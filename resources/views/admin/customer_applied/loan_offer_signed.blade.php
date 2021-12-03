@extends('admin.layouts.master')
@section('content')
    <div class="content-page">

        <div class="content">

            <div class="container-fluid">
                <div class="page-title-box">

                    <div class="row align-items-center ">
                        <div class="col-md-12">
                            <div class="page-title-box">
                                <h4 class="page-title">Loan offer signed</h4>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="table-rep-plugin">
                                    <div class="table-responsive b-0" data-pattern="priority-columns">
                                        <table id="loan_application_table" class="table  table-striped">
                                            <thead>
                                            <tr>
                                                <th>Enquiry Id</th>
                                                <th>Profile</th>
                                                <th>Date Received</th>
                                                <th>Loan type</th>
                                                <th>Customer name</th>
                                                <th>Quotation Date</th>
                                                <th>Applied at</th>
                                                <th>Offer signed at</th>
                                                
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($quotations as $quote)
                                            <tr class="loan_application_row" url="{{ route('loan-application-summary',['apply_loan_id'=>$quote->loan_application->id]) }}"  style="cursor: pointer" title="Show summary">
                                                <td>{{ $quote->loan_application->enquiry_id }}</td>
                                                <td>{{ getProfile($quote->loan_application->profile) }}</td>
                                                <td>{{ $quote->loan_application->created_at }}</td>
                                                <td>{{ $quote->loan_application->loan_type->sub_type }}</td>
                                                <td>{{ $quote->loan_application->loan_user->first_name." ".$quote->loan_application->loan_user->last_name }}</td>
                                                <td>{{ $quote->created_at }}</td>
                                                <td>{{ $quote->proceeded_at }}</td>
                                                <td>{{ $quote->offer_signed_at }}</td>                                                
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

