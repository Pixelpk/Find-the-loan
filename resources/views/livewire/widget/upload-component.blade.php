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
            <input multiple accept="image/jpeg,image/gif,image/png,application/pdf,image/x-eps" wire:model="images" type="file"
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
    <div class="row">
        @foreach($getImages as $item)
        
        <div class="col-md-12">
            {{ $item['orignal_name'] }}  <span wire:click="removePhoto({{ $item['id'] }})" style="color:red;cursor: pointer;" aria-hidden="true">&times;</span>
        </div>
        @endforeach
    </div>

</div>


