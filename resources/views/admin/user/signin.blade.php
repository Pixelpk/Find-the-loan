@extends("admin.layouts.auth")
@section('content')
    <div class="accountbg"></div>

    <!-- Begin page -->
    {{--<div class="home-btn d-none d-sm-block">--}}
    {{--    <a href="index.html" class="text-white"><i class="mdi mdi-home h1"></i></a>--}}
    {{--</div>--}}

    <div class="wrapper-page">

        <div class="container">
            <div class="row align-items-center justify-content-center">
                <div class="col-lg-5">
                    <div class="card card-pages shadow-none mt-4">
                        <div class="card-body">
                            <div class="text-center mt-0 mb-5">
                                <a href="{{ route('admin-login') }}" class="logo logo-admin">
                                    <img src="{{ asset('assets/images/logo.png') }}" class="mt-3" alt="Find the loan" style="height: 4.5em"></a>
                            </div>

                            <form method="post" class="form-horizontal mt-6" action="{{ $login_url }}">
                                @csrf
                                <div class="form-group">
                                    <div class="col-12">
                                        <label for="username">Email</label>
                                        <input class="form-control" type="email" required="" id="email" name="email" placeholder="Email">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-12">
                                        <label for="password">Password</label>
                                        <input class="form-control" type="password" name="password" required="" id="password" placeholder="Password">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-12">
                                        <div class="checkbox checkbox-primary">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="customCheck1">
                                                <label class="custom-control-label" for="customCheck1"> Remember me</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group text-center mt-3">
                                    <div class="col-12">
                                        <button class="btn btn-primary btn-block waves-effect waves-light" type="submit">Log In</button>
                                    </div>
                                </div>

                            </form>

                        </div>

                    </div>

                </div>
            </div>
            <!-- end row -->
        </div>
    </div>
@endsection
