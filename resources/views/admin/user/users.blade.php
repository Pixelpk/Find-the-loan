@extends("admin.layouts.master")
@section('content')
    <section class="content">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-12 col-md-6 col-sm-12">
                    <h2>All Users</h2>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row clearfix">
                <div class="col-md-12">
                    <div class="card patients-list">
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table m-b-0 table-hover">
                                    <thead>
                                    <tr>
                                        <th>Image</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Hourly rate</th>
                                        <th>Food allowance</th>
                                        <th>Travel allowance</th>
                                        <th>Covid test amount</th>
                                        <th>Phone</th>
                                        <th>Work history</th>
{{--                                        <th>Vaccinated</th>--}}
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
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>{{ $user->phone }}</td>
                                            <td>{{ $user->user_detail->hourly_rate }}</td>
                                            <td>{{ $user->user_detail->food_allowance }}</td>
                                            <td>{{ $user->user_detail->travel_allowance }}</td>
                                            <td>{{ $user->user_detail->covid_test_amount }}</td>
                                            <td>{{ $user->user_detail->work_description }}</td>
{{--                                            <td>{{ getYesNo($user->user_detail->is_vaccinated) }}</td>--}}
                                            <td>{{ getStatus($user->status) }}</td>
                                            <td class="actions">
                                                <a href="#" onclick="getUserDetail({{$user->id}})" class="btn btn-default btn-icon btn-simple btn-icon-mini btn-round edit_user_btn" data-toggle="tooltip" data-original-title="Edit">
                                                    <i class="m-2 zmdi zmdi-edit" aria-hidden="true"></i>
                                                </a>
                                                @if($user->status == 0)
                                                    <a href="{{ route('change-user-status',['user_id'=>$user->id,'status'=>'1']) }}" msg="Are you sure to activate this user?" class="btn btn-default btn-icon btn-simple btn-icon-mini btn-round change_status" data-toggle="tooltip" data-original-title="Activate">
                                                        <i class="m-2 zmdi zmdi-thumb-up"></i>
                                                    </a>
                                                @elseif($user->status == 1)
                                                    <a href="{{ route('change-user-status',['user_id'=>$user->id,'status'=>'0']) }}" msg="Are you sure to deactivate this user?" class="btn btn-default btn-icon btn-simple btn-icon-mini btn-round change_status" data-toggle="tooltip" data-original-title="Deactivate">
                                                        <i class="m-2 zmdi zmdi-thumb-down"></i>
                                                    </a>
                                                @endif
                                                <a href="{{ route('change-user-status',['user_id'=>$user->id,'status'=>'2']) }}" msg="Are you sure to delete this user?" class="btn btn-default btn-icon btn-simple btn-icon-mini btn-round change_status" data-toggle="tooltip" data-original-title="Delete">
                                                    <i class="m-2 zmdi zmdi-delete"></i>
                                                </a>
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
        </div>
    </section>

    <script>
        function getUserDetail(id) {
            // $('.page-loader-wrapper').show();
            $.ajax({
                method: "POST",
                url: "{{ route('user-detail') }}",
                data: {
                    '_token': '{{ csrf_token() }}',
                    id: id,
                }
            }).done(function (data) {
                let detail = data.data.detail;
                console.log(data)
                console.log(detail)
                if (data.success === 1) {
                    $('#update_user_id').val(detail.user_id);
                    $("#user_hourly_rate").val(detail.hourly_rate);
                    $("#user_food_allowance").val(detail.food_allowance);
                    $("#user_travel_allowance").val(detail.travel_allowance);
                    $("#user_covid_amount").val(detail.covid_test_amount);

                    $('#UserModal').modal('toggle');
                    $('#UserModal').modal('show');
                } else {
                    alert(data.message);
                }
            });
        }
    </script>
@endsection
