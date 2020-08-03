@extends('admin.layouts.master')

@section('content')

<div id="content">
      <div class="content-header">
        <h1>
            <small>إدارة الوحدات الدرسيّة</small>
            
        </h1>
      </div>


        <div class="row">
          <div class="card-deck">
            
            <div class="col-lg-6">
              <div class="card color-grey">
                <div class="card-body">
                  <div class="card-header">اختر صف لإضافة وحدة درسية </div>
                
                    <div>
                    <div class="form-group">
                      <label for="classRoom"><h5>الصف:</h5></label>
                      
                        <select class="form-control" id="classRoom" name="class_id">
                          <option selected>--اختر الصف--</option>
                            @foreach($classes as $class)
                        <option value="{{$class->id}}">{{$class->name}}</option>
                             
                            @endforeach
                        </select>
                    </div>
                   
                    <button type="submit" class="btn btn-success" id="selectClass">اختر الصف الدراسي</button>
                  <a href="{{route('unit.index')}}" class="btn btn-default" style="margin-right:5px">إلغاء</a>

                </div>
                </div>
              </div>
            </div>
            
          </div>
        </div>

    </div>

@endsection


@section('scripts')

    <script>
        var selectButton = document.getElementById('selectClass'); 

selectButton.addEventListener('click', function(){
    
    var classSelect = document.getElementById('classRoom');

    var id = classSelect.selectedIndex ; 

    window.location = '/classes/' + id + '/units/create'; 


});
    </script>
@endsection