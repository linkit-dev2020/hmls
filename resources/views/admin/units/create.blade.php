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

  <div id="table" class="row">

    <div class="card-deck">

      <div class="col-lg-12 col-md-12 col-sm-12">

        <div class="card color-grey">

          <div class="card-body">

            <div class="card-header">إضافة وحدة دراسية <i class="fa fa-plus-square" aria-hidden="true"></i></div>



              <form action="{{route('unit.store')}}" method="POST">

                      {!! csrf_field() !!}

                <div class="form-group">

                  <label for="unit"><h5>الوحدة الدراسية :</h5></label>

                  <input type="text" class="form-control" id="unit" name="title" required placeholder="اسم الوحدة الجديدة">

                </div>

                <div class="form-group">

                        <label for="unit"><h5>الترتيب</h5></label>

                        <input type="number" min="1" max="1500" class="form-control" id="unit" name="order_num" required placeholder="الترتيب">

                </div>


                <div class="form-group">
                    <label for="">الصف: </label>
                   <select class="form-control form-control-select mt-3" id="class_id" name="class" onchange="fillSubjects()">
                       @foreach($classes as $class)
                            <option value="{{$class->id}}" selected>{{$class->name}}</option>
                       @endforeach
                   </select>
                    <br>
                  <label for="subject">المادة الدراسية :</label>
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


                                }
                            });
                        }
                    </script>

                  <select class="form-control form-control-select mt-3" id="subject_id" name="subject_id">

                    <option selected>-- اختر المادة الدراسية --</option>

                  </select>
                </div>

                <div class="radioG">

                  <h5>تفعيل الوحدة الدراسية :</h5>

                  <div class="radio">

                    <input type="radio" name="active" id="active" value="1" checked>

                    <label for="active">مفعلة</label>

                  </div>

                  <div class="radio">

                    <input type="radio" name="active" id="deactive" value="0">

                    <label for="deactive">غير مفعلة</label>

                  </div>

                </div>

                <button type="submit" class="btn btn-success button1">إضافة</button>

                <a href="{{route('unit.index')}}" class="btn btn-default" style="margin-right:5px">إلغاء</a>

              </form>



          </div>

        </div>

      </div>

    </div>

  </div>

</div>



@endsection
