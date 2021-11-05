<section>
    <div class="form-group">

        <label class="control-label mb-10">
            {{ $label }}
        </label>
        <br>
        <br>
        <label class="label" data-toggle="tooltip" title="Select Image">
          
            <span wire:loading >
                <span class="spinner-border spinner-border-sm" role="status"
                    aria-hidden="true"></span>
            </span>

            <input multiple accept="image/jpeg,image/gif,image/png,application/pdf,image/x-eps" wire:model="images"
                type="file" id="uploadID">
        </label>
    </div>
    @error('images')
    <div style="color: red;">
        {{ $message }}
    </div>
    @enderror

    <div class="row">
        @foreach($getImages as $item)
        
        <div class="col-md-12">
            <a target="_blank" href="{{ url('storage/').'/'.$item->image }}">
            {{ $item['orignal_name'] }} 
        </a>
            <span wire:click="removePhoto({{ $item['id'] }})"
                style="color:red;cursor: pointer;" aria-hidden="true">&times;</span>
        </div>
   
        @endforeach
    </div>
</section>
