{{-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
	Open Form
</button> --}}

<!-- Modal -->
<div wire:ignore.self class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Please Select Reason</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true close-btn">×</span>
                </button>
            </div>
           <div class="modal-body">
                <form>

                    <div class="row g-3">
                        <div class="col-md-12">
                            <label for="no_loan_reason">Select Reason</label>
                            <select wire:model="no_loan_reason" id="no_loan_reason" class="form-control" aria-label="Default select example">
                                <option value="">Select Reason</option>
                                <option value="Found Better Offer">Found Better Offer</option>
                                <option value="No Longer Required">No Longer Required</option>
                                <option value="Other">Other</option>
                            </select>
                            @error("no_loan_reason")
                                <div style="color: red;">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                    @if($no_loan_reason == 'Other')
                    <div class="row mt-3">
                        <div class="col-md-12">
                            <label for="no_loan_reason_ellaborate" class="form-label">Please Elaborate
                            </label>
                            <input wire:model="no_loan_reason_ellaborate" type="text" class="form-control" id="no_loan_reason_ellaborate">
                            @error("no_loan_reason_ellaborate")
                                <div style="color: red;">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    @endif

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" wire:click.prevent="loanNoLongerRequiredReason()" class="btn btn-primary close-modal">Save</button>
                <button type="button" class="btn btn-secondary close-btn c-cancel-btn" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
