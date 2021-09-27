@extends('cms.layouts.master')
@section('content')
    <div class="breadcrumb-wrapper">

        <div class="breadcrumb-wrapper-overlay"></div>

        <!--begin container -->
        <div class="container">

            <!--begin row -->
            <div class="row">

                <!--begin col-xs-12 -->
                <div class="col-sm-12 col-lg-12 col-xs-12">

                    <h2 class="page-title white text-center">About Us</h2>

                </div>


                <!--end col-xs-12 -->

            </div>
            <!--end row -->

        </div>
        <!--end container -->

    </div>
    <!--end breadcrumb-wrapper-->

    <!--begin section-white -->
    <section class="section-white-services">

        <!--begin container-->
        <div class="container">

            <!--begin row-->
            <div class="row">

                <!--begin col-md-6-->
                <div class="col-md-6 text-center wow fadeIn" data-wow-delay="0.15s">

                    <div class="video-wrapper">

                        <!--begin popup-gallery-->
                        <div class="popup-gallery">

                        </div>
                        <!--end popup-gallery-->

                    </div>

                </div>
                <!--end col-sm-6-->

                <!--begin col-md-6-->
                <div class="col-md-6">
                    {!! $about_us->value !!}
{{--                    <h5>About Us</h5>--}}
{{--                    <h3>Find the Loan Financial originated in 2000 with five strong principles</h3>--}}

{{--                    <p class="medium-paragraph margin-bottom-40">Nemo enim ipsam voluptatem quia voluptas sit aspernatur netsum loris fugit, sed quia magni dolores eos qui ratione sequi nesciunt. Neque ets poris ratione fugit, sed quia magni dolores eos qui ratione sequi nesciunt. Neque etus quis sequi enim ipsam voluptatem quias net volupti etsim et netus tempor.</p>--}}

                    <!--begin testimonials_item -->
                        @foreach($testimonials as $testimonial)
                    <div class="testimonials_item4 pb-5" style="border-bottom: #69696926 1px solid !important;">
                        <div class="testimonials_box4 mt-0">
                            <p>"{!! $testimonial->review !!}"</p>
                            <span class="testimonials_arrow"></span>
                        </div>
                            <img src="{{ asset('uploads/testimonialImages/'.$testimonial->reviewer_image) }}" alt="Picture" class="autor_pic">
                            <p class="autor"><span>{{ $testimonial->review_by }}</span></p>
                    </div>
                    @endforeach
                    <!--end testimonials_item -->

                </div>
                <!--end col-sm-6-->

            </div>
            <!--end row-->

        </div>
        <!--end container-->

    </section>
    <!--end section-white-->
    <!--begin section-grey-->
    <div class="section-grey sponsors-padding">

        <!--begin container-->
        <div class="container">

            <!--begin row-->
            <div class="row text-center">

                <!--begin col-sm-12-->
                    <div data-owl-auto-height="20" data-owl-items="6" data-owl-auto-width="19" class="col-sm-12 sponsors d-block d-md-flex justify-content-between align-items-center text-center ts-partners owl-carousel">
                        @foreach($partners as $partner)
                        <div href="#" class="ml-5" style="width: 120px;height: 120px;">
                            <img src="{{ asset('uploads/financePartnerImages/'.$partner->image) }}" alt="">
                        </div>
                        @endforeach
                </div>
                <!--end col-sm-12-->

            </div>
            <!--end row-->

        </div>
        <!--end container-->

    </div>
    <!--end section-grey-->
@endsection
