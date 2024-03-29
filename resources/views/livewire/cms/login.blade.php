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
                            <button type="submit" class="btn mt-3 w-100"
                                type="button" wire:loading.attr='disabled' wire:target='loginAttemp'
                                wire:click.prevent='loginAttemp'>
                                Login
                                <div wire:loading wire:target="loginAttemp">
                                    <span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true">
                                    </span>
                                </div>
                            </button>
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
