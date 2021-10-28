<section>
    <div class="row">
        <div class="col-md-6">
            <label for="amount" class="form-label">
                Amount
            </label>
            <input wire:model="amount" type="number" class="form-control" id="amount">
            @error("amount")
            <div style="color: red;">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="col-md-6"></div>
        
        <div class="col-md-3">
            <br>
            <div class="form-check form-switch">
                <input @if($amount <=0) disabled @endif wire:change="changeType()" wire:model="overdraft.unsecured"
                    class="form-check-input" type="checkbox" id="flexSwitchCheckDefau2">
                <label class="form-check-label" for="flexSwitchCheckDefau2">Unsecured
                </label>
            </div>
        </div>
        <div class="col-md-3">
            <br>
            <div class="form-check form-switch">
                <input @if($amount <=0) disabled @endif wire:change="changeType()" wire:model="overdraft.secure"
                    class="form-check-input" type="checkbox" id="flexSwitchCheckDef3">
                <label class="form-check-label" for="flexSwitchCheckDef3">Secured
                </label>
            </div>
        </div>
        
        <div class="col-md-12">
            <hr>
        </div>
    </div>
    @if(isset($overdraft['secure']) && $overdraft['secure'])
    <div class="row">
        <div class="col-md-12">
            <ul class="nav nav-pills">
                <li class="nav-item">
                    <a style="padding: 0px 15px 0px 15px;border-radius: 0px;font-size: 10px;"
                        wire:click="$set('tab', '9')" style="padding: .1rem 1rem;"
                        class="nav-link {{ $tab=='9' ? 'active' : '' }}" aria-current="page" href="#">TYPE</a>
                </li>
                @if(isset($overdraft['security_type']) && sizeof($overdraft['security_type']))
                @foreach($overdraft['security_type'] as $key => $item)
                @if($key == true)
                <li class="nav-item">
                    <a style="padding: 0px 15px 0px 15px;border-radius: 0px;font-size: 10px;"
                        wire:click="ChnageTab({{ $key }})" style="padding: .1rem 1rem;"
                        class="nav-link {{ $tab==$key ? 'active' : '' }}" aria-current="page" href="#">
                        @if($key==1)
                        Insurance
                        @elseif($key==2)
                        Unit Trust/Funds
                        @elseif($key==3)
                        Stocks
                        @elseif($key==4)
                        Bonds
                        @elseif($key==5)
                        Deposit
                        @elseif($key==8)
                        Fixed Deposit
                        @elseif($key==6)
                        Structured Deposit
                        @elseif($key==7)
                        Property

                        @endif
                    </a>
                </li>
                @endif
                @endforeach
                @endif
            </ul>
        </div>
    </div>
    @if($tab == 9)
    <div class="row">
        <div class="col-md-3" style="margin-top: 30px;">
            <div class="form-check form-switch">
                <input wire:model="overdraft.security_type.1" wire:change="removeIndexInSecurityType(1)"
                    class="form-check-input" type="checkbox" id="flexSwitchCheckDefault1">
                <label class="form-check-label" for="flexSwitchCheckDefault1">Insurance
                </label>
            </div>
        </div>
        <div class="col-md-3" style="margin-top: 30px;">
            <div class="form-check form-switch">
                <input wire:model="overdraft.security_type.2" wire:change="removeIndexInSecurityType(2)"
                    class="form-check-input" type="checkbox" id="flexSwitchCheckDefault2">
                <label class="form-check-label" for="flexSwitchCheckDefault2">Unit Trust/Funds
                </label>
            </div>
        </div>
        <div class="col-md-3" style="margin-top: 30px;">
            <div class="form-check form-switch">
                <input wire:model="overdraft.security_type.3" wire:change="removeIndexInSecurityType(3)"
                    class="form-check-input" type="checkbox" id="flexSwitchCheckDefaul3">
                <label class="form-check-label" for="flexSwitchCheckDefaul3">Stocks
                </label>
            </div>
        </div>
        <div class="col-md-3" style="margin-top: 30px;">
            <div class="form-check form-switch">
                <input wire:model="overdraft.security_type.4" wire:change="removeIndexInSecurityType(4)"
                    class="form-check-input" type="checkbox" id="flexSwitchCheckDefault4">
                <label class="form-check-label" for="flexSwitchCheckDefault4">Bonds
                </label>
            </div>
        </div>
        <div class="col-md-3" style="margin-top: 30px;">
            <div class="form-check form-switch">
                <input wire:model="overdraft.security_type.5" wire:change="removeIndexInSecurityType(5)"
                    class="form-check-input" type="checkbox" id="flexSwitchCheckDefault5">
                <label class="form-check-label" for="flexSwitchCheckDefault5">Deposit
                </label>
            </div>
        </div>
        <div class="col-md-3" style="margin-top: 30px;">
            <div class="form-check form-switch">
                <input wire:model="overdraft.security_type.8" wire:change="removeIndexInSecurityType(8)"
                    class="form-check-input" type="checkbox" id="flexSwitchCheckDefault8">
                <label class="form-check-label" for="flexSwitchCheckDefault8">Fixed Deposit

                </label>
            </div>
        </div>
        <div class="col-md-3" style="margin-top: 30px;">
            <div class="form-check form-switch">
                <input wire:model="overdraft.security_type.6" class="form-check-input"
                    wire:change="removeIndexInSecurityType(6)" type="checkbox" id="flexSwitchCheckDefault6">
                <label class="form-check-label" for="flexSwitchCheckDefault6">Structured Deposit
                </label>
            </div>
        </div>
        <div class="col-md-3" style="margin-top: 30px;">
            <div class="form-check form-switch">
                <input wire:model="overdraft.security_type.7" wire:change="removeIndexInSecurityType(7)"
                    class="form-check-input" type="checkbox" id="flexSwitchCheckDefault7">
                <label class="form-check-label" for="flexSwitchCheckDefault7">Property

                </label>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <br>
            <br>
            <button class="btn" type="button" wire:target="store" wire:click.prevent="store">
                <span wire:loading="" wire:target="store" class="spinner-border spinner-border-sm" role="status"
                    aria-hidden="true"></span>
                Next
            </button>
        </div>
    </div>
    @elseif($tab == 7)
    <div class="row">
        <div class="col-md-12">
            <livewire:cms.loan.business.loan-type.over-draft.property-land :loan_type_id="$loan_type_id"
                :main_type="$main_type" :apply_loan="$apply_loan" :amount="$amount" :loan_type_id="$loan_type_id">
        </div>

    </div>
    @elseif($tab == 1)
    <div class="row">
        <div class="col-md-12">
            <livewire:cms.loan.business.loan-type.over-draft.insurance :loan_type_id="$loan_type_id"
                :main_type="$main_type" :apply_loan="$apply_loan" :amount="$amount" :loan_type_id="$loan_type_id">
        </div>

    </div>
    @elseif($tab == 5)
    <div class="row">
        <div class="col-md-12">
            <livewire:cms.loan.business.loan-type.over-draft.deposit :loan_type_id="$loan_type_id"
                :main_type="$main_type" :apply_loan="$apply_loan" :amount="$amount" :loan_type_id="$loan_type_id"
                :tab="$tab">
        </div>
    </div>
    @elseif($tab == 8)
    <div class="row">
        <div class="col-md-12">
            <livewire:cms.loan.business.loan-type.over-draft.deposit :loan_type_id="$loan_type_id"
                :main_type="$main_type" :apply_loan="$apply_loan" :amount="$amount" :loan_type_id="$loan_type_id"
                :tab="$tab">
        </div>
    </div>
    @elseif($tab == 6)
    <div class="row">
        <div class="col-md-12">
            <livewire:cms.loan.business.loan-type.over-draft.deposit :loan_type_id="$loan_type_id"
                :main_type="$main_type" :apply_loan="$apply_loan" :amount="$amount" :loan_type_id="$loan_type_id"
                :tab="$tab">
        </div>
    </div>
    @elseif($tab == 2)
    <div class="row">
        <div class="col-md-12">
            <livewire:cms.loan.business.loan-type.over-draft.trust-fund :loan_type_id="$loan_type_id"
                :main_type="$main_type" :apply_loan="$apply_loan" :amount="$amount" :loan_type_id="$loan_type_id"
                :tab="$tab"
                :security_type="$overdraft['security_type']"
                >
        </div>
    </div>
    @elseif($tab == 3)
    <div class="row">
        <div class="col-md-12">
            <livewire:cms.loan.business.loan-type.over-draft.stock-bond :loan_type_id="$loan_type_id"
                :main_type="$main_type" :apply_loan="$apply_loan" :amount="$amount" :loan_type_id="$loan_type_id"
                :tab="$tab">
        </div>
    </div>
    @elseif($tab == 4)
    <div class="row">
        <div class="col-md-12">
            <livewire:cms.loan.business.loan-type.over-draft.stock-bond :loan_type_id="$loan_type_id"
                :main_type="$main_type" :apply_loan="$apply_loan" :amount="$amount" :loan_type_id="$loan_type_id"
                :tab="$tab">
        </div>
    </div>
    @endif
    @endif
    <div class="row">
        <div class="col-md-12 text-end">
            <br>
            @if($enableButtons == false)
            <button   wire:click="tabChange()" class="btn">Save & Continue</button>
            @endif
        </div>
    </div>
</section>