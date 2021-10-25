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
            <label for="indicative_nav" class="form-label">indicative NAV
            </label>
            <input wire:model="indicative_nav" type="text" class="form-control" id="indicative_nav">
            @error("indicative_nav")
            <div style="color: red;">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="col-md-6" style="margin-top: 30px;">
            <label for="deposit_ac_number" class="form-label">Deposit A/c Number
            </label>
            <input wire:model="deposit_ac_number" type="number" class="form-control" id="deposit_ac_number">
            @error("deposit_ac_number")
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
            <label for="fund_name" class="form-label">
                Please specify fund name
            </label>
            <div class="input-form mb-3">
                <input wire:model="fund_name" type="text" class="form-control" aria-label="fund_name"
                    aria-describedby="basic-addon2">
                    <span> e.g. SG equity fund
                    </span>
            </div>
            @error("fund_name")
            <div style="color: red;">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="col-md-6" style="margin-top: 10px;">
            <label for="fd_sd" class="form-label">
                For FD and SD please state Maturity Date

            </label>
            <div class="input-form mb-3">
                <input wire:model="fd_sd_date" type="date" class="form-control" aria-label="fd_sd_date"
                    aria-describedby="basic-addon2">
            </div>
            @error("fd_sd_date")
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
            <button class="btn" wire:click="store">Add @if($trustFunds->count() > 0)Another @endif Unit Trust/Fund</button>
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
                        <th scope="col">indicative NAV</th>
                        <th scope="col">Deposit A/c Number</th>
                        
                        <th scope="col">Company </th>
                        <th scope="col">Fund Name </th>
                        <th scope="col">For FD and SD</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($trustFunds as $item)
                    <tr>
                        <th scope="row">1</th>
                        <td>{{ $item->currency }}</td>
                        <td>{{ $item->total_indicative_value }}</td>
                        <td>{{ $item->indicative_nav }}</td>
                        
                        <td>{{ $item->deposit_ac_number }}</td>
                        <td>{{ $item->company_purchased }}</td>
                        <td>{{ $item->fund_name }}</td>
                        <td>{{ $item->fd_sd_date }}</td>
                        <td><button wire:click="deleteRecord({{ $item->id }})" style="background: red;"
                                class="btn">Delete</button></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</section>
