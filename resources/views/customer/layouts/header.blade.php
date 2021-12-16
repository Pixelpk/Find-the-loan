<link href="{{ asset('assets/cms/css/style01.css?v1') }}" rel="stylesheet" type="text/css">

<!-- Top Bar Start -->
<div class="topbar">

    <!-- LOGO -->
    <div class="topbar-left bg-white">
        <a href="{{ route('admin-dashboard') }}" class="logo">
            <img src="{{ asset('assets/images/logo.png') }}" class="logo-lg" alt="Find the loan" style="height: 3rem">
            <img src="{{ asset('assets/images/icon59.png') }}" class="logo-sm" alt="Find the loan" style="height: 2em">
        </a>
    </div>

    <!-- Search input -->
    <div class="search-wrap" id="search-wrap">
        <div class="search-bar">
            <input class="search-input" type="search" placeholder="Search" />
            <a href="#" class="close-search toggle-search" data-target="#search-wrap">
                <i class="mdi mdi-close-circle"></i>
            </a>
        </div>
    </div>

    <nav class="navbar-custom">
        <ul class="navbar-right list-inline float-right mb-0">

            <!-- full screen -->
            <li class="dropdown notification-list list-inline-item d-none d-md-inline-block">
                <a class="nav-link waves-effect" href="#" id="btn-fullscreen">
                    <i class="fas fa-expand noti-icon"></i>
                </a>
            </li>

            <li class="dropdown notification-list list-inline-item">
                <div class="dropdown notification-list nav-pro-img">
                    <a class="dropdown-toggle nav-link arrow-none waves-effect nav-user" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                        <img src="{{ asset('assets/images/user.png') }}" alt="user" class="rounded-circle">
                    </a>
                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-animated profile-dropdown">
                        <!-- item-->
                            <a class="dropdown-item" href="{{ route('customer-profile') }}"><i class="mdi mdi-account-circle"></i> Profile</a>

                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item text-danger" href="{{ route('customer-logout') }}"><i class="mdi mdi-power text-danger"></i> Logout</a>
                    </div>
                </div>
            </li>

        </ul>

        <ul class="list-inline menu-left mb-0">
            <li class="float-left">
                <button class="button-menu-mobile open-left waves-effect">
                    <i class="mdi mdi-menu"></i>
                </button>
            </li>
        </ul>

    </nav>

</div>
<!-- Top Bar End -->
