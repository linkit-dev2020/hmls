<?php

namespace App\Http\Controllers;

use App\Notifications\NewCommentNotif;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Notification;

class TestingController extends Controller
{
    //
    public function __construct()
    {
        return $this->middleware('auth');
    }
    public function login(Request $request)
    {
        $email=$request->email;
        $password=$request->password;

        if(Auth::attempt(['email' => $email, 'password' => $password]))
             return response()->json(['success'=>true,'data'=>Auth::user()]);
        return response()->json(['success'=>false,'data'=>null,'error'=>'error in email or password']);
    }

    public function register(Request $request)
    {
        $email = $request->email;
        $password = Hash::make($request->password);
        $name=$request->name;
        $role=0;

        $user = new User();
        $user->email=$email;
        $user->name=$name;
        $user->password=$password;
        $user->role=0;

        $user->save();
        return response()->json(['success'=>true,'data'=>'Registered successfully','error'=>null]);
    }

    public function updateProfile(Request $request)
    {
        $userData = $request;
        $status=User::create_function($userData);
        if($status)
            return response()->json(['data'=>$status,'success'=>true,'error'=>null]);
        return response()->json(['data'=>null,'success'=>false,'error'=>'Error']);
    }

    public function delete(Request $request)
    {
        $id=$request->id;
        $status=User::destroy($id);
        if($status)
            return response()->json(['success'=>true,'data'=>'Deleted successfully']);
        return response()->json(['success'=>false,'error'=>'Unexpected Error']);
    }
}
