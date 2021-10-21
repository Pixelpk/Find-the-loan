@extends("admin.layouts.master")
@section('content')
<div class="content-page">
    <!-- Start content -->
    <div class="content">

        <div class="container-fluid">
            <div class="page-title-box">

                <div class="row align-items-center ">
                    <div class="col-md-12">
                        <div class="page-title-box">
                            <h4 class="page-title">Summary</h4>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end page-title -->

            <!-- INFO CONTAINER -->
            <div class="container py-3 info-container">
                <nav class="navbar navbar-expand-lg navbar-light">
                    <div class="container-fluid mb-3" style="padding:0">
                      <span class="navbar-brand">Summary</span>
                      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                      </button>
                      <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
                        <ul class="navbar-nav sum-nav me-auto mb-2 mb-lg-0">
                        @if(!$application->application_rejected)
                          <li class="nav-item">
                            <a href="#" onclick="rejectApplication({{$application->id}});" data-toggle="tooltip" data-original-title="Reject" class="btn btn-primary" aria-current="page" >Reject</a>
                          </li>
                        @endif
                        @if(!$application->application_quote)
                          <li class="nav-item">
                            <a class="btn btn-primary" aria-current="page" href="{{ route('put-quotation',['apply_loan_id'=>$application->id]) }}">Put quotation</a>
                          </li>
                          @endif
                          <li class="nav-item">
                            <a class="btn btn-primary" aria-current="page" href="{{ route('more-doc-required',['apply_loan_id'=>$application->id]) }}">
                                More doc required
                            </a>
                          </li>
                          <li class="nav-item">
                            <a class="btn btn-primary" data-original-title="Download All Documents" aria-current="page" href="{{ route('download-loan-doc',['id'=>$application->id]) }}">
                                Download documents
                            </a>
                          </li>

                        </ul>
        
                      </div>
                    </div>
                  </nav>
                <!-- <div class="top-div mb-4">
                    <h5 class="fw-bold"><u>Summary</u></h5>
                </div> -->
                <!-- SEC 1 -->
                <div class="container">
                    <div class="sumary-list same-gp">
                        <span class="info__text">Incorporated</span>
                        <span class="info__field">
                            @php
                            $start_date = explode('/',$application->loan_company_detail->company_start_date ?? '');
                            @endphp
                            {{$start_date[0] ?? '0'}} years , {{$start_date[1] ?? '0'}} months ago
                        </span>
                        <span class="info__text">Bussiness Structure</span>
                        <span class="info__field">{{ $application->loan_company_detail->loan_company_structure->structure_type ?? '' }}</span>
                        <span class="info__text">Local Shareholding</span>
                        <span class="info__field">{{ $application->loan_company_detail->percentage_shareholder ?? '' }}%</span>
                        <span class="info__text">Sector</span>
                        <span class="info__field">{{ $application->loan_company_detail->loan_company_sector->name ?? '' }}</span>
                        <span class="info__text">Loan type looking for</span>
                        <span class="info__field">{{ $application->loan_type->sub_type }}</span>
                        <span class="info__text">Amount looking at</span>
                        <span class="info__field">${{ $application->amount }}</span>
                        <span class="info__text">Reason for loan</span>
                        <span class="info__field">{{ $application->loan_reason->reason ?? "" }}</span>
                        <span class="info__text">No of shareholder</span>
                        <span class="info__field">{{ $application->loan_company_detail->share_holder ?? '' }}</span>
                    </div>
                    <hr style="background:#000000; margin: 2rem 0">
                    <!-- /SYMMARY-LIST -->

                    <div class="same-gp sumary-list__1">
                        <div class="same-gp info__inner-list">
                            <span class="info__text-h">Bank Statement</span>
                            <span class="info__field">Dec</span>
                            <span class="info__field">Jan</span>
                            <span class="info__field">Feb</span>
                            <span class="info__field">March</span>
                            <span class="info__field">April</span>
                            <span class="info__field">Total 6 Months</span>
                            <span class="info__field">Average</span>
                        </div>
                        <!-- /INFO INNER LIST -->

                        <div class="same-gp info__inner-list">
                            <span class="info__text-h">Total Deposit</span>
                            <span class="info__field">$233945.00</span>
                            <span class="info__field">$233945.00</span>
                            <span class="info__field">$233945.00</span>
                            <span class="info__field">$233945.00</span>
                            <span class="info__field">$233945.00</span>
                            <span class="info__field">$233945.00</span>
                            <span class="info__field">$233945.00</span>
                        </div>
                        <!-- /INFO INNER LIST 2-->

                        <div class="same-gp info__inner-list">
                            <span class="info__text-h">Total Withdrawals</span>
                            <span class="info__field">$301287.98</span>
                            <span class="info__field">$301287.98</span>
                            <span class="info__field">$301287.98</span>
                            <span class="info__field">$301287.98</span>
                            <span class="info__field">$301287.98</span>
                            <span class="info__field">$301287.98</span>
                            <span class="info__field">$301287.98</span>
                        </div>
                        <!-- /INFO INNER LIST 3-->

                        <div class="same-gp info__inner-list">
                            <span class="info__text-h">Month end Balance</span>
                            <span class="info__field">$540299.55</span>
                            <span class="info__field">$540299.55</span>
                            <span class="info__field">$540299.55</span>
                            <span class="info__field">$540299.55</span>
                            <span class="info__field">$540299.55</span>
                            <span class="info__field">$540299.55</span>
                            <span class="info__field">$540299.55</span>
                        </div>
                        <!-- /INFO INNER LIST 4-->
                    </div>
                    <!-- /SYMMARY-LIST 1-->

                    <hr style="background:#000000; margin: 2rem 0">
                    <!-- SUMMARY LIST 2 -->
                    <div class="same-gp sumary-list__2">
                        <span class="info__text">Returned cheques in last 6 months</span>
                        <span class="info__field">0</span>
                        <span class="info__text">More than 15k a month</span>
                        <span class="info__field">Yes</span>
                        <span class="info__text">More than 650k a year</span>
                        <span class="info__field">Yes</span>
                    </div>
                </div>
                <!-- /SUMMARY LIST 2 -->

                <hr style="background:#000000; margin: 2rem 0">

                <!-- SUMMARY LIST 3 -->
                <div class="same-gp sumary-list__3">
                    <!-- FOR NEW PERSON -->
                    <span class="info__text">Shareholders
                        <!-- SUMMARY LIST 3 INNER -->
                        <div class="same-gp sumary-list__3-inner">
                            <span class="info__text">Mr Tan</span>
                            <span class="info__field">CBS Grading</span>
                            <span class="info__field">AA</span>
                            <span class="info__text"></span>
                            <span class="info__field">NOA Latest Year</span>
                            <span class="info__field">$35000,89</span>
                            <span class="info__text"></span>
                            <span class="info__field">NOA Latest Year</span>
                            <span class="info__field">$35000,89</span>
                        </div>
                        <!-- /SUMMARY LIST 3 INNER -->
                    </span>
                    <!-- /FOR NEW PERSON -->

                    <!-- FOR AGE -->
                    <span class="info__text text-center">Age
                        <!-- SUMMARY LIST 3 INNER 1-->
                        <div class="same-gp sumary-list__3-inner1">
                            <span class="info__field">55</span>
                        </div>
                        <!-- /SUMMARY LIST 3 INNER 1-->
                    </span>
                    <!-- FOR AGE -->
                </div>
            </div>
            <!-- /SUMMARY LIST 3 -->
            <!-- /SEC 1 -->
        </div>
        <!-- /INFO CONTAINER -->
    </div>
    <!-- container-fluid -->
</div>
<!-- content -->

@include('admin.pages.footer')

</div>
@endsection