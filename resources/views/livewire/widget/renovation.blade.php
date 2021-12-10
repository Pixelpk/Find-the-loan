<div>

       <div class="row">
                <div class="col-md-4">
                    <div class="mb-3">
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
            <div class="mb-3">
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


            <div class="col-md-8">
                <div class="row">
                    <div class="col-md-2 col-lg-1">
                        <p><b>Or</b></p>
                    </div>
                    <div class="col-md-4 col-lg-3">
                        <div class="form-check mb-3">
                            <input wire:model="user_owned" class="form-check-input" type="checkbox" value="" id="User Owned">
                            <label class="form-check-label" for="User Owned">
                                User Owned
                            </label>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-8">
<p> Please provide address of renovation if  the tenancy agreement or quotation do not indicate address</p>
<div class="mb-3">
    <label for="address" class="form-label">Address</label>
    <input onkeyup="dddd()" wire:model.defer="address" type="text" class="form-control" id="ship-address1">
    @error("address")
    <div style="color: red;">
        {{ $message }}
    </div>
    @enderror
</div>

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
                    :keyvalue="'property_renovation_optional_documents'"/>
                    <!-- @error("document")
                    <div style="color: red;">
                        {{ $message }}
                    </div>
                    @enderror -->
                </div>
            </div>
        </div>

        <div class="text-end">
            <br>
            <button class="btn btn-custom" type="button" wire:target="store" wire:click.prevent="store">
                <span wire:loading="" wire:target="store" class="spinner-border spinner-border-sm" role="status"
                    aria-hidden="true"></span>
                Save &amp; Continue
            </button>
        </div>
    </div>
