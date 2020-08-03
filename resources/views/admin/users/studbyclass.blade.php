@foreach($students->sortByDesc('created_at') as $student)
    <tr class="">
        <td>{{$student->username}}</td>
        <td class="operations">
            @if($student->active)
                <form action="{{ route('users.deactivate', $student) }}" method="POST" id="activateForm">
                    {!! csrf_field() !!}
                    <button id="{{$student->id+1}}" class=" btn-xs delete-button" style="display:none;"></button>
                    <a herf="javascript:;" class="" onclick="$('#{{$student->id+1}}').click();" >
                        <i class="fa fa-check-circle" aria-hidden="true" style="font-size:18px;color:#5cb85c;cursor: pointer;"></i>
                    </a>
                </form>
            @else
                <form action="{{ route('users.activate', $student) }}" method="POST" id="activateForm">
                    {!! csrf_field() !!}
                    <button id="{{$student->id}}" class=" btn-xs delete-button" style="display:none;"></button>
                    <a herf="javascript:;" class="" onclick="$('#{{$student->id}}').click();" >
                        <i class="fa fa-times-circle" aria-hidden="true" style="font-size:18px;color:#dd4b39;cursor: pointer;"></i>
                    </a>
                </form>
            @endif
        </td>
        <td>{{$student->tc}}</td>

        <td>{{$student->phone}}</td>
        <td>{{$student->created_at}}</td>
        <td>
            <div class="operations show">
                <a href="{{ route('users.show', $student) }}"><i class="fa fa-eye" style="font-size:18px;color:#5cb85c"></i></a>
            </div>
        </td>
        <td>
            <div class="operations update">
                <a href="{{ route('users.edit', $student) }}"><i class="fa fa-edit" style="font-size:18px;color:#00c0ef"></i></a>
            </div>
        </td>
        <td>
            <div class="operations delete">
                <form action="{{ route('users.destroy',['user' => $student->id]) }}" method="POST" id="deleteForm">
                    {!! csrf_field() !!}
                    <input type="hidden" name="_method" value="DELETE">
                    <button id="del{{$student->id}}" class=" btn-xs delete-button" style="display:none;"></button>
                    <a herf="javascript:;" class="" onclick="$('#del{{$student->id}}').click();" >
                        <i class="fa fa-trash" style="font-size:18px;color:#dd4b39"></i>
                    </a>
                </form>
            </div>
        </td>
    </tr>
@endforeach
