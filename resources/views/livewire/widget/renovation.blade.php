<div>
    <div class="row">

        <div class="col-md-6">
            <div class="row">
                <div class="col-md-12 text-left">
                    <div x-data="{ isUploading: false, progress: 0 }" x-on:livewire-upload-start="isUploading = true"
                        x-on:livewire-upload-finish="isUploading = false"
                        x-on:livewire-upload-error="isUploading = false"
                        x-on:livewire-upload-progress="progress = $event.detail.progress">
                        <div class="form-group">
                            <label class="control-label mb-10">
                                Tanancy Agreement
                            </label>
                            <br>
                            <br>
                            {{-- @if($apply_loan)
                           @php 
                           if(isset($gernalInfo)){
                            $tanancy_agreement = $gernalInfo->where('key','tanancy_agreement')->where('apply_loan_id', $this->apply_loan->id)->first(); 
                            $tanancy_agreement = $tanancy_agreement->value;
                            }
                           @endphp
                           @if(isset($gernalInfo))
                           <a target="blank" href="{{ Storage::url($tanancy_agreement) }}">
                            <i class="fa fa-file"></i>
                            </a>
                            @endif
                            @endif --}}
                            <label wire:ignore class="label" data-toggle="tooltip" title="Select Image">
                                <input accept="image/jpeg,image/gif,image/png,application/pdf,image/x-eps"
                                    wire:model="tanancy_agreement" type="file" id="vehicleimage">

                            </label>
                        </div>
                        @error('tanancy_agreement')
                        <div style="color: red;">
                            {{ $message }}
                        </div>
                        @enderror
                        <div x-show="isUploading">
                            <progress max="100" x-bind:value="progress"></progress>
                        </div>
                    </div>
                </div>


                <div class="col-md-12 text-left">
                    <div x-data="{ isUploading: false, progress: 0 }" x-on:livewire-upload-start="isUploading = true"
                        x-on:livewire-upload-finish="isUploading = false"
                        x-on:livewire-upload-error="isUploading = false"
                        x-on:livewire-upload-progress="progress = $event.detail.progress">
                        <div class="form-group">
                            <label class=""><br>
                                Renovation Quotation
                            </label>
                            <br>
                            <br>
                            {{-- @php 
                        if(isset($gernalInfo)){
                            $renovation_quotation = $gernalInfo->where('key','renovation_quotation')->where('apply_loan_id', $this->apply_loan->id)->first(); 
                            $renovation_quotation = $renovation_quotation->value;
                        }
                        @endphp
                        @if(isset($gernalInfo) || isset($renovation_quotation))
                        <a target="blank" href="{{ Storage::url($renovation_quotation) }}">
                            <i class="fa fa-file"></i>
                            @endif
                            </a> --}}
                            <label wire:ignore class="label" data-toggle="tooltip" title="Select Image">
                                <input accept="image/jpeg,image/gif,image/png,application/pdf,image/x-eps"
                                    wire:model="renovation_quotation" type="file" id="vehicleimage">

                            </label>
                        </div>
                        @error('renovation_quotation')
                        <div style="color: red;">
                            {{ $message }}
                        </div>
                        @enderror
                        <div x-show="isUploading">
                            <progress max="100" x-bind:value="progress"></progress>
                        </div>
                    </div>
                </div>

                <div class="col-md-9" style="margin-top: 30px;">
                    <label for="amount" class="form-label">Amount</label>
                    <input wire:model="amount" type="number" class="form-control" id="amount">
                    @error("amount")
                    <div style="color: red;">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
            </div>


        </div>

        <div class="col-md-6">

            <div class="col-md-12">

                <b>OR</b>
                <br>
                <br>
                <div class="form-check">
                    <input wire:model="user_owned" class="form-check-input" type="checkbox" value="" id="User Owned">
                    <label class="form-check-label" for="User Owned">
                        User Owned
                    </label>
                </div>
                
            </div>
            @if($user_owned)
            <div class="col-md-12">
                <br>
               <p> Please provide address of renovation if  the tenancy agreement or quotation do not indicate address</p>
            </div>
            @endif
            <div wire:ignore.self class="col-md-12" style="margin-top: 30px;">
                <label for="address" class="form-label">Address</label>
                <input onkeyup="dddd()" wire:model.defer="address" type="text" class="form-control" id="ship-address1">
                @error("address")
                <div style="color: red;">
                    {{ $message }}
                </div>
                @enderror

            </div>
            <div class="col-md-12" style="margin-top: 30px;">
                <label for="unit" class="form-label">Unit if any
                </label>
                <input wire:model="unit" type="text" class="form-control" id="unit">
                @error("unit")
                <div style="color: red;">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="col-md-12" style="margin-top: 30px;">
                <label for="building_name" class="form-label">Building name if any
                </label>
                <input wire:model="building_name" type="text" class="form-control" id="building_name">
                @error("building_name")
                <div style="color: red;">
                    {{ $message }}
                </div>
                @enderror
            </div>
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
