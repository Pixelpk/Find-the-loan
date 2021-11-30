<div class="table-responsive">
    <table class="table table-bordered table-striped table-hover dataTable js-exportable">
        <thead>
        <tr>
            <th>Name</th>
            <th>Role</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Registered at</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach($users as $user)
            <tr>
                <td>{{ $user->first_name." ".$user->last_name }}</td>
                <td>{{ \App\Models\Helper::getRole($user->role_id) }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->phone }}</td>
                <td>{{ $user->created_at }}</td>
                <td>{{ \App\Models\Helper::getStatus($user->status) }}</td>
                <td class="actions">
                    @if($user->status == 0)
                        <a href="{{ route('change-user-status',['user_id'=>$user->id,'status'=>'1']) }}" msg="Are you sure to activate this user?" class="btn btn-sm btn-icon btn-pure btn-default on-default m-r-5 change_status" data-toggle="tooltip" data-original-title="Activate">
                            <i class="icon-like" aria-hidden="true"></i>
                        </a>
                    @elseif($user->status == 1)
                        <a href="{{ route('change-user-status',['user_id'=>$user->id,'status'=>'0']) }}" msg="Are you sure to deactivate this user?" class="btn btn-sm btn-icon btn-pure btn-default on-editing change_status" data-toggle="tooltip" data-original-title="Deactivate">
                            <i class="icon-close" aria-hidden="true"></i>
                        </a>
                    @endif
                    <a href="{{ route('change-user-status',['user_id'=>$user->id,'status'=>'2']) }}" msg="Are you sure to delete this user?" class="btn btn-sm btn-icon btn-pure btn-default on-default change_status" data-toggle="tooltip" data-original-title="Delete">
                        <i class="icon-trash" aria-hidden="true"></i>
                    </a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <div class="pagination">
        {!! $users->links('pagination::bootstrap-4') !!}
    </div>

</div>
