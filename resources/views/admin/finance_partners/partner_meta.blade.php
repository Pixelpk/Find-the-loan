@extends("admin.layouts.master")
@section('content')
    <div class="content-page">
        <!-- Start content -->
        <div class="content">

            <div class="container-fluid">
                <div class="page-title-box">

                    <div class="row align-items-center ">
                        <div class="col-md-8">
                            <div class="page-title-box">
                                <h4 class="page-title">Partner Details</h4>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="float-right d-none d-md-block">
                                <a href="{{route('update-partner-meta')}}" class="btn admin-btn">Update details</a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end page-title -->
                <div class="row">

                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="col-lg-12">
                                    <h5>Terms & Conditions</h5>
                                        @if (isset($partners_meta['terms_condition']))
                                        
                                        {!! $partners_meta['terms_condition'] !!}
                                        @else
                                        <p>Please update your terms & conditions.</p>
                                        @endif
                                </div>
                                <div class="col-lg-12">
                                    <h5>Promo</h5>
                                    @if (isset($partners_meta['promo']))
                                    {!! $partners_meta['promo'] !!}
                                    @else
                                        <p>Please update your Promo.</p>
                                    @endif
                                </div>
                                <div class="col-lg-12">
                                    <h5>Subsidy & Features</h5>
                                    @if (isset($partners_meta['subsidy_features']))
                                    {!! $partners_meta['subsidy_features'] !!}
                                    @else
                                        <p>Please update your subsidy & features.</p>
                                    @endif
                                </div>
                                <div class="col-lg-12">
                                    <h5>Board rate</h5>
                                    @if (isset($partners_meta['board_rate']))
                                        @foreach ($partners_meta['board_rate'] as $key=>$item)
                                            <span>{{$item['date']}} : {{$item['rate']}}</span><br>
                                    
                                        @endforeach
                                    @else
                                        <p>Please update your Board rate.</p>
                                    @endif
                                </div>
                                
                            </div>
                        </div>
                    </div>
                    <!-- end col -->
                </div>
                <!-- end row -->



            </div>
            <!-- container-fluid -->

        </div>
        <!-- content -->

        @include('admin.pages.footer')

    </div>
@endsection
