<section>
    @php $NFL = [1,2,3,4]
    @endphp

    <!-- LENDERS -->
    <div class="row mb-4 text-center">
        <p class="lead fw-bold">Select Lenders</p>
        <p>The following lenders offer the loan type you chose, factoring the information you have
            entered.</p>
        <p>Please select which of our following Financing Partners you wish to send your enquiry to.</p>
    </div>

    <div class="row mb-3">
        <div class="col-md-6">
            <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked">
                <label class="form-check-label" for="flexSwitchCheckChecked">Show only CBS
                    members</label>
            </div>
        </div>
        <div class="col-md-6">
            <div class="cbc">
                <p><b>CBS</b>(Downloaded Within The Last 30 days)</p>
                <input type="file" class="mt-2 form-control">
            </div>
        </div>
    </div>
    @foreach($NFL as $item)
    <div class="row mb-3">
        <div class="card px-0">
            <div class="card-header d-flex justify-content-between py-2">
                @if($item == 1)
                <p class="mb-0">Bank</p>
                @elseif($item == 2)
                <p class="mb-0">Excluded Moneylender</p>

                @else
                <p class="mb-0">Moneylender</p>


                @endif
                <div class="form-check">

                    <input class="form-check-input" type="checkbox" value="" id="flexCheckIndeterminate1">
                    <label class="form-check-label" for="flexCheckIndeterminate1">
                        Select All
                    </label>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    @foreach($financePartners as $financePartner)
                    @if($financePartner->type == 1 && $item == 1)
                    <div class="col-md-6 col-lg-3">
                        <div class="lender-bank d-flex justify-content-between align-items-center px-3 py-2">
                            <div class="lender-bank__img">
                                <img for="{{ $financePartner->id }}"
                                    src="{{ asset('uploads/financePartnerImages/'.$financePartner->image) }}" alt=""
                                    width="80px" height="25px">
                            </div>
                            <input wire:model="lender.{{ $financePartner->id }}" wire:change="Selectall({{ $item }})"
                                type="checkbox" id="{{ $financePartner->id }}">
                        </div>
                    </div>


                    @endif
                    @endforeach

                </div>
            </div>
        </div>
    </div>
    @endforeach

    <div class="row mb-3 mt-2">
        <div class="form-check">
            <input class="form-check-input" type="checkbox" value="" id="flexCheckIndeterminate">
            <label class="form-check-label" for="flexCheckIndeterminate">
                I/we agree the information I/we provided is true to the best of my knowledge and I/we
                give consent to these Financing Partners to verify them and those that are CBS members
                to access my credit report/s instead of furnishing it myself. I/we \also agree to
                FindTheLoan.com’s Privacy Policy, Terms of use and any related policies.
            </label>
        </div>
    </div>

    <div class="text-center">
        <button class="btn" wire:click="storeLender">Send Enquiry</button>
    </div>

    <div class="row mt-3 d-flex">

        <p><span class="text-danger">Note:</span> While the lenders above may offer your loan type, it
            doesn’t not necessarily mean they may offer a loan to you, depending on factors such as your
            risk profile, their monthly limited to a certain risk bracket etc. It is generally better to
            check with more lenders to compare with.</p>

    </div>
</section>
