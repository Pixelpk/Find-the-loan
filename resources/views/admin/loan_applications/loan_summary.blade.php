@extends("admin.layouts.master")
@section('content')
<div class="content-page">
    <!-- Start content -->
    <div class="content">

        <div class="container-fluid">
            <div class="page-title-box">

                <div class="row align-items-center ">
                    <div class="col-md-12">
                        <div class="page-title-box">
                            <h4 class="page-title">Summary & Quotation</h4>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end page-title -->

            <!-- INFO CONTAINER -->
            <div class="container py-3 info-container">
                <nav class="navbar navbar-expand-lg navbar-light">
                    <div class="container-fluid mb-3" style="padding:0">
                        <span class="navbar-brand">
                            Summary
                            @if ($application->application_rejected)
                                <b style="color: #27B34D">(Rejected)</b>
                            @elseif($application->application_quote)
                                <b style="color: #27B34D">(Quoted)</b>
                            @endif
                        </span>
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                            data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                            aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>

                        <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
                            
                            <ul class="navbar-nav sum-nav me-auto mb-2 mb-lg-0">
                                @if($application->assigned_to_user == null)
                                    <li class="nav-item">

                                        <div class="dropdown dropleft">
                                            <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                              Actions
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                                                @if($application->assigned_to_user == null)
                                                    @if (!$application->pending_meet_call)
                                                        <a href="{{ route('pending-meet-call',['apply_loan_id'=>$application->id]) }}" type="button" class="dropdown-item change_status" msg="Are you sure to keep it in Pending Meet Call List?">Pending Meet Call</a>
                                                    @endif
                                                @endif
                                                <a href="javascript:void(0)" type="button" class="dropdown-item" >Loan Disbursed</a>
                                            </div>
                                        </div>
                                    </li>
                                
                                    @if(!$application->application_rejected && !$application->application_quote)
                                        <li class="nav-item">
                                            <a href="#" onclick="rejectApplication({{$application->id}});" data-toggle="tooltip"
                                                data-original-title="Reject" class="btn btn-primary"
                                                aria-current="page">Reject</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="btn btn-primary" aria-current="page"
                                                href="{{ route('more-doc-required',['apply_loan_id'=>$application->id]) }}">
                                                More doc required
                                            </a>
                                        </li>

                                        @if (!$application->application_more_doc->isEmpty())
                                        <li class="nav-item">
                                            <a class="btn btn-primary" id="view_more_doc_detail_btn" data-toggle="modal" data-target="#ViewMoreDocDetails" data-dismiss="modal" aria-label="Close" 
                                                href="javascript:void(0)">
                                                View more doc request
                                            </a>
                                        </li>
                                        @endif
                                    @endif
                                @endif

                                
                                <li class="nav-item">
                                    <a class="btn btn-primary" data-original-title="Download All Documents"
                                        aria-current="page"
                                        href="{{ route('download-loan-doc',['id'=>$application->id]) }}">
                                        Download documents
                                    </a>
                                </li>

                            </ul>

                        </div>
                    </div>
                </nav>
                <!-- <div class="top-div mb-4">
                    <h5 class="fw-bold"><u>Summary</u></h5>
                </div> -->
                <!-- SEC 1 -->
                <div class="container">
                    <div class="sumary-list same-gp">
                        
                        <span class="info__text">Loan type looking for</span>
                        <span class="info__field">{{ $application->loan_type->sub_type }}</span>
                        <span class="info__text">Amount looking at</span>
                        <span class="info__field">${{ $application->amount }}</span>
                        <span class="info__text">Reason for loan</span>
                        <span class="info__field">{{ $application->loan_reason->reason ?? "" }}</span>
                        
                        <span class="info__text">Market Status</span>
                        <span class="info__field">{{ $application->quotations_of_application_count ?? 0}} Finance partners have quoted</span>
                        <span class="info__text">Assigned to</span>
                        <span class="info__field">
                            @if($application->assigned_to_user != null)
                            {{ $application->assigned_to_user->user->name }}
                            @endif
                        </span>
                        <span class="info__text">Applied at</span>
                        <span class="info__field">{{ $application->created_at }}</span>

                        @if ($application->profile == '1')
                            <span class="info__text">Company name</span>
                            <span class="info__field">{{ $application->loan_company_detail->company_name ?? '' }}</span>
                            <span class="info__text">Company website</span>
                            <span class="info__field">{{ $application->loan_company_detail->website ?? '' }}</span>
                            <span class="info__text">Incorporated</span>
                            <span class="info__field">
                                @php
                                $start_date = explode('/',$application->loan_company_detail->company_start_date ?? '');
                                @endphp
                                {{$start_date[0] ?? '0'}} years , {{$start_date[1] ?? '0'}} months ago
                            </span>
                            <span class="info__text">Business Structure</span>
                            <span
                                class="info__field">{{ $application->loan_company_detail->loan_company_structure->structure_type ?? '' }}</span>
                            <span class="info__text">Local Shareholding</span>
                            <span
                                class="info__field">{{ $application->loan_company_detail->percentage_shareholder ?? '' }}%</span>
                            <span class="info__text">Sector</span>
                            <span
                                class="info__field">{{ $application->loan_company_detail->loan_company_sector->name ?? '' }}</span>
                            <span class="info__text">No. of employees</span>
                            <span class="info__field">{{ $application->loan_company_detail->number_of_employees ?? '' }}</span>
                            <span class="info__text">Revenue</span>
                            <span class="info__field">{{ $application->loan_company_detail->revenue ?? '' }}</span>
                            <span class="info__text">Optional revenue</span>
                            <span class="info__field">{{ $application->loan_company_detail->optional_revenuee ?? '' }}</span>
                            <span class="info__text">No of shareholder</span>
                            <span class="info__field">{{ $application->loan_company_detail->share_holder ?? '' }}</span>
                            <span class="info__text">Profitable latest year</span>
                            <span class="info__field">{{ getYesNo($application->loan_company_detail->profitable_latest_year ?? '') }}</span>
                            <span class="info__text">Profitable year before</span>
                            <span class="info__field">{{ getYesNo($application->loan_company_detail->profitable_before_year ?? '') }}</span>

                        @else

                        <span class="info__text">NRIC</span>
                        <span class="info__field"></span>
                        <span class="info__text">Nationality</span>
                        <span class="info__field"></span>
                        <span class="info__text">Estimated monthly income</span>
                        <span class="info__field"></span>
                            
                        @endif
                        
                        
                        @if ($application->application_rejected != null)
                        <span class="info__text">Rejected by</span>
                        <span class="info__field">{{ $application->application_rejected->rejected_by->name }}</span>
                        <span class="info__text">Customer reject reason</span>
                        <span class="info__field">{{ $application->application_rejected->customer_reject_reason->reason }}</span>
                        <span class="info__text">Internal reject reason</span>
                        <span class="info__field">{{ $application->application_rejected->internal_reject_reason->reason }}</span>
                        <span class="info__text">Reject date</span>
                        <span class="info__field">{{ $application->application_rejected->created_at }}</span>
                        @endif
                    </div>
                    <hr style="background:#000000; margin: 2rem 0">
                    <!-- /SYMMARY-LIST -->

                    <div class="same-gp sumary-list__1">
                        <div class="same-gp info__inner-list">
                            <span class="info__text-h">Bank Statement</span>
                            <span class="info__field">Dec</span>
                            <span class="info__field">Jan</span>
                            <span class="info__field">Feb</span>
                            <span class="info__field">March</span>
                            <span class="info__field">April</span>
                            <span class="info__field">Total 6 Months</span>
                            <span class="info__field">Average</span>
                        </div>
                        <!-- /INFO INNER LIST -->

                        <div class="same-gp info__inner-list">
                            <span class="info__text-h">Total Deposit</span>
                            <span class="info__field">$233945.00</span>
                            <span class="info__field">$233945.00</span>
                            <span class="info__field">$233945.00</span>
                            <span class="info__field">$233945.00</span>
                            <span class="info__field">$233945.00</span>
                            <span class="info__field">$233945.00</span>
                            <span class="info__field">$233945.00</span>
                        </div>
                        <!-- /INFO INNER LIST 2-->

                        <div class="same-gp info__inner-list">
                            <span class="info__text-h">Total Withdrawals</span>
                            <span class="info__field">$301287.98</span>
                            <span class="info__field">$301287.98</span>
                            <span class="info__field">$301287.98</span>
                            <span class="info__field">$301287.98</span>
                            <span class="info__field">$301287.98</span>
                            <span class="info__field">$301287.98</span>
                            <span class="info__field">$301287.98</span>
                        </div>
                        <!-- /INFO INNER LIST 3-->

                        <div class="same-gp info__inner-list">
                            <span class="info__text-h">Month end Balance</span>
                            <span class="info__field">$540299.55</span>
                            <span class="info__field">$540299.55</span>
                            <span class="info__field">$540299.55</span>
                            <span class="info__field">$540299.55</span>
                            <span class="info__field">$540299.55</span>
                            <span class="info__field">$540299.55</span>
                            <span class="info__field">$540299.55</span>
                        </div>
                        <!-- /INFO INNER LIST 4-->
                    </div>
                    <!-- /SYMMARY-LIST 1-->

                    <hr style="background:#000000; margin: 2rem 0">
                    <!-- SUMMARY LIST 2 -->
                    <div class="same-gp sumary-list__2">
                        <span class="info__text">Returned cheques in last 6 months</span>
                        <span class="info__field">0</span>
                        <span class="info__text">More than 15k a month</span>
                        <span class="info__field">Yes</span>
                        <span class="info__text">More than 650k a year</span>
                        <span class="info__field">Yes</span>
                    </div>
                </div>
                <!-- /SUMMARY LIST 2 -->

                <hr style="background:#000000; margin: 2rem 0">

                <!-- SUMMARY LIST 3 -->
                <div class="same-gp sumary-list__3">
                    <!-- FOR NEW PERSON -->
                    <span class="info__text">Shareholders
                        <!-- SUMMARY LIST 3 INNER -->
                        <div class="same-gp sumary-list__3-inner">
                            <span class="info__text">Mr Tan</span>
                            <span class="info__field">CBS Grading</span>
                            <span class="info__field">AA</span>
                            <span class="info__text"></span>
                            <span class="info__field">NOA Latest Year</span>
                            <span class="info__field">$35000,89</span>
                            <span class="info__text"></span>
                            <span class="info__field">NOA Latest Year</span>
                            <span class="info__field">$35000,89</span>
                        </div>
                        <!-- /SUMMARY LIST 3 INNER -->
                    </span>
                    <!-- /FOR NEW PERSON -->

                    <!-- FOR AGE -->
                    <span class="info__text text-center">Age
                        <!-- SUMMARY LIST 3 INNER 1-->
                        <div class="same-gp sumary-list__3-inner1">
                            <span class="info__field">55</span>
                        </div>
                        <!-- /SUMMARY LIST 3 INNER 1-->
                    </span>
                    <!-- FOR AGE -->
                </div>
            </div>

            @if($application->assigned_to_user == null)
                @if(!$application->application_rejected && !$application->application_quote)
                    @include('admin.loan_applications.put_quotation')
                @endif
            @endif

            @if ($application->application_quote != null && $application->application_quote->quoted_by == Auth::user()->id)
                @include('admin.loan_applications.quotation_details')
            @endif

    <!-- content -->

    @include('admin.pages.footer')

</div>
@endsection
