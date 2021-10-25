<div x-data="{ isUploading: false, progress: 0 }" x-on:livewire-upload-start="isUploading = true"
    x-on:livewire-upload-finish="isUploading = false" x-on:livewire-upload-error="isUploading = false"
    x-on:livewire-upload-progress="progress = $event.detail.progress">
    <div class="form-group">
        <label class="control-label mb-10">
           {{ $label }}
        </label>
        <br>
        <br>
        <label  class="label" data-toggle="tooltip" title="Select Image">
            <input  accept="image/jpeg,image/gif,image/png,application/pdf,image/x-eps" wire:model="file" type="file"
                id="uploadID">
        </label>
    </div>
    @error('images')
    <div style="color: red;">
        {{ $message }}
    </div>
    @enderror
    <div x-show="isUploading">
        <progress max="100" x-bind:value="progress"></progress>
    </div>
  

</div>


