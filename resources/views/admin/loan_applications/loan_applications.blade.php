@extends('admin.layouts.master')
@section('content')
    <div class="content-page">

        <div class="content">

            <div class="container-fluid">
                <div class="page-title-box">

                    <div class="row align-items-center ">
                        <div class="col-md-8">
                            <div class="page-title-box">
                                <h4 class="page-title">Finance partners</h4>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="float-right d-none d-md-block ml-2">
                                <button type="button" title="Assign" class="btn btn-primary bulk_assign">
                                    <i class="fa fa-thumbs-up"></i></button>
                            </div>
                            <div class="float-right d-none d-md-block">
                                <button onclick="resetFormFields()" type="button" id="add_partner_btn" data-toggle="modal" data-target="#FinancePartnerModal" data-dismiss="modal" aria-label="Close" class="btn btn-primary "><i class="fa fa-plus-circle"></i></button>
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
                                                <th>Select</th>
                                                <th>Download documents</th>
                                                <th>Applied at</th>
                                                <th>User</th>
                                                <th>Loan type</th>
                                                <th>Amount</th>
                                                <th>Loan reasons</th>
                                                <th>Company name</th>
                                                <th>Company website</th>
                                                <th>Company structure</th>
                                                <th>Sector</th>
                                                <th>No. of employees</th>
                                                <th>Company started</th>
                                                <th>Revenue</th>
                                                <th>Optional revenue</th>
                                                <th>Share holders</th>
                                                <th>% Shareholder</th>
                                                <th>Profitable latest year</th>
                                                <th>Profitable year before</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($applications as $application)
                                                <tr>
                                                    <td>
                                                        <input style="height: 16px;width: 16px" name="selected_application" class="form-control select-product" value="{{$application->id}}" id="application{{$application->id}}" type="checkbox"/>
                                                    </td>
                                                    <td>
                                                        <a href="{{ route('download-loan-doc',['id'=>$application->id]) }}" class="" data-toggle="tooltip" data-original-title="Download All Documents">
                                                            <i class="m-2 fa fa-download"></i>
                                                        </a>
                                                    </td>
                                                    <td>
                                                        {{ $application->created_at }}
                                                    </td>
                                                    <td>
                                                        {{ $application->loan_user->first_name." ".$application->loan_user->last_name }}
                                                    </td>
                                                    <td>
                                                        {{ $application->loan_type->sub_type }}
                                                    </td>
                                                    <td>
                                                        {{ $application->amount }}
                                                    </td>
                                                    <td>
                                                        @foreach($application->user_loan_reasons as $reason)
                                                            {{ $reason->loan_reason->reason."," }}
                                                        @endforeach
                                                    </td>
                                                    <td>
                                                        {{ $application->loan_company_detail->company_name }}
                                                    </td>
                                                    <td>
                                                        {{ $application->loan_company_detail->website }}
                                                    </td>
                                                    <td>
                                                        {{ $application->loan_company_detail->loan_company_structure->structure_type }}
                                                    </td>
                                                    <td>
                                                        {{ $application->loan_company_detail->loan_company_sector->name }}
                                                    </td>
                                                    <td>
                                                        {{ $application->loan_company_detail->number_of_employees }}
                                                    </td>
                                                    <td>
                                                        @php
                                                            $start_date = explode('/',$application->loan_company_detail->company_start_date);
                                                        @endphp
                                                        {{$start_date[0]." years".", ".$start_date[1]." months ago"}}
                                                    </td>
                                                    <td>
                                                        {{ $application->loan_company_detail->revenue }}
                                                    </td>
                                                    <td>
                                                        {{ $application->loan_company_detail->optional_revenuee }}
                                                    </td>
                                                    <td>
                                                        {{ $application->loan_company_detail->share_holder }}
                                                    </td>
                                                    <td>
                                                        {{ $application->loan_company_detail->percentage_shareholder }}
                                                    </td>
                                                    <td>
                                                        {{ $application->loan_company_detail->profitable_latest_year }}
                                                    </td>
                                                    <td>
                                                        {{ $application->loan_company_detail->profitable_before_year }}
                                                    </td>
                                                </tr>

                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    {{ $applications->links() }}
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

