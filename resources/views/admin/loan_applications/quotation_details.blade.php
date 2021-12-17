<div class="container bg-white py-3 mt-5 info-container" style="border-radius: .7rem;">
    <div class="container-fluid mb-3" style="padding:0">
        <span class="navbar-brand">
            Quotation Details
        </span>
    </div>
        <div class="container">
            <div class="sumary-list same-gp">
                <span class="info__text">Quotation Date</span>
                <span class="info__field">{{ $application->application_quote->created_at }}</span>

                {{-- invoice financinng and purchase order financing quantum section details --}}
                @if (in_array($application->loan_type_id,[5,6]))
                    <span class="info__text">Facility Limit</span>
                    <span class="info__field">{{ $application->application_quote->quantum_interest->quantum }}</span>
                    <span class="info__text">Advance Percentage</span>
                    <span class="info__field">{{ $application->application_quote->quantum_interest->advance_percentage }}</span>
                    <span class="info__text">Notified</span>
                    <span class="info__field">{{ isNotified($application->application_quote->quantum_interest->is_notified) }}</span>
                    <span class="info__text">Interest calculated by</span>
                    <span class="info__field">{{ getInterestCalculatedBy($application->application_quote->quantum_interest->interest_calculated_by) }}</span>
                    <span class="info__text">Is Joint Account Required</span>
                    <span class="info__field">{{ isJointAccountRequired($application->application_quote->quantum_interest->is_joint_account_required) }}</span>
                    @if ($application->application_quote->quantum_interest->is_joint_account_required == 1)
                        <span class="info__text">Joint Account Days</span>
                        <span class="info__field">{{ $application->application_quote->quantum_interest->joint_account->joint_account_days }}</span>
                        <span class="info__text">Joint Account Cost</span>
                        <span class="info__field">{{ $application->application_quote->quantum_interest->joint_account->joint_account_cost_from }}
                            -
                            {{ $application->application_quote->quantum_interest->joint_account->joint_account_cost_to }}</span>
                    @endif

                @else

                    {{-- other loan types quantum section details --}}
                    <span class="info__text">Quantum</span>
                    <span class="info__field">{{ $application->application_quote->quantum_interest->quantum }}</span>
                    <span class="info__text">Fixed or floating</span>
                    <span class="info__field">{{ getFixedFloating($application->application_quote->quantum_interest->fixed_or_floating) }}</span>
                    
                    {{-- if fixed --}}
                    @if ($application->application_quote->quantum_interest->fixed_or_floating == 1)
                        <span class="info__text">Interest</span>
                        <span class="info__field">
                            @if ($application->application_quote->quantum_interest->fixed->interest->interest_pa != "")
                                {{$application->application_quote->quantum_interest->fixed->interest->interest_pa}}(pa)
                                @else
                                {{$application->application_quote->quantum_interest->fixed->interest->interest_pm}}(pm)
                            @endif
                        </span>

                        <span class="info__text">Tenure</span>
                        <span class="info__field">
                            {{ $application->application_quote->quantum_interest->fixed->tenure->years }} Years & 
                            {{ $application->application_quote->quantum_interest->fixed->tenure->months }} months
                        </span>

                        <span class="info__text">Lock in</span>
                        <span class="info__field">
                            {{ $application->application_quote->quantum_interest->fixed->lock_in->years }} Years & 
                            {{ $application->application_quote->quantum_interest->fixed->lock_in->months }} months
                        </span>

                        @else
                        <span class="info__text">Reference rate</span>
                        <span class="info__field">{{ $application->application_quote->quantum_interest->floating->reference_rate }}</span>
                        <span class="info__text">Other Reference rates</span>
                        <span class="info__field">{{ $application->application_quote->quantum_interest->floating->other_financial_rates }}</span>
                        <span class="info__text">Months if any</span>
                        <span class="info__field">{{ $application->application_quote->quantum_interest->floating->months_if_any }}</span>
                        <span class="info__text">Currency</span>
                        <span class="info__field">{{ $application->application_quote->quantum_interest->floating->currency }}</span>
                        <span class="info__text">Current value indicative</span>
                        <span class="info__field">{{ $application->application_quote->quantum_interest->floating->current_value_indicative }}</span>

                        @foreach ($application->application_quote->quantum_interest->floating->pa as $item)
                        <span class="info__text">Pa(From :{{$item->from_month}} to {{$item->to_month}} month)</span>
                        <span class="info__field">{{ $item->month_vise_pa }}</span>
                        @endforeach
                        <span class="info__text">Thereafter Pa</span>
                        <span class="info__field">{{ $application->application_quote->quantum_interest->floating->thereafter_pa }}</span>
                        {{-- <span class="info__text">Thereafter spread</span>
                        <span class="info__field">{{ $application->application_quote->quantum_interest->floating->thereafter_spread }}</span>
                        <span class="info__text">Thereafter spread pa</span>
                        <span class="info__field">{{ $application->application_quote->quantum_interest->floating->thereafter_spread_pa }}</span> --}}

                    @endif
                    {{-- if floating --}}

                

                @endif

                {{-- general info for all quotations --}}
                <span class="info__text">One Time Fee</span>
                @if ($application->application_quote->one_time_fee->flat_value != "")
                    <span class="info__field">${{ $application->application_quote->one_time_fee->flat_value }}</span>
                    @else
                    <span class="info__field">{{ $application->application_quote->one_time_fee->percentage }} %</span>
                @endif
                <span class="info__text">Monthly Fee</span>
                @if ($application->application_quote->monthly_fee->flat_value != "")
                    <span class="info__field">${{ $application->application_quote->monthly_fee->flat_value }}</span>
                    @else
                    <span class="info__field">{{ $application->application_quote->monthly_fee->percentage }} %</span>
                @endif
                <span class="info__text">Annual Fee</span>
                @if ($application->application_quote->annual_fee->flat_value != "")
                    <span class="info__field">${{ $application->application_quote->annual_fee->flat_value }}</span>
                    @else
                    <span class="info__field">{{ $application->application_quote->annual_fee->percentage }} %</span>
                @endif
                <span class="info__text">Legal Fee</span>
                <span class="info__field">
                    ${{ $application->application_quote->legal_fee->range_from }}-${{ $application->application_quote->legal_fee->range_to }}
                </span>

                <span class="info__text">If Insurance required</span>
                <span class="info__field">
                    @if ($application->application_quote->if_insurance_required->range_value_from != "")
                        
                    ${{ $application->application_quote->if_insurance_required->range_value_from."-$".$application->application_quote->if_insurance_required->range_value_to }}
                    @else
                    {{ $application->application_quote->if_insurance_required->range_percentage_from."%-".$application->application_quote->if_insurance_required->range_value_to."%" }}
                    @endif
                </span>

                <span class="info__text">Eir</span>
                @if ($application->application_quote->eir->pa_percentage != "")
                    <span class="info__field">{{ $application->application_quote->eir->pa_percentage }}(pa)</span>
                    @else
                    <span class="info__field">{{ $application->application_quote->eir->pm_percentage }} (pm)</span>
                @endif
                
                <span class="info__text">Repayment terms</span>
                <span class="info__field">{{ $application->application_quote->repayment->repayment_terms }}</span>
                <span class="info__text">Deffered after</span>
                <span class="info__field">{{ $application->application_quote->repayment->deffered_after }}</span>
                <span class="info__text">Balloon on</span>
                <span class="info__field">{{ $application->application_quote->repayment->balloon_on }}</span>
                <span class="info__text">Quote validity</span>
                <span class="info__field">{{ $application->application_quote->quote_validity }}</span>
                <span class="info__text">Remarks</span>
                <span class="info__field">{{ $application->application_quote->repayment->remarks }}</span>
                <span class="info__text">Personal notepad</span>
                <span class="info__field">{{ $application->application_quote->repayment->personal_notepad }}</span>
                {{-- ============================= --}}

            </div>
        </div>
    </div>
</div>