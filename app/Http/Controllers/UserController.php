<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;
class UserController extends Controller
{
    public function postSignup(Request $request){
        $this->validate($request, [
            'email'=>'email|required',
            'password'=>'required|min:4'
        ]);
        $user = new User([
            'email'=>$request->input('email'),
            'name'=>$request->input('name'),
            'password'=>bcrypt($request->input('password'))
        ]);
        $user->save();
        return response()->json($user,200);
    }
    public function postSignin(Request $request){
        $this->validate($request, [
            'email'=>'email|required',
            'password'=>'required|min:4'
        ]);
        if(Auth::attempt([
            'email'=>$request->input('email'),
            'password'=>$request->input('password')
        ])){
            return response()->json(['msg'=>'hey yoou'],200);
        }
        return response()->json(['msg'=>'Please leave us'],200);
    }
}
