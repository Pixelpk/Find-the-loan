
<div>
    <div class="content-page">
        <div class="content">

            <div class="container-fluid">
                <div class="page-title-box">

                    <div class="row align-items-center ">
                        <div class="col-md-12">
                            <div class="page-title-box">
                                <h4 class="page-title">Customer Profile</h4>

                            </div>
                        </div>

                    </div>
                </div>
                <!-- end page-title -->

                <!-- start top-Contant -->

                @if($errorMessage)
                    <div class="alert alert-danger" role="alert">
                         <strong>ERROR!</strong> {{ $errorMessage }}
                          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                    </div>
                @endif
                @if($message)
                    <div class="alert alert-success custom-success-alert" id="success-alert" role="alert">
                     <strong>Success!</strong> {{ $message }}
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                @endif


                <div class="row">
                    <div class="col-sm-12 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="mt-0 header-title">Update Profile</h4>

                                <div>
                                    <input class="contact-input white-input custominput" wire:model.defer="first_name"
                                        placeholder="First Name*" type="text">
                                    @error('first_name')
                                    <span class="customspan">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div>
                                    <input style="margin-top:15px;" class="contact-input white-input custominput" wire:model.defer="last_name"
                                        placeholder="Last Name*" type="text">
                                    @error('last_name')
                                    <span class="customspan">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div>
                                    <input style="margin-top:15px;" class="contact-input white-input custominput" wire:model.defer="email"
                                        placeholder="Email *" type="email">
                                    @error('email')
                                    <span class="customspan">{{ $message }}</span>
                                    @enderror


                                </div>

                                <div>
                                    <input style="margin-top:15px;" class="contact-input white-input custominput" wire:model.defer="phone"
                                        placeholder="Phone *" type="tel">
                                    @error('phone')
                                    <span class="customspan">{{ $message }}</span>
                                    @enderror

                                </div>

                              <button class="btn btn-custom mt-3 w-100 waves-effect waves-light" type="button" wire:loading.attr='disabled'
                                    wire:target='updateProfile' wire:click.prevent='updateProfile' style="background-color: #27B34D !important; border: 1px solid #27B34D !important; color: #fff !important;">
                                    Update
                                    <div wire:loading wire:target="updateProfile">
                                        <span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true">
                                        </span>
                                    </div>
                                </button>

                            </div>
                        </div>
                    </div>

                    @if($status == 0)
                    <!-- UPDATE PASSWORD -->
                     <div class="col-sm-12 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="mt-0 header-title">Update password</h4>

                                 <label>Old password</label>
                                 <div>
                                   
                                    <input class="contact-input white-input custominput" wire:model="old_password"
                                        placeholder="Old Password *" type="password">

                                    @error('old_password')
                                    <span class="customspan">{{ $message }}</span>
                                    @enderror

                                </div>

                                <div>
                                    <label>New password</label>
                                    <input class="contact-input white-input custominput" wire:model="password"
                                        placeholder="Password *" type="password">

                                    <br>
                                    <span>Please include at least one letter one number and one special character.</span>
                                    <br>
                                    

                                    @error('password')
                                    <span class="customspan">{{ $message }}</span>
                                    @enderror

                                </div>
                                <br>
                                 <label>Confirm password</label>
                                <div>
                                    <input class="contact-input white-input custominput"
                                        wire:model="confirm_password" placeholder="Confirm Password *" type="password">
                                    @error('confirm_password')
                                    <span class="customspan">{{ $message }}</span>
                                    @enderror

                                </div>

                                <button class="btn btn-custom mt-3 w-100 waves-effect waves-light" type="button" wire:loading.attr='disabled'
                                    wire:target='updatePassword' wire:click.prevent='updatePassword' style="background-color: #27B34D !important; border: 1px solid #27B34D !important; color: #fff !important;">
                                    Update
                                    <div wire:loading wire:target="updatePassword">
                                        <span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true">
                                        </span>
                                    </div>
                                </button>

                            </div>
                        </div>
                    </div>
                    @endif

                </div>

                <!-- end top-Contant -->
            </div>
            <!-- container-fluid -->

        </div>
        <!-- content -->
        @include('admin.pages.footer')

    </div>
</div>



<!--begin row-->
    <div class="row">
        <div class="col-md 3"></div>
        <!--begin col-sm-6 -->
        <div class="col-sm-6" style="padding-top: 60px;">

            <!--end contact form -->
        </div>
        <div class="col-md 3"></div>
        <!--end col-sm-6-->
        <!--begin col-sm-6 -->
        <!--end col-sm-6-->
    </div>
<!--end row-->
