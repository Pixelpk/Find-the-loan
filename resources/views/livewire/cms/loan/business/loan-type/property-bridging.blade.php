<div>
    <!-- 1ST SECTION -->
    <div class="border p-2 rounded">
        <div class="row mt-2 text-center">
            <p><b>Details of property being sold</b></p>
        </div>
        <div class="row d-flex align-items-end">
            <div class="col-md-6">
                <div class="mb-3">
                    <livewire:widget.upload-component :label="'OTP/Sale & Purchase Agreement if any'"
                        :apply_loan="$apply_loan" :main_type="$main_type" :loan_type_id="$loan_type_id"
                        :share_holder="0" :modell="'App\Models\LoanGernalInfo'"
                        :keyvalue="'property_bridging_sale_purchase_agreement'" />
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <livewire:widget.upload-component
                        :label="'loan statement showing past 12 months repayment history if any(please ensure address is visible, if not kindly include the main page where address is visible)'"
                        :apply_loan="$apply_loan" :main_type="$main_type" :loan_type_id="$loan_type_id"
                        :share_holder="0" :modell="'App\Models\LoanGernalInfo'"
                        :keyvalue="'property_bridging_loan_statement'" />
                </div>
                {{-- <div x-data="{ isUploading: false, progress: 0 }" x-on:livewire-upload-start="isUploading = true"
                    x-on:livewire-upload-finish="isUploading = false" x-on:livewire-upload-error="isUploading = false"
                    x-on:livewire-upload-progress="progress = $event.detail.progress">
                    <div class="form-group">
                        <label class="control-label mb-10">

                            loan statement showing past 12 months repayment history if any(please ensure address is
                            visible,
                            if not kindly include the main page where address is visible)

                        </label>
                        <br>
                        <br>
                        <label wire:ignore class="label" data-toggle="tooltip" title="Select Image">
                            <input accept="image/jpeg,image/gif,image/png,application/pdf,image/x-eps"
                                wire:model="sold_tmonth_statement" type="file" id="vehicleimage">
                        </label>
                    </div>
                    @error('sold_tmonth_statement')
                    <div style="color: red;">
                        {{ $message }}
            </div>
            @enderror
            <div x-show="isUploading">
                <progress max="100" x-bind:value="progress"></progress>
            </div>
        </div> --}}
    </div>
</div>

<div class="row mt-2">
    <div class="col-md-6">
        <div class="mb-3">
            <livewire:widget.upload-component
                :label="'Loan statement reflecting current Outstanding loan amount if it is not reflected in your repayment history statement'"
                :apply_loan="$apply_loan" :main_type="$main_type" :loan_type_id="$loan_type_id" :share_holder="0"
                :modell="'App\Models\LoanGernalInfo'"
                :keyvalue="'property_bridging_reflecting_current_loan_statement'" />
        </div>
    </div>
    <div class="col-md-6"></div>
</div>
</div>
<!-- /1ST SECTION -->

