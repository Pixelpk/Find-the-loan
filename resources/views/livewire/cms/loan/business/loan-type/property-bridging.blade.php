<div>
    <div class="row">
        <div class="col-md-12 text-center"><b>Details of property being sold</b> <br><br></div>
        <div class="col-md-6 text-left">
            <livewire:widget.upload-component 
                :label="'OTP/Sale & Purchase Agreement if any'" 
                :apply_loan="$apply_loan"
                :main_type="$main_type" 
                :loan_type_id="$loan_type_id" 
                :share_holder="0"
                :modell="'App\Models\LoanGernalInfo'" 
                :keyvalue="'property_bridging_sale_purchase_agreement'" 
            />
            {{-- <div x-data="{ isUploading: false, progress: 0 }" x-on:livewire-upload-start="isUploading = true"
                x-on:livewire-upload-finish="isUploading = false" x-on:livewire-upload-error="isUploading = false"
                x-on:livewire-upload-progress="progress = $event.detail.progress">
                <div class="form-group">
                    <label class="control-label mb-10">
                        OTP/Sale & Purchase Agreement if any
                    </label>
                    <br>
                    <br>
                    <label wire:ignore class="label" data-toggle="tooltip" title="Select Image">
                        <input accept="image/jpeg,image/gif,image/png,application/pdf,image/x-eps"
                            wire:model="sold_agreement" type="file" id="vehicleimage">
                    </label>
                </div>
                @error('sold_agreement')
                <div style="color: red;">
                    {{ $message }}
                </div>
                @enderror
                <div x-show="isUploading">
                    <progress max="100" x-bind:value="progress"></progress>
                </div>
            </div> --}}
        </div>
        <div class="col-md-6 text-left">
            <livewire:widget.upload-component 
            :label="'loan statement showing past 12 months repayment history if any(please ensure address is visible, if not kindly include the main page where address is visible)'" 
            :apply_loan="$apply_loan"
            :main_type="$main_type" 
            :loan_type_id="$loan_type_id" 
            :share_holder="0"
            :modell="'App\Models\LoanGernalInfo'" 
            :keyvalue="'property_bridging_loan_statement'" 
            />
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
        <div class="col-md-6 text-left">
            <br>
           
            <livewire:widget.upload-component 
            :label="'Loan statement reflecting current Outstanding loan amount if it is not reflected in your repayment history statement'" 
            :apply_loan="$apply_loan"
            :main_type="$main_type" 
            :loan_type_id="$loan_type_id" 
            :share_holder="0"
            :modell="'App\Models\LoanGernalInfo'" 
            :keyvalue="'property_bridging_reflecting_current_loan_statement'" 
            />
            {{-- <div x-data="{ isUploading: false, progress: 0 }" x-on:livewire-upload-start="isUploading = true"
                x-on:livewire-upload-finish="isUploading = false" x-on:livewire-upload-error="isUploading = false"
                x-on:livewire-upload-progress="progress = $event.detail.progress">
                <div class="form-group">
                    <label class="control-label mb-10">
                        Loan statement reflecting current Outstanding loan amount if it is not reflected in your
                        repayment history statement
                    </label>
                    <br>
                    <br>
                    <label wire:ignore class="label" data-toggle="tooltip" title="Select Image">
                        <input accept="image/jpeg,image/gif,image/png,application/pdf,image/x-eps"
                            wire:model="sold_statement" type="file" id="vehicleimage">
                    </label>
                </div>
                @error('sold_statement')
                <div style="color: red;">
                    {{ $message }}
                </div>
                @enderror
                <div x-show="isUploading">
                    <progress max="100" x-bind:value="progress"></progress>
                </div>
            </div> --}}
        </div>

        <div class="col-md-12">
            <hr>
        </div>

        <div class="col-md-12" style="margin-top: 30px;">
            <label for="lot_number" class="form-label">Lot Number</label>
            <input wire:model="sold_lot_number" type="text" class="form-control">
            @error("sold_lot_number")
            <div style="color: red;">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div wire:ignore.self class="col-md-12" style="margin-top: 30px;">
            <b>OR</b>
            <br>
            <br>
            <label for="sold_address" class="form-label">Address</label>
            <input onkeyup="dddd()" wire:model.defer="sold_address" type="text" class="form-control" id="ship-address1">
            @error("sold_address")
            <div style="color: red;">
                {{ $message }}
            </div>
            @enderror
        </div>

        <div class="col-md-6" style="margin-top: 30px;">
            <label for="sold_unit" class="form-label">Unit if any
            </label>
            <input wire:model="sold_unit" type="text" class="form-control" id="sold_unit">
            @error("sold_unit")
            <div style="color: red;">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="col-md-6" style="margin-top: 30px;">
            <label for="sold_building_name" class="form-label">Building name if any
            </label>
            <input wire:model="sold_building_name" type="text" class="form-control" id="sold_building_name">
            @error("sold_building_name")
            <div style="color: red;">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="col-md-6" style="margin-top: 30px;">
            <label for="sold_lease_remaining" class="form-label">
                Lease remaining
            </label>
            <div class="input-group mb-3">
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
        <div class="col-md-6" style="margin-top: 40px;">
            <br>
            <div class="form-check form-switch">
                <input wire:model="sold_free_hold" class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                <label class="form-check-label" for="flexSwitchCheckDefault">Freehold
                </label>
            </div>
            @error("sold_free_hold")
            <div style="color: red;">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="col-md-6" style="margin-top: 30px;">
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
        <div class="col-md-6" style="margin-top: 30px;">
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
        <div class="col-md-2">
            <br>
            <div class="form-check form-switch">
                <input wire:change="changeAreaTypee()" wire:model="sold_square_feet" class="form-check-input"
                    type="checkbox" id="flexSwitchCheckDefault">
                <label class="form-check-label" for="flexSwitchCheckDefault">Square Feet

                </label>
            </div>
            @error("sold_square_feet")
            <div style="color: red;">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="col-md-2">
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
        <div class="col-md-8"></div>
        <div class="col-md-12">
            <br>
            <hr class="new5">
        </div>
        <div class="col-md-12 text-center"><br><b>Details of new property</b><br><br></div>
        <div class="col-md-6 text-left">
            <livewire:widget.upload-component 
            :label="' letter of offer/loan agreement From Another lender if any'" 
            :apply_loan="$apply_loan"
            :main_type="$main_type" 
            :loan_type_id="$loan_type_id" 
            :share_holder="0"
            :modell="'App\Models\LoanGernalInfo'" 
            :keyvalue="'property_bridging_offer_letter_loan_agreement'" 
            />
            {{-- <div x-data="{ isUploading: false, progress: 0 }" x-on:livewire-upload-start="isUploading = true"
                x-on:livewire-upload-finish="isUploading = false" x-on:livewire-upload-error="isUploading = false"
                x-on:livewire-upload-progress="progress = $event.detail.progress">
                <div class="form-group">
                    <label class="control-label mb-10">
                        letter of offer/loan agreement From Another lender if any
                    </label>
                    <br>
                    <br>
                    <label wire:ignore class="label" data-toggle="tooltip" title="Select Image">
                        <input accept="image/jpeg,image/gif,image/png,application/pdf,image/x-eps"
                            wire:model="letter_of_loan_new_agreement" type="file" id="vehicleimage">
                    </label>
                </div>
                @error('letter_of_loan_new_agreement')
                <div style="color: red;">
                    {{ $message }}
                </div>
                @enderror
                <div x-show="isUploading">
                    <progress max="100" x-bind:value="progress"></progress>
                </div>
            </div> --}}
        </div>
        <div class="col-md-6 text-left">
            <livewire:widget.upload-component 
            :label="'OTP or Sale/Purchase Agreement of property/land being sold'" 
            :apply_loan="$apply_loan"
            :main_type="$main_type" 
            :loan_type_id="$loan_type_id" 
            :share_holder="0"
            :modell="'App\Models\LoanGernalInfo'" 
            :keyvalue="'property_bridging_sold_sale_purchase_agreement'" 
            />
            {{-- <div x-data="{ isUploading: false, progress: 0 }" x-on:livewire-upload-start="isUploading = true"
                x-on:livewire-upload-finish="isUploading = false" x-on:livewire-upload-error="isUploading = false"
                x-on:livewire-upload-progress="progress = $event.detail.progress">
                <div class="form-group">
                    <label class="control-label mb-10">
                        OTP or Sale/Purchase Agreement of property/land being sold
                    </label>
                    <br>
                    <br>
                    <label wire:ignore class="label" data-toggle="tooltip" title="Select Image">
                        <input accept="image/jpeg,image/gif,image/png,application/pdf,image/x-eps"
                            wire:model="new_sale_purchase_agreement" type="file" id="vehicleimage">
                    </label>
                </div>
                @error('new_sale_purchase_agreement')
                <div style="color: red;">
                    {{ $message }}
                </div>
                @enderror
                <div x-show="isUploading">
                    <progress max="100" x-bind:value="progress"></progress>
                </div>
            </div> --}}
        </div>
        <div class="col-md-12">
            <br>
            <hr>
        </div>
        <div class="col-md-12">
            <br>
            <p>Please provide details not found in letter of offer/loan agreement or if there is not one </p>
        </div>
        <div class="col-md-12" style="margin-top: 30px;">
            <label for="new_lot_number" class="form-label">Lot Number</label>
            <input wire:model="new_lot_number" type="text" class="form-control">
            @error("new_lot_number")
            <div style="color: red;">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div wire:ignore.self class="col-md-12" style="margin-top: 30px;">
            <b>OR</b>
            <br>
            <br>
            <label for="new_address" class="form-label">Address</label>
            <input onkeyup="dddd()" wire:model.defer="new_address" type="text" class="form-control" id="ship-address1">
            @error("new_address")
            <div style="color: red;">
                {{ $message }}
            </div>
            @enderror
        </div>

        <div class="col-md-6" style="margin-top: 30px;">
            <label for="new_unit" class="form-label">Unit if any
            </label>
            <input wire:model="new_unit" type="text" class="form-control" id="new_unit">
            @error("new_unit")
            <div style="color: red;">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="col-md-6" style="margin-top: 30px;">
            <label for="new_building_name" class="form-label">Building name if any
            </label>
            <input wire:model="new_building_name" type="text" class="form-control" id="new_building_name">
            @error("new_building_name")
            <div style="color: red;">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="col-md-6" style="margin-top: 30px;">
            <label for="new_lease_remaining" class="form-label">
                Lease remaining

            </label>
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
        <div class="col-md-6" style="margin-top: 40px;">
            <br>
            <div class="form-check form-switch">
                <input wire:model="new_free_hold" class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                <label class="form-check-label" for="flexSwitchCheckDefault">Freehold
                </label>
            </div>
        </div>
        <div class="col-md-6" style="margin-top: 30px;">
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
        <div class="col-md-6" style="margin-top: 30px;">
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
        <div class="col-md-2">
            <br>
            <div class="form-check form-switch">
                <input wire:change="changeAreaTypee()" wire:model="new_square_feet" class="form-check-input"
                    type="checkbox" id="flexSwitchCheckDefault">
                <label class="form-check-label" for="flexSwitchCheckDefault">Square Feet

                </label>
            </div>
        </div>
        <div class="col-md-2">
            <br>
            <div class="form-check form-switch">
                <input wire:change="changeAreaType()" wire:model="new_square_meter" class="form-check-input"
                    type="checkbox" id="flexSwitchCheckDefault">
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
            <select wire:model="construction_year" class="form-control">
                <option value="">Select</option>
                @for ($x = 1990; $x <= date('Y'); $x++) <option value="{{ $x }}">{{ $x }}</option>
                    @endfor
            </select>
        </div>
        <div class="col-md-2">
            <label for="useable_area" class="form-label">Quarterly</label>
            <select wire:model="construction_year_time" class="form-control">
                <option value="">Select</option>
                <option value="1">Q1</option>
                <option value="2">Q2</option>
                <option value="3">Q3</option>
                <option value="4">Q4</option>
            </select>
        </div>
        <div class="col-md-12">
            <br>
            <hr>
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
            <div class="col-md-6" style="margin-top: 30px;">
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
