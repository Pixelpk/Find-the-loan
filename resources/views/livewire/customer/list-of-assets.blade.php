<div class="col-md-12 px-0">
    <div class="container">
        <h6>
            Local assets such as Investment, Life Insurance, Property, if any
        </h6>
        <input type="checkbox" id="{{$item2->quote_additional_doc->id}}" wire:change="chk({{$item2->quote_additional_doc->id}})" wire:model="dont_have_doc.{{$item2->quote_additional_doc->id}}" class="mr-2"><label for="{{$item2->quote_additional_doc->id}}">Don't have this?</label>
        
        <div class="row">
            <div class="col-md-3">
                <label for="">Insurance</label>
                <select @if(isset($dont_have_doc[$item2->quote_additional_doc->id]) == true) disabled  @endif class="form-control" wire:model.defer="insurance_type">
                    <option value="Regular Premium">Regular Premium</option>
                    <option value="Single Premium">Single Premium</option>
                    <option value="Endownment/Savings">Endownment/Savings</option>
                    <option value="Universal Life">Universal Life</option>
                </select>
            </div>
            <div class="col-md-3">
                <label for="">Details</label>
                <input type="text" @if(isset($dont_have_doc[$item2->quote_additional_doc->id]) == true) disabled @else @endif class="form-control" wire:model.defer="insurance_details">
            </div>
            <div class="col-md-2">
                <label for="">Current value</label>
                <input type="number" min="0" @if(isset($dont_have_doc[$item2->quote_additional_doc->id]) == true) disabled @else @endif class="form-control" wire:model.defer="insurance_current_value">
            </div>
            <div class="col-md-2">
                <label for="">Maturity Date</label>
                <input type="date" @if(isset($dont_have_doc[$item2->quote_additional_doc->id]) == true) disabled @else @endif class="form-control" wire:model.defer="insurance_matruity_date">
            </div>
            <div class="col-md-2">
                <label for="">Year Purchased</label>
                <input type="number" min="0" @if(isset($dont_have_doc[$item2->quote_additional_doc->id]) == true) disabled @else @endif class="form-control" wire:model.defer="insurance_year_purchase">
            </div>
        </div>
        <div class="mt-2">
            <button wire:click.prevent="addInsuranceAsset({{$insurance_counter}})" @if(isset($dont_have_doc[$item2->quote_additional_doc->id]) == true) disabled @else @endif class="btn btn-primary ">Add(+)</button>
        </div>    
    </div>
