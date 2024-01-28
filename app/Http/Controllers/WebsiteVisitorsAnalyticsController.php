<?php

namespace App\Http\Controllers;

use App\Models\RegisteredTripsAnalyticsModel;
use App\Models\WebsiteVisitorsAnalyticsModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WebsiteVisitorsAnalyticsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return count(RegisteredTripsAnalyticsModel::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $urlVisited = $request->input('url_visited');
        $userAgent = $request->input('userAgent');
        DB::table('website_visitors_analytics')->insert(['url_visited' => $urlVisited, 'user_agent' => $userAgent]);
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
