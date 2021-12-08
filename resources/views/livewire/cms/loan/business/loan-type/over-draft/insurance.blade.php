<section>

    <div class="row mt-4">
        <div class="col-md-4">
       <div class="mb-3">
        <label for="insurance" class="form-label">Name of insured
        </label>
        <input wire:model="insurance" type="text" class="form-control" id="insurance">
        @error("insurance")
        <div style="color: red;">
            {{ $message }}
        </div>
        @enderror
       </div>
        </div>
        <div class="col-md-4">
        <div class="mb-3">
            <label for="type_of_policy" class="form-label">Type of policy
            </label>
            <select class="form-select" wire:model="type_of_policy">
                <option value="">Select</option>
                <option value="1">Whole life</option>
                <option value="2">Endowment/Savings</option>
                <option value="3">Universal Life</option>
            </select>
            @error("type_of_policy")
            <div style="color: red;">
                {{ $message }}
            </div>
            @enderror
        </div>
        </div>
        <div class="col-md-4">
           <div class="mb-3">
            <label for="lease_remaining" class="form-label">
                Policy start date
            </label>
            <div class="input-group mb-3">
                <input wire:model="policy_start_date" type="date" class="form-control" aria-label="Recipient's username"
                    aria-describedby="basic-addon2">
                <div class="input-group-append">
                    <span class="input-group-text" id="basic-addon2">Date</span>
                </div>
            </div>
            @error("policy_start_date")
            <div style="color: red;">
                {{ $message }}
            </div>
            @enderror
           </div>
        </div>
    </div>

    <div class="row mt-2">
        <div class="col-md-3">
           <div class="mb-3">
            <label for="name_of_policy_owner" class="form-label">
                Name of policyowner
            </label>
            <input wire:model="name_of_policy_owner" type="text" class="form-control" id="name_of_policy_owner">
            <span>
                <div class="form-check form-switch">
                    <input wire:model="above" wire:change="getSameName()" class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                    <label class="form-check-label" for="flexSwitchCheckDefault">Same as above
                    </label>
                </div>
            </span>
            @error("name_of_policy_owner")
            <div style="color: red;">
                {{ $message }}
            </div>
            @enderror
           </div>
        </div>
        <div class="col-md-3">
           <div class="mb-3">
            <label for="insurer" class="form-label">
                Insurer
            </label>
            <input wire:model="insurer" type="text" class="form-control" id="insurer">
            @error("insurer")
            <div style="color: red;">
                {{ $message }}
            </div>
            @enderror
           </div>
        </div>
        <div class="col-md-3">
          <div class="mb-3">
            <livewire:widget.currency/>
            @error("currency")
            <div style="color: red;">
                {{ $message }}
            </div>
            @enderror
          </div>
        </div>
        <div class="col-md-3">
            <div class="mb-3">
             <label for="bank" class="form-label">Company purchased from
             </label>
             <select class="form-select" wire:model="company_purchased_from">
                 <option value="">Select Bank</option>
                 <optgroup label="Local Banks">
                     @foreach(Config::get('gernalinfo.bank.local_bank') as $item)
                     <option value="{{ $item }}">{{ $item }}</option>
                     @endforeach
                 </optgroup>
                 <optgroup label="Local/Foreign Banks">
                     @foreach(Config::get('gernalinfo.bank.foreign_bank') as $item)
                     <option value="{{ $item }}">{{ $item }}</option>
                     @endforeach
                 </optgroup>
                 <optgroup label="Other Bank">
                     <option value="other">Other</option>
                 </optgroup>
             </select>
             @error("bank")
             <div style="color: red;">
                 {{ $message }}
             </div>
             @enderror
            </div>
         </div>
    </div>

    <div class="row mt-3">
        <div class="col-md-5">
          <div class="mb-3">
            <label for="surrender_value" class="form-label">
                Surrender Value $
            </label>
            <input wire:model="surrender_value" type="number" class="form-control" id="surrender_value">
           <p>  Download from your insurer’s website or check with your advisor for a updated copy. The latest surrender value can be found on it.</p>
            @error("surrender_value")
            <div style="color: red;">
                {{ $message }}
            </div>
            @enderror
          </div>
        </div>
        <div class="col-md-2 d-flex justify-content-center align-items-center">
            <h5 class="pb-5">Or</h5>
        </div>
        <div class="col-md-5">
           <div class="mb-3">
            <livewire:widget.upload-component 
            :label="'Upload your benefit illustration'" 
            :apply_loan="$apply_loan"
            :main_type="$main_type" 
            :loan_type_id="$loan_type_id" 
            :share_holder="0"
            :modell="'App\Models\OverDraftInsurance'" 
            :keyvalue="'over_draft_benifit_illustration'" 
        />
           </div>
        </div>
    </div>

    <div class="row mt-3">
        <div class="col-md-12">
            <button class="btn" wire:click="store">Add @if(sizeof($insurances) > 0) Another @endif Policy</button>
        </div>
    </div>

<hr class="mt-4 mb-0">

    <div class="row mt-3">
        <div class="col-md-12">
          <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Insured Name</th>
                        <th scope="col">Type of policy</th>
                        <th scope="col">Policy start date</th>
                        <th scope="col">Name of Policy Owner</th>
                        <th scope="col">Insurer</th>
                        <th scope="col">Surrender Value</th>
                        <th scope="col">Currency</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($insurances as $item)
                    <tr>
                        <th scope="row">1</th>
                        <td>{{ $item->insurance }}</td>
                        <td>
                            @if($item->type_of_policy == 1)
                            Whole life
                            @elseif($item->type_of_policy == 2)
                            Endowment/Savings
                            @elseif($item->type_of_policy == 3)
                            Universal Life
                            @endif
                        </td>
                        <td>{{ $item->policy_start_date }}</td>
                        <td>{{ $item->name_of_policy_owner }}</td>
                        <td>
                           {{ $item->insurer }}
                        </td>
                        <td>{{ $item->surrender_value }}</td>
                       
                        <td>{{ $item->currency }}</td>
                      
                        <td><button wire:click="deleteRecord({{ $item->id }})" style="background: red;"
                                class="btn">Delete</button></td>
                    </tr>
                    @endforeach

                </tbody>
            </table>
          </div>
           
        </div>
    </div>

</section>