</div>
@foreach($insurance_asset_list as $key3 => $value3)
    <div class="col-md-12 px-0">
        <div class="container">
            <div class="row">
                <div class="col-md-2">
                    <label for="">Insurance</label>
                    <input type="text" wire:model="insurance_asset_list.{{$key3}}.insurance_type" readonly class="form-control">
                </div>
                <div class="col-md-2">
                    <label for="">Details</label>
                    <input type="text" wire:model="insurance_asset_list.{{$key3}}.insurance_details" readonly class="form-control">
                </div>
                <div class="col-md-2">
                    <label for="">Current value</label>
                    <input type="text" wire:model="insurance_asset_list.{{$key3}}.insurance_current_value" readonly class="form-control">
                </div>
                <div class="col-md-2">
                    <label for="">Maturity Date</label>
                    <input type="text" wire:model="insurance_asset_list.{{$key3}}.insurance_maturity_date" readonly class="form-control">
                </div>
                <div class="col-md-2">
                    <label for="">Year Purchased</label>
                    <input type="text" wire:model="insurance_asset_list.{{$key3}}.insurance_year_purchased" readonly class="form-control">
                </div>
                
            </div>
            <div class="mt-2">
                <button class="btn btn-danger btn-sm" wire:click.prevent="removeInsuranceAsset({{$key3}})">remove</button>
            </div>    
        </div>
    </div>
    <hr>
    @endforeach

    {{-- ---------------------------------------------------------------- --}}
    <div class="col-md-12 px-0">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <label for="">Investment</label>
                    <select @if(isset($dont_have_doc[$item2->quote_additional_doc->id]) == true) disabled  @endif class="form-control" wire:model.defer="investment_type">
                        <option value="Unit Trust">Unit Trust</option>
                        <option value="Reits">Reits</option>
                        <option value="Stocks">Stocks</option>
                        <option value="Others">Others</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="">Details</label>
                    <input type="text" @if(isset($dont_have_doc[$item2->quote_additional_doc->id]) == true) disabled @else @endif class="form-control" wire:model.defer="investment_details">
                </div>
                <div class="col-md-2">
                    <label for="">Current value</label>
                    <input type="number" min="0" @if(isset($dont_have_doc[$item2->quote_additional_doc->id]) == true) disabled @else @endif class="form-control" wire:model.defer="investment_current_value">
                </div>

            </div>
            <div class="mt-2">
                <button wire:click.prevent="addInvestmentAsset({{$investment_counter}})" @if(isset($dont_have_doc[$item2->quote_additional_doc->id]) == true) disabled @else @endif class="btn btn-primary ">Add(+)</button>
            </div>    
        </div>
    </div>
    @foreach($investment_asset_list as $key4 => $value4)
        <div class="col-md-12 px-0">
            <div class="container">
                <div class="row">
                    <div class="col-md-3">
                        <label for="">Insurance</label>
                        <input type="text" wire:model="investment_asset_list.{{$key4}}.investment_type" readonly class="form-control">
                    </div>
                    <div class="col-md-3">
                        <label for="">Details</label>
                        <input type="text" wire:model="investment_asset_list.{{$key4}}.investment_details" readonly class="form-control">
                    </div>
                    <div class="col-md-3">
                        <label for="">Current value</label>
                        <input type="text" wire:model="investment_asset_list.{{$key4}}.investment_current_value" readonly class="form-control">
                    </div>
                    <div class="col-md-3 mt-2">
                        <button class="btn btn-danger btn-sm" wire:click.prevent="removeInvestmentAsset({{$key4}})">remove</button>
                    </div>
                </div>

            </div>
        </div>
    @endforeach

    {{-- ---------------------------------------------------------------- --}}
    <div class="col-md-12 px-0">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <label for="">Cash & Deposit</label>
                    <select @if(isset($dont_have_doc[$item2->quote_additional_doc->id]) == true) disabled  @endif class="form-control" wire:model.defer="cash_and_deposit_type">
                        
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="">Details</label>
                    <input type="text" @if(isset($dont_have_doc[$item2->quote_additional_doc->id]) == true) disabled @else @endif class="form-control" wire:model.defer="cash_and_deposit_details">
                </div>
                <div class="col-md-2">
                    <label for="">Current value</label>
                    <input type="number" min="0" @if(isset($dont_have_doc[$item2->quote_additional_doc->id]) == true) disabled @else @endif class="form-control" wire:model.defer="cash_and_deposit_current_value">
                </div>

            </div>
            <div class="mt-2">
                <button wire:click.prevent="addCashDepositAsset({{$cd_counter}})" @if(isset($dont_have_doc[$item2->quote_additional_doc->id]) == true) disabled @else @endif class="btn btn-primary ">Add(+)</button>
            </div>    
        </div>
    </div>
    @foreach($cash_and_deposit_asset_list as $key4 => $value4)
        <div class="col-md-12 px-0">
            <div class="container">
                <div class="row">
                    <div class="col-md-3">
                        <label for="">Insurance</label>
                        <input type="text" wire:model="cash_and_deposit_asset_list.{{$key4}}.cash_and_deposit_type" readonly class="form-control">
                    </div>
                    <div class="col-md-3">
                        <label for="">Details</label>
                        <input type="text" wire:model="cash_and_deposit_asset_list.{{$key4}}.cash_and_deposit_details" readonly class="form-control">
                    </div>
                    <div class="col-md-3">
                        <label for="">Current value</label>
                        <input type="text" wire:model="cash_and_deposit_asset_list.{{$key4}}.cash_and_deposit_current_value" readonly class="form-control">
                    </div>
                    <div class="col-md-3 mt-2">
                        <button class="btn btn-danger btn-sm" wire:click.prevent="removeCashDepositAsset({{$key4}})">remove</button>
                    </div>
                </div>

            </div>
        </div>
    @endforeach

    
    {{-- ---------------------------------------------------------------- --}}
    <div class="col-md-12 px-0">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <label for="">Property</label>
                    <select @if(isset($dont_have_doc[$item2->quote_additional_doc->id]) == true) disabled  @endif class="form-control" wire:model.defer="asset_property_type">
                        <option value="Main resident">Main resident</option>
                        <option value="Commerical property">Commerical property</option>
                        <option value="Residential property">Residential property</option>
                        <option value="Rental">Rental</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="">Details</label>
                    <input type="text" @if(isset($dont_have_doc[$item2->quote_additional_doc->id]) == true) disabled @else @endif class="form-control" wire:model.defer="asset_property_details">
                </div>
                <div class="col-md-2">
                    <label for="">Current value</label>
                    <input type="number" min="0" @if(isset($dont_have_doc[$item2->quote_additional_doc->id]) == true) disabled @else @endif class="form-control" wire:model.defer="asset_property_current_value">
                </div>

            </div>
            <div class="mt-2">
                <button wire:click.prevent="addPropertyAsset({{$p_counter}})" @if(isset($dont_have_doc[$item2->quote_additional_doc->id]) == true) disabled @else @endif class="btn btn-primary ">Add(+)</button>
            </div>    
        </div>
    </div>
    @foreach($property_asset_list as $key4 => $value4)
        <div class="col-md-12 px-0">
            <div class="container">
                <div class="row">
                    <div class="col-md-3">
                        <label for="">Insurance</label>
                        <input type="text" wire:model="property_asset_list.{{$key4}}.asset_property_type" readonly class="form-control">
                    </div>
                    <div class="col-md-3">
                        <label for="">Details</label>
                        <input type="text" wire:model="property_asset_list.{{$key4}}.asset_property_details" readonly class="form-control">
                    </div>
                    <div class="col-md-3">
                        <label for="">Current value</label>
                        <input type="text" wire:model="property_asset_list.{{$key4}}.asset_property_current_value" readonly class="form-control">
                    </div>
                    <div class="col-md-3 mt-2">
                        <button class="btn btn-danger btn-sm" wire:click.prevent="removePropertyAsset({{$key4}})">remove</button>
                    </div>
                </div>

            </div>
        </div>
    @endforeach

    {{-- ---------------------------------------------------------------- --}}
    <div class="col-md-12 px-0">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <label for="">Others</label>
                    <input type="text" @if(isset($dont_have_doc[$item2->quote_additional_doc->id]) == true) disabled  @endif class="form-control" wire:model.defer="asset_others_type">
                </div>
                <div class="col-md-3">
                    <label for="">Details</label>
                    <input type="text" @if(isset($dont_have_doc[$item2->quote_additional_doc->id]) == true) disabled @else @endif class="form-control" wire:model.defer="asset_others_details">
                </div>
                <div class="col-md-2">
                    <label for="">Current value</label>
                    <input type="number" min="0" @if(isset($dont_have_doc[$item2->quote_additional_doc->id]) == true) disabled @else @endif class="form-control" wire:model.defer="asset_others_current_value">
                </div>

            </div>
            <div class="mt-2">
                <button wire:click.prevent="addOthersAsset({{$o_counter}})" @if(isset($dont_have_doc[$item2->quote_additional_doc->id]) == true) disabled @else @endif class="btn btn-primary ">Add(+)</button>
            </div>    
        </div>
    </div>
    @foreach($others_asset_list as $key4 => $value4)
        <div class="col-md-12 px-0">
            <div class="container">
                <div class="row">
                    <div class="col-md-3">
                        <label for="">Insurance</label>
                        <input type="text" wire:model="others_asset_list.{{$key4}}.asset_others_type" readonly class="form-control">
                    </div>
                    <div class="col-md-3">
                        <label for="">Details</label>
                        <input type="text" wire:model="others_asset_list.{{$key4}}.asset_others_details" readonly class="form-control">
                    </div>
                    <div class="col-md-3">
                        <label for="">Current value</label>
                        <input type="text" wire:model="others_asset_list.{{$key4}}.asset_others_current_value" readonly class="form-control">
                    </div>
                    <div class="col-md-3 mt-2">
                        <button class="btn btn-danger btn-sm" wire:click.prevent="removeOthersAsset({{$key4}})">remove</button>
                    </div>
                </div>

            </div>
        </div>
    @endforeach