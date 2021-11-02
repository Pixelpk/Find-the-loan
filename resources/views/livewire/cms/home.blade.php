<main id="hero">

<!-- HERO -->
<section id="home" class="home-section">
  
  <!-- Modal -->
  <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-body">
          <div class="cookie-img text-center">
              <img src="{{ asset ('assets/cms/img/Home/cookie.png')}}" alt="cookie img">
          </div>
          <div class="cookie-content text-center my-2">
              <p class="lea">
                We use cookie to offer a better user experience such as 
                allowing your browser to remember who you are and not 
                having to enter your login address each time.
              </p>
          </div>
          <div class="cookie-buttons text-center">
            <button type="button" class="btn" data-bs-dismiss="modal">Yes to cookies!</button>
            <button type="button" class="btn btn-cookie" data-bs-dismiss="modal">No I hate cookies</button>
          </div>
        </div>
      </div>
    </div>
  </div>
<!-- MODAL COOKIE -->

            <div class="container">
            <div class="row text-center">
                <h2 class="fw-bold text-white display-6">Still approaching banks one by one <br> when you need a loan?</h2>
            </div>
        
            <!-- CARDS -->
            <div class="row mt-4">
                <div class="col-sm-12 col-md-12 col-lg-4">
                    <div class="card nmor-card text-center">
                        <div class="card-body">
                            <div class="icon-circle mx-auto mb-3">
                            <svg class="circle__icon" xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-users" viewBox="0 0 24 24" stroke-width="1.5" stroke="#00b341" fill="none" stroke-linecap="round" stroke-linejoin="round">
          <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
          <circle cx="9" cy="7" r="4" />
          <path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" />
          <path d="M16 3.13a4 4 0 0 1 0 7.75" />
          <path d="M21 21v-2a4 4 0 0 0 -3 -3.85" />
        </svg>
                            </div>
                            <h5 class="fw-bold">Ease</h5>
                            <hr>
                            <p>Single interface to easily reach multiple lenders, no more grappling with different jargons, banks's website layout and product names.</p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-12 col-lg-4">
                <div class="card nmor-card text-center">
                        <div class="card-body">
                            <div class="icon-circle mx-auto mb-3">
                            <svg class="circle__icon" xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-clipboard-list" viewBox="0 0 24 24" stroke-width="1.5" stroke="#00b341" fill="none" stroke-linecap="round" stroke-linejoin="round">
          <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
          <path d="M9 5h-2a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-12a2 2 0 0 0 -2 -2h-2" />
          <rect x="9" y="3" width="6" height="4" rx="2" />
          <line x1="9" y1="12" x2="9.01" y2="12" />
          <line x1="13" y1="12" x2="15" y2="12" />
          <line x1="9" y1="16" x2="9.01" y2="16" />
          <line x1="13" y1="16" x2="15" y2="16" />
        </svg>
                            </div>
                            <h5 class="fw-bold">Tailord</h5>
                            <hr>
                            <p>For business to home loans, get actual qoutes directly from our lenders based on your credit profile, not some advertised rates, no broker involved.</p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-12 col-lg-4">
                <div class="card nmor-card text-center">
                        <div class="card-body">
                            <div class="icon-circle mx-auto mb-3">
                            <svg  class="circle__icon" xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-alarm" viewBox="0 0 24 24" stroke-width="1.5" stroke="#00b341" fill="none" stroke-linecap="round" stroke-linejoin="round">
          <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
          <circle cx="12" cy="13" r="7" />
          <polyline points="12 10 12 13 14 13" />
          <line x1="7" y1="4" x2="4.25" y2="6" />
          <line x1="17" y1="4" x2="19.75" y2="6" />
        </svg>
                            </div>
                            <h5 class="fw-bold">Speed</h5>
                            <hr>
                            <p>Being able to reach so many lenders directly with just a single submission helps you in finding a competative loan fast.</p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /CARDS -->
                </div>
     </section>
