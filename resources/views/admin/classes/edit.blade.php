@extends('admin.layouts.master')

@section('content')


<div id="content">

  <div class="header-card table-cards color-grey">
    <div class="row">
      <div class="col-lg-4">
        <div class="content-header">
         <h1><small><i class="fa fa-cogs" aria-hidden="true" style="font-size:26px;"></i> إدارة {{$class->name}}</small></h1>
        </div>
      </div>
    </div>
  </div>

  <div class="row" id="table">
    <div class="card-deck">
      <div class="col-lg-6">
        <div class="card color-grey">
          <div class="card-header">تعديل البرنامج <i class="fa fa-edit" aria-hidden="true"></i></div>
            <div class="card-body">

              <form action="{{ route('class.update',['class' => $class->id]) }}" method="POST">
                {!! csrf_field() !!}
                <input type="hidden" name="_method" value="PATCH">
                <div class="form-group">
                  <label for="classRoom">اسم البرنامج:</label>
                  <input type="text" class="form-control" id="classRoom" name="name" value="{{$class->name}}" required>
                    <br>
                    <label for="order">الترتيب</label>
                    <input type="number" class="form-control" min="1" max="1000" value="{{$class->order_num}}" id="order" name="order" required placeholder="الترتيب">
                    <br>
                    <label for="stunum">عدد الطلاب </label>
                    <input type="number" class="form-control" value="{{$class->stunum}}" id="stunum" min="1" max="100000000" name="stunum" required placeholder="عدد الطلاب">
                </div>
                <div class="radioG">
                  <h5>مجانية البرنامج :</h5>
                    <div class="radio">
                      <input type="radio" name="free" value="1" {{$class->free ? 'checked' : ''}}>
                      <label>مجاني</label>
                    </div>
                    <div class="radio">
                      <input type="radio" name="free" value="0" {{!$class->free ? 'checked' : ''}} >
                      <label>غير مجاني</label>
                    </div>
                </div>
                <button type="submit" class="btn btn-success button1">تعديل</button>
                <a href="{{route('class.index')}}" class="btn btn-default button2" style="margin-right:5px">إلغاء</a>
            </form>

          </div>
        </div>
      </div>
    </div>
  </div>

</div>

@endsection
