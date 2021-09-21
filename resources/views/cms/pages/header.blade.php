@if(Route::currentRouteName() == 'home')
<header id="ts-hero" class="ts-full-screen ts-separate-bg-element" data-mask-bottom-wn-color="#fff"
    data-bg-color="#ffffff8f" data-bg-image-opacity=".8" data-bg-parallax="scroll" data-bg-parallax-speed="3">
    <!--NAVIGATION ******************************************************************************************-->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top ts-separate-bg-element headshad" data-bg-color="#1d1d1d">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}">
                <img src="{{ asset('assets/cms/img/logo-w2.png') }}" alt="">
            </a>
            <!--end navbar-brand-->
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup"
                aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <!--end navbar-toggler-->
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav ml-auto">
                    <a class="nav-item nav-link active ts-scroll" href="{{ route('home') }}">HOME <span
                            class="sr-only">(current)</span></a>
                    <a class="nav-item nav-link ts-scroll" href="{{ route('our-blogs') }}">Blogs</a>
                    <a class="nav-item nav-link ts-scroll" href="{{ route('about-us') }}">ABOUT US</a>
                    <a class="nav-item nav-link ts-scroll" href="{{ route('faqs') }}">FAQ'S</a>
                    <a class="nav-item nav-link ts-scroll" href="{{ route('contact-us') }}">CONTACT US</a>
                    @if(!Auth::guard('web')->check())
                    <a href="{{ route('login') }}" class="btnnew1" style="color:#161b5b; font-size:14px !important;"> <i
                            class="fas fa-user ts-opacity__80 pr-2"></i>LOGIN </a>
                    <a class="logpad btnnew1" href="{{ route('registration') }}"
                        style="color:#161b5b; font-size:14px !important;"> / REGISTER</a>
                    @endif
                    @if(Auth::guard('web')->check())
                    <a href="{{ route('applyLoan') }}" class="btnnew2"
                        style="color:#1db046; font-size:14px !important;"> <i
                            class="fas fa-tags ts-opacity__80 pr-2"></i>Apply now </a>

                    @endif
                </div>


                <!--end navbar-nav-->
            </div>
            @if(Auth::guard('web')->check())
            <div class="collapse navbar-collapse" id="navbarNavDarkDropdown">
                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDarkDropdownMenuLink" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            {{ Auth::guard('web')->user()->first_name }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDarkDropdownMenuLink">
                            <li><a class="dropdown-item" href="{{ route('customer-logout') }}">Logout</a></li>
                           
                        </ul>
                    </li>
                </ul>
            </div>
            @endif
            <!--end collapse-->
        </div>
        <!--end container-->
    </nav>
    <!--end navbar-->

    <!--HERO CONTENT ****************************************************************************************-->
    <div class="container align-self-center align-items-center text-left ">
        <div class="row">
            <div class="col-md-5 col-xl-5">
                <h1>Your Digital <br> <strong style="color:#1db046 !important; font-weight: 500!important;">Loan
                    </strong>Platform </h1>
                <p class="hedtext" style="padding-bottom: 20px;">No more paying a broker fee or approaching the banks
                    one by one. </p>

                <a href="#what-youll-get" class="btn btn-primary btn-lg ts-scroll">APPLY NOW</a>
            </div>
            <div class="col-md-5 col-xl-5 text-right align-self-center align-items-center">
                <img src="{{ asset('assets/cms/img/dollercirle1.png') }}" class="mw-100" alt="">
            </div>
        </div>
    </div>
    <!--end container-->
    <div class="ts-background" data-bg-color="#fff" data-bg-parallax="scroll" data-bg-parallax-speed="3">
        <div class="owl-carousel ts-hero-slider ts-parallax-element" data-owl-loop="0" data-owl-fadeout="1">
            <div class="ts-background-image ts-opacity__70" data-bg-image="{{ asset('assets/cms/img/bg-map.jpg') }}">
            </div>

        </div>
    </div>
</header>
@else
<header>
    <!--NAVIGATION ******************************************************************************************-->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top ts-separate-bg-element headshad" data-bg-color="#1d1d1d">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}">
                <img src="{{ asset('assets/cms/img/logo-w2.png') }}" alt="">
            </a>
            <!--end navbar-brand-->
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup"
                aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <!--end navbar-toggler-->
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav ml-auto">
                    <a class="nav-item nav-link active ts-scroll" href="{{ route('home') }}">HOME <span
                            class="sr-only">(current)</span></a>
                    <a class="nav-item nav-link ts-scroll" href="{{ route('our-blogs') }}">Blogs</a>
                    <a class="nav-item nav-link ts-scroll" href="{{ route('about-us') }}">ABOUT US</a>
                    <a class="nav-item nav-link ts-scroll" href="{{ route('faqs') }}">FAQ'S</a>
                    <a class="nav-item nav-link ts-scroll" href="{{ route('contact-us') }}">CONTACT US</a>
                    @if(!Auth::guard('web')->check())
                    <a href="{{ route('login') }}" class="btnnew1" style="color:#161b5b; font-size:14px !important;"> <i
                            class="fas fa-user ts-opacity__80 pr-2"></i>LOGIN </a>
                    <a class="logpad btnnew1" href="{{ route('registration') }}"
                        style="color:#161b5b; font-size:14px !important;"> / REGISTER</a>
                    @endif
                    @if(Auth::guard('web')->check())
                    <a href="{{ route('applyLoan') }}" class="btnnew2"
                        style="color:#1db046; font-size:14px !important;"> <i
                            class="fas fa-tags ts-opacity__80 pr-2"></i>Apply now </a>
                            
                            <a class="nav-item nav-link ts-scroll" href="{{ route('customer-logout') }}">Logout</a>
                    @endif

                </div>
               
                <!--end navbar-nav-->
            </div>
            <!--end collapse-->
        </div>
        <!--end container-->
    </nav>
    <!--end navbar-->
</header>
@endif
