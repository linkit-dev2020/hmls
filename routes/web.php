<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/stdsh/show/{cid}/{uid}/{lid}','StudentDashboard@showSubject');
Route::get('/stdsh/showCourse/{cid}/{lid}','StudentDashboard@showCourseLesson');
Route::get('/stdsh/show/course/{cid}','StudentDashboard@showCourse');
Route::get('/stdsh/showtest/{cid}/test/{tid}','StudentDashboard@showTest');
Route::get('/stdsh/showtestcourse/{cid}/test/{tid}','StudentDashboard@showTestCourse');
Route::get('/stdsh/show/{cid}/','StudentDashboard@showSubjectMain');
Route::get('/stdsh','StudentDashboard@index');
Route::get('/stdsh/class/{id}','GuestController@showCourses');
Route::get('/stdsh/myclasses','StudentDashboard@myclasses');
Route::get('/stdsh/myclass/{id}','StudentDashboard@showMyClass');
Route::get('/about',function()
{
   return view('front-end.nhome.about');
});
Route::get('/class',function ()
{
   $classes=\App\ClassRoom::all()->sortBy('order_num');
   return view('front-end.nhome.class',compact('classes'));
});
Route::get('course',function()
{
    $courses =\App\Course::all()->sortBy('order_num');
    return view('front-end.nhome.course',compact('courses'));
	
});

Route::get('/contact',function()
{
   return view('front-end.nhome.contact');
});
Route::get('welcome',function(){

    return view('welcome');
});

Route::get('/activate','HomeController@showStudent')->name('activate');
/**
 * Front-End Endpoints
 */

 //Home interface
Route::get('/', function() {
    $studentThanks = \App\StudentThank::latest()->get();
    $carousels = \App\Carousel::latest()->get();
    $showLessons =\App\ShowLesson::latest()->get();
    $classes =\App\ClassRoom::all()->sortBy('order_num');
    $courses =\App\Course::all()->sortBy('order_num');
    $notes = \App\Note::where('type','public')->get();
    return view('front-end.nhome.home',compact('studentThanks','carousels','showLessons','classes','courses','notes'));
});Route::get('/testing',function(){	return "Hello World";});Route::get('/teesting',function(){	return "Hello World";});

Route::get('/contactUs', function() {
    $classes =\App\ClassRoom::latest()->get();
    $courses =\App\Course::latest()->get();
    $notes = \App\Note::where('type','public')->get();
    return view('front-end.contactUs.contactUs', compact('studentThanks','carousels','showLessons','classes','courses','notes'));
})->name('contactUs');

Route::get('/AboutUs', function() {
    $classes =\App\ClassRoom::latest()->get();
    $courses =\App\Course::latest()->get();

    return view('front-end.aboutUs.aboutUs', compact('classes', 'courses'));
})->name('AboutUs');

/**
 * Class Operatrions
 */
//Show All Classes
Route::get('classes',
['uses' => 'ClassRoom\ClassesController@index',
'middleware' => 'roles',
'roles' => [\App\Role::ADMIN,\App\Role::MANAGER,\App\Role::TEACHER,\App\Role::STUDENT]
])
->name('class.index');


//Show Active Courses Only 
//TODO display courses depending on the Role of the user 

//Show The Form to Create New Class 
Route::get('classes/create',
['uses' => 'ClassRoom\ClassesController@create',
'middleware' => 'roles',
'roles' => [\App\Role::ADMIN,\App\Role::MANAGER]
])
->name('class.create');

//Show One Class 
Route::get('classes/{class}',
['uses' => 'ClassRoom\ClassesController@show',
'middleware' => 'roles',
'roles' => [\App\Role::ADMIN,\App\Role::MANAGER,\App\Role::TEACHER,\App\Role::STUDENT]
])
->name('class.show');


//Store the new Class in the database 
Route::post('classes',
['uses' => 'ClassRoom\ClassesController@store',
'middleware' => 'roles',
'roles' => [\App\Role::ADMIN,\App\Role::MANAGER]
])
->name('class.store');

//Show the Form to edit a class
Route::get('classes/{class}/edit',
['uses' => 'ClassRoom\ClassesController@edit',
'middleware' => 'roles',
'roles' => [\App\Role::ADMIN,\App\Role::MANAGER]
])
->name('class.edit');


//Update A Class 
Route::patch('classes/{class}/',
['uses' => 'ClassRoom\ClassesController@update',
'middleware' => 'roles',
'roles' => [\App\Role::ADMIN,\App\Role::MANAGER]
])
->name('class.update');

//Delete A Class 
Route::delete('classes/{class}',
['uses' => 'ClassRoom\ClassesController@destroy',
'middleware' => 'roles',
'roles' => [\App\Role::ADMIN,\App\Role::MANAGER]
])
->name('class.destroy');

//endpoint to Make The Class Free
Route::post('classes/{class}/setFree',
['uses' => 'ClassRoom\ClassesController@free',
'middleware' => 'roles',
'roles' => [\App\Role::ADMIN,\App\Role::MANAGER]
])
->name('class.free');


//endpoint to make the class priced 
Route::post('classes/{class}/setPriced',
['uses' => 'ClassRoom\ClassesController@priced',
'middleware' => 'roles',
'roles' => [\App\Role::ADMIN,\App\Role::MANAGER]
])
->name('class.priced');


//update freereason route
Route::post('classes/{class}/addteacher',
    ['uses' => 'ClassRoom\ClassesController@addteacher',
        'middleware' => 'roles',
        'roles' => [\App\Role::ADMIN,\App\Role::MANAGER
        ]])
    ->name('class.addteacher');


Route::post('classes/{class}/addStudent',
    ['uses' => 'ClassRoom\ClassesController@addStudent',
        'middleware' => 'roles',
        'roles' => [\App\Role::ADMIN,\App\Role::MANAGER
        ]])
    ->name('class.addstudent');

//update freereason route
Route::post('classes/{class}/deleteTeacher',
['uses' => 'ClassRoom\ClassesController@deleteTeacher',
'middleware' => 'roles',
'roles' => [\App\Role::ADMIN,\App\Role::MANAGER
]])
->name('class.deleteteacher');

//update freereason route
Route::post('classes/{class}/deleteStudent',
['uses' => 'ClassRoom\ClassesController@deleteStudent',
'middleware' => 'roles',
'roles' => [\App\Role::ADMIN,\App\Role::MANAGER
]])
->name('class.deletestudent');

Route::post('classes/{class}/deleteAllStudents',
['uses' => 'ClassRoom\ClassesController@deleteAllStudents',
'middleware' => 'roles',
'roles' => [\App\Role::ADMIN,\App\Role::MANAGER
]])
->name('class.deleteAllStudents');


/**Courses Endpoints */

//Show All Courses
Route::get('courses',
['uses' => 'Course\CoursesController@index',
'middleware' => 'roles',
'roles' => [\App\Role::ADMIN,\App\Role::MANAGER,\App\Role::TEACHER,\App\Role::STUDENT]
])
    ->name('course.index');
