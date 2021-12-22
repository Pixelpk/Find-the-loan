<div class="col-md-12  mt-2 mb-2">
    <div class="container">
        <h6>
            Local assets such as Investment, Life Insurance, Property, if any
        </h6>
        <input type="checkbox" id="{{$item2->quote_additional_doc->id}}" wire:change="chk({{$item2->quote_additional_doc->id}})" wire:model="dont_have_doc.{{$item2->quote_additional_doc->id}}" class="mr-2"><label for="{{$item2->quote_additional_doc->id}}">Don't have this?</label>
        
        <div class="row align-items-end">
            <div class="col-md-2">
                <label for="">Insurance</label>
                <select @if(isset($dont_have_doc[$item2->quote_additional_doc->id]) == true) disabled  @endif class="form-control @error('insurance_type') is-invalid @enderror" wire:model.defer="insurance_type">
                    <option value="Regular Premium">Regular Premium</option>
                    <option value="Single Premium">Single Premium</option>
                    <option value="Endownment/Savings">Endownment/Savings</option>
                    <option value="Universal Life">Universal Life</option>
                </select>
                
            </div>
            <div class="col-md-3">
                <label for="">Details</label>
                <input type="text" @if(isset($dont_have_doc[$item2->quote_additional_doc->id]) == true) disabled @else @endif class="form-control @error('insurance_details') is-invalid @enderror" wire:model.defer="insurance_details">
            </div>
            <div class="col-md-2">
                <label for="">Current value</label>
                <input type="number" min="0" @if(isset($dont_have_doc[$item2->quote_additional_doc->id]) == true) disabled @else @endif class="form-control @error('insurance_current_value') is-invalid @enderror" wire:model.defer="insurance_current_value">
            </div>
            <div class="col-md-2">
                <label for="">Maturity Date</label>
                <input type="date" @if(isset($dont_have_doc[$item2->quote_additional_doc->id]) == true) disabled @else @endif class="form-control @error('insurance_maturity_date') is-invalid @enderror" wire:model.defer="insurance_maturity_date">

            </div>
            <div class="col-md-2">
                <label for="">Year Purchased</label>
                <input type="number" min="0" @if(isset($dont_have_doc[$item2->quote_additional_doc->id]) == true) disabled @else @endif class="form-control @error('insurance_year_purchased') is-invalid @enderror" wire:model.defer="insurance_year_purchased">

            </div>

            <div class="col-md-1">
                <button wire:click.prevent="addInsuranceAsset({{$insurance_counter}})" @if(isset($dont_have_doc[$item2->quote_additional_doc->id]) == true) disabled @else @endif class="btn btn-primary ">Add(+)</button>
            </div>    
        </div>
    </div>
</div>
@if (count($insurance_asset_list) > 0)
<div class="col-md-12 ">
    <div class="card">
        <div class="card-body">
                <div class="table-rep-plugin">
                    <div class="table-responsive b-0" data-pattern="priority-columns">
                        <table id="" class="table  table-striped">
                            <thead>
                                <tr>
                                    <th>Insurance</th>
                                    <th>Details</th>
                                    <th>Current value</th>
                                    <th>Maturity Date</th>
                                    <th>Year Purchased</th>
                                    <th>Remove</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($insurance_asset_list as $key => $value)
                                <tr>
                                    <td>{{ $value['insurance_type'] }}</td>
                                    <td>{{ $value['insurance_details'] }}</td>
                                    <td>{{ $value['insurance_current_value'] }}</td>
                                    <td>{{ $value['insurance_maturity_date'] }}</td>
                                    <td>{{ $value['insurance_year_purchased'] }}</td>
                                    <td><button class="btn btn-danger btn-sm" wire:click.prevent="removeInsuranceAsset({{$key}})">remove</button></td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
    </div>
