@if ($item2->quote_additional_doc->id == 99)
    <div class="col-md-12">
        <div class="container">
            <h6>
                Please list all of your personal outstanding loans & borrowing 
            </h6>

            <input type="checkbox" id="{{$item2->quote_additional_doc->id}}" wire:change="chk({{$item2->quote_additional_doc->id}})" wire:model="dont_have_doc.{{$item2->quote_additional_doc->id}}" class="mr-2"><label for="{{$item2->quote_additional_doc->id}}">Don't have this?</label>
            <div class="row">
                <div class="col-md-3">
                    <label for="">Bank / Financial Institution</label>
                    <input type="text" @if(isset($dont_have_doc[$item2->quote_additional_doc->id]) == true) disabled  @endif class="form-control @error('pl_bank_institution') is-invalid @enderror" wire:model.defer="pl_bank_institution">

                </div>
                <div class="col-md-3">
                    <label for="">Type of Facility</label>
                    <input type="text" @if(isset($dont_have_doc[$item2->quote_additional_doc->id]) == true) disabled @else @endif class="form-control @error('pl_facility_type') is-invalid @enderror" wire:model.defer="pl_facility_type">

                </div>
                <div class="col-md-3">
                    <label for="">Original Loan amount </label>
                    <input type="number" min="0" @if(isset($dont_have_doc[$item2->quote_additional_doc->id]) == true) disabled @else @endif class="form-control @error('pl_original_loan_amount') is-invalid @enderror" wire:model.defer="pl_original_loan_amount">

                </div>
                <div class="col-md-3">
                    <label for="">Interest per year</label>
                    <input type="number" min="0" @if(isset($dont_have_doc[$item2->quote_additional_doc->id]) == true) disabled @else @endif class="form-control @error('pl_interest_per_year') is-invalid @enderror" wire:model.defer="pl_interest_per_year">

                </div>
                <div class="col-md-3">
                    <label for="">Outstanding Loan Amount</label>
                    <input type="number" min="0" @if(isset($dont_have_doc[$item2->quote_additional_doc->id]) == true) disabled @else @endif class="form-control @error('pl_outstanding_loan_amount') is-invalid @enderror" wire:model.defer="pl_outstanding_loan_amount">

                </div>
                <div class="col-md-3">
                    <label for="">Monthly Installment Amount</label>
                    <input type="number" min="0" @if(isset($dont_have_doc[$item2->quote_additional_doc->id]) == true) disabled @else @endif class="form-control @error('pl_monthly_installment_amount') is-invalid @enderror" wire:model.defer="pl_monthly_installment_amount">

                </div>
                <div class="col-md-3">
                    <label for="">Start Date MM/YY</label>
                    <input type="date" @if(isset($dont_have_doc[$item2->quote_additional_doc->id]) == true) disabled @else @endif class="form-control @error('pl_start_date') is-invalid @enderror" wire:model.defer="pl_start_date">

                </div>
                <div class="col-md-3">
                    <label for="">Duration</label>
                    <input type="number" min="0" @if(isset($dont_have_doc[$item2->quote_additional_doc->id]) == true) disabled @else @endif class="form-control @error('pl_duration') is-invalid @enderror" wire:model.defer="pl_duration">

                </div>
            </div>
            <div class="mt-2">
                <button wire:click.prevent="addPersonalLoan({{$i}})" @if(isset($dont_have_doc[$item2->quote_additional_doc->id]) == true) disabled @else @endif class="btn btn-primary ">Add(+)</button>
            </div>    
        </div>
    </div>
    @if (count($personal_loan_list) > 0)
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                    <div class="table-rep-plugin">
                        <div class="table-responsive b-0" data-pattern="priority-columns">
                            <table id="" class="table  table-striped">
                                <thead>
                                    <tr>
                                        <th>Bank/Financial Institution</th>
                                        <th>Type of Facility</th>
                                        <th>Original Loan amount</th>
                                        <th>Interest per year</th>
                                        <th>Outstanding Loan Amount</th>
                                        <th>Monthly Installment Amount</th>
                                        <th>Start Date MM/YY</th>
                                        <th>Duration</th>
                                        <th>Remove</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($personal_loan_list as $key => $value)
                                    <tr>
                                        <td>{{ $value['bank_institution'] }}</td>
                                        <td>{{ $value['facility_type'] }}</td>
                                        <td>{{ $value['original_loan_amount'] }}</td>
                                        <td>{{ $value['interest_per_year'] }}</td>
                                        <td>{{ $value['outstanding_loan_amount'] }}</td>
                                        <td>{{ $value['monthly_installment_amount'] }}</td>
                                        <td>{{ $value['start_date'] }}</td>
                                        <td>{{ $value['duration'] }}</td>
                                        <td><button class="btn btn-danger btn-sm" wire:click.prevent="removePersonalLoan({{$key}})">remove</button></td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
        </div>
    </div>
    <hr>
    @endif
    
