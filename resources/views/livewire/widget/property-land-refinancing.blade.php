<div>
    <div class="row">

        <div class="col-md-6 text-left">
            <livewire:widget.upload-component :label="'loan statement showing past 12 months repayment history if any'"
                :apply_loan="$apply_loan" :main_type="$main_type" :loan_type_id="$loan_type_id" :share_holder="0"
                :modell="'App\Models\LoanGernalInfo'" :keyvalue="'property_land_refinancing_statement'" />
        </div>

        <div class="col-md-6 text-left">
            <livewire:widget.upload-component
                :label="'Loan statement reflecting current Outstanding loan amount if it is not reflected in your repayment history statement'"
                :apply_loan="$apply_loan" :main_type="$main_type" :loan_type_id="$loan_type_id" :share_holder="0"
                :modell="'App\Models\LoanGernalInfo'" :keyvalue="'property_land_refinancing_current_statement'" />
        </div>
        <div class="col-md-6 text-left">
            <livewire:widget.upload-component :label="'CPF property withdrawal/utilization statement If CPF was used'"
                :apply_loan="$apply_loan" :main_type="$main_type" :loan_type_id="$loan_type_id" :share_holder="0"
                :modell="'App\Models\LoanGernalInfo'" :keyvalue="'property_land_refinancing_cpf_statement'" />
        </div>

        <div class="col-md-6 text-left">
            <br>
            <livewire:widget.upload-component :label="'Tenancy Agreement If it’s rented out'" :apply_loan="$apply_loan"
                :main_type="$main_type" :loan_type_id="$loan_type_id" :share_holder="0"
                :modell="'App\Models\LoanGernalInfo'" :keyvalue="'property_land_refinancing_tenancy_agreement'" />
        </div>

        <div class="col-md-12">
            <hr>
        </div>
        <div class="col-md-12" style="margin-top: 30px;">


            <label for="lot_number" class="form-label">Lot Number</label>
            <input wire:model="lot_number" type="text" class="form-control">
            @error("lot_number")
            <div style="color: red;">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div wire:ignore.self class="col-md-12" style="margin-top: 30px;">
            <b>OR</b>
            <br>
            <br>
            <label for="address" class="form-label">Address</label>
            <input onkeyup="dddd()" wire:model.defer="address" type="text" class="form-control" id="ship-address1">
            @error("address")
            <div style="color: red;">
                {{ $message }}
            </div>
            @enderror
        </div>

        <div class="col-md-6" style="margin-top: 30px;">
            <label for="unit" class="form-label">Unit if any
            </label>
            <input wire:model="unit" type="text" class="form-control" id="unit">
            @error("unit")
            <div style="color: red;">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="col-md-6" style="margin-top: 30px;">
            <label for="building_name" class="form-label">Building name if any
            </label>
            <input wire:model="building_name" type="text" class="form-control" id="building_name">
            @error("building_name")
            <div style="color: red;">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="col-md-6" style="margin-top: 30px;">
            <label for="lease_remaining" class="form-label">
                Lease remaining

            </label>
            <div class="input-group mb-3">
                <input wire:model="lease_remaining_year" type="text" class="form-control"
                    aria-label="Recipient's username" aria-describedby="basic-addon2">
                <div class="input-group-append">
                    <span class="input-group-text" id="basic-addon2">Years</span>
                </div>
            </div>
            @error("lease_remaining_year")
            <div style="color: red;">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="col-md-6" style="margin-top: 40px;">
            <br>
            <div class="form-check form-switch">
                <input wire:model="free_hold" class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                <label class="form-check-label" for="flexSwitchCheckDefault">Freehold
                </label>
            </div>
        </div>
        <div class="col-md-6" style="margin-top: 30px;">
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
        <div class="col-md-6" style="margin-top: 30px;">
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
        <div class="col-md-2">
            <br>
            <div class="form-check form-switch">
                <input wire:change="changeAreaTypee()" wire:model="square_feet" class="form-check-input" type="checkbox"
                    id="flexSwitchCheckDefault">
                <label class="form-check-label" for="flexSwitchCheckDefault">Square Feet

                </label>
            </div>
        </div>
        <div class="col-md-2">
            <br>
            <div class="form-check form-switch">
                <input wire:change="changeAreaType()" wire:model="square_meter" class="form-check-input" type="checkbox"
                    id="flexSwitchCheckDefault">
                <label class="form-check-label" for="flexSwitchCheckDefault">Square Meter
                </label>
            </div>
        </div>
        <div class="col-md-8"></div>
        <div class="col-md-12 text-center">
            <br>
            <b>If applicable
            </b>

        </div>
        <div class="col-md-2">
            <br>
            <div class="form-check form-switch">
                <input wire:model="completed" class="form-check-input" type="checkbox" id="flexSwitchCheckDefaul3">
                <label class="form-check-label" for="flexSwitchCheckDefaul3">Completed</label>
            </div>
        </div>
        <div class="col-md-6">
            <br>
            Under Construction -Expected date of completion
        </div>
        <div class="col-md-2">
            <label for="useable_area" class="form-label">Year</label>
            <select wire:model="construction_year" class="form-select">
                <option value="">Select</option>
                @for ($x = 1990; $x <= date('Y'); $x++) <option value="{{ $x }}">{{ $x }}</option>
                    @endfor
            </select>
        </div>
        <div class="col-md-2">
            <label style="color:white;" for="useable_area" class="form-label">.</label>
            <select wire:model="construction_year_time" class="form-select">
                <option value="">Select</option>
                <option value="1">Q1</option>
                <option value="2">Q2</option>
                <option value="3">Q3</option>
                <option value="4">Q4</option>
            </select>
        </div>
        <div class="col-md-12">
            <hr>
        </div>

        <div class="col-md-4">
            {{-- <br>
            <div class="form-check">
                <input wire:model="check_offer" value="1" class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                <label class="form-check-label" for="flexRadioDefault1">
                    Check offer for floating rate

                </label>
            </div> --}}
            <br>
            <div class="form-check form-switch">
                <input wire:model="float_rate" class="form-check-input" type="checkbox" id="flexSwitchCheckDefault1234">
                <label class="form-check-label" for="flexSwitchCheckDefault1234"> Check offer for floating rate
                </label>
            </div>
            @error("float_rate")
            <div style="color: red;">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="col-md-4">
            {{-- <br>
            <div class="form-check">
                <input wire:model="check_offer" value="2" class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2">
                <label class="form-check-label" for="flexRadioDefault2">
                    Check offer for fixed rate

                </label>
            </div> --}}
            <br>
            <div class="form-check form-switch">
                <input wire:model="fix_rate" class="form-check-input" type="checkbox" id="flexSwitchCheckDefaul24">
                <label class="form-check-label" for="flexSwitchCheckDefaul24"> Check offer for fixed rate
                </label>
            </div>
            @error("fix_rate")
            <div style="color: red;">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="col-md-4">

        </div>
        @error("check_offer")
        <div class="col-md-12 text-danger">
            {{ $message }}
        </div>
        @enderror
        <div class="col-md-6" style="margin-top: 30px;">
            <label for="preferred_tenure_month" class="form-label">
                Preferred Tenure

            </label>
            <div class="input-group mb-3">
                <input wire:model="preferred_tenure_year" type="text" class="form-control"
                    aria-label="Recipient's username" aria-describedby="basic-addon2">
                <div class="input-group-append">
                    <span class="input-group-text" id="basic-addon2">Years</span>
                </div>
                <input wire:model="preferred_tenure_month" type="text" class="form-control"
                    aria-label="Recipient's username" aria-describedby="basic-addon2">
                <div class="input-group-append">
                    <span class="input-group-text" id="basic-addon2">Months</span>
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
        <div class="col-md-2" style="margin-top: 40px;">
            <br>
            <div class="form-check form-switch">
                <input wire:model="as_long_as_possiable" class="form-check-input" type="checkbox"
                    id="flexSwitchCheckDefault">
                <label class="form-check-label" for="flexSwitchCheckDefault">As Long As Possible
                </label>
            </div>
        </div>
        <div class="col-md-4"></div>
        <div class="col-md-12">
            <b> Property type</b>

            <br>
            <br>
        </div>
        <div class="col-md-4">
            <div class="form-check">
                <input value="Commercial" wire:model="property_land_property_type" class="form-check-input" type="radio"
                    id="flexRadioDefault101">
                <label class="form-check-label" for="flexRadioDefault101">
                    Commercial

                </label>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-check">
                <input value="Residential" wire:model="property_land_property_type" class="form-check-input"
                    type="radio" id="flexRadioDefault202">
                <label class="form-check-label" for="flexRadioDefault202">
                    Residential
                </label>
            </div>
        </div>

        <div class="col-md-4">
            <div class="form-check">
                <input value="industrial" wire:model="property_land_property_type" class="form-check-input" type="radio"
                    id="flexRadioDefault303">
                <label class="form-check-label" for="flexRadioDefault303">
                    industrial

                </label>
            </div>
        </div>
        <div class="col-md-12">
            @error("property_land_property_type")
            <div style="color: red;">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="col-md-12">
            <br>
            <br>
            <b> Geographical location
            </b>

            <br>
            <br>
        </div>
        <div class="col-md-4">
            <div class="form-check">
                <input value="Local" wire:model="property_land_geographical" class="form-check-input" type="radio"
                    id="flexRadioDefault304">
                <label class="form-check-label" for="flexRadioDefault304">
                    Local
                </label>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-check">
                <input  value="Foreign" wire:model="property_land_geographical" class="form-check-input" type="radio"
                    id="flexRadioDefault3044">
                <label class="form-check-label" for="flexRadioDefault3044">
                    Foreign
                </label>
            </div>
        </div>
        <div class="col-md-12">
            @error("property_land_geographical")
            <div style="color: red;">
                {{ $message }}
            </div>
            @enderror
        </div>
        @if($loan_type_id == 14)
        <div class="col-md-12">
            <br>
            <br>
            <b>Property/Land is under
            </b>
            <br>
            <br>
        </div>
        <div class="col-md-4">
            <div class="form-check">
                <input value="Company name" value="Company name" wire:model="property_land_under" class="form-check-input"
                    type="radio" name="flexRadioDefault" id="flexRadioDefault305">
                <label class="form-check-label" for="flexRadioDefault305">
                    Company name

                </label>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-check">
                <input value="Personal name" value="Personal name" wire:model="property_land_under" class="form-check-input"
                    type="radio" name="flexRadioDefault" id="flexRadioDefault306">
                <label class="form-check-label" for="flexRadioDefault306">
                    Personal name
                </label>
            </div>
        </div>
        <div class="col-md-12">
            @error("property_land_under")
            <div style="color: red;">
                {{ $message }}
            </div>
            @enderror
        </div>
        @endif
        <div class="col-md-12">
            <div class="col-md-12" style="margin-top: 30px;">
                <label for="amount" class="form-label">Amount</label>
                <input wire:model="amount" type="number" class="form-control" id="amount">
                @error("amount")
                <div style="color: red;">
                    {{ $message }}
                </div>
                @enderror
            </div>
        </div>
        <div class="col-12">
            <br>
            <button class="btn" type="button" wire:target="store" wire:click.prevent="store">
                <span wire:loading="" wire:target="store" class="spinner-border spinner-border-sm" role="status"
                    aria-hidden="true"></span>
                Save &amp; Continue
            </button>
        </div>
    </div>