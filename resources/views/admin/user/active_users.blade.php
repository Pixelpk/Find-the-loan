@extends("admin.layouts.master")
@section('content')
    <section class="content">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-12 col-md-6 col-sm-12">
                    <h2>Active users</h2>
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
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($logs as $item)
                                        <tr>
                                            <td>{{ $item->user->name }}</td>
                                            <td>{{ $item->user->email }}</td>
                                            <td>{{ $item->user->phone }}</td>
                                            <td>{{ $item->user_detail->work_description }}</td>
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
