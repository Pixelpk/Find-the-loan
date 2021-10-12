<div>
    <div class="row">
        <div class="col-md-12 text-left">
            <div x-data="{ isUploading: false, progress: 0 }" x-on:livewire-upload-start="isUploading = true"
                x-on:livewire-upload-finish="isUploading = false" x-on:livewire-upload-error="isUploading = false"
                x-on:livewire-upload-progress="progress = $event.detail.progress">
                <div class="form-group">
                    <label class="control-label mb-10">
                       <b>
                        Documents such as letter of interest, confirmed work order, contract/tender etc 
                       </b>
                    </label>
                    <br>
                    <br>
                    <label wire:ignore class="label" data-toggle="tooltip" title="Select Image">
                        <input accept="image/jpeg,image/gif,image/png,application/pdf,image/x-eps"
                            wire:model="document" type="file" id="vehicleimage">

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
        <div class="col-md-6">
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
            <input wire:model="amount" type="text" class="form-control" id="amount">
            @error("amount")
            <div style="color: red;">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="col-12">
            <br>
            <button class="btn" type="button" wire:target="store" wire:click.prevent="store">
                <span wire:loading="" wire:target="store" class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                Save &amp; Continue
            </button>
        </div>
    </div>