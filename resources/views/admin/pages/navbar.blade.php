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
                        <i class="dripicons-meter"></i><span> Overview </span>
                    </a>
                </li>
                @if(Auth::guard('partners')->check())
                    <li>
                        <a href="{{ route('partner-users') }}" class="waves-effect">
                            <i class="fa fa-users"></i><span> Partner Users </span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('loan-applications',['profile'=>'1']) }}" class="@if((Route::CurrentRouteName() == 'loan-applications') && ($_GET['profile'] == 1)) mm-active @endif">
                            <i class="fa fa-money-bill-alt"></i><span> Business enquiries</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('loan-applications',['profile'=>'2']) }}" class="@if((Route::CurrentRouteName() == 'loan-applications') && ($_GET['profile'] == 2)) mm-active @endif">
                            <i class="fa fa-money-bill-alt"></i><span> Consumer enquiries </span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('quoted-customer') }}" class="@if(Route::CurrentRouteName() == 'quoted-customer') mm-active @endif">
                            <i class="fa fa-money-bill-alt"></i><span> Quoted customer </span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('rejected-applications') }}" class="@if(Route::CurrentRouteName() == 'rejected-applications') mm-active @endif">
                            <i class="fa fa-money-bill-alt"></i><span> Rejected </span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('assigned-out') }}" class="@if(Route::CurrentRouteName() == 'assigned-out') mm-active @endif">
                            <i class="fa fa-money-bill-alt"></i><span> Assigned out </span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('ask-more-docs-applications') }}" class="@if(Route::CurrentRouteName() == 'ask-more-docs-applications') mm-active @endif">
                            <i class="fa fa-money-bill-alt"></i><span> Ask for more docs </span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('replied-with-docs') }}" class="@if(Route::CurrentRouteName() == 'replied-with-docs') mm-active @endif">
                            <i class="fa fa-money-bill-alt"></i><span> Replied with docs </span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('pending-meet-applications') }}" class="@if(Route::CurrentRouteName() == 'pending-meet-applications') mm-active @endif">
                            <i class="fa fa-money-bill-alt"></i><span> Pending meet call </span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('customer-applied') }}" class="@if(Route::CurrentRouteName() == 'customer-applied') mm-active @endif">
                            <i class="fa fa-money-bill-alt"></i><span> Customer applied </span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('loan-offer-sign-list') }}" class="@if(Route::CurrentRouteName() == 'loan-offer-sign-list') mm-active @endif">
                            <i class="fa fa-money-bill-alt"></i><span> Loan offer signed </span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('loan-offer-disburse-list') }}" class="@if(Route::CurrentRouteName() == 'loan-offer-disburse-list') mm-active @endif">
                            <i class="fa fa-money-bill-alt"></i><span> Loan offer disbursed </span>
                        </a>
                    </li>
                    {{-- <li>
                        <a href="javascript:void(0);" class="waves-effect"><i class="fa fa-list"></i><span> Loan enquiries <span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span> </span></a>
                        <ul class="submenu">
                            <li>
                                <a href="{{ route('loan-applications',['profile'=>'1']) }}" class="@if(Route::CurrentRouteName() == 'loan-applications') mm-active @endif">
                                    <i class="fa fa-money-bill-alt"></i><span> Business </span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('loan-applications',['profile'=>'2']) }}" class="@if(Route::CurrentRouteName() == 'loan-applications') mm-active @endif">
                                    <i class="fa fa-money-bill-alt"></i><span> Consumer </span>
                                </a>
                            </li>
                        </ul>
                    </li> --}}

                   <li>
                       <a href="{{ route('partner-sales-report') }}" class="waves-effect">
                           <i class="fa fa-list"></i><span> Sales report </span>
                       </a>
                   </li>
                   <li>
                    <a href="{{ route('partner-meta') }}" class="waves-effect">
                        <i class="dripicons-document"></i><span> Update details </span>
                    </a>
                </li>
                    <li>
                        {{-- <a href="{{ route('partner-terms-conditions') }}" class="waves-effect">
                            <i class="dripicons-document"></i><span class="@if(bankUserTermsRequest() == 1) blinking @endif"> Terms & Conditions </span>
                        </a> --}}
                        <a href="{{ route('partner-meta-requests') }}" class="waves-effect">
                            <i class="dripicons-document"></i><span>Update detail requests</span>
                        </a>
                    </li>
                @else
                    <li>
                        <a href="javascript:void(0);" class="waves-effect"><i class="dripicons-web"></i><span> CMS <span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span> </span></a>
                        <ul class="submenu">
                            <li>
                                <a href="{{ route('site-data') }}" class="@if(Route::CurrentRouteName() == 'site-data') mm-active @endif">
                                    <i class="dripicons-web"></i><span> Site Data </span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('blogs') }}" class="@if(Route::CurrentRouteName() == 'blogs')  mm-active @endif">
                                    <i class="fa fa-blog"></i><span> Blogs </span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('faq') }}" class="@if(Route::CurrentRouteName() == 'faq')  mm-active @endif">
                                    <i class="dripicons-question"></i><span> Faqs </span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('testimonials') }}" class="@if(Route::CurrentRouteName() == 'testimonials')  mm-active @endif">
                                    <i class="fa fa-quote-left"></i><span> Testimonials </span>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li>
                        <a href="javascript:void(0);" class="waves-effect"><i class="fa fa-list"></i><span> Loan Management <span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span> </span></a>
                        <ul class="submenu">
                            <li>
                                <a href="{{ route('loan-types') }}" class="@if(Route::CurrentRouteName() == 'loan-types') mm-active @endif">
                                    <i class="fa fa-money-bill-alt"></i><span> Loan Types </span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('loan-reasons') }}" class="@if(Route::CurrentRouteName() == 'loan-reasons') mm-active @endif">
                                    <i class="fa fa-list"></i><span> Loan reasons </span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('company-structure-type') }}" class="waves-effect @if(Route::CurrentRouteName() == 'company-structure-type') mm-active @endif">
                                    <i class="fa fa-object-group"></i><span> Company structures </span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('sectors') }}" class="waves-effect @if(Route::CurrentRouteName() == 'sectors') mm-active @endif">
                                    <i class="fa fa-industry"></i><span> Sectors </span>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li>
                        <a href="{{ route('users') }}" class="waves-effect @if(Route::CurrentRouteName() == 'users') mm-active @endif">
                            <i class="fa fa-users"></i><span>Platform Users </span>
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('finance-partners') }}" class="waves-effect @if(Route::CurrentRouteName() == 'finance-partners')  mm-active @endif">
                            <i class="fa fa-handshake"></i><span> Finance partners </span>
                        </a>
                    </li>
                    <li>
                        {{-- <a href="{{ route('conditions-approval-requests') }}" class="waves-effect">
                            <i class="dripicons-document"></i><span> Terms&Conditions requests </span><span style="color: #27b34d">@if(adminTermsRequests() > 0) ({{adminTermsRequests()}}) @endif</span>
                        </a> --}}
                        <a href="{{ route('partner-meta-requests') }}" class="waves-effect">
                            <i class="dripicons-document"></i><span>Update detail requests</span>
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('admin-sales-report') }}" class="waves-effect">
                            <i class="fa fa-list"></i><span> Sales report </span>
                        </a>
                    </li>
                @endif

            </ul>

        </div>
        <!-- Sidebar -->
        <div class="clearfix"></div>

    </div>
    <!-- Sidebar -left -->

</div>
<!-- Left Sidebar End -->
