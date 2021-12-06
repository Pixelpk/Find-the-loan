<section>
    <div>
        <div class="row">
            <div class="col-md-6">
           <div class="mb-3">
            <label for="hirePurchase.amount" class="form-label">Amount required
            </label>
            <input wire:model="hirePurchase.amount" type="number" class="form-control" id="hirePurchase.amount">
            @error("hirePurchase.amount")
            <div style="color: red;">
                {{ $message }}
            </div>
            @enderror
           </div>
            </div>
            @if($main_type == 1)
            <div class="col-md-6">
          <div class="mb-3">
            <label for="" class="form-label">Select Hire Purchase Type
            </label>
            <select id="currency" wire:model="hirePurchase.hire_purchase_type" class="form-select">
                <option value="" hidden>Select</option>
                <option value="1">Office Equipment</option>
                <option value="2">Other Commercial & Industrial Equipment
                </option>
                <option value="3">Industry Vehicle –
                    Cranes, forklift, Tractors etc
                </option>
                <option value="4">Commercial Vehicle – Cars, lorries, trucks etc
                </option>
                <option value="5">Passenger Vehicle
                </option>

            </select>
          </div>
            </div>
            @endif
        </div>

        @if($hirePurchase['hire_purchase_type'] || $main_type == 2  ?? '')
        
        <div class="row mt-2">
            @if($hirePurchase['hire_purchase_type']  == 4 || $hirePurchase['hire_purchase_type']  == 5 || $main_type == 2 ?? '')
            <div class="col-md-6">
                <livewire:widget.upload-component
                    :label="'Vehicle Sales Agreement/Quotation form if any'"
                    :apply_loan="$apply_loan" :main_type="$main_type" :loan_type_id="$loan_type_id" :share_holder="0"
                    :modell="'App\Models\BusinessHirePurchase'" :keyvalue="'business_hire_purchase_vehicle_agreement'" />
            </div>
            @else
            <div class="col-md-6">
                <livewire:widget.upload-component
                    :label="'Quotation form/purchase order/sales agreement for the Equipment/Machinery/Vehicle'"
                    :apply_loan="$apply_loan" :main_type="$main_type" :loan_type_id="$loan_type_id" :share_holder="0"
                    :modell="'App\Models\BusinessHirePurchase'" :keyvalue="'business_hire_purchase_agreement'" />
            </div>
            @endif

            <div class="col-md-3">
                <div class="form-check">
                    <input wire:model="hirePurchase.type" value="Leasing" class="form-check-input" type="radio"
                        id="flexRadioDefault1">
                    <label class="form-check-label" for="flexRadioDefault1">
                        Leasing
                    </label>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-check">
                    <input wire:model="hirePurchase.type" value="Hire Purchase" class="form-check-input" type="radio"
                        id="flexRadioDefault2" checked>
                    <label class="form-check-label" for="flexRadioDefault2">
                        Hire Purchase
                    </label>
                </div>
            </div>

            <div class="col-md-6">
                @error('hirePurchase.agreement')
                <div style="color: red;">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="col-md-6">
                @error('hirePurchase.type')
                <div style="color: red;">
                    {{ $message }}
                </div>
                @enderror
            </div>
        </div>

                <hr>

                <div class="row">
                    <p class="mb-1"> <b> Please provide any details not found in quotation form/purchase order/sales agreement</b></p>
                </div>
                @if($hirePurchase['hire_purchase_type']  == 4 || $hirePurchase['hire_purchase_type']  == 5 ||  $main_type == 2 ?? '')
                <div class="row">
                   <p> <b> Vehicle details</b></p>
                </div>
                @endif
                <div class="row mt-3">
            @if($hirePurchase['hire_purchase_type'] == 1 || $hirePurchase['hire_purchase_type'] == 2 ||
            $hirePurchase['hire_purchase_type'] == 3 ?? '')
            <div class="col-md-4">
            <div class="mb-3">
                <label for="hirePurchase.distributer" class="form-label">Distributer</label>
                <input wire:model="hirePurchase.distributer" type="text" class="form-control">
                @error("hirePurchase.distributer")
                <div style="color: red;">
                    {{ $message }}
                </div>
                @enderror
            </div>
            </div>
            @endif
            <div class="col-md-4">
            <div class="mb-3">
                <label for="hirePurchase.manufacturer" class="form-label">Manufacturer (brand)
                </label>
                <input wire:model="hirePurchase.manufacturer" type="text" class="form-control">
                @error("hirePurchase.manufacturer")
                <div style="color: red;">
                    {{ $message }}
                </div>
                @enderror
            </div>
            </div>
            <div class="col-md-4">
             <div class="mb-3">
                <label for="hirePurchase.model" class="form-label">Model
                </label>
                <input wire:model="hirePurchase.model" type="text" class="form-control">
                @error("hirePurchase.model")
                <div style="color: red;">
                    {{ $message }}
                </div>
                @enderror
             </div>
            </div>
        </div>

            <div class="row mt-2">
            @if($hirePurchase['hire_purchase_type'] == 1 || $hirePurchase['hire_purchase_type'] == 2 ||
            $hirePurchase['hire_purchase_type'] == 3 ||  $main_type == 2 ?? '')
            <div class="col-md-4">
          <div class="mb-3">
            <label for="hirePurchase.number_of_units" class="form-label">Number of units </label>
            <input wire:model="hirePurchase.number_of_units" type="text" class="form-control">
            @error("hirePurchase.number_of_units")
            <div style="color: red;">
                {{ $message }}
            </div>
            @enderror
          </div>
            </div>
            <div class="col-md-4">
            <div class="mb-3">
                <label for="hirePurchase.country_of_origin" class="form-label">Country of origin </label>
                <input wire:model="hirePurchase.country_of_origin" type="text" class="form-control">
                @error("hirePurchase.country_of_origin")
                <div style="color: red;">
                    {{ $message }}
                </div>
                @enderror
            </div>
            </div>
            <div class="col-md-4">
          <div class="mb-3">
            <label for="hirePurchase.price_per_unit" class="form-label">Price per unit before trade if any $  </label>
            <input wire:model="hirePurchase.price_per_unit" type="number" class="form-control">
            @error("hirePurchase.price_per_unit")
            <div style="color: red;">
                {{ $message }}
            </div>
            @enderror
          </div>
            </div>
        </div>

