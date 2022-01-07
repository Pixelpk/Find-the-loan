<div>
  <div class="breadcrumb-wrapper">

    <div class="breadcrumb-wrapper-overlay"></div>

    <!--begin container -->
    <div class="container sec-container">

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
  <section class="section-white-services pt-5" id="about">
    <img class="about-bg" src="{{ asset('assets/cms/img/Home/about-bg1.jpg') }}" alt="">
    <div class="container position-relative">
      <div class="row">
        <div class="about-content mx-auto w-75">
          <p class="lead"> {!! $about_us->value !!}</p>
        </div>
      </div>
      <!-- <div class="row">
              <div class="col-md-12">
              {!! $financial_inclusion->value !!}
              </div>
          </div> -->
    </div>

  </section>
  <div class="about-grid mt-2 justify-content-md-center">
    <div class="about--img_box">
      <img class="img-fluid " src="{{ asset('assets/cms/img/about/about-1st.jpg') }}" alt="about img">
    </div>
    <div class="about--img_box">
      <img class="img-fluid " src="{{ asset('assets/cms/img/about/about-2nd.jpg') }}" alt="about img">
    </div>
    <div class="about--img_box">
      <img class="img-fluid " src="{{ asset('assets/cms/img/about/about-3rd.jpg') }}" alt="about img">
    </div>
    <div class="about--img_box">
      <img class="img-fluid " src="{{ asset('assets/cms/img/about/about-4th.jpg') }}" alt="about img">
    </div>
    <div class="about--img_box">
      <img class="img-fluid " src="{{ asset('assets/cms/img/about/about-5th.jpg') }}" alt="about img">
    </div>
  </div>
</div>
