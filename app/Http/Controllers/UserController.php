<?php

namespace App\Http\Controllers;

use App\{User, Email};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        User::whereId(Auth::id())->update([$request->field=>$request->value]);

        return response(['status' => "alert-success", 'message' => "User information has been updated."], 200);
    }

    public function profile(){
        $user = User::whereId(Auth::id())->first();

        return view('profile', compact('user'));
    }

}
