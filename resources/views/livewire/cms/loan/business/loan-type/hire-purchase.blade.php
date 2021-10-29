<div>
    <div class="row">
        <div class="col-md-12" style="margin-top: 30px;">
            <label for="hirePurchase.amount" class="form-label">Amount
            </label>
            <input wire:model="hirePurchase.amount" type="numbedr" class="form-control" id="hirePurchase.amount">
            @error("hirePurchase.amount")
            <div style="color: red;">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="col-md-12" style="margin-top: 30px;">
            <select id="currency" wire:model="hirePurchase.hire_purchase_type" class="form-select">
                <option value="" hidden>Select Hire Purchase Type</option>
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
            <br>
            <br>
        </div>
    </div>
    @if($hirePurchase['hire_purchase_type'] == 1 || $hirePurchase['hire_purchase_type'] == 2 ||
    $hirePurchase['hire_purchase_type'] == 3 ?? '')
    <div class="row">

        <div class="col-md-6 text-left">
            <div x-data="{ isUploading: false, progress: 0 }" x-on:livewire-upload-start="isUploading = true"
                x-on:livewire-upload-finish="isUploading = false" x-on:livewire-upload-error="isUploading = false"
                x-on:livewire-upload-progress="progress = $event.detail.progress">
                <div class="form-group">
                    <label class="control-label mb-10">
                        Quotation form/purchase order/sales agreement for the Equipment/Machinery/Vehicle
                    </label>
                    <br>
                    <br>
                    <label class="label" data-toggle="tooltip" title="Select Image">
                        <input accept="image/jpeg,image/gif,image/png,application/pdf,image/x-eps"
                            wire:model="hirePurchase.agreement" type="file" id="vehicleimage">
                    </label>
                </div>

                <div x-show="isUploading">
                    <progress max="100" x-bind:value="progress"></progress>
                </div>
            </div>
        </div>
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
        <div class="col-md-12">
            <hr>
        </div>
        <div class="col-md-12">
            Please provide any details not found in quotation form/purchase order/sales agreement
        </div>
        <div class="col-md-6" style="margin-top: 30px;">
            <label for="hirePurchase.distributer" class="form-label">Distributer</label>
            <input wire:model="hirePurchase.distributer" type="text" class="form-control">
            @error("hirePurchase.distributer")
            <div style="color: red;">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="col-md-6" style="margin-top: 30px;">
            <label for="hirePurchase.manufacturer" class="form-label">Manufacturer (brand)
            </label>
            <input wire:model="hirePurchase.manufacturer" type="text" class="form-control">
            @error("hirePurchase.manufacturer")
            <div style="color: red;">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="col-md-6" style="margin-top: 30px;">
            <label for="hirePurchase.model" class="form-label">Model
            </label>
            <input wire:model="hirePurchase.model" type="text" class="form-control">
            @error("hirePurchase.model")
            <div style="color: red;">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="col-md-6" style="margin-top: 30px;">
            <label for="hirePurchase.number_of_units" class="form-label">Number of units
            </label>
            <input wire:model="hirePurchase.number_of_units" type="text" class="form-control">
            @error("hirePurchase.number_of_units")
            <div style="color: red;">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="col-md-6" style="margin-top: 30px;">
            <label for="hirePurchase.country_of_origin" class="form-label">Country of origin

            </label>
            <input wire:model="hirePurchase.country_of_origin" type="text" class="form-control">
            @error("hirePurchase.country_of_origin")
            <div style="color: red;">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="col-md-6" style="margin-top: 30px;">
            <label for="hirePurchase.price_per_unit" class="form-label">Price per unit before trade if any $
            </label>
            <input wire:model="hirePurchase.price_per_unit" type="number" class="form-control">
            @error("hirePurchase.price_per_unit")
            <div style="color: red;">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="col-md-12">
            <br>
            <hr>
        </div>
        <div class="col-md-12">
            Additional Remarks/Description or URL of equipment/machinery if any may assist the Financing Partner to make
            a faster evaluation
        </div>
        <div class="col-md-6" style="margin-top: 30px;">
            <textarea rows="9" wire:model="hirePurchase.remark" type="text" class="form-control"></textarea>
            @error("hirePurchase.remark")
            <div style="color: red;">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="col-md-6 text-left">
            <div x-data="{ isUploading: false, progress: 0 }" x-on:livewire-upload-start="isUploading = true"
                x-on:livewire-upload-finish="isUploading = false" x-on:livewire-upload-error="isUploading = false"
                x-on:livewire-upload-progress="progress = $event.detail.progress">
                <div class="form-group">
                    <label class="control-label mb-10">
                        <br>
                        <br>
                        <br>
                        Brochure if any
                    </label>
                    <br>
                    <br>
                    <label class="label" data-toggle="tooltip" title="Select Image">
                        <input accept="image/jpeg,image/gif,image/png,application/pdf,image/x-eps"
                            wire:model="hirePurchase.brochure" type="file" id="vehicleimage">
                    </label>
                </div>
                @error('hirePurchase.brochure')
                <div style="color: red;">
                    {{ $message }}
                </div>
                @enderror
                <div x-show="isUploading">
                    <progress max="100" x-bind:value="progress"></progress>
                </div>
            </div>
        </div>
        <div class="col-md-12 text-left">
            <div x-data="{ isUploading: false, progress: 0 }" x-on:livewire-upload-start="isUploading = true"
                x-on:livewire-upload-finish="isUploading = false" x-on:livewire-upload-error="isUploading = false"
                x-on:livewire-upload-progress="progress = $event.detail.progress">
                <div class="form-group">
                    <label class="control-label mb-10">
                        For Gear up or refinancing please include latest month of loan outstanding statement If it is
                        still under financing
                    </label>
                    <br>
                    <br>
                    <label class="label" data-toggle="tooltip" title="Select Image">
                        <input accept="image/jpeg,image/gif,image/png,application/pdf,image/x-eps"
                            wire:model="hirePurchase.gearup_or_refinancing" type="file" id="vehicleimage">
                    </label>
                </div>
                @error('hirePurchase.gearup_or_refinancing')
                <div style="color: red;">
                    {{ $message }}
                </div>
                @enderror
                <div x-show="isUploading">
                    <progress max="100" x-bind:value="progress"></progress>
                </div>
            </div>
        </div>
        <div class="col-md-6" style="margin-top: 30px;">
            <label for="hirePurchase.preferred_tenure_month" class="form-label">
                Preferred Tenure
            </label>
            <div class="input-group mb-3">
                <input wire:model="hirePurchase.preferred_tenure_year" type="text" class="form-control"
                    aria-label="Recipient's username" aria-describedby="basic-addon2">
                <div class="input-group-append">
                    <span class="input-group-text" id="basic-addon2">Years</span>
                </div>
                <input wire:model="hirePurchase.preferred_tenure_month" type="text" class="form-control"
                    aria-label="Recipient's username" aria-describedby="basic-addon2">
                <div class="input-group-append">
                    <span class="input-group-text" id="basic-addon2">Month</span>
                </div>
            </div>
            @error("hirePurchase.preferred_tenure_year")
            <div style="color: red;">
                {{ $message }}
            </div>
            @enderror
            @error("hirePurchase.preferred_tenure_month")
            <div style="color: red;">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="col-md-3" style="margin-top: 40px;">
            <br>
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
        <div class="col-md-12">
            <br>
            <hr>
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

        </div>
        <div class="col-md-6" style="margin-top: 30px;">
            <label for="hirePurchase.unit" class="form-label">Unit if any
            </label>
            <input wire:model="hirePurchase.unit" type="text" class="form-control" id="hirePurchase.unit">
            @error("hirePurchase.unit")
            <div style="color: red;">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="col-md-6" style="margin-top: 30px;">
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
        <div class="col-md-3">
            <br>
            <br>
            <br>
            <div class="form-check">
                <input wire:model="hirePurchase.property_type" value="Owned" class="form-check-input" type="radio"
                    id="flexRadioDefault3">
                <label class="form-check-label" for="flexRadioDefault3">

                    Owned
                </label>
            </div>

        </div>
        <div class="col-md-3">
            <br>
            <br>
            <br>
            <div class="form-check">
                <input wire:model="hirePurchase.property_type" value="Rented" class="form-check-input" type="radio"
                    id="flexRadioDefault4" checked>
                <label class="form-check-label" for="flexRadioDefault4">

                    Rented
                </label>
            </div>
        </div>
        @if($hirePurchase['property_type'] == 'Rented' ?? '')
        <div class="col-md-6" style="margin-top: 30px;">
            <label for="hirePurchase.lender_name" class="form-label">Mortgaged to – Lender’s name

            </label>
            <input wire:model="hirePurchase.lender_name" type="text" class="form-control" id="hirePurchase.lender_name">
            @error("hirePurchase.lender_name")
            <div style="color: red;">
                {{ $message }}
            </div>
            @enderror
        </div>
        @endif



        


        <div class="col-12 text-end">
            <br>
            <button class="btn" type="button" wire:target="store" wire:click.prevent="store">
                <span wire:loading="" wire:target="store" class="spinner-border spinner-border-sm" role="status"
                    aria-hidden="true"></span>
                Save &amp; Continue
            </button>
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
                        <th scope="col">Type</th>
                        <th scope="col">Address</th>
                        <th scope="col">Property Type</th>
                      
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($hirePurchaseGet as $item)
                    <tr>
                        <th scope="row">1</th>
                        <td>{{ $item->type }}</td>
                        <td>{{ $item->address }}</td>
                        <td>{{ $item->property_type }}</td>
                     
                       
                        <td><button wire:click="deleteRecord({{ $item->id }})" style="background: red;"
                                class="btn">Delete</button></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @endif
