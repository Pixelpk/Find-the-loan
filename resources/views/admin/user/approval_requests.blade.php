@extends("admin.layouts.master")
@section('content')
    <section class="content">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-12 col-md-6 col-sm-12">
                    <h2>All Approval Requests</h2>
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
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Work history</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($requests as $item)
                                        <tr>
                                            <td>{{ $item->name }}</td>
                                            <td>{{ $item->email }}</td>
                                            <td>{{ $item->phone }}</td>
                                            <td>{{ $item->user_detail->work_description }}</td>
                                            <td>{{ getStatus($item->status) }}</td>
                                            <td class="actions">
                                                <a href="{{ route('approve-user',['user_id'=>$item->id,'status'=>'1']) }}" msg="Are you sure to approve user request??" class="btn btn-default btn-icon btn-simple btn-icon-mini btn-round change_status" data-toggle="tooltip" data-original-title="Activate">
                                                    <i class="m-2 zmdi zmdi-thumb-up"></i>
                                                </a>
                                                <a href="{{ route('approve-user',['user_id'=>$item->id,'status'=>'2']) }}" msg="Are you sure to delete user request?" class="btn btn-default btn-icon btn-simple btn-icon-mini btn-round change_status" data-toggle="tooltip" data-original-title="Delete">
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
@endsection
