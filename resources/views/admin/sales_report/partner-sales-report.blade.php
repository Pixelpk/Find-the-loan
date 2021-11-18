@extends("admin.layouts.master")
@section('content')
    <div class="content-page">
        <div class="content">
            <div class="container-fluid">
                <div class="page-title-box">

                    <div class="row align-items-center ">
                        <div class="col-md-4">
                            <div class="page-title-box">
                                <h4 class="page-title">Sales report</h4>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <form action="{{ route('partner-sales-report') }}" class="">
                                <div class="col-md-4 float-left">
                                    <div class="form-group">
                                        <select class="form-control"  name="partner_user_id">
                                            <option value="">Select User</option>
                                            @foreach ($all_users as $user)
                                                <option value="{{$user->id}}">{{$user->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4 float-left">
                                    <div class="form-group">
                                        <select class="form-control" name="date">
                                            <option value="">View Period</option>
                                            @foreach ($months_list as $month)
                                                <option value="{{$month['start_date1']}}">{{$month['month_start_day']." ".$month['month_name']}}-{{"10 ".$month['month_name']}}</option>
                                                <option value="{{$month['start_date2']}}">{{"11 ".$month['month_name']}}-{{"20 ".$month['month_name']}}</option>
                                                <option value="{{$month['start_date3']}}">{{"21 ".$month['month_name']}}-{{ $month['month_end_day']." ".$month['month_name']}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4 float-right">
                                    <button type="submit" class="btn btn-primary">Apply</button>
                                    
                                </div>
                            </form>
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
                                           
                                            </tbody>
                                        </table>
                                    </div>
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
