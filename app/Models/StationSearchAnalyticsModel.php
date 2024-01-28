<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StationSearchAnalyticsModel extends Model
{
    use HasFactory;
    public $table = 'stations_search_analytics';
    public $fillable = ['station_id', 'user_agent'];
}
