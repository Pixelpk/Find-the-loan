<section>
    <div class="row">
        <div class="col-md-12" style="margin-top: 30px;">
            <label for="amount" >Amount required
                    <div class="tooltip-c">
                        <i class="fa fa-info-circle"></i>
                        <span class="tooltip-text custom-tooltip-text">Amount required is the amount you are aiming to borrow for that loan type. You may still reduce it prior to signing Loan Offer Letter.</span>
                    </div>
                </label>
            <input wire:model="amount" type="number" class="form-control" id="amount">
            @error("amount")
            <div style="color: red;">
                {{ $message }}
            </div>
            @enderror
            <br>
        </div>
    </div>
    <div class="row text-end">
        <div class="col-md-12">
            <button class="btn btn-custom" wire:click="store">Save & Continue</button>
        </div>
    </div>
</section>
