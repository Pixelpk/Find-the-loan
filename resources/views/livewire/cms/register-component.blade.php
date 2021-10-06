<section class="section-white small-padding">

    <!--begin container-->
    <div class="container">

        <!--begin row-->
        <div class="row">
            <div class="col-md 3"></div>
            <!--begin col-sm-6 -->
            <div class="col-sm-6" style="padding-top: 60px;">
                @if($errorMessage)
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Error!</strong> {{ $errorMessage }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif
                @if($message)

                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Message!</strong> {{ $message }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>

                @endif
               
                <div class="card">
                    <div class="card-body">
                        <h3 class="text-center">Registration</h3>
                        <div>
                            <input class="contact-input white-input custominput" wire:model="first_name"
                                placeholder="First Name*" type="text">
                            @error('first_name')
                            <span class="customspan">{{ $message }}</span>
                            @enderror
                        </div>
                        <div>
                            <input style="margin-top:15px;" class="contact-input white-input custominput" wire:model="last_name"
                                placeholder="Last Name*" type="text">
                            @error('last_name')
                            <span class="customspan">{{ $message }}</span>
                            @enderror
                        </div>
        
                        <div>
                            <input style="margin-top:15px;" class="contact-input white-input custominput" wire:model="email"
                                placeholder="Email *" type="email">
                            @error('email')
                            <span class="customspan">{{ $message }}</span>
                            @enderror
        
                        </div>
        
                        <div>
                            <input style="margin-top:15px;" class="contact-input white-input custominput" wire:model="phone"
                                placeholder="Phone *" type="tel">
                            @error('phone')
                            <span class="customspan">{{ $message }}</span>
                            @enderror
        
                        </div>
                        <div>
                            <input style="margin-top:15px;" class="contact-input white-input custominput" wire:model="password"
                                placeholder="Password *" type="password">
                            @error('password')
                            <span class="customspan">{{ $message }}</span>
                            @enderror
        
                        </div>
                        <div>
                            <input style="margin-top:15px;" class="contact-input white-input custominput"
                                wire:model="confirm_password" placeholder="Confirm Password *" type="password">
                            @error('confirm_password')
                            <span class="customspan">{{ $message }}</span>
                            @enderror
        
                        </div>
        
                      <button class="btn mt-3 w-100" type="button" wire:loading.attr='disabled'
                            wire:target='store' wire:click.prevent='store'>
                            Register
                            <div wire:loading wire:target="store">
                                <span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true">
                                </span>
                            </div>
                        </button>
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
