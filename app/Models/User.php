<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasFactory, HasApiTokens, Notifiable;

    protected $table = 'users';
    protected $primaryKey = 'id';

    protected $fillable = ['name', 'email', 'password', 'balance', 'permissions'];

    protected $hidden = array('password', 'remember_token');

    public function stations(): BelongsToMany
    {
        return $this->belongsToMany(Station::class, 'frequentstations', 'userId', 'stationId');
    }
}
