<section>
    <ul class="nav nav-pills">
        @php $sr = 1; @endphp
        @foreach($get_share_holder_type as $item)
        <li class="nav-item">
            <a wire:click="gotoView({{ $item }})" style="padding: .1rem 1rem;"
                class="nav-link {{ $share_holder == $item['id'] ? 'active' : '' }}" aria-current="page"
                href="#">Shareholder {{ $sr++ }}</a>
        </li>
        @endforeach
    </ul>
    <div class="ps-3">
        <div class="row">
            @if(!$check && $share_holder)
            <div class="col-md-12">
                <br>
                <br>
                <div class="form-check form-switch">

                    <input wire:change="getShareholderTypeId({{ $item['id'] }})"
                        wire:model="company_share_holder.{{ $share_holder }}" class="form-check-input" type="checkbox"
                        id="flexSwitchCheckDefault">
                    <label class="form-check-label" for="flexSwitchCheckDefault">This shareholder is a comapny</label>
                    <br>
                    <br>
                </div>
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
                                <input wire:model="nric_front.{{ $share_holder }}"
                                    accept="image/jpeg,image/gif,image/png,application/pdf,image/x-eps" type="file"
                                    class="form-control" id="vehicleimage" name="" id="">
                                </label>
                            </div>
                            @error("nric_front.$share_holder")
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
                                <input wire:model="nric_back.{{ $share_holder }}"
                                    accept="image/jpeg,image/gif,image/png,application/pdf,image/x-eps" type="file"
                                    class="form-control" id="vehicleimage" name="" id="">
                                </label>
                            </div>
                            @error("nric_back.$share_holder")
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
                                <input wire:model="passport.{{ $share_holder }}"
                                    accept="image/jpeg,image/gif,image/png,application/pdf,image/x-eps" type="file"
                                    class="form-control" id="vehicleimage" name="" id="">
                                </label>
                            </div>
                            @error("passport.$share_holder")
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
                                <input wire:model="nao_latest.{{ $share_holder }}"
                                    accept="image/jpeg,image/gif,image/png,application/pdf,image/x-eps" type="file"
                                    class="form-control" id="vehicleimage" name="" id="">
                                </label>
                            </div>
                            @error("nao_latest.$share_holder")
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
                                <input wire:model="nao_older.{{ $share_holder }}"
                                    accept="image/jpeg,image/gif,image/png,application/pdf,image/x-eps" type="file"
                                    class="form-control" id="vehicleimage" name="" id="">
                                </label>
                            </div>
                            @error("nao_older.$share_holder")
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
                        <select class="form-select" name="" id="" wire:model.defer="not_proof.{{ $share_holder }}">
                            <option value="" hidden>Select</option>
                            <option value="1">Student</option>
                            <option value="2">Homemaker</option>
                            <option value="3">Retired</option>
                            <option value="4">Unemployed</option>
                        </select>
                        @error("not_proof.$share_holder")
                        <div style="color: red;">
                            @php $message = preg_replace('/[0-9]+/', '', $message);
                            @endphp
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="ro text-end">
                    <br>
                    <button class="btn" type="button" wire:target='share_holder_document_store'
                        wire:click.prevent='share_holder_document_store({{ $item['id'] }})'>
                        <span wire:loading wire:target="share_holder_document_store"
                            class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                        Save
                    </button>
                </div>

            </div>
            @endif
            @if($check && $share_holder)
            <div class="cold-md-12">
                <br>
                <br>
                <div class="form-check form-switch">
                    <input wire:change="getShareholderTypeId({{ $item['id'] }})"
                        wire:model="company_share_holder.{{ $share_holder }}" class="form-check-input" type="checkbox"
                        id="flexSwitchCheckDefault">
                    <label class="form-check-label" for="flexSwitchCheckDefault">This shareholder is a comapny</label>
                    <br>
                    <br>
                </div>
            </div>
            <div class="col-md-12">
                <ul class="nav nav-pills">
                    <li class="nav-item">
                        <a style="padding: .1rem 1rem;padding-left: 0px; {{ $subtab == 1 ? 'color: green;' : '' }}" class="nav-link"
                            aria-current="page" href="#"><b>Shareholder company detail</b></a>
                    </li>
                    <li class="nav-item">
                        <a style="padding: .1rem 1rem; {{ $subtab == 2 ? 'color: green;' : '' }}" class="nav-link"
                            aria-current="page" href="#"><b>Shareholder company documents</b></a>
                    </li>
                </ul>
                @if($subtab == 1)
                <livewire:loan.company-detail :apply_loan="$apply_loan" :share_holder="$share_holder">
                    @endif
                    @if($subtab == 2)
                    <livewire:loan.company-documents :apply_loan="$apply_loan" :share_holder="$share_holder">
                        @endif
            </div>
            @endif
        </div>
    </div>
</section>
