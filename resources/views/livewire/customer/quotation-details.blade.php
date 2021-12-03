<div>
    <div class="content-page">
        <!-- Start content -->
        <div class="content">
    
            <div class="container-fluid">
                <div class="page-title-box">
    
                    <div class="row align-items-center ">
                        <div class="col-md-10">
                            <div class="page-title-box">
                                <h4 class="page-title">Quotation details</h4>
                            </div>
                        </div>
                        <div class="col-md-2">
                            {{-- href="{{ route('proceed-with-quotation',['quote_id'=>$quotation_details->id]) }}" --}}
                            @if ($quotation_details->status != '1')
                                <a wire:click="proceedAlert()" data-toggle="tooltip"
                                data-original-title="" class="btn btn-primary"
                                    aria-current="page">
                                    Proceed
                                </a>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="container py-3 info-container">
                    <div class="container">
                        
                        <div class="row">
                            <div class="col-md-3">
                                <h6>Quotation Date:</h6>
                                <span>{{ $quotation_details->created_at }}</span>
                            </div>
                            @if (in_array($quotation_details->loan_application->loan_type_id,[5,6]))
                                <div class="col-md-3">
                                    <h6>Facility Limit</h6>
                                    <span>32-12-32132</span>
                                </div>
                                <div class="col-md-3">
                                    <h6>Advance Percentage</h6>
                                    <span>{{ $quotation_details->quantum_interest->advance_percentage }}</span>
                                </div>
                                <div class="col-md-3">
                                    <h6>Notified</h6>
                                    <span>{{ isNotified($quotation_details->quantum_interest->is_notified) }}</span>
                                </div>
                                <div class="col-md-3">
                                    <h6>Interest calculated by</h6>
                                    <span>{{ getInterestCalculatedBy($quotation_details->quantum_interest->interest_calculated_by) }}</span>
                                </div>
                                <div class="col-md-3">
                                    <h6>Is Joint Account Required</h6>
                                    <span>{{ isJointAccountRequired($quotation_details->quantum_interest->is_joint_account_required) }}</span>
                                </div>


                                @if ($quotation_details->quantum_interest->is_joint_account_required == 1)
                                <div class="col-md-3">
                                    <h6>Joint Account Days</h6>
                                    <span>{{ $quotation_details->quantum_interest->joint_account->joint_account_days }}</span>
                                </div>
                                <div class="col-md-3">
                                    <h6>Joint Account Cost</h6>
                                    <span>
                                        {{ $quotation_details->quantum_interest->joint_account->joint_account_cost_from }}
                                        -
                                        {{ $quotation_details->quantum_interest->joint_account->joint_account_cost_to }}
                                    </span>
                                </div>

                                @endif

                            @else

                                {{-- other loan types quantum section details --}}
                                <div class="col-md-3">
                                    <h6>Quantum</h6>
                                    <span>{{ $quotation_details->quantum_interest->quantum }}</span>
                                </div>
                                <div class="col-md-3">
                                    <h6>Fixed or floating</h6>
                                    <span>{{ getFixedFloating($quotation_details->quantum_interest->fixed_or_floating) }}</span>
                                </div>
                            
                                {{-- if fixed --}}
                                @if ($quotation_details->quantum_interest->fixed_or_floating == 1)
                                    <div class="col-md-3">
                                        <h6>Interest</h6>
                                        <span> 
                                            @if ($quotation_details->quantum_interest->fixed->interest->interest_pa != "")
                                            {{$quotation_details->quantum_interest->fixed->interest->interest_pa}}(pa)
                                            @else
                                            {{$quotation_details->quantum_interest->fixed->interest->interest_pm}}(pm)
                                            @endif
                                        </span>
                                    </div>

                                    <div class="col-md-3">
                                        <h6>Tenure</h6>
                                        <span> 
                                            {{ $quotation_details->quantum_interest->fixed->tenure->years }} Years & 
                                            {{ $quotation_details->quantum_interest->fixed->tenure->months }} months
                                        </span>
                                    </div>

                                    <div class="col-md-3">
                                        <h6>Lock in</h6>
                                        <span> 
                                            {{ $quotation_details->quantum_interest->fixed->lock_in->years }} Years & 
                                        {{ $quotation_details->quantum_interest->fixed->lock_in->months }} months
                                        </span>
                                    </div>


                                    @else
                                    <div class="col-md-3">
                                        <h6>Reference rate</h6>
                                        <span>{{ $quotation_details->quantum_interest->floating->reference_rate }}</span>
                                    </div>

                                    <div class="col-md-3">
                                        <h6>Other Reference rates</h6>
                                        <span>{{ $quotation_details->quantum_interest->floating->other_financial_rates }} </span>
                                    </div>

                                    <div class="col-md-3">
                                        <h6>Months if any</h6>
                                        <span>{{ $quotation_details->quantum_interest->floating->months_if_any }}</span>
                                    </div>
                                    <div class="col-md-3">
                                        <h6>Currency</h6>
                                        <span>{{ $quotation_details->quantum_interest->floating->currency }}</span>
                                    </div>
                                    <div class="col-md-3">
                                        <h6>Current value indicative</h6>
                                        <span>{{ $quotation_details->quantum_interest->floating->current_value_indicative }} </span>
                                    </div>

                                    @foreach ($quotation_details->quantum_interest->floating->pa as $item)
                                        <div class="col-md-3">
                                            <h6>Pa(From :{{$item->from_month}} to {{$item->to_month}} month)</h6>
                                            <span>{{ $item->month_vise_pa }}</span>
                                        </div>
                                    @endforeach
                                    <div class="col-md-3">
                                        <h6>Thereafter Pa</h6>
                                        <span>{{ $quotation_details->quantum_interest->floating->thereafter_pa }}</span>
                                    </div>
                                    

                                @endif
                            {{-- if floating --}}
                            @endif

                            {{-- general info for all quotations --}}
                            <div class="col-md-3">
                                <h6>One Time Fee</h6>
                                <span>
                                    @if ($quotation_details->one_time_fee->flat_value != "")
                                        ${{ $quotation_details->one_time_fee->flat_value }}
                                    @else
                                        {{ $quotation_details->one_time_fee->percentage }} %
                                    @endif
                                </span>
                            </div>
                            <div class="col-md-3">
                                <h6>Monthly Fee</h6>
                                <span>
                                    @if ($quotation_details->monthly_fee->flat_value != "")
                                    ${{ $quotation_details->monthly_fee->flat_value }}
                                    @else
                                        {{ $quotation_details->monthly_fee->percentage }} %
                                    @endif
                                </span>
                            </div>
                            <div class="col-md-3">
                                <h6>Annual Fee</h6>
                                <span>
                                    @if ($quotation_details->annual_fee->flat_value != "")
                                    ${{ $quotation_details->annual_fee->flat_value }}
                                    @else
                                    {{ $quotation_details->annual_fee->percentage }} %
                                    @endif
                                </span>
                            </div>
                            <div class="col-md-3">
                                <h6>Legal Fee</h6>
                                <span>
                                    ${{ $quotation_details->legal_fee->range_from }}-${{ $quotation_details->legal_fee->range_to }}
                                </span>
                            </div>
                            <div class="col-md-3">
                                <h6>If Insurance required</h6>
                                <span>
                                    ${{ $quotation_details->if_insurance_required->range_value_from }}
                                    or
                                    {{ $quotation_details->if_insurance_required->range_percentage_from }}%
                                </span>
                            </div>
                            <div class="col-md-3">
                                <h6>Eir</h6>
                                <span>
                                    @if ($quotation_details->eir->pa_percentage != "")
                                    {{ $quotation_details->eir->pa_percentage }}(pa)
                                    @else 
                                    {{ $quotation_details->eir->pm_percentage }} (pm)
                                    @endif
                                </span>
                            </div>
                            <div class="col-md-3">
                                <h6>Repayment terms</h6>
                                <span>
                                    {{ $quotation_details->repayment->repayment_terms }}
                                </span>
                            </div>
                            <div class="col-md-3">
                                <h6>Deffered after</h6>
                                <span>
                                    {{ $quotation_details->repayment->deffered_after }}
                                </span>
                            </div>
                            <div class="col-md-3">
                                <h6>Balloon on</h6>
                                <span>
                                    {{ $quotation_details->repayment->balloon_on }}
                                </span>
                            </div>
                            <div class="col-md-3">
                                <h6>Quote validity</h6>
                                <span>
                                    {{ $quotation_details->quote_validity }}
                                </span>
                            </div>
                            {{-- <div class="col-md-3">
                                <h6>Remarks</h6>
                                <span>
                                    {{ $quotation_details->repayment->remarks }}
                                </span>
                            </div> --}}

                        </div>
                        <hr>

                    </div>
                </div>
    
    
        @include('admin.pages.footer')
        <script>
            window.addEventListener('proceed_with_quotation', event => {
                Swal.fire({
                    title: event.detail.message,
                    showDenyButton: true,
                    showCancelButton: true,
                    confirmButtonColor: 'rgb(221, 51, 51)',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Proceed',
                }).then((result) => {
                    /* Read more about isConfirmed, isDenied below */
                    if (result.value) {
                        // calling destroy method to delete
                        @this.call(event.detail.function)
                        // success response
    
                    } else {
    
                    }
                })
            })
    
        </script>
    </div>
</div>