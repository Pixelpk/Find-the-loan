@extends("admin.layouts.master")
@section('content')
    <div class="content-page">
        <div class="content">
            <div class="container-fluid">
                <div class="page-title-box">

                    <div class="row align-items-center ">
                        <div class="col-md-12">
                            <div class="page-title-box">
                                <h4 class="page-title">All Users</h4>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end page-title -->

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="table-rep-plugin">
                                    <div class="table-responsive b-0" data-pattern="priority-columns">
                                        <table id="tech-companies-1" class="table  table-striped">
                                            <thead>
                                            <tr>
                                                <th>Image</th>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Phone</th>
                                                <th>Status</th>
                                                <th>Actions</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($users as $user)
                                                <tr>
                                                    <td>
                                                        @if (isset($user->photo) && file_exists(base_path('uploads/userImages/'.$user->photo)) && $user->photo != '')
                                                            <img class="justify-content-center resize-img" src="{{ url('uploads/userImages/'.$user->photo) }}"/>
                                                        @else
                                                            <img class="justify-content-center resize-img" src="{{asset('assets/images/no_image.png')}}" />
                                                        @endif
                                                    </td>
                                                    <td>{{ $user->first_name." ".$user->last_name }}</td>
                                                    <td>{{ $user->email }}</td>
                                                    <td>{{ $user->phone }}</td>
                                                    <td>{{ getStatus($user->status) }}</td>
                                                    <td class="actions">
{{--                                                        <a href="#" onclick="getUserDetail({{$user->id}})" class="edit_testimonial_btn" data-toggle="tooltip" data-original-title="Edit">--}}
{{--                                                            <i class="m-2 fa fa-edit" aria-hidden="true"></i>--}}
{{--                                                        </a>--}}
                                                        @if($user->status == 0)
                                                            <a href="{{ route('change-user-status',['user_id'=>$user->id,'status'=>'1']) }}" msg="Are you sure to activate this user?" class=" change_status icons-td" data-toggle="tooltip" data-original-title="Activate">
                                                                <i class="m-2 fa fa-thumbs-up"></i>
                                                            </a>
                                                        @elseif($user->status == 1)
                                                            <a href="{{ route('change-user-status',['user_id'=>$user->id,'status'=>'0']) }}" msg="Are you sure to deactivate this user?" class="icons-td  change_status" data-toggle="tooltip" data-original-title="Deactivate">
                                                                <i class="m-2 fa fa-thumbs-down"></i>
                                                            </a>
                                                        @endif
                                                        <a href="{{ route('change-user-status',['user_id'=>$user->id,'status'=>'2']) }}" msg="Are you sure to delete this user?" class=" change_status icons-td" data-toggle="tooltip" data-original-title="Delete">
                                                            <i class="m-2 fa fa-trash"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    {{ $users->links() }}
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- end col -->
                </div>
                <!-- end row -->

            </div>
            <!-- container-fluid -->

        </div>
        @include('admin.pages.footer')
    </div>
@endsection