// / get courses of current student
Route::get('mycourses',
    ['uses' => 'Course\CoursesController@myCourses',
        'middleware' => 'roles',
        'roles' => [\App\Role::ADMIN,\App\Role::MANAGER,\App\Role::TEACHER,\App\Role::STUDENT]
    ])
    ->name('course.mycourses');

//Create A Form to store new Course 
Route::get('courses/create',
['uses' => 'Course\CoursesController@create',
'middleware' => 'roles',
'roles' => [\App\Role::ADMIN,\App\Role::MANAGER]
])
    ->name('course.create');

//Post Course 
Route::post('courses',
['uses' => 'Course\CoursesController@store',
'middleware' => 'roles',
'roles' => [\App\Role::ADMIN,\App\Role::MANAGER]
])
    ->name('course.store');

//Show A Single Course 
Route::get('courses/{course}',
['uses' => 'Course\CoursesController@show',
'middleware' => 'roles',
'roles' => [\App\Role::ADMIN,\App\Role::MANAGER,\App\Role::TEACHER,\App\Role::STUDENT]
])
    ->name('course.show');

//Delete A Course
 Route::delete('courses/{course}','Course\CoursesController@destroy')
     ->name('course.destroy');
Route::delete('courses/{course}',
['uses' => 'Course\CoursesController@destroy',
'middleware' => 'roles',
'roles' => [\App\Role::ADMIN,\App\Role::MANAGER]
])
     ->name('course.destroy');




//Edit A Course
Route::get('courses/{course}/edit',
['uses' => 'Course\CoursesController@edit',
'middleware' => 'roles',
'roles' => [\App\Role::ADMIN,\App\Role::MANAGER]
])
    ->name('course.edit');


//Update A Course 
Route::patch('courses/{course}',
['uses' => 'Course\CoursesController@update',
'middleware' => 'roles',
'roles' => [\App\Role::ADMIN,\App\Role::MANAGER]
])
    ->name('course.update');


//Activate A Course 
Route::post('courses/{course}/activate',
['uses' => 'Course\CoursesController@activate',
'middleware' => 'roles',
'roles' => [\App\Role::ADMIN,\App\Role::MANAGER]
])
    ->name('course.activate');

//Deactivate A Course 
Route::post('courses/{course}/deactivate',
['uses' => 'Course\CoursesController@deactivate',
'middleware' => 'roles',
'roles' => [\App\Role::ADMIN,\App\Role::MANAGER]
])
    ->name('course.deactivate');

    //Show The Form to add Lesson to Course 
Route::get('courses/{course}/addlesson',
['uses' => 'Course\CoursesController@addLesson',
'middleware' => 'roles',
'roles' => [\App\Role::ADMIN,\App\Role::MANAGER,\App\Role::TEACHER]
])
->name('course.addlesson');



//Update The Course attach lesson
Route::post('courses/{course}',
['uses' => 'Course\CoursesController@storeLesson',
'middleware' => 'roles',
'roles' => [\App\Role::ADMIN,\App\Role::MANAGER,\App\Role::TEACHER]
])
->name('course.storelesson');

//Update The course detach lesson
Route::post('courses/{course}',
['uses' => 'Course\CoursesController@deleteLesson',
'middleware' => 'roles',
'roles' => [\App\Role::ADMIN,\App\Role::MANAGER,\App\Role::TEACHER]
])
->name('course.deletelesson');

    //update freereason route
Route::post('courses/{course}/addteacher',
['uses' => 'Course\CoursesController@addteacher',
'middleware' => 'roles',
'roles' => [\App\Role::ADMIN,\App\Role::MANAGER
]])
->name('course.addteacher');

Route::post('courses/{course}/addstudent',
    ['uses' => 'Course\CoursesController@addStudent',
        'middleware' => 'roles',
        'roles' => [\App\Role::ADMIN,\App\Role::MANAGER
        ]])
    ->name('course.addstudent');


    //update freereason route
Route::post('courses/{course}/deleteteacher',
['uses' => 'Course\CoursesController@deleteTeacher',
'middleware' => 'roles',
'roles' => [\App\Role::ADMIN,\App\Role::MANAGER
]])
->name('course.deleteteacher');

    //update freereason route
    Route::post('courses/{course}/deletestudent',
    ['uses' => 'Course\CoursesController@deleteStudent',
    'middleware' => 'roles',
    'roles' => [\App\Role::ADMIN,\App\Role::MANAGER
    ]])
    ->name('course.deletestudent');
	
	Route::post('courses/{course}/deleteallstudents',
    ['uses' => 'Course\CoursesController@deleteAllStudents',
    'middleware' => 'roles',
    'roles' => [\App\Role::ADMIN,\App\Role::MANAGER
    ]])
    ->name('course.deleteAllStudents');
    
/**
 * Subjects endpoints
 */

//Show All Subjects 
Route::get('/subjects',
['uses' => 'Subject\SubjectsController@index',
'middleware' => 'roles',
'roles' => [\App\Role::ADMIN,\App\Role::MANAGER,\App\Role::TEACHER]
])
->name('subject.index');


//Show The Form to Create A New Subject 
Route::get('subjects/create',
['uses' => 'Subject\SubjectsController@create',
'middleware' => 'roles',
'roles' => [\App\Role::ADMIN,\App\Role::MANAGER]
])
    ->name('subject.create');

//Show A Single Subject 
Route::get('subjects/{subject}',
['uses' => 'Subject\SubjectsController@show',
'middleware' => 'roles',
'roles' => [\App\Role::ADMIN,\App\Role::MANAGER,\App\Role::TEACHER,\App\Role::STUDENT]
])
->name('subject.show');


//DELETE A Subject 
Route::delete('subjects/{subject}',
    ['uses' => 'Subject\SubjectsController@destroy',
    'middleware' => 'roles',
    'roles' => [\App\Role::ADMIN,\App\Role::MANAGER]
    ])
    ->name('subject.destroy');



//Store Subject 
Route::post('subjects',
['uses' => 'Subject\SubjectsController@store',
'middleware' => 'roles',
'roles' => [\App\Role::ADMIN,\App\Role::MANAGER]
])
->name('subject.store');


//Edit A Subject 
Route::get('subjects/{subject}/edit',
['uses' => 'Subject\SubjectsController@edit',
'middleware' => 'roles',
'roles' => [\App\Role::ADMIN,\App\Role::MANAGER]
])
->name('subject.edit');


//Update A Subject 
Route::put('subjects/{subject}',
['uses' => 'Subject\SubjectsController@update',
'middleware' => 'roles',
'roles' => [\App\Role::ADMIN,\App\Role::MANAGER]
])
->name('subject.update');


//Activate A Subject 
Route::post('subjects/{subject}/activate',
['uses' => 'Subject\SubjectsController@activate',
'middleware' => 'roles',
'roles' => [\App\Role::ADMIN,\App\Role::MANAGER]
])
->name('subject.activate');



//Deactivate A Subject 
Route::post('subjects/{subject}/deactivate',
['uses' => 'Subject\SubjectsController@deactivate',
'middleware' => 'roles',
'roles' => [\App\Role::ADMIN,\App\Role::MANAGER]
])
->name('subject.deactivate');

