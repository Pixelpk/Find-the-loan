<div>
    @php
    $main_types = loanProfile();
    @endphp
    <section class="section-white small-padding" style="margin-top: 50px;">
        <div class="container">
            <div class="card" style="margin-top:30px;">
                <div class="card-body">
                    <ul class="nav nav-pills">
                        <li class="nav-item">
                            <a wire:click="$set('tab', '1')" style="padding: .1rem 1rem;"
                                class="nav-link {{ $tab == '1' ? 'active' : '' }}" aria-current="page" href="#">LOAN
                                TYPE</a>
                        </li>
                        
                        {{-- @if($loan_type_id) --}}
                        <li class="nav-item">
                            <a wire:click="goToReasons()" style="padding: .1rem 1rem;"
                                class="{{ !$loan_type_id ? 'disabled' : '' }} nav-link {{ $tab == '2' ? 'active' : '' }}"
                                href="#">REASON</a>
                        </li>
                        <li class="nav-item">
                            <a wire:click="storeReason()" aria-disabled="true" style="padding: .1rem 1rem;"
                                class="{{ !$loan_type_id ? 'disabled' : '' }} nav-link {{ $tab == '3' ? 'active' : '' }}"
                                href="#">AMOUNT</a>
                        </li>
                        <li class="nav-item">
                            <a wire:click="companyDetail()" style="padding: .1rem 1rem;"
                                class="{{ !$loan_type_id ? 'disabled' : '' }} nav-link {{ $tab == '4' ? 'active' : '' }}"
                                href="#">COMPANY DETAIL</a>
                        </li>
                        @if($apply_loan)
                        @if(!$listed_company_check)
                        <li class="nav-item">
                            <a wire:click="$set('tab', '5')" style="padding: .1rem 1rem;"
                                class="nav-link {{ $tab == '5' ? 'active' : '' }}" href="#">COMPANY DOCUMENTS</a>
                        </li>
                        @endif
                        @if($apply_loan && $apply_loan->parentCompany->number_of_share_holder > 0)
                        @if(!$this->listed_company_check)
                        {{-- <li class="nav-item">
                            <a wire:click="$set('tab', '6')" style="padding: .1rem 1rem;"
                                class="nav-link {{ $tab == '6' ? 'active' : '' }}" href="#">SHARE HOLDER TYPE</a>
                        </li> --}}
                        @endif

                        {{-- @if(sizeof($get_share_holder_type) > 0) --}}
                        <li class="nav-item">
                            <a wire:click="$set('tab', '7')" style="padding: .1rem 1rem;"
                                class="nav-link {{ $tab == '7' ? 'active' : '' }}" href="#">SHAREHOLDER</a>
                        </li>
                        {{-- @endif --}}
                        @endif
                        @endif
                    </ul>
                    <br>
                    <br>
                    @if(session('gernalMessage'))
                    <div class="alert alert-danger" role="alert">
                        {{ session('gernalMessage') }}
                    </div>
                    @endif
                    @if($tab == 1)
                    <div class="row g-3">
                        <div class="col-md-12">
                            <label for="">Select Profile</label>
                            <select style="margin-top: 10px;" wire:model="main_type" class="form-select"
                                aria-label="Default select example" wire:change="getMainType()">
                                <option value="" hidden>Select</option>
                                <option value="1">Business</option>
                                <option value="2">Consumer</option>
                            </select>
                        </div>
                    </div>
                    @if(sizeof($mainTypes) > 0)
                    <div class="row">
                        @foreach($mainTypes as $item)
                        <div class="col-md-3" style="padding-top:30px;">
                            <div class="list-group">
                                <a href="#" class="custmbtn list-group-item list-group-item-action active">
                                    {{ $item->main_type }}
                                </a>
                                @foreach($item->subTypes as $key => $subType)
                                <a class="list-group-item list-group-item-action">
                                    <div class="form-check form-switch">
                                        <input wire:model="values.{{ $subType->id }}"
                                            wire:click="getLoanReason({{ $subType->id }}, {{ $key }})"
                                            class="form-check-input singleCheck" type="checkbox" />
                                        <label class="form-check-label"
                                            for="{{ $subType->id }}">{{ $subType->sub_type }}</label>
                                    </div>
                                </a>
                                @endforeach
                            </div>
                        </div>
                        @endforeach
                    </div>
                    {{-- <div class="row">
                        <div class="col-12">
                            <br>
                            <button @if(!$loan_type_id) disabled @endif class="btn btn-primary" type="button"
                                wire:target='goToReasons' wire:click.prevent='goToReasons'>
                                <span wire:loading wire:target="goToReasons" class="spinner-border spinner-border-sm"
                                    role="status" aria-hidden="true"></span>
                                Submit
                            </button>
                        </div>
                    </div> --}}
                    @endif
                    @elseif($tab == 2)
                    <div class="row">
                        <div class="col-md-12 text-left" style="margin-top: 30px;"><b style="font-size: 30px;">Loan
                                Reason</b></div>
                        @foreach($loanReasons as $key => $item)
                        <div class="col-md-4" style="margin-top: 30px;">
                            <div class="form-check form-switch">
                                <input wire:model="reasonValue.{{ $item->id }}" class="form-check-input"
                                    type="checkbox" />
                                <label class="form-check-label" for="{{ $item->id }}">{{ $item->reason }}</label>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <br>
                            <button class="btn btn-primary" type="button" wire:target='storeReason'
                                wire:click.prevent='storeReason'>
                                <span wire:loading wire:target="storeReason" class="spinner-border spinner-border-sm"
                                    role="status" aria-hidden="true"></span>
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
                            <button wire:loading.attr='disabled' class="btn btn-primary" type="button"
                                wire:target='companyDetail' wire:click.prevent='companyDetail'>
                                <div wire:loading wire:target="companyDetail">
                                    <span class="spinner-border spinner-border-sm" role="status"
                                        aria-hidden="true"></span>
                                </div>
                                Submit
                            </button>

                        </div>
                    </div>
                    @elseif($tab == 4)

                    <div class="row">
                        <div class="col-md-12" style="margin-top: 40px;">
                            <div class="form-check form-switch">
                                <input wire:model="listed_company_check" class="form-check-input" type="checkbox"
                                    id="flexSwitchCheckDefault">
                                <label class="form-check-label" for="flexSwitchCheckDefault">This is a listed
                                    company</label>
                            </div>
                        </div>
                        @if(!$listed_company_check)
                        <div class="col-md-5" style="margin-top: 30px;">
                            <label for="company_year" class="form-label">How long has the company been in
                                business?</label>
                            <div class="input-group">
                                <input wire:click="resetComapny()" placeholder="Number of years"
                                    wire:model="company_year" type="number" class="form-control"
                                    aria-label="Text input with dropdown button">
                                &nbsp;&nbsp;<p style="padding-top:10px;">Years</p>
                            </div>
                            @error('company_year')
                            <div style="color: red;">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="col-md-3" style="margin-top: 30px;">
                            <div class="input-group" style="margin-top:29px;">
                                <input wire:click="resetComapny()" placeholder="Number of month"
                                    wire:model="company_month" type="number" class="form-control"
                                    aria-label="Text input with dropdown button">
                                &nbsp;&nbsp;<p style="padding-top:10px;">Months</p>
                            </div>
                            @error('company_month')
                            <div style="color: red;">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="col-md-12" style="margin-top:20px;margin-bottom:20px;"><b>OR</b></div>
                        <div class="col-md-5">
                            <label for="company_year">When was the company incorporated?
                            </label>
                            <div class="input-group">
                                {{-- <label for="">Year</label> --}}
                                <select {{ $company_year || $company_month ? 'disabled' : '' }}
                                    wire:model="company_years" class="form-select" aria-label="Default select example">
                                    <option value="" hidden>Select</option>
                                    @for ($x = 1990; $x <= date('Y'); $x++) <option value="{{ $x }}">{{ $x }}</option>
                                        @endfor
                                </select>
                                &nbsp;&nbsp;<p style="padding-top:10px;">Years</p>

                            </div>
                            @error('company_years')
                            <div style="color: red;">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="col-md-3">
                            <div class="input-group" style="margin-top:20px;">
                                <select {{ $company_year || $company_month ? 'disabled' : '' }}
                                    wire:model="company_months" class="form-select" aria-label="Default select example">
                                    <option value="" hidden>Select</option>
                                    @for ($x = 01; $x <= 12; $x++) <option value="1">{{ $x }}</option>
                                        @endfor
                                </select>
                                &nbsp;&nbsp;<p style="padding-top:10px;">Months</p>
                                @error('company_months')
                                <div style="color: red;">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4"></div>
                        <div class="col-md-6" style="margin-top: 30px;">
                            <label for="percentage_shareholder" class="form-label">% of local shareholding
                            </label>
                            <input wire:model="percentage_shareholder" type="number" class="form-control"
                                id="percentage_shareholder">
                            @error('percentage_shareholder')
                            <div style="color: red;">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="col-md-6" style="margin-top: 30px;">
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
                        <div class="col-md-6" style="margin-top: 30px;">
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
                        <div class="col-md-6" style="margin-top: 30px;">
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
                        <div class="col-md-6" style="margin-top: 30px;">
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

                        <div class="col-md-6" style="margin-top: 30px;">
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

                        <div class="col-md-6" style="margin-top: 30px;">
                            <label for="company_name" class="form-label">COMPANY NAME</label>
                            <input wire:model="company_name" type="text" class="form-control" id="company_name">
                            @error('company_name')
                            <div style="color: red;">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="col-md-6" style="margin-top: 30px;">
                            <label for="website" class="form-label">Company website (if available)</label>
                            <input wire:model="website" type="text" class="form-control" id="website">
                            @error('website')
                            <div style="color: red;">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>


                        @else
                        <div class="col-md-12" style="margin-top: 30px;">
                            <label for="company_name" class="form-label">Please provide either parent company name or
                                its ticker number followed by which stock exchange</label>
                            <input wire:model="company_name" type="text" class="form-control" id="company_name">
                            @error('company_name')
                            <div style="color: red;">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="col-md-12" style="margin-top:30px;">
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
                                        <input wire:model="subsidiary" type="file" id="vehicleimage">
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
                        @endif
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <br>
                            <button class="btn btn-primary" type="button" wire:target='companyDetailStore'
                                wire:click.prevent='companyDetailStore'>
                                <div wire:loading wire:target="companyDetailStore">
                                    <span class="spinner-border spinner-border-sm" role="status"
                                        aria-hidden="true"></span>
                                </div>
                                Submit
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
                            <div x-data="{ isUploading: false, progress: 0 }"
                                x-on:livewire-upload-start="isUploading = true"
                                x-on:livewire-upload-finish="isUploading = false"
                                x-on:livewire-upload-error="isUploading = false"
                                x-on:livewire-upload-progress="progress = $event.detail.progress">
                                <div class="form-group">
                                    <label class="control-label mb-10">
                                        @php echo date("M", strtotime( date( 'Y-m-01' )." -$x months")) @endphp

                                        @if(1 == $x) (Optional) @endif
                                    </label>
                                    <br>
                                    <label wire:ignore class="label" data-toggle="tooltip" title="Select Image">
                                        <input
                                            wire:model="photo.{{ date("M", strtotime( date( 'Y-m-01' )." -$x months")) }}"
                                            type="file" id="vehicleimage" name="" id="">
                                    </label>
                                </div>
                                @foreach(array_unique($errorArray) as $error)
                                @if($error == date("M", strtotime( date( 'Y-m-01' )." -$x months")))
                                <div class="text-danger">
                                    {{ $error. ' month required' }}
                                </div>
                                @endif
                                @endforeach
                                <div x-show="isUploading">
                                    <progress max="100" x-bind:value="progress"></progress>
                                </div>
                            </div>
                    </div>
                    @endfor

                    <b><br>OR</b>
                    <div class="row">
                        <div class="col-md-12" style="margin-top: 30px;">

                            <b>Consolidated Statement.</b>
                            <p>If Your Statement Is Not Spilt Between Months But One</p>
                        </div>
                        <div class="col-md-4 text-left">
                            <div x-data="{ isUploading: false, progress: 0 }"
                                x-on:livewire-upload-start="isUploading = true"
                                x-on:livewire-upload-finish="isUploading = false"
                                x-on:livewire-upload-error="isUploading = false"
                                x-on:livewire-upload-progress="progress = $event.detail.progress">

                                <div class="form-group">
                                    <label class="control-label mb-10">

                                    </label>

                                    <br>
                                    <label wire:ignore class="label" data-toggle="tooltip" title="Select Image">
                                        <input wire:model="statement" type="file" id="vehicleimage" name="" id="">

                                    </label>
                                </div>
                                @error('statement')
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
                            <div x-data="{ isUploading: false, progress: 0 }"
                                x-on:livewire-upload-start="isUploading = true"
                                x-on:livewire-upload-finish="isUploading = false"
                                x-on:livewire-upload-error="isUploading = false"
                                x-on:livewire-upload-progress="progress = $event.detail.progress">

                                <div class="form-group">
                                    <label class="control-label mb-10">
                                        <label for="">Latest year</label>
                                    </label>

                                    <br>
                                    <input wire:model="latest_year" type="file" id="vehicleimage" name="" id="">

                                </div>
                                @error('latest_year')
                                <div style="color: red;">
                                    {{ $message }}
                                </div>
                                @enderror


                                <div x-show="isUploading">
                                    <progress max="100" x-bind:value="progress"></progress>
                                </div>
                            </div>
                        </div>
                        @if($getNumberOfCompanyYears >= 3)
                        <div class="col-md-3 text-left" style="margin-top: 30px;">
                            <div x-data="{ isUploading: false, progress: 0 }"
                                x-on:livewire-upload-start="isUploading = true"
                                x-on:livewire-upload-finish="isUploading = false"
                                x-on:livewire-upload-error="isUploading = false"
                                x-on:livewire-upload-progress="progress = $event.detail.progress">
                                <div class="form-group">
                                    <label class="control-label mb-10">
                                        <label for="">Before year</label>
                                    </label>
                                    <br>
                                    <input wire:model="year_before" type="file" id="vehicleimage" name="" id="">
                                </div>
                                @error('year_before')
                                <div style="color: red;">
                                    {{ $message }}
                                </div>
                                @enderror
                                <div x-show="isUploading">
                                    <progress max="100" x-bind:value="progress"></progress>
                                </div>
                            </div>
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
                            <div x-data="{ isUploading: false, progress: 0 }"
                                x-on:livewire-upload-start="isUploading = true"
                                x-on:livewire-upload-finish="isUploading = false"
                                x-on:livewire-upload-error="isUploading = false"
                                x-on:livewire-upload-progress="progress = $event.detail.progress">
                                <div class="form-group">
                                    <label class="control-label mb-10">
                                    </label>
                                    <br>
                                    <input wire:model="current_year" type="file" id="vehicleimage" name="" id="">
                                </div>
                                @error('current_year')
                                <div style="color: red;text-align:center">
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
                        <button class="btn btn-primary" type="button" wire:target='saveCompanyDocuments'
                            wire:click.prevent='saveCompanyDocuments'>
                            <span wire:loading wire:target="saveCompanyDocuments"
                                class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                            Submit
                        </button>
                    </div>
                </div>
                @endif
                {{-- @elseif($tab == 6)
                <div class="row">
                    @if($errorMessage)
                    <div class="col-md-12">
                        <br>
                        <br>
                        <div class="alert alert-danger" role="alert">
                            {{ $errorMessage }}
            </div>
        </div>
        @endif
        @if($apply_loan && $apply_loan->parentCompany->number_of_share_holder > 0)
        @for ($count = 1; $count <= $apply_loan->parentCompany->number_of_share_holder; $count++) <div class="col-md-12"
                style="margin-top:30px;">
                <label for="">Share holder type</label>
                <select @if($apply_loan->getNnumberOfShareHolder->count() > 0) disabled @endif
                    wire:model="all_share_holder.{{ $count }}" class="form-select"
                    aria-label="Default select example">
                    <option value="" hidden>Select</option>
                    <option value="1">Person</option>
                    <option value="2">Company</option>
                </select>
            </div>
            @endfor
            @endif
            <div class="col-12">
                <br>
                <button class="btn btn-primary" type="button" wire:target='share_holder_detail'
                    wire:click.prevent='share_holder_detail'>
                    <span wire:loading wire:target="share_holder_detail" class="spinner-border spinner-border-sm"
                        role="status" aria-hidden="true"></span>
                    Submit
                </button>
            </div>
</div> --}}
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
            <input wire:model="checkShareHolder.{{ $item['id'] }}" wire:change="getShareholderTypeId({{ $item['id'] }})"
                class="form-check-input" type="checkbox" value="" id="{{ $item['id'] }}">
            <label class="form-check-label" for="{{ $item['id'] }}">
                Company
            </label>
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
                <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne{{ $shreholder }}"
                    aria-expanded="true" aria-controls="collapseOne{{ $shreholder }}">
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
                                <input wire:model="nric_front.{{ $shreholder }}" type="file" id="vehicleimage" name=""
                                    id="">
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
                                <input wire:model="nric_back.{{ $shreholder }}" type="file" id="vehicleimage" name=""
                                    id="">
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
                                <input wire:model="passport.{{ $shreholder }}" type="file" id="vehicleimage" name=""
                                    id="">
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
                                <input wire:model="nao_latest.{{ $shreholder }}" type="file" id="vehicleimage" name=""
                                    id="">
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
                                <input wire:model="nao_older.{{ $shreholder }}" type="file" id="vehicleimage" name=""
                                    id="">
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
                        <select class="form-control" name="" id="" wire:model.defer="not_proof.{{ $shreholder }}">
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
                        <button class="btn btn-primary" type="button" wire:target='share_holder_document_store'
                            wire:click.prevent='share_holder_document_store({{ $item['id'] }})'>
                            <span wire:loading wire:target="share_holder_document_store"
                                class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                            Submit
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
                <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne{{ $shreholder }}"
                    aria-expanded="true" aria-controls="collapseOne{{ $shreholder }}">
                    Shareholder Company {{ $key++ }}
                </button>
            </h5>
        </div>
        <div wire:ignore.self id="collapseOne{{ $shreholder }}" class="collapse" aria-labelledby="{{ $shreholder }}"
            data-parent="#accordion">
            <div class="card-body">
                <ul class="nav nav-pills">
                    <li class="nav-item">
                        <a wire:click="$set('subtab', '1')" style="padding: .1rem 1rem;"
                            class="nav-link {{ $subtab == '1' ? 'active' : '' }}" href="#">SHAREHOLDER
                            COMPANY
                            DETAIL</a>
                    </li>
                    <li class="nav-item">
                        <a wire:click="$set('subtab', '2')" style="padding: .1rem 1rem;"
                            class="nav-link {{ $subtab == '2' ? 'active' : '' }}" href="#">SHAREHOLDER
                            COMPANY
                            DOCUMENTS</a>
                    </li>
                </ul>
                @if($subtab == 1)
                <div class="row" style="margin-top:30px;">
                    <div class="col-md-12">
                        <div class="form-check form-switch">
                            <input wire:model="listed_company_check" class="form-check-input" type="checkbox"
                                id="flexSwitchCheckDefault">
                            <label class="form-check-label" for="flexSwitchCheckDefault">This is a
                                listed
                                company</label>
                        </div>
                    </div>

                    {{-- <div class="col-md-6" style="margin-top: 30px;">
                        <label for="share_holder_company_year.{{ $shreholder }}" class="form-label">How
                    long
                    has the company</label>
                    <div class="input-group">
                        <input placeholder="yy" wire:model="share_holder_company_year.{{ $shreholder }}" type="number"
                            class="form-control" aria-label="Text input with dropdown button">
                        <select wire:model="share_holder_company_month.{{ $shreholder }}" class="form-select"
                            aria-label="Default select example" wire:change="getMainType()">
                            <option value="" hidden>Select Month</option>
                            <option value="1">01</option>
                            <option value="2">02</option>
                            <option value="3">03</option>
                            <option value="4">04</option>
                            <option value="5">05</option>
                            <option value="6">06</option>
                            <option value="7">07</option>
                            <option value="8">08</option>
                            <option value="9">09</option>
                            <option value="10">10</option>
                            <option value="11">11</option>
                            <option value="12">12</option>
                        </select>
                    </div>
                    @error("share_holder_company_year.$shreholder")
                    <div style="color: red;">
                        @php $message = preg_replace('/[0-9]+/', '', $message); @endphp
                        {{ $message }}
                    </div>
                    @enderror
                    @error("share_holder_company_month.$shreholder")
                    <div style="color: red;">
                        @php $message = preg_replace('/[0-9]+/', '', $message); @endphp
                        {{ $message }}
                    </div>
                    @enderror
                </div> --}}
                <div class="col-md-5" style="margin-top: 30px;">
                    <label for="share_holder_company_year.{{ $shreholder }}" class="form-label">How long has the company
                        been in
                        business?</label>
                    <div class="input-group">
                        <input wire:click="shareHolderResetComapny({{ $shreholder }})" placeholder="Number of years"
                            wire:model="share_holder_company_year.{{ $shreholder }}" type="number" class="form-control"
                            aria-label="Text input with dropdown button">
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
                        <input wire:click="shareHolderResetComapny({{ $shreholder }})" placeholder="Number of month"
                            wire:model="share_holder_company_month.{{ $shreholder }}" type="number" class="form-control"
                            aria-label="Text input with dropdown button">
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
                    <label for="share_holder_company_years.{{ $shreholder }}">When was the company incorporated?
                    </label>
                    <div class="input-group">
                        {{-- <label for="">Year</label> --}}
                        <select {{ isset($share_holder_company_year[$shreholder]) || isset( $share_holder_company_month[$shreholder]) ? 'disabled' : '' }}
                            wire:model="share_holder_company_years.{{ $shreholder }}" class="form-select"
                            aria-label="Default select example">
                            <option value="" hidden>Select</option>
                            @for ($x = 1990; $x <= date('Y'); $x++) <option value="{{ $x }}">{{ $x }}</option>
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
                        <select
                            {{ isset($share_holder_company_year[$shreholder]) || isset( $share_holder_company_month[$shreholder]) ? 'disabled' : '' }}
                            wire:model="share_holder_company_months.{{ $shreholder }}" class="form-select"
                            aria-label="Default select example">
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
                    <label for="share_holder_percentage_shareholder.{{ $shreholder }}" class="form-label">% of local
                        shareholding
                    </label>
                    <input wire:model="share_holder_percentage_shareholder.{{ $shreholder }}" type="number"
                        class="form-control" id="share_holder_percentage_shareholder.{{ $shreholder }}">
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
                    <input wire:model="share_holder_number_of_share_holder.{{ $shreholder }}" type="number"
                        class="form-control" id="share_holder_number_of_share_holder.{{ $shreholder }}">
                    @error("share_holder_number_of_share_holder.$shreholder")
                    <div style="color: red;">
                        @php $message = preg_replace('/[0-9]+/', '', $message); @endphp
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="col-md-6" style="margin-top: 30px;">
                    <label class="form-label">Company structure type</label>
                    <select wire:model="share_holder_company_structure_type_id.{{ $shreholder }}" class="form-select"
                        aria-label="Default select example">
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
                        <input placeholder="$" wire:model="share_holder_revenue.{{ $shreholder }}" type="number"
                            class="form-control" aria-label="Text input with dropdown button">
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
                    <input wire:model="share_holder_company_name.{{ $shreholder }}" type="text" class="form-control"
                        id="share_holder_company_name.{{ $shreholder }}">
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
                    <input wire:model="share_holder_website.{{ $shreholder }}" type="text" class="form-control"
                        id="share_holder_website.{{ $shreholder }}">
                    @error("share_holder_website.$shreholder")
                    <div style="color: red;">
                        @php $message = preg_replace('/[0-9]+/', '', $message); @endphp
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="col-12">
                    <br>
                    <button class="btn btn-primary" type="button" wire:target='share_holder_document_store'
                        wire:click.prevent='share_holder_document_store({{ $shreholder  }})'>
                        <span wire:loading wire:target="share_holder_document_store"
                            class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                        Submit
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
                    <div x-data="{ isUploading: false, progress: 0 }" x-on:livewire-upload-start="isUploading = true"
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
                                <input
                                    wire:model="share_holder_photo.{{ $shreholder }}.{{ date("M", strtotime( date( 'Y-m-01' )." -$x months")) }}"
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
                    </div>
            </div>
            @endfor
            <b><br>OR</b>
            <div class="row">
                <div class="col-md-12" style="margin-top: 30px;">

                    <b>Consolidated Statement.</b>
                    <p>If Your Statement Is Not Spilt Between Months But One</p>
                </div>
                <div class="col-md-4 text-left">
                    <div x-data="{ isUploading: false, progress: 0 }" x-on:livewire-upload-start="isUploading = true"
                        x-on:livewire-upload-finish="isUploading = false"
                        x-on:livewire-upload-error="isUploading = false"
                        x-on:livewire-upload-progress="progress = $event.detail.progress">
                        <div class="form-group">
                            <label class="control-label mb-10">
                            </label>
                            <br>
                            <label wire:ignore class="label" data-toggle="tooltip" title="Select Image">
                                <input wire:model="share_holder_statement.{{ $shreholder }}" type="file"
                                    id="vehicleimage" name="" id="">
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
                    </div>
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
                    <div x-data="{ isUploading: false, progress: 0 }" x-on:livewire-upload-start="isUploading = true"
                        x-on:livewire-upload-finish="isUploading = false"
                        x-on:livewire-upload-error="isUploading = false"
                        x-on:livewire-upload-progress="progress = $event.detail.progress">
                        <div class="form-group">
                            <label class="control-label mb-10">
                                <label for="">Latest year</label>
                            </label>
                            <br>
                            <input wire:model="share_holder_latest_year.{{ $shreholder }}" type="file" id="vehicleimage"
                                name="" id="">
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
                    </div>
                </div>
                @if(isset($share_holder_company_year[$shreholder]) &&
                $share_holder_company_year[$shreholder] >= 3)
                <div class="col-md-3 text-left" style="margin-top: 30px;">
                    <div x-data="{ isUploading: false, progress: 0 }" x-on:livewire-upload-start="isUploading = true"
                        x-on:livewire-upload-finish="isUploading = false"
                        x-on:livewire-upload-error="isUploading = false"
                        x-on:livewire-upload-progress="progress = $event.detail.progress">
                        <div class="form-group">
                            <label class="control-label mb-10">
                                <label for="">Before year</label>
                            </label>
                            <br>
                            <input wire:model="share_holder_year_before.{{ $shreholder }}" type="file" id="vehicleimage"
                                name="" id="">
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
                    </div>
                </div>
                @endif
            </div>
            <div class="row">
                <div class="col-md-12" style="margin-top: 30px;">
                    <b>Profitable for the last 2 accounting years</b>
                </div>
                <div class="col-md-4" style="margin-top: 30px;">

                    <div class="form-group">

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
                <div class="col-md-4" style="margin-top: 30px;">
                    <div class="form-group">
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
                    <div x-data="{ isUploading: false, progress: 0 }" x-on:livewire-upload-start="isUploading = true"
                        x-on:livewire-upload-finish="isUploading = false"
                        x-on:livewire-upload-error="isUploading = false"
                        x-on:livewire-upload-progress="progress = $event.detail.progress">
                        <div class="form-group">
                            <label class="control-label mb-10">
                            </label>
                            <br>
                            <input wire:model="share_holder_current_year" type="file" id="vehicleimage" name="" id="">
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
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12" style="margin-top: 30px;">
                    <b>Revenue (rounded up is fine)</b>
                </div>
                <div class="col-md-3" style="margin-top: 30px;">
                    <div class="form-group">
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
            <div class="row">
                <div class="col-md-12">
                    <button class="btn btn-primary" type="button" wire:target='share_holder_document_store'
                        wire:click.prevent='company_share_holder_documents_store({{ $shreholder  }})'>
                        <span wire:loading wire:target="share_holder_document_store"
                            class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                        Submit
                    </button>
                </div>
            </div>
        </div>
        @endif
    </div>
</div>
</div>
@endif
@endforeach
{{--
@foreach($get_share_holder_type as $key => $item)
@if($item['share_holder_type'] == 2)

@endif
@endforeach --}}
</div>
@endif
</div>
</div>
</div>
<script>
    $(document).on('click', '.singleCheck', function () {
        $('.singleCheck').not(this).prop('checked', false);
    });

</script>

<script>
    $(document).on('click', '.customchk', function () {
        $('.customchk').not(this).prop('checked', false);
    });

</script>
<script>
    window.addEventListener('name-updated', event => {
        alert('Name updated to: ' + event.detail.newName);
    })
    </script>
</section>

</div>
