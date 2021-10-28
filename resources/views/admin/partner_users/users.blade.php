@extends("admin.layouts.master")
@section('content')
    <div class="content-page">
        <div class="content">
            <div class="container-fluid">
                <div class="page-title-box">

                    <div class="row align-items-center ">
                        <div class="col-md-8">
                            <div class="page-title-box">
                                <h4 class="page-title">All Users</h4>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="float-right d-none d-md-block">
                                <button onclick="resetFormFields()" type="button" id="add_user" data-toggle="modal" data-target="#PartnerUserModel" data-dismiss="modal" aria-label="Close" class="btn btn-primary "><i class="fa fa-plus-circle"></i></button>
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
                                                <th>Designation</th>
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
                                                    <td>{{ $user->designation }}</td>
                                                    <td>{{ $user->name }}</td>
                                                    <td>{{ $user->email }}</td>
                                                    <td>{{ $user->phone }}</td>
                                                    <td>{{ getStatus($user->status) }}</td>
                                                    <td class="actions">
                                                        <a class="icons-td" href="#" onclick="getPartnerUserDetail({{$user->id}})" class="edit_testimonial_btn" data-toggle="tooltip" data-original-title="Edit">
                                                            <i class="m-2 fa fa-edit" aria-hidden="true"></i>
                                                        </a>
                                                        @if($user->status == 0)
                                                            <a href="{{ route('partner-user-status',['user_id'=>$user->id,'status'=>'1']) }}" msg="Are you sure to activate this user?" class=" change_status" data-toggle="tooltip" data-original-title="Activate">
                                                                <i class="m-2 fa fa-thumbs-up"></i>
                                                            </a>
                                                        @elseif($user->status == 1)
                                                            <a href="{{ route('partner-user-status',['user_id'=>$user->id,'status'=>'0']) }}" msg="Are you sure to deactivate this user?" class="  change_status" data-toggle="tooltip" data-original-title="Deactivate">
                                                                <i class="m-2 fa fa-thumbs-down"></i>
                                                            </a>
                                                        @endif
                                                        <a href="{{ route('partner-user-status',['user_id'=>$user->id,'status'=>'2']) }}" msg="Are you sure to delete this user?" class=" change_status" data-toggle="tooltip" data-original-title="Delete">
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
    <script>
        function getPartnerUserDetail(id) {
            $.ajax({
                method: "POST",
                url: "{{ route('partner-user-detail') }}",
                data: {
                    '_token': '{{ csrf_token() }}',
                    id: id,
                }
            }).done(function (data) {
                let detail = data.data.user;
                console.log(data)
                // console.log(detail)
                if (data.success === 1) {
                    $('#edit_partner_user_id').val(detail.id);
                    $('#edit_partner_user_designation').val(detail.designation);
                    $('#edit_partner_user_name').val(detail.name);
                    $('#edit_partner_user_email').val(detail.email);
                    $('#edit_partner_user_phone').val(detail.phone);
                    $('#edit_partner_user_password').val("");

                    $('#EditPartnerUserModel').modal('toggle');
                    $('#EditPartnerUserModel').modal('show');
                } else {
                    alert(data.data.message);
                }
            });
        }
    </script>
@endsection
