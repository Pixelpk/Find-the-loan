@extends("admin.layouts.master")
@section('content')
    <div class="content-page">
        <div class="content">
            <div class="container-fluid">
                <div class="page-title-box">

                    <div class="row align-items-center ">
                        <div class="col-md-2">
                            <div class="page-title-box">
                                <h4 class="page-title">Sales report</h4>
                            </div>
                        </div>
                        <div class="col-md-10">
                            <form action="{{ route('admin-sales-report') }}" class="">
                                <div class="col-md-4 float-left">
                                    <div class="form-group">
                                        <select class="form-control" required  name="partner_id">
                                            <option value="">Select Partner</option>
                                            @foreach ($finance_partners as $partner)
                                                <option value="{{$partner->id}}" @if($selected_partner == $partner->id) selected @endif>{{$partner->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4 float-left">
                                    <div class="form-group">
                                        <select class="form-control" required  name="profile">
                                            <option value="1" @if($selected_profile == '1') selected @endif>Business Enquiries</option>
                                            <option value="2" @if($selected_profile == '2') selected @endif>Consumer Enquiries</option>
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
                                <h5>Received: {{$total_received_applications ?? ''}}</h5>
                                {{-- <div class=""> --}}
                                    <div class="table-responsive b-0" style="width: 100%;overflow-x:scroll" data-pattern="priority-columns">
                                        <table id="" class="table table-bordered" style="width:150%">
                                            <thead>
                                                <th style="">Month</th>
                                                {{-- <th style="">Received</th> --}}
                                                <th style="border-right:none">Quoted</th>
                                                <th style="border-left:none;text-align:center">MoM</th>
                                                <th style="border-right:none">Disbursed</th>
                                                <th style="border-left:none;text-align:center">MoM</th>
                                                <th style="">Disburse to quote ratio by $$</th>
                                                <th style="">Disburse to quote ratio by lead count</th>
                                            </thead>
                                            <tbody>
                                                @foreach ($month_list as $key => $month)
                                                <tr>
                                                    <td>{{ $month['month_name'] }}</td>
                                                    {{-- <td>{{ $month['partner_applications_count'] }}</td> --}}
                                                    <td style="border-right:none">
                                                        <span style="font-weight:bold">Leads: {{ $month['partner_quoted_applications_count'] }}</span><br>
                                                        <span style="font-weight:bold">Of Leads: {{ $month['avg_quoted_applications'] }}</span><br>
                                                        <span style="font-weight:bold">Amount quoted: {{ $month['amount_quoted'] }}</span><br>
                                                        <span style="font-weight:bold">Average quoted: {{ $month['amount_quoted_average'] }}</span><br>
                                                    </td>
                                                    <td style="border-left:none;text-align: center;">
                                                        @if($loop->first )
                                                        <span style="font-weight:bold">{{ $month['partner_quoted_applications_count'] }}</span><br>
                                                        <span style="font-weight:bold">{{ $month['avg_quoted_applications'] }}</span><br>
                                                        <span style="font-weight:bold">{{ $month['amount_quoted'] }}</span><br>
                                                        <span style="font-weight:bold">{{ $month['amount_quoted_average'] }}</span><br>
                                                        @else
                                                        <span style="font-weight:bold">
                                                            {{ $month['partner_quoted_applications_count'] - $month_list[$key-1]['partner_quoted_applications_count'] }}
                                                            or 
                                                            @if ($month['partner_quoted_applications_count'] > 0)
                                                            {{ $month_list[$key-1]['partner_quoted_applications_count'] /$month['partner_quoted_applications_count'] }}%                                                                
                                                            @else
                                                                0%
                                                            @endif
                                                        </span><br>
                                                        <span style="font-weight:bold">
                                                            {{ $month['avg_quoted_applications'] - $month_list[$key-1]['avg_quoted_applications'] }}
                                                            or 
                                                            @if ($month['avg_quoted_applications'] > 0)
                                                            {{ $month_list[$key-1]['avg_quoted_applications'] /$month['avg_quoted_applications'] }}%                                                                
                                                            @else
                                                                0%
                                                            @endif
                                                        </span><br>
                                                        <span style="font-weight:bold">
                                                            {{ $month['amount_quoted'] - $month_list[$key-1]['amount_quoted'] }}
                                                            or 
                                                            @if ($month['amount_quoted'] > 0)
                                                            {{ $month_list[$key-1]['amount_quoted'] /$month['amount_quoted'] }}%                                                                
                                                            @else
                                                                0%
                                                            @endif
                                                        </span><br>
                                                        <span style="font-weight:bold">
                                                            {{ $month['amount_quoted_average'] - $month_list[$key-1]['amount_quoted_average'] }}
                                                            or 
                                                            @if ($month['amount_quoted_average'] > 0)
                                                            {{ $month_list[$key-1]['amount_quoted_average'] /$month['amount_quoted_average'] }}%                                                                
                                                            @else
                                                                0%
                                                            @endif
                                                        </span><br>
                                                        @endif
                                                    </td>
                                                    <td style="border-right:none">
                                                        <span style="font-weight:bold">Leads: {{ $month['partner_disbursed_applications_count'] }}</span><br>
                                                        <span style="font-weight:bold">Of Leads: {{ $month['avg_disbursed_applications'] }}</span><br>
                                                        <span style="font-weight:bold">Amount disbursed: {{ $month['amount_disbursed'] }}</span><br>
                                                        <span style="font-weight:bold">Average disbursed: {{ $month['amount_disbursed_average'] }}</span><br>
                                                    </td>
                                                    <td style="border-left:none;text-align: center;">
                                                        @if($loop->first )
                                                        <span style="font-weight:bold">{{ $month['partner_disbursed_applications_count'] }}</span><br>
                                                        <span style="font-weight:bold">{{ $month['avg_disbursed_applications'] }}</span><br>
                                                        <span style="font-weight:bold">{{ $month['amount_disbursed'] }}</span><br>
                                                        <span style="font-weight:bold">{{ $month['amount_disbursed_average'] }}</span><br>
                                                        @else
                                                        <span style="font-weight:bold">
                                                            {{ $month['partner_disbursed_applications_count'] - $month_list[$key-1]['partner_disbursed_applications_count'] }}
                                                            or 
                                                            @if ($month['partner_disbursed_applications_count'] > 0)
                                                            {{ $month_list[$key-1]['partner_disbursed_applications_count'] /$month['partner_disbursed_applications_count'] }}%                                                                
                                                            @else
                                                                0%
                                                            @endif
                                                        </span><br>
                                                        <span style="font-weight:bold">
                                                            {{ $month['avg_disbursed_applications'] - $month_list[$key-1]['avg_disbursed_applications'] }}
                                                            or 
                                                            @if ($month['avg_disbursed_applications'] > 0)
                                                            {{ $month_list[$key-1]['avg_disbursed_applications'] /$month['avg_disbursed_applications'] }}%                                                                
                                                            @else
                                                                0%
                                                            @endif
                                                        </span><br>
                                                        <span style="font-weight:bold">
                                                            {{ $month['amount_disbursed'] - $month_list[$key-1]['amount_disbursed'] }}
                                                            or 
                                                            @if ($month['amount_disbursed'] > 0)
                                                            {{ $month_list[$key-1]['amount_disbursed'] /$month['amount_disbursed'] }}%                                                                
                                                            @else
                                                                0%
                                                            @endif
                                                        </span><br>
                                                        <span style="font-weight:bold">
                                                            {{ $month['amount_disbursed_average'] - $month_list[$key-1]['amount_disbursed_average'] }}
                                                            or 
                                                            @if ($month['amount_disbursed_average'] > 0)
                                                            {{ $month_list[$key-1]['amount_disbursed_average'] /$month['amount_disbursed_average'] }}%                                                                
                                                            @else
                                                                0%
                                                            @endif
                                                        </span><br>
                                                        @endif
                                                    </td>
                                                    <td>@if($month['amount_quoted'] != 0){{ ($month['amount_disbursed'] /$month['amount_quoted'])*100 }}% @endif</td>
                                                    <td>@if($month['partner_quoted_applications_count'] != 0){{ ($month['partner_disbursed_applications_count'] /$month['partner_quoted_applications_count'])*100 }}% @endif</td>
                                                </tr>
                                                @endforeach
                                            </tbody>                                            
                                        </table>
                                    </div>
                                {{-- </div> --}}

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
