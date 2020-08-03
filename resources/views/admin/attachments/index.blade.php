@extends('admin.layouts.master')

@section('content')

<div id="content">

  <div class="header-card table-cards color-grey">
    <div class="row">
      <div class="col-lg-4">
        <div class="content-header">
         <h1><small><i class="fa fa-cogs" aria-hidden="true" style="font-size:26px;"></i> إدارة المرفقات</small></h1>
        </div>
      </div>
      <div class="col-lg-2">
        <a href="{{route('attachment.create')}}" class="btn btn-success myhover BP" role="button">إضافة مرفق <div><i class="material-icons" style="font-size:16px">add_box</i></div></a>
      </div>
    </div>
  </div>
  
  <div id="table" class="row">
    <div class="col-lg-8 col-m-u">
      <div class="card table-cards color-grey">
        <div class="card-body">
          <div class="content-header">
            <h2>
              <small><i class="fa fa-picture-o" aria-hidden="true" style="font-size:24px;"></i> المرفقات</small>
            </h2>
          </div>
          <table class="table table-bordered table-hover table-width">
            <thead>
              <tr> 
                <th>اسم الملف</th>
                <th>النوع</th>
                <th>نوع التبعية</th>
                <th>عرض</th>
                <th>تعديل</th>
                <th>حذف</th>
              </tr>
            </thead>
            <tbody>
              @foreach($attachments as $attachment)
              <tr>
                <td>{{ $attachment->name }}</td>
                @if($attachment->type === 'file')
                <td>ملف</td>
                @elseif($attachment->type === 'image')
                <td>صورة</td>
                @else
                  <td></td>
                @endif
                @if($attachment->attachmentable_type === 'App\Lesson')
                <td>لدرس</td>
                @elseif($attachment->attachmentable_type === 'App\Deneme')
                <td>لدينيمي</td>
                @elseif($attachment->attachmentable_type === 'App\Test' || $attachment->attachmentable_type === 'App\test')
                <td>للأختبار</td>
                  @else
                  <td></td>
                @endif
                <td>
                  <div class="operations update">
                    <a href="{{ route('attachment.show', $attachment) }}"><i class="fa fa-eye" style="font-size:18px;color:#5cb85c"></i></a>
                  </div>
                </td>
                <td>
                  <div class="operations update">
                    <a href="{{ route('attachment.edit', $attachment) }}"><i class="fa fa-edit" style="font-size:18px;color:#00c0ef"></i></a>
                  </div>
                </td>
                <td>
                  <div class="operations delete">
                    <form action="{{ route('attachment.destroy',$attachment) }}" method="POST">
                      {!! csrf_field() !!}
                      <input type="hidden" name="_method" value="DELETE">    
                      <button id="{{$attachment->id}}" class=" btn-xs delete-button" style="display:none;">
                        <i class="fa fa-trash" style="font-size:18px;color:#dd4b39"></i>
                      </button>
                      <a herf="javascript:;" onclick="$('#{{$attachment->id}}').click();" >
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