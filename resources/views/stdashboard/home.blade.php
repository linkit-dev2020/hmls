@extends('stdashboard.master')
@section('title')
    @if(Auth::check())
        حسابي
    @else
        LMS
    @endif
@endsection

@section('marq')
        @php
            $notes=\App\Note::where('type','public')->get();

        @endphp

        @foreach($notes as $note)
            {{$note->content}} &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        @endforeach
@endsection
@section('content')

    <div class="language " id="class">
        <div class="container">
                <div class="row">
                    <div class="col-12">
                        @if ( session('success') )

                            <div class = "alert alert-success">

                                {{session('success')}}

                            </div>

                        @endif

                        @if ( session('error') )

                            <div class = "alert alert-danger">

                                {{session('error')}}

                            </div>

                        @endif
                    </div>
                </div>
                <div class="row" id="#myclasses">

                <div class="col">
                    @if($check)
                    <div class="language_title wow flipInX"> برامجي</div>
                    @else
                    <div class="language_title wow flipInX">البرامج الدراسية</div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="courses">
        <div class="container">
            <div class="row courses_row">
            @foreach($classes as $class)


                <!-- Course -->
                    <div class="col-lg-4 course_col">
                        <div class="course wow fadeInRight">
                            <div class="course_image"><img src="{{asset('images/course_4.jpg')}}" alt=""></div>
                            <div class="course_body">
                                <div class="course_title"><a href="/stdsh/class/{{$class->id}}">{{$class->name}}</a></div>
                            </div>
                            <div class="course_footer d-flex flex-row align-items-center justify-content-start">
                                <div class="course_students"><i class="fa fa-user" aria-hidden="true"></i><span>{{$class->students()->count()}}</span></div>&nbsp;&nbsp;&nbsp;
                                <!--<div class="course_rating ml-auto"><i class="fa fa-star" aria-hidden="true"></i><span>4,5</span></div>
                                <div class="course_mark course_free trans_200"><a href="#">مجاني</a></div> -->
                                <?php
                                    $cid=$class->id;
                                    $sid=\Illuminate\Support\Facades\Auth::user()->id;
                                    $match=['student_id'=>$sid,'class_id'=>$cid];
                                    $a=\App\ClassStudent::where('student_id',$sid)->where('class_id',$cid)->first();
                                    $new=true;
                                    if($a!==null&&$a->count()>0)
                                    {
                                        $new=false;
                                    }

                                ?>
                                @if($new)
                                    <span  class="badge badge-primary" style="cursor: pointer" onclick="showModal({{$class->id}})" > طلب انضمام</span>
                                    <form id="request{{$class->id}}" method="post" action="/classrequests">
                                        @csrf
                                        <input type="hidden" name="class_id" value="{{$class->id}}">
                                        <input type="hidden" name="mark" id="mark"/>
                                    </form>
                                @else
                                    <div class="badge badge-pill">منضم</div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="modal" tabindex="-1" id="quizmodal" role="dialog">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">اختبار القبول</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form id="questions">

                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-primary" onclick="submitAns()">تقديم</button>
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">الغاء</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Course -->
                @endforeach

            <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">طلب انضمام</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                يرجى التواصل مع الادارة للانضمام الى الصف أو الدورة المحددين على الرقم 0999999999
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">إغلاق</button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="language" id="courses">
        <div class="container">
            <div class="row">
                <div class="col">
                    @if($check)
                    <div class="language_title wow bounceIn">دوراتي</div>
                    @else
                    <div class="language_title wow bounceIn">دوراتنا</div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="courses">
        <div class="container">
            <div class="row courses_row">
            @foreach($courses as $class)

                <!-- Course -->
                    <div class="col-lg-4 course_col">
                        <div class="course wow fadeInRight">
                            <div class="course_image"><img src="{{asset('images/course_4.jpg')}}" alt=""></div>
                            <div class="course_body">
                                <?php
                                $cid=$class->id;
                                $sid=\Illuminate\Support\Facades\Auth::user()->id;
                                $match=['student_id'=>$sid,'class_id'=>$cid];
                                $a=\App\CourseStudent::where('student_id',$sid)->where('course_id',$cid)->first();

                                $new=true;

                                if($a!==null&&$a->count()>0)
                                {
                                    $new=false;
                                }

                                ?>
                                @if($check || \Illuminate\Support\Facades\Auth::user()->hasAnyRole([0,1]))
                                <div class="course_title"><a href="/stdsh/show/course/{{$class->id}}">{{$class->title}}</a></div>
                                @elseif(!$new)
                                <div class="course_title"><a href="/stdsh/show/course/{{$class->id}}">{{$class->title}}</a></div>
								@else
								<div class="course_title"><a href="#">{{$class->title}}</a></div>
                                @endif
                            </div>
                            <div class="course_footer d-flex flex-row align-items-center justify-content-start">
                                <div class="course_students"><i class="fa fa-user" aria-hidden="true"></i><span>{{$class->stunum}}</span></div> &nbsp;&nbsp;
                                <!-- <div class="course_rating ml-auto"><i class="fa fa-star" aria-hidden="true"></i><span>4,5</span></div> -->
                                @if($new)
                                       <span  class="badge badge-primary" style="cursor: pointer"  data-toggle="modal" data-target="#exampleModal" > طلب انضمام</span>
                                @else
                                    <div class="badge badge-pill">منضم</div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <!-- Course -->
                @endforeach
            </div>
        </div>
    </div>
@endsection
<script>
    let class_id = 0;
    function showModal(id) {
        class_id = id;
        $("#quizmodal").modal();
        getQuizz(id);
        return "w";
    }
     function getQuizz(id) {
        $.ajax({
           url: '/getQuizz/'+id,
           method:'get',
           data: {
               __token: '{{csrf_token()}}',
           },
            success:function (data) {
               console.log(data);
               parseQuizz(data);
            }
        });
    }
    let qst = null;
    let total = 0;
    function parseQuizz(data) {
        let q = JSON.parse(data);
        total = q.length;
        qst = q;
        for(let i = 0 ; i<q.length;i++) {
            addQuestion(i,q[i].question,q[i].correct,q[i].wrongOne,q[i].wrongTwo);
        }
    }
    function shuffle(array) {
        array.sort(() => Math.random() - 0.5);
    }
    function addQuestion(id,q,a1,a2,a3) {
        let form = document.getElementById('questions');
        let html = '<h4>'+q+'</h4>';
        let arr = [a1,a2,a3];
        let ord = [0,1,2];
        shuffle(ord);
        let ans = [arr[ord[0]],arr[ord[1]],arr[ord[2]]];
        html+= getRadio(id,ans[0],(ans[0]==a1?'correct':''));
        html+= getRadio(id,ans[1],(ans[1]==a1?'correct':''));
        html+= getRadio(id,ans[2],(ans[2]==a1?'correct':''));
        form.innerHTML+=html;
        console.log(ans);
    }
    function getRadio(id,cont,correct) {
        return cont+ "<input class='"+correct+"' type='radio' name='q"+id+"'><br>";
    }
    function submitAns() {
        let form = document.getElementById("request"+class_id);
        let mark = document.getElementById("mark");
        let correct = document.getElementsByClassName("correct");
        console.log(correct);
        let ctotal = 0;
        for(let i = 0; i<correct.length;i++)
        {
            if(correct[i].checked) {
                console.log("correct");
                ctotal++;
            }
        }
        console.log(ctotal);
        mark.value = ctotal*100.0/total;
        document.getElementById("request"+class_id).submit();
    }

</script>
