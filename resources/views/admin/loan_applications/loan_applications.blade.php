@extends('admin.layouts.master')
@section('content')
    <div class="content-page">

        <div class="content">

            <div class="container-fluid">
                <div class="page-title-box">

                    <div class="row align-items-center ">
                        <div class="col-md-2">
                            <div class="page-title-box">
                                <h4 class="page-title">Loan applications</h4>
                            </div>
                        </div>
{{--                        <div class="col-md-3 float-right">--}}
{{--                            <div class="input-group no-border">--}}
{{--                                <input class="form-control search-user" name="search" type="text" autocomplete="off" value="" id="product-search" placeholder="Search by EnquiryID" >--}}
{{--                            </div>--}}
{{--                            <div id="search_list" style="" class="autocomplete-items"></div>--}}
{{--                        </div>--}}
                        <div class="col-md-10">
                            <div class="float-right d-none d-md-block ml-2">
                                <button type="button" class="btn btn-primary" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-filter"></i>
                                </button>
                                <form method="get" action="{{ route('loan-applications') }}" id="application_filter_form" class="dropdown-menu  dropdown-menu-left p-4" style="background-color: #27b34d;margin-top: 10px !important;width: 30%;">
                                    <input type="hidden" id="application_profile_tab" name="profile" value="{{$profile}}">
                                    <div class="form-group">
                                        <label for="" class="control-label mb-10"> From:</label>
                                        <input type="text" autocomplete="off" class="form-control date-picker" name="from_date">
                                        <label for="" class="control-label mb-10"> To:</label>
                                        <input type="text" autocomplete="off" class="form-control date-picker" name="to_date">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Loan type</label>
                                        <select class="form-control" name="loan_type_id">
                                            <option value="">Select</option>
                                            @foreach($loan_types as $type)
                                                <option value="{{$type->id}}" @if(isset($_GET['loan_type_id']) && $_GET['loan_type_id'] == $type->id) {{'selected'}} @endif>{{ $type->sub_type }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Company structure Type</label>
                                        <select class="form-control" name="company_structure_type_id">
                                            <option value="">Select</option>
                                            @foreach($company_structure as $type)
                                                <option value="{{$type->id}}" @if(isset($_GET['company_structure_type_id']) && $_GET['company_structure_type_id'] == $type->id) {{'selected'}} @endif>{{ $type->structure_type }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Assigned User</label>
                                        <select class="form-control" name="assigned_user_id">
                                            <option value="">Select</option>
                                            @foreach($all_users as $user)
                                                <option value="{{ $user->id }}" @if(isset($_GET['assigned_user_id']) && $_GET['assigned_user_id'] == $user->id) {{'selected'}} @endif>{{ $user->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <button type="submit" class="btn btn-primary">Apply</button>
                                </form>
                            </div>
                            <div class="float-right d-none d-md-block ml-2">
                                <button type="button" id="" data-toggle="modal" data-target="#AssignApplicationsUser" data-dismiss="modal" title="Assign" class="btn btn-primary">
                                    Assign
                                </button>
                            </div>
                            <div class="float-right d-none d-md-block ml-2">
                                <button onclick="resetFormFields()" type="button" id="add_partner_btn" data-toggle="modal" data-target="#FinancePartnerModal" data-dismiss="modal" aria-label="Close" class="btn btn-primary "><i class="fa fa-plus-circle"></i></button>
                            </div>
                            <div class=" col-md-3 float-right d-none d-md-block ml-2">
                                <div class="input-group no-border">
                                    <input class="form-control search-user" name="search" type="text" autocomplete="off" value="" id="product-search" placeholder="Search by EnquiryID" >
                                </div>
                                <div id="search_list" style="" class="autocomplete-items"></div>
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
                                        <table id="loan_application_table" class="table  table-striped">
                                            <thead>
                                            <tr>
                                                <th>Select</th>
                                                <th>Quote</th>
                                                <th>Assigned to</th>
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
                                                <th>Incorporated for</th>
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
                                                <tr style="background-color: <?php /* @if($application->loan_company_detail !== null && $application->loan_company_detail->profitable_latest_year == 1) {{ $enquiry_data['profitable_color'] ?? '' }} @else {{ $enquiry_data['loss_color'] ?? '' }} @endif */ ?>">
                                                    <td>
                                                        @if($application->assigned_by_application == null)
                                                            <input style="height: 16px;width: 16px" name="selected_application" class="form-control select-product" value="{{$application->id}}" id="application{{$application->id}}" type="checkbox"/>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        {{-- <a href="{{ route('put-quotation',['apply_loan_id'=>$application->id]) }}" class="" data-toggle="tooltip" data-original-title="Put quotation">
                                                            <i class="fa fa-quote-left" aria-hidden="true"></i>
                                                        </a> --}}
                                                    </td>
                                                    <td>
                                                        @if($application->assigned_by_application != null)
                                                            {{ $application->assigned_by_application->user->name }}
                                                        @endif
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
                                                        {{ $application->loan_company_detail->company_name ?? '' }}
                                                    </td>
                                                    <td>
                                                        {{ $application->loan_company_detail->website ?? '' }}
                                                    </td>
                                                    <td>
                                                        {{ $application->loan_company_detail->loan_company_structure->structure_type ?? '' }}
                                                    </td>
                                                    <td>
                                                        {{ $application->loan_company_detail->loan_company_sector->name ?? '' }}
                                                    </td>
                                                    <td>
                                                        {{ $application->loan_company_detail->number_of_employees ?? '' }}
                                                    </td>
                                                    <td>
                                                        @php
                                                            $start_date = explode('/',$application->loan_company_detail->company_start_date ?? '');
                                                        @endphp
                                                        {{$start_date[0] ?? ''." years".", ".$start_date[1] ?? ''." months ago"}}
                                                    </td>
                                                    <td>
                                                        {{ $application->loan_company_detail->revenue ?? '' }}
                                                    </td>
                                                    <td>
                                                        {{ $application->loan_company_detail->optional_revenuee ?? '' }}
                                                    </td>
                                                    <td>
                                                        {{ $application->loan_company_detail->share_holder ?? '' }}
                                                    </td>
                                                    <td>
                                                        {{ $application->loan_company_detail->percentage_shareholder ?? '' }}
                                                    </td>
                                                    <td>
                                                        {{ getYesNo($application->loan_company_detail->profitable_latest_year ?? '') }}
                                                    </td>
                                                    <td>
                                                        {{ getYesNo($application->loan_company_detail->profitable_before_year ?? '') }}
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
{{--    <script>--}}
{{--        $('.bulk_assign').click(function (){--}}
{{--            console.log('asdfasdf')--}}
{{--            $('AssignApplicationsUser').toggle();--}}
{{--            $('AssignApplicationsUser').show();--}}
{{--        });--}}
{{--    </script>--}}
@endsection