<!-- 2ND SECTION -->
<div class="border p-2 rounded mt-3">
    <div class="row mt-2 d-flex align-items-center">
        <p>Please provide details not found in OTP or Sale/Purchase Agreement</p>
        <div class="col-md-5">
            <div class="mb-3">
                <label for="lot_number" class="form-label">Lot Number</label>
                <input wire:model="sold_lot_number" type="text" class="form-control">
                @error("sold_lot_number")
                <div style="color: red;">
                    {{ $message }}
                </div>
                @enderror
            </div>
        </div>
        <div wire:ignore.self class="col-md-1 text-center">
            <p><b>or</b></p>
        </div>
        <div class="col-md-5">
            <div class="mb-3">
                <label for="sold_address" class="form-label">Address</label>
                <input onkeyup="dddd()" wire:model.defer="sold_address" type="text" class="form-control"
                    id="ship-address1">
                @error("sold_address")
                <div style="color: red;">
                    {{ $message }}
                </div>
                @enderror
            </div>
        </div>
    </div>

    <div class="row mt-2">
        <div class="col-md-3">
            <div class="mb-3">
                <label for="sold_unit" class="form-label">Unit if any
                </label>
                <input wire:model="sold_unit" type="text" class="form-control" id="sold_unit">
                @error("sold_unit")
                <div style="color: red;">
                    {{ $message }}
                </div>
                @enderror
            </div>
        </div>
        <div class="col-md-3">
            <div class="mb-3">
                <label for="sold_building_name" class="form-label">Building name if any
                </label>
                <input wire:model="sold_building_name" type="text" class="form-control" id="sold_building_name">
                @error("sold_building_name")
                <div style="color: red;">
                    {{ $message }}
                </div>
                @enderror
            </div>
        </div>
        <div class="col-md-3">
            <div class="mb-3">
                <label for="sold_lease_remaining" class="form-label">
                    Lease Remaining
                </label>
                <div class="input-group">
                    <input wire:model="sold_lease_remaining_year" type="text" class="form-control"
                        aria-label="Recipient's username" aria-describedby="basic-addon2">
                    <div class="input-group-append">
                        <span class="input-group-text" id="basic-addon2">Years</span>
                    </div>
                </div>
                @error("sold_lease_remaining_year")
                <div style="color: red;">
                    {{ $message }}
                </div>
                @enderror
            </div>
        </div>
        <div class="col-md-3 d-flex align-items-center">
            <div class="mb-3">
                <br>
                <div class="form-check form-switch">
                    <input wire:model="sold_free_hold" class="form-check-input" type="checkbox"
                        id="flexSwitchCheckDefault">
                    <label class="form-check-label" for="flexSwitchCheckDefault">Freehold
                    </label>
                </div>
                @error("sold_free_hold")
                <div style="color: red;">
                    {{ $message }}
                </div>
                @enderror
            </div>
        </div>
    </div>



    <div class="row mt-2">
        <div class="col-md-3">
            <div class="mb-3">
                <label for="sold_fllor_area" class="form-label">
                    Land/Floor Area
                    if applicable
                </label>
                <input wire:model="sold_fllor_area" type="text" class="form-control" id="sold_fllor_area">
                @error("sold_fllor_area")
                <div style="color: red;">
                    {{ $message }}
                </div>
                @enderror
            </div>
        </div>
        <div class="col-md-3">
            <div class="mb-3">
                <label for="sold_useable_area" class="form-label">
                    Build-in/Useable Area
                </label>
                <input wire:model="sold_useable_area" type="text" class="form-control" id="sold_useable_area">
                @error("sold_useable_area")
                <div style="color: red;">
                    {{ $message }}
                </div>
                @enderror
            </div>
        </div>
        <div class="col-md-3 col-lg-2 mt-3">
            <div class="mb-3">
                <br>
                <div class="form-check form-switch">
                    <input wire:change="changeAreaTypee()" wire:model="sold_square_feet" class="form-check-input"
                        type="checkbox" id="flexSwitchCheckDefault">
                    <label class="form-check-label" for="flexSwitchCheckDefault">Square Feet </label>
                </div>
                @error("sold_square_feet")
                <div style="color: red;">
                    {{ $message }}
                </div>
                @enderror
            </div>
        </div>
        <div class="col-md-3 col-lg-2 mt-3">
            <div class="mb-3">
               <br>
                <div class="form-check form-switch">
                    <input wire:change="changeAreaType()" wire:model="sold_square_meter" class="form-check-input"
                        type="checkbox" id="flexSwitchCheckDefault">
                    <label class="form-check-label" for="flexSwitchCheckDefault">Square Meter
                    </label>
                </div>
                @error("sold_square_meter")
                <div style="color: red;">
                    {{ $message }}
                </div>
                @enderror
            </div>
        </div>
    </div>


</div>
<!-- /2ND SECTION -->

