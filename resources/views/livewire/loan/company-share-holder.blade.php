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
                    <label class="form-check-label" for="flexSwitchCheckDefault">This shareholder is a company</label>
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
                    <div class="col-md-4 d-flex align-items-center">
                        <span style="padding: 43px 10px 0px 10px;"><b>or</b></span>
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

                    <span class="d-flex">
                        <p class="mb-1">

                        <b>Personal NOA</b>

                        &nbsp;&nbsp;
                        <div class="tooltip-c" style="font-size: 16px; color: #ff0000c4;">
                            <i class="fa fa-info-circle"></i>
                            <span class="tooltip-text">Hello World</span>
                        </div>
                    </p>

                    </span>
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
                                <!-- <br> -->
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
                                <!-- <br> -->
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

                <br>
                <hr>
                <div class="row">
                    <div class="col-md-8">
                        <p class="mb-1">
                            If your company constitution allows for borrowing without the approval of the majority of the shareholders, please attach your constitution/M&AA
                            Most Financing Partners need to see at least 30-51% of shareholder information & may still ask for additional shareholder information later via this platform OR if they deem profile of above shareholder/s not strong enough due to e.g NOA, credit score etc
                        </p>
                    </div>
                    <div class="col-md-4">
                        <div x-data="{ isUploading: false, progress: 0 }"
                            x-on:livewire-upload-start="isUploading = true"
                            x-on:livewire-upload-finish="isUploading = false"
                            x-on:livewire-upload-error="isUploading = false"
                            x-on:livewire-upload-progress="progress = $event.detail.progress">
                            <div class="form-group">
                                <label for="">Choose File</label>
                                <input wire:model="share_holder_constitution.{{ $share_holder }}"
                                    accept="image/jpeg,image/gif,image/png,application/pdf,image/x-eps" type="file"
                                    class="form-control" id="vehicleimage" name="" id="">
                                </label>
                            </div>
                            {{-- @error("share_holder_constitution.$share_holder")
                            <div style="color: red;">
                                @php $message = preg_replace('/[0-9]+/', '', $message);
                                @endphp
                                {{ $message }}
                            </div>
                            @enderror --}}
                            <div x-show="isUploading">
                                <progress max="100" x-bind:value="progress"></progress>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="ro">
                    <br>
                    <button class="btn btn-custom" type="button" wire:target='share_holder_document_store'
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
                    <label class="form-check-label" for="flexSwitchCheckDefault">This shareholder is a company</label>
                    <br>
                    <br>
                </div>
            </div>
            <div class="col-md-12">
                <ul class="nav nav-pills">
                    <li class="nav-item">
                        <a wire:click="$set('subtab', '1')"
                            style="padding: .1rem 1rem;"
                            class="nav-link {{ $subtab == 1 ? 'active' : '' }}" aria-current="page" href="#"><b>Shareholder company detail</b></a>
                    </li>
                    @if(!$hideCompanyDocuments)
                    <li class="nav-item">
                        <a wire:click="$set('subtab', '2')"
                            style="padding: .1rem 1rem;" class="nav-link {{ $subtab == 2 ? 'active' : '' }}"
                            aria-current="page" href="#"><b>Shareholder company documents</b></a>
                    </li>
                    @endif
                </ul>

                @if($subtab == 1 && $share_holder)

                <livewire:loan.company-detail :key="$share_holder" :apply_loan="$apply_loan"
                    :share_holder="$share_holder">

                    @endif

                    @if($subtab == 2)

                    <livewire:loan.company-documents key="{{ now() }}" :apply_loan="$apply_loan"
                        :share_holder="$share_holder">

                        @endif
            </div>
            @endif
        </div>
    </div>
    <div class="ro text-end">


        {{-- @if($enableButtons == false) --}}
            <button class="btn btn-custom" type="button" wire:target='searchLender' wire:click.prevent='searchLender'>
                <div class="magnify-loader-background d-none" wire:loading.longest wire:target="searchLender" wire:loading.class.remove="d-none">

                    <div class="magnify-loader">
                            <div class="loadingio-spinner-magnify-hz4ezng7lp">
                                <div class="ldio-8j2236x8qt">
                                    <div><div>
                                    <div></div>
                                    <div></div>
                                    </div></div>
                                </div>
                            </div>
                        <p class="text-center fw-bold" style="color:black;">Please wait... <br> calculating which Financing Partner you can talk to..</p>
                    </div>

                </div>
                {{-- <span wire:loading wire:target="searchLender" class="spinner-border spinner-border-sm" role="status"
                    aria-hidden="true"></span> --}}
                Save Continue
            </button>
        {{-- @else
            <button class="btn btn-custom" disabled>
                <span class="spinner-border-sm" role="status"
                    aria-hidden="true"></span>
                Save Continue
            </button>
        @endif --}}

    </div>
</section>
