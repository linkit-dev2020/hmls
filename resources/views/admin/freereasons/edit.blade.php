@extends('admin.layouts.master')

@section('content')


<div id="content">

  <div class="header-card table-cards color-grey">
    <div class="row">
      <div class="col-lg-4">
        <div class="content-header">
         <h1><small><i class="fa fa-cogs" aria-hidden="true" style="font-size:26px;"></i>إدارة إعفاءات الطلاب</small></h1>
        </div>
      </div> 
    </div>
  </div>

  <div class="row" id="table">
    <div class="card-deck">
      <div class="col-lg-6">
        <div class="card color-grey">
          <div class="card-header">تعديل الإعفاءات <i class="fa fa-edit" aria-hidden="true"></i></div>
            <div class="card-body">

              <form action="{{route('freereason.update', ['freeReason' => $freeReason])}}" method="POST">
                      {!! csrf_field() !!}
                      {!! method_field('PUT') !!}
                <div class="form-group">
                  <label for="reason"><h5>نص سبب الأعفاء :</h5></label>
                  <textarea class="form-control" id="reason" name="text" rows="3" required>{{$freeReason->text}}</textarea> 
                </div>
                <button type="submit" class="btn btn-success button1">تعديل</button>
                <a href="{{route('freereason.index')}}" class="btn btn-default" style="margin-right:5px">إلغاء</a>
              </form>

          </div>
        </div>
      </div> 
    </div>
  </div>

</div>

@endsection