{{-- ---------------------------------------------------- --}}
@elseif($item2->quote_additional_doc->id == 4)
    <div class="col-md-12">
        <div class="container">
            <h6>
                Please list all of your company's outstanding loans & borrowing ( do not include personal )
            </h6>
            <input type="checkbox" id="{{$item2->quote_additional_doc->id}}" wire:change="chk({{$item2->quote_additional_doc->id}})" wire:model="dont_have_doc.{{$item2->quote_additional_doc->id}}" class="mr-2"><label for="{{$item2->quote_additional_doc->id}}">Don't have this?</label>
            <div class="row">
                <div class="col-md-3">
                    <label for="">Bank / Financial Institution</label>
                    <input type="text" @if(isset($dont_have_doc[$item2->quote_additional_doc->id]) == true) disabled  @endif class="form-control @error('cl_bank_institution') is-invalid @enderror" wire:model.defer="cl_bank_institution">

                </div>
                <div class="col-md-3">
                    <label for="">Type of Facility</label>
                    <input type="text" @if(isset($dont_have_doc[$item2->quote_additional_doc->id]) == true) disabled @else @endif class="form-control @error('cl_facility_type') is-invalid @enderror" wire:model.defer="cl_facility_type">

                </div>
                <div class="col-md-3">
                    <label for="">Original Loan amount </label>
                    <input type="number" min="0" @if(isset($dont_have_doc[$item2->quote_additional_doc->id]) == true) disabled @else @endif class="form-control @error('cl_original_loan_amount') is-invalid @enderror" wire:model.defer="cl_original_loan_amount">

                </div>
                <div class="col-md-3">
                    <label for="">Interest per year</label>
                    <input type="number" min="0" @if(isset($dont_have_doc[$item2->quote_additional_doc->id]) == true) disabled @else @endif class="form-control @error('cl_interest_per_year') is-invalid @enderror" wire:model.defer="cl_interest_per_year">

                </div>
                <div class="col-md-3">
                    <label for="">Outstanding Loan Amount</label>
                    <input type="number" min="0" @if(isset($dont_have_doc[$item2->quote_additional_doc->id]) == true) disabled @else @endif class="form-control @error('cl_outstanding_loan_amount') is-invalid @enderror" wire:model.defer="cl_outstanding_loan_amount">

                </div>
                <div class="col-md-3">
                    <label for="">Monthly Installment Amount</label>
                    <input type="number" min="0" @if(isset($dont_have_doc[$item2->quote_additional_doc->id]) == true) disabled @else @endif class="form-control @error('cl_monthly_installment_amount') is-invalid @enderror" wire:model.defer="cl_monthly_installment_amount">

                </div>
                <div class="col-md-3">
                    <label for="">Start Date MM/YY</label>
                    <input type="date" @if(isset($dont_have_doc[$item2->quote_additional_doc->id]) == true) disabled @else @endif class="form-control @error('cl_start_date') is-invalid @enderror" wire:model="cl_start_date">

                </div>
                <div class="col-md-3">
                    <label for="">Duration</label>
                    <input type="number" min="0" @if(isset($dont_have_doc[$item2->quote_additional_doc->id]) == true) disabled @else @endif class="form-control @error('cl_duration') is-invalid @enderror" wire:model.defer="cl_duration">
                </div>
            </div>
            <div class="mt-2">
                <button wire:click.prevent="addCompanyLoan({{$j}})" @if(isset($dont_have_doc[$item2->quote_additional_doc->id]) == true) disabled @else @endif class="btn btn-primary ">Add(+)</button>
            </div>    
        </div>
    </div>

    @if (count($company_loan_list) > 0)
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                    <div class="table-rep-plugin">
                        <div class="table-responsive b-0" data-pattern="priority-columns">
                            <table id="" class="table  table-striped">
                                <thead>
                                    <tr>
                                        <th>Bank/Financial Institution</th>
                                        <th>Type of Facility</th>
                                        <th>Original Loan amount</th>
                                        <th>Interest per year</th>
                                        <th>Outstanding Loan Amount</th>
                                        <th>Monthly Installment Amount</th>
                                        <th>Start Date MM/YY</th>
                                        <th>Duration</th>
                                        <th>Remove</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($company_loan_list as $key => $value)
                                    <tr>
                                        <td>{{ $value['bank_institution'] }}</td>
                                        <td>{{ $value['facility_type'] }}</td>
                                        <td>{{ $value['original_loan_amount'] }}</td>
                                        <td>{{ $value['interest_per_year'] }}</td>
                                        <td>{{ $value['outstanding_loan_amount'] }}</td>
                                        <td>{{ $value['monthly_installment_amount'] }}</td>
                                        <td>{{ $value['start_date'] }}</td>
                                        <td>{{ $value['duration'] }}</td>
                                        <td><button class="btn btn-danger btn-sm" wire:click.prevent="removeCompanyLoan({{$key}})">remove</button></td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
        </div>
    </div>
    <hr>
    @endif

@endif