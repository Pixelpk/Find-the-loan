<div>
    @php
    $main_types = loanProfile();
    @endphp

    <section class="section-white pb-4" id="apply-loan">
        <div class="container">
            <div class="card" style="margin-top:30px;">
                <div class="card-body">
                    <ul class="nav nav-pills">
                        <li class="nav-item">
                            <a wire:click="$set('tab', '1')" style="padding: .1rem 1rem;"
                                class="nav-link {{ $tab == '1' ? 'active' : '' }}" aria-current="page" href="#">LOAN
                                TYPE</a>
                        </li>
                        <li class="nav-item">
                            <a wire:click="storeReasonLoanType" style="padding: .1rem 1rem;"
                                class="{{ !$main_type || sizeof($this->reasonValue) == 0 ? 'disabled' : '' }} nav-link {{ $tab == '8' ? 'active' : '' }}"
                                aria-current="page" href="#">LOAN TYPE DETAIL
                            </a>
                        </li>

                        @if($main_type == 1)
                        <li class="nav-item">
                            <a wire:click="$set('tab', '4')" style="padding: .1rem 1rem;"
                                class="{{ !$comDisable ? 'disabled' : '' }} nav-link {{ $tab == '4' ? 'active' : '' }}"
                                href="#">COMPANY DETAIL</a>
                        </li>
                        @if(!$this->listed_company_check)
                        <li class="nav-item">
                            <a wire:click="$set('tab', '5')" style="padding: .1rem 1rem;"
                                class="{{ !$documentDisable ? 'disabled' : '' }} nav-link {{ $tab == '5' ? 'active' : '' }}"
                                href="#">COMPANY DOCUMENTS</a>
                        </li>
                        @endif
                        @if(sizeof($get_share_holder_type) > 0 && !$this->listed_company_check)
                        <li class="nav-item">
                            <a wire:click="$set('tab', '7')" style="padding: .1rem 1rem;"
                                class="{{ !$shareDisable ? 'disabled' : '' }} nav-link {{ $tab == '7' ? 'active' : '' }}"
                                href="#">SHAREHOLDER</a>
                        </li>
                        {{-- @endif --}}
                        @endif
                        @elseif($main_type == 2)
                        <li class="nav-item">
                            <a wire:click="$set('tab', '10')" style="padding: .1rem 1rem;"
                                class="nav-link {{ $tab == '10' ? 'active' : '' }}" href="#">Consumer Detail</a>
                        </li>
                        @endif
                        @if(!$lenderflag)
                        <li class="nav-item">
                            <a style="padding: .1rem 1rem;" class="disabled nav-link {{ $tab == '9' ? 'active' : '' }}"
                                href="#">LENDER</a>
                        </li>
                        @elseif($lenderflag)
                        <li class="nav-item">
                            <a wire:click="$set('tab', '9')" style="padding: .1rem 1rem;"
                                class=" nav-link {{ $tab == '9' ? 'active' : '' }}" href="#">LENDER</a>
                        </li>
                        @endif
                        {{-- @endif --}}
                    </ul>
                    <br>
                    <br>
                    @if(session('gernalMessage'))
                    <div class="alert alert-danger" role="alert">
                        {{ session('gernalMessage') }}
                    </div>
                    @endif
                    <div wire:ignore>
                        <input type="hidden" class="form-control" id="ship-address">
                    </div>
                    @if($tab == 10)
                    @livewire('widget.personal-detail', ['loan_type_id' => $loan_type_id, "main_type" => $main_type,
                    'apply_loan' => $apply_loan])
                    @endif
                    @if($tab == 8 && $loan_type_id == 15)
                    @livewire('widget.renovation', ['loan_type_id' => $loan_type_id, "main_type" => $main_type,
                    'apply_loan' => $apply_loan])

                    @elseif($tab == 8 && $loan_type_id == 16)
                    @livewire('widget.property-loan', ['loan_type_id' => $loan_type_id, "main_type" => $main_type,
                    'apply_loan' => $apply_loan])

                    @elseif($tab == 8 && $loan_type_id == 12)

                    @livewire('widget.new-loan', ['loan_type_id' => $loan_type_id, "main_type" => $main_type,
                    'apply_loan' => $apply_loan])
                    @elseif($tab == 8 && $loan_type_id == 23)

                    @livewire('widget.new-loan', ['loan_type_id' => $loan_type_id, "main_type" => $main_type,
                    'apply_loan' => $apply_loan])
                    @elseif($tab == 8 && $loan_type_id == 13)

                    @livewire('widget.property-land-refinancing', ['loan_type_id' => $loan_type_id, "main_type" =>
                    $main_type,
                    'apply_loan' => $apply_loan,
                    'loan_type_id' => $loan_type_id
                    ])
                    @elseif($tab == 8 && $loan_type_id == 24)

                    @livewire('widget.property-land-refinancing', ['loan_type_id' => $loan_type_id, "main_type" =>
                    $main_type,
                    'apply_loan' => $apply_loan,
                    'loan_type_id' => $loan_type_id
                    ])
                    @elseif($tab == 8 && $loan_type_id == 14)

                    @livewire('widget.property-land-refinancing', ['loan_type_id' => $loan_type_id, "main_type" =>
                    $main_type,
                    'apply_loan' => $apply_loan,
                    'loan_type_id' => $loan_type_id
                    ])
                    @elseif($tab == 8 && $loan_type_id == 4)

                    @livewire('widget.project-finance', ['loan_type_id' => $loan_type_id, "main_type" => $main_type,
                    'apply_loan' => $apply_loan])
                    @elseif($tab == 8 && $loan_type_id == 1)

                    @livewire('widget.over-draft', ['loan_type_id' => $loan_type_id, "main_type" => $main_type,
                    'apply_loan' => $apply_loan])

                    @elseif($tab == 8 && $loan_type_id == 19)

                    @livewire('widget.over-draft', ['loan_type_id' => $loan_type_id, "main_type" => $main_type,
                    'apply_loan' => $apply_loan])

                    @elseif($tab == 8 && $loan_type_id == 7)

                    @livewire('cms.loan.business.loan-type.business-debt-consolidation', ['loan_type_id' =>
                    $loan_type_id, "main_type" => $main_type,
                    'apply_loan' => $apply_loan])
                    @elseif($tab == 8 && $loan_type_id == 20)

                    @livewire('cms.loan.business.loan-type.business-debt-consolidation', ['loan_type_id' =>
                    $loan_type_id, "main_type" => $main_type,
                    'apply_loan' => $apply_loan])
                    @elseif($tab == 8 && $loan_type_id == 5)

                    @livewire('cms.loan.business.loan-type.business-invoice-financing', ['loan_type_id' =>
                    $loan_type_id, "main_type" => $main_type,
                    'apply_loan' => $apply_loan])
                    @elseif($tab == 8 && $loan_type_id == 6)

                    @livewire('cms.loan.business.loan-type.business-purchase-order', ['loan_type_id' =>
                    $loan_type_id, "main_type" => $main_type,
                    'apply_loan' => $apply_loan])
                    @elseif($tab == 8 && $loan_type_id == 17)
                    @livewire('cms.loan.business.loan-type.property-bridging', ['loan_type_id' => $loan_type_id,
                    "main_type" => $main_type,
                    'apply_loan' => $apply_loan])
                    @elseif($loan_type_id == 9 || $loan_type_id == 10 || $loan_type_id == 11 || $loan_type_id == 21 ||
                    $loan_type_id == 22)
                    @if($tab == 8 && $apply_loan)
                    @livewire('cms.loan.business.loan-type.hire-purchase', ['loan_type_id' => $loan_type_id,
                    "main_type" => $main_type,
                    'apply_loan' => $apply_loan])
                    @endif
                    @endif
                    @if($tab == 1)
                    <div class="row g-3">
                        <div class="col-md-12">
                            <label for="">Select Borrower Profile</label>
                            <select wire:model="main_type" class="form-control mt-2" aria-label="Default select example"
                                wire:change="getMainType()">
                                <option value="">Select Borrower Profile</option>
                                <option value="1">Business</option>
                                <option value="2">Consumer</option>
                            </select>
                        </div>
                    </div>
                    @if(sizeof($mainTypes) > 0)
                    <div class="row mt-3">

                        @foreach($mainTypes as $item)
                        @if($item->subTypes->count() > 0)
                        <div class="col-md-4">
                            <div class="list-group">
                                <a href="#" class="custmbtn list-group-item list-group-item-action text-white">
                                    {{ $item->main_type }}
                                </a>
                                @foreach($item->subTypes as $key => $subType)
                                <a class="list-group-item list-group-item-action d-flex justify-content-between">
                                    <div class="form-check form-switch">
                                        <input wire:model="values.{{ $subType->id }}"
                                            wire:click="getLoanReason({{ $subType->id }}, {{ $key }})"
                                            class="form-check-input singleCheck" type="checkbox" />
                                        <label class="form-check-label">{{ $subType->sub_type }}</label>
                                    </div>
                                    <div class="tooltip-c">
                                       <i class="fa fa-info-circle"></i>
                                       <span class="tooltip-text">Hello World</span>
                                    </div>
                                </a>
                                @endforeach
                            </div>
                        </div>

                        @endif
                        @endforeach
                    </div>
                    <!-- /LOAN TYPES -->
                    @if(sizeof($loanReasons) > 0)
                    <div class="row">
                        <div class="col-md-12">
                            <br>
                            <br>
                            <hr>
                            <h5 class="mb-0">Reasons for loan</h5>
                            <p>(Please select any reason for the loan)</p>
                        </div>
                        @foreach($loanReasons as $key => $item)
                        <div class="col-md-4" style="margin-top: 30px;">
                            <div class="form-check form-switch">
                                <input wire:click="pushReason({{ $item->id }})" wire:model="reasonValue.{{ $item->id }}"
                                    class="form-check-input reasonCheck" type="checkbox" id="{{ $item->id }}" />
                                <label class="form-check-label" for="{{ $item->id }}">{{ $item->reason }}</label>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <div class="col-md-12 text-end">
                        <div>
                            <br>
                            <br>
                            <button class="btn" wire:click="storeReasonLoanType">Save & Continue</button>
                        </div>
                    </div>
                    @endif

                    @endif

                    @elseif($tab == 9)
                    @php $NFL = [1,2,3,4]
                    @endphp

                    <div class="row">
                        <div class="col-md-8">
                            @foreach($NFL as $item)
                            <div class="row">
                                <div class="col-md-8" style="margin-top: 30px;">
                                    <b>
                                        @if($item == 1)
                                        Bank
                                        @elseif($item == 2)
                                        Excluded Moneylender
                                        @elseif($item == 3)
                                        Fintech
                                        @else
                                        Moneylender
                                        @endif
                                    </b>
                                </div>
                                <div class="col-md-4" style="margin-top: 30px;">
                                    <div class="form-check">
                                        <input wire:model="checkSelect.{{ $item }}" wire:change="Selectall({{ $item }})"
                                            class="form-check-input" type="checkbox" value="" id="{{ $item }}">
                                        <label class="form-check-label" for="{{ $item }}">
                                            <b> Select All</b>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                @foreach($financePartners as $financePartner)
                                @if($financePartner->type == 1 && $item == 1)
                                <div class="col-md-4" style="margin-top:30px;">
                                    <div class="form-check">
                                        <input wire:model="lender.{{ $financePartner->id }}" class="form-check-input"
                                            type="checkbox" value="" id="{{ $financePartner->id }}">
                                        <label class="form-check-label" for="{{ $financePartner->id }}">
                                            <img for="{{ $financePartner->id }}"
                                                src="uploads/financePartnerImages/{{ $financePartner->image }}" alt=""
                                                width="80px" height="25px">
                                        </label>
                                    </div>
                                </div>
                                @elseif($financePartner->type == 2 && $item == 2)
                                <div class="col-md-4" style="margin-top:30px;">
                                    <div class="form-check">
                                        <input wire:model="lender.{{ $financePartner->id }}" class="form-check-input"
                                            type="checkbox" value="" id="{{ $financePartner->id }}">
                                        <label class="form-check-label" for="{{ $financePartner->id }}">
                                            <img for="{{ $financePartner->id }}"
                                                src="uploads/financePartnerImages/{{ $financePartner->image }}" alt=""
                                                width="80px" height="25px">
                                        </label>
                                    </div>
                                </div>
                                @elseif($financePartner->type == 3 && $item == 3)
                                <div class="col-md-4" style="margin-top:30px;">
                                    <div class="form-check">
                                        <input wire:model="lender.{{ $financePartner->id }}" class="form-check-input"
                                            type="checkbox" value="" id="{{ $financePartner->id }}">
                                        <label class="form-check-label" for="{{ $financePartner->id }}">
                                            <img for="{{ $financePartner->id }}"
                                                src="uploads/financePartnerImages/{{ $financePartner->image }}" alt=""
                                                width="80px" height="25px">
                                        </label>
                                    </div>
                                </div>
                                @elseif($financePartner->type == 4 && $item == 4)
                                <div class="col-md-4" style="margin-top:30px;">
                                    <div class="form-check">
                                        <input wire:model="lender.{{ $financePartner->id }}" class="form-check-input"
                                            type="checkbox" value="" id="{{ $financePartner->id }}">
                                        <label class="form-check-label" for="{{ $financePartner->id }}">
                                            <img for="{{ $financePartner->id }}"
                                                src="uploads/financePartnerImages/{{ $financePartner->image }}" alt=""
                                                width="80px" height="25px">
                                        </label>
                                    </div>
                                </div>
                                @endif
                                @endforeach
                            </div>
                            @endforeach
                        </div>
                        <div class="col-md-4">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-check form-switch">
                                        <input wire:change="getCbsLender()" wire:model="cbs_member"
                                            class="form-check-input" type="checkbox" id="flexSwitchCheckChecked4">
                                        <label class="form-check-label" for="flexSwitchCheckChecked4">Show only CBS
                                            members</label>
                                    </div>
                                    <br>
                                </div>
                                @if($cbs_member)
                                <div class="col-md-6">
                                    <p>
                                        <b>CBS</b>(Downloaded Within The Last 30 days)

                                    </p>
                                </div>
                                <div class="col-md-6">
                                    <input wire:model="cbs_member_image"
                                        accept="image/jpeg,image/gif,image/png,application/pdf,image/x-eps" type="file"
                                        id="vehicleimage">
                                    @error('cbs_member_image')
                                    <div style="color:red;">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                @endif
                                <div class="col-md-12">
                                    <br>
                                    <div class="form-check form-switch">
                                        <input wire:model="financial_institute" class="form-check-input" type="checkbox"
                                            id="flexSwitchCheckChecked4">
                                        <label class="form-check-label" for="flexSwitchCheckChecked4"> <b>Show only
                                                Enterprise Financing
                                                Scheme Participating Financial Institutes</b></label>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="col-md-12">
                            <br>
                            <button wire:loading.attr='disabled' class="btn" type="button" wire:target='storeLender'
                                wire:click.prevent='storeLender'>
                                <div wire:loading wire:target="storeLender">
                                    <span class="spinner-border spinner-border-sm" role="status"
                                        aria-hidden="true"></span>
                                </div>
                                Submit
                            </button>
                        </div>

                    </div>



                    @elseif($tab == 3)
                    <div class="row">
                        <div class="col-md-12" style="margin-top: 30px;">
                            <label for="amount" class="form-label">AMOUNT</label>
                            <input wire:model="amount" type="number" class="form-control" id="amount">
                            @if(session('sessionMessage'))
                            <div style="color:red;">
                                {{ session('sessionMessage') }}
                            </div>
                            @endif
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <br>
                            <button wire:loading.attr='disabled' class="btn" type="button" wire:target='companyDetail'
                                wire:click.prevent='companyDetail'>
                                <div wire:loading wire:target="companyDetail">
                                    <span class="spinner-border spinner-border-sm" role="status"
                                        aria-hidden="true"></span>
                                </div>
                                Save & Continue
                            </button>

                        </div>
                    </div>
                    @elseif($tab == 4)

                    <div class="row mt-3">
                        <div class="col-md-12">
                            <div class="form-check form-switch">
                                <input wire:model="listed_company_check" class="form-check-input" type="checkbox"
                                    id="flexSwitchCheckDefault">
                                <label class="form-check-label" for="flexSwitchCheckDefault">This is a listed
                                    company</label>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3">
                        @if(!$listed_company_check)
                      
                        <div class="col-md-5">
                            <p> When was the company incorporated?</p>
                      <div class="row">
                          <div class="col-md-6">
                            <div class="input-group">
                                {{-- <label for="">Year</label> --}}
                                <select wire:model="company_years" class="form-select"
                                    aria-label="Default select example" wire:change="getnoofYear()">
                                    <option value="" hidden>Select</option>
                                    @for ($x = 1990; $x <= date('Y'); $x++) <option value="{{ $x }}">{{ $x }}</option>
                                        @endfor
                                </select>
                                &nbsp;&nbsp;<p class="pt-2">Year</p>

                            </div>
                            @error('company_years')
                            <div style="color: red;">
                                {{ $message }}
                            </div>
                            @enderror
                          </div>
                          <div class="col-md-6">
                            <div class="input-group">
                                <select wire:model="company_months" class="form-select"
                                    aria-label="Default select example" wire:change="getnoofYear()">
                                    <option value="" hidden>Select</option>
                                    @for ($x = 01; $x <= 11; $x++) <option value="{{ $x }}">{{ $x }}</option>
                                        @endfor
                                </select>
                                &nbsp;&nbsp;<p class="pt-2">Month</p>
                                @error('company_months')
                                <div style="color: red;">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                          </div>
                      </div>
                        </div>
