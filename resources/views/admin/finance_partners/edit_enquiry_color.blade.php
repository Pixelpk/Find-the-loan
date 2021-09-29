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
                                {{--                                <h4 class="mt-0 header-title">Web Data</h4>--}}
                                <form method="post" action="#">
                                    @csrf
                                    <div class="form-group">
                                        <h5>Contact email</h5>
                                        <input type="email" class="form-control" required  name="contact_email" value="{{$web_data['contact_email'] ?? ""}}"/>
                                    </div>

                                    <div class="form-group mb-0">
                                        <div>
                                            <button type="submit" class="btn btn-primary waves-effect waves-light">
                                                Submit
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

                <?php
                /*
                <div class="row">
                    <div class="col-lg-12">
                        {!! $web_data['about_us'] !!}
                    </div>
                </div>
                */
                ?>



            </div>
            <!-- container-fluid -->

        </div>
        <!-- content -->

        @include('admin.pages.footer')

    </div>
@endsection
