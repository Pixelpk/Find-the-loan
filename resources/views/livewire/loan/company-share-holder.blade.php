<section>
    <div class="row">
        @foreach($get_share_holder_type as $key => $item)
        <div class="col-md-4 col-lg-3 mb-3">
            <div class="form-check">
                <label class="form-check-label" for="flexSwitchCheckDefault">Shareholder
                    @if($key++ == 0)
                    1
                    @else
                    {{ $key++ }}
                    @endif
                </label>
                <select class="form-select" wire:model="checkShareHolder.{{ $item['id'] }}"
                    wire:change="getShareholderTypeId({{ $item['id'] }})">
                    <option value="0">Person</option>
                    <option value="1">Company</option>
                </select>
            </div>
        </div>
        @endforeach
    </div>
    <div class="row mt-3">
        <div class="col-md-12 col-lg-12 mb-3">
            <div class="form-check">
                <div id="accordion">
                    @foreach($get_share_holder_type as $key => $item)
                    @if($item['share_holder_type'] == 1)
                    <div class="card">
                        @php $shreholder = $item['id'] @endphp
                        <div class="card-header" id="{{ $shreholder }}">
                            <h5 class="mb-0">
                                <button class="btn" data-toggle="collapse" data-target="#collapseOne{{ $shreholder }}"
                                    aria-expanded="true" aria-controls="collapseOne{{ $shreholder }}">
                                    Shareholder Person
                                    @if($key++ == 0)
                                    1
                                    @else
                                    {{ $key++ }}
                                    @endif
                                </button>
                            </h5>
                        </div>
                        <div wire:ignore.self style="margin-top: 30px;" id="collapseOne{{ $shreholder }}"
                            class="collapse {{  $key == 0 ? 'show' : '' }}" aria-labelledby="{{ $shreholder }}"
                            data-parent="#accordion">
                            <div class="card-body">

                                <!-- SHAREHOLDER__SELECT PERSON -->
                                <div class="row">
                                    <p class="mb-1"> <b>NRIC</b> or <b>Passport/Identity Card</b> (
                                        Foreigner)</p>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div x-data="{ isUploading: false, progress: 0 }"
                                            x-on:livewire-upload-start="isUploading = true"
                                            x-on:livewire-upload-finish="isUploading = false"
                                            x-on:livewire-upload-error="isUploading = false"
                                            x-on:livewire-upload-progress="progress = $event.detail.progress">
                                            <div class="form-group">
                                                <br>
                                                <label for="">NRIC Front</label>
                                                <input wire:model="nric_front.{{ $shreholder }}"
                                                    accept="image/jpeg,image/gif,image/png,application/pdf,image/x-eps"
                                                    type="file" class="form-control" id="vehicleimage" name="" id="">
                                                </label>
                                            </div>
                                            @error("nric_front.$shreholder")
                                            <div style="color: red;">
                                                @php $message = preg_replace('/[0-9]+/', '', $message);
                                                @endphp
                                                {{ $message }}
                                            </div>
                                            @enderror
                                            <div x-show="isUploading">
                                                <progress max="100" x-bind:value="progress"></progress>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div x-data="{ isUploading: false, progress: 0 }"
                                            x-on:livewire-upload-start="isUploading = true"
                                            x-on:livewire-upload-finish="isUploading = false"
                                            x-on:livewire-upload-error="isUploading = false"
                                            x-on:livewire-upload-progress="progress = $event.detail.progress">
                                            <div class="form-group">
                                                <br>
                                                <label for="">NRIC Back</label>
                                                <input wire:model="nric_back.{{ $shreholder }}"
                                                    accept="image/jpeg,image/gif,image/png,application/pdf,image/x-eps"
                                                    type="file" class="form-control" id="vehicleimage" name="" id="">
                                                </label>
                                            </div>
                                            @error("nric_back.$shreholder")
                                            <div style="color: red;">
                                                @php $message = preg_replace('/[0-9]+/', '', $message);
                                                @endphp
                                                {{ $message }}
                                            </div>
                                            @enderror
                                            <div x-show="isUploading">
                                                <progress max="100" x-bind:value="progress"></progress>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div x-data="{ isUploading: false, progress: 0 }"
                                            x-on:livewire-upload-start="isUploading = true"
                                            x-on:livewire-upload-finish="isUploading = false"
                                            x-on:livewire-upload-error="isUploading = false"
                                            x-on:livewire-upload-progress="progress = $event.detail.progress">
                                            <div class="form-group">
                                                <br>
                                                <label for="">Passport</label>
                                                <input wire:model="passport.{{ $shreholder }}"
                                                    accept="image/jpeg,image/gif,image/png,application/pdf,image/x-eps"
                                                    type="file" class="form-control" id="vehicleimage" name="" id="">
                                                </label>
                                            </div>
                                            @error("passport.$shreholder")
                                            <div style="color: red;">
                                                @php $message = preg_replace('/[0-9]+/', '', $message);
                                                @endphp
                                                {{ $message }}
                                            </div>
                                            @enderror
                                            <div x-show="isUploading">
                                                <progress max="100" x-bind:value="progress"></progress>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-4">
                                    <p class="mb-1"> <b>Personal NOA</b></p>
                                    <p class="mb-1">(Notice of Assessment) 2 Years</p>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div x-data="{ isUploading: false, progress: 0 }"
                                            x-on:livewire-upload-start="isUploading = true"
                                            x-on:livewire-upload-finish="isUploading = false"
                                            x-on:livewire-upload-error="isUploading = false"
                                            x-on:livewire-upload-progress="progress = $event.detail.progress">
                                            <div class="form-group">
                                                <br>
                                                <label for="">Latest</label>
                                                <input wire:model="nao_latest.{{ $shreholder }}"
                                                    accept="image/jpeg,image/gif,image/png,application/pdf,image/x-eps"
                                                    type="file" class="form-control" id="vehicleimage" name="" id="">
                                                </label>
                                            </div>
                                            @error("nao_latest.$shreholder")
                                            <div style="color: red;">
                                                @php $message = preg_replace('/[0-9]+/', '', $message);
                                                @endphp
                                                {{ $message }}
                                            </div>
                                            @enderror
                                            <div x-show="isUploading">
                                                <progress max="100" x-bind:value="progress"></progress>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div x-data="{ isUploading: false, progress: 0 }"
                                            x-on:livewire-upload-start="isUploading = true"
                                            x-on:livewire-upload-finish="isUploading = false"
                                            x-on:livewire-upload-error="isUploading = false"
                                            x-on:livewire-upload-progress="progress = $event.detail.progress">
                                            <div class="form-group">
                                                <br>
                                                <label for="">Older</label>
                                                <input wire:model="nao_older.{{ $shreholder }}"
                                                    accept="image/jpeg,image/gif,image/png,application/pdf,image/x-eps"
                                                    type="file" class="form-control" id="vehicleimage" name="" id="">
                                                </label>
                                            </div>
                                            @error("nao_older.$shreholder")
                                            <div style="color: red;">
                                                @php $message = preg_replace('/[0-9]+/', '', $message);
                                                @endphp
                                                {{ $message }}
                                            </div>
                                            @enderror
                                            <div x-show="isUploading">
                                                <progress max="100" x-bind:value="progress"></progress>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mt-4">
                                    <p> <b>I don't have income proof because i am</b></p>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-md-4">
                                        <select class="form-select" name="" id=""
                                            wire:model.defer="not_proof.{{ $shreholder }}">
                                            <option value="" hidden>Select</option>
                                            <option value="1">Student</option>
                                            <option value="2">Homemaker</option>
                                            <option value="3">Retired</option>
                                            <option value="4">Unemployed</option>
                                        </select>
                                        @error("not_proof.$shreholder")
                                        <div style="color: red;">
                                            @php $message = preg_replace('/[0-9]+/', '', $message);
                                            @endphp
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="ro">
                                    <br>
                                    <button class="btn" type="button" wire:target='share_holder_document_store'
                                        wire:click.prevent='share_holder_document_store({{ $item['id'] }})'>
                                        <span wire:loading wire:target="share_holder_document_store"
                                            class="spinner-border spinner-border-sm" role="status"
                                            aria-hidden="true"></span>
                                        Save
                                    </button>
                                </div>
                                <!-- /SHAREHOLDER__SELECT PERSON -->
                            </div>
                        </div>
                    </div>
                    @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
