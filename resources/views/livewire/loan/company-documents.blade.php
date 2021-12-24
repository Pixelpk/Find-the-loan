<section>
    @if(!$listed_company_check)
    <div class="row">
        <div class="row mt-4">

            <b>

                6 months latest bank statement</b>
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
         <!--  <p><b>Consolidated Statement.</b></p> -->
        <p class="mb-0">If Your Statement Is Not Spilt Between Months But One <b>Consolidated Statement.</b></p>
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
    @if($share_holder > 0)
    <div class="row mt-3">
        <div class="col-md-3 mt-3">
            <livewire:widget.upload-component :label="'M&AA/ company constitution or equivalent'" :apply_loan="$apply_loan"
                :main_type="$main_type" :loan_type_id="$loan_type_id" :share_holder="0"
                :modell="'App\Models\LoanCompanyDetail'" :keyvalue="'child_company_constitution_equivalent'" />
        </div>
        <div class="col-md-9 mt-3">
            <livewire:widget.upload-component :label="'Ultimate beneficial owner/ main director’s proof of identity at the top corporate level e.g there is another parent company'" :apply_loan="$apply_loan"
                :main_type="$main_type" :loan_type_id="$loan_type_id" :share_holder="0"
                :modell="'App\Models\LoanCompanyDetail'" :keyvalue="'child_company_ultimate_beneficial'" />
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-md-12 mt-3">
            <b>If the parent company is based overseas, please provide the following
            </b>
        </div>
        <div class="col-md-4 mt-3">
            <livewire:widget.upload-component :label="'Cert of incorporation'" :apply_loan="$apply_loan"
                :main_type="$main_type" :loan_type_id="$loan_type_id" :share_holder="0"
                :modell="'App\Models\LoanCompanyDetail'" :keyvalue="'company_documents_cert_of_incarpuration'" />
        </div>
        <div class="col-md-4 mt-3">
            <livewire:widget.upload-component :label="'Cert of incumbency'" :apply_loan="$apply_loan"
                :main_type="$main_type" :loan_type_id="$loan_type_id" :share_holder="0"
                :modell="'App\Models\LoanCompanyDetail'" :keyvalue="'company_documents_cert_of_incumbency'" />
        </div>
        <div class="col-md-4 mt-3">
           
            <label class="form-label">Country Incorporated</label>
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
    @endif
    <!-- /COMPANY DOCUMENTS__PROFITABLE -->
    <hr class="mt-3">

    <!-- COMPANY DOCUMENTS__OPTIONOL INFO -->
    <div class="row">
        <P class="text-muted"><b>Optional info</b></P>
    </div>

    <div class="row">
        {{-- <p><b>Current Year</b></p> --}}
        <p>If you are <b>more than 3-6 months into your current accounting year,</b> and if your
            management account(drafts/unaudited) pulls up the average, providing them may be
            helpful
        </p>
    </div>

    <div class="row mt-3">
        <div class="col-md-4">
            <livewire:widget.upload-component :label="'Curent Years'" :apply_loan="$apply_loan" :main_type="$main_type"
                :loan_type_id="$loan_type_id" :share_holder="0" :modell="'App\Models\LoanCompanyDetail'"
                :keyvalue="'parent_company_current_year_statement'" />
        </div>
        <div class="col-md-4">

            <div class="form-group">
                <label for="" class="form-label">Revenue (rounded up is fine)</label>
                <input type="number" class="form-control" wire:model="optional_revenuee">
                @error('optional_revenuee')
                <div style="color: red;">
                    {{ $message }}
                </div>
                @enderror
            </div>
        </div>
        @if($share_holder > 0)
        <div class="col-md-12 mt-3">
            For companies with multiple layers, please take note that many lenders especially banks or especially
                when going for the enterprise financing scheme, for compliance purposes, may require documents of all
                shareholders at all layers at signing the loan letter of offer. But to get a quote it may not be
                required if the borrowing company is deemed to have a strong repayment ability etc. You may however wish
                to still furnish them if you have them readily on hand instead of waiting for them to ask and delay your
                getting of a loan quote. Or especially if you have been rejected by a bank due to multiple layers, to do
                so, please attach the same range of documents you have just provided such as bank statements, NRIC, NOA
                etc for all shareholders at all layers with the choose file button below.
            
        </div>
        <div class="col-md-4">
            <livewire:widget.upload-component :label="''" :apply_loan="$apply_loan" :main_type="$main_type"
                :loan_type_id="$loan_type_id" :share_holder="0" :modell="'App\Models\LoanCompanyDetail'"
                :keyvalue="'parent_company_multiple_layer'" />
        </div>
        @endif
       
    </div>
    <!-- /COMPANY DOCUMENTS__OPTIONOL INFO -->

    <!-- COMPANY DOCUMENTS__REVENUE -->
    {{-- <div class="row mt-3">
        <b>Revenue (rounded up is fine)</b>
    </div> --}}

    <!-- /COMPANY DOCUMENTS__REVENUE -->
    <hr class="mt-3">


    <div class="ro {{ $share_holder == 0 ? 'text-end' : '' }}">
        <br>
        <button class="btn custom-info-btn" type="button" style="color: #6c6868 !important;">
           
                Why these documents ?
        </button>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <button class="btn btn-custom" type="button" wire:target='confirmationMessage' wire:click.prevent='confirmationMessage'>
            <span wire:loading wire:target="confirmationMessage" class="spinner-border spinner-border-sm" role="status"
                aria-hidden="true"></span>
            Save @if($share_holder == 0) & Continue @endif
        </button>
    </div>
    </div>
    @endif
</section>
<style type="text/css">
    .swal2-popup{
        padding: 2em 3em !important;
    }

    .swal2-styled.swal2-confirm{
        background-color: #3EBB60 !important;
    }
</style>
 <script>
        window.addEventListener('confirmation', event => {
            Swal.fire({
                text: event.detail.message,
                width: 750,
                showDenyButton: true,
                showCancelButton: false,
                confirmButtonText: 'Ok',
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