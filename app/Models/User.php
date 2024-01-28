<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory;

    protected $table = 'users';
    protected $primaryKey = 'id';

    protected $fillable = ['name', 'email', 'password', 'balance', 'permissions'];


    public function stations(): BelongsToMany
    {
        return $this->belongsToMany(Station::class, 'frequentstations', 'userId', 'stationId');
    }
}
