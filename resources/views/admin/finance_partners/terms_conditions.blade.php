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
                                <h4 class="page-title">Site Data</h4>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end page-title -->
                <div class="row">

                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="col-lg-12">
                                    <h5>Terms & Conditions</h5>
                                    {!! $detail->terms_condition !!}
                                </div>
                                <hr>
                                @if(Auth::user()->parent_id == 0 && $detail->terms_request_status == 0 && $detail->terms_request_status != null)
                                <div class="col-lg-12">
                                    <h5>Requested Terms & Conditions</h5>
                                    <div>
                                        <a href="{{ route('approve-request-by-bank',['status'=>'1']) }}" msg="Are you sure to forward this request to super admin?" class=" change_status" data-toggle="tooltip" data-original-title="Approve">
                                            <i class="m-2 fa fa-thumbs-up">Approve & Forward</i>
                                        </a>
                                        <a href="{{ route('approve-request-by-bank',['status'=>'0']) }}" msg="Are you sure to reject this request?" class="  change_status" data-toggle="tooltip" data-original-title="Reject">
                                            <i class="m-2 fa fa-thumbs-down">Reject</i>
                                        </a>
                                    </div>
                                    <h6>Request submitted by: {{ $user_detail->name }}</h6>
                                    <h6>User designation: {{ $user_detail->designation }}</h6>
                                    {!! $detail->requested_terms_condition !!}
                                </div>
                                <hr>
                                @endif
                                {{--                                <h4 class="mt-0 header-title">Web Data</h4>--}}
                                <form method="post" action="{{ route('request-terms-conditions') }}">
                                    @csrf
                                    <div class="form-group">
                                        <h5>Terms & conditions update request</h5>
                                        <textarea type="text" class="form-control ckeditor" required  name="requested_terms_condition" >{!! $detail->requested_terms_condition !!}</textarea>
                                    </div>

                                    <div class="form-group mb-0">
                                        <div>
                                            <button type="submit" class="btn btn-primary waves-effect waves-light">
                                                Request Update
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
