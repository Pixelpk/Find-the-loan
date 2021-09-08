@extends('admin.layouts.master')
@section('content')
    <div class="content-page">
        <!-- Start content -->
        <div class="content">

            <div class="container-fluid">
                <div class="page-title-box">

                    <div class="row align-items-center ">
                        <div class="col-md-12">
                            <div class="page-title-box">
                                <h4 class="page-title">Dashboard</h4>
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item active">Welcome to Admin dashboard</li>
                                </ol>
                            </div>
                        </div>

                    </div>
                </div>
                <!-- end page-title -->

                <!-- start top-Contant -->
                <div class="row">
                    <div class="col-sm-6 col-xl-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="row align-items-center p-1">
                                    <div class="col-lg-9">
                                        <h5 class="font-16">Users</h5>
                                        <h4 class="text-info pt-1 mb-0">{{ $user_count }}</h4>
                                    </div>
                                    <div class="col-lg-3">
                                        <i class="fa fa-2x fa-user-circle"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6 col-xl-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="row align-items-center p-1">
                                    <div class="col-lg-9">
                                        <h5 class="font-16">Blogs</h5>
                                        <h4 class="text-warning pt-1 mb-0">{{ $blog_count }}</h4>
                                    </div>
                                    <div class="col-lg-3">
                                        <i class="fa fa-2x fa-blog"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6 col-xl-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="row align-items-center p-1">
                                    <div class="col-lg-9">
                                        <h5 class="font-16">Finance partners</h5>
                                        <h4 class="text-primary pt-1 mb-0">{{ $partner_count }}</h4>
                                    </div>
                                    <div class="col-lg-3">
                                        <i class="fa fa-2x fa-handshake"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6 col-xl-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="row align-items-center p-1">
                                    <div class="col-lg-9">
                                        <h5 class="font-16">Faqs</h5>
                                        <h4 class="text-danger pt-1 mb-0">{{ $faq_count }}</h4>
                                    </div>
                                    <div class="col-lg-3">
                                        <i class="fa fa-2x fa-question-circle"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end top-Contant -->
            </div>
            <!-- container-fluid -->

        </div>
        <!-- content -->

        @include('admin.pages.footer')

    </div>
@endsection
