@extends('admin.layouts.master')
@section('content')
    <div class="content-page">

        <div class="content">

            <div class="container-fluid">
                <div class="page-title-box">

                    <div class="row align-items-center ">
                        <div class="col-md-12">
                            <div class="page-title-box">
                                <h4 class="page-title">Rejected loan enquiries</h4>
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
                                        <table id="loan_application_table" class="table table-hover table-striped text-center  w-100">
                                            <thead>
                                            <tr>
                                                <th>Enquiry Id</th>
                                                <th>Profile</th>
                                                <th>Date Received</th>
                                                <th>Customer Name</th>
                                                <th>Loan type</th>
                                                <th>Amount</th>
                                                <th>Rejected by</th>
                                                <th>Customer reject reason</th>
                                                <th>Internal reject reason</th>
                                                <th>Other reasons</th>
                                                <th>Reject date</th>
                                                <th>Market Status</th>
                                            
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($applications as $application)
                                                <tr class="loan_application_row" url="{{ route('loan-application-summary',['apply_loan_id'=>$application->id]) }}" title="Show summary" style="cursor: pointer;background-color: <?php /* @if($application->loan_company_detail !== null && $application->loan_company_detail->profitable_latest_year == 1) {{ $enquiry_data['profitable_color'] ?? '' }} @else {{ $enquiry_data['loss_color'] ?? '' }} @endif */ ?>">
                                                    <td>{{ $application->enquiry_id }}</td>
                                                    <td>{{ getProfile($application->profile) }}</td>
                                                    <td>{{ $application->created_at }}</td>
                                                    <td>{{ $application->loan_user->first_name." ".$application->loan_user->last_name }}</td>
                                                    <td>{{ $application->loan_type->sub_type }}</td>
                                                    <td>{{ $application->amount }}</td>
                                                    <td>{{ $application->application_rejected->rejected_by->name }}</td>
                                                    <td>{{ $application->application_rejected->customer_reject_reason->reason }}</td>
                                                    <td>{{ $application->application_rejected->internal_reject_reason->reason }}</td>
                                                    <td>{{ $application->application_rejected->other_reasons }}</td>
                                                    <td>{{ $application->application_rejected->created_at }}</td>
                                                    <td>{{ $application->quotations_of_application_count ?? 0}} Finance partners have quoted</td>
                                                   
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    {{ $applications->links('pagination::bootstrap-4') }}
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