<!-- 3RD SECTION -->
<div class="border p-2 rounded mt-3">
    <div class="row text-center mt-2">
        <p><b>Details of new property</b></p>
    </div>
    <div class="row mt-2">
        <div class="col-md-6">
            <div class="mb-3">
                <livewire:widget.upload-component :label="' letter of offer/loan agreement From Another lender if any'"
                    :apply_loan="$apply_loan" :main_type="$main_type" :loan_type_id="$loan_type_id" :share_holder="0"
                    :modell="'App\Models\LoanGernalInfo'" :keyvalue="'property_bridging_offer_letter_loan_agreement'" />
            </div>
        </div>
        <div class="col-md-6">
            <div class="mb-3">
                <livewire:widget.upload-component :label="'OTP or Sale/Purchase Agreement of property/land being sold'"
                    :apply_loan="$apply_loan" :main_type="$main_type" :loan_type_id="$loan_type_id" :share_holder="0"
                    :modell="'App\Models\LoanGernalInfo'"
                    :keyvalue="'property_bridging_sold_sale_purchase_agreement'" />
            </div>
        </div>
    </div>

    <div class="row mt-3">
        <p>Please provide details not found in letter of offer/loan agreement or if there is not one </p>
    </div>

    <div class="row mt-2 d-flex align-items-center">
        <div class="col-md-5">
            <div class="mb-3">
                <label for="new_lot_number" class="form-label">Lot Number</label>
                <input wire:model="new_lot_number" type="text" class="form-control">
                @error("new_lot_number")
                <div style="color: red;">
                    {{ $message }}
                </div>
                @enderror
            </div>
        </div>
        <div wire:ignore.self class="col-md-1 text-center">
            <p><b>or</b></p>
        </div>
        <div class="col-md-5">
            <div class="mb-3">
                <label for="new_address" class="form-label">Address</label>
                <input onkeyup="dddd()" wire:model.defer="new_address" type="text" class="form-control"
                    id="ship-address1">
                @error("new_address")
                <div style="color: red;">
                    {{ $message }}
                </div>
                @enderror
            </div>
        </div>
    </div>

    <div class="row mt-2">
        <div class="col-md-3">
            <div class="mb-3">
                <label for="new_unit" class="form-label">Unit if any
                </label>
                <input wire:model="new_unit" type="text" class="form-control" id="new_unit">
                @error("new_unit")
                <div style="color: red;">
                    {{ $message }}
                </div>
                @enderror
            </div>
        </div>
        <div class="col-md-3">
            <div class="mb-3">
                <label for="new_building_name" class="form-label">Building name if any
                </label>
                <input wire:model="new_building_name" type="text" class="form-control" id="new_building_name">
                @error("new_building_name")
                <div style="color: red;">
                    {{ $message }}
                </div>
                @enderror
            </div>
        </div>
        <div class="col-md-3">
            <div class="mb-3">
                <label for="new_lease_remaining" class="form-label">
                    Lease remaining </label>
                <div class="input-group mb-3">
                    <input wire:model="new_lease_remaining_year" type="text" class="form-control"
                        aria-label="Recipient's username" aria-describedby="basic-addon2">
                    <div class="input-group-append">
                        <span class="input-group-text" id="basic-addon2">Years</span>
                    </div>
                </div>
                @error("new_lease_remaining_year")
                <div style="color: red;">
                    {{ $message }}
                </div>
                @enderror
            </div>
        </div>
        <div class="col-md-3 d-flex align-items-center mt-3">
            <div class="form-check form-switch mb-3">
                <input wire:model="new_free_hold" class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                <label class="form-check-label" for="flexSwitchCheckDefault">Freehold
                </label>
            </div>
        </div>
    </div>


    <div class="row mt-2">
        <div class="col-md-3">
            <div class="mb-3">
                <label for="new_floor_area" class="form-label">
                    Land/Floor Area
                    if applicable
                </label>
                <input wire:model="new_floor_area" type="text" class="form-control" id="new_floor_area">
                @error("new_floor_area")
                <div style="color: red;">
                    {{ $message }}
                </div>
                @enderror
            </div>
        </div>
        <div class="col-md-3">
            <div class="mb-3">
                <label for="new_useable_area" class="form-label">
                    Build-in/Useable Area
                </label>
                <input wire:model="new_useable_area" type="text" class="form-control" id="new_useable_area">
                @error("new_useable_area")
                <div style="color: red;">
                    {{ $message }}
                </div>
                @enderror
            </div>
        </div>
        <div class="col-md-3 col-lg-2 mt-3">
            <br>
            <div class="form-check form-switch mb-3">
                <input wire:change="changeAreaTypee()" wire:model="new_square_feet" class="form-check-input"
                    type="checkbox" id="flexSwitchCheckDefault">
                <label class="form-check-label" for="flexSwitchCheckDefault">Square Feet</label>
            </div>
        </div>
        <div class="col-md-3 col-lg-2 mt-3">
            <br>
            <div class="form-check form-switch mb-3">
                <input wire:change="changeAreaType()" wire:model="new_square_meter" class="form-check-input"
                    type="checkbox" id="flexSwitchCheckDefault">
                <label class="form-check-label" for="flexSwitchCheckDefault">Square Meter </label>
            </div>
        </div>
    </div>



    <div class="row mt-3 text-center">
        <p> <b>If applicable</b></p>
    </div>

    <div class="row mt-2">

        <div class="col-md-12 col-lg-12">
            <p style="margin: 0px;"> Under Construction -Expected date of completion</p>
        </div>
        <div class="col-md-2">
            <div class="mb-3">
                <label for="useable_area" class="form-label">Year</label>
                <select wire:model="construction_year" class="form-select">
                    <option value="">Select</option>
                    @for ($x = 1990; $x <= date('Y'); $x++) <option value="{{ $x }}">{{ $x }}</option>
                        @endfor
                </select>
            </div>
        </div>
        <div class="col-md-2">
            <div class="mb-3">
                <label for="useable_area" class="form-label">Quater</label>
                <select wire:model="construction_year_time" class="form-select">
                    <option value="">Select</option>
                    <option value="1">Q1</option>
                    <option value="2">Q2</option>
                    <option value="3">Q3</option>
                    <option value="4">Q4</option>
                </select>
            </div>
        </div>
        <div class="col-md-3 col-lg-2">
            <div class="form-check form-switch mb-3 float-right mt-2">
                <br>
                <input wire:model="completed" class="form-check-input" type="checkbox" id="flexSwitchCheckDefaul3">
                <label class="form-check-label" for="flexSwitchCheckDefaul3">Completed</label>
            </div>
        </div>
    </div>

    @error("check_offer")
    <div class="row text-danger">
        {{ $message }}
    </div>
    @enderror
