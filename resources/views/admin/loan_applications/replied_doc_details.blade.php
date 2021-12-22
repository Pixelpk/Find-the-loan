@extends('admin.layouts.master')
@section('content')
<div>
    <div class="content-page">
        <!-- Start content -->
        <div class="content">
    
            <div class="container-fluid">
                <div class="page-title-box">
    
                    <div class="row align-items-center ">
                        <div class="col-md-12">
                            <div class="page-title-box">
                                <h4 class="page-title">Replied Documents Details</h4>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="container py-3 info-container">
                    <div class="container">
                        @foreach ($more_doc_request_detail->more_doc_msg_desc as $item2)
                        <div class="row">
                            <div class="col-md-3">
                                <h6>Document:</h6>
                                <span>{{ $item2->quote_additional_doc->info }}</span>
                            </div>
                            <div class="col-md-3">
                                <h6>Document of:</h6>
                                <span>{{ getDocumentOf($item2->document_of) }}</span>
                            </div>
                            
                            <div class="col-md-3">
                                <h6>From:</h6>
                                <span>{{ $item2->from }}</span>
                            </div>
                            <div class="col-md-3">
                                <h6>To:</h6>
                                <span>{{ $item2->to }}</span>
                            </div>
                            <div class="col-md-3">
                                <h6>Within days:</h6>
                                <span>{{ $item2->within_days }}</span>
                            </div>
                            <div class="col-md-3">
                                <h6>Past Months:</h6>
                                <span>{{ $item2->past_months }}</span>
                            </div>
                            <div class="col-md-3">
                                <h6>Valid for:</h6>
                                <span>{{ $item2->valid_for }}</span>
                            </div>
                            
                            <div class="col-md-3">
                                <h6>Reasons:</h6>
                                <span>
                                    @foreach ($item2->more_doc_reasons as $reason)
                                    {{ getMoreDocReason($reason) }},
                                    @endforeach
                                </span>
                            </div>
                        </div>
                        <hr>
                        @endforeach
                    </div>
                </div>

                @if ($more_doc_request_detail->replied_doc_details->replied_docs || $more_doc_request_detail->replied_doc_details->dont_have_doc || $more_doc_request_detail->replied_doc_details->personal_loan_list)
                <div class="container py-3 info-container mt-5 info-container">
                    <div class="container">
                        <div class="row">
                            @isset($more_doc_request_detail->replied_doc_details->replied_docs)
                            @foreach ($more_doc_request_detail->replied_doc_details->replied_docs as $doc)
                            <div class="col-md-6">
                                <h6>{{$doc->lable}}</h6>
                                @if ($doc->doc_type == "file")
                                    <span>
                                        <a class="btn btn-primary" data-original-title="Download Document" aria-current="page"
                                        href="{{Storage::url($doc->value)}}">
                                            Download documents
                                        </a>
                                    </span>
                                    @else
                                    <span>
                                        {{$doc->value}} 
                                        @if (in_array($doc->quote_additional_docs_id,[131,132]))
                                        ({{$doc->area_parameter}} )
                                        @endif
                                    </span>
                                @endif
                            </div>
                            @endforeach  
                            @endisset                              
                        </div>
                        <div class="row">
                            @isset($more_doc_request_detail->replied_doc_details->dont_have_doc_list)
                            @foreach ($more_doc_request_detail->replied_doc_details->dont_have_doc_list as $doc)
                            <div class="col-md-6">
                                <h6>{{$doc->info}}</h6>
                                <span>
                                    Don't have document
                                </span>
                            </div>
                            @endforeach
                            @endisset
                        </div>
                        @isset($more_doc_request_detail->replied_doc_details->personal_loan_list)
                        <div class="row">
                            <h6>Personal outstanding loans & borrowing </h6>
                            <div class="col-md-12">
                                <table class="table table-hover table-striped">
                                    <thead>
                                        <tr>
                                            <th>Bank / Financial Institution</th>
                                            <th>Type of Facility</th>
                                            <th>Original Loan amount</th>
                                            <th>Interest per year</th>
                                            <th>Outstanding Loan Amount</th>
                                            <th>Monthly Installment Amount</th>
                                            <th>Start Date MM/YY</th>
                                            <th>Duration</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($more_doc_request_detail->replied_doc_details->personal_loan_list as $doc)
                                        <tr>
                                            <td>{{$doc['bank_institution']}}</td>
                                            <td>{{$doc['facility_type']}}</td>
                                            <td>{{$doc['original_loan_amount']}}</td>
                                            <td>{{$doc['interest_per_year']}}</td>
                                            <td>{{$doc['outstanding_loan_amount']}}</td>
                                            <td>{{$doc['monthly_installment_amount']}}</td>
                                            <td>{{$doc['start_date']}}</td>
                                            <td>{{$doc['duration']}}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <hr>
                        @endisset
                        @isset($more_doc_request_detail->replied_doc_details->company_loan_list)
                        <div class="row">
                            <h6>Company's outstanding loans & borrowing </h6>
                            <div class="col-md-12">
                                <table class="table table-hover table-striped">
                                    <thead>
                                        <tr>
                                            <th>Bank / Financial Institution</th>
                                            <th>Type of Facility</th>
                                            <th>Original Loan amount</th>
                                            <th>Interest per year</th>
                                            <th>Outstanding Loan Amount</th>
                                            <th>Monthly Installment Amount</th>
                                            <th>Start Date MM/YY</th>
                                            <th>Duration</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($more_doc_request_detail->replied_doc_details->company_loan_list as $doc)
                                        <tr>
                                            <td>{{$doc['bank_institution']}}</td>
                                            <td>{{$doc['facility_type']}}</td>
                                            <td>{{$doc['original_loan_amount']}}</td>
                                            <td>{{$doc['interest_per_year']}}</td>
                                            <td>{{$doc['outstanding_loan_amount']}}</td>
                                            <td>{{$doc['monthly_installment_amount']}}</td>
                                            <td>{{$doc['start_date']}}</td>
                                            <td>{{$doc['duration']}}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <hr>
                        @endisset

                        @isset($more_doc_request_detail->replied_doc_details->personal_assets_list)
                        <div class="row mt-2">
                            <h6>Local assets such as Investment, Life Insurance, Property</h6>
                            @if (count($more_doc_request_detail->replied_doc_details->personal_assets_list['insurance_asset_list']) > 0)                                
                            <div class="col-md-12">
                                <table class="table table-hover table-striped">
                                    <thead>
                                        <tr>
                                            <th>Insurance</th>
                                            <th>Details</th>
                                            <th>Current value</th>
                                            <th>Maturity Date</th>
                                            <th>Year Purchased</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($more_doc_request_detail->replied_doc_details->personal_assets_list['insurance_asset_list'] as $doc)
                                        <tr>
                                            <td>{{$doc['insurance_type']}}</td>
                                            <td>{{$doc['insurance_details']}}</td>
                                            <td>{{$doc['insurance_current_value']}}</td>
                                            <td>{{$doc['insurance_maturity_date']}}</td>
                                            <td>{{$doc['insurance_year_purchased']}}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <hr>
                            @endif

                            @if (count($more_doc_request_detail->replied_doc_details->personal_assets_list['investment_asset_list']) > 0)                                
                            <div class="col-md-12">
                                <table class="table table-hover table-striped">
                                    <thead>
                                        <tr>
                                            <th>Investment</th>
                                            <th>Details</th>
                                            <th>Current value</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($more_doc_request_detail->replied_doc_details->personal_assets_list['investment_asset_list'] as $doc)
                                        <tr>
                                            <td style="width: 33%">{{$doc['investment_type']}}</td>
                                            <td style="width: 33%">{{$doc['investment_details']}}</td>
                                            <td style="width: 33%">{{$doc['investment_current_value']}}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <hr>
                            @endif

                            @if (count($more_doc_request_detail->replied_doc_details->personal_assets_list['cash_and_deposit_asset_list']) > 0)
                            <div class="col-md-12">
                                <table class="table table-hover table-striped">
                                    <thead>
                                        <tr>
                                            <th>Cash & Deposit</th>
                                            <th>Details</th>
                                            <th>Current value</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($more_doc_request_detail->replied_doc_details->personal_assets_list['cash_and_deposit_asset_list'] as $doc)
                                        <tr>
                                            <td style="width: 33%">{{$doc['cash_and_deposit_type']}}</td>
                                            <td style="width: 33%">{{$doc['cash_and_deposit_details']}}</td>
                                            <td style="width: 33%">{{$doc['cash_and_deposit_value']}}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <hr>
                            @endif

                            @if (count($more_doc_request_detail->replied_doc_details->personal_assets_list['property_asset_list']) > 0)                                
                            <div class="col-md-12">
                                <table class="table table-hover table-striped">
                                    <thead>
                                        <tr>
                                            <th>Property</th>
                                            <th>Details</th>
                                            <th>Current value</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($more_doc_request_detail->replied_doc_details->personal_assets_list['property_asset_list'] as $doc)
                                        <tr>
                                            <td style="width: 33%">{{$doc['asset_property_type']}}</td>
                                            <td style="width: 33%">{{$doc['asset_property_details']}}</td>
                                            <td style="width: 33%">{{$doc['asset_property_current_value']}}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <hr>
                            @endif

                            @if (count($more_doc_request_detail->replied_doc_details->personal_assets_list['others_asset_list']) > 0)                                
                            <div class="col-md-12">
                                <table class="table table-hover table-striped">
                                    <thead>
                                        <tr>
                                            <th>Others</th>
                                            <th>Details</th>
                                            <th>Current value</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($more_doc_request_detail->replied_doc_details->personal_assets_list['others_asset_list'] as $doc)
                                        <tr>
                                            <td style="width: 33%">{{$doc['asset_others_type']}}</td>
                                            <td style="width: 33%">{{$doc['asset_others_details']}}</td>
                                            <td style="width: 33%">{{$doc['asset_others_current_value']}}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <hr>
                            @endif
                        </div>
                        <hr>
                        @endisset
                    </div>
                </div>
                @endif
                
        @include('admin.pages.footer')
    
    </div>
</div>
@endsection