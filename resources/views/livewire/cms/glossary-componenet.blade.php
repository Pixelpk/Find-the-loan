<div>
    {{-- Success is as dangerous as failure. --}}

    <div>
    <div class="breadcrumb-wrapper">

    <div class="breadcrumb-wrapper-overlay"></div>

    <!--begin container -->
    <div class="container sec-container">

        <!--begin row -->
        <div class="row">

            <!--begin col-xs-12 -->
            <div class="col-sm-12 col-lg-12 col-xs-12">

                <h2 class="page-title white text-center">Glossary</h2>

            </div>


            <!--end col-xs-12 -->

        </div>
        <!--end row -->

    </div>
    <!--end container -->

    </div>
    <!--end breadcrumb-wrapper-->

    <!--begin section-white -->
    <section class="section-white-services py-3">

    <!--begin container-->
    <div class="container">
        {{-- GLOSSARY CONTENT --}}
        <section id="sec1">
    <div class="row">
        <div class="col">
            <div class="card my-3" style="border: 0px;">
                <div class="card-body">
                  <div class="row">
                      <div class="col-12 col-md-4" style="border-right: 1px solid #cdcdcd; overflow-x: auto; height: 600px;">
                        <div class="nav flex-column nav-pills glossary-tabs" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                            @foreach($glossaries as $key=>$glossary)
                                <a class="nav-link @if($key == 0) active @endif" id="v-pills-glossary-tab-{{$key}}" data-toggle="pill" href="#v-pills-glossary-{{$key}}" role="tab" aria-controls="v-pills-glossary-{{$key}}" aria-selected="true">{{ $glossary->title }}</a>
                            @endforeach
                            {{-- <a class="nav-link active" id="v-pills-second-loan-tab" data-toggle="pill" href="#v-pills-second-loan" role="tab" aria-controls="v-pills-second-loan" aria-selected="true">2nd Charge, Caveat Loan</a>
                            <a class="nav-link" id="v-pills-amortization-tab" data-toggle="pill" href="#v-pills-amortization" role="tab" aria-controls="v-pills-amortization" aria-selected="false">Amortization </a>
                            <a class="nav-link" id="v-pills-ensure-article-tab" data-toggle="pill" href="#v-pills-ensure-article" role="tab" aria-controls="v-pills-ensure-article" aria-selected="false">Please ensure links on articles to another article if any are added</a> --}}
                          </div>
                      </div>
                      <div class="col-12 col-md-8">
                        <div class="tab-content" id="v-pills-tabContent">
                            @foreach($glossaries as $key=>$glossary)
                                <div class="tab-pane fade show @if($key == 0) active @endif" id="v-pills-glossary-{{$key}}" role="tabpanel" aria-labelledby="v-pills-glossary-tab-{{$key}}">{!! $glossary->description !!}</div>
                            @endforeach
                            {{-- <div class="tab-pane fade show active" id="v-pills-second-loan" role="tabpanel" aria-labelledby="v-pills-second-loan-tab">2nd Charge Loan</div>
                            <div class="tab-pane fade" id="v-pills-amortization" role="tabpanel" aria-labelledby="v-pills-amortization-tab">Amortization</div>
                            <div class="tab-pane fade" id="v-pills-ensure-article" role="tabpanel" aria-labelledby="v-pills-ensure-article-tab">Please ensure links on articles to another article if any are added</div> --}}

                          </div>
                      </div>
                  </div>

                </div>
            </div>
        </div>
    </div>
</section>
     {{-- /GLOSSARY CONTENT --}}

        <!--begin row-->
        {{-- <div class="row">
            <div class="col-md-12">
                {!! $glossary !!}
            </div>
        </div> --}}
        <!--end row-->

    </div>
    <!--end container-->

    </section>
    <!--end section-white-->
    </div>

</div>
