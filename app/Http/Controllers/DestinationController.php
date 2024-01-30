<?php

namespace App\Http\Controllers;

use App\Models\Destination;

class DestinationController extends Controller
{
    public function show(string $apiId)
    {
        return Destination::query()->where(['apiId' => $apiId])->first();
    }
}
