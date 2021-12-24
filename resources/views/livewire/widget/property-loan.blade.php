<div>
    <div class="row d-flex align-items-end">
        <div class="col-md-6">
       <div class="mb-3">
        <livewire:widget.upload-component
        :label="' OTP or Sale/Purchase Agreement of property/land being sold'"
        :apply_loan="$apply_loan"
        :main_type="$main_type"
        :loan_type_id="$loan_type_id"
        :share_holder="0"
        :modell="'App\Models\LoanGernalInfo'"
        :keyvalue="'property_advance_loan_sale_purchase_agreement'"
    />
       </div>
        </div>
        <div class="col-md-6">
           <div class="mb-3">
            <livewire:widget.upload-component
            :label="' Loan statement showing past 12 months repayment history if any(please ensure address is
            visible,
            if not kindly include the main page where address is visible)'"
            :apply_loan="$apply_loan"
            :main_type="$main_type"
            :loan_type_id="$loan_type_id"
            :share_holder="0"
            :modell="'App\Models\LoanGernalInfo'"
            :keyvalue="'property_advance_loan_statement'"
        />
           </div>
        </div>
        </div>

        <div class="row mt-2">
        <div class="col-md-6">
     <div class="mb-3">
        <livewire:widget.upload-component
        :label="'Loan statement reflecting current Outstanding loan amount if it is not reflected in your
        repayment history statement'"
        :apply_loan="$apply_loan"
        :main_type="$main_type"
        :loan_type_id="$loan_type_id"
        :share_holder="0"
        :modell="'App\Models\LoanGernalInfo'"
        :keyvalue="'property_advance_loan_current_statement'"
    />
     </div>
        </div>
    </div>

    <hr>

        <div class="row mt-2 d-felx align-items-center">
        <div class="col-md-5">
          <div class="mb-3">
            <label for="lot_number" class="form-label">Lot Number</label>
            <input wire:model="lot_number" type="text" class="form-control">
            @error("lot_number")
            <div style="color: red;">
                {{ $message }}
            </div>
            @enderror
          </div>
        </div>
        <div wire:ignore.self class="col-md-2 text-center">
            <p><b>or</b></p>
        </div>
        <div class="col-md-5">
            <div class="mb-3">
                <label for="address" class="form-label">Address</label>
                <input onkeyup="dddd()" wire:model.defer="address" type="text" class="form-control" id="ship-address1">
                @error("address")
                <div style="color: red;">
                    {{ $message }}
                </div>
                @enderror
            </div>
        </div>
</div>

<div class="row mt-2 d-flex align-items-center">
        <div class="col-md-3">
        <div class="mb-3">
            <label for="unit" class="form-label">Unit if any
            </label>
            <input wire:model="unit" type="text" class="form-control" id="unit">
            @error("unit")
            <div style="color: red;">
                {{ $message }}
            </div>
            @enderror
        </div>
        </div>
        <div class="col-md-3">
       <div class="mb-3">
        <label for="building_name" class="form-label">Building name if any
        </label>
        <input wire:model="building_name" type="text" class="form-control" id="building_name">
        @error("building_name")
        <div style="color: red;">
            {{ $message }}
        </div>
        @enderror
       </div>
        </div>

        <div class="col-md-3">
       <div class="mb-3">
        <label for="lease_remaining" class="form-label">
            Lease Remaining
        </label>
        <div class="input-group mb-3">
            <input wire:model="lease_remaining_year" type="text" class="form-control" aria-label="Recipient's username"
                aria-describedby="basic-addon2">
            <div class="input-group-append">
                <span class="input-group-text lh-1-3" id="basic-addon2">Years</span>
            </div>
        </div>
        @error("lease_remaining_year")
        <div style="color: red;">
            {{ $message }}
        </div>
        @enderror
       </div>
        </div>
        <div class="col-md-3">
            <div class="form-check form-switch mt-3">
                <input wire:model="free_hold" class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                <label class="form-check-label" for="flexSwitchCheckDefault">Freehold
                </label>
            </div>
        </div>
    </div>

    <div class="row mt-2 d-flex align-items-center">
        <div class="col-md-3">
       <div class="mb-3">
        <label for="fllor_area" class="form-label">
            Land/Floor Area
                if applicable
        </label>
        <input wire:model="fllor_area" type="text" class="form-control" id="fllor_area">
        @error("fllor_area")
        <div style="color: red;">
            {{ $message }}
        </div>
        @enderror
       </div>
        </div>
        <div class="col-md-3">
        <div class="mb-3">
            <label for="useable_area" class="form-label">
                Build-in/Useable Area
            </label>
            <input wire:model="useable_area" type="text" class="form-control" id="useable_area">
            @error("useable_area")
            <div style="color: red;">
                {{ $message }}
            </div>
            @enderror
        </div>
        </div>

        <div class="col-md-2">
            <div class="form-check form-switch mt-3">
                <input wire:change="changeAreaTypee()" wire:model="square_feet" class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                <label class="form-check-label" for="flexSwitchCheckDefault">Square Feet </label>
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-check form-switch mt-3">
                <input wire:change="changeAreaType()" wire:model="square_meter" class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                <label class="form-check-label" for="flexSwitchCheckDefault">Square Meter
                </label>
            </div>
        </div>
       <div class="col-md-4"></div>
    </div>

    <hr>

       <div class="row mt-4">
        <label for="preferred_tenure_month" class="form-label">
            Preferred Tenure </label>
        <div class="col-md-4">
       <div class="mb-3">
        <div class="input-group">
            <input wire:model="preferred_tenure_year" type="text" class="form-control" aria-label="Recipient's username"
                aria-describedby="basic-addon2">
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
                    <input wire:model="preferred_tenure_month" type="text" class="form-control" aria-label="Recipient's username"
                    aria-describedby="basic-addon2">
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
            <div class="form-check form-switch mt-1">
                <input  wire:model="as_long_as_possiable" class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                <label class="form-check-label" for="flexSwitchCheckDefault">As Long As Possible
                </label>
            </div>
        </div>
    </div>

        <div class="row mt-2">
        <div class="col-md-6">
            <div class="mb-3">
                <label for="amount" >Amount Required
                    <div class="tooltip-c">
                        <i class="fa fa-info-circle"></i>
                        <span class="tooltip-text custom-tooltip-text">Amount required is the amount you are aiming to borrow for that loan type. You may still reduce it prior to signing Loan Offer Letter.</span>
                    </div>
                </label>
                <input wire:model="amount" type="number" class="form-control" id="amount">
                @error("amount")
                <div style="color: red;">
                    {{ $message }}
                </div>
                @enderror
            </div>
        </div>
        </div>

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
                    :keyvalue="'property_land_sale_optional_documents'"/>
                    <!-- @error("document")
                    <div style="color: red;">
                        {{ $message }}
                    </div>
                    @enderror -->
                </div>
            </div>
        </div>

        <div class="mt-3 text-end">
            <button class="btn" type="button" wire:target="store" wire:click.prevent="store">
                <span wire:loading="" wire:target="store" class="spinner-border spinner-border-sm" role="status"
                    aria-hidden="true"></span>
                Save &amp; Continue
            </button>
        </div>
    </div>
