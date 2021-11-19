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
                            @if($application->assigned_by_application != null)
                            {{ $application->assigned_by_application->user->name }}
                            @endif
                        </span>
                        <span class="info__text">Applied at</span>
                        <span class="info__field">{{ $application->created_at }}</span>
                        <span class="info__text">Company name</span>
                        <span class="info__field">{{ $application->loan_company_detail->company_name ?? '' }}</span>
                        <span class="info__text">Company website</span>
                        <span class="info__field">{{ $application->loan_company_detail->website ?? '' }}</span>
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

            @if(!$application->application_rejected && !$application->application_quote)
            <div class="container bg-white py-3 mt-5 info-container" style="border-radius: .7rem;">
                <h5 class="">Quantum section</h5>
                <!-- SEC 1 -->
                <form method="POST" id="quotationForm" action="{{route('submit-quotation')}}">
                    @csrf
                    <input type="hidden" name="apply_loan_id" id="apply_loan_id" value="{{$application->id}}">
                    <!-- 1ST ROW -->
                    @if ($application->loan_type_id == 5 || $application->loan_type_id == 6)
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="input1" class="col-form-label">Facility limit($)</label>
                            <input type="number" min="0" id="facility_limit" name="facility_limit" required
                                class="form-control">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="input1" class="col-form-label">Advance percentage(%)</label>
                            <input type="number" min="0" id="advance_percentage" name="advance_percentage" required
                                class="form-control">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="custom-control custom-switch">
                                        <input type="radio" checked class="custom-control-input" value="1"
                                            name="is_notified" id="not_notified">
                                        <label class="custom-control-label" for="not_notified">Not notified?</label>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    or
                                </div>
                                <div class="col-md-3">
                                    <div class="custom-control custom-switch">
                                        <input type="radio" class="custom-control-input" value="1" name="is_notified"
                                            id="notified">
                                        <label class="custom-control-label" for="notified">Notified</label>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" class="custom-control-input" value="1"
                                            name="is_joint_account_required" id="is_joint_account_required">
                                        <label class="custom-control-label" for="is_joint_account_required">Joint
                                            account required</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="input1" class="col-form-label">Days needed to set up joint account</label>
                            <input type="number" min="0" disabled id="joint_account_days" name="joint_account_days"
                                required class="form-control">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="input1" class="col-form-label">Cost for joint account if any($)</label>
                            <div class="row">
                                <div class="col-md-5">
                                    <input type="number" disabled min="0" id="joint_account_cost_from"
                                        name="joint_account_cost_from" required class="form-control">
                                </div>
                                <span>-</span>
                                <div class="col-md-5">
                                    <input type="number" disabled min="0" id="joint_account_cost_to"
                                        name="joint_account_cost_to" required class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="input1" class="col-form-label">Interest calculated by</label>
                            <select required name="interest_calculated_by" id="interest_calculated_by"
                                class="form-control">
                                <option value="">Select interest calculated by</option>
                                <option value="1">Per year</option>
                                <option value="2">Per month</option>
                                <option value="3">Per week</option>
                                <option value="4">Per day</option>
                            </select>
                        </div>
                    </div>
                    @else
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="input1" class="col-form-label">Quantum($)</label>
                            <input type="number" min="0" name="quantum" required class="form-control">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="input1" class="col-form-label">Fixed or floating</label>
                            <select required id="fixed_or_floating" name="fixed_or_floating" class="form-control">
                                <option value="1">Fixed</option>
                                <option value="2">Floating</option>
                            </select>
                        </div>
                    </div>
                    <div id="fixed_floating_div">

                    </div>
                    @endif

                    <hr style=" background: grey;">
                    <h5 class="">Fee section</h5><span>(Please indicate all fees incurred upfront/draw down only
                        excluding e.g late fees)</span>


                    <div class="form-row">
                        <div class="col-md-6">
                            <label for="input7" class="col-form-label">One-time fee if any(processing/faculty/admin)
                            </label>
                            <div class="row d-flex">
                                <div class="col-md-3">
                                    <input type="number" min="0" name="one_time_fee_value" class="form-control"
                                        placeholder="$" id="one_time_fee_value">
                                </div>
                                <div class="col-md-1">
                                    <span>or</span>
                                </div>
                                <div class="col-md-3">
                                    <input type="number" min="0" name="one_time_fee_percent" class="form-control"
                                        placeholder="%" id="one_time_fee_percent">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="input7" class="col-form-label">Monthly Fee if any
                            </label>
                            <div class="row d-flex">
                                <div class="col-md-3">
                                    <input type="number" min="0" name="monthly_fee_value" class="form-control"
                                        placeholder="$" id="monthly_fee_value">
                                </div>
                                <div class="col-md-1">
                                    <span>or</span>
                                </div>
                                <div class="col-md-3">
                                    <input type="number" min="0" name="monthly_fee_percent" class="form-control"
                                        placeholder="%" id="monthly_fee_percent">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="input7" class="col-form-label">Annual Fee if any
                            </label>
                            <div class="row d-flex">
                                <div class="col-md-3">
                                    <input type="number" min="0" name="annual_fee_value" class="form-control"
                                        placeholder="$" id="annual_fee_value">
                                </div>
                                <div class="col-md-1">
                                    <span>or</span>
                                </div>
                                <div class="col-md-3">
                                    <input type="number" min="0" name="annual_fee_percent" class="form-control"
                                        placeholder="%" id="annual_fee_percent">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="input7" class="col-form-label">Legal Fee if any
                            </label>
                            <div class="row d-flex">
                                <div class="col-md-3">
                                    <input type="number" min="0" name="legal_fee_start_range" class="form-control"
                                        placeholder="$" id="legal_fee_start_range">
                                </div>
                                <div class="col-md-1">
                                    <span>-</span>
                                </div>
                                <div class="col-md-3">
                                    <input type="number" min="0" name="legal_fee_end_range" class="form-control"
                                        placeholder="$" id="legal_fee_end_range">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="input7" class="col-form-label">If insurance required
                            </label>
                            <div class="row d-flex">
                                <div class="col-md-2">
                                    <input type="number" min="0" name="if_insurance_start_value"
                                        class="form-control if_insurance_required_value" placeholder="$"
                                        id="if_insurance_start_value">
                                </div>
                                <div class="col-md-1">
                                    <span>-</span>
                                </div>
                                <div class="col-md-2">
                                    <input type="number" min="0" name="if_insurance_end_value"
                                        class="form-control if_insurance_required_value" placeholder="$"
                                        id="if_insurance_end_value">
                                </div>
                                <div class="col-md-1">
                                    <span>or</span>
                                </div>
                                <div class="col-md-2">
                                    <input type="number" min="0" name="if_insurance_start_percent"
                                        class="form-control if_insurance_required_percent" placeholder="%" id="input7">
                                </div>
                                <div class="col-md-1">
                                    <span>-</span>
                                </div>
                                <div class="col-md-2">
                                    <input type="number" min="0" name="if_insurance_end_value"
                                        class="form-control if_insurance_required_percent" placeholder="%" id="input7">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-5">
                            <label for="input1" class="col-form-label">EIR % P.a (optional)</label>
                            <input type="number" min="0" class="form-control" name="eir_pa" id="eir_pa">
                        </div>
                        <div class="form-group col-md-2 d-flex pt-4 justify-content-center align-items-center">
                            <h6 class="">or</h6>
                        </div>
                        <div class="form-group col-md-5">
                            <label for="input2" class="col-form-label">EIR % P.m (optional)</label>
                            <input type="number" min="0" class="form-control w-100" name="eir_pm" id="eir_pm">
                        </div>
                    </div>
                    <hr style=" background: grey;">
                    <h5 class="">Repayment section</h5><span>(Please select whichever that applies)</span>
                    <div class="form-row">
                        <div class="col-md-3">
                            <label for="input7" class="col-form-label">Repayment terms
                            </label>
                            <select required name="repayment_terms" class="form-control">
                                <option value="P+I">P+I</option>
                                <option value="P+I">I only</option>
                                <option value="P+I">Front end</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for="input7" class="col-form-label">Deferred after
                            </label>
                            <input type="number" step="1" min="0" required name="deffered_after" class="form-control"
                                placeholder="Months" id="input7">
                        </div>
                        <div class="col-md-3">
                            <label for="input7" class="col-form-label">Balloon on
                            </label>
                            <input type="number" min="0" required name="balloon_on" class="form-control"
                                placeholder="Months" id="input7">
                        </div>
                        <div class="col-md-3">
                            <label for="input7" class="col-form-label">Quote is valid for(Days)
                            </label>
                            <input type="text" required name="quote_validity" autocomplete="off"  class="form-control date-picker-quote"
                                placeholder="Quote validity" id="input7">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="input1" class="col-form-label">Remarks-Seen by all internal users</label>
                            <textarea type="text" required name="remarks" class="form-control" id="input1"></textarea>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="input1" class="col-form-label">Personal notepad(read only by me)</label>
                            <textarea type="text" name="personal_notepad" class="form-control" id="input1"></textarea>
                        </div>
                        <div class="form-group mb-0">
                            <div>
                                <button type="" id="submit_quotation" class="btn btn-primary waves-effect waves-light">
                                    Submit
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            @endif
        </div>
        <!-- container-fluid -->
    </div>
    <!-- content -->

    @include('admin.pages.footer')

</div>
@endsection
