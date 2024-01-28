<?php

namespace App\Http\Controllers;

use App\Models\StationSearchAnalyticsModel;
use App\Models\WebsiteVisitorsAnalyticsModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StationSearchAnalyticsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return count(StationSearchAnalyticsModel::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $stationId = $request->input('station_id');
        $userAgent = $request->input('userAgent');
        DB::table('stations_search_analytics')->insert(['station_id' => $stationId, 'user_agent' => $userAgent, 'created_at' => date('Y-m-d H:i:s')]);
        return response("Insert with success");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return WebsiteVisitorsAnalyticsModel::all()->firstWhere('id', $id);
    }
}
