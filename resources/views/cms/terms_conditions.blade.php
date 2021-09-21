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

                    <h2 class="page-title white text-center">Terms & Conditions</h2>

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
                <div class="col-md-12">
                {!! $terms_conditions !!}
                </div>
            </div>
            <!--end row-->

        </div>
        <!--end container-->

    </section>
    <!--end section-white-->
@endsection
