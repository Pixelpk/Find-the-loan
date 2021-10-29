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
{{--        @if ($message = Session::get('success'))--}}
{{--            <div class="alert alert-success alert-block">--}}
{{--                <a type="button" class="close" data-dismiss="alert">×</a>--}}
{{--                <strong>{{ $message }}</strong>--}}
{{--            </div>--}}
{{--    @endif--}}
    @include('cms.pages.flash-message')
    <!--begin container-->
        <div class="container">

            <!--begin row-->
            <div class="row">

                <!--begin col-sm-6 -->
                <div class="col-sm-6 margin-bottom-50">

                    <h3>Get in touch</h3>

                    <!--begin success message -->
                    <p class="contact_success_box" style="display:none;">We received your message and you'll hear from us soon. Thank You!</p>
                    <!--end success message -->

                    <!--begin contact form -->
                    <form wire:submit.prevent="contactUsSubmit">
                        <div class="form-group">
                            <label for="exampleInputName">Name</label>
                            <input type="text" class="contact-input white-input" id="exampleInputName" placeholder="Enter name" wire:model="name">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail">Phone</label>
                            <input type="text" class="contact-input white-input" id="exampleInputEmail" placeholder="Enter phone" wire:model="phone">
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail">Email</label>
                            <input type="email" class="contact-input white-input" id="exampleInputEmail" placeholder="Enter email" wire:model="email">
                        </div>

                        <div class="form-group">
                            <label for="exampleInputbody">Message</label>
                            <textarea class="contact-input white-input" id="exampleInputbody" placeholder="Message" wire:model="contact_message"></textarea>
                        </div>

                        <button type="submit" class="btn">Send Message</button>
                    </form>

                </div>
                <!--end col-sm-6-->

                <!--begin col-sm-6 -->
                <div class="col-sm-6">

                    <h3>How to find us</h3>

                    <iframe class="contact-maps" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d13266.458192764883!2d-118.12220140228776!3d33.770625036103965!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x80dd31d82982f643%3A0x1fdc7f26cec72dab!2sCalifornia+State+University+Long+Beach!5e0!3m2!1sro!2sro!4v1496928645987" width="600" height="450" style="border:0" allowfullscreen></iframe>

                </div>
                <!--end col-sm-6-->

            </div>
            <!--end row-->

        </div>
        <!--end container-->

    </section>
    <!--end blog -->

</div>
