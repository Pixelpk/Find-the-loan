<section>

    <div class="row">
        <div class="col-md-6" style="margin-top: 30px;">
            <label for="insurance" class="form-label">Name of insured
            </label>
            <input wire:model="insurance" type="text" class="form-control" id="insurance">
            @error("insurance")
            <div style="color: red;">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="col-md-6" style="margin-top: 30px;">
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
        <div class="col-md-6" style="margin-top: 30px;">
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

        <div class="col-md-6" style="margin-top: 30px;">
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
        <div class="col-md-6">
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
        
        
        <div class="col-md-6">
            <label for="surrender_value" class="form-label">
                Surrender Value $
            </label>
            <input wire:model="surrender_value" type="number" class="form-control" id="surrender_value">
            <span>
                Download from your insurer’s website or check with your advisor for a updated copy. The latest surrender value can be found on it.
            </span>
            @error("surrender_value")
            <div style="color: red;">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="col-md-6">
            <livewire:widget.currency/>
            @error("currency")
            <div style="color: red;">
                {{ $message }}
            </div>
            @enderror
        </div>
       
    </div>
    <div class="row">
        <div class="col-md-12">
            <br>
            <br>
            <livewire:widget.upload-component 
                :label="'Or upload your Benefit illustration'" 
                :apply_loan="$apply_loan"
                :main_type="$main_type" 
                :loan_type_id="$loan_type_id" 
                :share_holder="0"
                :modell="'\App\Models\OverDraftInsurance'" 
                :keyvalue="'over_draft_benifit_illustration'" 
            />
        </div>
        
        <div class="col-md-12">
            <hr>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <br>
            <br>
            <button class="btn" wire:click="store">Add Another Policy</button>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <br>
            <br>
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

</section>