//update freereason route
Route::post('subjects/{subject}/addteacher',
['uses' => 'Subject\SubjectsController@addteacher',
'middleware' => 'roles',
'roles' => [\App\Role::ADMIN,\App\Role::MANAGER
]])
->name('subject.addteacher');

//update freereason route
Route::post('subjects/{subject}/deleteTeacher',
['uses' => 'Subject\SubjectsController@deleteTeacher',
'middleware' => 'roles',
'roles' => [\App\Role::ADMIN,\App\Role::MANAGER
]])
->name('subject.deleteteacher');


Route::post('subjects/{subject}/attachTest',
    ['uses' => 'Subject\SubjectsController@attachTest',
        'middleware' => 'roles',
        'roles' => [\App\Role::ADMIN,\App\Role::MANAGER,\App\Role::TEACHER]
    ])
    ->name('subject.attachTest');

Route::post('subjects/{subject}/detachTest',
    ['uses' => 'Unit\SubjectsController@deleteTest',
        'middleware' => 'roles',
        'roles' => [\App\Role::ADMIN,\App\Role::MANAGER,\App\Role::TEACHER]
    ])
    ->name('subject.deleteTest');

/**
 * Units endpoints
 */

 //Index Units 
 //Display All Units 
 Route::get('units',
 ['uses' => 'Unit\UnitsController@index',
'middleware' => 'roles',
'roles' => [\App\Role::ADMIN,\App\Role::MANAGER,\App\Role::TEACHER]
])
    ->name('unit.index');


//Delete A Unit 
Route::delete('units/{unit}',
['uses' => 'Unit\UnitsController@destroy',
'middleware' => 'roles',
'roles' => [\App\Role::ADMIN,\App\Role::MANAGER,\App\Role::TEACHER]
])
    ->name('unit.destroy');



//Show All Classes to choose A Class to create A Unit in it 

Route::get('units/create','Unit\UnitsController@chooseClass');


//Show The Form to create a New Unit 
Route::get('units/create',
['uses' => 'Unit\UnitsController@create',
'middleware' => 'roles',
'roles' => [\App\Role::ADMIN,\App\Role::MANAGER,\App\Role::TEACHER]
])
    ->name('unit.create');

//Store The Unit 
Route::post('units',
['uses' => 'Unit\UnitsController@store',
'middleware' => 'roles',
'roles' => [\App\Role::ADMIN,\App\Role::MANAGER,\App\Role::TEACHER]
])
->name('unit.store');


//Show The Form to edit A Unit 
Route::get('units/{unit}/edit',
['uses' => 'Unit\UnitsController@edit',
'middleware' => 'roles',
'roles' => [\App\Role::ADMIN,\App\Role::MANAGER,\App\Role::TEACHER]
])
    ->name('unit.edit');

//Update The Unit 
Route::put('units/{unit}',
['uses' => 'Unit\UnitsController@update',
'middleware' => 'roles',
'roles' => [\App\Role::ADMIN,\App\Role::MANAGER,\App\Role::TEACHER]
])
->name('unit.update');

//Show A Unit 
Route::get('units/{unit}',
['uses' => 'Unit\UnitsController@show',
'middleware' => 'roles',
'roles' => [\App\Role::ADMIN,\App\Role::MANAGER,\App\Role::TEACHER,\App\Role::STUDENT]
])
    ->name('unit.show');

//Activate A unit 
Route::post('units/{unit}/activate',
['uses' => 'Unit\UnitsController@activate',
'middleware' => 'roles',
'roles' => [\App\Role::ADMIN,\App\Role::MANAGER]
])
    ->name('unit.activate');

//Deactivate The unit 
Route::post('units/{unit}/deactivate',
['uses' => 'Unit\UnitsController@deactivate',
'middleware' => 'roles',
'roles' => [\App\Role::ADMIN,\App\Role::MANAGER]
])
->name('unit.deactivate');

//Show The Form to add Lesson to Unit 
// Route::get('units/{unit}/addlesson','Unit\UnitsController@addLesson')
//     ->name('unit.addlesson');

    //Update The Unit attach lesson
Route::post('units/{unit}/attachlesson',
['uses' => 'Unit\UnitsController@attachLesson',
'middleware' => 'roles',
'roles' => [\App\Role::ADMIN,\App\Role::MANAGER,\App\Role::TEACHER]
])
->name('unit.attachlesson');

//Update The Unit detach lesson
Route::post('units/{unit}/detachlesson',
['uses' => 'Unit\UnitsController@deleteLesson',
'middleware' => 'roles',
'roles' => [\App\Role::ADMIN,\App\Role::MANAGER,\App\Role::TEACHER]
])
->name('unit.deletelesson');



/* Carousels Endpoints */ 
Route::get('carousels',
['uses' => 'Carousel\CarouselsController@index',
'middleware' => 'roles',
'roles' => [\App\Role::ADMIN,\App\Role::MANAGER]])->name('carousel.index');

//Show the form to create a new carousel 
Route::get('carousels/create',
['uses' => 'Carousel\CarouselsController@create',
'middleware' => 'roles',
'roles' => [\App\Role::ADMIN,\App\Role::MANAGER
]])
->name('carousel.create');


//Show The Form to Edit Carousel 
Route::get('carousels/{carousel}/edit',
['uses' => 'Carousel\CarouselsController@edit',
'middleware' => 'roles',
'roles' => [\App\Role::ADMIN,\App\Role::MANAGER
]])
    ->name('carousel.edit');

//Show Single Carousel 
Route::get('carousels/{carousel}',
['uses' => 'Carousel\CarouselsController@show',
'middleware' => 'roles',
'roles' => [\App\Role::ADMIN,\App\Role::MANAGER
]])
->name('carousel.show');

//Delete A Carousel 
Route::delete('carousels/{carousel}',
['uses' => 'Carousel\CarouselsController@destroy',
'middleware' => 'roles',
'roles' => [\App\Role::ADMIN,\App\Role::MANAGER
]])
->name('carousel.destroy');

//Store A Carousel 
Route::post('carousels',
['uses' => 'Carousel\CarouselsController@store',
'middleware' => 'roles',
'roles' => [\App\Role::ADMIN,\App\Role::MANAGER
]])
->name('carousel.store');

//Update Carousel 
Route::put('carousels/{carousel}',
['uses' => 'Carousel\CarouselsController@update',
'middleware' => 'roles',
'roles' => [\App\Role::ADMIN,\App\Role::MANAGER
]])
->name('carousel.update');



//Index Show Lesson 
 //Display All show lessons 
 Route::get('showlessons',
 ['uses' => 'ShowLesson\ShowLessonsController@index',
'middleware' => 'roles',
'roles' => [\App\Role::ADMIN,\App\Role::MANAGER,\App\Role::TEACHER,\App\Role::STUDENT
]])
    ->name('showlesson.index');

