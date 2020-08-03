<?php

namespace App\Http\Controllers\User;

use App\ClassRoom;
use App\ClassStudent;
use App\Http\Controllers\Requests\ClassRequestsController;
use App\RequestClass;
use App\User;
use App\Role;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UsersController extends Controller
{

    public function __construct()
    {
    
    $this->middleware('auth');
    
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexManager()
    {
        $managers = User::whereHas('roles', function ($query)  {
            $query->where('role', '=', 1);
        })->get();
        
        return view('admin.users.indexmanager',compact('managers'));
    }

    public function indexTeacher()
    {
        $teachers = User::whereHas('roles', function ($query)  {
            $query->where('role', '=', 2);
        })->get();
        //dd($managers,$teachers,$students);
        return view('admin.users.indexteacher',compact('teachers'));
    }

    public function indexStudent()
    {
        $students = User::whereHas('roles', function ($query)  {
            $query->where('role', '=', 3);
        })->get();
        
        return view('admin.users.indexstudent',compact('students'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view ('admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required|unique:users',
            'password' => 'required',

            'phone' => 'required',
            'tc' => 'required|max:15|min:11|unique:users',
            'role' => 'required',
        ]);

        $user = new User();
        $user->username = $request->username;
        $user->password = bcrypt($request->password);
        //$user->full_name = $request->full_name;
        $user->email = time().'@hh.com';
        $user->phone = $request->phone;
        
        $user->tc = $request->tc;
        $user->active=$request->active;
        $user->save();
        
        
          //$role = Role::where('role',0)->get();
          $user->roles()->attach(Role::where('role',$request->role)->get());
        

          //dd($request->role);
        //Return redirect 
        if($request->role === "1")
        {
        return redirect()
            ->route('users.indexmanager')
            ->with('success', 'تم اضافة مشرف بنجاح');
        }

        if($request->role === "2")
        {
            
        return redirect()
            ->route('users.indexteacher')
            ->with('success', 'تم اضافة مدرس بنجاح');
        }

        if($request->role === "3")
        {
        return redirect()
            ->route('users.indexstudent')
            ->with('success', 'تم اضافة طالب بنجاح');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view ('admin.users.show',compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  App\User  $user
     * @return \Illuminate\Http\Response
     */
     
    public function edit(User $user)
    {
        return view ('admin.users.edit',compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,User $user)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
            
            
            'phone' => 'required',
            'tc' => 'required|max:15|min:11',
            
        ]);

        $oldPassword = $user->passsword ;     
        
        $user->username = $request->username;
        if($request->password != $oldPassword)
        $user->password = bcrypt($request->password);
        
        //$user->email = $request->email;
        $user->phone = $request->phone;
        $user->tc = $request->tc;
        $user->save();
        

        //Return redirect 
        if($user->hasRole(1))
        {
        return redirect()
            ->route('users.indexmanager')
            ->with('success', 'تم تعديل مشرف بنجاح');
        }

        if($user->hasRole(2))
        {
            
        return redirect()
            ->route('users.indexteacher')
            ->with('success', 'تم تعديل مدرس بنجاح');
        }

        if($user->hasRole(3))
        {
        return redirect()
            ->route('users.indexstudent')
            ->with('success', 'تم تعديل طالب بنجاح');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $reqs=RequestClass::all()->where('student_id','=',$user->id);
        foreach ($reqs as $req)
            $req->delete();
        $reqs=ClassStudent::all()->where('student_id','=',$user->id);
        foreach ($reqs as $req)
            $req->delete();
        $user->delete();
        return redirect()->back()
        ->with('success','تم حذف مستخدم بنجاح');
    }

    public function activate(User $user){

        $user->active = true;
        
        $user->save();
        
        return redirect()->back()
                ->with('success','تم تفعيل المستخدم بنجاح');
    }

     /**
      * Action to deactivate A lesson
      */
      public function deactivate(User $user){
        $user->active = false;
        $user->save();

        return redirect()->back()
                ->with('success', 'تم إلغاء تفعيل المستخدم بنجاح');

      }
      public function getByClass($id)
      {

          if($id==0) {
              $students = User::whereHas('roles', function ($query) {
                  $query->where('role', '=', 3);
              })->get();
              return view('admin.users.studbyclass',compact('students'));
          }
          $students=ClassRoom::find($id)->students;
          return view('admin.users.studbyclass',compact('students'));
      }
}
