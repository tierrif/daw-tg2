<?php

namespace App\Http\Controllers;

use App\Models\RegisteredTripsAnalyticsModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RegisteredTripsAnalyticsController extends Controller
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
        $userId = $request->input('userId');
        $userAgent = $request->input('userAgent');
        DB::table('registed_tips_analytics')->insert(['userId' => $userId, 'user_agent' => $userAgent]);
        return response("Insert with success");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return RegisteredTripsAnalyticsModel::all()->firstWhere('id', $id);
    }
}
