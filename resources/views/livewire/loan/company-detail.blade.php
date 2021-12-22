<section>
    @php $mnth = [" ", "January", "February", "March", "April", "May", "June", "July", "August", "September", "October",
    "November", "December"]; @endphp
    <div class="row">
        <!-- OVERDRAFT UNSECURED COMPANY DETAILS-->
        <div class="row mt-3">
            <div class="col-md-12">
                <div class="form-check form-switch">
                    <input wire:model="listed_company_check" wire:change="listedCompanyCheck()" class="form-check-input"
                        type="checkbox" id="flexSwitchCheckDefault">
                    <label class="form-check-label" for="flexSwitchCheckDefault">This is a listed
                        company</label>
                </div>
            </div>
        </div>

        <div class="row mt-3">
            @if(!$listed_company_check)
            <div class="col-md-5">
                <p> When was the company incorporated?</p>
                <div class="row">
                    <div class="col-md-6">
                        <div class="input-group mb-2">
                            {{-- <label for="">Year</label> --}}
                            <select wire:model="company_years" class="form-select" aria-label="Default select example"
                                wire:change="getnoofYear()">
                                <option value="" hidden>Select</option>
                                @for ($x = 1990; $x <= date('Y'); $x++) <option value="{{ $x }}">

                                    {{  $x }}

                                    </option>
                                    @endfor
                            </select>
                            <label class="input-group-text">Year</label>
                        </div>
                        @error('company_years')
                        <div style="color: red;">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <div class="input-group mb-2">
                            <select wire:model="company_months" class="form-select" aria-label="Default select example"
                                wire:change="getnoofYear()">
                                <option value="" hidden>Select</option>
                                @for ($x = 0; $x <= 12; $x++) @if($x !=0) <option value="{{ $x }}">

                                    {{$mnth[$x] }}

                                    </option>
                                    @endif
                                    @endfor
                            </select>
                            <label class="input-group-text">Month</label>
                            <!-- &nbsp;&nbsp;<p class="pt-2">Month</p> -->
                            @error('company_months')
                            <div style="color: red;">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-1 d-flex justify-content-center pt-5">
                <p class="fw-bold">or</p>
            </div>
            <div class="col-md-6">
                <p>How long has the company been in
                    business?</p>
                <div class="row ">
                    <div class="col-md-6">
                        <div class="input-group mb-2">
                            <input wire:keyup="resetComapny" placeholder="No of years" wire:model="company_year"
                                type="number" class="form-control" aria-label="Text input with dropdown button">
                            <label class="input-group-text">Years</label>
                        </div>
                        @error('company_year')
                        <div style="color: red;">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <div class="input-group mb-2">
                            <input wire:keyup="resetComapny" placeholder="No of months" wire:model="company_month"
                                type="number" class="form-control" aria-label="Text input with dropdown button">
                            <label class="input-group-text">Months</label>
                        </div>
                        @error('company_month')
                        <div style="color: red;">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-md-6">
                <label for="percentage_shareholder" class="form-label">% of local shareholding
                </label>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">

                    </div>
                    <input wire:model="percentage_shareholder" type="number" class="form-control"
                        id="percentage_shareholder">
                    <div class="input-group-append">
                        <span class="input-group-text">%</span>
                    </div>
                </div>

                @error('percentage_shareholder')
                <div style="color: red;">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <div class="col-md-6">
                <label for="number_of_share_holder" class="form-label">Number of shareholder including
                    parent
                    company if any
                </label>
                <input max="10" wire:model="number_of_share_holder" type="number" class="form-control"
                    id="number_of_share_holder">
                @error('number_of_share_holder')
                <div style="color: red;">
                    {{ $message }}
                </div>
                @enderror
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-md-6">
                <label class="form-label">Company structure type</label>
                <select wire:model="company_structure_type_id" class="form-select" aria-label="Default select example">
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

            <div class="col-md-6">
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
        </div>

        <div class="row mt-3">
            <div class="col-md-6">
                <label for="number_of_employees" class="form-label">Number of full-time employee
                </label>
                <input wire:model="number_of_employees" type="number" class="form-control" id="number_of_employees">
                @error('number_of_employees')
                <div style="color: red;">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="col-md-6">
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
        </div>

        <div class="row mt-3">
            <div class="col-md-6">
                <label for="company_name" class="form-label">Company name</label>
                <input wire:model="company_name" type="text" class="form-control" id="company_name">
                @error('company_name')
                <div style="color: red;">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="col-md-6">
                <label for="website" class="form-label">Company website (if available)</label>
                <input wire:model="website" type="text" class="form-control" id="website">
                @error('website')
                <div style="color: red;">
                    {{ $message }}
                </div>
                @enderror
            </div>
        </div>
        <!-- /OVERDRAFT UNSECURED COMPANY DETAILS-->

        @else
        <div class="row">
            <div class="col-md-12 col-lg-6">
                <label for="company_name" class="form-label">Please provide either parent company name
                    or
                    its ticker number followed by which stock exchange</label>
                <input wire:model="company_name" type="text" class="form-control" id="company_name">
                @error('company_name')
                <div style="color: red;">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="col-md-12 col-lg-6">
                <p style="margin-bottom: 20px;"><label for="company_name" class="form-label">Select
                        country</label></p>
                <div class="form-group">
                    <select wire:model="country" class="form-select" aria-label="Default select example">
                        <option value="" hidden>Select</option>
                        @foreach($countries as $country)
                        <option value="{{ $country }}">{{ $country }}</option>
                        @endforeach
                    </select>
                    @error('country')
                    <div style="color: red;">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4 mt-4">
                <livewire:widget.upload-component :label="'Subsidiary'" :apply_loan="$apply_loan"
                    :main_type="$main_type" :loan_type_id="$loan_type_id" :share_holder="$share_holder"
                    :modell="'App\Models\LoanCompanyDetail'" :keyvalue="'parent_company_subsidairy'" />
            </div>
        </div>
        @endif
    </div>
    <!-- SAVE & CONTINUE BUTTON -->
    <div class="ro {{ $share_holder == 0 ? 'text-end' : '' }}">
        <br>
        <button class="btn btn-custom" type="button" wire:target='confirmationMessage' wire:click.prevent='confirmationMessage'>
          <!--   <div wire:loading wire:target="confirmationMessage">
                <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
            </div> -->

            <div class="magnify-loader-background  d-none" wire:loading.longest wire:target="confirmationMessage" wire:loading.class.remove="d-none">
                 <div class="magnify-loader" >
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


            Save @if($share_holder == 0) & Continue @endif
        </button>
    </div>
    <!-- /SAVE & CONTINUE BUTTON -->
    <script>
        window.addEventListener('name-updated', event => {
            Swal.fire({
                title: event.detail.newName,
                showDenyButton: true,
                showCancelButton: true,
                confirmButtonText: 'Update',
            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.value) {
                    // calling destroy method to delete
                    @this.call('shareholderDelete')
                    // success response

                } else {

                }
            })
        })

    </script>
    <script>
        window.addEventListener('confirmation', event => {
            Swal.fire({
                title: event.detail.message,
                showDenyButton: true,
                showCancelButton: true,
                confirmButtonText: 'Update',
            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.value) {
                    // calling destroy method to delete
                    @this.call(event.detail.function)
                    // success response

                } else {

                }
            })
        })

    </script>
</section>
