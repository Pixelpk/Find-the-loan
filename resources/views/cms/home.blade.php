@extends('cms.layouts.master')
@section('content')
<main id="ts-content">
    <!--PARTNERS ********************************************************************************************-->
    <section id="partners" class="ts-block0 text-center" data-bg-color="#f6f7f9" data-mask-top-nw-color="#fff"><h3 >
            Some  Of Our Financing Partners
        </h3>
        <!--container-->
        <div class="container">

            <!--block of logos-->
            <div data-owl-auto-height="10" data-owl-items="6" data-owl-auto-width="10" class="d-block d-md-flex justify-content-between align-items-center text-center ts-partners owl-carousel">
                @foreach($partners as $partner)
                <div href="#" class="ml-5" style="width: 120px;height: 120px;">
                    <img class="" src="{{ asset('uploads/financePartnerImages/'.$partner->image) }}" alt="">
                </div>
                @endforeach
            </div>
            <!--end logos-->
        </div>
        <!--end container-->
    </section>
    <!--END PARTNERS ****************************************************************************************-->


    <!--WHAT YOU'LL GET *************************************************************************************-->
    <section id="what-youll-get" class="ts-block text-center pt-4">
        <div class="container">
            <div class="ts-title">
                <h2></h2>
            </div>
            <!--end ts-title-->
            <div class="row">
                <div class="col-sm-6 col-md-4 col-xl-4">
                    <figure data-animate="ts-fadeInUp">
                        <figure class="icon imgsiz mb-5 p-2">
                            <img src="{{ asset('assets/cms/img/icon-chart.png') }}" alt="">
                        </figure>
                        <h4>Seamless</h4>
                        <p>
                            Single Interface to reach <br>multiple lenders
                        </p>
                    </figure>
                </div>
                <!--end col-xl-4-->
                <div class="col-sm-6 col-md-4 col-xl-4">
                    <figure data-animate="ts-fadeInUp" data-delay="0.1s">
                        <figure class="icon imgsiz mb-5 p-2">
                            <img src="{{ asset('assets/cms/img/icon-target.png') }}" alt="">
                        </figure>
                        <h4>Tailored</h4>
                        <p>
                            Actulal quotes directly from our Financing<br> Partners based on your credits profile
                        </p>
                    </figure>
                </div>
                <!--end col-xl-4-->
                <div class="col-sm-6 offset-sm-4 col-md-4 offset-md-0 col-xl-4">
                    <figure data-animate="ts-fadeInUp" data-delay="0.2s">
                        <figure class="icon imgsiz mb-5 p-2">
                            <img src="{{ asset('assets/cms/img/icon-first.png') }}" alt="">
                        </figure>
                        <h4>Digital </h4>
                        <p>
                            Truly digital. Not a landing page and someone <br>calling you during meetings or lunch<br> to ask for your documents.
                        </p>
                    </figure>
                </div>
                <!--end col-xl-4-->
            </div>
            <!--end row-->
            <div class="container">
                <div class="ts-title">
                    <h2></h2>
                </div>
                <!--end ts-title-->
                <div class="row headshado ">
                    <div class="col-sm-6 col-md-6 col-xl-6" style=" display: flex; justify-content: end; padding-right: 100px;">
                        <figure data-animate="ts-fadeInUp">
                            <figure class="icon imgsiz mb-5 p-2">
                                <img src="{{ asset('assets/cms/img/privacy.png') }}" alt="">
                            </figure>
                            <h4>Privacy</h4>
                            <p >
                                You decide and know exactly <br>who recives you info
                            </p>
                        </figure>
                    </div>
                    <!--end col-xl-4-->
                    <div class="col-sm-6 col-md-6 col-xl-6" style="display: flex; justify-content: start; padding-left: 100px;">
                        <figure data-animate="ts-fadeInUp" data-delay="0.1s">
                            <figure class="icon imgsiz mb-5 p-2">
                                <img src="{{ asset('assets/cms/img/speed.png') }}" alt="">
                            </figure>
                            <h4>Speed</h4>
                            <p>
                                Being able to reach so many lenders help<br> you in finding a competitive loan fast
                            </p>
                        </figure>
                    </div>
                    <!--end col-xl-4-->

                </div>
                <!--end row-->
            </div>
        </div>
        <!--end container-->
    </section>
    <!--END HOW IT WORKS ************************************************************************************-->

    <!--SIMPLY CHOSE THE LOAN ***********************************************************************************-->
    <section id="advanced-features" class="ts-block">
        <div class="container ">
            <h2 class="text-center" style="padding-bottom: 50px !important;"> How It Works</h2>
            <div class="row">
                <div class="col-md-6 col-xl-6 text-center align-self-center align-items-center" data-animate="ts-fadeInUp" data-delay="0.1s">
                    <div class="px-3">
                        <img src="{{ asset('assets/cms/img/image-device-01.png') }}" class="mw-100" alt="">
                    </div>
                </div>
                <!--end col-xl-5-->
                <div class="col-md-6 col-xl-6 align-self-center align-items-center" data-animate="ts-fadeInUp">
                    <div class="ts-title" >
                        <h3>Simply choose the loan type</h3>
                    </div>
                    <!--end ts-title-->
                    <p class="hedtext">
                        You are looking for. Our Algorithm will device you<br>Who offers that loan.
                    </p>
                </div>
                <!--end col-xl-5-->
            </div>
            <!--end row-->
        </div>
        <!--end container-->
    </section>
    <!--END SIMPLY CHOSE THE LOAN *******************************************************************************-->

    <!--Upload the documents ***********************************************************************************-->
    <section id="responsive" class="ts-block">
        <div class="container">
            <div class="row resrow">
                <div class="col-md-6 col-xl-6 align-self-center align-items-center  uploadpadding" data-animate="ts-fadeInUp">
                    <div class="ts-title">
                        <h3>Upload the documents</h3>
                    </div>
                    <!--end ts-title-->
                    <p class="hedtext">
                        Our Algorithm will device you what documents<br>are required.
                    </p>
                </div>
                <!--end col-xl-7-->
                <div class="col-md-6 col-xl-6 text-center align-self-center align-items-center" data-animate="ts-fadeInUp" data-delay="0.1s">
                    <div class="px-3 mb-4">
                        <img src="{{ asset('assets/cms/img/image-device-03.png') }}" class="mw-100" alt="">
                    </div>
                </div>
                <!--end col-xl-5-->
            </div>
            <!--end row-->
        </div>
        <!--end container-->
    </section>
    <!--END Upload the documents *******************************************************************************-->
    <!--COMPARE AND SELECT ***********************************************************************************-->
    <section id="advanced-features" class="ts-block">
        <div class="container ">
            <div class="row" style="padding-bottom: 50px !important;">
                <div class="col-md-6 col-xl-6 text-center align-self-center align-items-center" data-animate="ts-fadeInUp" data-delay="0.1s">
                    <div class="px-3">
                        <img src="{{ asset('assets/cms/img/image-device-001.png') }}" class="mw-100" alt="">
                    </div>
                </div>
                <!--end col-xl-5-->
                <div class="col-md-6 col-xl-6 align-self-center align-items-center" data-animate="ts-fadeInUp">
                    <div class="ts-title">
                        <h3>Compare and select</h3>
                    </div>
                    <!--end ts-title-->
                    <p class="hedtext">
                        Who offers the highest quantum, longest tenure, lowest<br>fees or interest, after financing partners compete <br>to offer you a loan
                    </p>
                </div>
                <!--end col-xl-6-->
            </div>
            <!--end row-->
        </div>
        <!--end container-->
    </section>
    <!--END COMPARE AND SELECT *******************************************************************************-->

    <!--WHAT HAPPEN *********************************************************************************************-->
    <section id="buy-now" class="ts-block text-center pt-4" data-bg-color="#eaeaea" data-mask-bottom-wn-color="#fff">
        <div class="container">
            <div class="ts-title">
                <h2>What Happen if You Don't Compare?</h2>
                <p>
                    Imagine 2 business loans that are both $300,000 anf 5 years long but one is at 3% and the other at 3.50% p.a<br> That whould give you a total interest of $52,500.
                </p>
                <span>
                            A difference of $7,500!
                        </span>
                <h2>OR</h2>
                <p>
                    Imagine a 20 years housing loan of just $500,000 @ 1.88% vs 1.98%. That's a total interest of %188,000 vs $298,000!
                </p>
                <span>
                            A difference of just 0.1% can cost you $10,000!
                        </span>
            </div>
            <!--end ts-title-->
        </div>
    </section>
    <!--END WHAT HAPPEN*****************************************************************************************-->
    <!--SUBSCRIBE *******************************************************************************************-->
    <section id="subscribe" class="ts-block ts-background ts-separate-bg-element" data-bg-image="{{ asset('assets/cms/img/bg-map.jpg') }}" data-bg-image-opacity=".1" data-bg-color="#dddddd0d" data-bg-parallax="scroll" data-bg-parallax-speed="3" data-mask-top-nw-color="#fff" data-mask-bottom-wn-color="#fff">
        <div class="container text-center">
            <h3>Change the way you apply for loans Now!</h3>
            <a href="#" class="btn btn-primary">Buy Now!</a>
        </div>
        <!--end container-->
    </section>
    <!--END apply now ***************************************************************************************-->
</main>
@endsection
