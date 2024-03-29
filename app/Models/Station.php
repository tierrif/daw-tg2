<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Station extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'frequentstations', 'stationId', 'userId');
    }

    public function lines(): BelongsToMany
    {
        return $this->belongsToMany(Line::class, 'stationlines', 'stationId', 'lineId');
    }
}
