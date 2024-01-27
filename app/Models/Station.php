<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Station extends Model
{
    use HasFactory;

    public function lines(): BelongsToMany
    {
        return $this->belongsToMany(Line::class, 'stationlines', 'stationId', 'lineId');
    }
}