<div class="row mt-2 d-flex align-items-end">
            <div class="col-md-4">
            <div class="mb-3">
                <label for="hirePurchase.purchase_used" class="form-label">
                    If Equipment Is purchased used, Please State Year Manufactured to the best of your knowledge
                </label>
                <input wire:model="hirePurchase.purchase_used" type="text" class="form-control">
                @error("hirePurchase.purchase_used")
                <div style="color: red;">
                    {{ $message }}
                </div>
                @enderror
            </div>
            </div>
            <div class="col-md-4">
             <div class="mb-3">
                <label for="hirePurchase.serial_number" class="form-label">
                    Serial number if applicable
                </label>
                <input wire:model="hirePurchase.serial_number" type="text" class="form-control">
                @error("hirePurchase.serial_number")
                <div style="color: red;">
                    {{ $message }}
                </div>
                @enderror
             </div>
            </div>
            <div class="col-md-4">
              <div class="mb-3">
                <label for="hirePurchase.register_number" class="form-label">
                    Registration number if applicable
                </label>
                <input wire:model="hirePurchase.register_number" type="text" class="form-control">
                @error("hirePurchase.register_number")
                <div style="color: red;">
                    {{ $message }}
                </div>
                @enderror
              </div>
            </div>
            @endif
        </div>

            <div class="row mt-2">
            <div class="col-md-6">
             <div class="mb-3">
                <label for="hirePurchase.chassis_number" class="form-label">Vehicle/chassis number if applicable   </label>
                <input wire:model="hirePurchase.chassis_number" type="text" class="form-control">
                @error("hirePurchase.chassis_number")
                <div style="color: red;">
                    {{ $message }}
                </div>
                @enderror
             </div>
            </div>
            @if($hirePurchase['hire_purchase_type'] == 1 || $hirePurchase['hire_purchase_type'] == 2 || $main_type == 3)
            <div class="col-md-6">
                <label for="hirePurchase.current_estimate_value" class="form-label">Current estimated value
                </label>
                <input wire:model="hirePurchase.current_estimate_value" type="text" class="form-control">
                @error("hirePurchase.current_estimate_value")
                <div style="color: red;">
                    {{ $message }}
                </div>
                @enderror
            </div>
            @endif
            @if($hirePurchase['hire_purchase_type'] == 4 || $hirePurchase['hire_purchase_type'] == 5 || $main_type == 2)
            <div class="col-md-6">
               <div class="mb-3">
                <label for="hirePurchase.purchase_price" class="form-label">Purchase price $
                </label>
                <input wire:model="hirePurchase.purchase_price" type="number" class="form-control">
                @error("hirePurchase.purchase_price")
                <div style="color: red;">
                    {{ $message }}
                </div>
                @enderror
               </div>
            </div>
            </div>

            <div class="row mt-3">
            <div class="col-md-4">
          <div class="mb-3">
            <label for="hirePurchase.deposit_paid" class="form-label">Deposit Paid if any </label>
            <input wire:model="hirePurchase.deposit_paid" type="text" class="form-control">
            @error("hirePurchase.deposit_paid")
            <div style="color: red;">
                {{ $message }}
            </div>
            @enderror
          </div>
            </div>
            <div class="col-md-4">
            <div class="mb-3">
                <label for="hirePurchase.engine_number" class="form-label">Engine number if applicable</label>
                <input wire:model="hirePurchase.engine_number" type="text" class="form-control">
                @error("hirePurchase.engine_number")
                <div style="color: red;">
                    {{ $message }}
                </div>
                @enderror
            </div>
            </div>
            <div class="col-md-4">
            <div class="mb-3">
                <label for="hirePurchase.plate_number" class="form-label">Registration/Car plate number if applicable
                </label>
                <input wire:model="hirePurchase.plate_number" type="text" class="form-control">
                @error("hirePurchase.plate_number")
                <div style="color: red;">
                    {{ $message }}
                </div>
                @enderror
            </div>
            </div>
            @endif
        </div>
        
        <hr>

        @if($hirePurchase['hire_purchase_type'] == 4 || $hirePurchase['hire_purchase_type'] == 5 || $main_type == 2)
        <div class="row">
           <p> Any discounts/rebates/benefits have the effect of reducing the actual price of the Vehicle below the
            purchase price stated in the Vehicle Sales Agreement</p>
        </div>
        <div class="row mt-2">
            <div class="col-md-6">
           <div class="mb-3">
            <label for="hirePurchase.item_name_1" class="form-label">Item Name
            </label>
            <input wire:model="hirePurchase.item_name_1" type="text" class="form-control">
            @error("hirePurchase.item_name_1")
            <div style="color: red;">
                {{ $message }}
            </div>
            @enderror
           </div>
            </div>
            <div class="col-md-6">
           <div class="mb-3">
            <label for="hirePurchase.item_value1" class="form-label">Value $
            </label>
            <input wire:model="hirePurchase.item_value1" type="text" class="form-control">
            @error("hirePurchase.item_value1")
            <div style="color: red;">
                {{ $message }}
            </div>
            @enderror
           </div>
            </div>
        </div>

            <div class="row mt-2">
            <div class="col-md-6">
          <div class="mb-3">
            <label for="hirePurchase.item_name_2" class="form-label">Item Name
            </label>
            <input wire:model="hirePurchase.item_name_2" type="text" class="form-control">
            @error("hirePurchase.item_name_2")
            <div style="color: red;">
                {{ $message }}
            </div>
            @enderror
          </div>
            </div>
            <div class="col-md-6">
         <div class="mb-3">
            <label for="hirePurchase.item_value2" class="form-label">Value $
            </label>
            <input wire:model="hirePurchase.item_value2" type="text" class="form-control">
            @error("hirePurchase.item_value2")
            <div style="color: red;">
                {{ $message }}
            </div>
            @enderror
         </div>
            </div>
        </div>

            <div class="row mt-2">
            <div class="col-md-6">
            <div class="mb-3">
                <label for="hirePurchase.item_name_3" class="form-label">Item Name
                </label>
                <input wire:model="hirePurchase.item_name_3" type="text" class="form-control">
                @error("hirePurchase.item_name_3")
                <div style="color: red;">
                    {{ $message }}
                </div>
                @enderror
            </div>
            </div>
            <div class="col-md-6">
          <div class="mb-3">
            <label for="hirePurchase.item_value3" class="form-label">Value $
            </label>
            <input wire:model="hirePurchase.item_value3" type="text" class="form-control">
            @error("hirePurchase.item_value3")
            <div style="color: red;">
                {{ $message }}
            </div>
            @enderror
          </div>
            </div>
        </div>

            <div class="row mt-2">
            <div class="col-md-12">
            <div class="mb-3">
                <div x-data="{ isUploading: false, progress: 0 }" x-on:livewire-upload-start="isUploading = true"
                x-on:livewire-upload-finish="isUploading = false" x-on:livewire-upload-error="isUploading = false"
                x-on:livewire-upload-progress="progress = $event.detail.progress">
                <div class="form-group">
                    <label class="form-label">
                        For used car, copy of LTA Vehicle Information
                    </label>
                    <label class="label" data-toggle="tooltip" title="Select Image">
                        <input accept="image/jpeg,image/gif,image/png,application/pdf,image/x-eps"
                            wire:model="hirePurchase.lta_vehicle_information" type="file" class="form-control" id="vehicleimage">
                    </label>
                </div>
                @error('hirePurchase.lta_vehicle_information')
                <div style="color: red;">
                    {{ $message }}
                </div>
                @enderror
                <div x-show="isUploading">
                    <progress max="100" x-bind:value="progress"></progress>
                </div>
            </div>
            </div>
            </div>
            @endif
        </div>

        @if($hirePurchase['hire_purchase_type'] == 1 || $hirePurchase['hire_purchase_type'] == 2 ||
        $hirePurchase['hire_purchase_type'] == 3 ?? '')
        <div class="row mt-2">
            <p>    Additional Remarks/Description or URL of equipment/machinery if any may assist the Financing Partner to
                make
                a faster evaluation</p>
            </div>
            <div class="row mt-2">
            <div class="col-md-6">
             <div class="mb-3">
                <textarea rows="6" wire:model="hirePurchase.remark" type="text" class="form-control"></textarea>
                @error("hirePurchase.remark")
                <div style="color: red;">
                    {{ $message }}
                </div>
                @enderror
             </div>
            </div>
            <div class="col-md-6">
              <div class="mb-3">
                <livewire:widget.upload-component :label="'Brochure if any'" :apply_loan="$apply_loan"
                :main_type="$main_type" :loan_type_id="$loan_type_id" :share_holder="0"
                :modell="'App\Models\BusinessHirePurchase'" :keyvalue="'business_hire_purchase_brochure'" />
              </div>
    </div>
    @endif