//Show The Form to create a New ShowLesson 
Route::get('showlessons/create',
['uses' => 'ShowLesson\ShowLessonsController@create',
'middleware' => 'roles',
'roles' => [\App\Role::ADMIN,\App\Role::MANAGER
]])
    ->name('showlesson.create');

    //Show A showlesson 
Route::get('showlessons/{showLesson}',
['uses' => 'ShowLesson\ShowLessonsController@show',
'middleware' => 'roles',
'roles' => [\App\Role::ADMIN,\App\Role::MANAGER,\App\Role::TEACHER,\App\Role::STUDENT
]])
->name('showlesson.show');

//store show lesson route
Route::post('showlessons',
['uses' => 'ShowLesson\ShowLessonsController@store',
'middleware' => 'roles',
'roles' => [\App\Role::ADMIN,\App\Role::MANAGER
]])
->name('showlesson.store');

//Show The Form to Edit a ShowLesson 
Route::get('showlessons/{showLesson}/edit',
['uses' => 'ShowLesson\ShowLessonsController@edit',
'middleware' => 'roles',
'roles' => [\App\Role::ADMIN,\App\Role::MANAGER
]])
    ->name('showlesson.edit');

    //update show lesson route
Route::put('showlessons/{showLesson}',
['uses' => 'ShowLesson\ShowLessonsController@update',
'middleware' => 'roles',
'roles' => [\App\Role::ADMIN,\App\Role::MANAGER
]])
->name('showlesson.update');




//Delete A ShowLesson 
Route::delete('showlessons/{showLesson}',
['uses' => 'ShowLesson\ShowLessonsController@destroy',
'middleware' => 'roles',
'roles' => [\App\Role::ADMIN,\App\Role::MANAGER
]])
    ->name('showlesson.destroy');



//display all denemes
    Route::get('denemes',
    ['uses' => 'Deneme\DenemesController@index',
     'middleware' => 'roles',
     'roles' => [\App\Role::ADMIN,\App\Role::MANAGER,\App\Role::TEACHER,\App\Role::STUDENT]
          ])->name('deneme.index');

    //create view route for deneme
    Route::get('denemes/create',
    ['uses' => 'Deneme\DenemesController@create',
'middleware' => 'roles',
'roles' => [\App\Role::ADMIN,\App\Role::MANAGER
]])
    ->name('deneme.create');

    //create view route for deneme
    Route::get('denemes/{deneme}',
    ['uses' => 'Deneme\DenemesController@show',
'middleware' => 'roles',
'roles' => [\App\Role::ADMIN,\App\Role::MANAGER,\App\Role::TEACHER,\App\Role::STUDENT
]])
    ->name('deneme.show');

    //store route for deneme
    Route::post('denemes',
    ['uses' => 'Deneme\DenemesController@store',
'middleware' => 'roles',
'roles' => [\App\Role::ADMIN,\App\Role::MANAGER
]])
    ->name('deneme.store');

    //Show The Form to Edit a Deneme 
Route::get('denemes/{deneme}/edit',
['uses' => 'Deneme\DenemesController@edit',
'middleware' => 'roles',
'roles' => [\App\Role::ADMIN,\App\Role::MANAGER
]])
->name('deneme.edit');

//update deneme route
Route::put('denemes/{deneme}',
['uses' => 'Deneme\DenemesController@update',
'middleware' => 'roles',
'roles' => [\App\Role::ADMIN,\App\Role::MANAGER
]])
->name('deneme.update');

//delete route for deneme
Route::delete('deneme/{deneme}',
['uses' => 'Deneme\DenemesController@destroy',
'middleware' => 'roles',
'roles' => [\App\Role::ADMIN,\App\Role::MANAGER
]])
->name('deneme.destroy');

//Activate A Deneme 
Route::post('denemes/{deneme}/activate',
['uses' => 'Deneme\DenemesController@activate',
'middleware' => 'roles',
'roles' => [\App\Role::ADMIN,\App\Role::MANAGER
]])
    ->name('deneme.activate');

//Deactivate A Deneme 
Route::post('denemes/{deneme}/deactivate',
['uses' => 'Deneme\DenemesController@deactivate',
'middleware' => 'roles',
'roles' => [\App\Role::ADMIN,\App\Role::MANAGER
]])
    ->name('deneme.deactivate');



//student Thanks index
Route::get('studentthanks',
['uses' => 'StudentThank\StudentThanksController@index',
'middleware' => 'roles',
'roles' => [\App\Role::ADMIN,\App\Role::MANAGER,\App\Role::TEACHER,\App\Role::STUDENT
]])
->name('studentthank.index');

//student thank create route
Route::get('studentthanks/create',
['uses' => 'StudentThank\StudentThanksController@create',
'middleware' => 'roles',
'roles' => [\App\Role::ADMIN,\App\Role::MANAGER
]])
->name('studentthank.create');

//student thank show route
Route::get('studentthanks/{studentThank}',
['uses' => 'StudentThank\StudentThanksController@show',
'middleware' => 'roles',
'roles' => [\App\Role::ADMIN,\App\Role::MANAGER,\App\Role::TEACHER,\App\Role::STUDENT
]])
->name('studentthank.show');

//store student thank route
Route::post('studentthanks',
['uses' => 'StudentThank\StudentThanksController@store',
'middleware' => 'roles',
'roles' => [\App\Role::ADMIN,\App\Role::MANAGER
]])
->name('studentthank.store');

//Show The Form to Edit a student thank 
Route::get('studentthanks/{studentThank}/edit',
['uses' => 'StudentThank\StudentThanksController@edit',
'middleware' => 'roles',
'roles' => [\App\Role::ADMIN,\App\Role::MANAGER
]])
    ->name('studentthank.edit');

    //update student thank route
Route::put('studentthanks/{studentThank}',
['uses' => 'StudentThank\StudentThanksController@update',
'middleware' => 'roles',
'roles' => [\App\Role::ADMIN,\App\Role::MANAGER
]])
->name('studentthank.update');

//Delete A student thank 
Route::delete('studentthanks/{studentThank}',
['uses' => 'StudentThank\StudentThanksController@destroy',
'middleware' => 'roles',
'roles' => [\App\Role::ADMIN,\App\Role::MANAGER
]])
    ->name('studentthank.destroy');


    //Evaluations index
Route::get('evaluations',
['uses' => 'Evaluation\EvaluationsController@index',
'middleware' => 'roles',
'roles' => [\App\Role::ADMIN,\App\Role::MANAGER,\App\Role::STUDENT
]])
->name('evaluation.index');

//Evaluation create route
Route::get('evaluations/create',
['uses' => 'Evaluation\EvaluationsController@create',
'middleware' => 'roles',
'roles' => [\App\Role::ADMIN,\App\Role::MANAGER,\App\Role::STUDENT
]])
->name('evaluation.create');

//Evaluation show route
Route::get('evaluations/{evaluation}',
['uses' => 'Evaluation\EvaluationsController@show',
'middleware' => 'roles',
'roles' => [\App\Role::ADMIN,\App\Role::MANAGER,\App\Role::STUDENT
]])
->name('evaluation.show');