<!-- /HERO -->

   <!-- LOAN TYPE -->
   <section id="loan-type" class="loan-type">
           <div class="container">
           <div class="loan-type same-carousel owl-carousel">
                <!-- ITEM 1 -->
                @foreach($loan_types as $type)

                <div class="loan-type__icon">
                    <div class="card">
                        <div class="card-body">
                         <div class="icon-circle mx-auto mb-3">
                             <svg class="circle__icon" xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-receipt-tax" width="28" height="28" viewBox="0 0 24 24" stroke-width="1.5" stroke="#00b341" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                 <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                 <line x1="9" y1="14" x2="15" y2="8" />
                                 <circle cx="9.5" cy="8.5" r=".5" fill="currentColor" />
                                 <circle cx="14.5" cy="13.5" r=".5" fill="currentColor" />
                                 <path d="M5 21v-16a2 2 0 0 1 2 -2h10a2 2 0 0 1 2 2v16l-3 -2l-2 2l-2 -2l-2 2l-2 -2l-3 2" />
                               </svg>
                             </div>
                             <p>{{ $type->sub_type }}</p>
                        </div>
                    </div>
                </div>
                @endforeach
              </div>
           </div>
       </section>
       <!-- /LOAN TYPE -->

         <!-- CHANGE THE WAY -->
         <section id="change-way" class="change-way">
           <div class="container">
               <div class="row text-center">
                   <h2 class="fw-bold">Change the way you find the loan!</h2>
               </div>
               <div class="row align-items-center">
                   <div class="col-sm-12 col-md-6 col-lg-4">
                    <div class="change-way__line d-md-flex">
                        <!-- CARD + LINE -->
                                   <div class="card shadow">
                                       <div class="card-body">
                                           <div class="no-circle">01</div>
                                           <svg class="circle__icon" xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-receipt-tax" width="28" height="28" viewBox="0 0 24 24" stroke-width="1.5" stroke="#00b341" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                            <line x1="9" y1="14" x2="15" y2="8" />
                                            <circle cx="9.5" cy="8.5" r=".5" fill="currentColor" />
                                            <circle cx="14.5" cy="13.5" r=".5" fill="currentColor" />
                                            <path d="M5 21v-16a2 2 0 0 1 2 -2h10a2 2 0 0 1 2 2v16l-3 -2l-2 2l-2 -2l-2 2l-2 -2l-3 2" />
                                          </svg>
                                       </div>
                                   </div>
                                   <div class="line">
                                   </div>
                                    <!-- /CARD + LINE -->
                   </div>
                   <!-- /CHANGE WAY LINE -->
                   </div>
                   <div class="col-sm-12 col-md-6 col-lg-8 pt-3 ps-md-3">
                   <P class="lea">Simple chose the loan type you are looking for.</P>
                   </div>
               </div>
              

<div class="row align-items-center">
    <div class="col-sm-12 col-md-6 col-lg-8 pt-3 order-2 order-md-1">
        <P class="lea">Upload the documents required. our algorithm will guide you on what documents are required</P>
    </div>
    <div class="col-sm-12 col-md-6 col-lg-4 order-1 order-md-2">
        <div class="change-way__line d-md-flex">
            <!-- CARD + LINE -->
                       <div class="line line2">
                       </div>
                       <div class="card shadow ">
                        <div class="card-body">
                            <div class="no-circle">02</div>
                            <svg class="circle__icon" xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-receipt-tax" width="28" height="28" viewBox="0 0 24 24" stroke-width="1.5" stroke="#00b341" fill="none" stroke-linecap="round" stroke-linejoin="round">
                             <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                             <line x1="9" y1="14" x2="15" y2="8" />
                             <circle cx="9.5" cy="8.5" r=".5" fill="currentColor" />
                             <circle cx="14.5" cy="13.5" r=".5" fill="currentColor" />
                             <path d="M5 21v-16a2 2 0 0 1 2 -2h10a2 2 0 0 1 2 2v16l-3 -2l-2 2l-2 -2l-2 2l-2 -2l-3 2" />
                           </svg>
                        </div>
                    </div>
                        <!-- /CARD + LINE -->
                        
       </div>
       <!-- /CHANGE WAY LINE 1 -->

    </div>
