<div>
  <div class="breadcrumb-wrapper">

    <div class="breadcrumb-wrapper-overlay"></div>

    <!--begin container -->
    <div class="container sec-container">

      <!--begin row -->
      <div class="row">

        <!--begin col-xs-12 -->
        <div class="col-sm-12 col-lg-12 col-xs-12">

          <h2 class="page-title white text-center">Tools and Calculators</h2>

        </div>


        <!--end col-xs-12 -->

      </div>
      <!--end row -->

    </div>
    <!--end container -->

  </div>
  <!--end breadcrumb-wrapper-->

  <!--begin section-white -->
  <section class="section-white-services py-4">

    <!--begin container-->
    <div class="container">

      <!--begin row-->
      <div class="row">
        <div class="col-md-12">
          <div class="container bg-light p-3 rounded-3">
            <div class="text-center">
              <h4>Loans Comparison Calculator</h4>
            </div>
            <div class="row">
              <div class="col-12 col-lg-6">
                <div class="card mb-3 rounded-3">
                  <div class="card-body">
                    <h3 class="card-title">Loan 1</h3>
                    <form action="" class="mt-4">

                      <div class="row">
                        <div class="col-12 col-md-6">
                          <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">$ Quantum</label>
                            <input type="text" wire:model='quantum1' class="form-control" id="exampleFormControlInput1" placeholder="">
                            @error('quantum1')
                                <span class="customspan">{{ $message }}</span>
                            @enderror
                          </div>
                        </div>
                        <div class="col-12 col-md-6">
                          <div class="mb-3">
                            <label for="exampleFormControlInput2" class="form-label">Tenure - Years</label>
                            <input type="text" wire:model='tenure_years1' class="form-control" id="exampleFormControlInput2" placeholder="">
                            @error('tenure_years1')
                                <span class="customspan">{{ $message }}</span>
                            @enderror
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-12 col-md-6">
                          <div class="mb-3">
                            <label for="exampleFormControlInput3" class="form-label">Interest Per Year (%)</label>
                            <input type="text" wire:model="interest_per_year_percent1" class="form-control" id="exampleFormControlInput3" placeholder="">
                            @error('interest_per_year_percent1')
                                <span class="customspan">{{ $message }}</span>
                            @enderror
                          </div>
                        </div>
                        <div class="col-12 col-md-6">
                          <div class="mb-3">
                            <label for="exampleFormControlInput7" class="form-label">Processing Fee </label>
                            <input type="text" wire:model='processing_fee1' class="form-control" id="exampleFormControlInput7" placeholder="">
                            @error('processing_fee1')
                                <span class="customspan">{{ $message }}</span>
                            @enderror
                          </div>
                        </div>
                        
                      </div>

                      <div class="row">
                        <div class="col-12 col-md-6">
                          <div class="mb-3">
                            <label for="exampleFormControlInput4" class="form-label">Interest Per Year</label>
                            <input type="text" wire:model='interest_per_year1' class="form-control" id="exampleFormControlInput4" placeholder=""
                              readonly>
                          </div>
                        </div>
                        <div class="col-12 col-md-6">
                          <div class="mb-3">
                            <label for="exampleFormControlInput5" class="form-label">Total Interest </label>
                            <input type="text" wire:model='total_interest1' class="form-control" id="exampleFormControlInput5" placeholder=""
                              readonly>
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-12 col-md-6">
                          <div class="mb-3">
                            <label for="exampleFormControlInput6" class="form-label">Total of P + I</label>
                            <input type="text" wire:model='total_pi1' class="form-control" id="exampleFormControlInput6" placeholder=""
                              readonly>
                          </div>
                        </div>
                        <div class="col-12 col-md-6">
                          <div class="mb-3">
                            <label for="exampleFormControlInput8" class="form-label">Fee in Dollar</label>
                            <input type="text" wire:model='fee_in_dollar1' class="form-control" id="exampleFormControlInput8" placeholder=""
                              readonly>
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-12">
                          <div class="mb-3">
                            <label for="exampleFormControlInput9" class="form-label">P + I + Fee</label>
                            <input type="text" wire:model='pi_fee1' class="form-control" id="exampleFormControlInput9" placeholder=""
                              readonly>
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-12 col-md-6">
                          <div class="mb-3">
                            <label for="exampleFormControlInput10" class="form-label">Monthly Installment </label>
                            <input type="text" wire:model='monthly_installment1' class="form-control" id="exampleFormControlInput10" placeholder=""
                              readonly>
                          </div>
                        </div>
                        <div class="col-12 col-md-6">
                          <div class="mb-3">
                            <label for="exampleFormControlInput11" class="form-label">Yearly Installment</label>
                            <input type="text" wire:model='yearly_installment1' class="form-control" id="exampleFormControlInput11" placeholder=""
                              readonly>
                          </div>
                        </div>
                      </div>

                    </form>
                  </div>
                </div>
              </div>

              <div class="col-12 col-lg-6">
                <div class="card mb-3 rounded-3">
                  <div class="card-body">
                    <h3 class="card-title">Loan 2</h3>
                    <form action="" class="mt-4">

                      <div class="row">
                        <div class="col-12 col-md-6">
                          <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">$ Quantum</label>
                            <input type="text" wire:model='quantum2' class="form-control" id="exampleFormControlInput1" placeholder="">
                            @error('quantum2')
                                <span class="customspan">{{ $message }}</span>
                            @enderror
                          </div>
                        </div>
                        <div class="col-12 col-md-6">
                          <div class="mb-3">
                            <label for="exampleFormControlInput2" class="form-label">Tenure - Years</label>
                            <input type="text" wire:model='tenure_years2' class="form-control" id="exampleFormControlInput2" placeholder="">
                            @error('tenure_years2')
                                <span class="customspan">{{ $message }}</span>
                            @enderror
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-12 col-md-6">
                          <div class="mb-3">
                            <label for="exampleFormControlInput3" class="form-label">Interest Per Year (%)</label>
                            <input type="text" wire:model="interest_per_year_percent2" class="form-control" id="exampleFormControlInput3" placeholder="">
                            @error('interest_per_year_percent2')
                                <span class="customspan">{{ $message }}</span>
                            @enderror
                          </div>
                        </div>
                        <div class="col-12 col-md-6">
                          <div class="mb-3">
                            <label for="exampleFormControlInput7" class="form-label">Processing Fee </label>
                            <input type="text" wire:model='processing_fee2' class="form-control" id="exampleFormControlInput7" placeholder="">
                            @error('processing_fee2')
                                <span class="customspan">{{ $message }}</span>
                            @enderror
                          </div>
                        </div>

                      <div class="row">
                        <div class="col-12 col-md-6">
                          <div class="mb-3">
                            <label for="exampleFormControlInput4" class="form-label">Interest Per Year</label>
                            <input type="text" wire:model='interest_per_year2' class="form-control" id="exampleFormControlInput4" placeholder=""
                              readonly>
                          </div>
                        </div>
                        <div class="col-12 col-md-6">
                          <div class="mb-3">
                            <label for="exampleFormControlInput5" class="form-label">Total Interest </label>
                            <input type="text" wire:model='total_interest2' class="form-control" id="exampleFormControlInput5" placeholder=""
                              readonly>
                          </div>
                        </div>
                        
                      </div>

                      <div class="row">
                        <div class="col-12 col-md-6">
                          <div class="mb-3">
                            <label for="exampleFormControlInput6" class="form-label">Total of P + I</label>
                            <input type="text" wire:model='total_pi2' class="form-control" id="exampleFormControlInput6" placeholder=""
                              readonly>
                          </div>
                        </div>
                        <div class="col-12 col-md-6">
                          <div class="mb-3">
                            <label for="exampleFormControlInput8" class="form-label">Fee in Dollar</label>
                            <input type="text" wire:model='fee_in_dollar2' class="form-control" id="exampleFormControlInput8" placeholder=""
                              readonly>
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-12">
                          <div class="mb-3">
                            <label for="exampleFormControlInput9" class="form-label">P + I + Fee</label>
                            <input type="text" wire:model='pi_fee2' class="form-control" id="exampleFormControlInput9" placeholder=""
                              readonly>
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-12 col-md-6">
                          <div class="mb-3">
                            <label for="exampleFormControlInput10" class="form-label">Monthly Installment </label>
                            <input type="text" wire:model='monthly_installment2' class="form-control" id="exampleFormControlInput10" placeholder=""
                              readonly>
                          </div>
                        </div>
                        <div class="col-12 col-md-6">
                          <div class="mb-3">
                            <label for="exampleFormControlInput11" class="form-label">Yearly Installment</label>
                            <input type="text" wire:model='yearly_installment2' class="form-control" id="exampleFormControlInput11" placeholder=""
                              readonly>
                          </div>
                        </div>
                      </div>

                    </form>
                  </div>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="d-flex align-items-center">
                <h5>Difference : </h5>
                <p class="mb-2">${{ $difference ?? ''}}</p>
              </div>
              <div class="row">
                <p>{{ $expense_message ?? ''}}</p>
              </div>
            </div>

            <div class="text-center mt-3">
              <button class="btn btn-custom" wire:click='calculateDifference'>See Result</button>
            </div>
          </div>
        </div>
      </div>
      <!--end row-->

    </div>
    <!--end container-->

  </section>
  <!--end section-white-->
</div>