//store Evaluation route
Route::post('evaluations',
['uses' => 'Evaluation\EvaluationsController@store',
'middleware' => 'roles',
'roles' => [\App\Role::ADMIN,\App\Role::MANAGER,\App\Role::STUDENT
]])
->name('evaluation.store');

//Show The Form to Edit a Evaluation 
Route::get('evaluations/{evaluation}/edit',
['uses' => 'Evaluation\EvaluationsController@edit',
'middleware' => 'roles',
'roles' => [\App\Role::ADMIN,\App\Role::MANAGER,\App\Role::STUDENT
]])
    ->name('evaluation.edit');

    //update Evaluation route
Route::put('evaluations/{evaluation}',
['uses' => 'Evaluation\EvaluationsController@update',
'middleware' => 'roles',
'roles' => [\App\Role::ADMIN,\App\Role::MANAGER,\App\Role::STUDENT
]])
->name('evaluation.update');

//Delete A Evaluation 
Route::delete('evaluations/{evaluation}',
['uses' => 'Evaluation\EvaluationsController@destroy',
'middleware' => 'roles',
'roles' => [\App\Role::ADMIN,\App\Role::MANAGER,\App\Role::STUDENT
]])
    ->name('evaluation.destroy');

 
 
    //freereasons index
Route::get('freereasons',
['uses' => 'FreeReason\FreeReasonsController@index',
'middleware' => 'roles',
'roles' => [\App\Role::ADMIN,\App\Role::MANAGER,2,3
]])
->name('freereason.index');

//freereason create route
Route::get('freereasons/create',
['uses' => 'FreeReason\FreeReasonsController@create',
'middleware' => 'roles',
'roles' => [\App\Role::ADMIN,\App\Role::MANAGER
]])
->name('freereason.create');

//freereason show route
Route::get('freereasons/{freeReason}',
['uses' => 'FreeReason\FreeReasonsController@show',
'middleware' => 'roles',
'roles' => [\App\Role::ADMIN,\App\Role::MANAGER
]])
->name('freereason.show');

//store freereason route
Route::post('freereasons',
['uses' => 'FreeReason\FreeReasonsController@store',
'middleware' => 'roles',
'roles' => [\App\Role::ADMIN,\App\Role::MANAGER
]])
->name('freereason.store');

//Show The Form to Edit a freereason
Route::get('freereasons/{freeReason}/edit',
['uses' => 'FreeReason\FreeReasonsController@edit',
'middleware' => 'roles',
'roles' => [\App\Role::ADMIN,\App\Role::MANAGER
]])
    ->name('freereason.edit');

    //update freereason route
Route::put('freereasons/{freeReason}',
['uses' => 'FreeReason\FreeReasonsController@update',
'middleware' => 'roles',
'roles' => [\App\Role::ADMIN,\App\Role::MANAGER
]])
->name('freereason.update');

//Delete A FreeReason 
Route::delete('freereasons/{freeReason}',
['uses' => 'FreeReason\FreeReasonsController@destroy',
'middleware' => 'roles',
'roles' => [\App\Role::ADMIN,\App\Role::MANAGER
]])
    ->name('freereason.destroy');

    //update freereason route
Route::post('freereasons/{freeReason}/addstudent',
['uses' => 'FreeReason\FreeReasonsController@addStudent',
'middleware' => 'roles',
'roles' => [\App\Role::ADMIN,\App\Role::MANAGER
]])
->name('freereason.addstudent');

//update freereason route
Route::post('freereasons/{freeReason}/deletestudent',
['uses' => 'FreeReason\FreeReasonsController@deleteStudent',
'middleware' => 'roles',
'roles' => [\App\Role::ADMIN,\App\Role::MANAGER
]])
->name('freereason.deletestudent');



    //Tests index
Route::get('tests',
['uses' => 'Test\TestController@index',
'middleware' => 'roles',
'roles' => [\App\Role::ADMIN,\App\Role::MANAGER,2
]])
->name('test.index');

//Test create route
Route::get('tests/create',
['uses' => 'Test\TestController@create',
'middleware' => 'roles',
'roles' => [\App\Role::ADMIN,\App\Role::MANAGER,2
]])
->name('test.create');

//Test show route
Route::get('tests/{test}',
['uses' => 'Test\TestController@show',
'middleware' => 'roles',
'roles' => [\App\Role::ADMIN,\App\Role::MANAGER,2,3
]])
->name('test.show');

//store Test route
Route::post('tests',
['uses' => 'Test\TestController@store',
'middleware' => 'roles',
'roles' => [\App\Role::ADMIN,\App\Role::MANAGER,2
]])
->name('test.store');

//Show The Form to Edit a Test
Route::get('tests/{test}/edit',
['uses' => 'Test\TestController@edit',
'middleware' => 'roles',
'roles' => [\App\Role::ADMIN,\App\Role::MANAGER,2
]])
    ->name('test.edit');

    //update Test route
Route::put('tests/{test}',
['uses' => 'Test\TestController@update',
'middleware' => 'roles',
'roles' => [\App\Role::ADMIN,\App\Role::MANAGER,2
]])
->name('test.update');

//Delete A Test 
Route::delete('tests/{test}',
['uses' => 'Test\TestController@destroy',
'middleware' => 'roles',
'roles' => [\App\Role::ADMIN,\App\Role::MANAGER,2
]])
    ->name('test.destroy');

//Activate A Test 
Route::post('tests/{test}/activate',
['uses' => 'Test\TestController@activate',
'middleware' => 'roles',
'roles' => [\App\Role::ADMIN,\App\Role::MANAGER]
])
->name('test.activate');



//Deactivate A Test 
Route::post('tests/{test}/deactivate',
['uses' => 'Test\TestController@deactivate',
'middleware' => 'roles',
'roles' => [\App\Role::ADMIN,\App\Role::MANAGER]
])
->name('test.deactivate');

//Add Attachment
Route::post('tests/{test}/addAttachment',
['uses' => 'Test\TestController@addAttachment',
'middleware' => 'roles',
'roles' => [\App\Role::ADMIN,\App\Role::MANAGER,\App\Role::TEACHER,\App\Role::STUDENT
]])
->name('test.addattachment');


//Comments index
Route::get('comments',
['uses' => 'Comment\CommentsController@index',
'middleware' => 'roles',
'roles' => [\App\Role::ADMIN,\App\Role::MANAGER,2,3
]])
->name('comment.index');

//Comment create route
Route::get('comments/create',
['uses' => 'Comment\CommentsController@create',
'middleware' => 'roles',
'roles' => [\App\Role::ADMIN,\App\Role::MANAGER,2,3
]])
->name('comment.create');

//Comment show route
Route::get('comments/{comment}',
['uses' => 'Comment\CommentsController@show',
'middleware' => 'roles',
'roles' => [\App\Role::ADMIN,\App\Role::MANAGER,2,3
]])
->name('comment.show');

//store Comment route
Route::post('comments',
['uses' => 'Comment\CommentsController@store',
'middleware' => 'roles',
'roles' => [\App\Role::ADMIN,\App\Role::MANAGER,2,3
]])
->name('comment.store');

