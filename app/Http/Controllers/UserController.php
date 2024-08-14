<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function login(){
        return view('user.login');
    }
    public function loginPost(Request $request){
        $user = User::where([
            'username' => $request->username,
        ])->first();

        if($user && Hash::check($request->password, $user->password)){
            //login the user
            Auth::login($user);
            return to_route("workspace.index");
        }else{
            return back()->withErrors([
                'username'=> 'Invalid username or password',
            ]);
        }
    }
    public function logout(Request $request){
        Auth::logout();
        return to_route("user.login");
    }
}
