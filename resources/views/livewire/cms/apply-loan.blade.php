<section class="section-white pb-4" id="apply-loan">
    @php $main_types = loanProfile(); @endphp
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
                            class="{{ isset($enable['companyDetail']) ? '' : 'disabled' }} nav-link {{ $tab == '4' ? 'active' : '' }}"
                            href="#">COMPANY DETAIL</a>
                    </li>

                    {{-- @if(!$this->listed_company_check) --}}
                    <li class="nav-item" style="display: none;">
                        <a wire:click="$set('tab', '5')" style="padding: .1rem 1rem;"
                            class=" nav-link {{ $tab == '5' ? 'active' : '' }}" href="#">COMPANY DOCUMENTS</a>
                    </li>
                    <li class="nav-item">
                        <a wire:click="$set('tab', '5')" style="padding: .1rem 1rem;"
                            class="{{ isset($enable['companyDocuments']) ? '' : 'disabled' }} nav-link {{ $tab == '5' ? 'active' : '' }}"
                            href="#">COMPANY DOCUMENTS</a>
                    </li>

                    <li class="nav-item">
                        <a wire:click="$set('tab', '7')" style="padding: .1rem 1rem;"
                            class="{{ isset($enable['companyShareHolder']) ? '' : 'disabled' }} nav-link {{ $tab == '7' ? 'active' : '' }}"
                            href="#">SHAREHOLDER</a>
                    </li>
                    {{-- @endif --}}

                    @else
                    <li class="nav-item">
                        <a wire:click="$set('tab', '10')" style="padding: .1rem 1rem;"
                            class="nav-link {{ $tab == '10' ? 'active' : '' }}" href="#">CONSUMER DETAIL</a>
                    </li>
                    @endif
                    @if(!$lenderflag)
                    <li class="nav-item">
                        <a wire:click="$set('tab', '9')" style="padding: .1rem 1rem;"
                            class="{{ isset($enable['lender']) ? '' : 'disabled' }} nav-link {{ $tab == '9' ? 'active' : '' }}"
                            href="#">FINANCING PARTNERS</a>
                    </li>
                    @elseif($lenderflag)
                    <li class="nav-item">
                        <a wire:click="$set('tab', '9')" style="padding: .1rem 1rem;"
                            class=" nav-link {{ $tab == '9' ? 'active' : '' }}" href="#">FINANCING PARTNERS</a>
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

                @elseif($tab == 8 && $loan_type_id == 27)
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
                @elseif($tab == 8 && $loan_type_id == 14 || $loan_type_id == 28)

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

                @elseif($tab == 8 && $loan_type_id == 2)

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

                @if(sizeof($loanReasons) > 0 && $main_type == 1)

                <div class="row">
                    <br>
                    <br>
                    <hr>
                    <h5>Reason For Loan</h5>
                </div>

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

                <div class="row text-end">
                    <div>
                        <br>
                        <br>
                        <button class="btn" wire:click="storeReasonLoanType">Save & Continue</button>
                    </div>
                </div>
                @else
                @if($loan_type_id == 19 || $loan_type_id == 25)
                <div class="row">
                    <br>
                    <br>
                    <hr class="mt-4">
                    <h5>Reason For Loan</h5>
                </div>

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

                <div class="row text-end">
                    <div>
                        <br>
                        <br>
                        <button class="btn" wire:click="storeReasonLoanType">Save & Continue</button>
                    </div>
                </div>
                @else
                <div class="row text-end">
                    <div>
                        <br>
                        <br>
                        <button class="btn" wire:click="storeReasonLoanType">Save & Continue</button>
                    </div>
                </div>
                @endif
                @endif
                @endif
                {{-- get lender --}}
                @elseif($tab == 9)
                <livewire:loan.lender :apply_loan="$apply_loan">
                    {{-- get lender --}}
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
                            <button wire:loading.attr='disabled' class="btn btn-custom" type="button"
                                wire:target='companyDetail' wire:click.prevent='companyDetail'>
                                <div wire:loading wire:target="companyDetail">
                                    <span class="spinner-border spinner-border-sm" role="status"
                                        aria-hidden="true"></span>
                                </div>
                                Save & Continue
                            </button>
                        </div>
                    </div>
                    @elseif($tab == 4)
                    <livewire:loan.company-detail :apply_loan="$apply_loan" :share_holder="$share_holder">
                        <!-- COMPANY DOCUMENTS__TOPCONTENT -->
                        @elseif($tab == 5)
                        <livewire:loan.company-documents :apply_loan="$apply_loan" :share_holder="$share_holder">
                            @elseif($tab == 7)
                            <livewire:loan.company-share-holder :apply_loan="$apply_loan">
                                @endif
            </div>

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
</section>
