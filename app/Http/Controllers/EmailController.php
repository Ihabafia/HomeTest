<?php

namespace App\Http\Controllers;

use Auth;
use App\Email;
use Illuminate\Http\Request;

class EmailController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $obj = new Email;
        $email = $request->email;
        $exist = Email::whereEmail($request->email)->first();

        if($exist){
            return response(['status' => "alert-danger", 'message' => "Email can't be added"], 200);
        } else {
            $obj->email = $request->email;
            $obj->user_id = Auth::id();
            $obj->save();
            return response(['status' => "alert-success", 'message' => "Email has been added successfully"], 200);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        if(Auth::check()){
            Email::whereEmail($request->email)->delete();
            return response(['status' => "alert-success", 'message' => "Email has been deleted successfully."], 200);
        }
    }

    public function changeDefaultEmail(Request $request){
        Email::where('email', '!=', $request->email)->where('user_id', Auth::id())->update(['is_default'=>'0']);
        Email::where('email', $request->email)->update(['is_default'=>'1']);

        return response(['status' => "alert-success", 'message' => "Changing default email is done successfully"], 200);
    }
}
