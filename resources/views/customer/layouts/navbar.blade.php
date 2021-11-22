<!-- ========== Left Sidebar Start ========== -->
<div class="left side-menu">
    <div class="slimscroll-menu" id="remove-scroll">
        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu" id="side-menu">
                <li class="menu-title">Menu</li>
                <li>
                    <a href="{{ route('customer-dashboard') }}" class="waves-effect @if(Route::CurrentRouteName() == 'customer-dashboard')  mm-active @endif">
                        <i class="dripicons-meter"></i><span> Dashboard </span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('customer-enquiry', ['profile' => 1]) }}" class="waves-effect @if(Route::CurrentRouteName() == 'customer-enquiry' && Request::get('profile') == '1' ) mm-active @endif">
                        <i class="dripicons-meter"></i><span> Business Enquiry </span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('customer-enquiry', ['profile' => 2]) }}" class="waves-effect @if(Route::CurrentRouteName() == 'customer-enquiry' && Request::get('profile') == '2' )) mm-active  @endif">
                        <i class="dripicons-meter"></i><span> Consumer Enquiry </span>
                    </a>
                </li>
            </ul>
        </div>
        <!-- Sidebar -->
        <div class="clearfix"></div>
    </div>
    <!-- Sidebar -left -->
</div>
<!-- Left Sidebar End -->