<div>


    <div class="row mt-2">
        <div class="col-md-6">
            <div class="mb-3">
                <livewire:widget.upload-component :label="'Add all purchase orders seeking financing'"
                    :apply_loan="$apply_loan" :main_type="$main_type" :loan_type_id="$loan_type_id" :share_holder="0"
                    :modell="'App\Models\LoanGernalInfo'" :keyvalue="'business_invoice_financing_purchase'" />
            </div>
        </div>
        <div class="col-md-6">
            <div class="mb-3">
                <livewire:widget.upload-component
                    :label="'Latest account payables report (ageing list ) ideally within 30 days '"
                    :apply_loan="$apply_loan" :main_type="$main_type" :loan_type_id="$loan_type_id" :share_holder="0"
                    :modell="'App\Models\LoanGernalInfo'"
                    :keyvalue="'business_invoice_financing_latest_account_report'" />
            </div>
        </div>
        <div class="col-md-6">
            <div class="mb-3">
                <label for="amount" >Amount required</label>
                <br>
                <span style="font-size:12px;"> (It should not be more than outstanding value of PO)
                </span>
                <input wire:model="amount" type="number" class="form-control" id="amount">
                @error("amount")
                <div style="color: red;">
                    {{ $message }}
                </div>
                @enderror
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 mt-2">
            <ul style="list-style-type:square; list-style-type: none;">
                <li>
                    <b>Please ensure the invoice/PO has the following or it may result in delays/decline in/of your
                        enquiry:</b>
                </li>
                <li>
                    Buyer and seller’s company name
                </li>
                <li>
                    Payment terms/date
                </li>
                <li>
                    Date the goods or service were/will be provided
                </li>
                </li>
                <li>
                    For goods and services where the final payment amount may differ due to acceptance, a credit
                    note/return policy may be requested later by the Financing Partners
                </li>
                <li>
                    <b>For progressive payment:</b>
                </li>
                <li>
                    Milestones should each have a start date/end date and payment date even if estimated or a range.
                    E.g 1st phrase 4-6 weeks required and payment within 30 days of delivery.
                </li>
                <li>
                    If a down payment has been made please attached e.g a screen shot if it is not reflect in
                    previously uploaded bank statement
                    <br>
                </li>
                <li>
                    If the above is on a separate document, you may attach them as optional documents below
                </li>
            </ul>


        </div>


    </div>

    <hr>
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
                :keyvalue="'business_invoice_financing_optional'"/>
               <!--  @error("document")
                <div style="color: red;">
                    {{ $message }}
                </div>
                @enderror -->
            </div>
        </div>
    </div>

    <div class="row mt-1">

        <div class="mt-3 text-end">
            <button class="btn" type="button" wire:target="store" wire:click.prevent="store">
                <span wire:loading="" wire:target="store" class="spinner-border spinner-border-sm" role="status"
                    aria-hidden="true"></span>
                Save &amp; Continue
            </button>
        </div>
    </div>
</div>
