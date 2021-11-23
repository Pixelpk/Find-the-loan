@extends("admin.layouts.master")
@section('content')
    <div class="content-page">
        <div class="content">
            <div class="container-fluid">
                <div class="page-title-box">

                    <div class="row align-items-center ">
                        <div class="col-md-6">
                            <div class="page-title-box">
                                <h4 class="page-title">Sales report</h4>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <form action="{{ route('admin-sales-report') }}" class="">
                                <div class="col-md-6 float-left">
                                    <div class="form-group">
                                        <select class="form-control" required  name="partner_id">
                                            <option value="">Select Partner</option>
                                            @foreach ($finance_partners as $partner)
                                                <option value="{{$partner->id}}" @isset($selected_partner) @if($selected_partner == $partner->id) selected @endif @endisset >{{$partner->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            
                                <button type="submit" class="btn btn-primary">Apply</button>

                            </form>
                        </div>
                    </div>
                </div>
                <!-- end page-title -->

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="">
                                    <div class="table-responsive b-0" data-pattern="priority-columns">
                                        <table id="" class="table">
                                            <thead>
                                                <th style="min-width:130px;">Month</th>
                                                <th style="min-width:130px;">Received</th>
                                                <th style="min-width:130px;">Quoted</th>
                                                <th style="min-width:130px;">Disbursed</th>
                                                <th style="min-width:130px;">Disburse to quote ratio by $$</th>
                                                <th style="min-width:130px;">Disburse to quote ratio by lead count</th>
                                            </thead>
                                            <tbody>
                                                @foreach ($month_list as $month)
                                                <tr>
                                                    <td>{{ $month['month_name'] }}</td>
                                                    <td>{{ $month['partner_applications_count'] }}</td>
                                                    <td>
                                                        <span style="font-weight:bold">Leads: {{ $month['partner_quoted_applications_count'] }}</span><br>
                                                        <span style="font-weight:bold">Of Leads: {{ $month['avg_quoted_applications'] }}</span><br>
                                                        <span style="font-weight:bold">Amount quoted: {{ $month['amount_quoted'] }}</span><br>
                                                        <span style="font-weight:bold">Average quoted: {{ $month['amount_quoted_average'] }}</span><br>
                                                    </td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                </tr>
                                                @endforeach
                                            </tbody>                                            
                                        </table>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- end col -->
                </div>
                <!-- end row -->

            </div>
            <!-- container-fluid -->

        </div>
        @include('admin.pages.footer')
    </div>

@endsection
