@extends('admin.layouts.master')
@section('content')
    <div class="content-page">

        <div class="content">

            <div class="container-fluid">
                <div class="page-title-box">

                    <div class="row align-items-center ">
                        <div class="col-md-12">
                            <div class="page-title-box">
                                <h4 class="page-title">Pending meet call</h4>
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
                                    <div class="table-responsive loan_application_table-w b-0" data-pattern="priority-columns">
                                        <table id="loan_application_table" class="table table-hover table-striped text-center">
                                            <thead>
                                            <tr>
                                                <th>Enquiry ID</th>
                                                <th>Profile</th>
                                                <th>Date Received</th>
                                                <th>Customer Name</th>
                                                <th>Loan type</th>
                                                <th>Amount</th>
                                                <th>Assigned to</th>
                                                <th>Date Assigned</th>
                                                <th>Action Done</th>
                                                <th>Market Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($applications as $application)
                                            <tr class="loan_application_row" url="{{ route('loan-application-summary',['apply_loan_id'=>$application->id]) }}" title="Show summary" style="cursor: pointer;">
                                                    <td>{{ $application->enquiry_id }}</td>
                                                    <td>{{ getProfile($application->profile) }}</td>
                                                    <td>{{ $application->created_at }}</td>
                                                    <td>
                                                        {{ $application->loan_user->first_name." ".$application->loan_user->last_name }}
                                                    </td>
                                                    <td>
                                                        {{ $application->loan_type->sub_type }}
                                                    </td>
                                                    <td>{{ $application->amount }}</td>
                                                    <td>
                                                        @if($application->assigned_to_user != null)
                                                            {{ $application->assigned_to_user->user->name }}
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if($application->assigned_to_user != null)
                                                            {{ $application->assigned_to_user->created_at }}
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if($application->application_rejected)
                                                        <span class="badge badge-info">Rejected</span>
                                                        @elseif($application->application_quote)
                                                        <span class="badge badge-info">Quoted</span>
                                                        @endif
                                                    </td>
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

