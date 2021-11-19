<section>
    @php $NFL = [1,2,3]
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
                <input class="form-check-input" wire:model="cbs_member" wire:change="getFinancePartner()" type="checkbox" id="flexSwitchCheckChecked234">
                <label class="form-check-label" for="flexSwitchCheckChecked234">Show only CBS
                    members</label>
            </div>
        </div>
        @if($cbs_member)
        <div class="col-md-6">
            <div class="cbc">
                <p><b>CBS</b>(Downloaded Within The Last 30 days)</p>
                <input type="file" class="mt-2 form-control">
                @error('cbs_member_image')
                   <span style="color:red;">Filed is required</span>
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
                    <div class="col-md-6 col-lg-3">
                        <div class="lender-bank d-flex justify-content-between align-items-center px-3 py-2">
                            <div class="lender-bank__img">
                                <img for="{{ $financePartner->id }}"
                                    src="{{ asset('uploads/financePartnerImages/'.$financePartner->image) }}" alt=""
                                    width="120px" height="45px">
                            </div>
                            <input wire:model="lender.{{ $financePartner->id }}"  type="checkbox" id="{{ $financePartner->id }}">
                        </div>
                    </div>
                    @elseif($financePartner->type == 2 && $item == 2)
                    <div class="col-md-6 col-lg-3">
                        <div class="lender-bank d-flex justify-content-between align-items-center px-3 py-2">
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

    <div class="row mb-3 mt-2">
        <div class="form-check">
            <input wire:model="policy" class="form-check-input" type="checkbox" value="" id="flexCheckIndeterminate">
            <label class="form-check-label" for="flexCheckIndeterminate" style="{{ $policy ? '' : 'color:red;' }}">
                I/we agree the information. I/we provided is true to the best of my knowledge and I/we
                give consent to these Financing Partners to verify them and those that are CBS members
                to access my credit reports instead of furnishing it myself. I/we also agree to
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
