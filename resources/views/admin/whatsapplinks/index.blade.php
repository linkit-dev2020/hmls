@extends('admin.layouts.master')

@section('content')

<div id="content">

  <div class="header-card table-cards color-grey">
    <div class="row">
      <div class="col-lg-6">
        <div class="content-header">
         <h1><small><i class="fa fa-cogs" aria-hidden="true" style="font-size:26px;"></i> إدارة روابط تطبيق الواتس أب </small></h1>
        </div>
      </div>
      <div class="col-lg-2">
        <a href="{{route('whatsapplink.create')}}" class="btn btn-success custom-but BP" >إضافة رابط <div><i class="fa fa-plus-square" aria-hidden="true"></i></div></a>
      </div>
    </div>
  </div>
  
  <div id="table" class="row">
    <div class="col-lg-10">
      <div class="card table-cards color-grey">
        <div class="card-body">
          <div class="content-header">
            <h2>
              <small><i class="fa fa-graduation-cap" aria-hidden="true" style="font-size:24px;"></i> روابط التطبيق</small>
            </h2>
          </div>
          <table class="table table-bordered table-hover table-width">
            <thead>
              <tr> 
                <th>روابط التطبيق</th>
                <th>النوع</th>
                <th>التابع ل</th>
                <th>الترتيب</th>
                <th>تعديل</th>
                <th>حذف</th>
              </tr>
            </thead>
            <tbody>
              @foreach($whatsappLinks as $whatsappLink)
              <tr>
                <td>{{$whatsappLink->url}}</td>
                @if($whatsappLink->type === 'lessons')
                <td>دروس</td>
                @elseif($whatsappLink->type === 'homeworks')
                <td>وظائف</td>
                @else
                <td></td>
                @endif
                @if($whatsappLink->linkable_type === 'App\ClassRoom')
                      @if($whatsappLink->linkable!=null)
                <td>{{$whatsappLink->linkable->name}}</td>
                      @else
                          <td></td>
                      @endif
                @elseif($whatsappLink->linkable_type === 'App\Course')
                    @if($whatsappLink->linkable!=null)
                <td>{{$whatsappLink->linkable->title}}</td>
                        @else
                        <td></td>

                    @endif
                @else
                <td></td>
                @endif
                <td>{{$whatsappLink->order}}</td>
                <td>
                  <div class="operations update">
                    <a href="{{ route('whatsapplink.edit', $whatsappLink) }}"><i class="fa fa-edit" style="font-size:18px;color:#00c0ef"></i></a>
                  </div>
                </td>
                <td>
                  <div class="operations delete">
                    <form action="{{ route('whatsapplink.destroy',['class' => $whatsappLink->id]) }}" method="POST" id="deleteForm">
                      {!! csrf_field() !!}
                      <input type="hidden" name="_method" value="DELETE">    
                      <button id="{{$whatsappLink->id}}" class=" btn-xs delete-button" style="display:none;"></button>
                      <a herf="javascript:;" class="" onclick="$('#{{$whatsappLink->id}}').click();" >
                        <i class="fa fa-trash" style="font-size:18px;color:#dd4b39"></i>
                      </a>
                    </form>       
                  </div>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

</div>

@endsection
