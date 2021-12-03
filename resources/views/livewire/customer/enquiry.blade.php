<section>
    <div class="content-page">
        <div class="content">
            <div class="container-fluid">
                <div class="page-title-box">
                    <div class="row align-items-center ">
                        <div class="col-md-8">
                            <div class="page-title-box">
                                <h4 class="page-title">Enquiries</h4>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            @if ($profile == 1)
                            <div class="card-body">
                                <div class="table-rep-plugin">
                                    <div class="table-responsive b-0" data-pattern="priority-columns">
                                        <table id="tech-companies-1" class="table  table-striped">
                                            <thead>
                                                <tr>
                                                    <th>Enquiry ID</th>
                                                    <th>Enquiry Date</th>
                                                    <th>Loan type</th>
                                                    <th>Amount</th>
                                                    <th>Company name</th>
                                                    <th>Percentage shareholder</th>
                                                    <th>Shareholders</th>
                                                    <th>Incorporated for</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($getLoans as $item)
                                                <tr>
                                                    <td>{{ $item->enquiry_id }}</td>
                                                    <td>{{ $item->created_at }}</td>
                                                    <td>{{ $item->loan_type->sub_type }}</td>
                                                    <td>{{ $item->amount }}</td>
                                                    <td>{{ $item->loan_company_detail->company_name ?? " " }}</td>
                                                    <td>{{ $item->loan_company_detail->percentage_shareholder ?? "" }}</td>
                                                    <td>{{ $item->loan_company_detail->number_of_share_holder ?? ""}}</td>
                                                    <td>
                                                        @php
                                                            $start_date = explode('/',$application->loan_company_detail->company_start_date ?? '');
                                                        @endphp
                                                        {{$start_date[0] ?? '0' }} years , {{$start_date[1] ?? '0'}} months ago
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    {{$getLoans->links('pagination::bootstrap-4')}}
                                </div>
                            </div>


                                @elseif($profile == 2)

                                <div class="card-body">
                                    <div class="table-rep-plugin">
                                        <div class="table-responsive b-0" data-pattern="priority-columns">
                                            <table id="tech-companies-1" class="table  table-striped">
                                                <thead>
                                                    <tr>
                                                        <th>Enquiry ID</th>
                                                        <th>Enquiry Date</th>
                                                        <th>Loan type</th>
                                                        <th>Amount</th>>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($getLoans as $item)
                                                    <tr>
                                                        <td>{{ $item->enquiry_id }}</td>
                                                        <td>{{ $item->created_at }}</td>
                                                        <td>{{ $item->loan_type->sub_type }}</td>
                                                        <td>{{ $item->amount }}</td>
                                                        
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    {{$getLoans->links('pagination::bootstrap-4')}}
                                    </div>
                                </div>

                            @endif


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>