<section>
    <div class="content-page">
        <div class="content">
            <div class="container-fluid">
                <div class="page-title-box">
                    <div class="row align-items-center ">
                        <div class="col-md-8">
                            <div class="page-title-box">
                                <h4 class="page-title">Loan types</h4>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="table-rep-plugin">
                                    <div class="table-responsive b-0" data-pattern="priority-columns">
                                        <table id="tech-companies-1" class="table  table-striped">
                                            <thead>
                                                <tr>
                                                    <th>Enquiry ID</th>
                                                    <th>Enquiry Date</th>
                                                    <th>Company name</th>
                                                    <th>Profitable latest year</th>
                                                    <th>Profitable year before</th>
                                                    <th>Incorporated for</th>
                                                    <th>Loan type</th>
                                                    <th>Assigned to</th>
                                                    <th>Date Assigned</th>
                                                    <th>Action Done</th>
                                                    <th>Market Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($getLoans as $item)
                                                <tr>
                                                    <td>{{ $item->enquiry_id }}</td>
                                                    {{-- <td>{{ $item->loan_type->profile == 1 ? 'Business' : 'Consumer' }}</td> --}}
                                                    <td>{{ $item->loan_type->sub_type }}</td>
                                                    <td>{{ $item->loan_company_detail->company_name ?? " " }}</td>
                                                    <td>{{ $item->loan_company_detail->percentage_shareholder }}</td>
                                                    <td>{{ $item->loan_company_detail->number_of_share_holder }}</td>
                                                    <td>{{ $item->amount }}</td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>