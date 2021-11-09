<div class="row">
    <div class="col-md-8">
        <p>Please upload any of the following.</p>
        <ul style="list-style-type:disc;margin-left:20px;">
            <li>Latest statements showing billed balance amounts</li>
            <li>Charge slips or online statements showing unbilled balance amounts</li>
            <li>Confirmation letter of evidence for billed and unbilled balances of unsecured credit instalment plans
            </li>
            <li>Any other relevant documents evidencing account information or balances</li>
        </ul>
    </div>
    <div class="col-md-4">
        <livewire:widget.upload-component 
        :label="'Or upload your Benefit illustration'" 
        :apply_loan="$apply_loan"
        :main_type="$main_type" 
        :loan_type_id="$loan_type_id" 
        :share_holder="0"
        :modell="'App\Models\LoanGernalInfo'" 
        :keyvalue="'debt_consolidation_documents'" 
        />
        @error("documents")
        <div style="color: red;">
            {{ $message }}
        </div>
        @enderror
    </div>
    <div class="col-md-12">
        <b>OR</b><br><br><br>
        <b>DCP refinancing </b><br><br>
    </div>
    <div class="col-md-6">
        <livewire:widget.upload-component 
        :label="'Or upload your Benefit illustration'" 
        :apply_loan="$apply_loan"
        :main_type="$main_type" 
        :loan_type_id="$loan_type_id" 
        :share_holder="0"
        :modell="'App\Models\LoanGernalInfo'" 
        :keyvalue="'debt_consolidation_settlement_notice'" 
        />
        @error("settlement_notice")
        <div style="color: red;">
            {{ $message }}
        </div>
        @enderror
        <div class="col-md-6">
           
        </div>
        <div class="col-md-6" style="margin-top: 30px;">
            <label for="amount" class="form-label">Amount</label>
            <input wire:model="amount" type="number" class="form-control" id="amount">
            @error("amount")
            <div style="color: red;">
                {{ $message }}
            </div>
            @enderror
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
</div>
