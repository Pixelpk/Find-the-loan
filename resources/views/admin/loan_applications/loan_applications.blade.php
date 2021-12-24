@extends('admin.layouts.master')
@section('content')
    <div class="content-page">

        <div class="content">

            <div class="container-fluid">
                <div class="page-title-box">

                    <div class="row align-items-center ">
                        <div class="col-md-2">
                            <div class="page-title-box">
                                <h4 class="page-title">Loan enquires</h4>
                            </div>
                        </div>
                        <div class="col-md-10">
                            <div class="float-right d-none d-md-block ml-2">
                                <button type="button" class="btn btn-primary" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-filter"></i>
                                </button>
                                <form method="get" action="{{ route('loan-applications') }}" id="application_filter_form" class="dropdown-menu  dropdown-menu-left p-4"
                                 style="margin-top: 10px !important;width: 30%;transform:none">
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
                            {{-- //filter div ends --}}


                            <div class="float-right d-none d-md-block ml-2">
                                <button type="button" id="" data-toggle="modal" data-target="#AssignApplicationsUser" data-dismiss="modal" title="Assign" class="btn btn-primary">
                                    Assign
                                </button>
                            </div>
                            {{-- <div class="float-right d-none d-md-block ml-2">
                                <button onclick="resetFormFields()" type="button" id="add_partner_btn" data-toggle="modal" data-target="#FinancePartnerModal" data-dismiss="modal" aria-label="Close" class="btn btn-primary "><i class="fa fa-plus-circle"></i></button>
                            </div> --}}
                            <div class=" col-md-3 float-right d-none d-md-block ml-2">
                                <div class="input-group no-border">
                                    <input class="form-control search-enquiries" name="search" type="text" autocomplete="off" value="" id="product-search" placeholder="Search by EnquiryID" >
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
                                @if ($profile == '1')
                                <div class="table-rep-plugin">
                                    <div class="table-responsive b-0" data-pattern="priority-columns">
                                        <table id="loan_application_table" class="table table-hover table-striped text-center">
                                            <thead>
                                            <tr>
                                                <th>Select</th>
                                                <th>Enquiry ID</th>
                                                {{-- <th>Assigned to</th>
                                                <th>Date Assigned</th> --}}
                                                <th>Name</th>
                                                <th>Profitable latest year</th>
                                                <th>Profitable year before</th>
                                                <th>Incorporated for</th>
                                                <th>Loan type</th>
                                                <th>Date Received</th>
                                                {{-- <th>Action Done</th> --}}
                                                <th>Market Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($applications as $application)
                                            <tr class="loan_application_row @if($application->assigned_application != null && $application->assigned_application->status == 1 && Auth::user()->parent_id != 0) shake @endif" url="{{ route('loan-application-summary',['apply_loan_id'=>$application->id]) }}" title="Show summary" style="cursor: pointer;">
                                                <td class="selected_application">
                                                        @if($application->assigned_to_user == null && $application->application_quote == null && $application->application_rejected == null)
                                                        <input style="height: 16px;width: 16px" name="selected_application" class="form-control" value="{{$application->id}}" id="application{{$application->id}}" type="checkbox"/>
                                                        @endif
                                                    </td>
                                                    <td>{{ $application->enquiry_id }}</td>
                                                    {{-- <td>
                                                        @if($application->assigned_to_user != null)
                                                            {{ $application->assigned_to_user->user->name }}
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if($application->assigned_to_user != null)
                                                            {{ date('Y-m-d',strtotime($application->assigned_to_user->created_at)) }}
                                                        @endif
                                                    </td> --}}
                                                    <td>
                                                        {{ $application->loan_user->first_name." ".$application->loan_user->last_name }}
                                                    </td>
                                                    <td>
                                                        {{ getYesNo($application->loan_company_detail->profitable_latest_year ?? '') }}
                                                    </td>
                                                    <td>
                                                        {{ getYesNo($application->loan_company_detail->profitable_before_year ?? '') }}
                                                    </td>
                                                    <td>
                                                        @php
                                                            $start_date = explode('/',$application->loan_company_detail->company_start_date ?? '');
                                                            @endphp
                                                        {{$start_date[0] ?? '0' }} years , {{$start_date[1] ?? '0'}} months ago
                                                    </td>
                                                    <td>
                                                        {{ $application->loan_type->sub_type }}
                                                    </td>
                                                    <td>
                                                        {{ date('Y-m-d',strtotime($application->created_at)) }}
                                                    </td>
                                                    {{-- <td>
                                                        @if($application->application_rejected)
                                                        <span class="badge badge-info">Rejected</span>
                                                        @elseif($application->application_quote)
                                                        <span class="badge badge-info">Quoted</span>
                                                        @endif
                                                    </td> --}}
                                                    <td>{{ $application->quotations_of_application_count ?? 0}} Finance partners have quoted</td>
                                                    
                                                    
                                                    
                                                </tr>

                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    {{ $applications->links('pagination::bootstrap-4') }}
                                </div>


                                @else

                                <div class="table-rep-plugin">
                                    <div class="table-responsive b-0" data-pattern="priority-columns">
                                        <table id="loan_application_table" class="table table-hover table-striped text-center">
                                            <thead>
                                            <tr>
                                                <th>Select</th>
                                                <th>Enquiry ID</th>
                                                {{-- <th>Assigned to</th>
                                                <th>Date Assigned</th> --}}
                                                <th>User</th>
                                                <th>NRIC</th>
                                                <th>Nationality</th>
                                                <th>Age</th>
                                                <th>Estimated monthly income</th>
                                                <th>Loan type</th>
                                                <th>Date Received</th>
                                                {{-- <th>Action Done</th> --}}
                                                <th>Market Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($applications as $application)
                                            <tr class="loan_application_row  @if($application->assigned_application != null && $application->assigned_application->status == 1 && Auth::user()->parent_id != 0) shake @endif" url="{{ route('loan-application-summary',['apply_loan_id'=>$application->id]) }}" title="Show summary"  style="cursor: pointer;">
                                                <td class="selected_application">
                                                    <input style="height: 16px;width: 16px" name="selected_application" class="form-control" value="{{$application->id}}" id="application{{$application->id}}" type="checkbox"/>
                                                </td>
                                                <td>{{ $application->enquiry_id }}</td>
                                                {{-- <td>
                                                    @if($application->assigned_to_user != null)
                                                        {{ $application->assigned_to_user->user->name }}
                                                    @endif
                                                </td>
                                                <td>
                                                    @if($application->assigned_to_user != null)
                                                        {{ date('Y-m-d',strtotime($application->assigned_to_user->created_at)) }}
                                                    @endif
                                                </td> --}}
                                                <td>
                                                    {{ $application->loan_user->first_name." ".$application->loan_user->last_name }}
                                                </td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td>
                                                    {{ $application->loan_type->sub_type }}
                                                </td>
                                                <td>
                                                    
                                                    {{ date('Y-m-d',strtotime($application->created_at)) }}
                                                </td>
                                                {{-- <td>
                                                    @if($application->application_rejected)
                                                    <span class="badge badge-info">Rejected</span>
                                                    @elseif($application->application_quote)
                                                    <span class="badge badge-info">Quoted</span>
                                                    @endif
                                                </td> --}}
                                                <td>{{ $application->quotations_of_application_count ?? 0}} Finance partners have quoted</td>
                                                
                                                    
                                                    
                                            </tr>

                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    {{ $applications->links('pagination::bootstrap-4') }}
                                </div>
                                @endif

                            </div>
                        </div>
                    </div>
                    <!-- end col -->
                </div>
                <!-- end row -->

            </div>
            <!-- container-fluid -->

        </div>
        {{-- @include('admin.pages.footer') --}}
    </div>

@endsection

