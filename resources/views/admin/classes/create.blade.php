@extends('admin.layouts.master')

@section('content')

<div id="content">
  <div class="header-card table-cards color-grey">
    <div class="row">
      <div class="col-lg-4">
        <div class="content-header">
         <h1><small><i class="fa fa-cogs" aria-hidden="true" style="font-size:26px;"></i> إدارة البرامج</small></h1>
        </div>
      </div>
    </div>
  </div>
  <div id="table" class="row">
    <div class="card-deck">
      <div class="col-lg-12">
        <div class="card color-grey">
          <div class="card-body">
            <div class="card-header">إضافة صف <i class="fa fa-plus-square" aria-hidden="true"></i></div>

              <form action="{{route('class.store')}}" method="POST">
                      {!! csrf_field() !!}
                <div class="form-group">
                  <label for="classRoom"><h5>البرنامج الدراسي:</h5></label>
                  <input type="text" class="form-control" id="classRoom" name="name" required placeholder="اسم البرنامج الجديد">
                  @if($errors->has('name'))
                  <span class="text-danger">* {{$errors->first('name')}}</span>
                  @endif
                    <br>
                    <label for="order">الترتيب</label>
                    <input type="number" class="form-control" min="1" max="1000" id="order" name="order" required placeholder="الترتيب">
                    <br>
                    <label for="stunum">عدد الطلاب </label>
                    <input type="number" class="form-control" id="stunum" min="1" max="100000000" name="stunum" required placeholder="عدد الطلاب">

                </div>
                <div class="radioG">
                  <h5>مجانية البرنامج :</h5>
                  <div class="radio">
                    <input type="radio" name="free" value="1" checked>
                    <label>مجاني</label>
                  </div>
                  <div class="radio">
                    <input type="radio" name="free" value="0">
                    <label>غير مجاني</label>
                  </div>
                </div>
                <button type="submit" class="btn btn-success button1">إضافة</button>
                <a href="{{route('class.index')}}" class="btn btn-default button2" style="margin-right:5px">إلغاء</a>
              </form>

          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection
