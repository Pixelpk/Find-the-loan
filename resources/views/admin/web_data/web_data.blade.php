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
                                <form method="post" action="{{ route('submit-site-data') }}">
                                    @csrf
                                    <div class="form-group">
                                        <h5>Contact email</h5>
                                        <input type="email" class="form-control" required  name="contact_email" value="{{$web_data['contact_email'] ?? ""}}"/>
                                    </div>
                                    <div class="form-group">
                                        <h5>Footer text</h5>
                                        <textarea type="text" class="form-control ckeditor" required  name="footer_text" >{{$web_data['footer_text'] ?? ""}}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <h5>Financial inclusion</h5>
                                        <textarea type="text" class="form-control ckeditor" required  name="financial_inclusion" >{{$web_data['financial_inclusion'] ?? ""}}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <h5>About us</h5>
                                        <textarea type="text" class="form-control ckeditor" required  name="about_us" >{{$web_data['about_us'] ?? ""}}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <h5>Privacy policy</h5>
                                        <textarea type="text" class="form-control ckeditor" required  name="privacy_policy" >{{$web_data['privacy_policy'] ?? ""}}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <h5>Terms and conditions</h5>
                                        <textarea type="text" class="form-control ckeditor" required  name="terms_condition" >{{$web_data['terms_condition'] ?? ""}}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <h5>Glossary</h5>
                                        <textarea type="text" class="form-control ckeditor" required  name="glossary" >{{$web_data['glossary'] ?? ""}}</textarea>
                                    </div>

                                    <div class="form-group mb-0">
                                        <div class="text-right">
                                            <button type="submit" class="btn admin-btn waves-effect waves-light">
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
