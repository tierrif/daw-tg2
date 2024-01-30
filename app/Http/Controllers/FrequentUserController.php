<?php

namespace App\Http\Controllers;

use App\Models\Line;
use App\Models\RegisteredTripsAnalyticsModel;
use App\Models\Station;
use App\Models\StationSearchAnalyticsModel;
use App\Models\User;
use App\Models\WebsiteVisitorsAnalyticsModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class FrequentUserController extends Controller
{
    public function index()
    {
        $user = Auth::getUser();
        if ($user->permissions == 1) {
            return $this->adminPanel();
        }

        $name = $user['name'];
        $lines = Line::all();
        $balance = $user['balance'];
        $frequentStations = User::with('stations')->with('stations.lines')->get()->firstWhere('email', $user['email'])['stations'];
        $allStations = Station::all()->toArray();
        $filterStations = [];
        $frequentStationsArr = User::with('stations')->get()->firstWhere('email', $user['email'])->toArray()['stations'];
        foreach ($allStations as $s) {
            $asStation = array_filter($frequentStationsArr, function ($f) use ($s) {
                return $f['id'] == $s['id'];
            });

            if (count($asStation) === 0) {
                array_push($filterStations, $s);
            }
        }

        return view('pages.frequent-user', [
            'username' => $name, 'userId' => $user['id'], 'lines' => $lines,
            'balance' => $balance, 'frequentStations' => $frequentStations, 'allStations' => $filterStations,
            'token' => $user->createToken('main', ['server:update'])->plainTextToken,
        ]);
    }

    private function adminPanel()
    {
        $stationsSearch = count(StationSearchAnalyticsModel::all());
        $visitorsCount = count(WebsiteVisitorsAnalyticsModel::all());
        $registeredTrips = count(RegisteredTripsAnalyticsModel::all());

        $urlMostViewed = WebsiteVisitorsAnalyticsModel::select('url_visited', DB::raw('COUNT(url_visited) as value_occurrence'))
            ->groupBy('url_visited')
            ->orderByDesc(DB::raw('COUNT(url_visited)'))
            ->limit(1)
            ->first();

        $stationMostSearched = StationSearchAnalyticsModel::select('station_id', DB::raw('COUNT(station_id) as value_occurrence'))
            ->groupBy('station_id')
            ->orderByDesc(DB::raw('COUNT(station_id)'))
            ->limit(1)
            ->first();

        $stationMostSearchedName = Station::all()->firstWhere('id', $stationMostSearched?->station_id ?? -1);

        return view('pages.admin-panel', [
            'stationsSearch' => $stationsSearch, 'visitorsCount' => $visitorsCount,
            'registeredTrips' => $registeredTrips, 'mostVisitedUrl' => $urlMostViewed->url_visited,
            'mostVisitedUrlOcurrence' => $urlMostViewed->value_occurrence,
            'stationMostSearchedName' => $stationMostSearchedName?->displayName ?? 'N/A',
            'stationMostSearchedOcurrence' => $stationMostSearched?->value_occurrence ?? 0
        ]);
    }
}
