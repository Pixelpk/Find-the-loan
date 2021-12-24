<div>
    <div class="content-page">
        <!-- Start content -->
        <div class="content">
    
            <div class="container-fluid">
                <div class="page-title-box">
    
                    <div class="row align-items-center ">
                        <div class="col-md-12">
                            <div class="page-title-box">
                                <h4 class="page-title">Previous Enquiry</h4>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="container py-3 info-container">
                    <div class="container">
                        @if ($enquiry)
                        <div class="row">
                            <div class="col-md-3">
                                <h6>Loan type:</h6>
                                <span>{{ $enquiry->loan_type->sub_type }}</span>
                            </div>
                            <div class="col-md-3">
                                <h6>Amount:</h6>
                                <span>{{ $enquiry->amount }}</span>
                            </div>
                            <div class="col-md-3">
                                <h6>Reason for loan:</h6>
                                <span>{{ $enquiry->loan_reason->reason }}</span>
                            </div>
                            <div class="col-md-3">
                                <h6>Applied at:</h6>
                                <span>{{ $enquiry->created_at }}</span>
                            </div>
                            @if ($enquiry->profile == 1)
                            <div class="col-md-3">
                                <h6>Company name:</h6>
                                <span>{{ $enquiry->loan_company_detail->company_name ?? '' }}</span>
                            </div>
                            <div class="col-md-3">
                                <h6>Company website:</h6>
                                <span>{{ $enquiry->loan_company_detail->website ?? '' }}</span>
                            </div>
                            <div class="col-md-3">
                                <h6>Incorporated:</h6>
                                <span>
                                    @php
                                    $start_date = explode('/',$enquiry->loan_company_detail->company_start_date ?? '');
                                    @endphp
                                    {{$start_date[0] ?? '0'}} years , {{$start_date[1] ?? '0'}} months ago
                                </span>
                            </div>
                            <div class="col-md-3">
                                <h6>Business Structure:</h6>
                                <span>{{ $enquiry->loan_company_detail->loan_company_structure->structure_type ?? '' }}</span>
                            </div>
                            <div class="col-md-3">
                                <h6>Local Shareholding:</h6>
                                <span>{{ $enquiry->loan_company_detail->percentage_shareholder ?? '' }}%</span>
                            </div>
                            <div class="col-md-3">
                                <h6>Sector:</h6>
                                <span>{{ $enquiry->loan_company_detail->loan_company_sector->name ?? '' }}</span>
                            </div>
                            <div class="col-md-3">
                                <h6>No. of employees:</h6>
                                <span>{{ $enquiry->loan_company_detail->number_of_employees ?? '' }}</span>
                            </div>
                            <div class="col-md-3">
                                <h6>Revenue:</h6>
                                <span>{{ $enquiry->loan_company_detail->revenue ?? '' }}</span>
                            </div>
                            <div class="col-md-3">
                                <h6>Optional revenue:</h6>
                                <span>{{ $enquiry->loan_company_detail->optional_revenuee ?? '' }}</span>
                            </div>
                            <div class="col-md-3">
                                <h6>No of shareholder:</h6>
                                <span>{{ $enquiry->loan_company_detail->share_holder ?? '' }}</span>
                            </div>
                            <div class="col-md-3">
                                <h6>Profitable latest year:</h6>
                                <span>{{ getYesNo($enquiry->loan_company_detail->profitable_latest_year ?? '') }}</span>
                            </div>
                            <div class="col-md-3">
                                <h6>Profitable year before:</h6>
                                <span>{{ getYesNo($enquiry->loan_company_detail->profitable_before_year ?? '') }}</span>
                            </div>

                            @else

                            <div class="col-md-3">
                                <h6>NRIC:</h6>
                                <span></span>
                            </div>
                            <div class="col-md-3">
                                <h6>Nationality:</h6>
                                <span></span>
                            </div>
                            <div class="col-md-3">
                                <h6>Estimated monthly income:</h6>
                                <span></span>
                            </div>
                            @endif

                        </div>

                        <div class="row">
                            <button class="btn btn-primary mt-3" wire:click="downloadDoc()" data-original-title="Download All Documents">
                                Download Documents
                            </button>
                        </div>

                        @else
                        <div class="row">
                            <span>Sorry. No previous enquiry found.</span>
                        </div>
                        @endif
                        
                    </div>
                </div>
            @include('admin.pages.footer')
        </div>
    
    </div>
</div>