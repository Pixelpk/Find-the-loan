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
                                <h4 class="page-title">Additional doc info</h4>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end page-title -->

                <div class="row">
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-body">

                                <h4 class="mt-0 header-title">Add additional doc info</h4>
                                <form class="" method="post" action="{{ route('additional-doc-info') }}">
                                    @csrf
                                    <div class="form-group">
                                        <label>Info Type</label>
                                        <select class="form-control" name="info_type" required>
                                            <option value="1">Company related</option>
                                            <option value="2">ACRA related</option>
                                            <option value="3">Project.Invoice/PO financing related</option>
                                            <option value="4">DCP and Secured overdraft related</option>
                                            <option value="5">Machinery/equipment/vehicle related</option>
                                            <option value="6">Individual related</option>
                                            <option value="7">Property related</option>
                                            <option value="8">Equipment/Vehicle related</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Info</label>
                                        <input class="form-control" name="info" type="text" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Doc type</label>
                                        <select class="form-control" name="doc_type" required>
                                            <option value="1">File</option>
                                            <option value="2">Input</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Additional description</label>
                                        <input class="form-control" name="additional_description" type="text">
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

            </div>
            <!-- container-fluid -->

        </div>
        <!-- content -->

        @include('admin.pages.footer')

    </div>
@endsection
