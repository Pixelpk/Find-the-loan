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
                            <h4 class="page-title">Put quotation</h4>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end page-title -->

            <!-- FORM NO 1 -->
            <div class="container bg-white shadow py-3" style="border-radius: 0.7rem;">
                <h5 class="">Quantum section</h5>
                <!-- SEC 1 -->
                <form method="POST" id="quotationForm" action="{{route('submit-quotation')}}">
                    @csrf
                    <input type="hidden" name="apply_loan_id" value="{{$apply_loan_id}}">
                    <!-- 1ST ROW -->
                    @if ($apply_loan->loan_type_id == 5 || $apply_loan->loan_type_id == 6)
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="input1" class="col-form-label">Facility limit($)</label>
                            <input type="number" min="0"  id="facility_limit" name="facility_limit" required class="form-control">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="input1" class="col-form-label">Advance percentage(%)</label>
                            <input type="number" min="0"  id="advance_percentage" name="advance_percentage" required class="form-control">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="custom-control custom-switch">
                                        <input type="radio" checked class="custom-control-input" value="1" name="is_notified" id="not_notified">
                                        <label class="custom-control-label" for="not_notified">Not notified?</label>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    or
                                </div>
                                <div class="col-md-3">
                                    <div class="custom-control custom-switch">
                                        <input type="radio" class="custom-control-input" value="1" name="is_notified" id="notified">
                                        <label class="custom-control-label" for="notified">Notified</label>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" class="custom-control-input" value="1" name="is_joint_account_required" id="is_joint_account_required">
                                        <label class="custom-control-label" for="is_joint_account_required">Joint account required</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                    
                    <div class="form-row">
                        {{-- <div class="form-group col-md-4">
                            <label for="input1" class="col-form-label">Invoice based on</label>
                            <select required name="invoice_based_on" id="invoice_based_on" class="form-control">
                                <option value="1">Notified</option>
                                <option value="2">Non notified</option>
                                <option value="3">Joint account required</option>
                            </select>                        
                        </div> --}}
                        <div class="form-group col-md-4">
                            <label for="input1" class="col-form-label">Days needed to set up joint account</label>
                            <input type="number" min="0" disabled  id="joint_account_days" name="joint_account_days" required class="form-control">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="input1" class="col-form-label">Cost for joint account if any($)</label>
                            <div class="row">
                                <div class="col-md-5">
                                    <input type="number" disabled min="0"  id="joint_account_cost_from" name="joint_account_cost_from" required class="form-control">
                                </div>
                                    <span>-</span>
                                <div class="col-md-5">
                                    <input type="number" disabled min="0"  id="joint_account_cost_to" name="joint_account_cost_to" required class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="input1" class="col-form-label">Interest calculated by</label>
                            <select required name="interest_calculated_by" id="interest_calculated_by" class="form-control">
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
                            <input type="number" min="0"  name="quantum" required class="form-control">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-5">
                            <label for="input1" class="col-form-label">Interest (flat) % P.a</label>
                            <input type="number" min="0"  required name="interest_flat_pa" class="form-control interest_flat" id="interest_flat_pa">
                        </div>
                        <div class="form-group col-md-2 d-flex pt-4 justify-content-center align-items-center">
                            <h6 class="">or</h6>
                        </div>
                        <div class="form-group col-md-5">
                            <label for="input2" class="col-form-label">Interest (flat)  % P.m</label>
                            <input type="number" min="0"  required name="interest_flat_pm" class="form-control interest_flat" id="interest_flat_pm">
                        </div>
                    </div>
                    <!-- /1ST ROW -->
                    <!-- SEPRATER -->
                    <div class="row my-2">
                        <h5 class="m-0 mx-auto">OR</h5>
                    </div>
                    <!-- /SEPRATER -->

                    <!-- 2ND ROW -->
                    <div class="form-row">
                        <div class="form-group col-md-5">
                            <label for="input3" class="col-form-label">Interest (Reducing Balance) % P.a</label>
                            <input type="number" min="0"  required name="interest_reducing_pa" class="form-control interest_reducing_balance" id="interest_reducing_pa">
                        </div>
                        <div class="form-group col-md-2 d-flex pt-4 justify-content-center align-items-center">
                            <h6 class="">or</h6>
                        </div>
                        <div class="form-group col-md-5">
                            <label for="input4" class="col-form-label">Interest (Reducing Balance) % P.m</label>
                            <input type="number" min="0"  required name="interest_reducing_pm" class="form-control interest_reducing_balance" id="interest_reducing_pm">
                        </div>
                    </div>
                    {{-- <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="input3" class="col-form-label">Interest (Reducing Balance)</label>
                            <input type="text" class="form-control" id="input3">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="input4" class="col-form-label">% P.a &nbsp; or &nbsp; % P.m</label>
                            <input type="text" class="form-control" id="input4">
                        </div>
                    </div> --}}
                    <!-- /2ND ROW -->

                    <!-- SEPRATER -->
                    <div class="row my-2">
                        <h5 class="m-0 mx-auto">OR</h5>
                    </div>
                    <!-- /SEPRATER -->

                    <!-- 3RD ROW -->
                    <div class="form-row">
                        <div class="form-group col-md-5">
                            <label for="input5" class="col-form-label">Interest % P.a</label>
                            <input type="number" min="0"  required class="form-control interest_board_rate" name="interest_pa" id="interest_pa">
                        </div>
                        <div class="form-group col-md-2 d-flex pt-4 justify-content-center align-items-center">
                            <h6 class="">+</h6>
                        </div>
                        <div class="form-group col-md-5">
                            <label for="input5" class="col-form-label">Board rate of % P.a</label>
                            <input type="number" min="0"  required class="form-control interest_board_rate" name="board_rate_pa" id="board_rate_pa">
                        </div>
                    </div>
                    <!-- /3RD ROW -->

                    <!-- SEPRATER -->
                    <div class="row my-2">
                        <h5 class="m-0 mx-auto">OR</h5>
                    </div>
                    <!-- /SEPRATER -->

                    <!-- 4TH ROW -->
                    <div class="form-row">
                        <div class="form-group col-md-5">
                            <label for="input7" class="col-form-label">Flat free regardless of tenure $
                            </label>
                            <input type="number" min="0"  required name="flat_fee_value" class="form-control flat_fee_regardless" id="flat_fee_value">
                        </div>
                        <div class="form-group col-md-1 d-flex align-items-end justify-content-center">
                            <label for="input8" class="col-form-label">/</label>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="input8" class="col-form-label">Flat free regardless of tenure %</label>
                            <input type="number" min="0"  required name="flat_fee_percent" class="form-control flat_fee_regardless" id="flat_fee_percent">
                        </div>
                    </div>
                    <!-- /4TH ROW -->
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="input7" class="col-form-label">Tenure(optional for overdraft)</label>
                            <div class="row">
                                <div class="col-md-3">
                                    <input type="number" min="0"  class="form-control" required name="tenure_years" placeholder="Years" id="input7">
                                </div>
                                <div class="col-md-3">
                                    <input type="number" min="0"  class="form-control" required name="tenure_months" placeholder="Months" id="input7">
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="input7" class="col-form-label">Lock-in if any( please state final length free of any form of penalty)
                            </label>
                            <div class="row">
                                <div class="col-md-3">
                                    <input type="number" min="0"  required class="form-control" name="lock_in_years" placeholder="Years" id="input7">
                                </div>
                                <div class="col-md-3">
                                    <input type="number" min="0"  required class="form-control" name="lock_in_months" placeholder="Months" id="input7">
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                    
                <hr style=" background: grey;">
                <h5 class="">Fee section</h5><span>(Please indicate all fees incurred upfront/draw down only excluding e.g late fees)</span>


                    <div class="form-row">
                        <div class="col-md-6">
                            <label for="input7" class="col-form-label">One-time fee if any(processing/faculty/admin)
                            </label>
                            <div class="row d-flex">
                                <div class="col-md-3">
                                    <input type="number" min="0"  name="one_time_fee_value" class="form-control" placeholder="$" id="input7">
                                </div>
                                <div class="col-md-1">
                                    <span>or</span>
                                </div>
                                <div class="col-md-3">
                                    <input type="number" min="0"  name="one_time_fee_percent" class="form-control" placeholder="%" id="input7">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="input7" class="col-form-label">Monthly Fee if any
                            </label>
                            <div class="row d-flex">
                                <div class="col-md-3">
                                    <input type="number" min="0"  name="monthly_fee_value" class="form-control" placeholder="$" id="input7">
                                </div>
                                <div class="col-md-1">
                                    <span>or</span>
                                </div>
                                <div class="col-md-3">
                                    <input type="number" min="0"  name="monthly_fee_percent" class="form-control" placeholder="%" id="input7">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="input7" class="col-form-label">Annual Fee if any
                            </label>
                            <div class="row d-flex">
                                <div class="col-md-3">
                                    <input type="number" min="0"  name="annual_fee_value" class="form-control" placeholder="$" id="input7">
                                </div>
                                <div class="col-md-1">
                                    <span>or</span>
                                </div>
                                <div class="col-md-3">
                                    <input type="number" min="0"  name="annual_fee_percent" class="form-control" placeholder="%" id="input7">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="input7" class="col-form-label">Legal Fee if any
                            </label>
                            <div class="row d-flex">
                                <div class="col-md-3">
                                    <input type="number" min="0"  name="legal_fee_start_range" class="form-control" placeholder="$" id="input7">
                                </div>
                                <div class="col-md-1">
                                    <span>-</span>
                                </div>
                                <div class="col-md-3">
                                    <input type="number" min="0"  name="legal_fee_end_range" class="form-control" placeholder="$" id="input7">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="input7" class="col-form-label">If insurance required
                            </label>
                            <div class="row d-flex">
                                <div class="col-md-2">
                                    <input type="number" min="0"  name="if_insurance_start_value" class="form-control" placeholder="$" id="input7">
                                </div>
                                <div class="col-md-1">
                                    <span>-</span>
                                </div>
                                <div class="col-md-2">
                                    <input type="number" min="0"  name="if_insurance_end_value" class="form-control" placeholder="$" id="input7">
                                </div>
                                <div class="col-md-1">
                                    <span>or</span>
                                </div>
                                <div class="col-md-2">
                                    <input type="number" min="0"  name="if_insurance_start_percent" class="form-control" placeholder="%" id="input7">
                                </div>
                                <div class="col-md-1">
                                    <span>-</span>
                                </div>
                                <div class="col-md-2">
                                    <input type="number" min="0"  name="if_insurance_end_value" class="form-control" placeholder="%" id="input7">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-5">
                            <label for="input1" class="col-form-label">EIR % P.a (optional)</label>
                            <input type="number" min="0"  class="form-control" name="eir_pa" id="input1">
                        </div>
                        <div class="form-group col-md-2 d-flex pt-4 justify-content-center align-items-center">
                            <h6 class="">or</h6>
                        </div>
                        <div class="form-group col-md-5">
                            <label for="input2" class="col-form-label">EIR  % P.m (optional)</label>
                            <input type="number" min="0"  class="form-control w-100" name="eir_pm" id="input2">
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
                        <label for="input7" class="col-form-label">Deffered after
                        </label>
                        <input type="number" step="1" min="0"  required name="deffered_after" class="form-control" placeholder="Months" id="input7">
                    </div>
                    <div class="col-md-3">
                        <label for="input7" class="col-form-label">Balloon on
                        </label>
                        <input type="number" min="0"  required name="balloon_on" class="form-control" placeholder="Months" id="input7">
                    </div>
                    <div class="col-md-3">
                        <label for="input7" class="col-form-label">Quote is valid for(Days)
                        </label>
                        <input type="text" required name="quote_validity" class="form-control date-picker-quote" placeholder="Quote validity" id="input7">
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
                <!-- /SEC 1 -->

                {{-- <hr style=" background: grey;"> --}}

                <!-- SEC 2 -->
                {{-- <form action="">
                    <!-- 1ST ROW -->
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="input9" class="col-form-label">Interest (Reducing Balance)</label>
                            <input type="text" class="form-control" id="input9">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="input10" class="col-form-label">Years &nbsp; - &nbsp; Months</label>
                            <input type="text" class="form-control" id="input10">
                        </div>
                    </div>
                    <!-- /1ST ROW -->

                    <!-- 2ND ROW -->
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="input11" class="col-form-label">Look-in if any (please state final length free
                                of any form of
                                penalty)</label>
                            <input type="text" class="form-control" id="input11">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="input12" class="col-form-label">Years &nbsp; - &nbsp; Months</label>
                            <input type="text" class="form-control" id="input12">
                        </div>
                    </div>
                    <!-- /2ND ROW -->
                </form> --}}
                <!-- /SEC 2 -->
            </div>
            <!-- /FORM NO 1 -->

            <!-- FORM 2 -->
            {{-- <div class="container bg-white shadow py-3 mt-5" style="border-radius: 0.7rem;">
                <form action="">
                    <!-- 1ST ROW -->
                    <div class="form-row pl-3 pr-3">
                        <!-- 1ST COL -->
                        <div class="col-lg-2 col-md-2 col-sm-12 same-col">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios1"
                                    value="option1">
                                <label class="form-check-label" for="exampleRadios1">
                                    Fixed
                                </label>
                            </div>
                        </div>
                        <!-- /1ST COL -->

                        <!-- 2nd COL -->
                        <div class="col-lg-2 col-md-2 col-sm-12 same-col">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios2"
                                    value="option2">
                                <label class="form-check-label" for="exampleRadios2">
                                    Floating
                                </label>
                            </div>
                        </div>
                        <!-- /2nd COL -->

                        <!-- 3RD COL -->
                        <div class="col-lg-2 col-md-2 col-sm-12 same-col">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios3"
                                    value="option3">
                                <label class="form-check-label" for="exampleRadios3">
                                    Sibor
                                </label>
                            </div>
                        </div>
                        <!-- /3RD COL -->

                        <!-- 4TH COL -->
                        <div class="col-lg-2 col-md-2 col-sm-12 same-col">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios4"
                                    value="option4">
                                <label class="form-check-label" for="exampleRadios4">
                                    Sor
                                </label>
                            </div>
                        </div>
                        <!-- /4TH COL -->

                        <!-- 5TH COL -->
                        <div class="col-lg-2 col-md-2 col-sm-12 same-col">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios5"
                                    value="option5">
                                <label class="form-check-label" for="exampleRadios5">
                                    Sora
                                </label>
                            </div>
                        </div>
                        <!-- /5TH COL -->

                        <!-- 6TH COL -->
                        <div class="col-lg-2 col-md-2 col-sm-12 same-col">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios6"
                                    value="option6">
                                <label class="form-check-label" for="exampleRadios6">
                                    Board
                                </label>
                            </div>
                        </div>
                        <!-- /6TH COL -->
                    </div>
                    <!-- /1ST ROW -->

                    <!-- 2nd ROW -->
                    <div class="form-row pl-3 pr-3">
                        <!-- 1ST COL -->
                        <div class="col-lg-2 col-md-2 col-sm-12 same-col">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios7"
                                    value="option7">
                                <label class="form-check-label" for="exampleRadios7">
                                    Fixed Deposit
                                </label>
                            </div>
                        </div>
                        <!-- /1ST COL -->

                        <!-- 2nd COL -->
                        <div class="col-lg-2 col-md-2 col-sm-12 same-col">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios8"
                                    value="option8">
                                <label class="form-check-label" for="exampleRadios8">
                                    Libor
                                </label>
                            </div>
                        </div>
                        <!-- /2nd COL -->

                        <!-- 3RD COL -->
                        <div class="col-lg-2 col-md-2 col-sm-12 same-col">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios9"
                                    value="option9">
                                <label class="form-check-label" for="exampleRadios9">
                                    Hdb
                                </label>
                            </div>
                        </div>
                        <!-- /3RD COL -->

                        <!-- 4TH COL -->
                        <div class="col-lg-6 col-md-6 col-sm-12 same-col">
                            <div class="form-row">
                                <div class="col-sm-12 col-md-6 col-lg-6 same-col">
                                    <span class="col-form-label">Other publicaly available financial indicator</span>
                                </div>
                                <div class="col-sm-12 col-md-6 col-lg-6 same-col">
                                    <input type="text" class="form-control" id="input11">
                                </div>

                            </div>
                        </div>
                        <!-- /4TH COL -->

                    </div>
                    <!-- /2nd ROW -->

                    <!-- 3RD ROW -->
                    <div class="form-row pl-3 pr-3">
                        <div class="form-group col-md-6">
                            <label for="input12" class="col-form-label">Years &nbsp; - &nbsp; Months</label>
                            <input type="text" class="form-control" id="input12">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="input13" class="col-form-label">Current Value in %</label>
                            <input type="text" class="form-control" id="input13">
                        </div>
                    </div>
                    <!-- /3RD ROW -->

                    <!-- 4TH ROW -->
                    <div class="form-row pl-3 pr-3">
                        <div class="form-group col-md-4">
                            <label for="input14" class="col-form-label">Quantum &nbsp;$</label>
                            <input type="text" class="form-control" id="input14">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="input15" class="col-form-label">Tenure</label>
                            <input type="text" class="form-control" id="input15">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="input16" class="col-form-label">Years &nbsp; - &nbsp; Months</label>
                            <input type="text" class="form-control" id="input16">
                        </div>
                    </div>
                    <!-- /4TH ROW -->
                </form>
            </div> --}}
            <!-- /FORM 2 -->

            <!-- FORM 3 -->
            {{-- <div class="container bg-white shadow py-3 mt-5" style="border-radius: 0.7rem;">
                <form action="">
                    <!-- 1ST ROW -->
                    <div class="form-row pl-3 pr-3 my-3">
                        <div class="form-group col-md-6 d-flex">
                            <div class="s-content d-flex">
                                <label for="input17" class="col-form-label">1<sup>st</sup> Month -</label>
                                <input type="text" class="form-control s-input" id="input17">
                                <label for="input17" class="col-form-label">Month</label>
                            </div>
                            <div class="s-content d-flex">
                                <input type="text" class="form-control s-input" id="input18">
                                <label for="input18" class="col-form-label">% P.a</label>
                            </div>
                        </div>
                        <div class="form-group col-md-1">
                            <!-- SEPRATOR -->
                            <div class="row pt-2">
                                <h5 class="m-0">OR</h5>
                            </div>
                            <!--/SEPRATOR  -->
                        </div>

                        <div class="form-group col-md-5 d-flex">
                            <div class="s-content d-flex">
                                <label for="input19" class="col-form-label">yyy xxx +</label>
                                <input type="text" class="form-control s-input" id="input19">
                                <label for="input17" class="col-form-label">%</label>
                            </div>
                            <div class="s-content d-flex">
                                <span class="pt-2">=</span> <input type="text" class="form-control s-input" id="input20"
                                    readonly="true">
                                <label for="input20" class="col-form-label">% P.a</label>
                            </div>
                        </div>
                    </div>
                    <!-- /1ST ROW -->

                    <!-- 2ND ROW -->
                    <div class="form-row pl-3 pr-3 my-3">
                        <div class="form-group col-md-6 d-flex">
                            <div class="s-content d-flex">
                                <label for="input21" class="col-form-label">if any</label>
                                <input type="text" class="form-control s-input" id="input21">
                            </div>
                            <div class="s-content d-flex">
                                <label for="input22" class="col-form-label">Month -</label>
                                <input type="text" class="form-control s-input" id="input22">
                                <label for="input22" class="col-form-label">Month</label>
                            </div>
                            <div class="s-content d-flex">
                                <input type="text" class="form-control s-input" id="input23">
                                <label for="input23" class="col-form-label">% P.a</label>
                            </div>
                        </div>
                        <div class="form-group col-md-1">
                            <!-- SEPRATOR -->
                            <div class="row pt-2">
                                <h5 class="m-0">OR</h5>
                            </div>
                            <!--/SEPRATOR  -->
                        </div>
                        <div class="form-group col-md-5 d-flex">
                            <div class="s-content d-flex">
                                <label for="input24" class="col-form-label">yyy xxx +</label>
                                <input type="text" class="form-control s-input" id="input24">
                                <label for="input24" class="col-form-label">%</label>
                            </div>
                            <div class="s-content d-flex">
                                <span class="pt-2">=</span> <input type="text" class="form-control s-input" id="input25"
                                    readonly="true">
                                <label for="input25" class="col-form-label">% P.a</label>
                            </div>
                        </div>
                    </div>
                    <!-- /2ND ROW -->

                    <!-- 3RD ROW -->
                    <div class="form-row pl-3 pr-3 my-3">
                        <div class="form-group col-md-5 d-flex">
                            <div class="s-content d-flex">
                                <label for="input26" class="col-form-label">Thereafter if any</label>
                                <input type="text" class="form-control s-input" id="input26">
                                <label for="input27" class="col-form-label">% P.a</label>
                            </div>
                        </div>
                        <div class="form-group col-md-1">
                            <!-- SEPRATOR -->
                            <div class="row pt-2">
                                <h5 class="m-0">OR</h5>
                            </div>
                            <!--/SEPRATOR  -->
                        </div>
                        <div class="form-group col-md-4 d-flex">
                            <div class="s-content d-flex">
                                <label for="input19" class="col-form-label">yyy xxx +</label>
                                <input type="text" class="form-control s-input" id="input19">
                                <label for="input17" class="col-form-label">%</label>
                            </div>
                            <div class="s-content d-flex">
                                <span class="pt-2">=</span> <input type="text" class="form-control s-input" id="input20"
                                    readonly="true">
                                <label for="input20" class="col-form-label">% P.a</label>
                            </div>
                        </div>
                        <div class="col-md-2"></div>
                    </div>
                    <!-- /3RD ROW -->
                </form>
            </div> --}}
            <!-- /FORM 3 -->
        </div>
        <!-- container-fluid -->
    </div>
    <!-- content -->

    @include('admin.pages.footer')

</div>
@endsection