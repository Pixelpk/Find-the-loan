<div>
    <!-- DEBT 1ST SECTION -->
    <div class="border rounded p-3">
        <div class="row">
            <div class="col-md-8 ps-4">
                <p>Please upload any of the following.</p>
                <ul style="list-style-type:square;padding-left:10px; font-size: 13px;">
                    <li>Latest statements showing billed balance amounts</li>
                    <li>Charge slips or online statements showing unbilled balance amounts</li>
                    <li>Confirmation letter of evidence for billed and unbilled balances of unsecured credit instalment
                        plans </li>
                    <li>Any other relevant documents evidencing account information or balances</li>
                </ul>
            </div>
            <div class="col-md-4">
                <div class="mb-3">
                    <livewire:widget.upload-component :label="'Upload your Benefit illustration'"
                        :apply_loan="$apply_loan" :main_type="$main_type" :loan_type_id="$loan_type_id"
                        :share_holder="0" :modell="'App\Models\LoanGernalInfo'"
                        :keyvalue="'debt_consolidation_documents'" />
                    @error("documents")
                    <div style="color: red;">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
            </div>
        </div>
    </div>




    <div class="row mt-2">
        <p><b>OR</b></p>
    </div>

    <div class="row mt-1">
        <p><b>DCP refinancing </b></p>
        <div class="col-md-6">
            <div class="mb-3">
                <livewire:widget.upload-component :label="'Settlement Notice From The Original Bank'"
                    :apply_loan="$apply_loan" :main_type="$main_type" :loan_type_id="$loan_type_id" :share_holder="0"
                    :modell="'App\Models\LoanGernalInfo'" :keyvalue="'debt_consolidation_settlement_notice'" />
                @error("settlement_notice")
                <div style="color: red;">
                    {{ $message }}
                </div>
                @enderror
            </div>
        </div>
        <div class="col-md-6">
            <div class="mb-3">
                <label for="amount" class="form-label">Amount required</label>
                <input wire:model.defer="amount" type="number" class="form-control" id="amount">
                @error("amount")
                <div style="color: red;">
                    {{ $message }}
                </div>
                @enderror
            </div>
        </div>
    </div>
</div>
<!-- /DEBT 1ST SECTION -->




<div class="mt-3 text-end">
    <button class="btn" type="button" wire:target="store" wire:click.prevent="store">
        <span wire:loading="" wire:target="store" class="spinner-border spinner-border-sm" role="status"
            aria-hidden="true"></span>
        Save &amp; Continue
    </button>
</div>
</div>