</div>
              
      <div class="row align-items-center">
          <div class="col-sm-12 col-md-6 col-lg-4">
            <div class="change-way__line d-md-flex">
                <!-- CARD + LINE -->
                           <div class="card shadow">
                               <div class="card-body">
                                   <div class="no-circle">03</div>
                                   <svg class="circle__icon" xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-receipt-tax" width="28" height="28" viewBox="0 0 24 24" stroke-width="1.5" stroke="#00b341" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                    <line x1="9" y1="14" x2="15" y2="8" />
                                    <circle cx="9.5" cy="8.5" r=".5" fill="currentColor" />
                                    <circle cx="14.5" cy="13.5" r=".5" fill="currentColor" />
                                    <path d="M5 21v-16a2 2 0 0 1 2 -2h10a2 2 0 0 1 2 2v16l-3 -2l-2 2l-2 -2l-2 2l-2 -2l-3 2" />
                                  </svg>
                               </div>
                           </div>
                           <div class="line">
                           </div>
                            <!-- /CARD + LINE -->
           </div>
           <!-- /CHANGE WAY LINE 2-->
          </div>
          <div class="col-sm-12 col-md-6 col-lg-8 pt-3 ps-md-3">
            <P class="lea">Compare and select who offer the highest quantum, logest tenure, lowest fee or interest, after our financing partners compete to offer you a loan.</P>
          </div>
      </div>
    
      <div class="text-center ">
          <a href="{{ route('applyLoan') }}" class="btn change-way__btn mt-3">Apply Now</a>
        </div>
           </div>
       </section>
       <!-- /CHANGE THE WAY -->

       <!-- DONT COMPARE -->
       <section id="dont-compare" class="dont-compare">
           <div class="container">
               <div class="row">
                   <div class="col-sm-12 col-md-6 col-lg-5">
                       <div class="compare__icon w-100 h-100 text-center text-lg-end">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-files" width="250" height="250" viewBox="0 0 24 24" stroke-width="1.5" stroke="#00b341" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                            <path d="M15 3v4a1 1 0 0 0 1 1h4" />
                            <path d="M18 17h-7a2 2 0 0 1 -2 -2v-10a2 2 0 0 1 2 -2h4l5 5v7a2 2 0 0 1 -2 2z" />
                            <path d="M16 17v2a2 2 0 0 1 -2 2h-7a2 2 0 0 1 -2 -2v-10a2 2 0 0 1 2 -2h2" />
                          </svg>
                       </div>
                   </div>
                   <div class="col-sm-12 col-md-6 col-lg-7">
                    <div class="compare__content">
                        <h2 class="fw-bold">What happen if you don't compare?</h2>
                        <p class="lea">Imagine 2 loans that are both $300,000 and 5 years long but 1 is at 3% and the other at 3.50% pa.</p>
                        <p class="lea">That would you give a total interest of $45,000 vs $52,500-a difference of $7,500.</p>
                    </div>
                   </div>
               </div>
           </div>
       </section>
       <!-- /DONT COMPARE -->

         <!-- FINANCING PARTNERS -->
         <section id="finance-partner" class="finance-partner">
           <div class="container">
               <div class="row text-center">
                   <h2 class="fw-bold">Some of our Financing Partners</h2>
                   </div>
                   <div class="finance__cards same-carousel owl-carousel">
                    @foreach($partners as $partner)
                       @if ($partner->image != '')
                        <div class="finance__card">
                            <div class="card shadow">
                                <div class="card-body">
                                    <img class="img-fluid" src="{{ asset('uploads/financePartnerImages/'.$partner->image) }}" alt="">
                                    
                                </div>
                            </div>
                        </div> 
                       @endif
                       
                    @endforeach
                   </div>
               </div>
       </section>
       <!-- /FINANCING PARTNERS -->
      
</main>
