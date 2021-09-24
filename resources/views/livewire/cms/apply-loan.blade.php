@php
$main_types = loanProfile();
@endphp
<section class="section-white small-padding" style="margin-top: 50px;">
    <div class="container">
        <div class="card" style="margin-top:30px;">
            <div class="card-body">
                <ul class="nav nav-pills">
                    <li class="nav-item">
                        <a wire:click="$set('tab', '1')" style="padding: .1rem 1rem;"
                            class="nav-link {{ $tab == '1' ? 'active' : '' }}" aria-current="page" href="#">LOAN
                            TYPE</a>
                    </li>
                    @if($loan_type_id)
                    <li wire:click="goToReasons()" class="nav-item">
                        <a style="padding: .1rem 1rem;" class="nav-link {{ $tab == '2' ? 'active' : '' }}"
                            href="#">REASON</a>
                    </li>

                    <li class="nav-item">
                        <a wire:click="storeReason()" aria-disabled="true" style="padding: .1rem 1rem;"
                            class="nav-link {{ $tab == '3' ? 'active' : '' }}" href="#">AMOUNT</a>
                    </li>
                    @if($amount)
                    <li class="nav-item">
                        <a wire:click="companyDetail()" style="padding: .1rem 1rem;"
                            class="nav-link {{ $tab == '4' ? 'active' : '' }}" href="#">COMPANY DETAIL</a>
                    </li>
                    @endif
                    @if($apply_loan)
                    <li class="nav-item">
                        <a wire:click="companyDetailStore()" style="padding: .1rem 1rem;"
                            class="nav-link {{ $tab == '5' ? 'active' : '' }}" href="#">COMPANY DOCUMENTS</a>
                    </li>
                    @if($tab == 6)
                    <li class="nav-item">
                        <a wire:click="companyDetailStore()" style="padding: .1rem 1rem;"
                            class="nav-link {{ $tab == '6' ? 'active' : '' }}" href="#">COMPANY SHARE HOLDER</a>
                    </li>
                    @endif
                    @endif
                    @endif
                    {{-- <li class="nav-item">
                        <a style="padding: .1rem 1rem;" class="nav-link" href="#">COMPANY SHARE HOLDER</a>
                    </li>  --}}

                    {{-- <li class="nav-item">
                        <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
                    </li> --}}
                </ul>
                @if($tab == 1)
                <div class="row g-3" style="margin-top: 30px;">
                    <div class="col-md-12">
                        <label for="">Select Profile</label>
                        <select style="margin-top: 10px;" wire:model="main_type" class="form-select"
                            aria-label="Default select example" wire:change="getMainType()">
                            <option value="" hidden>Select</option>
                            <option value="1">Business</option>
                            <option value="2">Consumer</option>
                        </select>
                    </div>
                </div>
                @if(sizeof($mainTypes) > 0)
                <div class="row">
                    @foreach($mainTypes as $item)
                    <div class="col-md-3" style="padding-top:30px;">
                        <div class="list-group">
                            <a href="#" class="custmbtn list-group-item list-group-item-action active">
                                {{ $item->main_type }}
                            </a>
                            @foreach($item->subTypes as $key => $subType)
                            <a class="list-group-item list-group-item-action">
                                <div class="form-check form-switch">
                                    <input wire:model="values.{{ $subType->id }}"
                                        wire:click="getLoanReason({{ $subType->id }}, {{ $key }})"
                                        class="form-check-input singleCheck" type="checkbox" />
                                    <label class="form-check-label"
                                        for="{{ $subType->id }}">{{ $subType->sub_type }}</label>
                                </div>
                            </a>
                            @endforeach
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="row">
                    <div class="col-12">
                        <br>
                        <button @if(!$loan_type_id) disabled @endif class="btn btn-primary" type="button"
                            wire:target='goToReasons' wire:click.prevent='goToReasons'>
                            <span wire:loading wire:target="goToReasons" class="spinner-border spinner-border-sm"
                                role="status" aria-hidden="true"></span>
                            Submit
                        </button>
                    </div>
                </div>
                @endif
                @elseif($tab == 2)
                <div class="row">
                    <div class="col-md-12 text-center" style="margin-top: 30px;"><b style="font-size: 30px;">Loan
                            Reason</b></div>
                    @foreach($loanReasons as $key => $item)
                    <div class="col-md-4" style="margin-top: 30px;">
                        <div class="form-check form-switch">
                            <input wire:model="reasonValue.{{ $item->id }}" class="form-check-input" type="checkbox" />
                            <label class="form-check-label" for="{{ $item->id }}">{{ $item->reason }}</label>
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="row">
                    <div class="col-12">
                        <br>
                        <button class="btn btn-primary" type="button" wire:target='storeReason'
                            wire:click.prevent='storeReason'>
                            <span wire:loading wire:target="storeReason" class="spinner-border spinner-border-sm"
                                role="status" aria-hidden="true"></span>
                            Submit
                        </button>
                    </div>
                </div>
                @elseif($tab == 3)
                <div class="row">
                    <div class="col-md-12" style="margin-top: 30px;">
                        <label for="amount" class="form-label">AMOUNT</label>
                        <input wire:model="amount" type="number" class="form-control" id="amount">
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <br>
                        <button class="btn btn-primary" type="button" wire:target='companyDetail'
                            wire:click.prevent='companyDetail'>
                            <span wire:loading wire:target="companyDetail" class="spinner-border spinner-border-sm"
                                role="status" aria-hidden="true"></span>
                            Submit
                        </button>
                    </div>
                </div>
                @elseif($tab == 4)
                <div class="row">
                    <div class="col-md-12" style="margin-top: 40px;">
                        <div class="form-check form-switch">
                            <input wire:model="listed_company_check" class="form-check-input" type="checkbox"
                                id="flexSwitchCheckDefault">
                            <label class="form-check-label" for="flexSwitchCheckDefault">This is a listed
                                company</label>
                        </div>
                    </div>
                    <div class="col-md-6" style="margin-top: 30px;">
                        <label for="company_name" class="form-label">COMPANY NAME</label>
                        <input wire:model="company_name" type="text" class="form-control" id="company_name">
                        @error('company_name')
                        <div style="color: red;">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="col-md-6" style="margin-top: 30px;">
                        <label for="company_year" class="form-label">How long has the company</label>
                        <div class="input-group">
                            <input placeholder="yy" wire:model="company_year" type="number" class="form-control"
                                aria-label="Text input with dropdown button">
                            <select wire:model="company_month" class="form-select" aria-label="Default select example"
                                wire:change="getMainType()">
                                <option value="" hidden>Select Month</option>
                                <option value="1">01</option>
                                <option value="2">02</option>
                                <option value="3">03</option>
                                <option value="4">04</option>
                                <option value="5">05</option>
                                <option value="6">06</option>
                                <option value="7">07</option>
                                <option value="8">08</option>
                                <option value="9">09</option>
                                <option value="10">10</option>
                                <option value="11">11</option>
                                <option value="12">12</option>
                            </select>
                        </div>
                        @error('company_year')
                        <div style="color: red;">
                            {{ $message }}
                        </div>
                        @enderror
                        @error('company_month')
                        <div style="color: red;">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="col-md-6" style="margin-top: 30px;">
                        <label for="percentage_shareholder" class="form-label">% of local shareholding
                        </label>
                        <input wire:model="percentage_shareholder" type="number" class="form-control"
                            id="percentage_shareholder">
                        @error('percentage_shareholder')
                        <div style="color: red;">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="col-md-6" style="margin-top: 30px;">
                        <label for="number_of_share_holder" class="form-label">Number of shareholder including parent
                            company if any
                        </label>
                        <input wire:model="number_of_share_holder" type="number" class="form-control"
                            id="number_of_share_holder">
                        @error('number_of_share_holder')
                        <div style="color: red;">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="col-md-6" style="margin-top: 30px;">
                        <label class="form-label">Company structure type</label>
                        <select wire:model="company_structure_type_id" class="form-select"
                            aria-label="Default select example">
                            <option value="" hidden>Select</option>
                            @foreach($company_structure_types as $item)
                            <option value="{{ $item->id }}">{{ $item->structure_type }}</option>
                            @endforeach
                        </select>
                        @error('company_structure_type_id')
                        <div style="color: red;">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="col-md-6" style="margin-top: 30px;">
                        <label class="form-label" for="">Sector</label>
                        <select wire:model="sector_id" class="form-select" aria-label="Default select example">
                            <option value="" hidden>Select</option>
                            @foreach($sectors as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                        @error('sector_id')
                        <div style="color: red;">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="col-md-6" style="margin-top: 30px;">
                        <label for="number_of_employees" class="form-label">Number of full-time employee
                        </label>
                        <input wire:model="number_of_employees" type="number" class="form-control"
                            id="number_of_employees">
                        @error('number_of_employees')
                        <div style="color: red;">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="col-md-6" style="margin-top: 30px;">
                        <label for="revenue" class="form-label">Revenue (rounded up is fine)</label>
                        <div class="input-group">
                            <input placeholder="$" wire:model="revenue" type="number" class="form-control"
                                aria-label="Text input with dropdown button">

                        </div>
                        @error('revenue')
                        <div style="color: red;">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="col-md-6" style="margin-top: 30px;">
                        <label for="website" class="form-label">Company website (if available)</label>
                        <input wire:model="website" type="text" class="form-control" id="website">
                        @error('website')
                        <div style="color: red;">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                </div>
                <div class="row">
                    <div class="col-12">
                        <br>
                        <button class="btn btn-primary" type="button" wire:target='companyDetailStore'
                            wire:click.prevent='companyDetailStore'>
                            <span wire:loading wire:target="companyDetailStore" class="spinner-border spinner-border-sm"
                                role="status" aria-hidden="true"></span>
                            Submit
                        </button>
                    </div>
                </div>
                @elseif($tab == 5)
                <div class="row">
                    <div class="col-md-12" style="margin-top: 30px;">
                        <b>6 months latest bank statement</b>
                        <p>If It’s on or Over The 8th Of The Current Month For Example 8th Jan, You Would Need To Submit
                            from Dec And Not Nov As The Latest Months. For companies less than 6 months old or
                            unprofitable do check out our FAQ here.</p>
                    </div>

                    @for ($x = 1; $x <= 7; $x++) <div class="col-md-3" style="margin-top: 30px;">
                        {{-- <label class="form-check-label" for="flexSwitchCheckDefault">
                            @php echo date('M', strtotime( "-".$x."month")) @endphp
                            @if(1 == $x) (Optional) @endif
                        </label> --}}
                        <div x-data="{ isUploading: false, progress: 0 }"
                            x-on:livewire-upload-start="isUploading = true"
                            x-on:livewire-upload-finish="isUploading = false"
                            x-on:livewire-upload-error="isUploading = false"
                            x-on:livewire-upload-progress="progress = $event.detail.progress">
                            <!-- File Input -->
                            {{-- <input type="file"   wire:model="photo.{{ date('M', strtotime( "-".$x."month")) }}"
                            class="form-control-file" id="exampleFormControlFile1"> --}}
                            {{-- <p>pdf,png,jpeg</p> --}}
                            <div class="form-group text-center">
                                <label class="control-label mb-10">
                                    @php echo date('M', strtotime( "-".$x."month")) @endphp
                                    @if(1 == $x) (Optional) @endif
                                </label>
                                {{-- <label for="" class="control-label mb-10">Blog image:</label> --}}
                                <br>
                                <label wire:ignore class="label" data-toggle="tooltip" title="Select blog image">
                                    <img id="blog_image" class="rounded avatar"
                                        src="{{ asset('assets/images/no_image.png') }}" alt="avatar"
                                        style="width: 120px;height: auto;cursor: pointer;">
                                    <input wire:model="photo.{{ date('M', strtotime( "-".$x."month")) }}" type="file"
                                        id="blog-image-file" required onchange="showImage(this)"
                                        class="sr-only img-crop" name="image" value="" accept="image/*">
                                </label>
                            </div>
                            {{-- @error('photo')
                            
                            @enderror --}}
                            @foreach($errorArray as $error)
                            @if($error == date('M', strtotime( "-".$x."month")))
                            <div style="text-align: center;" class="text-danger">
                                {{ $error. ' month required' }}
                            </div>
                            @endif
                            @endforeach

                            <!-- Progress Bar -->

                            <div x-show="isUploading" style="text-align: center;">
                                <progress max="100" x-bind:value="progress"></progress>
                            </div>
                        </div>
                </div>
                @endfor
                <div class="row">
                    <div class="col-md-12" style="margin-top: 30px;">

                        <b>Consolidated Statement.</b>
                        <p>If Your Statement Is Not Spilt Between Months But One</p>
                    </div>
                    <div class="col-md-3 text-left">
                        <div x-data="{ isUploading: false, progress: 0 }"
                            x-on:livewire-upload-start="isUploading = true"
                            x-on:livewire-upload-finish="isUploading = false"
                            x-on:livewire-upload-error="isUploading = false"
                            x-on:livewire-upload-progress="progress = $event.detail.progress">

                            <div class="form-group text-center">
                                <label class="control-label mb-10">
                                    {{-- <label for="">Con</label> --}}
                                </label>
                                {{-- <label for="" class="control-label mb-10">Blog image:</label> --}}
                                <br>
                                <label wire:ignore class="label" data-toggle="tooltip" title="Select blog image">
                                    <img id="blog_image" class="rounded avatar"
                                        src="{{ asset('assets/images/no_image.png') }}" alt="avatar"
                                        style="width: 120px;height: auto;cursor: pointer;">
                                    <input wire:model="statement" type="file" id="blog-image-file" required
                                        onchange="showImage(this)" class="sr-only img-crop" name="image" value=""
                                        accept="image/*">
                                </label>
                            </div>
                            @error('statement')
                            <div style="color: red;text-align: center">
                                {{ $message }}
                            </div>
                            @enderror
                            {{-- @error('photo')
                            @enderror --}}
                            <!-- Progress Bar -->

                            <div x-show="isUploading" style="text-align: center;">
                                <progress max="100" x-bind:value="progress"></progress>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12" style="margin-top: 30px;">
                        <b>Latest {{ $company_year >= 3 ? '2' : '1' }} Years Financial Statement</b>
                        <p>
                            (Income Statement also known as Profit & Loss
                            + Statement of financial position also known as Balance Sheet)
                        </p>
                    </div>
                    <div class="col-md-3 text-left" style="margin-top: 30px;">
                        <div x-data="{ isUploading: false, progress: 0 }"
                            x-on:livewire-upload-start="isUploading = true"
                            x-on:livewire-upload-finish="isUploading = false"
                            x-on:livewire-upload-error="isUploading = false"
                            x-on:livewire-upload-progress="progress = $event.detail.progress">

                            <div class="form-group text-center">
                                <label class="control-label mb-10">
                                    <label for="">Latest year</label>
                                </label>
                                {{-- <label for="" class="control-label mb-10">Blog image:</label> --}}
                                <br>
                                <label wire:ignore class="label" data-toggle="tooltip" title="Select blog image">
                                    <img id="blog_image" class="rounded avatar"
                                        src="{{ asset('assets/images/no_image.png') }}" alt="avatar"
                                        style="width: 120px;height: auto;cursor: pointer;">
                                    <input wire:model="latest_year" type="file" id="blog-image-file" required
                                        onchange="showImage(this)" class="sr-only img-crop" name="image" value=""
                                        accept="image/*">
                                </label>
                            </div>
                            @error('latest_year')
                            <div style="color: red;text-align: center">
                                {{ $message }}
                            </div>
                            @enderror
                            <!-- Progress Bar -->

                            <div x-show="isUploading" style="text-align: center;">
                                <progress max="100" x-bind:value="progress"></progress>
                            </div>
                        </div>
                    </div>
                    @if($company_year >= 3)
                    <div class="col-md-3 text-left" style="margin-top: 30px;">
                        <div x-data="{ isUploading: false, progress: 0 }"
                            x-on:livewire-upload-start="isUploading = true"
                            x-on:livewire-upload-finish="isUploading = false"
                            x-on:livewire-upload-error="isUploading = false"
                            x-on:livewire-upload-progress="progress = $event.detail.progress">
                            <div class="form-group text-center">
                                <label class="control-label mb-10">
                                    <label for="">Before year</label>
                                </label>
                                {{-- <label for="" class="control-label mb-10">Blog image:</label> --}}
                                <br>
                                <label wire:ignore class="label" data-toggle="tooltip" title="Select blog image">
                                    <img id="blog_image" class="rounded avatar"
                                        src="{{ asset('assets/images/no_image.png') }}" alt="avatar"
                                        style="width: 120px;height: auto;cursor: pointer;">
                                    <input wire:model="year_before" type="file" id="blog-image-file" required
                                        onchange="showImage(this)" class="sr-only img-crop" name="image" value=""
                                        accept="image/*">
                                </label>
                            </div>
                            @error('year_before')
                            <div style="color: red;text-align: center">
                                {{ $message }}
                            </div>
                            @enderror
                            {{-- @error('company_month') --}}
                       
                        {{-- @enderror --}}
                            {{-- @error('photo')
                            
                            @enderror --}}
                            <!-- Progress Bar -->

                            <div x-show="isUploading" style="text-align: center;">
                                <progress max="100" x-bind:value="progress"></progress>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
                <div class="row">
                    <div class="col-md-12" style="margin-top: 30px;">
                        <b>Profitable for the last 2 accounting years</b>
                    </div>
                    <div class="col-md-4" style="margin-top: 30px;">

                        <div class="form-group">

                            <select wire:model="profitable_latest_year" class="form-select" aria-label="Default select example"
                               >
                                <option value="" hidden>Select</option>
                                <option value="1">Yes</option>
                                <option value="0">No</option>
                            </select>
                            @error('profitable_latest_year')
                            <div style="color: red;">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>


                        @error('company_month')
                        <div style="color: red;">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="col-md-4" style="margin-top: 30px;">

                        <div class="form-group">

                            <select wire:model="profitable_before_year" class="form-select" aria-label="Default select example"
                                >
                                <option value="" hidden>Select</option>
                                <option value="1">Yes</option>
                                <option value="0">No</option>
                            </select>
                            @error('profitable_before_year')
                            <div style="color: red;">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>


                      
                    </div>
                    <div class="col-md-12" style="margin-top: 30px;">
                        <b style="color: grey;">Optional info</b>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12" style="margin-top: 30px;">

                        <b>Current Year.</b>
                        <p>If you are <b>more than 3-6 months into your current accounting year,</b> and if your
                            management account(drafts/unaudited) pulls up the average, providing them may be helpful</p>
                    </div>
                    <div class="col-md-3 text-left">
                        <div x-data="{ isUploading: false, progress: 0 }"
                            x-on:livewire-upload-start="isUploading = true"
                            x-on:livewire-upload-finish="isUploading = false"
                            x-on:livewire-upload-error="isUploading = false"
                            x-on:livewire-upload-progress="progress = $event.detail.progress">

                            <div class="form-group text-center">
                                <label class="control-label mb-10">
                                    {{-- <label for="">Con</label> --}}
                                </label>
                                {{-- <label for="" class="control-label mb-10">Blog image:</label> --}}
                                <br>
                                <label wire:ignore class="label" data-toggle="tooltip" title="Select blog image">
                                    <img id="blog_image" class="rounded avatar"
                                        src="{{ asset('assets/images/no_image.png') }}" alt="avatar"
                                        style="width: 120px;height: auto;cursor: pointer;">
                                    <input wire:model="current_year" type="file" id="blog-image-file" required
                                        onchange="showImage(this)" class="sr-only img-crop" name="image" value=""
                                        accept="image/*">
                                </label>
                            </div>
                            @error('current_year')
                            <div style="color: red;text-align:center">
                                {{ $message }}
                            </div>
                            @enderror
                            {{-- @error('photo')
                            
                            @enderror --}}


                            <!-- Progress Bar -->

                            <div x-show="isUploading" style="text-align: center;">
                                <progress max="100" x-bind:value="progress"></progress>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12" style="margin-top: 30px;">
                        <b>Revenue (rounded up is fine)</b>
                    </div>
                    <div class="col-md-3" style="margin-top: 30px;">

                        <div class="form-group">

                            <input type="number" class="form-control" wire:model="optional_revenuee">
                            @error('optional_revenuee')
                            <div style="color: red;">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                      

                       
                    </div>


                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <br>
                    <button  class="btn btn-primary" type="button"
                        wire:target='saveCompanyDocuments' wire:click.prevent='saveCompanyDocuments'>
                        <span wire:loading wire:target="saveCompanyDocuments" class="spinner-border spinner-border-sm"
                            role="status" aria-hidden="true"></span>
                        Submit
                    </button>
                </div>
            </div>
          
            @endif
        </div>
    </div>
    </div>
    <script>
        $(document).on('click', '.singleCheck', function () {
            $('.singleCheck').not(this).prop('checked', false);
        });

    </script>
    <script>
        // Set default FilePond options
        FilePond.setOptions({
            server: {
                process: "{{ config('filepond.server.process') }}",
                revert: "{{ config('filepond.server.revert') }}",
                headers: {
                    'X-CSRF-TOKEN': "{{ @csrf_token() }}",
                }
            }
        });

        // Create the FilePond instance
        FilePond.create(document.querySelector('input[name="avatar"]'));
        FilePond.create(document.querySelector('input[name="gallery[]"]'));

    </script>
</section>
