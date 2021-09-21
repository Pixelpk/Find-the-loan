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
                                <h4 class="page-title">Partner profile</h4>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end page-title -->

                <div class="row">
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-body">

                                <h4 class="mt-0 header-title">Update profile</h4>
                                <form class="" method="post" action="{{ route('partner-profile') }}">
                                    @csrf
                                    <div class="form-group">
                                        <label>Name</label>
                                        <input type="text" value="{{ Auth::user()->name }}" class="form-control" required placeholder="First name" value="{{ Auth::user()->first_name }}" name="first_name" />
                                    </div>

                                    <div class="form-group">
                                        <label>E-Mail</label>
                                        <div>
                                            <input type="email" disabled value="{{ Auth::user()->email }}" name="email" class="form-control" required parsley-type="email" placeholder="Enter a valid e-mail" />
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label>Mobile number</label>
                                        <div>
                                            <input type="text" value="{{ Auth::user()->phone }}" class="form-control" required placeholder="phone" name="phone" />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="" class="control-label mb-10">Min quantum:</label>
                                        <input type="number" required id="min_quantum" value="{{ Auth::user()->min_quantum }}" name="min_quantum" min="0"
                                               class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="" class="control-label mb-10">Max quantum:</label>
                                        <input type="number" required id="max_quantum" value="{{ Auth::user()->max_quantum }}" name="max_quantum" min="0"
                                               class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="" class="control-label mb-10">Type:</label>
                                        <select required class="form-control" name="type" id="edit_partner_type">
                                            <option value="1" @if(Auth::user()->type == '1') selected @endif>Bank</option>
                                            <option value="2" @if(Auth::user()->type == '2') selected @endif>Excluded moneylender</option>
                                            <option value="3" @if(Auth::user()->type == '3') selected @endif>Fintech</option>
                                            <option value="4" @if(Auth::user()->type == '4') selected @endif>Moneylender</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="" class="control-label mb-10">Company structure:</label>
                                        <select required class="form-control" name="company_structure_id" id="partner_company_structure">
                                            @foreach($structures as $structure)
                                                <option value="{{$structure->id}}" @if($selected_structure == $structure->id) selected @endif>{{ $structure->structure_type }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="" class="control-label mb-10">Loan type:</label>
                                        <select required multiple class="form-control" name="loan_type_id[]" id="partner_loan_type">
                                            @foreach($loan_types as $type)
                                                <option value="{{$type->id}}" @if(in_array($type->id,$selected_loan_types)) selected @endif>{{ $type->sub_type }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="" class="control-label mb-10">Length of incorporation</label>
                                        <input required type="number" value="{{ Auth::user()->length_of_incorporation }}" min="0" class="form-control" name="length_of_incorporation" id="length_of_incorporation">
                                    </div>
                                    <div class="form-group">
                                        <label for="" class="control-label mb-10">% of local shareholding required</label>
                                        <input required type="number" min="0" value="{{ Auth::user()->local_shareholding }}" class="form-control" name="local_shareholding" id="local_shareholding">
                                    </div>
                                    <div class="form-group">
                                        <label for="" class="control-label mb-10">Subsidiaries</label>
                                        <input required type="number" min="0" value="{{ Auth::user()->subsidiaries }}" class="form-control" name="subsidiaries" id="subsidiaries">
                                    </div>
                                    <div class="form-group mb-0">
                                        <div>
                                            <button type="submit" class="btn btn-primary waves-effect waves-light">
                                                Submit
                                            </button>

                                        </div>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>
                    <!-- end col -->

                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-body">

                                <h4 class="mt-0 header-title">Update password</h4>

                                <form method="post" action="{{ route('update-password') }}">
                                    @csrf
                                    <div class="form-group">
                                        <label>Old password</label>
                                        <div>
                                            <input type="password" required name="old_password" class="form-control" placeholder="Old password">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>New password</label>
                                        <div>
                                            <input type="password" required name="password" class="form-control" placeholder="Current Password">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Confirm password</label>
                                        <div>
                                            <input type="password" required name="password_confirmation" class="form-control" placeholder="New Password">
                                        </div>
                                    </div>

                                    <div class="form-group mb-0">
                                        <div>
                                            <button type="submit" class="btn btn-primary waves-effect waves-light">
                                                Update
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