//Show The Form to Edit a Comment
Route::get('comments/{comment}/edit',
['uses' => 'Comment\CommentsController@edit',
'middleware' => 'roles',
'roles' => [\App\Role::ADMIN,\App\Role::MANAGER,2,3
]])
    ->name('comment.edit');

    //update Comment route
Route::put('comments/{comment}',
['uses' => 'Comment\CommentsController@update',
'middleware' => 'roles',
'roles' => [\App\Role::ADMIN,\App\Role::MANAGER,2,3
]])
->name('comment.update');

//Delete A Comment 
Route::delete('comments/{comment}',
['uses' => 'Comment\CommentsController@destroy',
'middleware' => 'roles',
'roles' => [\App\Role::ADMIN,\App\Role::MANAGER,2,3
]])
    ->name('comment.destroy');


    //replies index
Route::get('replies',
['uses' => 'Reply\RepliesController@index',
'middleware' => 'roles',
'roles' => [\App\Role::ADMIN,\App\Role::MANAGER,2,3
]])
->name('reply.index');

//Reply create route
Route::get('replies/create',
['uses' => 'Reply\RepliesController@create',
'middleware' => 'roles',
'roles' => [\App\Role::ADMIN,\App\Role::MANAGER,2,3
]])
->name('reply.create');

//Reply show route
Route::get('replies/{reply}',
['uses' => 'Reply\RepliesController@show',
'middleware' => 'roles',
'roles' => [\App\Role::ADMIN,\App\Role::MANAGER,2,3
]])
->name('reply.show');

//store Reply route
Route::post('replies',
['uses' => 'Reply\RepliesController@store',
'middleware' => 'roles',
'roles' => [\App\Role::ADMIN,\App\Role::MANAGER,2,3
]])
->name('reply.store');

//Show The Form to Edit a Reply
Route::get('replies/{reply}/edit',
['uses' => 'Reply\RepliesController@edit',
'middleware' => 'roles',
'roles' => [\App\Role::ADMIN,\App\Role::MANAGER,2,3
]])
    ->name('reply.edit');

    //update Reply route
Route::put('replies/{reply}',
['uses' => 'Reply\RepliessController@update',
'middleware' => 'roles',
'roles' => [\App\Role::ADMIN,\App\Role::MANAGER,2,3
]])
->name('reply.update');

//Delete A Reply 
Route::delete('replies/{reply}',
['uses' => 'Reply\RepliesController@destroy',
'middleware' => 'roles',
'roles' => [\App\Role::ADMIN,\App\Role::MANAGER,2,3
]])
    ->name('reply.destroy');


       //attachments index
Route::get('attachments',
['uses' => 'Attachment\AttachmentsController@index',
'middleware' => 'roles',
'roles' => [\App\Role::ADMIN,\App\Role::MANAGER,2,3
]])
->name('attachment.index');

//attachment create route
Route::get('attachments/create',
['uses' => 'Attachment\AttachmentsController@create',
'middleware' => 'roles',
'roles' => [\App\Role::ADMIN,\App\Role::MANAGER,2
]])
->name('attachment.create');

//attachment show route
Route::get('attachments/{attachment}',
['uses' => 'Attachment\AttachmentsController@show',
'middleware' => 'roles',
'roles' => [\App\Role::ADMIN,\App\Role::MANAGER,2,3
]])
->name('attachment.show');

//store attachment route
Route::post('attachments',
['uses' => 'Attachment\AttachmentsController@store',
'middleware' => 'roles',
'roles' => [\App\Role::ADMIN,\App\Role::MANAGER,2
]])
->name('attachment.store');

//Show The Form to Edit a attachment
Route::get('attachments/{attachment}/edit',
['uses' => 'Attachment\AttachmentsController@edit',
'middleware' => 'roles',
'roles' => [\App\Role::ADMIN,\App\Role::MANAGER,2
]])
    ->name('attachment.edit');

    //update attachment route
Route::put('attachments/{attachment}',
['uses' => 'Attachment\AttachmentsController@update',
'middleware' => 'roles',
'roles' => [\App\Role::ADMIN,\App\Role::MANAGER,2
]])
->name('attachment.update');

//Delete A attachment 
Route::delete('attachments/{attachment}',
['uses' => 'Attachment\AttachmentsController@destroy',
'middleware' => 'roles',
'roles' => [\App\Role::ADMIN,\App\Role::MANAGER,2
]])
    ->name('attachment.destroy');


     //advices index
Route::get('advices',
['uses' =>'Advice\AdvicesController@index',
'middleware' => 'roles',
'roles' => [\App\Role::ADMIN,\App\Role::MANAGER,2,3
]])
->name('advice.index');

//advice create route
Route::get('advices/create',
['uses' =>'Advice\AdvicesController@create',
'middleware' => 'roles',
'roles' => [\App\Role::ADMIN,\App\Role::MANAGER
]])
->name('advice.create');

//advice show route
Route::get('advices/{advice}',
['uses' =>'Advice\AdvicesController@show',
'middleware' => 'roles',
'roles' => [\App\Role::ADMIN,\App\Role::MANAGER,2,3
]])
->name('advice.show');

//store advice route
Route::post('advices',
['uses' =>'Advice\AdvicesController@store',
'middleware' => 'roles',
'roles' => [\App\Role::ADMIN,\App\Role::MANAGER
]])
->name('advice.store');

//Show The Form to Edit an advice
Route::get('advices/{advice}/edit',
['uses' =>'Advice\AdvicesController@edit',
'middleware' => 'roles',
'roles' => [\App\Role::ADMIN,\App\Role::MANAGER
]])
    ->name('advice.edit');

    //update advice route
Route::put('advices/{advice}',
['uses' =>'Advice\AdvicesController@update',
'middleware' => 'roles',
'roles' => [\App\Role::ADMIN,\App\Role::MANAGER
]])
->name('advice.update');

//Delete An advice 
Route::delete('advices/{advice}',
['uses' =>'Advice\AdvicesController@destroy',
'middleware' => 'roles',
'roles' => [\App\Role::ADMIN,\App\Role::MANAGER
]])
    ->name('advice.destroy');

     //Activate A advice 
Route::post('advices/{advice}/activate',
['uses' => 'Advice\AdvicesController@activate',
'middleware' => 'roles',
'roles' => [\App\Role::ADMIN,\App\Role::MANAGER
]])
->name('advice.activate');

//Deactivate A advice 
Route::post('advices/{advice}/deactivate',
['uses' => 'Advice\AdvicesController@deactivate',
'middleware' => 'roles',
'roles' => [\App\Role::ADMIN,\App\Role::MANAGER
]])
->name('advice.deactivate');



        //lessons index
Route::get('lessons',
['uses' => 'Lesson\LessonsController@index',
'middleware' => 'roles',
'roles' => [\App\Role::ADMIN,\App\Role::MANAGER,\App\Role::STUDENT,\App\Role::TEACHER
]])
->name('lesson.index');


