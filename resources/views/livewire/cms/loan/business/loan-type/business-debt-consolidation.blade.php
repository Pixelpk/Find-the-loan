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
        <div x-data="{ isUploading: false, progress: 0 }" x-on:livewire-upload-start="isUploading = true"
            x-on:livewire-upload-finish="isUploading = false" x-on:livewire-upload-error="isUploading = false"
            x-on:livewire-upload-progress="progress = $event.detail.progress">
            <div class="form-group">

                <br>
                <br>
                <label wire:ignore class="label" data-toggle="tooltip" title="Select Image">
                    <input accept="image/jpeg,image/gif,image/png,application/pdf,image/x-eps" wire:model="document"
                        type="file" id="vehicleimage">
                </label>
            </div>
            @error('document')
            <div style="color: red;">
                {{ $message }}
            </div>
            @enderror
            <div x-show="isUploading">
                <progress max="100" x-bind:value="progress"></progress>
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <b>OR</b><br><br><br>
        <b>DCP refinancing </b><br><br>
    </div>
    <div class="col-md-6">
        <div x-data="{ isUploading: false, progress: 0 }" x-on:livewire-upload-start="isUploading = true"
            x-on:livewire-upload-finish="isUploading = false" x-on:livewire-upload-error="isUploading = false"
            x-on:livewire-upload-progress="progress = $event.detail.progress">
            <div class="form-group">
                <label>
                    Settlement Notice From The Original Bank
                </label>
                <br>
                <br>
                <label class="label" data-toggle="tooltip" title="Select Image">
                    <input accept="image/jpeg,image/gif,image/png,application/pdf,image/x-eps"
                        wire:model="settlement_notice" type="file" id="vehicleimage">
                </label>
            </div>
            @error('settlement_notice')
            <div style="color: red;">
                {{ $message }}
            </div>
            @enderror
            <div x-show="isUploading">
                <progress max="100" x-bind:value="progress"></progress>
            </div>
        </div>
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
