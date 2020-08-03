@extends('admin.layouts.master')

@section('content')

<div id="content">
  <div class="header-card table-cards color-grey">
    <div class="row">
      <div class="col-lg-4">
        <div class="content-header">
         <h1><small><i class="fa fa-cogs" aria-hidden="true" style="font-size:26px;"></i> إدارة إعفاءات الطلاب</small></h1>
        </div>
      </div>
    </div>
  </div>
  <div id="table" class="row">
    <div class="card-deck">       
      <div class="col-lg-6">
        <div class="card color-grey">
          <div class="card-body">
            <div class="card-header">إضافة إعفاء <i class="fa fa-plus-square" aria-hidden="true"></i></div>
              
              <form action="{{route('freereason.store')}}" method="POST">
                      {!! csrf_field() !!}
                <div class="form-group">
                  <label for="reason"><h5>نص سبب الأعفاء :</h5></label>
                  <textarea class="form-control" id="reason" name="text" rows="3" required placeholder="اكتب سبب الأعفاء"></textarea> 
                </div>
                <button type="submit" class="btn btn-success button1">إضافة</button>
                <a href="{{URL::previous()}}" class="btn btn-default" style="margin-right:5px">إلغاء</a>
              </form>
              
          </div>
        </div>
      </div>      
    </div>
  </div>
</div>

@endsection