<div class="col-md-2 d-flex align-items-end justify-content-center">
    <p class="fw-bold">or</p>
</div>
                        <div class="col-md-5">
                            <p>How long has the company been in
                                business?</p>
                            <div class="row ">
                                <div class="col-md-6">
                                    <div class="input-group">
                                        <input wire:keyup="resetComapny" placeholder="No of years" wire:model="company_year"
                                            type="number" class="form-control" aria-label="Text input with dropdown button">
                                        &nbsp;&nbsp;<p class="pt-2">Years</p>
                                    </div>
                                    @error('company_year')
                                    <div style="color: red;">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <div class="input-group">
                                        <input wire:keyup="resetComapny" placeholder="No of months"
                                            wire:model="company_month" type="number" class="form-control"
                                            aria-label="Text input with dropdown button">
                                        &nbsp;&nbsp;<p class="pt-2">Months</p>
                                    </div>
                                    @error('company_month')
                                    <div style="color: red;">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
      

                    <div class="row mt-3">
                        <div class="col-md-6">
                            <label for="percentage_shareholder" class="form-label">% of local shareholding
                            </label>
                            <div class="input-group">
                                <div class="input-group-prepend">

                                </div>
                                <input wire:model="percentage_shareholder" type="number" class="form-control"
                                    id="percentage_shareholder">
                                <div class="input-group-append">
                                    <span class="input-group-text">%</span>
                                </div>
                            </div>

                            @error('percentage_shareholder')
                            <div style="color: red;">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="number_of_share_holder" class="form-label">Number of shareholder including
                                parent
                                company if any
                            </label>
                            <input max="10" wire:model="number_of_share_holder" type="number" class="form-control"
                                id="number_of_share_holder">
                            @error('number_of_share_holder')
                            <div style="color: red;">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>

                    <div class="row mt-3">
                    <div class="col-md-6">
                        <label class="form-label">Select company structure type</label>
                        <select wire:model="company_structure_type_id" class="form-select"
                            aria-label="Default select example">
                            <option value="" hidden>Select</option>
                            @foreach($company_structure_types as $item)
                            <option value="{{ $item->id }}">{{ $item->structure_type }}</option>
                            @endforeach
                        </select>
                        @error('company_structure_type_id')
                        <div style="color: red;">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" for="">Select sector</label>
                        <select wire:model="sector_id" class="form-select" aria-label="Default select example">
                            <option value="" hidden>Select</option>
                            @foreach($sectors as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                        @error('sector_id')
                        <div style="color: red;">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    </div>

                    <div class="row mt-3">
                    <div class="col-md-6">
                        <label for="number_of_employees" class="form-label">Number of full-time employee
                        </label>
                        <input wire:model="number_of_employees" type="number" class="form-control"
                            id="number_of_employees">
                        @error('number_of_employees')
                        <div style="color: red;">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="revenue" class="form-label">Revenue (rounded up is fine)</label>
                        <div class="input-group">
                            <input placeholder="$" wire:model="revenue" type="number" class="form-control"
                                aria-label="Text input with dropdown button">
                        </div>
                        @error('revenue')
                        <div style="color: red;">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-md-6">
                        <label for="company_name" class="form-label">Company Name</label>
                        <input wire:model="company_name" type="text" class="form-control" id="company_name">
                        @error('company_name')
                        <div style="color: red;">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="website" class="form-label">Company website (if available)</label>
                        <input wire:model="website" type="text" class="form-control" id="website">
                        @error('website')
                        <div style="color: red;">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>

                    @else
                    <div class="row mt-3">
                    <div class="col-md-12">
                        <label for="company_name" class="form-label">Please provide either parent company name or
                            its ticker number followed by which stock exchange</label>
                        <input wire:model="company_name" type="text" class="form-control" id="company_name">
                        @error('company_name')
                        <div style="color: red;">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="company_name" class="form-label">Country</label>
                            <select wire:model="country" class="form-select" aria-label="Default select example">
                                <option value="" hidden>Select</option>
                                @foreach($countries as $country)
                                <option value="{{ $country }}">{{ $country }}</option>
                                @endforeach
                            </select>
                            @error('country')
                            <div style="color: red;">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-md-4 text-left">
                        <div x-data="{ isUploading: false, progress: 0 }"
                            x-on:livewire-upload-start="isUploading = true"
                            x-on:livewire-upload-finish="isUploading = false"
                            x-on:livewire-upload-error="isUploading = false"
                            x-on:livewire-upload-progress="progress = $event.detail.progress">
                            <div class="form-group">

                                <label class="control-label mb-10">
                                    Subsidiary’s (borrower)M&AA
                                </label>
                                <br>
                                <br>
                                <label wire:ignore class="label" data-toggle="tooltip" title="Select Image">
                                    <input wire:model="subsidiary"
                                        accept="image/jpeg,image/gif,image/png,application/pdf,image/x-eps" type="file"
                                        id="vehicleimage">
                                </label>
                            </div>
                            @error('subsidiary')
                            <div style="color: red;">
                                {{ $message }}
                            </div>
                            @enderror
                            <div x-show="isUploading">
                                <progress max="100" x-bind:value="progress"></progress>
                            </div>
                        </div>
                    </div>
                </div>
                    @endif
                <!-- </div> -->
                <div class="row">
                    <div class="col-12">
                        <br>
                        <button class="btn" type="button" wire:target='confirmationMessage'
                            wire:click.prevent='confirmationMessage'>
                            <div wire:loading wire:target="confirmationMessage">
                                <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                            </div>
                            Save & Continue
                        </button>

                    </div>
                </div>
                @elseif($tab == 5)
                @if(!$listed_company_check)
                <div class="row">
                    <div class="col-md-12" style="margin-top: 30px;">
                        <b>6 months latest bank statement</b>
                        <p>If It’s on or Over The 8th Of The Current Month For Example 8th Jan, You Would Need To
                            Submit
                            from Dec And Not Nov As The Latest Months. For companies less than 6 months old or
                            unprofitable do check out our FAQ here.</p>
                    </div>

                    @for ($x = 1; $x < 8; $x++) <div class="col-md-3" style="margin-top: 30px;">
                        @php $montName = date("M", strtotime( date( 'Y-m-01' )." -$x months")) @endphp

                        <livewire:widget.upload-component :label="$montName" :keyvalue="$montName" :key="$montName"
                            :getImages="$images" :apply_loan="$apply_loan" :main_type="$main_type"
                            :loan_type_id="$loan_type_id" :share_holder="0" :modell="'\App\Models\LoanStatement'" />

                </div>
                @endfor

                <b><br>OR</b>
                <div class="row">
                    <div class="col-md-12" style="margin-top: 30px;">

                        <b>Consolidated Statement.</b>
                        <p>If Your Statement Is Not Spilt Between Months But One</p>
                    </div>
                    <div class="col-md-4 text-left">
                        <livewire:widget.upload-component :label="''" :apply_loan="$apply_loan" :main_type="$main_type"
                            :loan_type_id="$loan_type_id" :share_holder="0" :modell="'\App\Models\LoanCompanyDetail'"
                            :keyvalue="'parent_company_combine_statement'" />

                    </div>
                </div>
                <hr>
                <div class="row">

                    <div class="col-md-12" style="margin-top: 30px;">
                        <b>Latest {{ $getNumberOfCompanyYears >= 3 ? '2' : '1' }} Years Financial Statement</b>
                        <p>
                            (Income Statement also known as Profit & Loss
                            + Statement of financial position also known as Balance Sheet)
                        </p>
                    </div>
                    <div class="col-md-4 text-left" style="margin-top: 30px;">
                        <livewire:widget.upload-component :label="'Latest year'" :apply_loan="$apply_loan"
                            :main_type="$main_type" :loan_type_id="$loan_type_id" :share_holder="0"
                            :modell="'\App\Models\LoanCompanyDetail'"
                            :keyvalue="'parent_company_latest_year_statement'" />

                    </div>
                    @if($getNumberOfCompanyYears >= 3)
                    <div class="col-md-3 text-left" style="margin-top: 30px;">
                        <livewire:widget.upload-component :label="'Before year'" :apply_loan="$apply_loan"
                            :main_type="$main_type" :loan_type_id="$loan_type_id" :share_holder="0"
                            :modell="'\App\Models\LoanCompanyDetail'"
                            :keyvalue="'parent_company_before_year_statement'" />

                    </div>
                    @endif
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-12" style="margin-top: 30px;">
                        <b>Profitable for the last 2 accounting years</b>
                    </div>
                    <div class="col-md-4" style="margin-top: 30px;">
                        <div class="form-group">
                            <select wire:model="profitable_latest_year" class="form-select"
                                aria-label="Default select example">
                                <option value="" hidden>Select</option>
                                <option value="1">Yes</option>
                                <option value="0">No</option>
                            </select>
                            @error('profitable_latest_year')
                            <div style="color: red;">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4" style="margin-top: 30px;">
                        <div class="form-group">
                            <select wire:model="profitable_before_year" class="form-select"
                                aria-label="Default select example">
                                <option value="" hidden>Select</option>
                                <option value="1">Yes</option>
                                <option value="0">No</option>
                            </select>
                            @error('profitable_before_year')
                            <div style="color: red;">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>

                </div>
                <hr>
                <div class="row">
                    <div class="col-md-12" style="margin-top: 30px;">
                        <b style="color: grey;">Optional info</b>
                    </div>
                    <div class="col-md-12" style="margin-top: 30px;">
                        <b>Current Year.</b>
                        <p>If you are <b>more than 3-6 months into your current accounting year,</b> and if your
                            management account(drafts/unaudited) pulls up the average, providing them may be helpful
                        </p>
                    </div>
                    <div class="col-md-3 text-left">
                        <livewire:widget.upload-component :label="''" :apply_loan="$apply_loan" :main_type="$main_type"
                            :loan_type_id="$loan_type_id" :share_holder="0" :modell="'\App\Models\LoanCompanyDetail'"
                            :keyvalue="'parent_company_current_year_statement'" />

                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12" style="margin-top: 30px;">
                        <b>Revenue (rounded up is fine)</b>
                    </div>
                    <div class="col-md-3" style="margin-top: 30px;">
                        <div class="form-group">
                            <input type="number" class="form-control" wire:model="optional_revenuee">
                            @error('optional_revenuee')
                            <div style="color: red;">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                </div>
                <hr>
                <div class="col-12">
                    <br>
                    <button class="btn" type="button" wire:target='saveCompanyDocuments'
                        wire:click.prevent='saveCompanyDocuments'>
                        <span wire:loading wire:target="saveCompanyDocuments" class="spinner-border spinner-border-sm"
                            role="status" aria-hidden="true"></span>
                        Save & Continue
                    </button>
                </div>
            </div>
            @endif

            @elseif($tab == 7)
            @php $srno = 1; @endphp
            @php $no = 1; @endphp
            <div class="row">
                @foreach($get_share_holder_type as $key => $item)
                <div class="col-md-6" style="margin-top: 40px;">
                    <div class="form-check form-switch">
                        <label class="form-check-label" for="flexSwitchCheckDefault">Shareholder {{ $key++ }}
                        </label>
                    </div>
                </div>
                <div class="col-md-6">

                    <div class="form-check" style="margin-top: 40px;">
                        <select wire:model="checkShareHolder.{{ $item['id'] }}"
                            wire:change="getShareholderTypeId({{ $item['id'] }})">
                            <option value="0">Person</option>
                            <option value="1">Company</option>
                        </select>

                    </div>

                </div>
                @endforeach
            </div>

            <div id="accordion" style="margin-top: 30px;">
                @foreach($get_share_holder_type as $key => $item)
                @if($item['share_holder_type'] == 1)
                <div class="card">
                    @php $shreholder = $item['id'] @endphp
                    <div class="card-header" id="{{ $shreholder }}" style="padding:10px;">
                        <h5 class="mb-0">
                            <button class="btn btn-link" data-toggle="collapse"
                                data-target="#collapseOne{{ $shreholder }}" aria-expanded="true"
                                aria-controls="collapseOne{{ $shreholder }}">
                                Shareholder Person {{ $key++ }}
                            </button>
                        </h5>
                    </div>
                    <div wire:ignore.self style="margin-top: 30px;" id="collapseOne{{ $shreholder }}"
                        class="collapse {{  $key == 0 ? 'show' : '' }}" aria-labelledby="{{ $shreholder }}"
                        data-parent="#accordion">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <b>NRIC</b> or <b>Passport/Identity Card</b> ( Foreigner)
                                </div>
                                <div class="col-md-3 text-left" style="margin-top: 30px;">
                                    <div x-data="{ isUploading: false, progress: 0 }"
                                        x-on:livewire-upload-start="isUploading = true"
                                        x-on:livewire-upload-finish="isUploading = false"
                                        x-on:livewire-upload-error="isUploading = false"
                                        x-on:livewire-upload-progress="progress = $event.detail.progress">
                                        <div class="form-group">
                                            <br>
                                            <label for="">NRIC Front</label>
                                            <input wire:model="nric_front.{{ $shreholder }}"
                                                accept="image/jpeg,image/gif,image/png,application/pdf,image/x-eps"
                                                type="file" id="vehicleimage" name="" id="">
                                            </label>
                                        </div>
                                        @error("nric_front.$shreholder")
                                        <div style="color: red;">
                                            @php $message = preg_replace('/[0-9]+/', '', $message); @endphp
                                            {{ $message }}
                                        </div>
                                        @enderror
                                        <div x-show="isUploading">
                                            <progress max="100" x-bind:value="progress"></progress>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 text-left" style="margin-top: 30px;">
                                    <div x-data="{ isUploading: false, progress: 0 }"
                                        x-on:livewire-upload-start="isUploading = true"
                                        x-on:livewire-upload-finish="isUploading = false"
                                        x-on:livewire-upload-error="isUploading = false"
                                        x-on:livewire-upload-progress="progress = $event.detail.progress">
                                        <div class="form-group">
                                            <br>
                                            <label for="">NRIC Back</label>
                                            <input wire:model="nric_back.{{ $shreholder }}"
                                                accept="image/jpeg,image/gif,image/png,application/pdf,image/x-eps"
                                                type="file" id="vehicleimage" name="" id="">
                                            </label>
                                        </div>
                                        @error("nric_back.$shreholder")
                                        <div style="color: red;">
                                            @php $message = preg_replace('/[0-9]+/', '', $message); @endphp
                                            {{ $message }}
                                        </div>
                                        @enderror
                                        <div x-show="isUploading">
                                            <progress max="100" x-bind:value="progress"></progress>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 text-left" style="margin-top: 30px;">
                                    <div x-data="{ isUploading: false, progress: 0 }"
                                        x-on:livewire-upload-start="isUploading = true"
                                        x-on:livewire-upload-finish="isUploading = false"
                                        x-on:livewire-upload-error="isUploading = false"
                                        x-on:livewire-upload-progress="progress = $event.detail.progress">
                                        <div class="form-group">
                                            <br>
                                            <label for="">Passport</label>
                                            <input wire:model="passport.{{ $shreholder }}"
                                                accept="image/jpeg,image/gif,image/png,application/pdf,image/x-eps"
                                                type="file" id="vehicleimage" name="" id="">
                                            </label>
                                        </div>
                                        @error("passport.$shreholder")
                                        <div style="color: red;">
                                            @php $message = preg_replace('/[0-9]+/', '', $message); @endphp
                                            {{ $message }}
                                        </div>
                                        @enderror
                                        <div x-show="isUploading">
                                            <progress max="100" x-bind:value="progress"></progress>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12" style="margin-top: 30px;">
                                    <b>Personal NOA</b>
                                    <p>(Notice of Assessment) 2 Years</p>
                                </div>
                                <div class="col-md-3 text-left" style="margin-top: 30px;">
                                    <div x-data="{ isUploading: false, progress: 0 }"
                                        x-on:livewire-upload-start="isUploading = true"
                                        x-on:livewire-upload-finish="isUploading = false"
                                        x-on:livewire-upload-error="isUploading = false"
                                        x-on:livewire-upload-progress="progress = $event.detail.progress">
                                        <div class="form-group">
                                            <br>
                                            <label for="">Latest</label>
                                            <input wire:model="nao_latest.{{ $shreholder }}"
                                                accept="image/jpeg,image/gif,image/png,application/pdf,image/x-eps"
                                                type="file" id="vehicleimage" name="" id="">
                                            </label>
                                        </div>
                                        @error("nao_latest.$shreholder")
                                        <div style="color: red;">
                                            @php $message = preg_replace('/[0-9]+/', '', $message); @endphp
                                            {{ $message }}
                                        </div>
                                        @enderror
                                        <div x-show="isUploading">
                                            <progress max="100" x-bind:value="progress"></progress>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 text-left" style="margin-top: 30px;">
                                    <div x-data="{ isUploading: false, progress: 0 }"
                                        x-on:livewire-upload-start="isUploading = true"
                                        x-on:livewire-upload-finish="isUploading = false"
                                        x-on:livewire-upload-error="isUploading = false"
                                        x-on:livewire-upload-progress="progress = $event.detail.progress">
                                        <div class="form-group">
                                            <br>
                                            <label for="">Older</label>
                                            <input wire:model="nao_older.{{ $shreholder }}"
                                                accept="image/jpeg,image/gif,image/png,application/pdf,image/x-eps"
                                                type="file" id="vehicleimage" name="" id="">
                                            </label>
                                        </div>
                                        @error("nao_older.$shreholder")
                                        <div style="color: red;">
                                            @php $message = preg_replace('/[0-9]+/', '', $message); @endphp
                                            {{ $message }}
                                        </div>
                                        @enderror
                                        <div x-show="isUploading">
                                            <progress max="100" x-bind:value="progress"></progress>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12" style="margin-top: 30px;">
                                    <b>I don't have income proof because i am</b>
                                </div>
                                <div class="col-md-4" style="margin-top:30px;">
                                    <select class="form-control" name="" id=""
                                        wire:model.defer="not_proof.{{ $shreholder }}">
                                        <option value="" hidden>Select</option>
                                        <option value="1">Student</option>
                                        <option value="2">Homemaker</option>
                                        <option value="3">Retired</option>
                                        <option value="4">Unemployed</option>
                                    </select>
                                    @error("not_proof.$shreholder")
                                    <div style="color: red;">
                                        @php $message = preg_replace('/[0-9]+/', '', $message); @endphp
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <br>
                                    <button class="btn" type="button" wire:target='share_holder_document_store'
                                        wire:click.prevent='share_holder_document_store({{ $item[' id'] }})'>
                                        <span wire:loading wire:target="share_holder_document_store"
                                            class="spinner-border spinner-border-sm" role="status"
                                            aria-hidden="true"></span>
                                        Save & Continue
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @else
                <div class="card">
                    @php $shreholder = $item['id'] @endphp
                    <div class="card-header" id="{{ $shreholder }}" style="padding:10px;">
                        <h5 class="mb-0">
                            <button class="btn btn-link" data-toggle="collapse"
                                data-target="#collapseOne{{ $shreholder }}" aria-expanded="true"
                                aria-controls="collapseOne{{ $shreholder }}">
                                Shareholder Company {{ $key++ }}
                            </button>
                        </h5>
                    </div>
                    <div wire:ignore.self id="collapseOne{{ $shreholder }}" class="collapse"
                        aria-labelledby="{{ $shreholder }}" data-parent="#accordion">
                        <div class="card-body">
                            <ul class="nav nav-pills">


                                <li class="nav-item">
                                    <a wire:click="$set('subtab', '1')" style="padding: .1rem 1rem;"
                                        class="nav-link {{ $subtab == '1' ? 'active' : '' }}" href="#">SHAREHOLDER
                                        COMPANY
                                        DETAIL</a>
                                </li>
                                @if(!$chklsit[$shreholder])
                                <li class="nav-item">
                                    <a wire:click="$set('subtab', '2')" style="padding: .1rem 1rem;"
                                        class="{{ !$shareholderCompany ? 'disabled' : '' }} nav-link {{ $subtab == '2' ? 'active' : '' }}"
                                        href="#">SHAREHOLDER
                                        COMPANY
                                        DOCUMENTS</a>
                                </li>
                                @endif



                            </ul>
                            @if($subtab == 1)
                            <div class="row">
                                <div class="col-md-12">
                                    <br>
                                    <br>
                                    <div class="form-check form-switch">
                                        <input wire:change="get_company_listed({{ $shreholder }})"
                                            wire:model="share_holder_listed_company_check.{{ $shreholder }}"
                                            class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                                        <label class="form-check-label" for="flexSwitchCheckDefault">This is a
                                            listed
                                            company</label>
                                    </div>
                                </div>
                            </div>
                            @if(!$chklsit[$shreholder])
                            <div class="row" style="margin-top:30px;">



                                <div class="col-md-5" style="margin-top: 30px;">
                                    <label for="share_holder_company_year.{{ $shreholder }}" class="form-label">How
                                        long has the
                                        company
                                        been in
                                        business?</label>
                                    <div class="input-group">
                                        <input wire:click="shareHolderResetComapny({{ $shreholder }})"
                                            placeholder="Number of years"
                                            wire:model="share_holder_company_year.{{ $shreholder }}" type="number"
                                            class="form-control" aria-label="Text input with dropdown button">
                                        &nbsp;&nbsp;<p style="padding-top:10px;">Years</p>
                                    </div>
                                    @error("share_holder_company_year.$shreholder")
                                    <div style="color: red;">
                                        @php $message = preg_replace('/[0-9]+/', '', $message); @endphp
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="col-md-3" style="margin-top: 30px;">
                                    <div class="input-group" style="margin-top:29px;">
                                        <input wire:click="shareHolderResetComapny({{ $shreholder }})"
                                            placeholder="Number of month"
                                            wire:model="share_holder_company_month.{{ $shreholder }}" type="number"
                                            class="form-control" aria-label="Text input with dropdown button">
                                        &nbsp;&nbsp;<p style="padding-top:10px;">Months</p>
                                    </div>
                                    @error("share_holder_company_month.$shreholder")
                                    <div style="color: red;">
                                        @php $message = preg_replace('/[0-9]+/', '', $message); @endphp
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="col-md-12" style="margin-top:20px;margin-bottom:20px;"><b>OR</b></div>
                                <div class="col-md-5">
                                    <label for="share_holder_company_years.{{ $shreholder }}">When was the company
                                        incorporated?
                                    </label>
                                    <div class="input-group">
                                        {{-- <label for="">Year</label> --}}
                                        <select {{ isset($share_holder_company_year[$shreholder]) || isset(
                                            $share_holder_company_month[$shreholder]) ? 'disabled' : '' }}
                                            wire:model="share_holder_company_years.{{ $shreholder }}"
                                            class="form-select" aria-label="Default select example">
                                            <option value="" hidden>Select</option>
                                            @for ($x = 1990; $x <= date('Y'); $x++) <option value="{{ $x }}">
                                                {{ $x }}</option>
                                                @endfor
                                        </select>
                                        &nbsp;&nbsp;<p style="padding-top:10px;">Years</p>

                                    </div>
                                    @error("share_holder_company_years.$shreholder")
                                    <div style="color: red;">
                                        @php $message = preg_replace('/[0-9]+/', '', $message); @endphp
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>

                                <div class="col-md-3">
                                    <div class="input-group" style="margin-top:20px;">
                                        <select {{ isset($share_holder_company_year[$shreholder]) || isset(
                                            $share_holder_company_month[$shreholder]) ? 'disabled' : '' }}
                                            wire:model="share_holder_company_months.{{ $shreholder }}"
                                            class="form-select" aria-label="Default select example">
                                            <option value="" hidden>Select</option>
                                            @for ($x = 01; $x <= 12; $x++) <option value="1">{{ $x }}</option>
                                                @endfor
                                        </select>
                                        &nbsp;&nbsp;<p style="padding-top:10px;">Months</p>
                                        @error("share_holder_company_months.$shreholder")
                                        <div style="color: red;">
                                            @php $message = preg_replace('/[0-9]+/', '', $message); @endphp
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4"></div>
                                <div class="col-md-6" style="margin-top: 30px;">
                                    <label for="share_holder_percentage_shareholder.{{ $shreholder }}"
                                        class="form-label">% of
                                        local
                                        shareholding
                                    </label>
                                    <input wire:model="share_holder_percentage_shareholder.{{ $shreholder }}"
                                        type="number" class="form-control"
                                        id="share_holder_percentage_shareholder.{{ $shreholder }}">
                                    @error("share_holder_percentage_shareholder.$shreholder")
                                    <div style="color: red;">
                                        @php $message = preg_replace('/[0-9]+/', '', $message); @endphp
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="col-md-6" style="margin-top: 30px;">
                                    <label for="share_holder_number_of_share_holder" class="form-label">Number of
                                        shareholder including
                                        parent
                                        company if any
                                    </label>
                                    <input wire:model="share_holder_number_of_share_holder.{{ $shreholder }}"
                                        type="number" class="form-control"
                                        id="share_holder_number_of_share_holder.{{ $shreholder }}">
                                    @error("share_holder_number_of_share_holder.$shreholder")
                                    <div style="color: red;">
                                        @php $message = preg_replace('/[0-9]+/', '', $message); @endphp
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="col-md-6" style="margin-top: 30px;">
                                    <label class="form-label">Company structure type</label>
                                    <select wire:model="share_holder_company_structure_type_id.{{ $shreholder }}"
                                        class="form-select" aria-label="Default select example">
                                        <option value="" hidden>Select</option>
                                        @foreach($company_structure_types as $item)
                                        <option value="{{ $item->id }}">{{ $item->structure_type }}</option>
                                        @endforeach
                                    </select>
                                    @error("share_holder_company_structure_type_id.$shreholder")
                                    <div style="color: red;">
                                        @php $message = preg_replace('/[0-9]+/', '', $message); @endphp
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="col-md-6" style="margin-top: 30px;">
                                    <label class="form-label" for="">Sector</label>
                                    <select wire:model="share_holder_sector_id.{{ $shreholder }}" class="form-select"
                                        aria-label="Default select example">
                                        <option value="" hidden>Select</option>
                                        @foreach($sectors as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                    @error("share_holder_sector_id.$shreholder")
                                    <div style="color: red;">
                                        @php $message = preg_replace('/[0-9]+/', '', $message); @endphp
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="col-md-6" style="margin-top: 30px;">
                                    <label for="share_holder_number_of_employees" class="form-label">Number of
                                        full-time
                                        employee
                                    </label>
                                    <input wire:model="share_holder_number_of_employees.{{ $shreholder }}" type="number"
                                        class="form-control" id="share_holder_number_of_employees.{{ $shreholder }}">
                                    @error("share_holder_number_of_employees.$shreholder")
                                    <div style="color: red;">
                                        @php $message = preg_replace('/[0-9]+/', '', $message); @endphp
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="col-md-6" style="margin-top: 30px;">
                                    <label for="share_holder_revenue.{{ $shreholder }}" class="form-label">Revenue
                                        (rounded up is fine)</label>
                                    <div class="input-group">
                                        <input placeholder="$" wire:model="share_holder_revenue.{{ $shreholder }}"
                                            type="number" class="form-control"
                                            aria-label="Text input with dropdown button">
                                    </div>
                                    @error("share_holder_revenue.$shreholder")
                                    <div style="color: red;">
                                        @php $message = preg_replace('/[0-9]+/', '', $message); @endphp
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="col-md-6" style="margin-top: 30px;">
                                    <label for="share_holder_company_name" class="form-label">COMPANY NAME</label>
                                    <input wire:model="share_holder_company_name.{{ $shreholder }}" type="text"
                                        class="form-control" id="share_holder_company_name.{{ $shreholder }}">
                                    @error("share_holder_company_name.$shreholder")
                                    <div style="color: red;">
                                        @php $message = preg_replace('/[0-9]+/', '', $message); @endphp
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="col-md-6" style="margin-top: 30px;">
                                    <label for="share_holder_website.{{ $shreholder }}" class="form-label">Company
                                        website (if available)</label>
                                    <input wire:model="share_holder_website.{{ $shreholder }}" type="text"
                                        class="form-control" id="share_holder_website.{{ $shreholder }}">
                                    @error("share_holder_website.$shreholder")
                                    <div style="color: red;">
                                        @php $message = preg_replace('/[0-9]+/', '', $message); @endphp
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>

                            </div>

                            @else
                            <div class="row">
                                <div class="col-md-12" style="margin-top: 30px;">
                                    <label for="share_holder_company_name.{{ $shreholder }}" class="form-label">Please
                                        provide
                                        either parent company name or
                                        its ticker number followed by which stock exchange</label>
                                    <input wire:model="share_holder_company_name.{{ $shreholder }}" type="text"
                                        class="form-control" id="share_holder_company_name.{{ $shreholder }}">
                                    @error("share_holder_company_name.$shreholder")
                                    <div style="color: red;">
                                        @php $message = preg_replace('/[0-9]+/', '', $message); @endphp
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>

                                <div class="col-md-12" style="margin-top:30px;">
                                    <div class="form-group">
                                        <label for="share_holder_country.{{ $shreholder }}"
                                            class="form-label">Country</label>
                                        <select wire:model="share_holder_country.{{ $shreholder }}" class="form-select"
                                            aria-label="Default select example">
                                            <option value="" hidden>Select</option>
                                            @foreach($countries as $country)
                                            <option value="{{ $country }}">{{ $country }}</option>
                                            @endforeach
                                        </select>
                                        @error("share_holder_country.$shreholder")
                                        <div style="color: red;">
                                            @php $message = preg_replace('/[0-9]+/', '', $message); @endphp
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4 text-left">
                                    <livewire:widget.upload-component :label="'Or upload your Benefit illustration'"
                                        :apply_loan="$apply_loan" :main_type="$main_type" :loan_type_id="$loan_type_id"
                                        :share_holder="0" :modell="'\App\Models\LoanCompanyDetail'"
                                        :keyvalue="'parent_listed_company_subsidiary'" />

                                </div>
                            </div>

                            @endif
                            <div class="row" class="row">
                                <div class="col-12">
                                    <br>
                                    <button class="btn" type="button" wire:target='share_holder_document_store'
                                        wire:click.prevent='share_holder_document_store({{ $shreholder  }})'>
                                        <span wire:loading wire:target="share_holder_document_store"
                                            class="spinner-border spinner-border-sm" role="status"
                                            aria-hidden="true"></span>
                                        Save & Continue
                                    </button>
                                </div>
                            </div>
                            @elseif($subtab == 2)

                            <div class="row">
                                <div class="col-md-12" style="margin-top: 60px;">
                                    <b>6 months latest bank statement</b>
                                    <p>If It’s on or Over The 8th Of The Current Month For Example 8th Jan, You
                                        Would
                                        Need To
                                        Submit
                                        from Dec And Not Nov As The Latest Months. For companies less than 6 months
                                        old
                                        or
                                        unprofitable do check out our FAQ here.</p>
                                </div>
                                @for ($x = 1; $x <= 7; $x++) <div class="col-md-3" style="margin-top: 30px;">
                                    @php $montName = date("M", strtotime( date( 'Y-m-01' )." -$x months")) @endphp

                                    <livewire:widget.upload-component :label="$montName" :keyvalue="$montName"
                                        :key="$montName" :getImages="$images" :apply_loan="$apply_loan"
                                        :main_type="$main_type" :loan_type_id="$loan_type_id"
                                        :share_holder="$shreholder" :modell="'\App\Models\LoanStatement'" />
                                    {{-- <div x-data="{ isUploading: false, progress: 0 }"
                                        x-on:livewire-upload-start="isUploading = true"
                                        x-on:livewire-upload-finish="isUploading = false"
                                        x-on:livewire-upload-error="isUploading = false"
                                        x-on:livewire-upload-progress="progress = $event.detail.progress">
                                        <div class="form-group">
                                            <label class="control-label mb-10">
                                                @php echo date("M", strtotime( date( 'Y-m-01' )." -$x months"))
                                                @endphp
                                                @if(1 == $x) (Optional) @endif
                                            </label>
                                            <br>
                                            <label wire:ignore class="label" data-toggle="tooltip" title="Select Image">
                                                <input wire:model="share_holder_photo.{{ $shreholder }}.{{ date(" M",
                                                    strtotime( date( 'Y-m-01' )." -$x months")) }}"
                                                    accept="image/jpeg,image/gif,image/png,application/pdf,image/x-eps"
                                                    type="file" id="vehicleimage" name="" id="">
                                            </label>
                                        </div>
                                        @foreach($share_errorArray as $error)
                                        @if($error == date("M", strtotime( date( 'Y-m-01' )." -$x months")))
                                        <div class="text-danger">
                                            {{ $error. ' month required' }}
                                        </div>
                                        @endif
                                        @endforeach
                                        <!-- Progress Bar -->
                                        <div x-show="isUploading">
                                            <progress max="100" x-bind:value="progress"></progress>
                                        </div>
                                    </div> --}}
                            </div>
                            @endfor
                            <b><br>OR</b>
                            <div class="row">
                                <div class="col-md-12" style="margin-top: 30px;">

                                    <b>Consolidated Statement.</b>
                                    <p>If Your Statement Is Not Spilt Between Months But One</p>
                                </div>
                                <div class="col-md-4 text-left">
                                    <livewire:widget.upload-component :label="''" :apply_loan="$apply_loan"
                                        :main_type="$main_type" :loan_type_id="$loan_type_id"
                                        :share_holder="$shreholder" :modell="'\App\Models\LoanCompanyDetail'"
                                        :keyvalue="'share_company_combine_statement'" />
                                    {{-- <div x-data="{ isUploading: false, progress: 0 }"
                                        x-on:livewire-upload-start="isUploading = true"
                                        x-on:livewire-upload-finish="isUploading = false"
                                        x-on:livewire-upload-error="isUploading = false"
                                        x-on:livewire-upload-progress="progress = $event.detail.progress">
                                        <div class="form-group">
                                            <label class="control-label mb-10">
                                            </label>
                                            <br>
                                            <label wire:ignore class="label" data-toggle="tooltip" title="Select Image">
                                                <input wire:model="share_holder_statement.{{ $shreholder }}"
                                                    accept="image/jpeg,image/gif,image/png,application/pdf,image/x-eps"
                                                    type="file" id="vehicleimage" name="" id="">
                                            </label>
                                        </div>
                                        @error("share_holder_statement.$shreholder")
                                        <div style="color:red;">
                                            @php $message = preg_replace('/[0-9]+/', '', $message); @endphp
                                            {{ $message }}
                                        </div>
                                        @enderror
                                        <div x-show="isUploading">
                                            <progress max="100" x-bind:value="progress"></progress>
                                        </div>
                                    </div> --}}
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12" style="margin-top: 30px;">
                                    <b>Latest {{ $company_year >= 3 ? '2' : '1' }} Years Financial Statement</b>
                                    <p>
                                        (Income Statement also known as Profit & Loss
                                        + Statement of financial position also known as Balance Sheet)
                                    </p>
                                </div>
                                <div class="col-md-3 text-left" style="margin-top: 30px;">
                                    <livewire:widget.upload-component :label="'Latest year'" :apply_loan="$apply_loan"
                                        :main_type="$main_type" :loan_type_id="$loan_type_id"
                                        :share_holder="$shreholder" :modell="'\App\Models\LoanCompanyDetail'"
                                        :keyvalue="'share_company_latest_year_statement'" />
                                    {{-- <div x-data="{ isUploading: false, progress: 0 }"
                                        x-on:livewire-upload-start="isUploading = true"
                                        x-on:livewire-upload-finish="isUploading = false"
                                        x-on:livewire-upload-error="isUploading = false"
                                        x-on:livewire-upload-progress="progress = $event.detail.progress">
                                        <div class="form-group">
                                            <label class="control-label mb-10">
                                                <label for="">Latest year</label>
                                            </label>
                                            <br>
                                            <input wire:model="share_holder_latest_year.{{ $shreholder }}"
                                                accept="image/jpeg,image/gif,image/png,application/pdf,image/x-eps"
                                                type="file" id="vehicleimage" name="" id="">
                                        </div>
                                        @error("share_holder_latest_year.$shreholder")
                                        <div style="color:red;">
                                            @php $message = preg_replace('/[0-9]+/', '', $message); @endphp
                                            {{ $message }}
                                        </div>
                                        @enderror
                                        <div x-show="isUploading">
                                            <progress max="100" x-bind:value="progress"></progress>
                                        </div>
                                    </div> --}}
                                </div>
                                @if(isset($share_holder_company_year[$shreholder]) &&
                                $share_holder_company_year[$shreholder] >= 3)
                                <div class="col-md-3 text-left" style="margin-top: 30px;">
                                    <livewire:widget.upload-component :label="'Before year'" :apply_loan="$apply_loan"
                                        :main_type="$main_type" :loan_type_id="$loan_type_id"
                                        :share_holder="$shreholder" :modell="'\App\Models\LoanCompanyDetail'"
                                        :keyvalue="'share_company_before_year_statement'" />
                                    {{-- <div x-data="{ isUploading: false, progress: 0 }"
                                        x-on:livewire-upload-start="isUploading = true"
                                        x-on:livewire-upload-finish="isUploading = false"
                                        x-on:livewire-upload-error="isUploading = false"
                                        x-on:livewire-upload-progress="progress = $event.detail.progress">
                                        <div class="form-group">
                                            <label class="control-label mb-10">
                                                <label for="">Before year</label>
                                            </label>
                                            <br>
                                            <input wire:model="share_holder_year_before.{{ $shreholder }}"
                                                accept="image/jpeg,image/gif,image/png,application/pdf,image/x-eps"
                                                type="file" id="vehicleimage" name="" id="">
                                        </div>
                                        @error("share_holder_year_before.$shreholder")
                                        <div style="color:red;">
                                            @php $message = preg_replace('/[0-9]+/', '', $message); @endphp
                                            {{ $message }}
                                        </div>
                                        @enderror
                                        <div x-show="isUploading">
                                            <progress max="100" x-bind:value="progress"></progress>
                                        </div>
                                    </div> --}}
                                </div>
                                @endif
                            </div>
                            <div class="row">
                                <div class="col-md-12" style="margin-top: 30px;">
                                    <b>Profitable for the last 2 accounting years</b>
                                </div>
                                <div class="col-md-4" style="margin-top: 30px;">

                                    <div class="form-group">

                                        <select wire:model="share_holder_profitable_latest_year.{{ $shreholder }}"
                                            class="form-select" aria-label="Default select example">
                                            <option value="" hidden>Select</option>
                                            <option value="1">Yes</option>
                                            <option value="0">No</option>
                                        </select>
                                        @error("share_holder_profitable_latest_year.$shreholder")
                                        <div style="color:red;">
                                            @php $message = preg_replace('/[0-9]+/', '', $message); @endphp
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4" style="margin-top: 30px;">
                                    <div class="form-group">
                                        <select wire:model="share_holder_profitable_before_year.{{ $shreholder }}"
                                            class="form-select" aria-label="Default select example">
                                            <option value="" hidden>Select</option>
                                            <option value="1">Yes</option>
                                            <option value="0">No</option>
                                        </select>
                                        @error("share_holder_profitable_before_year.$shreholder")
                                        <div style="color:red;">
                                            @php $message = preg_replace('/[0-9]+/', '', $message); @endphp
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12" style="margin-top: 30px;">
                                    <b style="color: grey;">Optional info</b>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12" style="margin-top: 30px;">
                                    <b>Current Year.</b>
                                    <p>If you are <b>more than 3-6 months into your current accounting year,</b> and
                                        if
                                        your
                                        management account(drafts/unaudited) pulls up the average, providing them
                                        may be
                                        helpful
                                    </p>
                                </div>
                                <div class="col-md-3 text-left">
                                    <livewire:widget.upload-component :label="''" :apply_loan="$apply_loan"
                                        :main_type="$main_type" :loan_type_id="$loan_type_id"
                                        :share_holder="$shreholder" :modell="'\App\Models\LoanCompanyDetail'"
                                        :keyvalue="'share_company_current_year_statement'" />
                                    {{-- <div x-data="{ isUploading: false, progress: 0 }"
                                        x-on:livewire-upload-start="isUploading = true"
                                        x-on:livewire-upload-finish="isUploading = false"
                                        x-on:livewire-upload-error="isUploading = false"
                                        x-on:livewire-upload-progress="progress = $event.detail.progress">
                                        <div class="form-group">
                                            <label class="control-label mb-10">
                                            </label>
                                            <br>
                                            <input wire:model="share_holder_current_year.{{ $shreholder }}"
                                                accept="image/jpeg,image/gif,image/png,application/pdf,image/x-eps"
                                                type="file" id="vehicleimage" name="" id="">
                                        </div>
                                        @error("share_holder_current_year.$shreholder")
                                        <div style="color:red;">
                                            @php $message = preg_replace('/[0-9]+/', '', $message); @endphp
                                            {{ $message }}
                                        </div>
                                        @enderror
                                        <div x-show="isUploading">
                                            <progress max="100" x-bind:value="progress"></progress>
                                        </div>
                                    </div> --}}
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12" style="margin-top: 30px;">
                                    <b>Revenue (rounded up is fine)</b>
                                </div>
                                <div class="col-md-3" style="margin-top: 30px;">
                                    <div class="form-group">
                                        <input type="number" class="form-control"
                                            wire:model="share_holder_optional_revenuee">
                                        @error("share_holder_optional_revenuee.$shreholder")
                                        <div style="color:red;">
                                            @php $message = preg_replace('/[0-9]+/', '', $message); @endphp
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <button class="btn" type="button" wire:target='share_holder_document_store'
                                        wire:click.prevent='company_share_holder_documents_store({{ $shreholder  }})'>
                                        <span wire:loading wire:target="share_holder_document_store"
                                            class="spinner-border spinner-border-sm" role="status"
                                            aria-hidden="true"></span>
                                        Save & Continue
                                    </button>
                                </div>
                            </div>

                            {{-- @endif --}}
                        </div>
                        @endif
                    </div>
                </div>
            </div>
            @endif
            @endforeach
        </div>
        @endif
</div>
</section>
</div>
</div>
<script>
    $(document).on('click', '.singleCheck', function () {
        $('.singleCheck').not(this).prop('checked', false);
    });
    $(document).on('click', '.reasonCheck', function () {
        $('.reasonCheck').not(this).prop('checked', false);
    });

</script>
<script>
    window.addEventListener('name-updated', event => {
        Swal.fire({
            title: event.detail.newName,
            showDenyButton: true,
            showCancelButton: true,
            confirmButtonText: 'Update',
        }).then((result) => {
            /* Read more about isConfirmed, isDenied below */
            if (result.value) {
                // calling destroy method to delete
                @this.call('shareholderDelete')
                // success response

            } else {

            }
        })
    })

</script>
<script>
    window.addEventListener('confirmation', event => {
        Swal.fire({
            title: event.detail.message,
            showDenyButton: true,
            showCancelButton: true,
            confirmButtonText: 'Update',
        }).then((result) => {
            /* Read more about isConfirmed, isDenied below */
            if (result.value) {
                // calling destroy method to delete
                @this.call(event.detail.function)
                // success response

            } else {

            }
        })
    })

</script>
</section>

</div>