<div>
    <div class="content-page">
        <div class="content">

            <div class="container-fluid">
                <div class="page-title-box">

                    <div class="row align-items-center ">
                        <div class="col-md-12">
                            <div class="page-title-box">
                                <h4 class="page-title">Overview</h4>

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
                                        <h5 class="font-16">Enquiries</h5>
                                        <h4 class="text-info pt-1 mb-0">{{ $user_enquiries}}</h4>
                                    </div>
                                    <div class="col-lg-3">
                                        <i class="fa fa-2x fa-user-circle"></i>
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
</div>
