<div>
    @php $main_types = loanProfile(); @endphp
    @php $mnth = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October",
    "November", "December"]; @endphp
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
                                class="nav-link {{ $tab == '10' ? 'active' : '' }}" href="#">CONSUMER DETAIL</a>
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

                    {{-- @elseif($tab == 8 && $loan_type_id == 25)
                    @livewire('widget.consumer-personal-loan', ['loan_type_id' => $loan_type_id, "main_type" => $main_type,
                    'apply_loan' => $apply_loan]) --}}

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

                    @elseif($tab == 8 && $loan_type_id == 25)

                    @livewire('cms.loan.consumer-personal-loan', ['loan_type_id' =>
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
                    <!-- LOAN TYPE CARDS -->
                    <div class="row">
                        @foreach($mainTypes as $item)
                        @if($item->subTypes->count() > 0)
                        <div class="col-md-4 pt-3">
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

                                    <!-- LOAN TYPE TOOLTIP -->
                                    <div class="tooltip-c">
                                        <i class="fa fa-info-circle"></i>
                                        <span class="tooltip-text">Hello World</span>
                                    </div>
                                    <!-- /LOAN TYPE TOOLTIP -->
                                </a>
                                @endforeach
                            </div>
                        </div>
                        @endif
                        @endforeach
                    </div>
                    <!-- /LOAN TYPE CARDS -->

                    @if(sizeof($loanReasons) > 0)
                    <div class="row">
                        <br>
                        <br>
                        <hr>
                        <h5>Loan Reasons</h5>
                    </div>

                    <!-- LOAN REASONS -->
                    <div class="row mt-3">
                        @foreach($loanReasons as $key => $item)
                        <div class="col-md-4 mb-2">
                            <div class="form-check form-switch">
                                <input wire:click="pushReason({{ $item->id }})" wire:model="reasonValue.{{ $item->id }}"
                                    class="form-check-input reasonCheck" type="checkbox" id="{{ $item->id }}" />
                                <label class="form-check-label" for="{{ $item->id }}">{{ $item->reason }}</label>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <!-- /LOAN REASONS -->

                    <div class="row text-end">
                        <div>
                            <br>
                            <br>
                            <button class="btn btn-custom" wire:click="storeReasonLoanType">Save & Continue</button>
                        </div>
                    </div>
                    @endif

                    @endif

                    @elseif($tab == 9)
                    @php $NFL = [1,2,3,4]
                    @endphp

                    <!-- LENDERS -->
                    <div class="row mb-4 text-center">
                        <p class="lead fw-bold">Select Lenders</p>
                        <p>The following lenders offer the loan type you chose, factoring the information you have entered.</p>
                        <p>Please select which of our following Financing Partners you wish to send your enquiry to.</p>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked">
                                <label class="form-check-label" for="flexSwitchCheckChecked">Show only CBS
                                    members</label>
                              </div>
                        </div>
                        <div class="col-md-6">
                           <div class="cbc">
                               <p><b>CBS</b>(Downloaded Within The Last 30 days)</p>
                              <input type="file" class="mt-2 form-control">
                           </div>
                        </div>
                    </div>
                    @foreach($NFL as $item)
                    <div class="row mb-3">
                        <div class="card px-0">
                            <div class="card-header d-flex justify-content-between py-2">
                                @if($item == 1)
                                <p class="mb-0">Bank</p>
                                @elseif($item == 2)
                                <p class="mb-0">Excluded Moneylender</p>
                                
                                @else
                                <p class="mb-0">Moneylender</p>
                                
                               
                                @endif
                                <div class="form-check">
                                   
                            <input class="form-check-input" type="checkbox" value="" id="flexCheckIndeterminate1">
                            <label class="form-check-label" for="flexCheckIndeterminate1">
                                Select All
                             </label>
                          </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    @foreach($financePartners as $financePartner)
                                    @if($financePartner->type == 1 && $item == 1)
                                    <div class="col-md-6 col-lg-3">
                                     <div class="lender-bank d-flex justify-content-between align-items-center px-3 py-2">
                                        <div class="lender-bank__img">
                                            <img for="{{ $financePartner->id }}"
                                            src="uploads/financePartnerImages/{{ $financePartner->image }}" alt=""
                                            width="80px" height="25px">
                                            </div>
                                        <input   wire:model="lender.{{ $financePartner->id }}" wire:change="Selectall({{ $item }})"    type="checkbox" id="{{ $financePartner->id }}">
                                     </div>
                                    </div>
                                   
                                   
                                    @endif
                                    @endforeach
                                   
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach

                    <div class="row mb-3 mt-2">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="flexCheckIndeterminate">
                            <label class="form-check-label" for="flexCheckIndeterminate">
                                I/we agree the information I/we provided is true to the best of my knowledge and I/we give consent to these Financing Partners to verify them and those that are CBS members to access my credit report/s instead of furnishing it myself. I/we \also agree to FindTheLoan.com’s Privacy Policy, Terms of use and any related policies.
                            </label>
                          </div>
                    </div>

                    <div class="text-center">
                        <button class="btn btn-custom">Send Enquiry</button>
                    </div>

                    <div class="row mt-3 d-flex">
                        
                        <p><span class="text-danger">Note:</span> While the lenders above may offer your loan type, it doesn’t not necessarily mean they may offer a loan to you, depending on factors such as your risk profile, their monthly limited to a certain risk bracket etc. It is generally better to check with more lenders to compare with.</p>
                      
                    </div>
                    <!-- /LENDERS -->
                    <!-- <div class="row">
                        <div class="col-md-8">
                            @foreach($NFL as $item)
                            <div class="row mt-3">
                                <div class="col-md-8">
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
                                <div class="col-md-4">
                                    <div class="form-check">
                                        <input wire:model="checkSelect.{{ $item }}" wire:change="Selectall({{ $item }})"
                                            class="form-check-input" type="checkbox" value="" id="{{ $item }}">
                                        <label class="form-check-label" for="{{ $item }}">
                                            <b> Select All</b>
                                        </label>
                                    </div>
                                </div>
                            </div>

                            
                            <div class="row mt-3">
                                @foreach($financePartners as $financePartner)
                                @if($financePartner->type == 1 && $item == 1)
                                <div class="col-md-3">
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
                                <div class="col-md-3">
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
                                <div class="col-md-3">
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
                                <div class="col-md-3">
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
                    </div>

                    <div class="row">
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
                    </div> -->



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
                            <button wire:loading.attr='disabled' class="btn btn-custom" type="button" wire:target='companyDetail'
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

                    <div class="row">
                        <!-- OVERDRAFT UNSECURED COMPANY DETAILS-->
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
                                        <div class="input-group mb-3">
                                            {{-- <label for="">Year</label> --}}
                                            <select wire:model="company_years" class="form-select"
                                                aria-label="Default select example" wire:change="getnoofYear()">
                                                <option value="" hidden>Select</option>
                                                @for ($x = 1990; $x <= date('Y'); $x++) <option value="{{ $x }}">{{  $x }}
                                                    </option>
                                                    @endfor
                                            </select>
                                            <label class="input-group-text">Year</label>
                                        </div>
                                        @error('company_years')
                                        <div style="color: red;">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <div class="input-group mb-3">
                                            <select wire:model="company_months" class="form-select"
                                                aria-label="Default select example" wire:change="getnoofYear()">
                                                <option value="" hidden>Select</option>
                                                @for ($x = 0; $x <= 11; $x++) <option value="{{ $x }}">{{$mnth[$x] }}
                                                    </option>
                                                    @endfor
                                            </select>
                                            <label class="input-group-text">Month</label>
                                            <!-- &nbsp;&nbsp;<p class="pt-2">Month</p> -->
                                            @error('company_months')
                                            <div style="color: red;">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-1 d-flex align-items-end justify-content-center">
                                <p class="fw-bold">or</p>
                            </div>
                            <div class="col-md-6">
                                <p>How long has the company been in
                                    business?</p>
                                <div class="row ">
                                    <div class="col-md-6">
                                        <div class="input-group mb-3">
                                            <input wire:keyup="resetComapny" placeholder="No of years"
                                                wire:model="company_year" type="number" class="form-control"
                                                aria-label="Text input with dropdown button">
                                            <label class="input-group-text">Years</label>
                                        </div>
                                        @error('company_year')
                                        <div style="color: red;">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <div class="input-group mb-3">
                                            <input wire:keyup="resetComapny" placeholder="No of months"
                                                wire:model="company_month" type="number" class="form-control"
                                                aria-label="Text input with dropdown button">
                                            <label class="input-group-text">Months</label>
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

                        <div class="row mt-2">
                            <div class="col-md-6">
                          <div class="mb-3">
                            <label for="percentage_shareholder" class="form-label">% of local shareholding
                            </label>
                            <div class="input-group mb-3">
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
                            </div>
                            <div class="col-md-6">
                            <div class="mb-3">
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
                        </div>

                        <div class="row mt-2">
                            <div class="col-md-4">
                          <div class="mb-3">
                            <label class="form-label">Company structure type</label>
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
                            </div>
                            <div class="col-md-4">
                         <div class="mb-3">
                            <label class="form-label" for="">Sector</label>
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
                            <div class="col-md-4">
                          <div class="mb-3">
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
                            </div>
                        </div>

                        <div class="row mt-2">
                            <div class="col-md-4">
                            <div class="mb-3">
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
                            <div class="col-md-4">
                             <div class="mb-3">
                                <label for="company_name" class="form-label">Company name</label>
                                <input wire:model="company_name" type="text" class="form-control" id="company_name">
                                @error('company_name')
                                <div style="color: red;">
                                    {{ $message }}
                                </div>
                                @enderror
                             </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                 <label for="website" class="form-label">Company website (if available)</label>
                                 <input wire:model="website" type="text" class="form-control" id="website">
                                 @error('website')
                                 <div style="color: red;">
                                     {{ $message }}
                                 </div>
                                 @enderror
                                </div>
                                 </div>
                        </div>
                        <!-- /OVERDRAFT UNSECURED COMPANY DETAILS-->

                        @else
                        <div class="row">
                        <div class="col-md-12 col-lg-6">
                            <label for="company_name" class="form-label">Please provide either parent company name or
                                its ticker number followed by which stock exchange</label>
                            <input wire:model="company_name" type="text" class="form-control" id="company_name">
                            @error('company_name')
                            <div style="color: red;">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="col-md-12 col-lg-6">
                            <p style="margin-bottom: 20px;"><label for="company_name" class="form-label">Select country</label></p>
                            <div class="form-group d-flex align-items-end">
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

                        <div class="row">
                            <div class="col-md-4 mt-4">
                                <div x-data="{ isUploading: false, progress: 0 }"
                                    x-on:livewire-upload-start="isUploading = true"
                                    x-on:livewire-upload-finish="isUploading = false"
                                    x-on:livewire-upload-error="isUploading = false"
                                    x-on:livewire-upload-progress="progress = $event.detail.progress">
                                    <div class="form-group">
    
                                        <label class="control-label">
                                            Subsidiary’s (borrower)M&AA
                                        </label>
                                        <br>
                                        <br>
                                        <label wire:ignore class="label" data-toggle="tooltip" title="Select Image">
                                            <input wire:model="subsidiary"
                                                accept="image/jpeg,image/gif,image/png,application/pdf,image/x-eps"
                                                type="file" class="form-control" id="vehicleimage">
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
                    </div>

                    <!-- SAVE & CONTINUE BUTTON -->
                    <div class="mt-3">
                        <button class="btn btn-custom" type="button" wire:target='confirmationMessage'
                            wire:click.prevent='confirmationMessage'>
                            <div wire:loading wire:target="confirmationMessage">
                                <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                            </div>
                            Save & Continue
                        </button>
                    </div>
                    <!-- /SAVE & CONTINUE BUTTON -->

                    <!-- COMPANY DOCUMENTS__TOPCONTENT -->
                    @elseif($tab == 5)
                    @if(!$listed_company_check)
                    <div class="row">
                        <!-- 1ST SECTION -->
                        <div class="border rounded p-3">
                        <div class="row">
                            <b>6 months latest bank statement</b>
                            <p>If It’s on or Over The 8th Of The Current Month For Example 8th Jan, You Would Need To
                                Submit
                                from Dec And Not Nov As The Latest Months. For companies less than 6 months old or
                                unprofitable do check out our FAQ here.</p>
                        </div>
                        <!-- /COMPANY DOCUMENTS__TOPCONTENT -->

                        <!-- COMPANY DOCUMENTS__FILE FEILD -->
                        <div class="row mt-3">
                            @for ($x = 1; $x < 8; $x++) <div class="col-md-6 col-lg-4 mb-3">
                                @php $montName = date("M", strtotime( date( 'Y-m-01' )." -$x months")) @endphp

                                <livewire:widget.upload-component :label="$montName" :keyvalue="$montName"
                                    :key="$montName" :getImages="$images" :apply_loan="$apply_loan"
                                    :main_type="$main_type" :loan_type_id="$loan_type_id" :share_holder="0"
                                    :modell="'App\Models\LoanStatement'" />
                        </div>
                        @endfor
                    </div>
                    <!-- /COMPANY DOCUMENTS__FILE FEILD -->

                    <!-- COMPANY DOCUMENTS__Consolidated Statement -->
                    <div class="row">
                        <p><b>OR</b></p>
                        <p><b>Consolidated Statement.</b></p>
                        <p class="mb-0">If Your Statement Is Not Spilt Between Months But One</p>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <livewire:widget.upload-component :label="''" :apply_loan="$apply_loan"
                                :main_type="$main_type" :loan_type_id="$loan_type_id" :share_holder="0"
                                :modell="'App\Models\LoanCompanyDetail'"
                                :keyvalue="'parent_company_combine_statement'" />
                        </div>
                    </div>
                    </div>
                    <!-- /COMPANY DOCUMENTS__Consolidated Statement -->
<!-- /1ST SECTION -->

<!-- 2ND SECTION -->
<div class="border rounded p-3 mt-3">
   <!-- COMPANY DOCUMENTS__LATEST YEAR -->
   <div class="row">
    <p> <b>Latest {{ $getNumberOfCompanyYears >= 3 ? '2' : '1' }} Years Financial Statement</b></p>
    <p>
        (Income Statement also known as Profit & Loss
        + Statement of financial position also known as Balance Sheet)
    </p>
</div>

<div class="row mt-1">
    <div class="col-md-4">
        <livewire:widget.upload-component :label="'Latest year'" :apply_loan="$apply_loan"
            :main_type="$main_type" :loan_type_id="$loan_type_id" :share_holder="0"
            :modell="'App\Models\LoanCompanyDetail'"
            :keyvalue="'parent_company_latest_year_statement'" />
    </div>
    @if($getNumberOfCompanyYears >= 3)
    <div class="col-md-4">
        <livewire:widget.upload-component :label="'Before year'" :apply_loan="$apply_loan"
            :main_type="$main_type" :loan_type_id="$loan_type_id" :share_holder="0"
            :modell="'App\Models\LoanCompanyDetail'"
            :keyvalue="'parent_company_before_year_statement'" />

    </div>
    @endif
</div>
<!-- /COMPANY DOCUMENTS__LATEST YEAR -->

<!-- COMPANY DOCUMENTS__PROFITABLE -->
<div class="row mt-4">
    <div class="col-md-4">
        <p> <b>Profitable for the last 2 accounting years</b></p>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label>Before Years</label>
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
    <div class="col-md-4">
        <div class="form-group">
            <label>After Years</label>
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
<!-- /COMPANY DOCUMENTS__PROFITABLE -->
</div>
<!-- /2ND SECTION -->
             
<!-- 3RD SECTION -->
<div class="border rounded p-3 mt-3">
  <!-- COMPANY DOCUMENTS__OPTIONOL INFO -->
  <div class="row">
    <P class="text-muted"><b>Optional info</b></P>
</div>

<div class="row">
    <p><b>Current Year</b></p>
    <p class="mb-0">If you are <b>more than 3-6 months into your current accounting year,</b> and if your
        management account(drafts/unaudited) pulls up the average, providing them may be helpful
    </p>
</div>

<div class="row">
    <div class="col-md-4">
        <livewire:widget.upload-component :label="''" :apply_loan="$apply_loan"
            :main_type="$main_type" :loan_type_id="$loan_type_id" :share_holder="0"
            :modell="'App\Models\LoanCompanyDetail'"
            :keyvalue="'parent_company_current_year_statement'" />
    </div>
</div>
<!-- /COMPANY DOCUMENTS__OPTIONOL INFO -->

<!-- COMPANY DOCUMENTS__REVENUE -->
<div class="row mt-3">
    <b>Revenue (rounded up is fine)</b>
</div>

<div class="row mt-3">
    <div class="col-md-4">
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
<!-- /COMPANY DOCUMENTS__REVENUE -->
</div>
<!-- /3RD SECTION -->

                    <div class="mt-3">
                        <button class="btn btn-custom" type="button" wire:target='saveCompanyDocuments'
                            wire:click.prevent='saveCompanyDocuments'>
                            <span wire:loading wire:target="saveCompanyDocuments"
                                class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                            Save & Continue
                        </button>
                        <a href="{{ route('faqs') }}" target="_blank" class="btn btn-outline-dark">Why these documents
                            <i class="fa fa-info-circle"></i></a>
                    </div>
                </div>
                @endif

                @elseif($tab == 7)
                @php $srno = 1; @endphp
                @php $no = 1; @endphp
                <!-- SHAREHOLDER__SELECT -->
                <div class="row">
                    @foreach($get_share_holder_type as $key => $item)
                    <div class="col-md-6 col-lg-3 mb-3">
                        <div class="form-check form-switch">
                            <label class="form-check-label" for="flexSwitchCheckDefault">Shareholder
                                @if($key++ == 0)
                                1
                                @else
                                {{ $key++ }}
                                @endif
                            </label>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3 mb-3">
                        <div class="form-check">
                            <select class="form-select" wire:model="checkShareHolder.{{ $item['id'] }}"
                                wire:change="getShareholderTypeId({{ $item['id'] }})">
                                <option value="0">Person</option>
                                <option value="1">Company</option>
                            </select>
                        </div>
                    </div>
                    @endforeach
                </div>
                <!-- /SHAREHOLDER__SELECT -->

                <div id="accordion" style="margin-top: 30px;">
                    @foreach($get_share_holder_type as $key => $item)
                    @if($item['share_holder_type'] == 1)
                    <div class="card mt-3">
                        @php $shreholder = $item['id'] @endphp
                        <div class="card-header" id="{{ $shreholder }}">
                            <h5 class="mb-0">
                                <button class="btn btn-custom" data-toggle="collapse" data-target="#collapseOne{{ $shreholder }}"
                                    aria-expanded="true" aria-controls="collapseOne{{ $shreholder }}">
                                    Shareholder Person
                                    @if($key++ == 0)
                                    1
                                    @else
                                    {{ $key++ }}
                                    @endif
                                </button>
                            </h5>
                        </div>
                        <div wire:ignore.self style="margin-top: 30px;" id="collapseOne{{ $shreholder }}"
                            class="collapse {{  $key == 0 ? 'show' : '' }}" aria-labelledby="{{ $shreholder }}"
                            data-parent="#accordion">
                            <div class="card-body">

                                <!-- SHAREHOLDER__SELECT PERSON -->
                                <div class="row">
                                    <p class="mb-1"> <b>NRIC</b> or <b>Passport/Identity Card</b> ( Foreigner)</p>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-md-4">
                               <div class="mb-3">
                                <div x-data="{ isUploading: false, progress: 0 }"
                                x-on:livewire-upload-start="isUploading = true"
                                x-on:livewire-upload-finish="isUploading = false"
                                x-on:livewire-upload-error="isUploading = false"
                                x-on:livewire-upload-progress="progress = $event.detail.progress">
                                <div class="form-group">
                                    <label for="">NRIC Front</label>
                                    <input wire:model="nric_front.{{ $shreholder }}"
                                        accept="image/jpeg,image/gif,image/png,application/pdf,image/x-eps"
                                        type="file" class="form-control" id="vehicleimage" name="" id="">
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
                                    </div>
                                    <div class="col-md-4">
                             <div class="mb-3">
                                <div x-data="{ isUploading: false, progress: 0 }"
                                x-on:livewire-upload-start="isUploading = true"
                                x-on:livewire-upload-finish="isUploading = false"
                                x-on:livewire-upload-error="isUploading = false"
                                x-on:livewire-upload-progress="progress = $event.detail.progress">
                                <div class="form-group">
                                    <label for="">NRIC Back</label>
                                    <input wire:model="nric_back.{{ $shreholder }}"
                                        accept="image/jpeg,image/gif,image/png,application/pdf,image/x-eps"
                                        type="file" class="form-control" id="vehicleimage" name="" id="">
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
                                    </div>
                                    <div class="col-md-4">
                                 <div class="mb-3">
                                    <div x-data="{ isUploading: false, progress: 0 }"
                                    x-on:livewire-upload-start="isUploading = true"
                                    x-on:livewire-upload-finish="isUploading = false"
                                    x-on:livewire-upload-error="isUploading = false"
                                    x-on:livewire-upload-progress="progress = $event.detail.progress">
                                    <div class="form-group">
                                        <label for="">Passport</label>
                                        <input wire:model="passport.{{ $shreholder }}"
                                            accept="image/jpeg,image/gif,image/png,application/pdf,image/x-eps"
                                            type="file" class="form-control" id="vehicleimage" name="" id="">
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
                                </div>
                                <div class="row mt-2">
                                    <p class="mb-1"> <b>Personal NOA</b></p>
                                    <p class="mb-1">(Notice of Assessment) 2 Years</p>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-md-4">
                                   <div class="mb-3">
                                    <div x-data="{ isUploading: false, progress: 0 }"
                                    x-on:livewire-upload-start="isUploading = true"
                                    x-on:livewire-upload-finish="isUploading = false"
                                    x-on:livewire-upload-error="isUploading = false"
                                    x-on:livewire-upload-progress="progress = $event.detail.progress">
                                    <div class="form-group">
                                    <label for="">Latest</label>
                                    <input wire:model="nao_latest.{{ $shreholder }}"
                                        accept="image/jpeg,image/gif,image/png,application/pdf,image/x-eps"
                                        type="file" class="form-control" id="vehicleimage" name="" id="">
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
                                    </div>
                                    <div class="col-md-4">
                                <div class="mb-3">
                                    <div x-data="{ isUploading: false, progress: 0 }"
                                    x-on:livewire-upload-start="isUploading = true"
                                    x-on:livewire-upload-finish="isUploading = false"
                                    x-on:livewire-upload-error="isUploading = false"
                                    x-on:livewire-upload-progress="progress = $event.detail.progress">
                                    <div class="form-group">
                                        <label for="">Older</label>
                                        <input wire:model="nao_older.{{ $shreholder }}"
                                            accept="image/jpeg,image/gif,image/png,application/pdf,image/x-eps"
                                            type="file" class="form-control" id="vehicleimage" name="" id="">
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
                                    <div class="col-md-4"></div>
                                </div>

                                <div class="row mt-2">
                                    <p> <b>I don't have income proof because i am</b></p>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-md-4">
                                  <div class="mb-3">
                                    <select class="form-select" name="" id=""
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
                                </div>
                                <div class="mt-3">
                                    <button class="btn btn-custom" type="button" wire:target='share_holder_document_store'
                                        wire:click.prevent='share_holder_document_store({{ $item['id'] }})'>
                                        <span wire:loading wire:target="share_holder_document_store"
                                            class="spinner-border spinner-border-sm" role="status"
                                            aria-hidden="true"></span>
                                        Save & Continue
                                    </button>
                                </div>
                                <!-- /SHAREHOLDER__SELECT PERSON -->
                            </div>
                        </div>
                    </div>
                    @else
                    <div class="card mt-3">
                        @php $shreholder = $item['id'] @endphp
                        <div class="card-header" id="{{ $shreholder }}">
                            <h5 class="mb-0">
                                <button class="btn btn-custom" data-toggle="collapse" data-target="#collapseOne{{ $shreholder }}"
                                    aria-expanded="true" aria-controls="collapseOne{{ $shreholder }}">
                                    Shareholder Company 
                                    @if($key++ == 0)
                                    1
                                    @else
                                    {{ $key++ }}
                                    @endif
                                </button>
                            </h5>
                        </div>
                        <div wire:ignore.self id="collapseOne{{ $shreholder }}" class="collapse"
                            aria-labelledby="{{ $shreholder }}" data-parent="#accordion">
                            <div class="card-body">
                                <!-- SHAREHOLDER__SELECT COMPANY -->
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
                                <div class="row mt-4">
                                    <div class="col-md-12">
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

                                <div class="row">
                                    <!-- SHAREHOLDER__COMPANY DETAIL -->
                                    <div class="row mt-3">
                                        <div class="col-md-5">
                                            <div class="row">
                                                <p>When was the company incorporated?</p>
                                                <div class="col-md-6">
                                            <div class="mb-3">
                                                <div class="input-group">
                                                    {{-- <label for="">Year</label> --}}
                                                    <select
                                                        {{ isset($share_holder_company_year[$shreholder]) || isset( $share_holder_company_month[$shreholder]) ? 'disabled' : '' }}
                                                        wire:model="share_holder_company_years.{{ $shreholder }}"
                                                        class="form-select" aria-label="Default select example">
                                                        <option value="" hidden>Select</option>
                                                        @for ($x = 1990; $x <= date('Y'); $x++) <option
                                                            value="{{ $x }}">
                                                            {{ $x }}</option>
                                                            @endfor
                                                    </select>
                                                    <label class="input-group-text">Year</label>
                                                </div>
                                                @error("share_holder_company_years.$shreholder")
                                                <div style="color: red;">
                                                    @php $message = preg_replace('/[0-9]+/', '', $message); @endphp
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                                </div>
                                                <div class="col-md-6">
                                            <div class="mb-3">
                                                <div class="input-group">
                                                    <select
                                                        {{ isset($share_holder_company_year[$shreholder]) || isset( $share_holder_company_month[$shreholder]) ? 'disabled' : '' }}
                                                        wire:model="share_holder_company_months.{{ $shreholder }}"
                                                        class="form-select" aria-label="Default select example">
                                                        <option value="" hidden>Select</option>
                                                        @for ($x = 01; $x <= 12; $x++) <option value="1">{{ $x }}
                                                            </option>
                                                            @endfor
                                                    </select>
                                                    <label class="input-group-text">Month</label>
                                                </div>
                                                    @error("share_holder_company_months.$shreholder")
                                                    <div style="color: red;">
                                                        @php $message = preg_replace('/[0-9]+/', '', $message);
                                                        @endphp
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                            </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-1 d-flex align-items-end justify-content-center">
                                            <p class="fw-bold">or</p>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="row">
                                                <p>How long has the company been in business?</p>
                                                <div class="col-md-6">
                                              <div class="mb-3">
                                                <div class="input-group">
                                                    <input wire:click="shareHolderResetComapny({{ $shreholder }})"
                                                        placeholder="Number of years"
                                                        wire:model="share_holder_company_year.{{ $shreholder }}"
                                                        type="number" class="form-control"
                                                        aria-label="Text input with dropdown button">
                                                    <label class="input-group-text">Years</label>
                                                </div>
                                                @error("share_holder_company_year.$shreholder")
                                                <div style="color: red;">
                                                    @php $message = preg_replace('/[0-9]+/', '', $message); @endphp
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                              </div>
                                                </div>
                                                <div class="col-md-6">
                                          <div class="mb-3">
                                            <div class="input-group">
                                                <input wire:click="shareHolderResetComapny({{ $shreholder }})"
                                                    placeholder="Number of month"
                                                    wire:model="share_holder_company_month.{{ $shreholder }}"
                                                    type="number" class="form-control"
                                                    aria-label="Text input with dropdown button">
                                                <label class="input-group-text">Months</label>
                                            </div>
                                            @error("share_holder_company_month.$shreholder")
                                            <div style="color: red;">
                                                @php $message = preg_replace('/[0-9]+/', '', $message); @endphp
                                                {{ $message }}
                                            </div>
                                            @enderror
                                          </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row mt-2">
                                        <div class="col-md-6">
                                    <div class="mb-3">
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
                                        </div>
                                        <div class="col-md-6">
                                      <div class="mb-3">
                                        <label for="share_holder_number_of_share_holder" class="form-label">Number
                                            of
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
                                        </div>
                                    </div>

                                    <div class="row mt-2">
                                        <div class="col-md-4">
                                      <div class="mb-3">
                                        <label class="form-label">Company structure type</label>
                                        <select
                                            wire:model="share_holder_company_structure_type_id.{{ $shreholder }}"
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
                                        </div>
                                        <div class="col-md-4">
                                    <div class="mb-3">
                                        <label class=" form-label" for="">Sector</label>
                                        <select wire:model="share_holder_sector_id.{{ $shreholder }}"
                                            class="form-select" aria-label="Default select example">
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
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                              <label for="share_holder_number_of_employees" class="form-label">Number of
                                                  full-time
                                                  employee
                                              </label>
                                              <input wire:model="share_holder_number_of_employees.{{ $shreholder }}"
                                                  type="number" class="form-control"
                                                  id="share_holder_number_of_employees.{{ $shreholder }}">
                                              @error("share_holder_number_of_employees.$shreholder")
                                              <div style="color: red;">
                                                  @php $message = preg_replace('/[0-9]+/', '', $message); @endphp
                                                  {{ $message }}
                                              </div>
                                              @enderror
                                            </div>
                                              </div>
                                    </div>

                                    <div class="row mt-2">
                                        <div class="col-md-4">
                                       <div class="mb-3">
                                        <label for="share_holder_revenue.{{ $shreholder }}"
                                        class="form-label">Revenue
                                        (rounded up is fine)</label>
                                    <div class="input-group">
                                        <input placeholder="$"
                                            wire:model="share_holder_revenue.{{ $shreholder }}" type="number"
                                            class="form-control" aria-label="Text input with dropdown button">
                                    </div>
                                    @error("share_holder_revenue.$shreholder")
                                    <div style="color: red;">
                                        @php $message = preg_replace('/[0-9]+/', '', $message); @endphp
                                        {{ $message }}
                                    </div>
                                    @enderror
                                       </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                               <label for="share_holder_company_name" class="form-label">Company
                                                   name</label>
                                               <input wire:model="share_holder_company_name.{{ $shreholder }}" type="text"
                                                   class="form-control" id="share_holder_company_name.{{ $shreholder }}">
                                               @error("share_holder_company_name.$shreholder")
                                               <div style="color: red;">
                                                   @php $message = preg_replace('/[0-9]+/', '', $message); @endphp
                                                   {{ $message }}
                                               </div>
                                               @enderror
                                            </div>
                                               </div>
                                               <div class="col-md-4">
                                            <div class="mb-3">
                                               <label for="share_holder_website.{{ $shreholder }}"
                                               class="form-label">Company
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
                                    </div>
                                    <!-- /SHAREHOLDER__COMPANY DETAIL -->
                                </div>

                                @else
                                <div class="row">
                                    <div class="col-md-12" style="margin-top: 30px;">
                                        <label for="share_holder_company_name.{{ $shreholder }}"
                                            class="form-label">Please provide
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
                                            <select wire:model="share_holder_country.{{ $shreholder }}"
                                                class="form-select" aria-label="Default select example">
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
                                            :apply_loan="$apply_loan" :main_type="$main_type"
                                            :loan_type_id="$loan_type_id" :share_holder="0"
                                            :modell="'App\Models\LoanCompanyDetail'"
                                            :keyvalue="'parent_listed_company_subsidiary'" />

                                    </div>
                                </div>

                                @endif
                                <div class="mt-3">
                                        <button class="btn btn-custom" type="button" wire:target='share_holder_document_store'
                                            wire:click.prevent='share_holder_document_store({{ $shreholder  }})'>
                                            <span wire:loading wire:target="share_holder_document_store"
                                                class="spinner-border spinner-border-sm" role="status"
                                                aria-hidden="true"></span>
                                            Save & Continue
                                        </button>
                                </div>
                                @elseif($subtab == 2)


<!-- SHAREHOLDER COMPANY DOCUMENTS 1ST SECTION -->
<div class="border rounded p-3 mt-4">
    <div class="row mt-2">
        <p>  <b>6 months latest bank statement</b></p>
          <p>If It’s on or Over The 8th Of The Current Month For Example 8th Jan, You
              Would
              Need To
              Submit
              from Dec And Not Nov As The Latest Months. For companies less than 6 months
              old
              or
              unprofitable do check out our FAQ here.</p>
      </div>
    
      <!-- SHAREHOLDER COMPANY DOCUMENTS__FILE FEILD -->
      <div class="row mt-2">
          @for ($x = 1; $x < 8; $x++) <div class="col-md-6 col-lg-4 mb-3">
              @php $montName = date("M", strtotime( date( 'Y-m-01' )." -$x months")) @endphp
    
              <livewire:widget.upload-component :label="$montName" :keyvalue="$montName"
                  :key="$montName" :getImages="$images" :apply_loan="$apply_loan"
                  :main_type="$main_type" :loan_type_id="$loan_type_id" :share_holder="0"
                  :modell="'App\Models\LoanStatement'" />
      </div>
      @endfor
    </div>
    <!-- /SHAREHOLDER COMPANY DOCUMENTS__FILE FEILD -->
    
    <!-- SHAREHOLDER COMPANY DOCUMENTS__Consolidated Statement -->
    <div class="row mt-2">
      <p><b>OR</b></p>
      <p><b>Consolidated Statement.</b></p>
      <p class="mb-0">If Your Statement Is Not Spilt Between Months But One</p>
    </div>
    
    <div class="row">
      <div class="col-md-4">
          <livewire:widget.upload-component :label="''" :apply_loan="$apply_loan"
              :main_type="$main_type" :loan_type_id="$loan_type_id" :share_holder="0"
              :modell="'App\Models\LoanCompanyDetail'"
              :keyvalue="'parent_company_combine_statement'" />
      </div>
    </div>
    <!-- /SHAREHOLDER COMPANY DOCUMENTS__Consolidated Statement -->
</div>
<!-- /SHAREHOLDER COMPANY DOCUMENTS 1ST SECTION -->

   <!-- SHAREHOLDER COMPANY DOCUMENTS 2ND SECTION -->
    <div class="border rounded p-3 mt-4">
                  <!-- SHAREHOLDER COMPANY DOCUMENTS__LATEST YEAR -->
                  <div class="row mt-2">
                    <p><b>Latest {{ $company_year >= 3 ? '2' : '1' }} Years Financial Statement</b></p>
                    <p class="mb-1">
                        (Income Statement also known as Profit & Loss
                        + Statement of financial position also known as Balance Sheet)
                    </p>
                </div>

                <div class="row mt-2">
                    <div class="col-md-4">
                        <livewire:widget.upload-component :label="'Latest year'" :apply_loan="$apply_loan"
                            :main_type="$main_type" :loan_type_id="$loan_type_id"
                            :share_holder="$shreholder" :modell="'App\Models\LoanCompanyDetail'"
                            :keyvalue="'share_company_latest_year_statement'" />
            </div>
            @if(isset($share_holder_company_year[$shreholder]) &&
            $share_holder_company_year[$shreholder] >= 3)
            <div class="col-md-4">
                <livewire:widget.upload-component :label="'Before year'" :apply_loan="$apply_loan"
                    :main_type="$main_type" :loan_type_id="$loan_type_id" :share_holder="$shreholder"
                    :modell="'App\Models\LoanCompanyDetail'"
                    :keyvalue="'share_company_before_year_statement'" />
    </div>
    <div class="col-md-4"></div>
    @endif
</div>
<!-- /SHAREHOLDER COMPANY DOCUMENTS__LATEST YEAR -->

<!-- SHAREHOLDER COMPANY DOCUMENTS__PROFITABLE -->
<div class="row mt-4">
    <div class="col-md-4">
        <p> <b>Profitable for the last 2 accounting years</b></p>
    </div>
    <div class="col-md-4">
        <div class="form-group mb-3">
            <label for="">Before year</label>
            <select wire:model="share_holder_profitable_latest_year.{{ $shreholder }}" class="form-select"
                aria-label="Default select example">
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
    <div class="col-md-4">
        <div class="form-group mb-3">
            <label for="">Before year</label>
            <select wire:model="share_holder_profitable_before_year.{{ $shreholder }}" class="form-select"
                aria-label="Default select example">
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
</div>
<!-- /SHAREHOLDER COMPANY DOCUMENTS__PROFITABLE -->
    </div>
    <!-- /SHAREHOLDER COMPANY DOCUMENTS 2ND SECTION -->
    
    <!-- SHAREHOLDER COMPANY DOCUMENTS 3RD SECTION -->
    <div class="border rounded p-3 mt-4">
                    <!-- SHAREHOLDER COMPANY DOCUMENTS__OPTIONAL INFO -->
                    <div class="row mt-2">
                        <p class="text-muted"><b>Optional info</b></p>
                    </div>
        
                    <div class="row">
                        <p> <b>Current Year</b></p>
                        <p class="mb-0">If you are <b>more than 3-6 months into your current accounting year,</b> and
                            if
                            your
                            management account(drafts/unaudited) pulls up the average, providing them
                            may be
                            helpful
                        </p>
                    </div>
        
                    <div class="row">
                        <div class="col-md-4">
                            <livewire:widget.upload-component :label="''" :apply_loan="$apply_loan" :main_type="$main_type"
                                :loan_type_id="$loan_type_id" :share_holder="$shreholder"
                                :modell="'App\Models\LoanCompanyDetail'" :keyvalue="'share_company_current_year_statement'" />
                </div>
                <div class="col-md-8"></div>
        </div>
        <!-- /SHAREHOLDER COMPANY DOCUMENTS__OPTIONAL INFO -->
        
        <!-- SHAREHOLDER COMPANY DOCUMENTS__REVENUE -->
        <div class="row mt-4">
            <p> <b>Revenue (rounded up is fine)</b></p>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group mb-3">
                    <input type="number" class="form-control" wire:model="share_holder_optional_revenuee">
                    @error("share_holder_optional_revenuee.$shreholder")
                    <div style="color:red;">
                        @php $message = preg_replace('/[0-9]+/', '', $message); @endphp
                        {{ $message }}
                    </div>
                    @enderror
                </div>
            </div>
        </div>
        <!-- /SHAREHOLDER COMPANY DOCUMENTS__REVENUE -->
    </div>
    <!-- /SHAREHOLDER COMPANY DOCUMENTS 3RD SECTION -->



<div class="mt-3">
        <button class="btn btn-custom" type="button" wire:target='share_holder_document_store'
            wire:click.prevent='company_share_holder_documents_store({{ $shreholder  }})'>
            <span wire:loading wire:target="share_holder_document_store" class="spinner-border spinner-border-sm"
                role="status" aria-hidden="true"></span>
            Save & Continue
        </button>
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
