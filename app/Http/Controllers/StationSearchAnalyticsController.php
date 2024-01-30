<?php

namespace App\Http\Controllers;

use App\Models\StationSearchAnalyticsModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StationSearchAnalyticsController extends Controller
{
    public function index()
    {
        return count(StationSearchAnalyticsModel::all());
    }

    public function store(Request $request)
    {
        $stationId = $request->input('station_id');
        $userAgent = $request->input('userAgent');

        DB::table('stations_search_analytics')->insert([
            'station_id' => $stationId,
            'user_agent' => $userAgent,
            'created_at' => date('Y-m-d H:i:s'),
        ]);

        return response('Inserted with success');
    }
}
