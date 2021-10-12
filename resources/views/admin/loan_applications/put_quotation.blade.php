@extends("admin.layouts.master")
@section('content')
<div class="content-page">
    <!-- Start content -->
    <div class="content">

        <div class="container-fluid">
            <div class="page-title-box">

                <div class="row align-items-center ">
                    <div class="col-md-12">
                        <div class="page-title-box">
                            <h4 class="page-title">Put quotation</h4>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end page-title -->

            <!-- FORM NO 1 -->
            <div class="container bg-white shadow py-3" style="border-radius: 0.7rem;">
                <!-- SEC 1 -->
                <form action="">
                    <!-- 1ST ROW -->
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="input1" class="col-form-label">Interest (flat)</label>
                            <input type="text" class="form-control" id="input1">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="input2" class="col-form-label">% P.a &nbsp; or &nbsp; % P.m</label>
                            <input type="text" class="form-control" id="input2">
                        </div>
                    </div>
                    <!-- /1ST ROW -->
                    <!-- SEPRATER -->
                    <div class="row my-2">
                        <h5 class="m-0 mx-auto">OR</h5>
                    </div>
                    <!-- /SEPRATER -->

                    <!-- 2ND ROW -->
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="input3" class="col-form-label">Interest (Reducing Balance)</label>
                            <input type="text" class="form-control" id="input3">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="input4" class="col-form-label">% P.a &nbsp; or &nbsp; % P.m</label>
                            <input type="text" class="form-control" id="input4">
                        </div>
                    </div>
                    <!-- /2ND ROW -->

                    <!-- SEPRATER -->
                    <div class="row my-2">
                        <h5 class="m-0 mx-auto">OR</h5>
                    </div>
                    <!-- /SEPRATER -->

                    <!-- 3RD ROW -->
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="input5" class="col-form-label">Interest+board rate of</label>
                            <input type="text" class="form-control" id="input5">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="input6" class="col-form-label">% P.a &nbsp; + &nbsp; % P.m</label>
                            <input type="text" class="form-control" id="input6">
                        </div>
                    </div>
                    <!-- /3RD ROW -->

                    <!-- SEPRATER -->
                    <div class="row my-2">
                        <h5 class="m-0 mx-auto">OR</h5>
                    </div>
                    <!-- /SEPRATER -->

                    <!-- 4TH ROW -->
                    <div class="form-row">
                        <div class="form-group col-md-5">
                            <label for="input7" class="col-form-label">Flat free regardless of tenure $
                            </label>
                            <input type="text" class="form-control" id="input7">
                        </div>
                        <div class="form-group col-md-1 d-flex align-items-end justify-content-center">
                            <label for="input8" class="col-form-label">/</label>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="input8" class="col-form-label">%</label>
                            <input type="text" class="form-control" id="input8">
                        </div>
                    </div>
                    <!-- /4TH ROW -->
                </form>
                <!-- /SEC 1 -->

                <hr style=" background: grey;">

                <!-- SEC 2 -->
                <form action="">
                    <!-- 1ST ROW -->
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="input9" class="col-form-label">Interest (Reducing Balance)</label>
                            <input type="text" class="form-control" id="input9">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="input10" class="col-form-label">Years &nbsp; - &nbsp; Months</label>
                            <input type="text" class="form-control" id="input10">
                        </div>
                    </div>
                    <!-- /1ST ROW -->

                    <!-- 2ND ROW -->
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="input11" class="col-form-label">Look-in if any (please state final length free
                                of any form of
                                penalty)</label>
                            <input type="text" class="form-control" id="input11">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="input12" class="col-form-label">Years &nbsp; - &nbsp; Months</label>
                            <input type="text" class="form-control" id="input12">
                        </div>
                    </div>
                    <!-- /2ND ROW -->
                </form>
                <!-- /SEC 2 -->
            </div>
            <!-- /FORM NO 1 -->

            <!-- FORM 2 -->
            <div class="container bg-white shadow py-3 mt-5" style="border-radius: 0.7rem;">
                <form action="">
                    <!-- 1ST ROW -->
                    <div class="form-row pl-3 pr-3">
                        <!-- 1ST COL -->
                        <div class="col-lg-2 col-md-2 col-sm-12 same-col">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios1"
                                    value="option1">
                                <label class="form-check-label" for="exampleRadios1">
                                    Fixed
                                </label>
                            </div>
                        </div>
                        <!-- /1ST COL -->

                        <!-- 2nd COL -->
                        <div class="col-lg-2 col-md-2 col-sm-12 same-col">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios2"
                                    value="option2">
                                <label class="form-check-label" for="exampleRadios2">
                                    Floating
                                </label>
                            </div>
                        </div>
                        <!-- /2nd COL -->

                        <!-- 3RD COL -->
                        <div class="col-lg-2 col-md-2 col-sm-12 same-col">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios3"
                                    value="option3">
                                <label class="form-check-label" for="exampleRadios3">
                                    Sibor
                                </label>
                            </div>
                        </div>
                        <!-- /3RD COL -->

                        <!-- 4TH COL -->
                        <div class="col-lg-2 col-md-2 col-sm-12 same-col">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios4"
                                    value="option4">
                                <label class="form-check-label" for="exampleRadios4">
                                    Sor
                                </label>
                            </div>
                        </div>
                        <!-- /4TH COL -->

                        <!-- 5TH COL -->
                        <div class="col-lg-2 col-md-2 col-sm-12 same-col">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios5"
                                    value="option5">
                                <label class="form-check-label" for="exampleRadios5">
                                    Sora
                                </label>
                            </div>
                        </div>
                        <!-- /5TH COL -->

                        <!-- 6TH COL -->
                        <div class="col-lg-2 col-md-2 col-sm-12 same-col">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios6"
                                    value="option6">
                                <label class="form-check-label" for="exampleRadios6">
                                    Board
                                </label>
                            </div>
                        </div>
                        <!-- /6TH COL -->
                    </div>
                    <!-- /1ST ROW -->

                    <!-- 2nd ROW -->
                    <div class="form-row pl-3 pr-3">
                        <!-- 1ST COL -->
                        <div class="col-lg-2 col-md-2 col-sm-12 same-col">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios7"
                                    value="option7">
                                <label class="form-check-label" for="exampleRadios7">
                                    Fixed Deposit
                                </label>
                            </div>
                        </div>
                        <!-- /1ST COL -->

                        <!-- 2nd COL -->
                        <div class="col-lg-2 col-md-2 col-sm-12 same-col">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios8"
                                    value="option8">
                                <label class="form-check-label" for="exampleRadios8">
                                    Libor
                                </label>
                            </div>
                        </div>
                        <!-- /2nd COL -->

                        <!-- 3RD COL -->
                        <div class="col-lg-2 col-md-2 col-sm-12 same-col">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios9"
                                    value="option9">
                                <label class="form-check-label" for="exampleRadios9">
                                    Hdb
                                </label>
                            </div>
                        </div>
                        <!-- /3RD COL -->

                        <!-- 4TH COL -->
                        <div class="col-lg-6 col-md-6 col-sm-12 same-col">
                            <div class="form-row">
                                <div class="col-sm-12 col-md-6 col-lg-6 same-col">
                                    <span class="col-form-label">Other publicaly available financial indicator</span>
                                </div>
                                <div class="col-sm-12 col-md-6 col-lg-6 same-col">
                                    <input type="text" class="form-control" id="input11">
                                </div>

                            </div>
                        </div>
                        <!-- /4TH COL -->

                    </div>
                    <!-- /2nd ROW -->

                    <!-- 3RD ROW -->
                    <div class="form-row pl-3 pr-3">
                        <div class="form-group col-md-6">
                            <label for="input12" class="col-form-label">Years &nbsp; - &nbsp; Months</label>
                            <input type="text" class="form-control" id="input12">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="input13" class="col-form-label">Current Value in %</label>
                            <input type="text" class="form-control" id="input13">
                        </div>
                    </div>
                    <!-- /3RD ROW -->

                    <!-- 4TH ROW -->
                    <div class="form-row pl-3 pr-3">
                        <div class="form-group col-md-4">
                            <label for="input14" class="col-form-label">Quantum &nbsp;$</label>
                            <input type="text" class="form-control" id="input14">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="input15" class="col-form-label">Tenure</label>
                            <input type="text" class="form-control" id="input15">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="input16" class="col-form-label">Years &nbsp; - &nbsp; Months</label>
                            <input type="text" class="form-control" id="input16">
                        </div>
                    </div>
                    <!-- /4TH ROW -->
                </form>
            </div>
            <!-- /FORM 2 -->

            <!-- FORM 3 -->
            <div class="container bg-white shadow py-3 mt-5" style="border-radius: 0.7rem;">
                <form action="">
                    <!-- 1ST ROW -->
                    <div class="form-row pl-3 pr-3 my-3">
                        <div class="form-group col-md-6 d-flex">
                            <div class="s-content d-flex">
                                <label for="input17" class="col-form-label">1<sup>st</sup> Month -</label>
                                <input type="text" class="form-control s-input" id="input17">
                                <label for="input17" class="col-form-label">Month</label>
                            </div>
                            <div class="s-content d-flex">
                                <input type="text" class="form-control s-input" id="input18">
                                <label for="input18" class="col-form-label">% P.a</label>
                            </div>
                        </div>
                        <div class="form-group col-md-1">
                            <!-- SEPRATOR -->
                            <div class="row pt-2">
                                <h5 class="m-0">OR</h5>
                            </div>
                            <!--/SEPRATOR  -->
                        </div>

                        <div class="form-group col-md-5 d-flex">
                            <div class="s-content d-flex">
                                <label for="input19" class="col-form-label">yyy xxx +</label>
                                <input type="text" class="form-control s-input" id="input19">
                                <label for="input17" class="col-form-label">%</label>
                            </div>
                            <div class="s-content d-flex">
                                <span class="pt-2">=</span> <input type="text" class="form-control s-input" id="input20"
                                    readonly="true">
                                <label for="input20" class="col-form-label">% P.a</label>
                            </div>
                        </div>
                    </div>
                    <!-- /1ST ROW -->

                    <!-- 2ND ROW -->
                    <div class="form-row pl-3 pr-3 my-3">
                        <div class="form-group col-md-6 d-flex">
                            <div class="s-content d-flex">
                                <label for="input21" class="col-form-label">if any</label>
                                <input type="text" class="form-control s-input" id="input21">
                            </div>
                            <div class="s-content d-flex">
                                <label for="input22" class="col-form-label">Month -</label>
                                <input type="text" class="form-control s-input" id="input22">
                                <label for="input22" class="col-form-label">Month</label>
                            </div>
                            <div class="s-content d-flex">
                                <input type="text" class="form-control s-input" id="input23">
                                <label for="input23" class="col-form-label">% P.a</label>
                            </div>
                        </div>
                        <div class="form-group col-md-1">
                            <!-- SEPRATOR -->
                            <div class="row pt-2">
                                <h5 class="m-0">OR</h5>
                            </div>
                            <!--/SEPRATOR  -->
                        </div>
                        <div class="form-group col-md-5 d-flex">
                            <div class="s-content d-flex">
                                <label for="input24" class="col-form-label">yyy xxx +</label>
                                <input type="text" class="form-control s-input" id="input24">
                                <label for="input24" class="col-form-label">%</label>
                            </div>
                            <div class="s-content d-flex">
                                <span class="pt-2">=</span> <input type="text" class="form-control s-input" id="input25"
                                    readonly="true">
                                <label for="input25" class="col-form-label">% P.a</label>
                            </div>
                        </div>
                    </div>
                    <!-- /2ND ROW -->

                    <!-- 3RD ROW -->
                    <div class="form-row pl-3 pr-3 my-3">
                        <div class="form-group col-md-5 d-flex">
                            <div class="s-content d-flex">
                                <label for="input26" class="col-form-label">Thereafter if any</label>
                                <input type="text" class="form-control s-input" id="input26">
                                <label for="input27" class="col-form-label">% P.a</label>
                            </div>
                        </div>
                        <div class="form-group col-md-1">
                            <!-- SEPRATOR -->
                            <div class="row pt-2">
                                <h5 class="m-0">OR</h5>
                            </div>
                            <!--/SEPRATOR  -->
                        </div>
                        <div class="form-group col-md-4 d-flex">
                            <div class="s-content d-flex">
                                <label for="input19" class="col-form-label">yyy xxx +</label>
                                <input type="text" class="form-control s-input" id="input19">
                                <label for="input17" class="col-form-label">%</label>
                            </div>
                            <div class="s-content d-flex">
                                <span class="pt-2">=</span> <input type="text" class="form-control s-input" id="input20"
                                    readonly="true">
                                <label for="input20" class="col-form-label">% P.a</label>
                            </div>
                        </div>
                        <div class="col-md-2"></div>
                    </div>
                    <!-- /3RD ROW -->
                </form>
            </div>
            <!-- /FORM 3 -->
        </div>
        <!-- container-fluid -->
    </div>
    <!-- content -->

    @include('admin.pages.footer')

</div>
@endsection