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
                                                <option value="{{$user->id}}" @isset($selected_user) @if($selected_user == $user->id) selected @endif @endisset >{{$user->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4 float-left">
                                    <div class="form-group">
                                        <select class="form-control" name="date">
                                            <option value="">View Period</option>
                                            @foreach ($months_list as $month)
                                                <option value="{{$month['start_date1']}}" @isset($selected_period) @if($selected_period == $month['start_date1']) selected @endif @endisset >{{$month['month_start_day']." ".$month['month_name']}}-{{"10 ".$month['month_name']}}</option>
                                                <option value="{{$month['start_date2']}}" @isset($selected_period) @if($selected_period == $month['start_date2']) selected @endif @endisset >{{"11 ".$month['month_name']}}-{{"20 ".$month['month_name']}}</option>
                                                <option value="{{$month['start_date3']}}" @isset($selected_period) @if($selected_period == $month['start_date3']) selected @endif @endisset >{{"21 ".$month['month_name']}}-{{ $month['month_end_day']." ".$month['month_name']}}</option>
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
                                <div class="">
                                    <div class="table-responsive b-0" data-pattern="priority-columns">
                                        
                                        <h6>
                                            Total leads received = @isset($sales_report) {{$total_applications}} @endisset 
                                        </h6>
                                        
                                        <table id="" class="table js-exportable">
                                            @isset($sales_report)
                                            <thead>
                                                <th style="min-width:130px;">Period</th>
                                                <th style="min-width:130px;">Viewed</th>
                                                <th style="min-width:130px;">Rejected</th>
                                                <th style="min-width:130px;">Pending docs</th>
                                                <th style="min-width:130px;">Cx no action after 14 days</th>
                                                <th style="min-width:130px;">Replied with docs</th>
                                                <th style="min-width:130px;">Assigned out</th>
                                                <th style="min-width:130px;">Quoted Customer</th>
                                                <th style="min-width:130px;">Customer Applied</th>
                                                <th style="min-width:130px;">To call/meet</th>
                                                <th style="min-width:130px;">No confirmation after 30 days</th>
                                                <th style="min-width:130px;">Loan no longer required</th>
                                                <th style="min-width:130px;">Letter of offer Signed</th>
                                                <th style="min-width:130px;">Loan Disbursed</th>
                                            </thead>
                                            <tbody>
                                                @foreach ($sales_report as $report)
                                                    @foreach ($report as $item)
                                                        <tr>
                                                            <td>{{$item['lable']}}</td>
                                                            <td>{{$item['total_viewed_applications']}} 
                                                                @if($item['total_viewed_applications'] >0 && $item['total_viewed_applications'] > 0) ({{ round(($item['total_viewed_applications']*100)/$total_applications, 2) }} %) @endif
                                                            </td>
                                                            <td>{{$item['total_rejected_applications']}} 
                                                                @if($item['total_rejected_applications'] > 0 && $item['total_viewed_applications'] > 0) ({{round(($item['total_rejected_applications']*100)/$item['total_viewed_applications'], 2)}} %) @endif
                                                            </td>
                                                            <td>{{$item['total_more_doc_requests']}} 
                                                                @if($item['total_more_doc_requests'] >0 && $item['total_viewed_applications'] > 0) ({{($item['total_more_doc_requests']*100)/$item['total_viewed_applications']}} %) @endif
                                                            </td>
                                                            <td>0</td>
                                                            <td>0</td>
                                                            <td>{{$item['total_assigned_out_application']}} 
                                                                @if($item['total_assigned_out_application'] >0 && $item['total_viewed_applications'] > 0) ({{($item['total_assigned_out_application']*100)/$item['total_viewed_applications']}} %) @endif
                                                            </td>
                                                            <td>{{$item['total_quoted_application']}} 
                                                                @if($item['total_quoted_application'] > 0 && $item['total_viewed_applications'] > 0) ({{($item['total_quoted_application']*100)/$item['total_viewed_applications']}} %) @endif
                                                            </td>
                                                            <td>0</td>
                                                            <td>0</td>
                                                            <td>0</td>
                                                            <td>0</td>
                                                            <td>0</td>
                                                            <td>0</td>
                                                        </tr>
                                                        
                                                    
                                                    @endforeach
                                                @endforeach
                                            </tbody>
                                            @endisset
                                            
                                        </table>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- end col -->
                </div>
                <!-- end row -->


                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="">
                                    <div class="table-responsive b-0" data-pattern="priority-columns">
                                        <h6>
                                            Quoted and Disbursed details
                                        </h6>
                                        <table id="" class="table">
                                            @isset($month_vise)
                                            <thead>
                                                <th style="min-width:130px;">Month</th>
                                                <th style="min-width:130px;">Loan Quoted</th>
                                                <th style="min-width:130px;">Loan Disbursed</th>
                                                
                                            </thead>
                                            <tbody>
                                                @foreach ($month_vise as $month)
                                                        <tr>
                                                            <td>{{ $month['month_name'] }}</td>
                                                            <td>
                                                                Total loan Quoted: {{ $month['quoted']['total_loan_quoted'] }}<br>
                                                                Average loan size: {{ $month['quoted']['quoted_average_loan_size'] }}<br>
                                                                Average interest: {{ $month['quoted']['quoted_average_interest'] }}<br>
                                                                Average tenure: {{ $month['quoted']['quoted_average_tenure'] }}<br>
                                                                Among xx cases: {{$month['quoted']['quoted_count']}}<br>
                                                                Disbursed to quoted ratio: <br>
                                                            </td>
                                                            <td></td>
                                                        </tr>
                                                @endforeach
                                            </tbody>
                                            @endisset
                                            
                                        </table>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- end col -->
                </div>
                <!-- end row -->

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="">
                                    <div class="table-responsive b-0" data-pattern="priority-columns">
                                        <h6>
                                            Reason For Rejection
                                        </h6>
                                        <table id="" class="table">
                                            @isset($month_vise)
                                            <thead>
                                                <th style="min-width:130px;">Month</th>
                                                <th style="min-width:130px;">Reason</th>
                                                
                                            </thead>
                                            <tbody>
                                                @foreach ($month_vise as $month)
                                                        <tr>
                                                            <td>{{ $month['month_name'] }}</td>
                                                            <td>
                                                                @foreach ($month['reject_reasons']  as $reason)
                                                                <span style="font-weight:bold">{{$reason->reason}} : ({{count($reason->user_loan_reject)}})<span> <br>
                                                                @endforeach
                                                            </td>
                                                            <td></td>
                                                        </tr>
                                                @endforeach
                                            </tbody>
                                            @endisset
                                            
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
