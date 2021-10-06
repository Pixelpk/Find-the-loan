<section>
    <form class="row g-3">
        @foreach (Config::get("gernalinfo.$loan_type_id") as $key => $item)
        @if($item['type'] == 'file')
        <div class="col-md-6 text-left">
            <div x-data="{ isUploading: false, progress: 0 }" x-on:livewire-upload-start="isUploading = true"
                x-on:livewire-upload-finish="isUploading = false" x-on:livewire-upload-error="isUploading = false"
                x-on:livewire-upload-progress="progress = $event.detail.progress">
                <div class="form-group">

                    <label class="control-label mb-10">
                        {{ $item['label'] }}
                    </label>
                    <br>
                    <br>
                    <label wire:ignore class="label" data-toggle="tooltip" title="Select Image">
                        <input wire:model="gernalinfo.{{ $item['key'] }}" type="{{ $item['type'] }}" id="vehicleimage">
                    </label>
                </div>
                @error('subsidiary')
                <div style="color: red;">
                    {{ $message }}
                </div>
                @enderror
                <div x-show="isUploading">
                    <progress max="100" x-bind:value="progress"></progress>
                </div>
            </div>
        </div>
        @endif
        @if($item['type'] == 'checkbox')
        <div class="col-md-12">
            <div class="form-check">
                <input wire:model="gernalinfo.{{ $item['key'] }}" class="form-check-input" type="checkbox" value=""
                    id="{{  $item['label'] }}">
                <label class="form-check-label" for="{{  $item['label'] }}">
                    {{ $item['label'] }}
                </label>
            </div>
        </div>
        @endif
        @if($item['type'] == 'number')
        <div class="col-md-6" style="margin-top: 30px;">
            <label class="form-label">{{ $item['label'] }}</label>
            <input wire:model="gernalinfo.{{ $item['key'] }}" type="number" class="form-control" id="amount">
            @if(session('sessionMessage'))
            <div style="color:red;">
                {{ session('sessionMessage') }}
            </div>
            @endif
        </div>
        @endif
        <div class="col-md-12">
            @error('gernalinfo.'.$item['key'])
            <div class="text-danger">
                {{ $message }}
            </div>
            @enderror
        </div>
        @endforeach
        <div class="col-12">
            <button class="btn btn-primary" type="button" wire:target='store' wire:click.prevent='store'>
                <span wire:loading wire:target="store" class="spinner-border spinner-border-sm" role="status"
                    aria-hidden="true"></span>
                Save & Continue
            </button>
        </div>
    </form>
</section>