</div>

  
    @if($loan_type_id == 10 || $loan_type_id == 11)
    <div class="row mt-2">
   <div class="mb-3">
    <livewire:widget.upload-component
    :label="'For Gear up or refinancing please include latest month of loan outstanding statement If it is'"
    :apply_loan="$apply_loan" :main_type="$main_type" :loan_type_id="$loan_type_id" :share_holder="0"
    :modell="'App\Models\BusinessHirePurchase'" :keyvalue="'business_hire_purchase_gearup_refinancing'" />
@error('hirePurchase.gearup_or_refinancing')
<div style="color: red;">
    {{ $message }}
</div>
@enderror
   </div>
    </div>
    @endif
    <div class="row mt-1">
        <label for="hirePurchase.preferred_tenure_month" class="form-label">
            Preferred Tenure</label>
    <div class="col-md-4">
        <div class="input-group">
            <input wire:model="hirePurchase.preferred_tenure_year" type="text" class="form-control"
                aria-label="Recipient's username" aria-describedby="basic-addon2">
            <div class="input-group-append">
                <!-- <span class="input-group-text" id="basic-addon2">Years</span> -->
                <label for="" class="input-group-text">Years</label>
            </div>
        </div>
        @error("hirePurchase.preferred_tenure_year")
        <div style="color: red;">
            {{ $message }}
        </div>
        @enderror
    </div>
        <div class="col-md-4">
        <div class="input-group">
            <input wire:model="hirePurchase.preferred_tenure_month" type="text" class="form-control"
            aria-label="Recipient's username" aria-describedby="basic-addon2">
        <div class="input-group-append">
            <!-- <span class="input-group-text" id="basic-addon2">Months</span> -->
            <label for="" class="input-group-text">Months</label>
        </div>
        </div>
        @error("hirePurchase.preferred_tenure_month")
        <div style="color: red;">
            {{ $message }}
        </div>
        @enderror
    </div>
    <div class="col-md-4">
   <div class="mb-3">
    <div class="form-check form-switch">
        <input wire:model="hirePurchase.as_long_as_possiable" class="form-check-input" type="checkbox"
            id="flexSwitchCheckDefault">
        <label class="form-check-label" for="flexSwitchCheckDefault">As Long As Possible
        </label>
    </div>
    @error("hirePurchase.as_long_as_possiable")
    <div style="color: red;">
        {{ $message }}
    </div>
    @enderror
   </div>
    </div>
