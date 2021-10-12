@extends('admin.layouts.master')
@section('content')
    <div class="content-page">

        <div class="content">

            <div class="container-fluid">
                <div class="page-title-box">

                    <div class="row align-items-center ">
                        <div class="col-md-2">
                            <div class="page-title-box">
                                <h4 class="page-title">Quoted customer</h4>
                            </div>
                        </div>
{{--                        <div class="col-md-3 float-right">--}}
{{--                            <div class="input-group no-border">--}}
{{--                                <input class="form-control search-user" name="search" type="text" autocomplete="off" value="" id="product-search" placeholder="Search by EnquiryID" >--}}
{{--                            </div>--}}
{{--                            <div id="search_list" style="" class="autocomplete-items"></div>--}}
{{--                        </div>--}}
                        <div class="col-md-10">
                            <div class="float-right d-none d-md-block ml-2">
                                <button type="button" class="btn btn-primary" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-filter"></i>
                                </button>
                                {{-- <form method="get" action="{{ route('loan-applications') }}" id="application_filter_form" class="dropdown-menu  dropdown-menu-left p-4" style="background-color: #27b34d;margin-top: 10px !important;width: 30%;">
                                    <div class="form-group">
                                        <label for="" class="control-label mb-10"> From:</label>
                                        <input type="text" autocomplete="off" class="form-control date-picker" name="from_date">
                                        <label for="" class="control-label mb-10"> To:</label>
                                        <input type="text" autocomplete="off" class="form-control date-picker" name="to_date">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Loan type</label>
                                        <select class="form-control" name="loan_type_id">
                                            <option value="">Select</option>
                                            
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Company structure Type</label>
                                        <select class="form-control" name="company_structure_type_id">
                                            <option value="">Select</option>
                                            
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Assigned User</label>
                                        <select class="form-control" name="assigned_user_id">
                                            <option value="">Select</option>
                                            
                                        </select>
                                    </div>

                                    <button type="submit" class="btn btn-primary">Apply</button>
                                </form> --}}
                            </div>

                            <div class=" col-md-3 float-right d-none d-md-block ml-2">
                                <div class="input-group no-border">
                                    <input class="form-control search-user" name="search" type="text" autocomplete="off" value="" id="product-search" placeholder="Search by EnquiryID" >
                                </div>
                                <div id="search_list" style="" class="autocomplete-items"></div>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- end page-title -->

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="table-rep-plugin">
                                    <div class="table-responsive b-0" data-pattern="priority-columns">
                                        <table id="loan_application_table" class="table  table-striped">
                                            <thead>
                                            <tr>
                                                <th>Customer name</th>
                                                <th>Loan type</th>
                                                <th>Quantum</th>
                                                <th>Interest % p.a</th>
                                                <th>Tenure</th>
                                                <th>Min Tenure</th>
                                                <th>Lock-in</th>
                                                <th>Monthly repayment terms</th>
                                                <th>Processing fee</th>
                                                <th>Legal Fee</th>
                                                <th>Other application Fee</th>
                                                <th>Floating/fixed</th>
                                                <th>Quoted validity</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($quotations as $quote)
                                            <tr>
                                                <td>{{ $quote->loan_application->loan_user->first_name." ".$quote->loan_application->loan_user->last_name }}</td>
                                                <td>{{ $quote->loan_application->loan_type->sub_type }}</td>
                                                <td>{{ $quote->quantum_interest->quantum ?? "" }}</td>
                                                <td></td>
                                                <td>{{ $quote->quantum_interest->tenure->months ?? "" }}</td>
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
                                                    {{ "$".$quote->one_time_fee->flat_value." & ".$quote->one_time_fee->percentage." %"}}
                                                </td>
                                                <td>{{ $quote->legal_fee->range_from."-".$quote->legal_fee->range_to }}</td>
                                                <td></td>
                                                <td></td>
                                                <td>{{ $quote->quote_validity }}</td>
                                            
                                            </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    {{ $quotations->links() }}
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- end col -->
                </div>
                <!-- end row -->

            </div>
            <!-- container-fluid -->

        </div>
        @include('admin.pages.footer')
    </div>

@endsection

