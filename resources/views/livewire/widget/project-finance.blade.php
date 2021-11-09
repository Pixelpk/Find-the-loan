<div>
    <div class="row">
        <div class="col-md-12 text-left">
             <livewire:widget.upload-component 
             :label="'Documents such as letter of interest, confirmed work order, contract/tender etc'" 
             :apply_loan="$apply_loan"
             :main_type="$main_type" 
             :loan_type_id="$loan_type_id" 
             :share_holder="0"
             :modell="'App\Models\LoanGernalInfo'" 
             :keyvalue="'project_finance_document'"/>
         @error("document")
         <div style="color: red;">
             {{ $message }}
         </div>
         @enderror
        </div>
        <div class="col-md-6">
            <br>
            <label for="" class="form-label">Tenure required</label>
            <div class="input-group mb-3">
                <input type="text" class="form-control" wire:model="tenure">
                <div class="input-group-append">
                    <span class="input-group-text" id="basic-addon2">Month</span>
                </div>
            </div>
            @error("tenure")
            <div style="color: red;">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="col-md-12" style="margin-top: 30px;">
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
   
    <script type="text/javascript">
        document.addEventListener('DOMContentLoaded', function () {
            window.livewire.on('urlChanged', param => {
                history.pushState(null, null, `${document.location.pathname}?${param}`);
            });
        });
    </script>
  
