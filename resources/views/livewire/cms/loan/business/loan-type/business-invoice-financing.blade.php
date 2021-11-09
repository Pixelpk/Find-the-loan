<div class="row">
    <div class="col-md-6">

        <ul style="list-style-type:disc;margin-left:20px;">
            <li>
                <p style="margin-bottom: 0px;">
                    Please ensure the invoice/PO has the following or it may result in delays/decline in/of your
                    enquiry.:
                </p>
                <p style="margin-bottom: 0px;">
                    Buyer and seller’s company name
                </p>
                <p style="margin-bottom: 0px;">
                    Payment terms/date
                </p>
                <p style="margin-bottom: 0px;">
                    Date the goods or service were/will be provided
                </p>
                <br>
            </li>
           
            <li>
                
                <p style="margin-bottom: 0px;">
                    If a down payment has been made please attached e.g a screen shot if it is not reflect in previously
                    uploaded bank statement

                </p>
                <br>
            </li>
           
        </ul>
    </div>
    <div class="col-md-6">

        <ul style="list-style-type:disc;margin-left:20px;">
          
            <li>
               
                <p style="margin-bottom: 0px;">
                    For progressive payment:
                </p>
                <p style="margin-bottom: 0px;">
                    Milestones should each have a start date/end date and payment date even if estimated or a range. E.g
                    1st phrase 4-6 weeks required and payment within 30 days of delivery.
                   
                </p>
                <br>
            </li>
            <li>
                <p style="margin-bottom: 0px;">
                    If the above is on a separate document, you may attach them as optional documents below
                </p>
            </li>
            
        </ul>
    </div>
    <div class="col-md-6">
        <livewire:widget.upload-component :label="'Add all purchase orders seeking financing'" :apply_loan="$apply_loan"
            :main_type="$main_type" :loan_type_id="$loan_type_id" :share_holder="0"
            :modell="'App\Models\LoanGernalInfo'" :keyvalue="'business_invoice_financing_purchase'" />
    </div>
    <div class="col-md-6">
        <livewire:widget.upload-component :label="'Latest account payables report (ageing list ) ideally within 30 days '" :apply_loan="$apply_loan"
            :main_type="$main_type" :loan_type_id="$loan_type_id" :share_holder="0"
            :modell="'App\Models\LoanGernalInfo'" :keyvalue="'business_invoice_financing_latest_account_report'" />
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