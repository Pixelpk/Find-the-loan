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

{{--            <li class="list-inline-item dropdown notification-list d-none d-md-inline-block">--}}
{{--                <a class="nav-link waves-effect toggle-search" href="#" data-target="#search-wrap">--}}
{{--                    <i class="fas fa-search noti-icon"></i>--}}
{{--                </a>--}}
{{--            </li>--}}

            <!-- language-->
{{--            <li class="dropdown notification-list list-inline-item d-none d-md-inline-block">--}}
{{--                <a class="nav-link dropdown-toggle arrow-none waves-effect" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">--}}
{{--                    <img src="assets/images/flags/us_flag.jpg" class="mr-2" height="12" alt="" /> English <span class="mdi mdi-chevron-down"></span>--}}
{{--                </a>--}}
{{--                <div class="dropdown-menu dropdown-menu-right dropdown-menu-animated language-switch">--}}
{{--                    <a class="dropdown-item" href="#"><img src="{{ asset('assets/images/flags/french_flag.jpg') }}" alt="" height="16" /><span> French </span></a>--}}
{{--                    <a class="dropdown-item" href="#"><img src="{{ asset('assets/images/flags/spain_flag.jpg') }}" alt="" height="16" /><span> Spanish </span></a>--}}
{{--                    <a class="dropdown-item" href="#"><img src="{{ asset('assets/images/flags/russia_flag.jpg') }}" alt="" height="16" /><span> Russian </span></a>--}}
{{--                    <a class="dropdown-item" href="#"><img src="{{ asset('assets/images/flags/germany_flag.jpg') }}" alt="" height="16" /><span> German </span></a>--}}
{{--                    <a class="dropdown-item" href="#"><img src="{{ asset('assets/images/flags/italy_flag.jpg') }}" alt="" height="16" /><span> Italian </span></a>--}}
{{--                </div>--}}
{{--            </li>--}}

            <!-- full screen -->
            <li class="dropdown notification-list list-inline-item d-none d-md-inline-block">
                <a class="nav-link waves-effect" href="#" id="btn-fullscreen">
                    <i class="fas fa-expand noti-icon"></i>
                </a>
            </li>

            <!-- notification -->
{{--            <li class="dropdown notification-list list-inline-item">--}}
{{--                <a class="nav-link dropdown-toggle arrow-none waves-effect" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">--}}
{{--                    <i class="fas fa-bell noti-icon"></i>--}}
{{--                    <span class="badge badge-pill badge-danger noti-icon-badge">3</span>--}}
{{--                </a>--}}
{{--                <div class="dropdown-menu dropdown-menu-right dropdown-menu-animated dropdown-menu-lg px-1">--}}
{{--                    <!-- item-->--}}
{{--                    <h6 class="dropdown-item-text">--}}
{{--                        Notifications--}}
{{--                    </h6>--}}
{{--                    <div class="slimscroll notification-item-list">--}}
{{--                        <!-- item-->--}}
{{--                        <a href="javascript:void(0);" class="dropdown-item notify-item active">--}}
{{--                            <div class="notify-icon bg-success"><i class="mdi mdi-cart-outline"></i></div>--}}
{{--                            <p class="notify-details"><b>Your order is placed</b><span class="text-muted">Dummy text of the printing and typesetting industry.</span></p>--}}
{{--                        </a>--}}

{{--                        <!-- item-->--}}
{{--                        <a href="javascript:void(0);" class="dropdown-item notify-item">--}}
{{--                            <div class="notify-icon bg-danger"><i class="mdi mdi-message-text-outline"></i></div>--}}
{{--                            <p class="notify-details"><b>New Message received</b><span class="text-muted">You have 87 unread messages</span></p>--}}
{{--                        </a>--}}

{{--                        <!-- item-->--}}
{{--                        <a href="javascript:void(0);" class="dropdown-item notify-item">--}}
{{--                            <div class="notify-icon bg-info"><i class="mdi mdi-filter-outline"></i></div>--}}
{{--                            <p class="notify-details"><b>Your item is shipped</b><span class="text-muted">It is a long established fact that a reader will</span></p>--}}
{{--                        </a>--}}

{{--                        <!-- item-->--}}
{{--                        <a href="javascript:void(0);" class="dropdown-item notify-item">--}}
{{--                            <div class="notify-icon bg-success"><i class="mdi mdi-message-text-outline"></i></div>--}}
{{--                            <p class="notify-details"><b>New Message received</b><span class="text-muted">You have 87 unread messages</span></p>--}}
{{--                        </a>--}}

{{--                        <!-- item-->--}}
{{--                        <a href="javascript:void(0);" class="dropdown-item notify-item">--}}
{{--                            <div class="notify-icon bg-warning"><i class="mdi mdi-cart-outline"></i></div>--}}
{{--                            <p class="notify-details"><b>Your order is placed</b><span class="text-muted">Dummy text of the printing and typesetting industry.</span></p>--}}
{{--                        </a>--}}

{{--                    </div>--}}
{{--                    <!-- All-->--}}
{{--                    <a href="javascript:void(0);" class="dropdown-item text-center notify-all text-primary">--}}
{{--                        View all <i class="fi-arrow-right"></i>--}}
{{--                    </a>--}}
{{--                </div>--}}
{{--            </li>--}}

            <li class="dropdown notification-list list-inline-item">
                <div class="dropdown notification-list nav-pro-img">
                    <a class="dropdown-toggle nav-link arrow-none waves-effect nav-user" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                        <img src="{{ asset('assets/images/user.png') }}" alt="user" class="rounded-circle">
                    </a>
                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-animated profile-dropdown">
                        <!-- item-->
                        @if(Auth::guard('partners')->check())
                            <a class="dropdown-item" href="{{ route('partner-profile') }}"><i class="mdi mdi-account-circle"></i> Profile</a>
                        @else
                            <a class="dropdown-item" href="{{ route('admin-profile') }}"><i class="mdi mdi-account-circle"></i> Profile</a>
                        @endif
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item text-danger" href="{{ route('admin-logout') }}"><i class="mdi mdi-power text-danger"></i> Logout</a>
                    </div>
                </div>
            </li>

        </ul>

        <ul class="list-inline menu-left mb-0">
            <li class="float-left">
                <button class="button-menu-mobile open-left waves-effect">
                    <i class="mdi mdi-arrow-left"></i>
                    <i class="mdi mdi-arrow-right d-none"></i>
                </button>
            </li>
        </ul>

    </nav>

</div>
<!-- Top Bar End -->
