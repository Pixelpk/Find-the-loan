<section>

    <div class="row mt-4">
        <div class="col-md-6">
           <div class="mb-3">
            <livewire:widget.currency/>
            @error("currency")
            <div style="color: red;">
                {{ $message }}
            </div>
            @enderror
           </div>
        </div>
        <div class="col-md-6">
         <div class="mb-3">
            <label for="deposit_amount" class="form-label">Deposit Amount
            </label>
            <input wire:model="deposit_amount" type="number" class="form-control" id="deposit_amount">
            @error("deposit_amount")
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
            <label for="deposit_ac_number" class="form-label">Deposit A/c Number
            </label>
            <input wire:model="deposit_ac_number" type="number" class="form-control" id="deposit_ac_number">
            @error("deposit_ac_number")
            <div style="color: red;">
                {{ $message }}
            </div>
            @enderror
           </div>
        </div>
        <div class="col-md-6">
           <div class="mb-3">
            <label for="bank" class="form-label">Company purchased from
            </label>
            <select class="form-select" wire:model="bank">
                <option value="">Select Bank</option>
                <optgroup label="Local Bank">
                    @foreach(Config::get('gernalinfo.bank.local_bank') as $item)
                    <option value="{{ $item }}">{{ $item }}</option>
                    @endforeach
                </optgroup>
                <optgroup label="Foreign Bank">
                    @foreach(Config::get('gernalinfo.bank.foreign_bank') as $item)
                    <option value="{{ $item }}">{{ $item }}</option>
                    @endforeach
                </optgroup>
                <optgroup label="Other Bank">
                    <option value="other">Other</option>
                </optgroup>
            </select>
            @error("bank")
            <div style="color: red;">
                {{ $message }}
            </div>
            @enderror
           </div>
        </div>
    </div>

    <div class="row mt-2">
        @if($bank == 'other')
        <div class="col-md 6">
            
        </div>
        <div class="col-md-6">
           <div class="mb-3">
            <label for="other_bank_name" class="form-label">
                Bank Name
            </label>
            <div class="input-form mb-3">
                <input wire:model="other_bank_name" type="text" class="form-control" aria-label="other_bank_name"
                    aria-describedby="basic-addon2">

            </div>
            @error("other_bank_name")
            <div style="color: red;">
                {{ $message }}
            </div>
            @enderror
           </div>
        </div>
        @endif
        @if($tab == 6)
        <div class="col-md-6">
           <div class="mb-3">
            <label for="tranche" class="form-label">
                For Structured Deposit, please specify name & tranche:
            </label>
            <div class="input-form">
                <input wire:model="tranche" type="text" class="form-control" aria-label="tranche"
                    aria-describedby="basic-addon2">
                    <!-- <span> e.g. SG growth 50 Tranche A</span> -->
            </div>
            @error("tranche")
            <div style="color: red;">
                {{ $message }}
            </div>
            @enderror
           </div>
        </div>
        @endif
        @if($tab == 8 || $tab == 6)
        <div class="col-md-6">
           <div class="mb-3">
            <label for="fd_sd" class="form-label">
                For FD and SD please state Maturity date
            </label>
            <div class="input-form mb-3">
                <input wire:model="fd_sd" type="date" class="form-control" aria-label="fd_sd"
                    aria-describedby="basic-addon2">
            </div>
            @error("fd_sd")
            <div style="color: red;">
                {{ $message }}
            </div>
            @enderror
           </div>
        </div>
        
        @endif
    </div>

    
        
    

    <div class="row mt-2">
        <div class="col-md-12">
            <button class="btn" wire:click="store">Add @if($Deposits->count() > 0)Another @endif Deposit</button>
            {{-- <button class="btn" wire:click="store">Submit</button> --}}
        </div>
    </div>

    <div class="row mt-3">
        <div class="col-md-12">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Currency</th>
                        <th scope="col">Deposit Amount</th>
                        <th scope="col">Deposit A/c Number</th>
                        <th scope="col">Bank</th>
                        <th scope="col">For Structured</th>
                        <th scope="col">For FD and SD</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($Deposits as $item)
                    <tr>
                        <th scope="row">1</th>
                        <td>{{ $item->currency }}</td>
                        <td>{{ $item->deposit_amount }}</td>
                        <td>{{ $item->deposit_ac_number }}</td>
                        <td>
                            @if($item->bank == 'other')
                            {{ $item->other_bank }}
                            @else
                            {{ $item->bank }}
                            @endif
                        </td>
                        <td>{{ $item->tranche }}</td>
                        <td>{{ $item->fd_sd }}</td>
                        <td><button wire:click="deleteRecord({{ $item->id }})" style="background: red;"
                                class="btn">Delete</button></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</section>
