<div>
  <div class="breadcrumb-wrapper">
    <div class="breadcrumb-wrapper-overlay"></div>
    <!--begin container -->
    <div class="container sec-container">
      <!--begin row -->
      <div class="row">
        <!--begin col-xs-12 -->
        <div class="col-sm-12 col-lg-12 col-xs-12">
          <h2 class="page-title white text-center">Contact Us</h2>
        </div>
        <!--end col-xs-12 -->
      </div>
      <!--end row -->
    </div>
    <!--end container -->
  </div>
  <!--end breadcrumb-wrapper-->

  <!--begin blog -->
  <section class="section-white small-padding">
    @include('cms.pages.flash-message')
    <!--begin container-->
    <div class="container">
      <!--begin row-->
      <div class="row">
          <div class="col-12 col-lg-6">
            <h3>Get in touch</h3>
            <form wire:submit.prevent="contactUsSubmit">
                <div class="row">
                    <div class="col-12">
                        <div class="form-group mb-3">
                            <label for="exampleInputName" class="form-label">Name</label>
                            <input type="text" class="form-control white-input" id="exampleInputName" placeholder="Enter name"
                              wire:model="name">
                          </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <div class="form-group mb-3">
                            <label for="exampleInputEmail" class="form-label">Email</label>
                            <input type="email" class="form-control white-input" id="exampleInputEmail" placeholder="Enter email"
                              wire:model="email">
                          </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <div class="form-group mb-3">
                            <label for="exampleInputPhone" class="form-label">Phone</label>
                            <input type="tel" class="form-control white-input" id="exampleInputPhone" placeholder="Enter phone"
                              wire:model="phone">
                          </div>
                    </div>
                </div>
               
              <div class="row">
                  <div class="col-12">
                    <div class="form-group mb-3">
                        <label for="exampleInputbody" class="form-label">Message</label>
                        <textarea class="form-control white-input" id="exampleInputbody" placeholder="Message"
                          wire:model="contact_message"></textarea>
                      </div>
                  </div>
              </div>
    
               <div class="my-3">
                <button type="submit" class="btn btn-custom">Send Message</button>
               </div>

              </form>
          </div>
          <div class="col-12 col-lg-6">
            <h3 class="just">How to find us</h3>
            <iframe class="contact-maps w-100"
              src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d13266.458192764883!2d-118.12220140228776!3d33.770625036103965!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x80dd31d82982f643%3A0x1fdc7f26cec72dab!2sCalifornia+State+University+Long+Beach!5e0!3m2!1sro!2sro!4v1496928645987"
              width="600" height="450" style="border:0" allowfullscreen></iframe>
          </div>

          {{-- <div class="f"></div> --}}
      </div>
      <!--end row-->

    </div>
    <!--end container-->

  </section>
  <!--end blog -->

</div>
