@extends('admin.layouts.master')
@section('content')
    <div class="content-page">

        <div class="content">

            <div class="container-fluid">
                <div class="page-title-box">

                    <div class="row align-items-center ">
                        <div class="col-md-12">
                            <div class="page-title-box">
                                <h4 class="page-title">Replied with docs</h4>
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
                                    <div class="table-responsive  b-0" data-pattern="priority-columns">
                                        <table id="loan_application_table" class="table table-hover table-striped text-center">
                                            <thead>
                                            <tr>
                                                <th>Enquiry ID</th>
                                                <th>Profile</th>
                                                <th>Date Received</th>
                                                <th>Customer Name</th>
                                                <th>Loan type</th>
                                                <th>Amount</th>
                                                <th>View Replied Docs</th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($applications as $application)
                                            <tr class="loan_application_row" url="{{ route('loan-application-summary',['apply_loan_id'=>$application->apply_loan_id]) }}" title="Show summary" style="cursor: pointer;">
                                                    <td>{{ $application->loan_application->enquiry_id }}</td>
                                                    <td>{{ getProfile($application->loan_application->profile) }}</td>
                                                    <td>{{ $application->loan_application->created_at }}</td>
                                                    <td>
                                                        {{ $application->loan_application->loan_user->first_name." ".$application->loan_application->loan_user->last_name }}
                                                    </td>
                                                    <td>
                                                        {{ $application->loan_application->loan_type->sub_type }}
                                                    </td>
                                                    <td>{{ $application->loan_application->amount }}</td>
                                                    <td><a href="{{ route('replied-doc-details',['more_doc_request_id'=> $application->more_doc_request_id]) }}" class="btn btn-primary">
                                                        View Replied Docs
                                                    </a></td>
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

