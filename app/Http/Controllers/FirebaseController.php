<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class FirebaseController extends Controller
{
    public function postToken(Request $request){
        $user = User::find(Auth::user()->id); 
        $user->device_token = $request->input('device_token');
        $user->save();
    }
}
