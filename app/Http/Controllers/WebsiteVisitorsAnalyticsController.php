<?php

namespace App\Http\Controllers;

use App\Models\RegisteredTripsAnalyticsModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WebsiteVisitorsAnalyticsController extends Controller
{
    public function index()
    {
        return count(RegisteredTripsAnalyticsModel::all());
    }

    public function store(Request $request)
    {
        $urlVisited = $request->input('url_visited');
        $userAgent = $request->input('userAgent');

        DB::table('website_visitors_analytics')->insert([
            'url_visited' => $urlVisited,
            'user_agent' => $userAgent,
            'created_at' => date('Y-m-d H:i:s')
        ]);

        return response('Inserted with success');
    }
}
