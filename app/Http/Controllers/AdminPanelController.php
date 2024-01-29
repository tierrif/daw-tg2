<?php

namespace App\Http\Controllers;

use App\Models\RegisteredTripsAnalyticsModel;
use App\Models\Station;
use App\Models\StationSearchAnalyticsModel;
use App\Models\WebsiteVisitorsAnalyticsModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminPanelController extends Controller
{
    /**
     * TODO: I will make a verification if it's an admin but i will have to do a middleware to do it properly
     */
    public function index()
    {
        $user = Auth::getUser();
        if ($user->permissions === 0){
            echo "ola";
            return redirect('/');
        }
        $stationsSearch = count(StationSearchAnalyticsModel::all());
        $visitorsCount = count(WebsiteVisitorsAnalyticsModel::all());
        $registeredTrips = count(RegisteredTripsAnalyticsModel::all());
        $urlMostViewed = WebsiteVisitorsAnalyticsModel::select('url_visited', \DB::raw('COUNT(url_visited) as value_occurrence'))
            ->groupBy('url_visited')
            ->orderByDesc(\DB::raw('COUNT(url_visited)'))
            ->limit(1)
            ->first();
        $stationMostSearched = StationSearchAnalyticsModel::select('station_id', \DB::raw('COUNT(station_id) as value_occurrence'))
            ->groupBy('station_id')
            ->orderByDesc(\DB::raw('COUNT(station_id)'))
            ->limit(1)
            ->first();
        $stationMostSearchedName = Station::all()->firstWhere('id', $stationMostSearched->station_id);
        return view('pages.admin-panel', ['stationsSearch' => $stationsSearch, 'visitorsCount' => $visitorsCount,
            'registeredTrips' => $registeredTrips, 'mostVisitedUrl' => $urlMostViewed->url_visited,
            'mostVisitedUrlOcurrence' => $urlMostViewed->value_occurrence,
            'stationMostSearchedName' => $stationMostSearchedName->displayName,
            'stationMostSearchedOcurrence' => $stationMostSearched->value_occurrence]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
