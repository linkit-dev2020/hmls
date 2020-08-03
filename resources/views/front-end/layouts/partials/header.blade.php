<nav class="navbar navbar-expand-md navbar-light bg-light">
  
  <div class="container">

    <div class="col-lg-5 col-md-5 col-sm-8">
      <a class="navbar-brand pull-right" href="/">
         <!--   <div style="background-color:#fff;border-radius:50%;width:160px;height:160px;">
          <img id="img-brand" src="{{asset('imgs/logo1.png')}}" width="130px">
              </div>
       <div id="brand-label">
          <h2><strong><span class="main-red">تركي </span>هوم</strong></h2>
          <h6><span class="main-red" style="padding-left: 15px;">Turkey </span>&nbsp;Home</h6>
        </div>-->
             <div style="background-color:#fff;border-radius:50%;
             width:125px;height:125px;">
        <img src="{{asset('imgs/logo1.png')}}" width="115px;">

      </div>
      </a>
    </div>

    <div class="col-lg-7 col-md-7 col-sm-4" style="padding: 0px;">
      <button class="navbar-toggler" type="button" data-toggler="collapse" data-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item" style="list-style-position:inside;
    border: 2px solid white;;  border-radius: 25px; padding:2px; background-color:#f8f9fa;">
            <a class="nav-link" href="/">الرئيسية</a>
          </li>
        <li class="nav-item" style="list-style-position:inside;
    border: 2px solid white;;  border-radius: 25px; padding:2px;">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              الصفوف
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
              @foreach($classes as $class)
           
          
             
               @if ( $class->free == 0 )
               <a class="dropdown-item" href="#"> {{$class->name}}  ,  ( غير مجاني   ) </a>
               @else
                           <a class="dropdown-item" href="{{ route('class.show', $class) }}">     {{$class->name}}  ,  ( مجاني  ) </a>
           
               @endif
 
 </a>
              @endforeach
            </div>
          </li>
         <li class="nav-item" style="list-style-position:inside;
    border: 2px solid white;;  border-radius: 25px; padding:2px;">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              الدورات
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            @foreach($courses as $course)
              <a class="dropdown-item" href="#">
             {{$course->title}} (
             @if ( $course->active == 0 ) غير مفعل @else مغعل @endif )
         
              </a> 
              <div class="dropdown-divider"></div>
            @endforeach
            </div>
          </li>
         <li class="nav-item" style="list-style-position:inside;
    border: 2px solid white;;  border-radius: 25px; padding:2px;">
            <a class="nav-link" href="{{ route('AboutUs') }}">عن المدرسة</a>
          </li>
        <li class="nav-item" style="list-style-position:inside;
    border: 2px solid white;;  border-radius: 25px; padding:2px;">
            <a class="nav-link" href="{{ route('contactUs') }}">تواصل معنا</a>
          </li>
        </ul>
      </div>
    </div>
    
    <style>
        ul.dropdown{
            width: 270px !important;
            text-align: right !important;
        }
    </style>
   
  </div>
</nav>