</div>

        <hr>

    @if($hirePurchase['hire_purchase_type'] == 4 || $hirePurchase['hire_purchase_type'] == 5 || $main_type == 2)
    <div class="row mt-2">
        <p><b>Details of Seller</b></p>
    </div>
    <div class="row">
        <div class="col-md-6">
        <div class="mb-3">
            <label for="hirePurchase.company_name" class="form-label">Company Name
            </label>
            <input wire:model="hirePurchase.company_name" type="text" class="form-control"
                id="hirePurchase.company_name">
            @error("hirePurchase.company_name")
            <div style="color: red;">
                {{ $message }}
            </div>
            @enderror
        </div>
        </div>
        <div wire:ignore.self class="col-md-6">
            <div class="mb-3">
             <label for="hirePurchase.address" class="form-label">Address</label>
             <input onkeyup="dddd()" wire:model.defer="hirePurchase.address" type="text" class="form-control"
                 id="ship-address1">
             @error("hirePurchase.address")
             <div style="color: red;">
                 {{ $message }}
             </div>
             @enderror
            </div>
         </div>
        @endif
        <div class="col-md-12">
            <b> Details of premise where equipment/machinery will be kept and used
            </b>
        </div>
        <div wire:ignore.self class="col-md-12" style="margin-top: 30px;">
            <label for="hirePurchase.address" class="form-label">Address</label>
            <input onkeyup="dddd()" wire:model.defer="hirePurchase.address" type="text" class="form-control"
                id="ship-address1">
            @error("hirePurchase.address")
            <div style="color: red;">
                {{ $message }}
            </div>
            @enderror

       <div class="row mt-3">
        <div class="col-md-4">
            <div class="mb-3">
                <label for="hirePurchase.sale_mane" class="form-label">Salesman names </label>
                <input wire:model="hirePurchase.sale_mane" type="text" class="form-control" id="hirePurchase.sale_mane">
                @error("hirePurchase.sale_mane")
                <div style="color: red;">
                    {{ $message }}
                </div>
                @enderror
            </div>
            </div>
        <div class="col-md-4">
      <div class="mb-3">
        <label for="hirePurchase.unit" class="form-label">Unit if any
        </label>
        <input wire:model="hirePurchase.unit" type="text" class="form-control" id="hirePurchase.unit">
        @error("hirePurchase.unit")
        <div style="color: red;">
            {{ $message }}
        </div>
        @enderror
      </div>
        </div>
        <div class="col-md-4">
        <div class="mb-3">
            <label for="hirePurchase.building_name" class="form-label">Building name if any
            </label>
            <input wire:model="hirePurchase.building_name" type="text" class="form-control"
                id="hirePurchase.building_name">
            @error("hirePurchase.building_name")
            <div style="color: red;">
                {{ $message }}
            </div>
            @enderror
        </div>
        </div>
    </div>

        <div class="row mt-2">
        @if($hirePurchase['hire_purchase_type'] == 1 || $hirePurchase['hire_purchase_type'] == 2 ||
        $hirePurchase['hire_purchase_type'] == 3 ?? '')
        <div class="col-md-3 col-lg-2">
    <div class="mb-3">
        <div class="form-check">
            <input wire:model="hirePurchase.property_type" value="Owned" class="form-check-input" type="radio"
                id="flexRadioDefault3">
            <label class="form-check-label" for="flexRadioDefault3">

                Owned
            </label>
        </div>
        @error("hirePurchase.property_type")
        <div style="color: red;">
            {{ $message }}
        </div>
        @enderror
    </div>

        </div>
        <div class="col-md-3 col-lg-2">
            <div class="form-check mb-3">
                <input wire:model="hirePurchase.property_type" value="Rented" class="form-check-input" type="radio"
                    id="flexRadioDefault4" checked>
                <label class="form-check-label" for="flexRadioDefault4">Rented </label>
            </div>
        </div>
        @if($hirePurchase['property_type'] == 'Rented' ?? '')
        <div class="col-md-6 col-lg-8">
        <div class="mb-3">
            <label for="hirePurchase.lender_name" class="form-label">Mortgaged to – Lender’s name </label>
            <input wire:model="hirePurchase.lender_name" type="text" class="form-control" id="hirePurchase.lender_name">
            @error("hirePurchase.lender_name")
            <div style="color: red;">
                {{ $message }}
            </div>
            @enderror
        </div>
        </div>
        @endif
        @endif
        </div>

        <div class="mt-2">
            <button class="btn btn-custom" type="button" wire:target="store" wire:click.prevent="store">
                <span wire:loading="" wire:target="store" class="spinner-border spinner-border-sm" role="status"
                    aria-hidden="true"></span>
            @if(sizeof($hirePurchaseGet) > 0)
                Add Another
            @else
            Submit
            @endif
            </button>
        </div>

    <div class="row mt-5">
        <div class="col-md-12">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Type</th>
                        @if($hirePurchase['hire_purchase_type'] == 1 || $hirePurchase['hire_purchase_type'] == 2 ||
                        $hirePurchase['hire_purchase_type'] == 3 ?? '')
                        <th scope="col">Address</th>

                        <th scope="col">Property Type</th>
                        @endif

                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($hirePurchaseGet as $item)
                    <tr>
                        <th scope="row">1</th>
                        <td>{{ $item->type }}</td>
                        @if($hirePurchase['hire_purchase_type'] == 1 || $hirePurchase['hire_purchase_type'] == 2 ||
                        $hirePurchase['hire_purchase_type'] == 3 ?? '')
                        <td>{{ $item->address }}</td>
                        <td>{{ $item->property_type }}</td>
                        @endif


                        <td><button wire:click="deleteRecord({{ $item->id }})" style="background: red;"
                                class="btn">Delete</button></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @endif

    <div class="row mt-3">
        <div class="col-md-12 text-end">
            @if(sizeof($hirePurchaseGet) >  0)
                <div>
                    <button wire:click="tabChange()" class="btn btn-custom">Save & Continue</button>
                </div>
            @else
                <button disabled class="btn btn-custom">Save & Continue</button>
            @endif
            
        </div>
    </div>

</section>
