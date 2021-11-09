<div>
    <div class="row">

        <div class="col-md-6">
            <div class="row">
                <div class="col-md-12 text-left">
                <livewire:widget.upload-component 
                :label="'Tenancy Agreement'" 
                :apply_loan="$apply_loan"
                :main_type="$main_type" 
                :loan_type_id="$loan_type_id" 
                :share_holder="0"
                :modell="'App\Models\LoanGernalInfo'" 
                :keyvalue="'property_renovation_tenancy_agreement'" 
                />
                </div>
                <div class="col-md-12 text-left">
                    <livewire:widget.upload-component 
                :label="'Renovation Quotation'" 
                :apply_loan="$apply_loan"
                :main_type="$main_type" 
                :loan_type_id="$loan_type_id" 
                :share_holder="0"
                :modell="'App\Models\LoanGernalInfo'" 
                :keyvalue="'property_renovation_quotation'" 
                />
                </div>
                <div class="col-md-9" style="margin-top: 30px;">
                    <label for="amount" class="form-label">Amount</label>
                    <input wire:model="amount" type="number" class="form-control" id="amount">
                    @error("amount")
                    <div style="color: red;">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="col-md-12">

                <b>OR</b>
                <br>
                <br>
                <div class="form-check">
                    <input wire:model="user_owned" class="form-check-input" type="checkbox" value="" id="User Owned">
                    <label class="form-check-label" for="User Owned">
                        User Owned
                    </label>
                </div>
                
            </div>
            @if($user_owned)
            <div class="col-md-12">
                <br>
               <p> Please provide address of renovation if  the tenancy agreement or quotation do not indicate address</p>
            </div>
            @endif
            <div wire:ignore.self class="col-md-12" style="margin-top: 30px;">
                <label for="address" class="form-label">Address</label>
                <input onkeyup="dddd()" wire:model.defer="address" type="text" class="form-control" id="ship-address1">
                @error("address")
                <div style="color: red;">
                    {{ $message }}
                </div>
                @enderror

            </div>
            <div class="col-md-12" style="margin-top: 30px;">
                <label for="unit" class="form-label">Unit if any
                </label>
                <input wire:model="unit" type="text" class="form-control" id="unit">
                @error("unit")
                <div style="color: red;">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="col-md-12" style="margin-top: 30px;">
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
        <div class="col-12">
            <br>
            <button class="btn" type="button" wire:target="store" wire:click.prevent="store">
                <span wire:loading="" wire:target="store" class="spinner-border spinner-border-sm" role="status"
                    aria-hidden="true"></span>
                Save &amp; Continue
            </button>
        </div>
    </div>