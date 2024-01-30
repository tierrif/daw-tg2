<?php

namespace App\Http\Controllers;

use App\Models\RegisteredTripsAnalyticsModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RegisteredTripsAnalyticsController extends Controller
{
    public function index()
    {
        return count(RegisteredTripsAnalyticsModel::all());
    }

    public function store(Request $request)
    {
        $userId = $request->input('userId');
        $userAgent = $request->input('userAgent');

        DB::table('registed_tips_analytics')->insert([
            'userId' => $userId,
            'user_agent' => $userAgent,
            'created_at' => date('Y-m-d H:i:s')
        ]);

        return response('Insert with success');
    }
}