</div>
<hr>
@endif


    {{-- ---------------------------------------------------------------- --}}
    <div class="col-md-12 ">
        <div class="container">
            <div class="row align-items-end">
                <div class="col-md-4">
                    <label for="">Investment</label>
                    <select @if(isset($dont_have_doc[$item2->quote_additional_doc->id]) == true) disabled  @endif class="form-control @error('investment_type') is-invalid @enderror" wire:model.defer="investment_type">
                        <option value="Unit Trust">Unit Trust</option>
                        <option value="Reits">Reits</option>
                        <option value="Stocks">Stocks</option>
                        <option value="Others">Others</option>
                    </select>

                </div>
                <div class="col-md-4">
                    <label for="">Details</label>
                    <input type="text" @if(isset($dont_have_doc[$item2->quote_additional_doc->id]) == true) disabled @else @endif class="form-control @error('investment_details') is-invalid @enderror" wire:model.defer="investment_details">

                </div>
                <div class="col-md-3">
                    <label for="">Current value</label>
                    <input type="number" min="0" @if(isset($dont_have_doc[$item2->quote_additional_doc->id]) == true) disabled @else @endif class="form-control @error('investment_current_value') is-invalid @enderror" wire:model.defer="investment_current_value">

                </div>
                <div class="col-md-1">
                    <button wire:click.prevent="addInvestmentAsset({{$investment_counter}})" @if(isset($dont_have_doc[$item2->quote_additional_doc->id]) == true) disabled @else @endif class="btn btn-primary ">Add(+)</button>
                </div>
            </div>
            
        </div>
    </div>
    @if (count($investment_asset_list) > 0)
    <div class="col-md-12 ">
        <div class="card">
            <div class="card-body">
                    <div class="table-rep-plugin">
                        <div class="table-responsive b-0" data-pattern="priority-columns">
                            <table id="" class="table  table-striped">
                                <thead>
                                    <tr>
                                        <th>Insurance</th>
                                        <th>Details</th>
                                        <th>Current value</th>
                                        <th>Remove</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($investment_asset_list as $key => $value)
                                    <tr>
                                        <td>{{ $value['investment_type'] }}</td>
                                        <td>{{ $value['investment_details'] }}</td>
                                        <td>{{ $value['investment_current_value'] }}</td>
                                        <td><button class="btn btn-danger btn-sm" wire:click.prevent="removeInvestmentAsset({{$key}})">remove</button></td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
        </div>
    </div>
    <hr>
    @endif

    {{-- ---------------------------------------------------------------- --}}
    <div class="col-md-12 ">
        <div class="container">
            <div class="row align-items-end">
                <div class="col-md-4">
                    <label for="">Cash & Deposit</label>
                    <select @if(isset($dont_have_doc[$item2->quote_additional_doc->id]) == true) disabled  @endif class="form-control @error('cash_and_deposit_type') is-invalid @enderror" wire:model.defer="cash_and_deposit_type">
                        
                    </select>

                </div>
                <div class="col-md-4">
                    <label for="">Details</label>
                    <input type="text" @if(isset($dont_have_doc[$item2->quote_additional_doc->id]) == true) disabled @else @endif class="form-control @error('cash_and_deposit_details') is-invalid @enderror" wire:model.defer="cash_and_deposit_details">
                </div>
                <div class="col-md-3">
                    <label for="">Current value</label>
                    <input type="number" min="0" @if(isset($dont_have_doc[$item2->quote_additional_doc->id]) == true) disabled @else @endif class="form-control @error('cash_and_deposit_current_value') is-invalid @enderror" wire:model.defer="cash_and_deposit_current_value">
                </div>
                <div class="col-md-1">
                    <button wire:click.prevent="addCashDepositAsset({{$cd_counter}})" @if(isset($dont_have_doc[$item2->quote_additional_doc->id]) == true) disabled @else @endif class="btn btn-primary ">Add(+)</button>
                </div>    

            </div>
        </div>
    </div>
    @if (count($cash_and_deposit_asset_list) > 0)
    <div class="col-md-12 ">
        <div class="card">
            <div class="card-body">
                    <div class="table-rep-plugin">
                        <div class="table-responsive b-0" data-pattern="priority-columns">
                            <table id="" class="table  table-striped">
                                <thead>
                                    <tr>
                                        <th>Insurance</th>
                                        <th>Details</th>
                                        <th>Current value</th>
                                        <th>Remove</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($cash_and_deposit_asset_list as $key => $value)
                                    <tr>
                                        <td>{{ $value['cash_and_deposit_type'] }}</td>
                                        <td>{{ $value['cash_and_deposit_details'] }}</td>
                                        <td>{{ $value['cash_and_deposit_current_value'] }}</td>
                                        <td><button class="btn btn-danger btn-sm" wire:click.prevent="removeCashDepositAsset({{$key}})">remove</button></td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
        </div>
    </div>
    <hr>
    @endif

    
    {{-- ---------------------------------------------------------------- --}}
    <div class="col-md-12 ">
        <div class="container">
            <div class="row align-items-end">
                <div class="col-md-4">
                    <label for="">Property</label>
                    <select @if(isset($dont_have_doc[$item2->quote_additional_doc->id]) == true) disabled  @endif class="form-control @error('asset_property_type') is-invalid @enderror" wire:model.defer="asset_property_type">
                        <option value="Main resident">Main resident</option>
                        <option value="Commerical property">Commerical property</option>
                        <option value="Residential property">Residential property</option>
                        <option value="Rental">Rental</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label for="">Details</label>
                    <input type="text" @if(isset($dont_have_doc[$item2->quote_additional_doc->id]) == true) disabled @else @endif class="form-control @error('asset_property_details') is-invalid @enderror" wire:model.defer="asset_property_details">
                </div>
                <div class="col-md-3">
                    <label for="">Current value</label>
                    <input type="number" min="0" @if(isset($dont_have_doc[$item2->quote_additional_doc->id]) == true) disabled @else @endif class="form-control @error('asset_property_current_value') is-invalid @enderror" wire:model.defer="asset_property_current_value">
                </div>
                <div class="col-md-1">
                    <button wire:click.prevent="addPropertyAsset({{$p_counter}})" @if(isset($dont_have_doc[$item2->quote_additional_doc->id]) == true) disabled @else @endif class="btn btn-primary ">Add(+)</button>
                </div>

            </div>
        </div>
    </div>
    @if (count($property_asset_list) > 0)
    <div class="col-md-12 ">
        <div class="card">
            <div class="card-body">
                    <div class="table-rep-plugin">
                        <div class="table-responsive b-0" data-pattern="priority-columns">
                            <table id="" class="table  table-striped">
                                <thead>
                                    <tr>
                                        <th>Insurance</th>
                                        <th>Details</th>
                                        <th>Current value</th>
                                        <th>Remove</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($property_asset_list as $key => $value)
                                    <tr>
                                        <td>{{ $value['asset_property_type'] }}</td>
                                        <td>{{ $value['asset_property_details'] }}</td>
                                        <td>{{ $value['asset_property_current_value'] }}</td>
                                        <td><button class="btn btn-danger btn-sm" wire:click.prevent="removePropertyAsset({{$key}})">remove</button></td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
        </div>
    </div>
    <hr>
    @endif


    {{-- ---------------------------------------------------------------- --}}
    <div class="col-md-12 ">
        <div class="container">
            <div class="row align-items-end">
                <div class="col-md-4">
                    <label for="">Others</label>
                    <input type="text" @if(isset($dont_have_doc[$item2->quote_additional_doc->id]) == true) disabled  @endif class="form-control @error('asset_others_type') is-invalid @enderror" wire:model.defer="asset_others_type">
                </div>
                <div class="col-md-4">
                    <label for="">Details</label>
                    <input type="text" @if(isset($dont_have_doc[$item2->quote_additional_doc->id]) == true) disabled @else @endif class="form-control @error('asset_others_details') is-invalid @enderror" wire:model.defer="asset_others_details">

                </div>
                <div class="col-md-3">
                    <label for="">Current value</label>
                    <input type="number" min="0" @if(isset($dont_have_doc[$item2->quote_additional_doc->id]) == true) disabled @else @endif class="form-control @error('asset_others_current_value') is-invalid @enderror" wire:model.defer="asset_others_current_value">
                </div>

                <div class="col-md-1">
                    <button wire:click.prevent="addOthersAsset({{$o_counter}})" @if(isset($dont_have_doc[$item2->quote_additional_doc->id]) == true) disabled @else @endif class="btn btn-primary ">Add(+)</button>
                </div>    
            </div>
        </div>
    </div>
    @if (count($others_asset_list) > 0)
    <div class="col-md-12 ">
        <div class="card">
            <div class="card-body">
                    <div class="table-rep-plugin">
                        <div class="table-responsive b-0" data-pattern="priority-columns">
                            <table id="" class="table  table-striped">
                                <thead>
                                    <tr>
                                        <th>Insurance</th>
                                        <th>Details</th>
                                        <th>Current value</th>
                                        <th>Remove</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($others_asset_list as $key => $value)
                                    <tr>
                                        <td>{{ $value['asset_others_type'] }}</td>
                                        <td>{{ $value['asset_others_details'] }}</td>
                                        <td>{{ $value['asset_others_current_value'] }}</td>
                                        <td><button class="btn btn-danger btn-sm" wire:click.prevent="removeOthersAsset({{$key}})">remove</button></td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
        </div>
    </div>
    <hr>
    @endif
