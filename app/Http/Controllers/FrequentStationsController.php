<?php

namespace App\Http\Controllers;

use App\Models\Station;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class FrequentStationsController extends Controller
{
    public function store(Request $request): int
    {
        // TODO: Add responses
        $stringId = $request->input('stringId');
        $userId = $request->input('userId');
        $frequentStringId = Station::all()->firstWhere('stringId', $stringId);
        return DB::table('frequentstations')->insertGetId(['stationId' => $frequentStringId['id'], 'userId' => $userId]);
    }

    public function show(string $userId)
    {
        // TODO: Add responses
        $frequentStations = DB::table('frequentstations')->where('userId', $userId)->get();
        if (empty($frequentStations))
            return [];
        $stations = [];
        foreach ($frequentStations as $f) {
            array_push($stations, Station::all()->firstWhere('id', $f->stationId));
        }
        return $stations;
    }


    public function destroy(Request $request, string $userId)
    {
        $stationId = $request->input('stationId');
        if ($userId == "" || $stationId == "")
            return response("Some fields were not fullfield!!!", Response::HTTP_BAD_REQUEST);
        DB::table('frequentstations')->where('userId', $userId)
            ->where('stationId', $stationId)->delete();
        return response("Deleted with sucess");
    }
}
