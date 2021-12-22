<div>
    <section>
        <div class="content-page">
            <div class="content">
                <div class="container-fluid">
                    <div class="page-title-box">
                        <div class="row align-items-center ">
                            <div class="col-md-8">
                                <div class="page-title-box">
                                    <h4 class="page-title">Rejected enquiries</h4>
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
                                            <table id="loan_application_table" class="table table-hover table-striped text-center  w-100">
                                                <thead>
                                                <tr>
                                                    <th>Enquiry Id</th>
                                                    <th>Profile</th>
                                                    <th>Loan type</th>
                                                    <th>Amount</th>
                                                    <th>Finance partner</th>
                                                    <th>Reject reason</th>
                                                    <th>Other reasons</th>
                                                    <th>Reject date</th>
                                                
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($reject_enquiries as $application)
                                                    <tr class="">
                                                        <td>{{ $application->loan_application->enquiry_id }}</td>
                                                        <td>{{ getProfile($application->loan_application->profile) }}</td>
                                                        <td>{{ $application->loan_application->loan_type->sub_type }}</td>
                                                        <td>{{ $application->loan_application->amount }}</td>
                                                        <td>{{ $application->reject_finance_partner->name }}</td>
                                                        <td>{{ $application->customer_reject_reason->reason }}</td>
                                                        <td>{{ $application->other_reasons }}</td>
                                                        <td>{{ $application->created_at }}</td>
                                                       
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                        {{ $reject_enquiries->links('pagination::bootstrap-4') }}
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
