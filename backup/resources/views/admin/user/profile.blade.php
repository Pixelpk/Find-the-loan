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
                                <h4 class="page-title">Admin profile</h4>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end page-title -->

                <div class="row">
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-body">

                                <h4 class="mt-0 header-title">Update profile</h4>
                                <form class="" method="post" action="{{ route('update-admin') }}">
                                    @csrf
                                    <div class="form-group">
                                        <label>First name</label>
                                        <input type="text" class="form-control" required placeholder="First name" value="{{ Auth::user()->first_name }}" name="first_name" />
                                    </div>
                                    <div class="form-group">
                                        <label>Last name</label>
                                        <input type="text" value="{{ Auth::user()->last_name }}" class="form-control" required placeholder="Last name" name="last_name" />
                                    </div>

                                    <div class="form-group">
                                        <label>E-Mail</label>
                                        <div>
                                            <input type="email" disabled value="{{ Auth::user()->email }}" name="email" class="form-control" required parsley-type="email" placeholder="Enter a valid e-mail" />
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label>Mobile number</label>
                                        <div>
                                            <input type="text" value="{{ Auth::user()->phone }}" class="form-control" required placeholder="phone" name="phone" />
                                        </div>
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

                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-body">

                                <h4 class="mt-0 header-title">Update password</h4>

                                <form method="post" action="{{ route('update-password') }}">
                                    @csrf
                                    <div class="form-group">
                                        <label>Old password</label>
                                        <div>
                                            <input type="password" required name="old_password" class="form-control" placeholder="Old password">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>New password</label>
                                        <div>
                                            <input type="password" required name="password" class="form-control" placeholder="Current Password">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Confirm password</label>
                                        <div>
                                            <input type="password" required name="password_confirmation" class="form-control" placeholder="New Password">
                                        </div>
                                    </div>

                                    <div class="form-group mb-0">
                                        <div>
                                            <button type="submit" class="btn btn-primary waves-effect waves-light">
                                                Update
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
