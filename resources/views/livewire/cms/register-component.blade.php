<section class="section-white small-padding">

  <!--begin container-->
  <div class="container">

    <!--begin row-->
    <div class="row pt-5">
      <div class="col-md-2 col-lg-3"></div>
      <!--begin col-sm-6 -->
      <div class="col-12 col-md-8 col-lg-6 pt-5">
        @if ($errorMessage)
          <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Error!</strong> {{ $errorMessage }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
        @endif
        @if ($message)

          <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Message!</strong> {{ $message }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
        @endif

        @if (session()->has('error'))
          <div class="alert alert-danger">
            {{ session('error') }}
          </div>
        @endif

        <div class="card">
          <div class="card-body">
            <h3 class="text-center">Signup</h3>
            <p>An email will be sent to ensure that you are reachable at this email when there is for example a quote
              has been offered. Please check your junk box if not received and remember to mark it as not junk</p>
            <div class="row">
              <div class="col-12">
                <div class="form-group mb-3">
                  <input class="form-control white-input custominput" wire:model="first_name" placeholder="First Name*"
                    type="text">
                  @error('first_name')
                    <span class="customspan">{{ $message }}</span>
                  @enderror
                </div>
              </div>
              <div class="col-12">
                <div class="form-group mb-3">
                  <input class="form-control white-input custominput" wire:model="last_name" placeholder="Last Name*"
                    type="text">
                  @error('last_name')
                    <span class="customspan">{{ $message }}</span>
                  @enderror
                </div>
              </div>
              <div class="col-12">
                <div class="form-group mb-3">
                  <input class="form-control white-input custominput" wire:model="email" placeholder="Email *"
                    type="email">
                  @error('email')
                    <span class="customspan">{{ $message }}</span>
                  @enderror
                </div>
              </div>
              <div class="col-12">
                <div class="form-group mb-3">
                  <input class="form-control white-input custominput" wire:model="phone" placeholder="Phone *"
                    type="tel">
                  @error('phone')
                    <span class="customspan">{{ $message }}</span>
                  @enderror
                </div>
              </div>
            </div>
            <div class="col-12">
              <div class="form-group mb-3">
                <input class="form-control white-input custominput mb-1" wire:model="password" placeholder="Password *"
                  type="password">
                <span>Please include at least one letter one number and one special character.</span>
                <br>
                @error('password')
                  <span class="customspan">{{ $message }}</span>
                @enderror
              </div>
            </div>
            <div class="col-12">
              <div class="form-group mb-3">
                <input class="form-control white-input custominput" wire:model="confirm_password"
                  placeholder="Confirm Password *" type="password">
                @error('confirm_password')
                  <span class="customspan">{{ $message }}</span>
                @enderror
              </div>
            </div>
            <div class="d-grid">
                <button class="btn btn-custom w-100" type="button" wire:loading.attr='disabled' wire:target='store'
                  wire:click.prevent='store'>
                  Signup
                  <div wire:loading wire:target="store">
                    <span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true">
                    </span>
                  </div>
                </button>
        </div>
        <div class="pt-3">
            <p>By signing up you acknowledge you have read and agreed to our Website’s <a
                href="{{ url('terms-conditions') }}">Terms of use</a>, <a
                href="{{ url('privacy-policy') }}">Privacy Policy</a> and related policies.</p>
          </div>
          </div>


        


        
        </div>
      </div>



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
