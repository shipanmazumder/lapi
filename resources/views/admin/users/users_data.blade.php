@isset($users)
    @foreach($users as $key=>$value)
        <tr>
            <td class="text-center">{{$sl_counter++}}</td>
            <td >{{$value->name}}</td>
            <td >{{$value->email}}</td>
            <td >{{$value->role->name}}</td>
            <td >{{($value->is_ban==1)?"Approved":"Ban"}}</td>
            <td class="text-center" >
                @if(\App\Helpers\Permissions::hasPermission("users","is_edit"))
                <a  href="{{url("admin/user-edit/".$value->id)}}"  class="text-info btn btn-info btn-xs  waves-effect tooltips" data-placement="top" data-toggle="tooltip" data-original-title="Edit" id=""><i class="fa fa-edit"></i></a>
                @endif
                @if(\App\Helpers\Permissions::hasPermission("users","is_ban"))
                    <a onclick="return confirm('Are You Sure?')" href="{{url("admin/user-ban/".$value->id)}}" title="{{($value->is_ban==1)?"Approved":"Ban"}}" class="btn btn-{{($value->is_ban==1)?"success":"danger"}}   btn-xs  waves-effect tooltips" data-placement="top" data-toggle="tooltip" data-original-title="View" id=""><i class="fa fa-check-circle"></i></a>
                @endif
                @if(\App\Helpers\Permissions::hasPermission("users","is_delete"))
                    <a  href="{{url("admin/user-delete/".$value->id)}}" onclick="return confirm('Are You Sure?')" title="Login" class="btn btn-info   btn-xs  waves-effect tooltips" data-placement="top" data-toggle="tooltip" data-original-title="View" id=""><i class="fa fa-trash"></i></a>
                @endif
            </td>
        </tr>
    @endforeach
     <tr>
        <td colspan="6" class="text-center">{{$users->links()}}</td>
    </tr>
@endisset
