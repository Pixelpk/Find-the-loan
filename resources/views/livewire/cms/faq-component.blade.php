<div class="breadcrumb-wrapper">

    <div class="breadcrumb-wrapper-overlay"></div>

    <!--begin container -->
    <div class="container sec-container">

        <!--begin row -->
        <div class="row">

            <!--begin col-xs-12 -->
            <div class="col-sm-12 col-lg-12 col-xs-12">

                <h2 class="page-title white text-center">FAQS</h2>

            </div>


            <!--end col-xs-12 -->

        </div>
        <!--end row -->

    </div>
    <!--end container -->

</div>
<!--end breadcrumb-wrapper-->

<section class="section-white mt-3">
        <div class="container">
                    <!-- ACCORDIAN -->
          <div class="row">
            <div class="col-md-12">
              <div class="accordion" id="accordionExample">
                @foreach($faqs as $key=>$faq)
                <div class="accordion-item shadow">
                  <h2 class="accordion-header" id="headingOne">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{$key}}" aria-expanded="false" aria-controls="collapseOne">
                      {{$faq->question}}
                    </button>
                  </h2>
                  <div id="collapse{{$key}}" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                      {{ $faq->answer }}
                    </div>
                  </div>
                </div>
                @endforeach

              </div>
            </div>
          </div>
          <!-- /ACCORDIAN -->


            {{--        <h2>Accordion Example</h2>--}}
            {{--        <p><strong>Note:</strong> The <strong>data-parent</strong> attribute makes sure that all collapsible elements under the specified parent will be closed when one of the collapsible item is shown.</p>--}}
        </div>
    </section>
