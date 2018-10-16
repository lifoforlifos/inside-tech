<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Admin;
use Auth;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin')->except('login');
    }

    public function index()
    {
        return response()->json(['admin' => true]);
    }

    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required|between:6,25'
        ]);

        $admin = Admin::where('email', $request->email)->where('password', $request->password)->first();

        if($admin) {
            $admin->api_token = str_random(60);
            $admin->save();

            return response()->json(['logged_in' => true, 'api_token' => $admin->api_token, 'user_id' => $admin->id]);
        } else {
            return response()->json(['error' => ['Provided email and password does not match!']], 422);
        }
    }

    public function logout(Request $request)
    {
        $admin = $request->admin();
        $admin->api_token = null;
        $admin->save();

        return response()->json(['logged_out' => true]);
    }
}
