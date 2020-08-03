<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Course;

use App\Http\Controllers\Controller;

use App\Role;

use App\User;

use Auth;

use Illuminate\Support\Facades\DB ;

use App\Lesson ;


class HomeController extends Controller
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
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
		$user=Auth::user();
		// wait for activation 
		if($user->hasRole(3)) return redirect('/stdsh');
        return view('admin.layouts.partials.index');
    }
	
	public function showStudent()
	{
		return "";
	}
}