Route::get('lesson/endUnit/{lesson}/{unit}',
    ['uses' => 'Lesson\LessonsController@endUnit',
        'middleware' => 'roles',
        'roles' => [\App\Role::ADMIN,\App\Role::MANAGER
        ]])
    ->name('lesson.endUnit') ;

//lesson create route
Route::get('lessons/create',
['uses' => 'Lesson\LessonsController@create',
'middleware' => 'roles',
'roles' => [\App\Role::ADMIN,\App\Role::MANAGER,\App\Role::TEACHER
]])
->name('lesson.create');

//lesson show route
Route::get('lessons/{lesson}',
['uses' => 'Lesson\LessonsController@show',
'middleware' => 'roles',
'roles' => [\App\Role::ADMIN,\App\Role::MANAGER,\App\Role::TEACHER,\App\Role::STUDENT
]])
->name('lesson.show');

//store lesson route
Route::post('lessons',
['uses' => 'Lesson\LessonsController@store',
'middleware' => 'roles',
'roles' => [\App\Role::ADMIN,\App\Role::MANAGER,\App\Role::TEACHER
]])
->name('lesson.store');

//Show The Form to Edit an lesson
Route::get('lessons/{lesson}/edit',
['uses' => 'Lesson\LessonsController@edit',
'middleware' => 'roles',
'roles' => [\App\Role::ADMIN,\App\Role::MANAGER,\App\Role::TEACHER
]])
    ->name('lesson.edit');

    //update lesson route
Route::put('lessons/{lesson}',
['uses' => 'Lesson\LessonsController@update',
'middleware' => 'roles',
'roles' => [\App\Role::ADMIN,\App\Role::MANAGER,\App\Role::TEACHER
]])
->name('lesson.update');





/*
Route::put('lessons/{lesson}',
['uses' => 'Lesson\LessonsController@updatetype',
'middleware' => 'roles',
'roles' => [\App\Role::ADMIN,\App\Role::MANAGER,\App\Role::TEACHER
]])
->name('lesson.updatetype');*/

//Delete An lesson 
Route::delete('lessons/{lesson}',
['uses' => 'Lesson\LessonsController@destroy',
'middleware' => 'roles',
'roles' => [\App\Role::ADMIN,\App\Role::MANAGER,\App\Role::TEACHER
]])
    ->name('lesson.destroy');

    //Activate A lesson 
Route::post('lessons/{lesson}/activate',
['uses' => 'Lesson\LessonsController@activate',
'middleware' => 'roles',
'roles' => [\App\Role::ADMIN,\App\Role::MANAGER,\App\Role::TEACHER
]])
->name('lesson.activate');

//Deactivate A lesson 
Route::post('lessons/{lesson}/deactivate',
['uses' => 'Lesson\LessonsController@deactivate',
'middleware' => 'roles',
'roles' => [\App\Role::ADMIN,\App\Role::MANAGER,\App\Role::TEACHER
]])
->name('lesson.deactivate');

Route::post('lessons/{lesson}/addComment',
['uses' => 'Lesson\LessonsController@addComment',
'middleware' => 'roles',
'roles' => [\App\Role::ADMIN,\App\Role::MANAGER,\App\Role::TEACHER,\App\Role::STUDENT
]])
->name('lesson.addcomment');





//update freereason route
Route::post('lessons/{lesson}/addteacher',
['uses' => 'Lesson\LessonsController@addteacher',
'middleware' => 'roles',
'roles' => [\App\Role::ADMIN,\App\Role::MANAGER
]])
->name('lesson.addteacher');

//update freereason route
Route::post('lessons/{lesson}/deleteTeacher',
['uses' => 'Lesson\LessonsController@deleteTeacher',
'middleware' => 'roles',
'roles' => [\App\Role::ADMIN,\App\Role::MANAGER
]])
->name('lesson.deleteteacher');



     //whatsappLinks index
Route::get('whatsapplinks',
['uses' => 'WhatsappLink\WhatsappLinksController@index',
'middleware' => 'roles',
'roles' => [\App\Role::ADMIN,\App\Role::MANAGER,2,3
]])
->name('whatsapplink.index');

//whatsappLink create route
Route::get('whatsapplinks/create',
['uses' => 'WhatsappLink\WhatsappLinksController@create',
'middleware' => 'roles',
'roles' => [\App\Role::ADMIN,\App\Role::MANAGER
]])
->name('whatsapplink.create');

//whatsappLink show route
Route::get('whatsapplinks/{whatsappLink}',
['uses' => 'WhatsappLink\WhatsappLinksController@show',
'middleware' => 'roles',
'roles' => [\App\Role::ADMIN,\App\Role::MANAGER,2,3
]])
->name('whatsapplink.show');

//store whatsappLink route
Route::post('whatsapplinks',
['uses' => 'WhatsappLink\WhatsappLinksController@store',
'middleware' => 'roles',
'roles' => [\App\Role::ADMIN,\App\Role::MANAGER
]])
->name('whatsapplink.store');

//Show The Form to Edit an whatsappLink
Route::get('whatsapplinks/{whatsappLink}/edit',
['uses' => 'WhatsappLink\WhatsappLinksController@edit',
'middleware' => 'roles',
'roles' => [\App\Role::ADMIN,\App\Role::MANAGER
]])
    ->name('whatsapplink.edit');

    //update whatsappLink route
Route::put('whatsapplinks/{whatsappLink}',
['uses' => 'WhatsappLink\WhatsappLinksController@update',
'middleware' => 'roles',
'roles' => [\App\Role::ADMIN,\App\Role::MANAGER
]])
->name('whatsapplink.update');

//Delete An whatsappLink 
Route::delete('whatsapplinks/{whatsappLink}',
['uses' => 'WhatsappLink\WhatsappLinksController@destroy',
'middleware' => 'roles',
'roles' => [\App\Role::ADMIN,\App\Role::MANAGER
]])
    ->name('whatsapplink.destroy');

//Ajax Dropdown
Route::get('dropdownlist/getdata/{type}','WhatsappLink\WhatsappLinksController@getData'); 


//auth routes
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
//Route::get('/home', function() {
  //  return view('admin.layouts.partials.index');})->name('home');

Route::get('/wait',function()
{
    return view('front-end.nhome.wait');
});



     //users index
     Route::get('managers',
     ['uses' => 'User\UsersController@indexManager',
'middleware' => 'roles',
'roles' => [\App\Role::ADMIN
]])
     ->name('users.indexmanager');

     //users index
     Route::get('teachers',
     ['uses' => 'User\UsersController@indexTeacher',
'middleware' => 'roles',
'roles' => [\App\Role::ADMIN,App\Role::MANAGER
]])
     ->name('users.indexteacher');

     //users index
Route::get('students',
    ['uses' => 'User\UsersController@indexStudent',
        'middleware' => 'roles',
        'roles' => [\App\Role::ADMIN,App\Role::MANAGER
        ]])
    ->name('users.indexstudent');

