@extends('admin.layouts.master')
@section('content')
    <div class="content-page">

        <div class="content">

            <div class="container-fluid">
                <div class="page-title-box">

                    <div class="row align-items-center ">
                        <div class="col-md-12">
                            <div class="page-title-box">
                                <h4 class="page-title">Quoted customer</h4>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="table-rep-plugin">
                                    <div class="b-0" data-pattern="priority-columns">
                                        <table id="loan_application_table" class="table  table-striped">
                                            <thead>
                                            <tr>
                                                <th>Enquiry Id</th>
                                                <th>Profile</th>
                                                <th>Loan type</th>
                                                <th>Customer name</th>
                                                <th>Quotation Date</th>
                                                <th>Quantum</th>
                                                <th>Interest % p.a</th>
                                                <th>Tenure</th>
                                                <th>Min Tenure</th>
                                                <th>Lock-in</th>
                                                <th>Monthly repayment terms</th>
                                                <th>Processing fee</th>
                                                <th>Legal Fee</th>
                                                <th>Other application Fee</th>
                                                <th>Floating/<br>Fixed</th>
                                                <th>Quoted validity</th>
                                                <th>Reason</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($quotations as $quote)
                                            <tr class="loan_application_row" url="{{ route('loan-application-summary',['apply_loan_id'=>$quote->loan_application->id]) }}"  style="cursor: pointer" title="Show summary">
                                                <td>{{ $quote->loan_application->enquiry_id }}</td>
                                                <td>{{ getProfile($quote->loan_application->profile) }}</td>
                                                <td>{{ $quote->loan_application->loan_type->sub_type }}</td>
                                                <td>{{ $quote->loan_application->loan_user->first_name." ".$quote->loan_application->loan_user->last_name }}</td>
                                                <td>{{ $quote->created_at }}</td>
                                                <td>{{ $quote->quantum_interest->quantum ?? "" }}</td>
                                                    <td>
                                                        @isset($quote->quantum_interest->fixed_or_floating)
                                                            @if($quote->quantum_interest->fixed_or_floating == '1')
                                                                {{ $quote->quantum_interest->fixed->interest->interest_pa."%" }}
                                                            @endif
                                                        @endisset
                                                    </td>
                                                    <td>
                                                        @isset($quote->quantum_interest->fixed_or_floating)
                                                        @if($quote->quantum_interest->fixed_or_floating == '1')
                                                            {{ $quote->quantum_interest->fixed->tenure->years." Years ".$quote->quantum_interest->fixed->tenure->months." Months" }}
                                                        @endif
                                                        @endisset
                                                    </td>
                                                    <td></td>
                                                    <td>
                                                        @isset($quote->quantum_interest->fixed_or_floating)
                                                            @if($quote->quantum_interest->fixed_or_floating == '1')
                                                                {{ $quote->quantum_interest->fixed->lock_in->years." Years ".$quote->quantum_interest->fixed->lock_in->months." Months" }}
                                                            @endif
                                                        @endisset
                                                    </td>
                                                    <td>{{ $quote->repayment->repayment_terms ?? "" }}</td>
                                                    <td>
                                                        @if ($quote->one_time_fee->flat_value != "")
                                                        {{ "$".$quote->one_time_fee->flat_value}}
                                                        @else
                                                        {{ $quote->one_time_fee->percentage." %"}}
                                                        @endif
                                                    </td>
                                                    <td>{{ $quote->legal_fee->range_from."-".$quote->legal_fee->range_to }}</td>
                                                    <td>
                                                        @isset($quote->one_time_fee->flat_value)
                                                            @if($quote->one_time_fee->flat_value != '')
                                                                One time fee: {{$quote->one_time_fee->flat_value}}
                                                            @endif
                                                        @endisset
                                                        @isset($quote->annual_fee->flat_value)
                                                            @if($quote->annual_fee->flat_value != '')
                                                                Annual fee: {{$quote->annual_fee->flat_value}}
                                                            @endif
                                                        @endisset
                                                    </td>
                                                <td>
                                                    @if (($quote->loan_application->loan_type_id != 5) && ($quote->loan_application->loan_type_id != 6))
                                                    {{getFixedFloating($quote->quantum_interest->fixed_or_floating)}}
                                                    @endif
                                                </td>
                                                <td>{{ $quote->quote_validity }}</td>
                                                <td>{{ $quote->no_loan_reason }}</td>

                                            </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    {{ $quotations->links('pagination::bootstrap-4') }}
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('admin.pages.footer')
    </div>

@endsection
