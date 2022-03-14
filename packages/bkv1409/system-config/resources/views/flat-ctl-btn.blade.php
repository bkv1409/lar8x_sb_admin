@if($systemConfig->isEmailGroup())
    <a class="btn btn-default show-config-ctl me-2 btn-sm"
       data-id="{{$id}}" href="{{route('admin.system-configs.show', $id)}}"
    ><i class="fa fa-eye"></i> Show</a>
@else
    <a class="btn btn-success edit-config-ctl me-2 btn-sm"
       data-id="{{$id}}" href="{{route('admin.system-configs.edit', $id)}}"
    ><i class="fa fa-edit"></i> Edit</a>
    <a class="btn btn-info change-config-ctl me-2 btn-sm" data-id="{{$id}}"
       href="{{route('admin.system-configs.changeStatus', $id)}}"
    ><i class="fas fa-recycle"></i> Ch. Status</a>
@endif
<form action="{{route('admin.system-configs.destroy', $id)}}" method="POST" class="form-inline me-2 btn-sm">
    @method('DELETE')
    @csrf
    <button class="btn btn-danger delete-config-ctl btn-sm" data-id="{{$id}}" onclick="return confirmDelete('{{$id}}');">
        <i class="fa fa-trash"></i> Xóa
    </button>
</form>
