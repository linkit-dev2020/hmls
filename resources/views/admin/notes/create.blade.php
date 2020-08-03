@extends('admin.layouts.master')

@section('content')

<div id="content">
  <div class="header-card table-cards color-grey">
    <div class="row">
      <div class="col-lg-4">
        <div class="content-header">
         <h1><small><i class="fa fa-cogs" aria-hidden="true" style="font-size:26px;"></i> إدارة الصفوف</small></h1>
        </div>
      </div>
    </div>
  </div>
  <div id="table" class="row">
    <div class="card-deck">       
      <div class="col-lg-6">
        <div class="card color-grey">
          <div class="card-body">
            <div class="card-header">إضافة ملاحظة <i class="fa fa-plus-square" aria-hidden="true"></i></div>
              
              <form action="{{route('notes.store')}}" method="POST">
                      {!! csrf_field() !!}

                <div class="form-group">

                    <div class="radioG">
                        <h5> النوع :</h5>
                        <div class="radio">
                            <input type="radio" name="type" value="public" checked onclick="hideClasses()">
                            <label>عامة</label>
                        </div>
                        <div class="radio">
                            <input type="radio" name="type" value="private" onclick="showClasses()">
                            <label> خاصة</label>
                        </div>
                    </div>

                    <script>
                        function showClasses()
                        {
                            document.getElementById("class_select").style.display='block';
                        }
                        function hideClasses()
                        {
                            document.getElementById('class_select').style.display='none';
                        }
                    </script>
                    <div id="class_select" style="display:none">
                      <label for="class_id" ><h5>الصف الدراسي:</h5></label>
                      <select name="class_id" id="class_id" class="form-control">
                      @foreach($classes as $class)
                      <option value="{{$class->id}}">{{$class->name}}</option>
                      @endforeach
                      </select>
                    </div>
                  @if($errors->has('class_id'))
                  <span class="text-danger">* {{$errors->first('class_id')}}</span>
                  @endif
                </div>

                <div class="form-group">
                 <label for="class_id"><h5>نص الملاحظة:</h5></label>
                 <input type="text" class="form-control" name="content" >
                </div>
                <button type="submit" class="btn btn-success button1">إضافة</button>
                <a href="{{route('notes.index')}}" class="btn btn-default button2" style="margin-right:5px">إلغاء</a>
              </form>
              
          </div>
        </div>
      </div>      
    </div>
  </div>
</div>

@endsection
