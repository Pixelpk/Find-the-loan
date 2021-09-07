<!-- ========== Left Sidebar Start ========== -->
<div class="left side-menu">
    <div class="slimscroll-menu" id="remove-scroll">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu" id="side-menu">
                <li class="menu-title">Menu</li>
                <li>
                    <a href="{{ route('admin-dashboard') }}" class="waves-effect @if(Route::CurrentRouteName() == 'admin-dashboard') mm-active @endif">
                        <i class="dripicons-meter"></i><span> Dashboard </span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('faq') }}" class="waves-effect @if(Route::CurrentRouteName() == 'faq')  mm-active @endif">
                        <i class="dripicons-question"></i><span> Faqs </span>
                    </a>
                </li>

{{--                <li>--}}
{{--                    <a href="javascript:void(0);" class="waves-effect"><i class="dripicons-mail"></i><span> User Management <span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span> </span></a>--}}
{{--                    <ul class="submenu">--}}
{{--                        <li><a href="email-inbox.html">Users</a></li>--}}
{{--                        <li><a href="email-read.html">Approval request</a></li>--}}
{{--                        <li><a href="email-compose.html">Email Compose</a></li>--}}
{{--                    </ul>--}}
{{--                </li>--}}

            </ul>

        </div>
        <!-- Sidebar -->
        <div class="clearfix"></div>

    </div>
    <!-- Sidebar -left -->

</div>
<!-- Left Sidebar End -->
