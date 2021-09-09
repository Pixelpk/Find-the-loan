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
                    <a href="{{ route('loan-types') }}" class="waves-effect @if(Route::CurrentRouteName() == 'loan-types') mm-active @endif">
                        <i class="fa fa-money-bill-alt"></i><span> Loan Types </span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('loan-reasons') }}" class="waves-effect @if(Route::CurrentRouteName() == 'loan-reasons') mm-active @endif">
                        <i class="fa fa-list"></i><span> Loan reasons </span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('company-structure-type') }}" class="waves-effect @if(Route::CurrentRouteName() == 'company-structure-type') mm-active @endif">
                        <i class="fa fa-object-group"></i><span> Company structures </span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('site-data') }}" class="waves-effect @if(Route::CurrentRouteName() == 'site-data') mm-active @endif">
                        <i class="dripicons-web"></i><span> Site Data </span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('blogs') }}" class="waves-effect @if(Route::CurrentRouteName() == 'blogs')  mm-active @endif">
                        <i class="fa fa-blog"></i><span> Blogs </span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('faq') }}" class="waves-effect @if(Route::CurrentRouteName() == 'faq')  mm-active @endif">
                        <i class="dripicons-question"></i><span> Faqs </span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('finance-partners') }}" class="waves-effect @if(Route::CurrentRouteName() == 'finance-partners')  mm-active @endif">
                        <i class="fa fa-handshake"></i><span> Finance partners </span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('testimonials') }}" class="waves-effect @if(Route::CurrentRouteName() == 'testimonials')  mm-active @endif">
                        <i class="fa fa-quote-left"></i><span> Testimonials </span>
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
