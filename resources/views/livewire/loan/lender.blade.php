@if($thank_you_message)
    <section style="margin: 125px 0px;">
        <div class="row">
            <div class="col-md-6 offset-md-3 text-center">
                <span class="text-center" style="font-size: 70px;font-weight: 700;color: #3ebb60;">Thank You! </span> 

                <br>

                <p class="text-center mt-5" style="font-size: 18px;">
                    Now just sit back and give the Financing Partners a couple of moments to look through your documents and make their offers on your dashboard – we’ll email you when an offer has been made.
                </p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 offset-md-3 text-center"><b class="text-center"></b></div>
        </div>
        <div class="row mt-5">
            <div class="col-md-4 offset-md-4 text-center">
                <a href="{{ route('home') }}" class="btnnew2 btn">Return To Home </a> 
                 <a href="{{ route('customer-dashboard') }}" class="btnnew2 btn">Dashboard</a>
            </div>
        </div>
    </section>
@else
<section>
    @php $NFL = [1,2,3]
    @endphp

    <!-- LENDERS -->
    <div class="row mb-4">
        <p class="lead fw-bold">Select Financing Partners</p>
        <p style="color:grey;font-size:13px;">The following lenders offer the loan type you chose, factoring the information you have
            entered.
            <br>
            Please select which of our following Financing Partners you wish to send your enquiry to.
        </p>

    </div>

    <div class="row mt-3 d-flex">

        <p style="color:grey;font-size:12px;"><span class="text-danger">Note:</span> While the lenders above may offer your loan type, it
            doesn’t not necessarily mean they may offer a loan to you, depending on factors such as your
            risk profile, their monthly limited to a certain risk bracket etc. It is generally better to
            check with more lenders to compare with.</p>

    </div>

    <div class="row mb-3">
        <div class="col-md-6">
            <div class="form-check form-switch">
                <input class="form-check-input" wire:model="cbs_member" wire:change="getFinancePartner()" type="checkbox" id="flexSwitchCheckChecked234">
                <label class="form-check-label" for="flexSwitchCheckChecked234">Show only CBS
                    members</label>
            </div>
        </div>
        @if($cbs_member)
        <div class="col-md-6">
            <div class="cbc">
                <p><b>CBS</b>(Downloaded Within The Last 30 days)</p>
                <input type="file" wire:model="cbs_member_image" class="mt-2 form-control">
                @error('cbs_member_image')
                   <span style="color:red;">Field is required</span>
                @enderror
            </div>
        </div>
        @endif
    </div>
    @foreach($NFL as $item)
    <div class="row mb-3">
        <div class="card px-0">
            <div class="card-header d-flex justify-content-between py-2">
                @if($item == 1)
                <p class="mb-0">Bank</p>
                @elseif($item == 2)
                <p class="mb-0">Excluded Moneylender</p>
                @elseif($item == 3)
                <p class="mb-0">Moneylender</p>

                @endif
                <div class="form-check">
                    <input wire:model="selectall.{{ $item }}" wire:change="Selectall({{ $item }})" class="form-check-input" type="checkbox" value="" id="{{ $item }}">
                    <label class="form-check-label" for="{{ $item}}">
                        Select All
                    </label>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    @foreach($financePartners as $financePartner)
                    @if($financePartner->type == 1 && $item == 1)
                    <div class="col-md-6 col-lg-2">
                        <div class="lender-bank d-flex justify-content-between align-items-center px-3 py-3">
                            <div class="lender-bank__img">
                                <img for="{{ $financePartner->id }}"
                                    src="{{ asset('uploads/financePartnerImages/'.$financePartner->image) }}" alt=""
                                    width="120px" height="45px">
                            </div>
                            <input wire:model="lender.{{ $financePartner->id }}"  type="checkbox" id="{{ $financePartner->id }}">
                        </div>
                    </div>
                    @elseif($financePartner->type == 2 && $item == 2)
                    <div class="col-md-6 col-lg-2">
                        <div class="lender-bank d-flex justify-content-between align-items-center px-3 py-3">
                            <div class="lender-bank__img">
                                <img for="{{ $financePartner->id }}"
                                    src="{{ asset('uploads/financePartnerImages/'.$financePartner->image) }}" alt=""
                                    width="120px" height="45px">
                            </div>
                            <input wire:model="lender.{{ $financePartner->id }}"  type="checkbox" id="{{ $financePartner->id }}">
                        </div>
                    </div>
                    @endif
                    @endforeach

                </div>
            </div>
        </div>
    </div>
    @endforeach

    <div class="row mb-3 mt-2 p-2" style="border: 1px solid;">
        <div class="form-check">
            <input wire:model="policy" class="form-check-input" type="checkbox" value="" id="flexCheckIndeterminate">
            <label class="form-check-label" for="flexCheckIndeterminate" style="">
                I/we agree the information. I/we provided is true to the best of my knowledge and I/we give consent to these Financing Partners to verify them and those that are CBS members to access my credit reports instead of furnishing them myself/ourselves. I/we also agree to <a href="{{ url('') }}">FindTheLoan.com</a>’s <a href="{{ url('privacy-policy') }}">Privacy Policy</a>, Terms of use and any related policies.
            </label>
        </div>

        <div class="pt-2 pl-2">
            @error('policy')
                <span style="color:red;">Please, Accept this agreement, So we wil further procedd the application.</span>
            @enderror
        </div>
    </div>

    <div class="text-end">
        <button class="btn btn-custom" wire:click="storeLender">Send Enquiry</button>
    </div>

</section>
@endif
<style type="text/css">
    .swal2-popup{
        padding: 2em 3em !important;
    }

    .swal2-styled.swal2-confirm{
        background-color: #3EBB60 !important;
    }
</style>

 <script>
        window.addEventListener('enquiry_submit', event => {
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
