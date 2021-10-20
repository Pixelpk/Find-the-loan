
    <!--NAVIGATION ******************************************************************************************-->
    <nav class="navbar navbar-expand-md navbar-light fixed-top ts-separate-bg-element headshad">
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
                   <div class="btn-group">
    <a href="{{ route('home') }}" class="btn btn-h">Home</a>
    <button type="button" class="btn dropdown-toggle dropdown-toggle-split" id="dropdownMenuReference" data-bs-toggle="dropdown" aria-expanded="false" data-bs-reference="parent">
      <span class="visually-hidden">Toggle Dropdown</span>
    </button>
    <ul class="dropdown-menu" aria-labelledby="dropdownMenuReference">
    <li><a href="{{ route('about-us') }}" class="dropdown-item">About</a></li>
    <li><a href="{{ route('our-blogs') }}" class="dropdown-item">Blog</a></li>
    <li><a href="{{ route('faqs') }}" class="dropdown-item">Faq</a></li>
    <li><a href="{{ route('faqs') }}" class="dropdown-item">Financial Inclusion</a></li>
    <li><a href="{{ route('faqs') }}" class="dropdown-item">Glossary</a></li>
    <li><a href="{{ route('faqs') }}" class="dropdown-item">Terms of uses</a></li>
    <li><a href="{{ route('faqs') }}" class="dropdown-item">Privacy policy</a></li>
    <li><a href="{{ route('contact-us') }}" class="dropdown-item">Contact</a></li>
    </ul>
  </div>   
                   
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

