<!--NAVIGATION ******************************************************************************************-->
<nav class="navbar navbar-expand-lg navbar-light fixed-top ts-separate-bg-element headshad pt-2">
    <div class="container ">
        <a class="navbar-brand" href="{{ route('home') }}">
            <img class="img-fluid" style="height:75px" src="{{ asset('assets/cms/img/FindTheLoan Logo-02.png') }}"
                alt="logo">
        </a>
        <!--end navbar-brand-->

        <!-- MOB SERCH -->
        <!-- Button trigger modal -->
        <a class="mob-srch" href="#" data-bs-toggle="modal" data-bs-target="#exampleModal">
            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-search" width="23" height="23"
                viewBox="0 0 24 24" stroke-width="1.5" stroke="#00b341" fill="none" stroke-linecap="round"
                stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                <circle cx="10" cy="10" r="7" />
                <line x1="21" y1="21" x2="15" y2="15" />
            </svg>
        </a>

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" data-bs-backdrop="static" tabindex="-1"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="input-group">
                            <input type="search" class="form-control" placeholder="Search Here "
                                aria-describedby="button-addon2">
                            <button class="btn" type="button" id="button-addon2"
                                style="margin-right: 0;">Search</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /MOB SERCH -->

        <!-- DESK SEARCH -->
        <!-- <div class="srch">
            <input type="search" class="form-control" id="exampleInput1">
            <span>
                <a href="#">
                    <svg class="position-absolute top-50 start-50 translate-middle" xmlns="http://www.w3.org/2000/svg"
                        class="icon icon-tabler icon-tabler-arrow-narrow-right" width="30" height="30"
                        viewBox="0 0 24 24" stroke-width="1.5" stroke="#ffffff" fill="none" stroke-linecap="round"
                        stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <line x1="5" y1="12" x2="19" y2="12" />
                        <line x1="15" y1="16" x2="19" y2="12" />
                        <line x1="15" y1="8" x2="19" y2="12" />
                    </svg>
                </a>
            </span>
        </div> -->
        <!-- DESK SEARCH -->

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup"
            aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <!--end navbar-toggler-->

        <!-- MOBILE MENU -->
        <div class="collapse navbar-collapse justify-content-end" id="navbarNavAltMarkup">
            <ul class="navbar-nav mob-nav">
                <li><a href="{{ route('about-us') }}" class="nav-link">About Us</a></li>
                <li><a href="{{ route('all-blogs') }}" class="nav-link">Blog</a></li>
                <li><a href="{{ route('faqs') }}" class="nav-link">Faq</a></li>
                {{-- <li><a href="{{ route('financial-inclusion') }}" class="nav-link">Financial Inclusion</a></li> --}}
                <li><a href="{{ route('calculator') }}" class="nav-link">Tools and Calculators</a></li>
                <li><a href="{{ route('glossary') }}" class="nav-link">Glossary</a></li>
                <li><a href="{{ route('faqs') }}" class="nav-link">Terms of use</a></li>
                <li><a href="{{ route('faqs') }}" class="nav-link">Privacy policy</a></li>
                <li><a href="{{ route('contact-us') }}" class="nav-link">Contact</a></li>
            </ul>
            <!-- /MOBILE MENU -->
            <ul class="navbar-nav desk-nav justify-content-end">
                <li>
                    <a href="">
                        <div class="btn-group desk-menu">
                            @php
                            $current_route = Route::currentRouteName();

                            if ($current_route == 'blog') {
                            $route = route('all-blogs');
                            }else if( ($current_route == 'login')){
                            $route = route('home');
                            $current_route = 'home';
                            }
                            else {
                            $route = route($current_route);
                            }
                            @endphp
                            @if($current_route != "applyLoan" && $current_route != "draftLoan")

                            <a href="{{$route}}" class="btn btn-h" style="border-top-left-radius: 0.25rem; border-bottom-left-radius: 0.25rem;">{{ getCmsRoute($current_route)}}</a>
                            <button type="button" class="btn dropdown-toggle dropdown-toggle-split" id="dropdownMenuReference"
                                data-bs-toggle="dropdown" aria-expanded="false" data-bs-reference="parent">
                                <span class="visually-hidden">Toggle Dropdown</span>
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuReference">
                            <li><a href="{{ route('home') }}" class="dropdown-item">Home</a></li>
                                <li><a href="{{ route('about-us') }}" class="dropdown-item">About Us</a></li>
                                <li><a href="{{ route('all-blogs') }}" class="dropdown-item">Blog</a></li>
                                <li><a href="{{ route('faqs') }}" class="dropdown-item">Faq</a></li>
                                {{-- <li><a href="{{ route('financial-inclusion') }}" class="dropdown-item">Financial Inclusion</a></li> --}}
                                <li><a href="{{ route('calculator') }}" class="dropdown-item">Tools and Calculators</a></li>
                                <li><a href="{{ route('glossary') }}" class="dropdown-item">Glossary</a></li>
                                <li><a href="{{ route('terms-conditions') }}" class="dropdown-item">Terms of use</a></li>
                                <li><a href="{{ route('privacy-policy') }}" class="dropdown-item">Privacy policy</a></li>
                                <li><a href="{{ route('contact-us') }}" class="dropdown-item">Contact us</a></li>
                            </ul>
                            @endif
                    </div>
                    </a>
                </li>
                <li>
                    <a href="#" class="nav-link">
                        @if(!Auth::guard('web')->check())
                        <!-- LOGIN BUTTON -->
                        <a href="{{ route('login') }}" class="btnnew1 btn">Login </a>
                        <!-- REGISTER BUTTON -->
                        <a class="logpad btnnew1 btn" href="{{ route('registration') }}"> Signup</a>
                        @endif
                    </a>
                </li>

                <li>
                    <a href="#" class="nav-link">
                        @if(Auth::guard('web')->check())
                            @if(Route::currentRouteName() != "applyLoan")
                            <a href="{{ route('applyLoan') }}" class="btnnew2 btn">Apply </a>
                            @endif
                        @endif
                    </a>
                </li>

                <li>
                    <a href="#" class="nav-link">
                        @if(Auth::guard('web')->check())
                            <a href="{{ route('draftLoan') }}" class="btnnew2 btn">Draft </a>
                        @endif
                    </a>
                </li>

                @if(Auth::guard('web')->check())
                <li>
                    <a href="#" class="nav-link">
                        @if(Auth::guard('web')->check())
                        <div class="dropdown user-dropdown ms-md-3 me-0 d-none d-lg-inline-block">
                            <a href="" class="" id="dropdownMenuOffset" data-bs-toggle="dropdown" aria-expanded="false"
                                data-bs-offset="10,20">
                                <span class="">Hi, {{ Auth::user()->first_name }}</span>
                                <img height="40" src="{{ asset('assets/cms/img/Home/user.svg') }}" alt="user">
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuOffset">
                                <li><a class="dropdown-item" href="{{ route('customer-dashboard') }}">Dashboard</a></li>
                                <li><a class="dropdown-item" href="{{ route('customer-logout') }}">Logout</a></li>
                            </ul>
                        </div>
                        @endif
                    </a>
                </li>
                @endif
            </ul>
            <!-- DESKTOP MENU -->

            <!-- /DESKTOP MENU -->
        </div>



        <!--end container-->
</nav>
<!--end navbar-->
