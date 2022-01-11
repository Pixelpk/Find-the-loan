<div>
    <div class="content-page">
        <!-- Start content -->
        <div class="content">

            <div class="container-fluid">
                <div class="page-title-box">

                    <div class="row align-items-center ">
                        <div class="col-md-12">
                            <div class="page-title-box">
                                <h4 class="page-title">Requested doc list</h4>
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

                            @if ($item2->from != null)
                            <div class="col-md-3">
                                <h6>From:</h6>
                                <span>{{ $item2->from }}</span>
                            </div>
                            @endif

                            @if ($item2->to != null)
                            <div class="col-md-3">
                                <h6>To:</h6>
                                <span>{{ $item2->to }}</span>
                            </div>
                            @endif

                            @if ($item2->within_days != null)
                            <div class="col-md-3">
                                <h6>Within days:</h6>
                                <span>{{ $item2->within_days }}</span>
                            </div>
                            @endif

                            @if ($item2->past_months != null)
                            <div class="col-md-3">
                                <h6>Past Months:</h6>
                                <span>{{ $item2->past_months }}</span>
                            </div>
                            @endif

                            @if ($item2->valid_for != null)
                            <div class="col-md-3">
                                <h6>Valid for:</h6>
                                <span>{{ $item2->valid_for }}</span>
                            </div>
                            @endif

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

                <div class="container py-3 info-container mt-5 info-container">
                    <div class="container">

                        {{-- view documents --}}
                        @if($more_doc_request_detail->replied_doc_details != null)
                            @if ($more_doc_request_detail->replied_doc_details->replied_docs || $more_doc_request_detail->replied_doc_details->dont_have_doc || $more_doc_request_detail->replied_doc_details->personal_loan_list)
                                <div class="">
                                    <div class="">
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
                                            @if (count($more_doc_request_detail->replied_doc_details->personal_loan_list) > 0)
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
                                            @endif
                                        @endisset

                                        @isset($more_doc_request_detail->replied_doc_details->company_loan_list)
                                            @if (count($more_doc_request_detail->replied_doc_details->company_loan_list) > 0)
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
                                            @endif
                                        @endisset

                                        @isset($more_doc_request_detail->replied_doc_details->personal_assets_list)
                                            @if (count($more_doc_request_detail->replied_doc_details->personal_assets_list) > 0)

                                                <div class="row mt-2">
                                                    <h6>Local assets such as Investment, Life Insurance, Property</h6>
                                                    @if (isset($more_doc_request_detail->replied_doc_details->personal_assets_list['insurance_asset_list']))
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

                                                    @if (isset($more_doc_request_detail->replied_doc_details->personal_assets_list['investment_asset_list']) > 0)
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

                                                    @if (isset($more_doc_request_detail->replied_doc_details->personal_assets_list['cash_and_deposit_asset_list']) > 0)
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

                                                    @if (isset($more_doc_request_detail->replied_doc_details->personal_assets_list['property_asset_list']) > 0)
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

                                                    @if (isset($more_doc_request_detail->replied_doc_details->personal_assets_list['others_asset_list']) > 0)
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
                                            @endif
                                        @endisset
                                    </div>
                                </div>
                            @endif
                        {{-- reply documents --}}
                        @else
                        {{-- <form class=""> --}}
                            <div class="row align-items-end">
                                <input type="hidden" wire:model="more_doc_request_id" value="{{ $more_doc_request_detail->id }}">
                                @foreach ($more_doc_request_detail->more_doc_msg_desc as $item2)
                                    @if ($item2->quote_additional_doc->id == 99 || $item2->quote_additional_doc_id == 4)

                                        @include('livewire.customer.personal-and-company-loan-list')

                                    @elseif($item2->quote_additional_doc_id == 100)
                                        @include('livewire.customer.list-of-assets')
                                    @else
                                        <div class="col-md-8 mb-3">
                                            <label>{{$item2->quote_additional_doc->info}}
                                                @if($item2->quote_additional_doc->additional_description != null)
                                                    <i class="fa fa-info-circle" data-toggle="tooltip"
                                                    data-original-title="{{$item2->quote_additional_doc->additional_description}}"></i>
                                                @endif
                                                {{-- (<input type="checkbox" id="{{$item2->quote_additional_doc->id}}" wire:change="chk({{$item2->quote_additional_doc->id}})" wire:model="dont_have_doc.{{$item2->quote_additional_doc->id}}" class="mr-2"><label for="{{$item2->quote_additional_doc->id}}">Don't have this?</label>) --}}
                                            </label>
                                            @if ($item2->quote_additional_doc->doc_type == 'text' || $item2->quote_additional_doc->doc_type == 'file' || $item2->quote_additional_doc->doc_type == 'number')
                                                @if ($item2->quote_additional_doc->id == 131 || $item2->quote_additional_doc->id == 132)
                                                    <input @if(isset($dont_have_doc[$item2->quote_additional_doc->id]) == true) disabled @endif  class="form-control float-right replied_docs" @if ($item2->quote_additional_doc->doc_type == 'number') min='0' @endif type="{{$item2->quote_additional_doc->doc_type}}" wire:model="form.{{$item2->quote_additional_doc->id}}.{{$item2->quote_additional_doc->info}}.{{$item2->quote_additional_doc->doc_type}}" id="">
                                                    <label >

                                                        <input type="radio" value="Square Feet"  wire:model="form.{{$item2->quote_additional_doc->id}}.{{$item2->quote_additional_doc->info}}.area_parameter"> Square Feet
                                                    </label>
                                                    <label >
                                                        <input type="radio" value="Square Meter" wire:model="form.{{$item2->quote_additional_doc->id}}.{{$item2->quote_additional_doc->info}}.area_parameter"> Square Meter
                                                    </label>

                                                @else
                                                <input  @if(isset($dont_have_doc[$item2->quote_additional_doc->id]) == true) disabled @endif class="form-control float-right replied_docs" @if ($item2->quote_additional_doc->doc_type == 'number') min='0' @endif type="{{$item2->quote_additional_doc->doc_type}}" wire:model="form.{{$item2->quote_additional_doc->id}}.{{$item2->quote_additional_doc->info}}.{{$item2->quote_additional_doc->doc_type}}" id="">
                                                @endif
                                            @elseif($item2->quote_additional_doc->doc_type == 'dropdown')
                                                    @if ($item2->quote_additional_doc->id == 101)
                                                        <select  @if(isset($dont_have_doc[$item2->quote_additional_doc->id]) == true) disabled @endif  class="form-control" wire:model="form.{{$item2->quote_additional_doc->id}}.{{$item2->quote_additional_doc->info}}.{{$item2->quote_additional_doc->doc_type}}">
                                                            @php
                                                                $i = 1;
                                                            @endphp
                                                            @while ($i<=100)
                                                                <option value="{{$i}}">{{$i}}</option>
                                                                @php
                                                                    $i++;
                                                                @endphp
                                                            @endwhile
                                                        </select>
                                                    @elseif($item2->quote_additional_doc->id == 102)
                                                        <select  @if(isset($dont_have_doc[$item2->quote_additional_doc->id]) == true) disabled @endif  class="form-control" wire:model="form.{{$item2->quote_additional_doc->id}}.{{$item2->quote_additional_doc->info}}.{{$item2->quote_additional_doc->doc_type}}">
                                                            <option value="Fully paid">Fully paid</option>
                                                            <option value="Under mortgage">Under mortgage</option>
                                                            <option value="Rented">Rented</option>
                                                            <option value="Parents">Parents</option>
                                                            <option value="Spouse's">Spouse's</option>
                                                            <option value="Other family members">Other family members</option>
                                                        </select>
                                                    @elseif($item2->quote_additional_doc->id == 104)
                                                        <select  @if(isset($dont_have_doc[$item2->quote_additional_doc->id]) == true) disabled @endif  class="form-control" wire:model="form.{{$item2->quote_additional_doc->id}}.{{$item2->quote_additional_doc->info}}.{{$item2->quote_additional_doc->doc_type}}">
                                                            <option value="No formal education">No formal education</option>
                                                            <option value="Primary education">Primary education</option>
                                                            <option value="Secondary education">Secondary education or high school</option>
                                                            <option value="GED">GED</option>
                                                            <option value="Vocational qualification">Vocational qualification</option>
                                                            <option value="Bachelor's degree">Bachelor's degree</option>
                                                            <option value="Master's degree">Master's degree</option>
                                                            <option value="Doctorate or higher">Doctorate or higher</option>
                                                        </select>
                                                    @elseif($item2->quote_additional_doc->id == 105)
                                                        <select  @if(isset($dont_have_doc[$item2->quote_additional_doc->id]) == true) disabled @endif  class="form-control" wire:model="form.{{$item2->quote_additional_doc->id}}.{{$item2->quote_additional_doc->info}}.{{$item2->quote_additional_doc->doc_type}}">
                                                            <option value="Single">Single</option>
                                                            <option value="Married">Married</option>
                                                            <option value="Divorced">Divorced</option>
                                                        </select>
                                                    @elseif($item2->quote_additional_doc->id == 107)
                                                        <select  @if(isset($dont_have_doc[$item2->quote_additional_doc->id]) == true) disabled @endif  class="form-control" wire:model="form.{{$item2->quote_additional_doc->id}}.{{$item2->quote_additional_doc->info}}.{{$item2->quote_additional_doc->doc_type}}">
                                                            @php
                                                                $i = 1;
                                                            @endphp
                                                            @while ($i<=10)
                                                                <option value="{{$i}}">{{$i}}</option>
                                                                @php
                                                                    $i++;
                                                                @endphp
                                                            @endwhile
                                                        </select>
                                                    @elseif($item2->quote_additional_doc->id == 108)
                                                        <select  @if(isset($dont_have_doc[$item2->quote_additional_doc->id]) == true) disabled @endif  class="form-control" wire:model="form.{{$item2->quote_additional_doc->id}}.{{$item2->quote_additional_doc->info}}.{{$item2->quote_additional_doc->doc_type}}">
                                                            <option value="Yes">Yes</option>
                                                            <option value="No">No</option>
                                                        </select>
                                                    @endif
                                            @endif
                                        </div>
                                        <div class="col-md-4 pb-2">
                                            <input type="checkbox" id="{{$item2->quote_additional_doc->id}}" wire:change="chk({{$item2->quote_additional_doc->id}})" wire:model="dont_have_doc.{{$item2->quote_additional_doc->id}}" class="mr-2"><label for="{{$item2->quote_additional_doc->id}}">Don't have this?</label>

                                        </div>
                                    @endif

                                @endforeach

                            </div>
                            <div class="mt-3 px-0 text-right text-align-end">
                                <button wire:click="submitMoreDocRequestReply()" class="btn btn-primary btn-lg">Submit</button>
                            </div>
                        {{-- </form> --}}
                        @endif

                    </div>
                </div>


        @include('admin.pages.footer')

    </div>
</div>
