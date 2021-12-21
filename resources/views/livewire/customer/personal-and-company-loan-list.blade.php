@if ($item2->quote_additional_doc->id == 99)
    <div class="col-md-12 px-0">
        <div class="container">
            <h6>
                Please list all of your personal outstanding loans & borrowing 
            </h6>

            <input type="checkbox" id="{{$item2->quote_additional_doc->id}}" wire:change="chk({{$item2->quote_additional_doc->id}})" wire:model="dont_have_doc.{{$item2->quote_additional_doc->id}}" class="mr-2"><label for="{{$item2->quote_additional_doc->id}}">Don't have this?</label>
            <div class="row">
                <div class="col-md-3">
                    <label for="">Bank / Financial Institution</label>
                    <input type="text" @if(isset($dont_have_doc[$item2->quote_additional_doc->id]) == true) disabled  @endif class="form-control" wire:model.defer="pl_bank_institution">
                </div>
                <div class="col-md-3">
                    <label for="">Type of Facility</label>
                    <input type="text" @if(isset($dont_have_doc[$item2->quote_additional_doc->id]) == true) disabled @else @endif class="form-control" wire:model.defer="pl_facility_type">
                </div>
                <div class="col-md-3">
                    <label for="">Original Loan amount </label>
                    <input type="number" min="0" @if(isset($dont_have_doc[$item2->quote_additional_doc->id]) == true) disabled @else @endif class="form-control" wire:model.defer="pl_original_loan_amount">
                </div>
                <div class="col-md-3">
                    <label for="">Interest per year</label>
                    <input type="number" min="0" @if(isset($dont_have_doc[$item2->quote_additional_doc->id]) == true) disabled @else @endif class="form-control" wire:model.defer="pl_interest_per_year">
                </div>
                <div class="col-md-3">
                    <label for="">Outstanding Loan Amount</label>
                    <input type="number" min="0" @if(isset($dont_have_doc[$item2->quote_additional_doc->id]) == true) disabled @else @endif class="form-control" wire:model.defer="pl_outstanding_loan_amount">
                </div>
                <div class="col-md-3">
                    <label for="">Monthly Installment Amount</label>
                    <input type="number" min="0" @if(isset($dont_have_doc[$item2->quote_additional_doc->id]) == true) disabled @else @endif class="form-control" wire:model.defer="pl_monthly_installment_amount">
                </div>
                <div class="col-md-3">
                    <label for="">Start Date MM/YY</label>
                    <input type="date" @if(isset($dont_have_doc[$item2->quote_additional_doc->id]) == true) disabled @else @endif class="form-control" wire:model.defer="pl_start_date">
                </div>
                <div class="col-md-3">
                    <label for="">Duration</label>
                    <input type="number" min="0" @if(isset($dont_have_doc[$item2->quote_additional_doc->id]) == true) disabled @else @endif class="form-control" wire:model.defer="pl_duration">
                </div>
            </div>
            <div class="mt-2">
                <button wire:click.prevent="addPersonalLoan({{$i}})" @if(isset($dont_have_doc[$item2->quote_additional_doc->id]) == true) disabled @else @endif class="btn btn-primary ">Add(+)</button>
            </div>    
        </div>
    </div>
    @foreach($personal_loan_list as $key => $value1)
    <div class="col-md-12 px-0">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <label for="">Bank / Financial Institution</label>
                    <input type="text" wire:model='personal_loan_list.{{$key}}.bank_institution' disabled class="form-control">
                </div>
                <div class="col-md-3">
                    <label for="">Type of Facility</label>
                    <input type="text" wire:model='personal_loan_list.{{$key}}.facility_type' disabled class="form-control">
                </div>
                <div class="col-md-3">
                    <label for="">Original Loan amount </label>
                    <input type="text" wire:model='personal_loan_list.{{$key}}.original_loan_amount' disabled class="form-control">
                </div>
                <div class="col-md-3">
                    <label for="">Interest per year</label>
                    <input type="text" wire:model='personal_loan_list.{{$key}}.interest_per_year' disabled class="form-control">
                </div>
                <div class="col-md-3">
                    <label for="">Outstanding Loan Amount</label>
                    <input type="text" wire:model='personal_loan_list.{{$key}}.outstanding_loan_amount' disabled class="form-control">
                </div>
                <div class="col-md-3">
                    <label for="">Monthly Installment Amount</label>
                    <input type="text" wire:model='personal_loan_list.{{$key}}.monthly_installment_amount' disabled class="form-control">
                </div>
                <div class="col-md-3">
                    <label for="">Start Date MM/YY</label>
                    <input type="text" wire:model='personal_loan_list.{{$key}}.start_date' disabled class="form-control ">
                </div>
                <div class="col-md-3">
                    <label for="">Duration</label>
                    <input type="text" wire:model='personal_loan_list.{{$key}}.duration' disabled class="form-control">
                </div>
            </div>
            <div class="mt-2">
                <button class="btn btn-danger btn-sm" wire:click.prevent="removePersonalLoan({{$key}})">remove</button>
            </div>    
        </div>
    </div>
    <hr>
    @endforeach
{{-- ---------------------------------------------------- --}}
@elseif($item2->quote_additional_doc->id == 4)
    <div class="col-md-12 px-0">
        <div class="container">
            <h6>
                Please list all of your company's outstanding loans & borrowing ( do not include personal )
            </h6>
            <input type="checkbox" id="{{$item2->quote_additional_doc->id}}" wire:change="chk({{$item2->quote_additional_doc->id}})" wire:model="dont_have_doc.{{$item2->quote_additional_doc->id}}" class="mr-2"><label for="{{$item2->quote_additional_doc->id}}">Don't have this?</label>
            <div class="row">
                <div class="col-md-3">
                    <label for="">Bank / Financial Institution</label>
                    <input type="text" @if(isset($dont_have_doc[$item2->quote_additional_doc->id]) == true) disabled  @endif class="form-control" wire:model.defer="cl_bank_institution">
                </div>
                <div class="col-md-3">
                    <label for="">Type of Facility</label>
                    <input type="text" @if(isset($dont_have_doc[$item2->quote_additional_doc->id]) == true) disabled @else @endif class="form-control" wire:model.defer="cl_facility_type">
                </div>
                <div class="col-md-3">
                    <label for="">Original Loan amount </label>
                    <input type="number" min="0" @if(isset($dont_have_doc[$item2->quote_additional_doc->id]) == true) disabled @else @endif class="form-control" wire:model.defer="cl_original_loan_amount">
                </div>
                <div class="col-md-3">
                    <label for="">Interest per year</label>
                    <input type="number" min="0" @if(isset($dont_have_doc[$item2->quote_additional_doc->id]) == true) disabled @else @endif class="form-control" wire:model.defer="cl_interest_per_year">
                </div>
                <div class="col-md-3">
                    <label for="">Outstanding Loan Amount</label>
                    <input type="number" min="0" @if(isset($dont_have_doc[$item2->quote_additional_doc->id]) == true) disabled @else @endif class="form-control" wire:model.defer="cl_outstanding_loan_amount">
                </div>
                <div class="col-md-3">
                    <label for="">Monthly Installment Amount</label>
                    <input type="number" min="0" @if(isset($dont_have_doc[$item2->quote_additional_doc->id]) == true) disabled @else @endif class="form-control" wire:model.defer="cl_monthly_installment_amount">
                </div>
                <div class="col-md-3">
                    <label for="">Start Date MM/YY</label>
                    <input type="text" @if(isset($dont_have_doc[$item2->quote_additional_doc->id]) == true) disabled @else @endif class="form-control " wire:model="cl_start_date">
                </div>
                <div class="col-md-3">
                    <label for="">Duration</label>
                    <input type="number" min="0" @if(isset($dont_have_doc[$item2->quote_additional_doc->id]) == true) disabled @else @endif class="form-control" wire:model.defer="cl_duration">
                </div>
            </div>
            <div class="mt-2">
                <button wire:click.prevent="addCompanyLoan({{$j}})" @if(isset($dont_have_doc[$item2->quote_additional_doc->id]) == true) disabled @else @endif class="btn btn-primary ">Add(+)</button>
            </div>    
        </div>
    </div>
    @foreach($company_loan_list as $key2 => $value2)
        <div class="col-md-12 px-0">
            <div class="container">
                <div class="row">
                    <div class="col-md-3">
                        <label for="">Bank / Financial Institution</label>
                        <input type="text" wire:model="company_loan_list.{{$key2}}.bank_institution" disabled class="form-control">
                    </div>
                    <div class="col-md-3">
                        <label for="">Type of Facility</label>
                        <input type="text" wire:model="company_loan_list.{{$key2}}.facility_type" disabled class="form-control">
                    </div>
                    <div class="col-md-3">
                        <label for="">Original Loan amount </label>
                        <input type="text" wire:model="company_loan_list.{{$key2}}.original_loan_amount" disabled class="form-control">
                    </div>
                    <div class="col-md-3">
                        <label for="">Interest per year</label>
                        <input type="text" wire:model="company_loan_list.{{$key2}}.interest_per_year" disabled class="form-control">
                    </div>
                    <div class="col-md-3">
                        <label for="">Outstanding Loan Amount</label>
                        <input type="text" wire:model="company_loan_list.{{$key2}}.outstanding_loan_amount" disabled class="form-control">
                    </div>
                    <div class="col-md-3">
                        <label for="">Monthly Installment Amount</label>
                        <input type="text" wire:model="company_loan_list.{{$key2}}.monthly_installment_amount" disabled class="form-control">
                    </div>
                    <div class="col-md-3">
                        <label for="">Start Date MM/YY</label>
                        <input type="text" wire:model="company_loan_list.{{$key2}}.start_date" disabled class="form-control ">
                    </div>
                    <div class="col-md-3">
                        <label for="">Duration</label>
                        <input type="text" wire:model="company_loan_list.{{$key2}}.duration" disabled class="form-control">
                    </div>
                </div>
                <div class="mt-2">
                    <button class="btn btn-danger btn-sm" wire:click.prevent="removeCompanyLoan({{$key2}})">remove</button>
                </div>    
            </div>
        </div>
    @endforeach
    <hr>
    @endif