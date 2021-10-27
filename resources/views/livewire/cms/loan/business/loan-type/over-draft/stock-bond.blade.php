<section>

    <div class="row">
        <div class="col-md-6" style="margin-top: 30px;">
            <livewire:widget.currency/>
            @error("currency")
            <div style="color: red;">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="col-md-6" style="margin-top: 30px;">
            <label for="total_indicative_value" class="form-label">Total Indicative Value
            </label>
            <input wire:model="total_indicative_value" type="number" class="form-control" id="total_indicative_value">
            @error("total_indicative_value")
            <div style="color: red;">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="col-md-6" style="margin-top: 30px;">
            <label for="indicative_bid_price" class="form-label">Current Indicative Bid Price
            </label>
            <input wire:model="indicative_bid_price" type="number" class="form-control" id="indicative_bid_price">
            @error("indicative_bid_price")
            <div style="color: red;">
                {{ $message }}
            </div>
            @enderror
        </div>
     
        <div class="col-md-6" style="margin-top: 30px;">
            <label for="company_purchased" class="form-label">Company purchased from

            </label>
            <select class="form-select" wire:model="company_purchased">
                <option value="">Select Company</option>
                @foreach($financePartners as $item)
                <option value="{{ $item->id }}">{{ $item->name }}</option>
                @endforeach
            </select>
            @error("company_purchased")
            <div style="color: red;">
                {{ $message }}
            </div>
            @enderror
        </div>
        
        <div class="col-md-6" style="margin-top: 30px;">
            <label for="name" class="form-label">
                Please Specify  @if($tab == 4)Bond Name @else Stock Name Or Code @endif  
            </label>
            <div class="input-form mb-3">
                <input wire:model="name" type="text" class="form-control" aria-label="name"
                    aria-describedby="basic-addon2">
                    @if($tab == 4)
                    <span>e..g TESLA 2021 CV

                    </span>
                    @endif
            </div>
            @error("name")
            <div style="color: red;">
                Field Is Required
            </div>
            @enderror
        </div>
      
    </div>
    <div class="row">
        <div class="col-md-12">
            <br>
            <br>
            <button class="btn" wire:click="store">
                @if($tab==4)Add @if($stockBonds->count() > 0)Another @endif Bond @endif
                @if($tab==3)Add @if($stockBonds->count() > 0)Another @endif Stock @endif
            </button>
            <button class="btn" wire:click="store">Submit</button>
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
                        <th scope="col">Currency</th>
                        <th scope="col">Total Indicative Value</th>
                        <th scope="col">Indicative Bid Price</th>
                        <th scope="col">Company </th>
                        @if($tab == 3 )
                        <th scope="col">Stock Name Or Code </th>
                        @elseif($tab == 4)
                        <th scope="col">Bond Name  </th>
                        @endif
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($stockBonds as $item)
                    <tr>
                        <th scope="row">1</th>
                        <td>{{ $item->currency }}</td>
                        <td>{{ $item->total_indicative_value }}</td>
                        <td>{{ $item->indicative_bid_price }}</td>
                        <td>{{ $item->company_purchased }}</td>
                        <td>{{ $item->name }}</td>
                       
                        <td><button wire:click="deleteRecord({{ $item->id }})" style="background: red;"
                                class="btn">Delete</button></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</section>
