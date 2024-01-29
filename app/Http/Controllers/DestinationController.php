<?php

namespace App\Http\Controllers;

use App\Models\Destination;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class DestinationController extends Controller
{
    public function show(string $apiId)
    {
        return Destination::query()->where(['apiId' => $apiId])->first();
    }
}
