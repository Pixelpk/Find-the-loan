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
                                <h6>If any:</h6>
                                <span>{{ getYesNo($item2->if_any) }}</span>
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

                @if ($more_doc_request_detail->replied_doc_details->replied_docs)
                <div class="container py-3 info-container mt-5 info-container">
                    <div class="container">
                        <div class="row">
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
                        </div>
                    </div>
                </div>
                @endif
                
        @include('admin.pages.footer')
    
    </div>
</div>
@endsection