<section class="section-white small-padding">
    <!--begin container-->
    <div class="container">
        <div class="row">
            <div class="col-md 3"></div>
            <div class="col-sm-6" style="padding-top: 60px;">
                @if($errorMessage)
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Error!</strong> {{ $errorMessage }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif
                @if ($message = Session::get('message'))
                <div class="alert alert-info alert-dismissible fade show" role="alert">
                    <strong>Error!</strong> {{ $message }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif
                <form wire:submit.prevent="loginAttemp">
                    <div class="card">
                        <div class="card-body">
                            <h3 class="text-center">Login</h3>
                            <div>
                                <input class="contact-input white-input custominput" wire:model="email"
                                    placeholder="Email*" type="email">
                                @error('email')
                                <span class="customspan">{{ $message }}</span>
                                @enderror
                            </div>
                            <div>
                                <input style="margin-top:15px;" class="contact-input white-input custominput"
                                    wire:model="password" placeholder="Password*" type="password">
                                @error('password')
                                <span class="customspan">{{ $message }}</span>
                                @enderror
                            </div>
                            {{-- <div id="g-recaptcha" class="g-recaptcha"></div> --}}
                            <button type="submit" data-sitekey="{{env('CAPTCHA_SITE_KEY')}}" data-callback='verifyCallBack' class="btn btn-custom g-recaptcha mt-3 w-100"
                                type="button" wire:loading.attr='disabled'>
                                Login
                                <div wire:loading wire:target="loginAttemp">
                                    <span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true">
                                    </span>
                                </div>
                            </button>

                            <div class="p-3 text-center">
                                <span><b>or</b></span>
                            </div>

                            <div class="text-center">
                                <i class="fab fa-facebook-square" style="font-size: 35px; color: #105785;"></i>
                            </div>
                            <div class="pt-3">
                               <span>You don't have an account?</span>
                               <a href="{{ route('registration') }}" style="text-decoration: underline;"> Sign Up </a>
                            </div>
                        </div>
                    </div>
                </form>
                <!--end contact form -->
            </div>
            <div class="col-md 3"></div>
            <!--end col-sm-6-->
            <!--begin col-sm-6 -->
            <!--end col-sm-6-->
        </div>
        <!--end row-->
    </div>
    <!--end container-->
</section>
<script src="https://www.google.com/recaptcha/api.js?render={{env('CAPTCHA_SITE_KEY')}}"></script>

<script>
    var verifyCallBack = function(response) {
        console.log(response)
        grecaptcha.ready(function () {
            // @this.set('captcha_token', response);
            console.log("i am in ready block");
            grecaptcha.execute('{{env('CAPTCHA_SITE_KEY')}}', {action: 'submit'})
                .then(function (token) {
                    @this.set('captcha', token);
                });
        });
      };
      var onloadCallback = function() {
        grecaptcha.render('g-recaptcha', {
            'sitekey' : '{{env('CAPTCHA_SITE_KEY')}}',
            'callback' : verifyCallback,
            });
      }

</script>