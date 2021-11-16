<section>
    @php $srno = 1; @endphp
    @php $no = 1; @endphp
    <!-- SHAREHOLDER__SELECT -->
    <div class="row">
        @foreach($get_share_holder_type as $key => $item)
        <div class="col-md-4 col-lg-2 mb-3">
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
        <div class="col-md-4 col-lg-3 mb-3">
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
        <div class="card">
            @php $shreholder = $item['id'] @endphp
            <div class="card-header" id="{{ $shreholder }}">
                <h5 class="mb-0">
                    <button class="btn" data-toggle="collapse" data-target="#collapseOne{{ $shreholder }}"
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
                        <p class="mb-1"> <b>NRIC</b> or <b>Passport/Identity Card</b> (
                            Foreigner)</p>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div x-data="{ isUploading: false, progress: 0 }"
                                x-on:livewire-upload-start="isUploading = true"
                                x-on:livewire-upload-finish="isUploading = false"
                                x-on:livewire-upload-error="isUploading = false"
                                x-on:livewire-upload-progress="progress = $event.detail.progress">
                                <div class="form-group">
                                    <br>
                                    <label for="">NRIC Front</label>
                                    <input wire:model="nric_front.{{ $shreholder }}"
                                        accept="image/jpeg,image/gif,image/png,application/pdf,image/x-eps" type="file"
                                        class="form-control" id="vehicleimage" name="" id="">
                                    </label>
                                </div>
                                @error("nric_front.$shreholder")
                                <div style="color: red;">
                                    @php $message = preg_replace('/[0-9]+/', '', $message);
                                    @endphp
                                    {{ $message }}
                                </div>
                                @enderror
                                <div x-show="isUploading">
                                    <progress max="100" x-bind:value="progress"></progress>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div x-data="{ isUploading: false, progress: 0 }"
                                x-on:livewire-upload-start="isUploading = true"
                                x-on:livewire-upload-finish="isUploading = false"
                                x-on:livewire-upload-error="isUploading = false"
                                x-on:livewire-upload-progress="progress = $event.detail.progress">
                                <div class="form-group">
                                    <br>
                                    <label for="">NRIC Back</label>
                                    <input wire:model="nric_back.{{ $shreholder }}"
                                        accept="image/jpeg,image/gif,image/png,application/pdf,image/x-eps" type="file"
                                        class="form-control" id="vehicleimage" name="" id="">
                                    </label>
                                </div>
                                @error("nric_back.$shreholder")
                                <div style="color: red;">
                                    @php $message = preg_replace('/[0-9]+/', '', $message);
                                    @endphp
                                    {{ $message }}
                                </div>
                                @enderror
                                <div x-show="isUploading">
                                    <progress max="100" x-bind:value="progress"></progress>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div x-data="{ isUploading: false, progress: 0 }"
                                x-on:livewire-upload-start="isUploading = true"
                                x-on:livewire-upload-finish="isUploading = false"
                                x-on:livewire-upload-error="isUploading = false"
                                x-on:livewire-upload-progress="progress = $event.detail.progress">
                                <div class="form-group">
                                    <br>
                                    <label for="">Passport</label>
                                    <input wire:model="passport.{{ $shreholder }}"
                                        accept="image/jpeg,image/gif,image/png,application/pdf,image/x-eps" type="file"
                                        class="form-control" id="vehicleimage" name="" id="">
                                    </label>
                                </div>
                                @error("passport.$shreholder")
                                <div style="color: red;">
                                    @php $message = preg_replace('/[0-9]+/', '', $message);
                                    @endphp
                                    {{ $message }}
                                </div>
                                @enderror
                                <div x-show="isUploading">
                                    <progress max="100" x-bind:value="progress"></progress>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-4">
                        <p class="mb-1"> <b>Personal NOA</b></p>
                        <p class="mb-1">(Notice of Assessment) 2 Years</p>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div x-data="{ isUploading: false, progress: 0 }"
                                x-on:livewire-upload-start="isUploading = true"
                                x-on:livewire-upload-finish="isUploading = false"
                                x-on:livewire-upload-error="isUploading = false"
                                x-on:livewire-upload-progress="progress = $event.detail.progress">
                                <div class="form-group">
                                    <br>
                                    <label for="">Latest</label>
                                    <input wire:model="nao_latest.{{ $shreholder }}"
                                        accept="image/jpeg,image/gif,image/png,application/pdf,image/x-eps" type="file"
                                        class="form-control" id="vehicleimage" name="" id="">
                                    </label>
                                </div>
                                @error("nao_latest.$shreholder")
                                <div style="color: red;">
                                    @php $message = preg_replace('/[0-9]+/', '', $message);
                                    @endphp
                                    {{ $message }}
                                </div>
                                @enderror
                                <div x-show="isUploading">
                                    <progress max="100" x-bind:value="progress"></progress>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div x-data="{ isUploading: false, progress: 0 }"
                                x-on:livewire-upload-start="isUploading = true"
                                x-on:livewire-upload-finish="isUploading = false"
                                x-on:livewire-upload-error="isUploading = false"
                                x-on:livewire-upload-progress="progress = $event.detail.progress">
                                <div class="form-group">
                                    <br>
                                    <label for="">Older</label>
                                    <input wire:model="nao_older.{{ $shreholder }}"
                                        accept="image/jpeg,image/gif,image/png,application/pdf,image/x-eps" type="file"
                                        class="form-control" id="vehicleimage" name="" id="">
                                    </label>
                                </div>
                                @error("nao_older.$shreholder")
                                <div style="color: red;">
                                    @php $message = preg_replace('/[0-9]+/', '', $message);
                                    @endphp
                                    {{ $message }}
                                </div>
                                @enderror
                                <div x-show="isUploading">
                                    <progress max="100" x-bind:value="progress"></progress>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-4">
                        <p> <b>I don't have income proof because i am</b></p>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-4">
                            <select class="form-select" name="" id="" wire:model.defer="not_proof.{{ $shreholder }}">
                                <option value="" hidden>Select</option>
                                <option value="1">Student</option>
                                <option value="2">Homemaker</option>
                                <option value="3">Retired</option>
                                <option value="4">Unemployed</option>
                            </select>
                            @error("not_proof.$shreholder")
                            <div style="color: red;">
                                @php $message = preg_replace('/[0-9]+/', '', $message);
                                @endphp
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="ro">
                        <br>
                        <button class="btn" type="button" wire:target='share_holder_document_store'
                            wire:click.prevent='share_holder_document_store({{ $item['id'] }})'>
                            <span wire:loading wire:target="share_holder_document_store"
                                class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                            Save
                        </button>
                    </div>
                    <!-- /SHAREHOLDER__SELECT PERSON -->
                </div>
            </div>
        </div>
        @else
        <div class="card">
            @php $shreholder = $item['id'] @endphp
            <div class="card-header" id="{{ $shreholder }}">
                <h5 class="mb-0">
                    <button class="btn" data-toggle="collapse" data-target="#collapseOne{{ $shreholder }}"
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
            <div wire:ignore.self id="collapseOne{{ $shreholder }}" class="collapse" aria-labelledby="{{ $shreholder }}"
                data-parent="#accordion">
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

                    <div class="row">
                        <!-- SHAREHOLDER__COMPANY DETAIL -->
                        <div class="row mt-3">
                            <div class="col-md-5">
                                <div class="row">
                                    <p>When was the company incorporated?</p>
                                    <div class="col-md-6">
                                        <div class="input-group">
                                            {{-- <label for="">Year</label> --}}
                                            <select
                                                {{ isset($share_holder_company_year[$shreholder]) || isset( $share_holder_company_month[$shreholder]) ? 'disabled' : '' }}
                                                wire:model="share_holder_company_years.{{ $shreholder }}"
                                                class="form-select" aria-label="Default select example">
                                                <option value="" hidden>Select</option>
                                                @for ($x = 1990; $x <= date('Y'); $x++) <option value="{{ $x }}">
                                                    {{ $x }}</option>
                                                    @endfor
                                            </select>
                                            <label class="input-group-text">Year</label>
                                        </div>
                                        @error("share_holder_company_years.$shreholder")
                                        <div style="color: red;">
                                            @php $message = preg_replace('/[0-9]+/', '',
                                            $message); @endphp
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
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
                                            @error("share_holder_company_months.$shreholder")
                                            <div style="color: red;">
                                                @php $message = preg_replace('/[0-9]+/', '',
                                                $message);
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
                                        <div class="input-group">
                                            <input wire:click="shareHolderResetComapny({{ $shreholder }})"
                                                placeholder="Number of years"
                                                wire:model="share_holder_company_year.{{ $shreholder }}" type="number"
                                                class="form-control" aria-label="Text input with dropdown button">
                                            <label class="input-group-text">Years</label>
                                        </div>
                                        @error("share_holder_company_year.$shreholder")
                                        <div style="color: red;">
                                            @php $message = preg_replace('/[0-9]+/', '',
                                            $message); @endphp
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <div class="input-group">
                                            <input wire:click="shareHolderResetComapny({{ $shreholder }})"
                                                placeholder="Number of month"
                                                wire:model="share_holder_company_month.{{ $shreholder }}" type="number"
                                                class="form-control" aria-label="Text input with dropdown button">
                                            <label class="input-group-text">Months</label>
                                        </div>
                                        @error("share_holder_company_month.$shreholder")
                                        <div style="color: red;">
                                            @php $message = preg_replace('/[0-9]+/', '',
                                            $message); @endphp
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-md-6">
                                <label for="share_holder_percentage_shareholder.{{ $shreholder }}" class="form-label">%
                                    of
                                    local
                                    shareholding
                                </label>
                                <input wire:model="share_holder_percentage_shareholder.{{ $shreholder }}" type="number"
                                    class="form-control" id="share_holder_percentage_shareholder.{{ $shreholder }}">
                                @error("share_holder_percentage_shareholder.$shreholder")
                                <div style="color: red;">
                                    @php $message = preg_replace('/[0-9]+/', '', $message);
                                    @endphp
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="share_holder_number_of_share_holder" class="form-label">Number
                                    of
                                    shareholder including
                                    parent
                                    company if any
                                </label>
                                <input wire:model="share_holder_number_of_share_holder.{{ $shreholder }}" type="number"
                                    class="form-control" id="share_holder_number_of_share_holder.{{ $shreholder }}">
                                @error("share_holder_number_of_share_holder.$shreholder")
                                <div style="color: red;">
                                    @php $message = preg_replace('/[0-9]+/', '', $message);
                                    @endphp
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-md-6">
                                <label class="form-label">Company structure type</label>
                                <select wire:model="share_holder_company_structure_type_id.{{ $shreholder }}"
                                    class="form-select" aria-label="Default select example">
                                    <option value="" hidden>Select</option>
                                    @foreach($company_structure_types as $item)
                                    <option value="{{ $item->id }}">
                                        {{ $item->structure_type }}</option>
                                    @endforeach
                                </select>
                                @error("share_holder_company_structure_type_id.$shreholder")
                                <div style="color: red;">
                                    @php $message = preg_replace('/[0-9]+/', '', $message);
                                    @endphp
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="col-md-6"">
                                        <label class=" form-label" for="">Sector</label>
                                <select wire:model="share_holder_sector_id.{{ $shreholder }}" class="form-select"
                                    aria-label="Default select example">
                                    <option value="" hidden>Select</option>
                                    @foreach($sectors as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}
                                    </option>
                                    @endforeach
                                </select>
                                @error("share_holder_sector_id.$shreholder")
                                <div style="color: red;">
                                    @php $message = preg_replace('/[0-9]+/', '', $message);
                                    @endphp
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-md-6">
                                <label for="share_holder_number_of_employees" class="form-label">Number of
                                    full-time
                                    employee
                                </label>
                                <input wire:model="share_holder_number_of_employees.{{ $shreholder }}" type="number"
                                    class="form-control" id="share_holder_number_of_employees.{{ $shreholder }}">
                                @error("share_holder_number_of_employees.$shreholder")
                                <div style="color: red;">
                                    @php $message = preg_replace('/[0-9]+/', '', $message);
                                    @endphp
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="share_holder_revenue.{{ $shreholder }}" class="form-label">Revenue
                                    (rounded up is fine)</label>
                                <div class="input-group">
                                    <input placeholder="$" wire:model="share_holder_revenue.{{ $shreholder }}"
                                        type="number" class="form-control" aria-label="Text input with dropdown button">
                                </div>
                                @error("share_holder_revenue.$shreholder")
                                <div style="color: red;">
                                    @php $message = preg_replace('/[0-9]+/', '', $message);
                                    @endphp
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-md-6">
                                <label for="share_holder_company_name" class="form-label">Company
                                    name</label>
                                <input wire:model="share_holder_company_name.{{ $shreholder }}" type="text"
                                    class="form-control" id="share_holder_company_name.{{ $shreholder }}">
                                @error("share_holder_company_name.$shreholder")
                                <div style="color: red;">
                                    @php $message = preg_replace('/[0-9]+/', '', $message);
                                    @endphp
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="share_holder_website.{{ $shreholder }}" class="form-label">Company
                                    website (if available)</label>
                                <input wire:model="share_holder_website.{{ $shreholder }}" type="text"
                                    class="form-control" id="share_holder_website.{{ $shreholder }}">
                                @error("share_holder_website.$shreholder")
                                <div style="color: red;">
                                    @php $message = preg_replace('/[0-9]+/', '', $message);
                                    @endphp
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <!-- /SHAREHOLDER__COMPANY DETAIL -->
                    </div>

                    @else
                    <div class="row">
                        <div class="col-md-12" style="margin-top: 30px;">
                            <label for="share_holder_company_name.{{ $shreholder }}" class="form-label">Please provide
                                either parent company name or
                                its ticker number followed by which stock exchange</label>
                            <input wire:model="share_holder_company_name.{{ $shreholder }}" type="text"
                                class="form-control" id="share_holder_company_name.{{ $shreholder }}">
                            @error("share_holder_company_name.$shreholder")
                            <div style="color: red;">
                                @php $message = preg_replace('/[0-9]+/', '', $message);
                                @endphp
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="col-md-12" style="margin-top:30px;">
                            <div class="form-group">
                                <label for="share_holder_country.{{ $shreholder }}" class="form-label">Country</label>
                                <select wire:model="share_holder_country.{{ $shreholder }}" class="form-select"
                                    aria-label="Default select example">
                                    <option value="" hidden>Select</option>
                                    @foreach($countries as $country)
                                    <option value="{{ $country }}">{{ $country }}</option>
                                    @endforeach
                                </select>
                                @error("share_holder_country.$shreholder")
                                <div style="color: red;">
                                    @php $message = preg_replace('/[0-9]+/', '', $message);
                                    @endphp
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4 text-left">
                            <livewire:widget.upload-component :label="'Or upload your Benefit illustration'"
                                :apply_loan="$apply_loan" :main_type="$main_type" :loan_type_id="$loan_type_id"
                                :share_holder="0" :modell="'App\Models\LoanCompanyDetail'"
                                :keyvalue="'parent_listed_company_subsidiary'" />

                        </div>
                    </div>

                    @endif
                    <div class="row">
                        <div class="col-12">
                            <br>
                            <button class="btn" type="button" wire:target='share_holder_document_store'
                                wire:click.prevent='share_holder_document_store({{ $shreholder  }})'>
                                <span wire:loading wire:target="share_holder_document_store"
                                    class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                Save & Continue
                            </button>
                        </div>
                    </div>
                    @elseif($subtab == 2)



                    <div class="row mt-4">
                        <b>6 months latest bank statement</b>
                        <p>If It’s on or Over The 8th Of The Current Month For Example 8th
                            Jan, You
                            Would
                            Need To
                            Submit
                            from Dec And Not Nov As The Latest Months. For companies less
                            than 6 months
                            old
                            or
                            unprofitable do check out our FAQ here.</p>
                    </div>

                    <!-- SHAREHOLDER COMPANY DOCUMENTS__FILE FEILD -->
                    <div class="row mt-3">
                        @for ($x = 1; $x < 8; $x++) <div class="col-md-6 col-lg-4 mb-3">
                            @php $montName = date("M", strtotime( date( 'Y-m-01' )." -$x
                            months")) @endphp

                            <livewire:widget.upload-component :label="$montName" :keyvalue="$montName" :key="$montName"
                                :getImages="$images" :apply_loan="$apply_loan" :main_type="$main_type"
                                :loan_type_id="$loan_type_id" :share_holder="0" :modell="'App\Models\LoanStatement'" />
                    </div>
                    @endfor
                </div>
                <!-- /SHAREHOLDER COMPANY DOCUMENTS__FILE FEILD -->


                <!-- SHAREHOLDER COMPANY DOCUMENTS__Consolidated Statement -->
                <div class="row mt-1">
                    <p><b>OR</b></p>
                    <p><b>Consolidated Statement.</b></p>
                    <p>If Your Statement Is Not Spilt Between Months But One</p>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <livewire:widget.upload-component :label="''" :apply_loan="$apply_loan" :main_type="$main_type"
                            :loan_type_id="$loan_type_id" :share_holder="0" :modell="'App\Models\LoanCompanyDetail'"
                            :keyvalue="'parent_company_combine_statement'" />
                    </div>
                </div>
                <!-- /SHAREHOLDER COMPANY DOCUMENTS__Consolidated Statement -->
                <hr class="mt-3">
                <!-- SHAREHOLDER COMPANY DOCUMENTS__LATEST YEAR -->
                <div class="row mt-4">
                    <p><b>Latest {{ $company_year >= 3 ? '2' : '1' }} Years Financial
                            Statement</b></p>
                    <p>
                        (Income Statement also known as Profit & Loss
                        + Statement of financial position also known as Balance Sheet)
                    </p>
                </div>

                <div class="row mt-2">
                    <div class="col-md-4">
                        <livewire:widget.upload-component :label="'Latest year'" :apply_loan="$apply_loan"
                            :main_type="$main_type" :loan_type_id="$loan_type_id" :share_holder="$shreholder"
                            :modell="'App\Models\LoanCompanyDetail'"
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

                    @endif
                </div>
                <!-- /SHAREHOLDER COMPANY DOCUMENTS__LATEST YEAR -->
                <hr class="mt-3">

                <!-- SHAREHOLDER COMPANY DOCUMENTS__PROFITABLE -->
                <div class="row mt-4">
                    <div class="col-md-4">
                        <p> <b>Profitable for the last 2 accounting years</b></p>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Before year</label>
                            <select wire:model="share_holder_profitable_latest_year.{{ $shreholder }}"
                                class="form-select" aria-label="Default select example">
                                <option value="" hidden>Select</option>
                                <option value="1">Yes</option>
                                <option value="0">No</option>
                            </select>
                            @error("share_holder_profitable_latest_year.$shreholder")
                            <div style="color:red;">
                                @php $message = preg_replace('/[0-9]+/', '', $message);
                                @endphp
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Before year</label>
                            <select wire:model="share_holder_profitable_before_year.{{ $shreholder }}"
                                class="form-select" aria-label="Default select example">
                                <option value="" hidden>Select</option>
                                <option value="1">Yes</option>
                                <option value="0">No</option>
                            </select>
                            @error("share_holder_profitable_before_year.$shreholder")
                            <div style="color:red;">
                                @php $message = preg_replace('/[0-9]+/', '', $message);
                                @endphp
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                </div>
                <!-- /SHAREHOLDER COMPANY DOCUMENTS__PROFITABLE -->
                <hr class="mt-3">
                <!-- SHAREHOLDER COMPANY DOCUMENTS__OPTIONAL INFO -->
                <div class="row mt-4">
                    <p class="text-muted"><b>Optional info</b></p>
                </div>


                <div class="row">
                    <p> <b>Current Year</b></p>
                    <p>If you are <b>more than 3-6 months into your current accounting
                            year,</b> and
                        if
                        your
                        management account(drafts/unaudited) pulls up the average, providing
                        them
                        may be
                        helpful
                    </p>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <livewire:widget.upload-component :label="''" :apply_loan="$apply_loan" :main_type="$main_type"
                            :loan_type_id="$loan_type_id" :share_holder="$shreholder"
                            :modell="'App\Models\LoanCompanyDetail'"
                            :keyvalue="'share_company_current_year_statement'" />

                    </div>
                </div>
                <!-- /SHAREHOLDER COMPANY DOCUMENTS__OPTIONAL INFO -->
                <hr class="mt-3">

                <!-- SHAREHOLDER COMPANY DOCUMENTS__REVENUE -->
                <div class="row mt-4">
                    <p> <b>Revenue (rounded up is fine)</b></p>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <input type="number" class="form-control" wire:model="share_holder_optional_revenuee">
                            @error("share_holder_optional_revenuee.$shreholder")
                            <div style="color:red;">
                                @php $message = preg_replace('/[0-9]+/', '', $message);
                                @endphp
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                </div>
                <!-- /SHAREHOLDER COMPANY DOCUMENTS__REVENUE -->

                <div class="row mt-4">
                    <div class="col-md-12">
                        <button class="btn" type="button" wire:target='share_holder_document_store'
                            wire:click.prevent='company_share_holder_documents_store({{ $shreholder  }})'>
                            <span wire:loading wire:target="share_holder_document_store"
                                class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
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
    <div class="text-end mt-3">
        <button class="btn" wire:click="findLender">Save & Continue</button>
    </div>
    </div>
</section>
