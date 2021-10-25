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
            @error("name_of_policy_owner")
            <div style="color: red;">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="col-md-6" style="margin-top: 30px;">
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
        
        <div class="col-md-2" style="margin-top: 40px;">
            <br>
            <div class="form-check form-switch">
                <input wire:model="above" class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                <label class="form-check-label" for="flexSwitchCheckDefault">Same as above
                </label>
            </div>
        </div>
        <div class="col-md-4" style="margin-top: 30px;">
            <label for="surrender_value" class="form-label">
                Surrender Value $
            </label>
            <input wire:model="surrender_value" type="text" class="form-control" id="surrender_value">
            @error("surrender_value")
            <div style="color: red;">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="col-md-6" style="margin-top: 30px;">
            <livewire:widget.currency/>
        </div>
        <div class="col-md-12">
            <br>
            <br>
            <div class="form-check form-switch">
                <input wire:model="float_rate" class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                <label class="form-check-label" for="flexSwitchCheckDefault"> Check offer for floating rate
                </label>
            </div>
            @error("float_rate")
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
            <livewire:widget.upload-component :label="'Tenancy Agreement If it’s rented out'" :apply_loan="$apply_loan"
                :main_type="$main_type" :loan_type_id="$loan_type_id" :share_holder="0"
                :modell="'\App\Models\OverDraftPropertyLand'" :keyvalue="'over_draft_tanancy_agreement'" />
        </div>
        <div class="col-md-12">
            <br>
            <br>
            If it is under financing, the Financing Partners may require you to refinance with them(not to worry they
            will
            provide you with the refinancing rate for consideration.)
        </div>
        <div class="col-md-12">
            <hr>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <br>
            <br>
            <button class="btn" wire:click="store">Add Property</button>
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
                        <th scope="col">Address</th>
                        <th scope="col">Lease remaining</th>
                        <th scope="col">FreeHold</th>
                        <th scope="col">Build-in/Useable Area</th>
                        <th scope="col">Meter</th>
                        <th scope="col">Document</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($propertyLands as $item)
                    <tr>
                        <th scope="row">1</th>
                        <td>{{ $item->address }}</td>
                        <td>{{ $item->lease_remaining_year }}</td>
                        <td>{{ $item->free_hold }}</td>
                        <td>{{ $item->useable_area }}</td>
                        <td>
                            @if($item->square_feet)
                            {{ $item->square_feet }}
                            @else
                            {{ $item->useable_area }}
                            @endif
                        </td>
                        <td><button class="btn">View Docuemts</button></td>
                        <td><button wire:click="deleteRecord({{ $item->id }})" style="background: red;"
                                class="btn">Delete</button></td>
                    </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>

</section>
