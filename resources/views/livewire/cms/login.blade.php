<section class="section-white small-padding">
  <!--begin container-->
  <div class="container">
    <div class="row pt-5">
      <div class="col-md-3"></div>
      <div class="col-12 col-md-8 col-lg-6 pt-5">
        @if ($errorMessage)
          <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Error!</strong> {{ $errorMessage }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
        @endif
        @if ($message = Session::get('message'))
          <div class="alert alert-info alert-dismissible fade show" role="alert">
            {{-- <strong>Error!</strong> --}}
            {{ $message }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
        @endif
        <form wire:submit.prevent="loginAttemp">
          <div class="card">
            <div class="card-body">
              <h3 class="text-center">Login</h3>
              <div class="row">
                <div class="col-12">
                  <div class="form-group mb-3">
                    <input class=" form-control white-input custominput" wire:model.defer="email"
                      placeholder="Email*" type="email">
                    @error('email')
                      <span class="customspan">{{ $message }}</span>
                    @enderror
                  </div>
                </div>
                <div class="col-12">
                  <div class="form-group mb-3">
                    <input class=" form-control white-input custominput" wire:model.defer="password"
                      placeholder="Password*" type="password">
                    @error('password')
                      <span class="customspan">{{ $message }}</span>
                    @enderror
                  </div>
                </div>
              </div>

              <div class="mt-1">
                <button onclick="verifyCallBack()" class="btn btn-custom g-recaptcha mt-3 w-100" type="button"
                  wire:loading.attr='disabled'>
                  Login
                  <div wire:loading>
                    <span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true">
                    </span>
                  </div>
                </button>
              </div>

              <div class="p-3 text-center">
                <span><b>or</b></span>
              </div>

              <div class="">
                <button class="btn btn-facebook-outline w-100">
                  Sign in with facebook <i class="fab fa-facebook-f"></i>
                </button>
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
<script src="https://www.google.com/recaptcha/api.js?render={{ env('CAPTCHA_SITE_KEY') }}"></script>

<script>
  function verifyCallBack(response) {
    console.log(response)
    grecaptcha.ready(function() {
      // @this.set('captcha_token', response);
      console.log("i am in ready block");
      // grecaptcha.execute('{{ env('CAPTCHA_SITE_KEY') }}', {action: 'loginAttemp'})
      grecaptcha.execute('{{ env('CAPTCHA_SITE_KEY') }}')
        .then(function(token) {
          @this.set('captcha', token);
          @this.call('loginAttemp');
        });
    });
  };
  //   var onloadCallback = function() {
  //     grecaptcha.render('g-recaptcha', {
  //         'sitekey' : '{{ env('CAPTCHA_SITE_KEY') }}',
  //         'callback' : verifyCallback,
  //         });
  //   }
</script>