Route::get('students/class/{id}',
    ['uses' => 'User\UsersController@getByClass',
        'middleware' => 'roles',
        'roles' => [\App\Role::ADMIN,App\Role::MANAGER
        ]])
    ->name('users.getbyclass');
     
     //user create route
     Route::get('users/create',
     ['uses' => 'User\UsersController@create',
'middleware' => 'roles',
'roles' => [\App\Role::ADMIN,\App\Role::MANAGER
]])
     ->name('users.create');
     
     //user show route
     Route::get('users/{user}',
     ['uses' => 'User\UsersController@show',
'middleware' => 'roles',
'roles' => [\App\Role::ADMIN,\App\Role::MANAGER
]])
     ->name('users.show');
     
     //store user route
     Route::post('users',
     ['uses' => 'User\UsersController@store',
'middleware' => 'roles',
'roles' => [\App\Role::ADMIN,\App\Role::MANAGER
]])
     ->name('users.store');
     
     //Show The Form to Edit an user
     Route::get('users/{user}/edit',
     ['uses' => 'User\UsersController@edit',
'middleware' => 'roles',
'roles' => [\App\Role::ADMIN,\App\Role::MANAGER
]])
         ->name('users.edit');
     
         //update user route
     Route::put('users/{user}',
     ['uses' => 'User\UsersController@update',
'middleware' => 'roles',
'roles' => [\App\Role::ADMIN,\App\Role::MANAGER
]])
     ->name('users.update');
     
     //Delete A user 
     Route::delete('users/{user}',
     ['uses' => 'User\UsersController@destroy',
'middleware' => 'roles',
'roles' => [\App\Role::ADMIN,\App\Role::MANAGER
]])
         ->name('users.destroy');

         //Deactivate A user 
Route::post('users/{user}/deactivate',
['uses' => 'User\UsersController@deactivate',
'middleware' => 'roles',
'roles' => [\App\Role::ADMIN,\App\Role::MANAGER
]])
->name('users.deactivate');

Route::post('users/{user}/activate',
['uses' => 'User\UsersController@activate',
'middleware' => 'roles',
'roles' => [\App\Role::ADMIN,\App\Role::MANAGER
]])
->name('users.activate');


//Delete and approve A student request to class 
Route::delete('classrequests/{classrequest}',
['uses' => 'Requests\ClassRequestsController@accept',
'middleware' => 'roles',
'roles' => [\App\Role::ADMIN,\App\Role::MANAGER
]])
    ->name('classrequest.accept');


//Delete and approve A student request to class
Route::delete('classrequestsremove/{classrequest}',
    ['uses' => 'Requests\ClassRequestsController@remove',
        'middleware' => 'roles',
        'roles' => [\App\Role::ADMIN,\App\Role::MANAGER
        ]])
    ->name('classrequest.remove');

//show classes requests 
Route::get('classrequests',
['uses' => 'Requests\ClassRequestsController@index',
'middleware' => 'roles',
'roles' => [\App\Role::ADMIN,\App\Role::MANAGER
]])
    ->name('classrequest.index');
    
Route::get('myclasses',
    ['uses' => 'ClassRoom\ClassesController@myclasses',
        'middleware' => 'roles',
        'roles' => [\App\Role::ADMIN,\App\Role::MANAGER,\App\Role::TEACHER,\App\Role::STUDENT]
    ])
    ->name('class.myclasses');


Route::get('showMyClass/{id}',
    ['uses' => 'ClassRoom\ClassesController@showMyClass',
        'middleware' => 'roles',
        'roles' => [\App\Role::ADMIN,\App\Role::MANAGER,\App\Role::TEACHER,\App\Role::STUDENT]
    ])
    ->name('class.showMyClass');

//send request to class
Route::post('classrequests',
['uses' => 'Requests\ClassRequestsController@store',
'middleware' => 'roles',
'roles' => [\App\Role::STUDENT
]])
    ->name('classrequest.store');



    //Delete and approve A student request to course 
Route::delete('courseRequests/{courserequest}',
    ['uses' => 'Requests\CourseRequestsController@accept',
        'middleware' => 'roles',
        'roles' => [\App\Role::ADMIN,\App\Role::MANAGER
        ]])
    ->name('courserequest.accept');

Route::delete('courseRequestsremove/{courserequest}',
    ['uses' => 'Requests\CourseRequestsController@remove',
        'middleware' => 'roles',
        'roles' => [\App\Role::ADMIN,\App\Role::MANAGER
        ]])
    ->name('courserequest.remove');

    
//show coursees requests 
Route::get('courserequests',
['uses' => 'Requests\CourseRequestsController@index',
'middleware' => 'roles',
'roles' => [\App\Role::ADMIN,\App\Role::MANAGER
]])
    ->name('courserequest.index');

//send request to course
Route::post('courserequests',
['uses' => 'Requests\CourseRequestsController@store',
'middleware' => 'roles',
'roles' => [\App\Role::STUDENT
]])
    ->name('courserequest.store');



     //notes index
     Route::get('notes',
     ['uses' => 'Note\NotesController@index',
'middleware' => 'roles',
'roles' => [\App\Role::ADMIN,App\Role::MANAGER,2,3
]])
     ->name('notes.index');
     
     //note create route
     Route::get('notes/create',
     ['uses' => 'Note\NotesController@create',
'middleware' => 'roles',
'roles' => [\App\Role::ADMIN,\App\Role::MANAGER
]])
     ->name('notes.create');
     
     //note show route
     Route::get('notes/{note}',
     ['uses' => 'Note\NotesController@show',
'middleware' => 'roles',
'roles' => [\App\Role::ADMIN,\App\Role::MANAGER,2,3
]])
     ->name('notes.show');
     
     //store note route
     Route::post('notes',
     ['uses' => 'Note\NotesController@store',
'middleware' => 'roles',
'roles' => [\App\Role::ADMIN,\App\Role::MANAGER
]])
     ->name('notes.store');
     
     //Show The Form to Edit an note
     Route::get('notes/{note}/edit',
     ['uses' => 'Note\NotesController@edit',
'middleware' => 'roles',
'roles' => [\App\Role::ADMIN,\App\Role::MANAGER
]])
         ->name('notes.edit');
     
         //update note route
     Route::put('notes/{note}',
     ['uses' => 'Note\NotesController@update',
'middleware' => 'roles',
'roles' => [\App\Role::ADMIN,\App\Role::MANAGER
]])
     ->name('notes.update');
     
     //Delete A note 
     Route::delete('notes/{note}',
     ['uses' => 'Note\NotesController@destroy',
'middleware' => 'roles',
'roles' => [\App\Role::ADMIN,\App\Role::MANAGER
]])
         ->name('notes.destroy');

Route::get('getAllRequests',
    ['uses' => 'Requests\StatisticsController@getAllRequests',
        'middleware' => 'roles',
        'roles' => [\App\Role::ADMIN,\App\Role::MANAGER
        ]])
    ->name('requests.getAllRequests');



// Testing Routes
Route::get('/notf','TestingController@index');
Route::get('/notf/get','TestingController@get');
Route::get('/clearNotf',function()
{
    $user=\Illuminate\Support\Facades\Auth::user();
    foreach ($user->unreadNotifications as $notf)
    {
        $notf->markAsRead();
    }
    return redirect()->back();
});
