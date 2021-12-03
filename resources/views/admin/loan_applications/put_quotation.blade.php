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
                            <label class="custom-control-label" for="is_joint_account_required">If Joint
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
                    @php
                        $interest_calculated_list = interestCalculatedByList();
                    @endphp
                    <option value="">Select interest calculated by</option>
                    @foreach ($interest_calculated_list as $key=>$item)
                        @if (!$loop->first)
                            <option value="{{$key}}">{{$item}}</option>
                        @endif
                    @endforeach
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
                    <option value="I only">I only</option>
                    <option value="Front end">Front end</option>
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