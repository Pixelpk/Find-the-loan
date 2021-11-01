<section>
    <div class="row">
        <div class="col-md-6">
            <br>
            <br>
            <livewire:widget.upload-component
                :label="'loan statement showing past 12 months prompt repayment history if any(please ensure address is visible, if not kindly include the main page where address is visible)'"
                :apply_loan="$apply_loan" :main_type="$main_type" :loan_type_id="$loan_type_id"
                :modell="'App\Models\OverDraftPropertyLand'" :keyvalue="'over_draft_past_twelve_month_statement'"
                :share_holder="0" />
        </div>
        <div class="col-md-6">
            <br>
            <br>
            <livewire:widget.upload-component
                :label="'Loan statement reflecting current Outstanding loan amount if it is not reflected in your repayment history statement'"
                :apply_loan="$apply_loan" :main_type="$main_type" :loan_type_id="$loan_type_id"
                :modell="'App\Models\OverDraftPropertyLand'" :keyvalue="'over_draft_current_loan_statement'"
                :share_holder="0" />
        </div>
        <div class="col-md-6">
            <br>
            <br>
            <livewire:widget.upload-component :label="'CPF property withdrawal/utilization statement If CPF was used'"
                :apply_loan="$apply_loan" :main_type="$main_type" :loan_type_id="$loan_type_id"
                :modell="'App\Models\OverDraftPropertyLand'" :keyvalue="'over_draft_cpf_statement'" :share_holder="0" />
        </div>
        <div class="col-md-6">
            <br>
            <br>
            <livewire:widget.upload-component :label="'Tenancy Agreement If it’s rented out'" :apply_loan="$apply_loan"
                :main_type="$main_type" :loan_type_id="$loan_type_id" :modell="'App\Models\OverDraftPropertyLand'"
                :keyvalue="'over_draft_tenancy_agreement'" :share_holder="0" />
        </div>
        <div class="col-md-12">
            <hr>
        </div>
    </div>
    <div class="row">
        <div wire:ignore.self class="col-md-12" style="margin-top: 30px;">


            <label for="address" class="form-label">Address</label>
            <input onkeyup="dddd()" wire:model.defer="address" type="text" class="form-control" id="ship-address1">
            @error("address")
            <div style="color: red;">
                {{ $message }}
            </div>
            @enderror
        </div>

        <div class="col-md-6" style="margin-top: 30px;">
            <label for="unit" class="form-label">Unit if any
            </label>
            <input wire:model="unit" type="text" class="form-control" id="unit">
            @error("unit")
            <div style="color: red;">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="col-md-6" style="margin-top: 30px;">
            <label for="building_name" class="form-label">Building name if any
            </label>
            <input wire:model="building_name" type="text" class="form-control" id="building_name">
            @error("building_name")
            <div style="color: red;">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="col-md-6" style="margin-top: 30px;">
            <label for="lease_remaining" class="form-label">
                Lease remaining

            </label>
            <div class="input-group mb-3">
                <input wire:model="lease_remaining_year" type="text" class="form-control"
                    aria-label="Recipient's username" aria-describedby="basic-addon2">
                <div class="input-group-append">
                    <span class="input-group-text" id="basic-addon2">Years</span>
                </div>
            </div>
            @error("lease_remaining_year")
            <div style="color: red;">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="col-md-6" style="margin-top: 40px;">
            <br>
            <div class="form-check form-switch">
                <input wire:model="free_hold" class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                <label class="form-check-label" for="flexSwitchCheckDefault">Freehold
                </label>
            </div>
        </div>
        <div class="col-md-6" style="margin-top: 30px;">
            <label for="floor_area" class="form-label">
                Land/Floor Area
                if applicable
            </label>
            <input wire:model="floor_area" type="text" class="form-control" id="floor_area">
            @error("floor_area")
            <div style="color: red;">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="col-md-6" style="margin-top: 30px;">
            <label for="useable_area" class="form-label">
                Build-in/Useable Area


            </label>
            <input wire:model="useable_area" type="text" class="form-control" id="useable_area">
            @error("useable_area")
            <div style="color: red;">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="col-md-2">
            <br>
            <div class="form-check form-switch">
                <input wire:change="changeAreaTypee()" wire:model="square_feet" class="form-check-input" type="checkbox"
                    id="flexSwitchCheckDefault">
                <label class="form-check-label" for="flexSwitchCheckDefault">Square Feet

                </label>
            </div>
            @error("square_feet")
            <div style="color: red;">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="col-md-2">
            <br>
            <div class="form-check form-switch">
                <input wire:change="changeAreaType()" wire:model="square_meter" class="form-check-input" type="checkbox"
                    id="flexSwitchCheckDefault">
                <label class="form-check-label" for="flexSwitchCheckDefault">Square Meter
                </label>
            </div>
            @error("square_meter")
            <div style="color: red;">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="col-md-8"></div>
        <div class="col-md-12 text-center">
            <br>
            <b>If applicable
            </b>

        </div>
        <div class="col-md-2">
            <br>
            <div class="form-check form-switch">
                <input wire:model="completed" class="form-check-input" type="checkbox" id="flexSwitchCheckDefaul3">
                <label class="form-check-label" for="flexSwitchCheckDefaul3">Completed</label>
            </div>
        </div>
        <div class="col-md-6">
            <br>
            Under Construction -Expected date of completion
        </div>
        <div class="col-md-2">
            <label for="useable_area" class="form-label">Year</label>
            <select wire:model="construction_year" class="form-control">
                <option value="">Select</option>
                @for ($x = 1990; $x <= date('Y'); $x++) <option value="{{ $x }}">{{ $x }}</option>
                    @endfor
            </select>
        </div>
        <div class="col-md-2">
            <label for="useable_area" class="form-label">Quater</label>
            <select wire:model="construction_year_time" class="form-control">
                <option value="">Select</option>
                <option value="1">Q1</option>
                <option value="2">Q2</option>
                <option value="3">Q3</option>
                <option value="4">Q4</option>
            </select>
        </div>
        <div class="col-md-12">
            <hr>
        </div>

        <div class="col-md-12">
            <br>
            <br>
            If it is under financing, the Financing Partners may require you to refinance with them(not to worry they
            will
            provide you with the refinancing rate for consideration.)
        </div>
        <div class="col-md-6">
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
        <div class="col-md-6">
            <br>
            <br>
            <div class="form-check form-switch">
                <input wire:model="fix_rate" class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                <label class="form-check-label" for="flexSwitchCheckDefault"> Check offer for fixed rate
                </label>
            </div>
            @error("fix_rate")
            <div style="color: red;">
                {{ $message }}
            </div>
            @enderror
        </div>
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
                        {{-- <th scope="col">Document</th> --}}
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
                        {{-- <td>
                            <button  class="btn">View Docuemts</button>
                               
                        </td> --}}
                        <td><button wire:click="deleteRecord({{ $item->id }})" style="background: red;"
                                class="btn">Delete</button></td>
                    </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>

</section>
