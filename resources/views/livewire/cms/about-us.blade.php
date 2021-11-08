
    <div class="about-slider sec-container">
    <div id="carouselExampleFade" class="carousel slide carousel-fade" data-ride="carousel">
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img class="d-block" src="assets/cms/img/Home/image1.jpg" alt="First slide">
      <div class="carousel-caption d-none d-md-block">
      <h3 class="fw-bold mb-0 animated bounceInLeft" style="animation-delay: 1s;">Be it for your bussines</h3>
      <h4 class="animated bounceInRight" style="animation-delay: 2s;">Or an investment for your future.</h4>
</div>
    </div>
    <div class="carousel-item">
      <img class="d-block" src="{{ asset('assets/cms/img/Home/image2.jpg') }}" alt="Second slide">
      <div class="carousel-caption d-none d-md-block">
        <h4 class="mb-0 animated slideInDown" style="animation-delay: 1s;">We beleive no hardworking entreprenures should be allowed to fail due to disruption in cash flow and no individuals should be denied the opportunity to fulfil their dreams from poor access to finanacing.</h4>
  </div>
    </div>
    <div class="carousel-item">
      <img class="d-block" src="assets/cms/img/Home/image3.jpg" alt="Third slide">
      <div class="carousel-caption d-none d-md-block">
        <h3 class="fw-bold mb-0 animated slideInUp" style="animation-delay: 1s;">Getting a loan should <br> be easier</h3>
        <button class="btn animated bounceInRight mt-3" style="animation-delay: 3s;">Apply Now</button>
  </div>
    </div>
  </div>
</div>
<a href="#carouselExampleFade" role="button" data-slide="prev" class="carousel-control-prev">
  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
  <span class="sr-only">Previous</span>
</a>
<a href="#carouselExampleFade" role="button" data-slide="next" class="carousel-control-next">
  <span class="carousel-control-next-icon" aria-hidden="true"></span>
  <span class="sr-only">Next</span>
</a>
        </div>
<section class="section-white-services" id="about">
    <img
    class="about-bg"
    src="{{ asset('assets/cms/img/Home/about-bg1.jpg') }}"
    alt=""
  >
    <div class="container position-relative">
        <div class="row">
            <div class="about-content mx-auto w-75">
                <h2 class="fw-bold text-center">About Us</h2>
          <p class="lead">  {!! $about_us->value !!}</p>
            </div>
        </div>
        <!-- <div class="row">
            <div class="col-md-12">
            {!! $financial_inclusion->value !!}
            </div>
        </div> -->
    </div>
</section>