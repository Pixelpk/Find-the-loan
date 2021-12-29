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
                                <h4 class="page-title">Request for More doc/Info</h4>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end page-title -->

                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">

                                {{-- <h4 class="mt-0 header-title">Add additional doc info</h4> --}}
                                <form method="POST" id="more_doc_form">
                                    <span style="color: red" id="more_doc_error"></span>

                                    <input class="form-control" type="hidden" name="apply_loan_id" value="{{$apply_loan_id}}" id="apply_loan_id">
                                    <h6>Additional Information/Documents required for quotation.</h6>
                                    <p class="lh-1">Please reserve information/documents required for application after the borrower has chosen to proceed with your quote.
                                    Grouping name is only for your ease of use and is not shown to borrower. There will be additional description shown to 
the borrower for uncommon documents, to help them understand what are you requesting for. We will also send a 
reminder for the customer to upload and furnish the required info/doc automatically.</p>

                                        @foreach($additional_docs as $key=>$items)
                                        <h6>{{ getAdditionDocInfoType($key) }}</h6>
                                        <div class="row">
                                            
                                            @foreach($items as $item_key=>$item)
                                            
                                            <div class="col-md-3">
                                                <div class="form-group custom-switch"> 
                                                    <input type="radio" @if ($key==1 && $item_key==0) checked  @endif 
                                                    class="custom-control-input quote_additional_doc_id" value="{{$item->id}}" name="quote_additional_doc_id" id="quote_additional_doc_id{{$item->id}}">
                                                    <label class="custom-control-label" for="quote_additional_doc_id{{$item->id}}">{{ $item->info }}</label>
                                                </div>
                                            </div>
                                            @endforeach
                                        </div>
                                        @endforeach
                                    
                                    <hr>
                                    <section id="more_doc_section">
                                    {{-- <h5 class="">Message description</h5> --}}
                                    <h6 class="">You may pick a combination of the following reasons to be displayed along with the info/document asked to the borrower.</h6>
                                    {{-- <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group custom-switch">
                                                <input type="checkbox" class="custom-control-input" name="if_any" id="if_any">
                                                <label class="custom-control-label" for="if_any">If any</label>
                                            </div>
                                        </div>
                                    </div> --}}
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>From</label>
                                                        <input class="form-control date-picker" autocomplete="off" id="from" name="from" type="text">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>To</label>
                                                        <input class="form-control date-picker" autocomplete="off" id="to" name="to" type="text">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>Within(Days)</label>
                                                        <input class="form-control" autocomplete="off" id="within_days" name="within_days" min="0" type="number">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>Past(Months)</label>
                                                        <input class="form-control" autocomplete="off" id="past_months" name="past_months" min="0" type="number">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>Valid For(Months)</label>
                                                        <input class="form-control" autocomplete="off" id="valid_for" name="valid_for" min="0" type="number">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- <hr> --}}
                                    {{-- <h6>Reasons</h6> --}}
                                    <span style="color: red" id="more_doc_reasons_error"></span>
                                    @php
                                        $list = moreDocReasons();
                                    @endphp
                                    <div class="row">
                                        @for($i=1;$i<count($list);$i++)
                                        <div class="col-md-3">
                                            <div class="form-group custom-switch"> 
                                                <input type="checkbox"
                                                class="custom-control-input more_doc_reasons" value="{{ $i }}" name="more_doc_reasons" id="more_doc_reasons{{ $i }}">
                                                <label class="custom-control-label" for="more_doc_reasons{{ $i }}">{{$list[$i]}}</label>
                                            </div>
                                        </div>
                                        @endfor

                                    </div>
                                    <hr>
                                    
                                    <hr>
                                    </section>
                                    <div class="form-group mt-1">
                                        <div>
                                            <button type="button" id="add_more_message_desc" class="btn btn-primary waves-effect waves-light">
                                                Save
                                            </button>

                                        </div>
                                    </div>
                                    <section id="">
                                        <div class="row" id="more_doc_msg_list" style="display:none">
                                            
                                            <div class="col-12">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <div class="table-rep-plugin">
                                                            <div class="table-responsive b-0" data-pattern="priority-columns">
                                                                <table id="tech-companies-1" class="table  table-striped">
                                                                    <thead>
                                                                    <tr>
                                                                        <th>Delete</th>
                                                                        <th>Document</th>
                                                                        <th>Reasons</th>
                                                                        <th>Within(Days)</th>
                                                                        <th>Past(Months)</th>
                                                                        <th>Valid For(Months)</th>
                                                                        <th>From</th>
                                                                        <th>To</th>
                                                                        
                                                                    </tr>
                                                                    </thead>
                                                                    <tbody id="more_doc_msg_table">
                                                                    
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                        
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- end col -->
                                        </div>
                                    </section>
                                    <div class="form-group mt-1">
                                        <div>
                                            <button type="submit" id="more_doc_request_btn" class="btn float-right btn-primary waves-effect waves-light">
                                                Send request
                                            </button>
                                        </div>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>
                    <!-- end col -->

                </div>
                <!-- end row -->

            </div>
            <!-- container-fluid -->

        </div>
        <!-- content -->

        @include('admin.pages.footer')

    </div>
@endsection
