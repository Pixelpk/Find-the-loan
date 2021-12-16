<section>
    <div class="row mt-4">
        <div class="col-md-6">
           <div class="mb-3">
            <livewire:widget.upload-component
            :label="'Loan statement showing past 12 months prompt repayment history if any(please ensure address is visible, if not kindly include the main page where address is visible)'"
            :apply_loan="$apply_loan" :main_type="$main_type" :loan_type_id="$loan_type_id"
            :modell="'App\Models\OverDraftPropertyLand'" :keyvalue="'over_draft_past_twelve_month_statement'"
            :share_holder="0" />
           </div>
        </div>
        <div class="col-md-6 d-flex align-items-end">
           <div class="mb-3">
            <livewire:widget.upload-component
            :label="'Loan statement reflecting current Outstanding loan amount if it is not reflected in your repayment history statement'"
            :apply_loan="$apply_loan" :main_type="$main_type" :loan_type_id="$loan_type_id"
            :modell="'App\Models\OverDraftPropertyLand'" :keyvalue="'over_draft_current_loan_statement'"
            :share_holder="0" />
           </div>
        </div>
    </div>
 
        <div class="row mt-2">
        <div class="col-md-6">
       <div class="mb-3">
        <livewire:widget.upload-component :label="'CPF property withdrawal/utilization statement If CPF was used'"
        :apply_loan="$apply_loan" :main_type="$main_type" :loan_type_id="$loan_type_id"
        :modell="'App\Models\OverDraftPropertyLand'" :keyvalue="'over_draft_cpf_statement'" :share_holder="0" />
    </div>
        </div>
        <div class="col-md-6">
           <div class="mb-3">
            <livewire:widget.upload-component :label="'Tenancy Agreement If it’s rented out'" :apply_loan="$apply_loan"
            :main_type="$main_type" :loan_type_id="$loan_type_id" :modell="'App\Models\OverDraftPropertyLand'"
            :keyvalue="'over_draft_tenancy_agreement'" :share_holder="0" />
           </div>
        </div>
    </div>


    
    <hr class="mt-4 mb-0">

    <div class="row mt-4">
        <div wire:ignore.self class="col-md-2">
           <div class="mb-3">
            <label for="address" class="form-label">Address</label>
            <input onkeyup="dddd()" wire:model.defer="address" type="text" class="form-control" id="ship-address1">
            @error("address")
            <div style="color: red;">
                {{ $message }}
            </div>
            @enderror
           </div>
        </div>
        <div class="col-md-2">
          <div class="mb-3">
            <label for="unit" class="form-label">Unit if any
            </label>
            <input wire:model="unit" type="text" class="form-control" id="unit">
            @error("unit")
            <div style="color: red;">
                {{ $message }}
            </div>
            @enderror
          </div>
        </div>
        <div class="col-md-2">
        <div class="mb-3">
            <label for="building_name" class="form-label">Building name if any
            </label>
            <input wire:model="building_name" type="text" class="form-control" id="building_name">
            @error("building_name")
            <div style="color: red;">
                {{ $message }}
            </div>
            @enderror
        </div>
        </div>

        <div class="col-md-2">
         <div class="mb-3">
            <label for="lease_remaining" class="form-label">
                Lease remaining
            </label>
            <div class="input-group">
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
        </div>
        <div class="col-md-2 d-flex align-items-center">
            <div class="form-check form-switch pt-3">
                <input wire:model="free_hold" class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                <label class="form-check-label" for="flexSwitchCheckDefault">Freehold
                </label>
            </div>
        </div>

    </div>


        <div class="row mt-2">
        <div class="col-md-4 col-lg-3">
         <div class="mb-3">
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
        </div>
        <div class="col-md-4 col-lg-3">
         <div class="mb-3">
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
        </div>
        <div class="col-md-2 d-flex align-items-center">
            <div class="form-check form-switch mb-1 pt-3">
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
        <div class="col-md-2 d-flex align-items-center">
            <div class="form-check form-switch mb-1 pt-3">
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
    </div>

    <hr class="mt-4 mb-0">

    <div class="row pt-4 text-center">
        <p> <b>Not applicable for land</b></p>
    </div>

    <div class="row mt-2 align-items-center">
        <div class="col-md-2">
            <div class="form-check form-switch">
                <input wire:model="completed" class="form-check-input" type="checkbox" id="flexSwitchCheckDefaul3">
                <label class="form-check-label" for="flexSwitchCheckDefaul3">Completed</label>
            </div>
        </div>
        <div class="col-md-4 d-flex justify-content-end align-items-center">
          <p class="mb-0">Under Construction -Expected date of completion</p>
          
        </div>
        <div class="col-md-3 justify-content-end d-flex">
            <label for="useable_area" class="form-label mb-0 pt-2">Year</label>  &nbsp;&nbsp;&nbsp;
            <select wire:model="construction_year" class="form-select">
                <option value="">Select</option>
                @for ($x = 1990; $x <= date('Y'); $x++) <option value="{{ $x }}">{{ $x }}</option>
                    @endfor
            </select>
        </div>
        <div class="col-md-3 justify-content-end d-flex">
            <label for="useable_area" class="form-label mb-0 pt-2">Quarter</label> &nbsp;&nbsp;&nbsp;
            <select wire:model="construction_year_time" class="form-select">
                <option value="">Select</option>
                <option value="1">Q1</option>
                <option value="2">Q2</option>
                <option value="3">Q3</option>
                <option value="4">Q4</option>
            </select>
        </div>
    </div>

      <hr class="mt-4 mb-0">

      <div class="row mt-4">
          <p>If it is under financing, the Financing Partners may require you to refinance with them(not to worry they
          will
          provide you with the refinancing rate for consideration.)</p>
        </div>

        <div class="row mt-3">
            <small class="mb-2"><b>You can select both</b></small>
        <div class="col-md-6 col-lg-3">
            <div class="form-check form-switch mb-3">
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
        <div class="col-md-6 col-lg-3">
            <div class="form-check form-switch mb-3">
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
      
    </div>

        <hr class="mt-4 mb-0">
        <!-- Optional Documents -->
        <div class="row mt-2">
            <div class="col-md-12">
               <label>Submitting the following optional documents may help to give our Financing Partners more <br> confidence  in your repayment ability, if they suggest cashflow coming into the company <br>  over the tenure of the loan. E.g Aging list (account receivable) contract, LC, PO/invoices etc.</label>
               <br>
           </div>
        </div>

        <div class="row">
            <div class="col-md-2">
                <p class="mt-4">Optional Documents</p>
            </div>
            <div class="col-md-4">
                <div class="mb-3">
                    <livewire:widget.upload-component
                    :apply_loan="$apply_loan"
                    :main_type="$main_type"
                    :loan_type_id="$loan_type_id"
                    :share_holder="0"
                    :modell="'App\Models\OverDraftPropertyLand'"
                    :keyvalue="'over_draft_property_optional_statement'"/>
                    <!-- @error("document")
                    <div style="color: red;">
                        {{ $message }}
                    </div>
                    @enderror -->
                </div>
            </div>
        </div>


        <div class="mt-2">
            <button class="btn" wire:click="store">Add Property</button>
        </div>

    <div class="row mt-3">
        <div class="col-md-12">
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
