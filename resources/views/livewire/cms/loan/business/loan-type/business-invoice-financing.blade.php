<div>
    <div class="row">
        <div class="col-md-6 ps-4">
            <p>
                Please ensure the invoice/PO has the following or it may result in delays/decline in/of your
                enquiry:
            </p>
            <ul style="list-style-type: square; padding-left: 10px;">
                <li>
                    <p>
                        Buyer and seller’s company name
                    </p>
                </li>
                <li>
                    <p>
                        Payment terms/date
                    </p>
                </li>
                <li>
                    <p>
                        Date the goods or service were/will be provided
                    </p>
                </li>
    
                <li>
                    <p>
                        If a down payment has been made please attached e.g a screen shot if it is not reflect in previously
                        uploaded bank statement
                    </p>
                </li>
    
            </ul>
        </div>
        <div class="col-md-6 ps-4">
            <p>
                For progressive payment:
            </p>
            <ul style="list-style-type: square; padding-left: 10px;">
                <li>
                    <p>
                        Milestones should each have a start date/end date and payment date even if estimated or a range. E.g
                        1st phrase 4-6 weeks required and payment within 30 days of delivery.
                    </p>
                </li>
                <li>
                    <p>
                        If the above is on a separate document, you may attach them as optional documents below
                    </p>
                </li>
    
            </ul>
        </div>
    </div>

    <div class="row mt-2">
    <div class="col-md-6">
 <div class="mb-3">
    <livewire:widget.upload-component :label="'Add all purchase orders seeking financing'" :apply_loan="$apply_loan"
    :main_type="$main_type" :loan_type_id="$loan_type_id" :share_holder="0"
    :modell="'App\Models\LoanGernalInfo'" :keyvalue="'business_invoice_financing_purchase'" />
 </div>
    </div>
    <div class="col-md-6">
        <div class="mb-3">
            <livewire:widget.upload-component
            :label="'Latest account payables report (ageing list ) ideally within 30 days '" :apply_loan="$apply_loan"
            :main_type="$main_type" :loan_type_id="$loan_type_id" :share_holder="0"
            :modell="'App\Models\LoanGernalInfo'" :keyvalue="'business_invoice_financing_latest_account_report'" />
        </div>
    </div>
</div>

<div class="row mt-2">
    <div class="col-md-6">
      <div class="mb-3">
        <label for="amount" class="form-label">Amount required</label>
        <input wire:model="amount" type="number" class="form-control" id="amount">
        @error("amount")
        <div style="color: red;">
            {{ $message }}
        </div>
        @enderror
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
</div>