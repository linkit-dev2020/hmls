@extends('admin.layouts.master')

@section('content')


<div id="content">

  <div class="header-card table-cards color-grey">
    <div class="row">
      <div class="col-lg-4">
        <div class="content-header">
         <h1><small><i class="fa fa-cogs" aria-hidden="true" style="font-size:26px;"></i> إدارة الوحدات الدراسية</small></h1>
        </div>
      </div>
    </div>
  </div>

  <div class="row" id="table">
    <div class="card-deck">
      <div class="col-lg-12 col-sm-12 col-md-12">
        <div class="card color-grey">
          <div class="card-header">تعديل الوحدة الدراسية <i class="fa fa-edit" aria-hidden="true"></i></div>
            <div class="card-body">

            <form action="{{route('unit.update', $unit)}}" method="POST">
                      {!! csrf_field() !!}
                      {!! method_field('PUT') !!}
                <div class="form-group">
                  <label for="unit"><h5>الوحدة الدراسية :</h5></label>
                  <input type="text" class="form-control" id="unit" name="title" required value="{{$unit->title}}">
                </div>
                <div class="form-group">

                        <label for="unit"><h5>الترتيب</h5></label>

                <input type="number" min="1" max="1500" class="form-control" id="unit" name="order_num" required value="{{$unit->order_num}}">

                </div>
                <div class="form-group">

                    <select class="form-control form-control-select mt-3" id="class_id" name="class" onchange="fillSubjects()">
                        @foreach($classes as $class)
                            <option value="{{$class->id}}" @if($class->id==$unit->subject->class->id) selected @endif>{{$class->name}}</option>
                        @endforeach
                    </select>
                    <br>
                    <script>
                        var ch=false;
                        @if(!\Illuminate\Support\Facades\Auth::user()->hasAnyRole([0,1]))
                            ch=true;
                        @endif
                        fillSubjects();
                        function  fillSubjects() {
                            var cid=document.getElementById('class_id').value;
                            console.log(cid);
                            var url="/api/getSubjects/"+cid;;
                            if(ch)
                                url="/api/getSubjects/"+cid+"/{{\Illuminate\Support\Facades\Auth::user()->id}}";
                            $.ajax({
                                url:url,
                                success:function(e)
                                {
                                    let t='';
                                    $('#subject_id').html(t+e);
                                    $('#subject_id').css('display','block');
                                    $('.taSub').css('display','block');
                                    console.log(e);
                                    $("#sub{{$unit->subject->id}}").attr('selected','selected');
                                }
                            });
                        }
                    </script>
                  <label for="subject">المادة الدراسية : {{$unit->subject->name }}  </label>
                  <select class="form-control form-control-select mt-3" id="subject_id" name="subject_id">

                  </select>
                </div>
                <div class="radioG">
                  <h5>تفعيل الوحدة الدراسية :</h5>
                  <div class="radio">
                    <input type="radio" name="active" id="active" value="1" {{$unit->active ? "checked" : ""}}>
                    <label for="active">مفعلة</label>
                  </div>
                  <div class="radio">
                    <input type="radio" name="active" id="deactive" value="0" {{!$unit->active ? "checked" : ""}}>
                    <label for="deactive">غير مفعلة</label>
                  </div>
                </div>

                <button type="submit" class="btn btn-success button1">تعديل</button>

                <a href="{{route('unit.index')}}" class="btn btn-default" style="margin-right:5px">إلغاء</a>
              </form>

          </div>
        </div>
      </div>
    </div>
  </div>

</div>

@endsection
