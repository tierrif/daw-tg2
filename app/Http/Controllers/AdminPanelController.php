<?php

namespace App\Http\Controllers;

use App\Models\RegisteredTripsAnalyticsModel;
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
        return view('pages.admin-panel', ['stationsSearch' => $stationsSearch, 'visitorsCount' => $visitorsCount,
            'registeredTrips' => $registeredTrips]);
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
