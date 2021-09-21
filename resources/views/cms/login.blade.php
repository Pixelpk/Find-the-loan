@extends('cms.layouts.master')
@section('content')

<!--end breadcrumb-wrapper-->

<!--begin blog -->
<section class="section-white small-padding">

    <!--begin container-->
    <div class="container">

        <!--begin row-->
        <div class="row">
            <div class="col-md 3"></div>
            <!--begin col-sm-6 -->
            <div class="col-sm-6" style="padding-top: 60px;">
                @if(session('message'))
                {{-- <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Info!</strong> {{ session('message') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div> --}}
                 <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Message!</strong> {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>
                @endif
                @if(session('error'))
                {{-- <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Info!</strong> {{ session('error') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div> --}}
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Error!</strong> {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>
                @endif
                <h3>Login</h3>

                <!--begin success message -->
                <p class="contact_success_box" style="display:none;">We received your message and you'll hear from us
                    soon. Thank You!</p>
                <!--end success message -->

                <!--begin contact form -->
                <form id="contact-form" class="contact" action="{{ route('loginAttempt') }}" method="post">
                    @csrf
                  <div>
                    <input class="contact-input white-input custominput" required="" name="email" placeholder="Email*"
                    type="email" >
                    @error('email')
                    <span class="customspan">{{ $message }}</span>
                    @enderror
                  </div>
                        
                 <div>
                    <input style="margin-top:15px;" class="contact-input white-input custominput" required="" name="password"
                    placeholder="Password*" type="password">
                    @error('password')
                    <span class="customspan">{{ $message }}</span>
                    @enderror
                   
                 </div>
                  
                    <input style="margin-left: 0px;" value="Login" id="submit-button" class="btn btn-primary" type="submit">
                </form>
                <!--end contact form -->
            </div>
            <div class="col-md 3"></div>
            <!--end col-sm-6-->
            <!--begin col-sm-6 -->
            <!--end col-sm-6-->
        </div>
        <!--end row-->

    </div>
    <!--end container-->

</section>
<!--end blog -->
@endsection
