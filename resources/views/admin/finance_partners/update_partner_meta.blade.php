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
                                <h4 class="page-title">Update details</h4>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end page-title -->
                <div class="row">

                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                {{--                                <h4 class="mt-0 header-title">Web Data</h4>--}}
                                <form method="post" action="{{ route('submit-partner-meta-request') }}">
                                    @csrf
                                    <div class="form-group">
                                        <h5>Terms & conditions(such as fees for late payment, early termination, how is it calculated etc)</h5>
                                        <textarea type="text" class="form-control ckeditor"  name="terms_condition" ></textarea>
                                    </div>
                                    <div class="form-group">
                                        <h5>Promo</h5>
                                        <textarea type="text" class="form-control ckeditor"  name="promo" ></textarea>
                                    </div>
                                    <div class="form-group">
                                        <h5>Subsidy & Features</h5>
                                        <textarea type="text" class="form-control ckeditor"  name="subsidy_features" ></textarea>
                                    </div>

                                    <div class="add_board_rate_div">
                                        {{-- <div class="row" >
                                            <div class="form-group col-md-4">
                                                <label class="col-form-label">
                                                    Date
                                                </label>
                                                <input type="text" name="board_rate[0][date]" row_index="0" class="form-control date-picker" >
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label class="col-form-label">
                                                    Rate
                                                </label>
                                                <input type="number" min="1" name="board_rate[0][rate]" row_index="0" class="form-control" >
                                            </div>
                                        </div> --}}
                                                @isset($partner_meta['board_rate'])
                                                @foreach ($partner_meta['board_rate'] as $key=>$item)
                                                <div class="row" >
                                                    <div class="form-group col-md-4">
                                                        <label class="col-form-label">
                                                            Date
                                                        </label>
                                                        <input type="text" name="board_rate[{{$key}}][date]" value="{{$item['date']}}" row_index="0" class="form-control date-picker" >
                                                    </div>
                                                    <div class="form-group col-md-4">
                                                        <label class="col-form-label">
                                                            Rate
                                                        </label>
                                                        <input type="number" min="1" name="board_rate[{{$key}}][rate]" value="{{$item['rate']}}" row_index="0" class="form-control" >
                                                    </div>
                                                </div>
                                                @endforeach
                                                    
                                                @endisset
                                        
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 form-group mt-1">
                                                <button type="button" id="add_board_rate_row" class="btn btn-primary waves-effect waves-light">
                                                    Add Board Rate
                                                </button>
                                        </div>
                                    </div>

                                    <div class="form-group mb-0">
                                        <div>
                                            <button type="submit" class="btn float-right admin-btn waves-effect waves-light">
                                                Request Update
                                            </button>
                                        </div>
                                    </div>
                                    
                                </form>

                            </div>
                        </div>
                    </div>
                    <!-- end col -->
                </div>
                <!-- end row -->



            </div>
            <!-- container-fluid -->

        </div>
        <!-- content -->

        @include('admin.pages.footer')

    </div>
@endsection
