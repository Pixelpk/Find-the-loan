@if(Route::currentRouteName() == 'home')
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
            <div class="collapse navbar-collapse justify-content-end" id="navbarNavAltMarkup">
                <ul class="navbar-nav">
                   <li class="nav-item">
                       <a class="nav-link active ts-scroll" href="{{ route('home') }}">HOME <span
                            class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item">  <a class="nav-link ts-scroll" href="{{ route('our-blogs') }}">BLOGS</a>
                    </li>
                  <li class="nav-item">
                  <a class="nav-link ts-scroll" href="{{ route('about-us') }}">ABOUT US</a>
                  </li>
                    <li class="nav-item">
                    <a class="nav-link ts-scroll" href="{{ route('faqs') }}">FAQ'S</a>
                    </li>
                   <li class="nav-item">
                   <a class="nav-link ts-scroll" href="{{ route('contact-us') }}">CONTACT US</a>
                   </li>
    </ul>
                   
                    @if(!Auth::guard('web')->check())
                    <!-- LOGIN BUTTON -->
                    <a href="{{ route('login') }}" class="btnnew1 btn">LOGIN </a>
                        <!-- REGISTER BUTTON -->
                    <a class="logpad btnnew1 btn" href="{{ route('registration') }}"> REGISTER</a>
                    @endif
                    @if(Auth::guard('web')->check())
                    <a href="{{ route('applyLoan') }}" class="btnnew2 btn"> 
                        <i class="fas fa-tags ts-opacity__80 pr-2"></i>Apply now </a>

                    @endif

                    @if(Auth::guard('web')->check())
            <a href="{{ route('customer-logout') }}" class="btn log-btn btnnew1">Logout </a>
            @endif
            <!--end collapse-->
                <!--end navbar-nav-->
            </div>
           
        <!--end container-->
    </nav>
    <!--end navbar-->

    <!--HERO CONTENT ****************************************************************************************-->
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
            <div class="collapse navbar-collapse justify-content-end" id="navbarNavAltMarkup">
                <ul class="navbar-nav">
                   <li class="nav-item">
                       <a class="nav-link ts-scroll active" href="{{ route('home') }}">HOME <span
                            class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item">  <a class="nav-link ts-scroll" href="{{ route('our-blogs') }}">BLOGS</a>
                    </li>
                  <li class="nav-item">
                  <a class="nav-link ts-scroll" href="{{ route('about-us') }}">ABOUT US</a>
                  </li>
                    <li class="nav-item">
                    <a class="nav-link ts-scroll" href="{{ route('faqs') }}">FAQ'S</a>
                    </li>
                   <li class="nav-item">
                   <a class="nav-link ts-scroll" href="{{ route('contact-us') }}">CONTACT US</a>
                   </li>
</ul>
                   
                    @if(!Auth::guard('web')->check())
                    <!-- LOGIN BUTTON -->
                    <a href="{{ route('login') }}" class="btnnew1 btn">LOGIN </a>
                        <!-- REGISTER BUTTON -->
                    <a class="logpad btnnew1 btn" href="{{ route('registration') }}"> REGISTER</a>
                    @endif
                    @if(Auth::guard('web')->check())
                    <a href="{{ route('applyLoan') }}" class="btnnew2 btn"> 
                        <i class="fas fa-tags ts-opacity__80 pr-2"></i>Apply now </a>

                    @endif

                    @if(Auth::guard('web')->check())
            <a href="{{ route('customer-logout') }}" class="btn log-btn btnnew1">Logout </a>
            @endif
            <!--end collapse-->
                <!--end navbar-nav-->
            </div>
          
        </div>
        <!--end container-->
    </nav>
    <!--end navbar-->
</header>
@endif
