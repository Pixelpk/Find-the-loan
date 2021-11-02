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
                                <h4 class="page-title">More document required</h4>
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
                                    <h6>Point to any specific document/applicant?</h6>

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
                                        
                                        {{-- <div class="col-md-12 col-lg-12">
                                            <div class="form-group">
                                                <label>Point to any specific document/applicant?</label>
                                                <select required class="form-control" name="quote_additional_doc_id" id="quote_additional_doc_id">
                                                    @foreach($additional_docs as $key=>$items)
                                                    <optgroup label="{{ getAdditionDocInfoType($key) }}">
                                                        @foreach($items as $item)
                                                            <option value="{{ $item->id }}">{{ $item->info }}</option>
                                                        @endforeach
                                                    </optgroup>
                                                    @endforeach
                                                </select>
                                                <span style="color: red" id="add_doc_id_error"></span>
                                            </div>
                                        </div> --}}
                                    
                                    <hr>
                                    <section id="more_doc_section">
                                    {{-- <h5 class="">Message description</h5> --}}
                                    {{-- <span>(You may pick a combination of the following reasons to be displayed along with the info/document asked to the borrower.)</span> --}}
                                    <h6 class="">You may pick a combination of the following reasons to be displayed along with the info/document asked to the borrower.</h6>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group custom-switch">
                                                <input type="checkbox" class="custom-control-input" name="if_any" id="if_any">
                                                <label class="custom-control-label" for="if_any">If any</label>
                                            </div>
                                        </div>
                                    </div>
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

                                    {{-- <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group custom-switch">
                                                <input type="checkbox" class="custom-control-input" name="latest" id="latest">
                                                <label class="custom-control-label" for="latest">Latest</label>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group custom-switch">
                                                <input type="checkbox" class="custom-control-input" name="required_company_stamp" id="required_company_stamp">
                                                <label class="custom-control-label" for="required_company_stamp">Required Company stamp</label>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group custom-switch">
                                                <input type="checkbox" class="custom-control-input" name="need_notarized" id="need_notarized">
                                                <label class="custom-control-label" for="need_notarized">Need notarized</label>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group custom-switch">
                                                <input type="checkbox" class="custom-control-input" name="signature_borrower" id="signature_borrower">
                                                <label class="custom-control-label" for="signature_borrower">Require Signature of borrower</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group custom-switch">
                                                <input type="checkbox" class="custom-control-input" name="signature_borrowers_customer" id="signature_borrowers_customer">
                                                <label class="custom-control-label" for="signature_borrowers_customer">Require Signature of borrower's Customer</label>
                                            </div>
                                        </div>
                                    </div> --}}
                                    <hr>
                                    <h6>Reasons</h6>
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
                                        {{-- <div class="col-md-4">
                                            <label>Reasons</label>
                                            <select class="form-control select2" name="more_doc_reasons" id="more_doc_reasons">
                                                @php 
                                                $list = moreDocReasons();
                                                @endphp
                                                @for($i=1;$i<count($list);$i++)
                                                    <option value="{{ $i }}">{{$list[$i]}}</option>
                                                @endfor
                                            </select>
                                            <span style="color: red" id="more_doc_reasons_error"></span>
                                        </div> --}}
                                    </div>
                                    <hr>
                                    <h6>Document of</h6>
                                    <div class="row">
                                        @php
                                            $list = moreDocOfList();
                                        @endphp
                                        @for($i=1;$i<count($list);$i++)
                                        <div class="col-md-3">
                                            <div class="form-group custom-switch"> 
                                                <input type="radio" @if ($i==1) checked  @endif 
                                                class="custom-control-input document_of" value="{{$i}}" name="document_of" id="document_of{{$i}}">
                                                <label class="custom-control-label" for="document_of{{$i}}">{{$list[$i]}}</label>
                                            </div>
                                        </div>
                                        @endfor
                                        {{-- <div class="col-md-4">
                                            <label>Document of</label>
                                            <select class="form-control select2" name="document_of" id="document_of">
                                                @php 
                                                $list = moreDocOfList();
                                                @endphp
                                                @for($i=1;$i<count($list);$i++)
                                                    <option value="{{ $i }}">{{$list[$i]}}</option>
                                                @endfor
                                            </select>
                                            <span style="color: red" id="document_of_error"></span>
                                        </div> --}}
                                    </div>
                                    <hr>
                                    </section>
                                    <div class="form-group mt-1">
                                        <div>
                                            <button type="button" id="add_more_message_desc" class="btn btn-primary waves-effect waves-light">
                                                Save and Add more+
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
                                                                        <th>Document of</th>
                                                                        <th>Reasons</th>
                                                                        <th>Within(Days)</th>
                                                                        <th>Past(Months)</th>
                                                                        <th>Valid For(Months)</th>
                                                                        <th>From</th>
                                                                        <th>To</th>
                                                                        <th>If any</th>
                                                                        
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
