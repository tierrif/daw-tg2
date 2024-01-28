<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class BalanceController extends Controller
{
    public function show(string $id)
    {
        return User::all()->where('id', $id)[0]['balance'];
    }

    public function update(Request $request, string $id)
    {
        $userId = $id;
        $requestedAddBalance = $request->input('balance');
        $user = User::all()->where('id', $userId)[0];
        $user->balance += floatval($requestedAddBalance);
        $user->save();
        return response("Updated with sucess");
    }
}
