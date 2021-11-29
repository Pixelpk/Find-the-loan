<section>
    <div class="row">
        <div class="col-md-12">
            <label for="amount" class="form-label">Amount Required</label>
            <input wire:model="amount" type="number" class="form-control" id="amount">
            @error("amount")
            <div style="color: red;">
                {{ $message }}
            </div>
            @enderror
            <br>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <button class="btn btn-custom" wire:click="store">Save & Continue</button>
        </div>
    </div>
</section>