</div>
<!-- /3RD SECTION -->

<!-- 4TH SECTION -->
<div class="border p-2 rounded mt-3">
    <div class="row mt-4">
        <label for="preferred_tenure_month" class="form-label">
            Preferred Tenure
        </label>
        <div class="col-md-4">
            <div class="mb-3">
                <div class="input-group mb-3">
                    <input wire:model="preferred_tenure_year" type="text" class="form-control"
                        aria-label="Recipient's username" aria-describedby="basic-addon2">
                    <div class="input-group-append">
                        <span class="input-group-text" id="basic-addon2">Years</span>
                    </div>
                </div>
                @error("preferred_tenure_year")
                <div style="color: red;">
                    {{ $message }}
                </div>
                @enderror
                @error("preferred_tenure_month")
                <div style="color: red;">
                    {{ $message }}
                </div>
                @enderror
            </div>
        </div>
        <div class="col-md-4">
            <div class="mb-3">
                <div class="input-group">
                    <input wire:model="preferred_tenure_month" type="text" class="form-control"
                        aria-label="Recipient's username" aria-describedby="basic-addon2">
                    <div class="input-group-append">
                        <span class="input-group-text" id="basic-addon2">Month</span>
                    </div>
                </div>
                @error("preferred_tenure_year")
                <div style="color: red;">
                    {{ $message }}
                </div>
                @enderror
                @error("preferred_tenure_month")
                <div style="color: red;">
                    {{ $message }}
                </div>
                @enderror
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-check form-switch mb-3">
                <input wire:model="as_long_as_possiable" class="form-check-input" type="checkbox"
                    id="flexSwitchCheckDefault">
                <label class="form-check-label" for="flexSwitchCheckDefault">As Long As Possible
                </label>
            </div>
        </div>
    </div>

    <div class="row mt-2">
        <div class="col-md-6">
            <div class="mb-3">
                <label for="amount" class="form-label">Amount Required</label>
                <input wire:model="amount" type="number" class="form-control" id="amount">
                @error("amount")
                <div style="color: red;">
                    {{ $message }}
                </div>
                @enderror
            </div>
        </div>
    </div>
</div>
<!-- /4TH SECTION -->

<div class="">
    <div class="col-md-12">
        <hr>
    </div>
</div>
<!-- Optional Documents -->
<div class="row mt-2">
    <div class="col-md-12">
        <label>Submitting the following optional documents may help to give our Financing Partners more <br> confidence  in your repayment ability, if they suggest cashflow coming into the company <br>  over the tenure of the loan. E.g Aging list (account receivable) contract, LC, PO/invoices etc.</label>
        <br>
    </div>
</div>

<div class="row">
    <div class="col-md-2">
        <p class="mt-4">Optional Documents</p>
    </div>
    <div class="col-md-4">
        <div class="mb-3">
            <livewire:widget.upload-component
            :apply_loan="$apply_loan"
            :main_type="$main_type"
            :loan_type_id="$loan_type_id"
            :share_holder="0"
            :modell="'App\Models\LoanGernalInfo'"
            :keyvalue="'property_bridge_optional_documents'"/>
            @error("document")
            <div style="color: red;">
                {{ $message }}
            </div>
            @enderror
        </div>
    </div>
</div>

<!-- BUTTON -->
<div class="mt-3 text-end">
    <button class="btn" type="button" wire:target="store" wire:click.prevent="store">
        <span wire:loading="" wire:target="store" class="spinner-border spinner-border-sm" role="status"
            aria-hidden="true"></span>
        Save &amp; Continue
    </button>
</div>
<!-- /BUTTON -->
</div>
