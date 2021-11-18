<section>
    @if(!$listed_company_check)
    <div class="row">
        <div class="row">
            <b>6 months latest bank statement</b>
            <p>If It’s on or Over The 8th Of The Current Month For Example 8th Jan, You Would
                Need To
                Submit
                from Dec And Not Nov As The Latest Months. For companies less than 6 months old
                or
                unprofitable do check out our FAQ here.</p>
        </div>
        <!-- /COMPANY DOCUMENTS__TOPCONTENT -->

        <!-- COMPANY DOCUMENTS__FILE FEILD -->
        <div class="row mt-3">
            @for ($x = 1; $x < 8; $x++) <div class="col-md-6 col-lg-4 mb-3">
                @php $montName = date("M", strtotime( date( 'Y-m-01' )." -$x months")) @endphp

                <livewire:widget.upload-component :label="$montName" :keyvalue="$montName" :key="$montName"
                    :getImages="$images" :apply_loan="$apply_loan" :main_type="$main_type" :loan_type_id="$loan_type_id"
                    :share_holder="$share_holder" :modell="'App\Models\LoanStatement'" />
        </div>
        @endfor
    </div>
    <!-- /COMPANY DOCUMENTS__FILE FEILD -->

    <!-- COMPANY DOCUMENTS__Consolidated Statement -->
    <div class="row">
        <p><b>OR</b></p>
        <p><b>Consolidated Statement.</b></p>
        <p>If Your Statement Is Not Spilt Between Months But One</p>
    </div>

    <div class="row">
        <div class="col-md-4">
            <livewire:widget.upload-component :label="''" :apply_loan="$apply_loan" :main_type="$main_type"
                :loan_type_id="$loan_type_id" :share_holder="0" :modell="'App\Models\LoanCompanyDetail'"
                :keyvalue="'parent_company_combine_statement'" />
        </div>
    </div>
    <!-- /COMPANY DOCUMENTS__Consolidated Statement -->
    <hr class="mt-3">

    <!-- COMPANY DOCUMENTS__LATEST YEAR -->
    <div class="row">
        <p> <b>Latest 2 Years Financial
                Statement</b></p>
        <p>
            (Income Statement also known as Profit & Loss
            + Statement of financial position also known as Balance Sheet)
        </p>
    </div>

    <div class="row mt-2">
        <div class="col-md-4">
            <livewire:widget.upload-component :label="'Latest year'" :apply_loan="$apply_loan" :main_type="$main_type"
                :loan_type_id="$loan_type_id" :share_holder="0" :modell="'App\Models\LoanCompanyDetail'"
                :keyvalue="'parent_company_latest_year_statement'" />
        </div>
        {{-- @if($getNumberOfCompanyYears >= 3) --}}
        <div class="col-md-4">
            <livewire:widget.upload-component :label="'Before year'" :apply_loan="$apply_loan" :main_type="$main_type"
                :loan_type_id="$loan_type_id" :share_holder="0" :modell="'App\Models\LoanCompanyDetail'"
                :keyvalue="'parent_company_before_year_statement'" />

        </div>
        {{-- @endif --}}
    </div>
    <!-- /COMPANY DOCUMENTS__LATEST YEAR -->
    <hr class="mt-3">

    <!-- COMPANY DOCUMENTS__PROFITABLE -->
    <div class="row mt-2">
        <div class="col-md-4">
            <p> <b>Profitable for the last 2 accounting years</b></p>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label>Before Years</label>
                <select wire:model="profitable_latest_year" class="form-select" aria-label="Default select example">
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
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label>After Years</label>
                <select wire:model="profitable_before_year" class="form-select" aria-label="Default select example">
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
    </div>
    <!-- /COMPANY DOCUMENTS__PROFITABLE -->
    <hr class="mt-3">

    <!-- COMPANY DOCUMENTS__OPTIONOL INFO -->
    <div class="row">
        <P class="text-muted"><b>Optional info</b></P>
    </div>

    <div class="row">
        <p><b>Current Year</b></p>
        <p>If you are <b>more than 3-6 months into your current accounting year,</b> and if your
            management account(drafts/unaudited) pulls up the average, providing them may be
            helpful
        </p>
    </div>

    <div class="row">
        <div class="col-md-4">
            <livewire:widget.upload-component :label="''" :apply_loan="$apply_loan" :main_type="$main_type"
                :loan_type_id="$loan_type_id" :share_holder="0" :modell="'App\Models\LoanCompanyDetail'"
                :keyvalue="'parent_company_current_year_statement'" />
        </div>
    </div>
    <!-- /COMPANY DOCUMENTS__OPTIONOL INFO -->

    <!-- COMPANY DOCUMENTS__REVENUE -->
    <div class="row mt-3">
        <b>Revenue (rounded up is fine)</b>
    </div>

    <div class="row mt-3">
        <div class="col-md-4">
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
    <!-- /COMPANY DOCUMENTS__REVENUE -->
    <hr class="mt-3">


    <div class="ro text-end">
        <br>
        <button class="btn" type="button" wire:target='saveCompanyDocuments' wire:click.prevent='saveCompanyDocuments'>
            <span wire:loading wire:target="saveCompanyDocuments" class="spinner-border spinner-border-sm" role="status"
                aria-hidden="true"></span>
            Save & Continue
        </button>
    </div>
    </div>
    @endif
</section>
