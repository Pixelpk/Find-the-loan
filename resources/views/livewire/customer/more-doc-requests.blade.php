<div>
    <section>
        <div class="content-page">
            <div class="content">
                <div class="container-fluid">
                    <div class="page-title-box">
                        <div class="row align-items-center ">
                            <div class="col-md-8">
                                <div class="page-title-box">
                                    <h4 class="page-title">Requests for More doc/info</h4>
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
                                            <table id="" class="table table-hover table-striped text-center">
                                                <thead>
                                                    <tr>
                                                        <th>Finance Partner</th>
                                                        <th>Enquiry ID</th>
                                                        <th>Profile</th>
                                                        <th>Loan type</th>
                                                        <th>Document</th>
                                                        <th>Reason</th>
                                                        <th>Amount</th>
                                                        <th>Reply</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($applications as $application)
                                                    <tr>
                                                        <td>{{ $application->finance_partner->name }}</td>
                                                        <td>{{ $application->loan_application->enquiry_id }}</td>
                                                        <td>{{ getProfile($application->loan_application->profile) }}</td>
                                                        <td>
                                                            {{ $application->loan_application->loan_type->sub_type }}
                                                        </td>

                                                    <td class="text-left">
                                                        @foreach ($application->more_doc_msg_desc as $item2)
                                                            {{ $item2->quote_additional_doc->info }}
                                                            <br>
                                                        @endforeach
                                                    </td>

                                                    <td class="text-left">
                                                        @foreach ($application->more_doc_msg_desc as $item2)
                                                            @foreach ($item2->more_doc_reasons as $reason)
                                                                {{ getMoreDocReason($reason) }}
                                                                <br>
                                                            @endforeach
                                                        @endforeach
                                                    </td>

                                                        <td>{{ $application->loan_application->amount }}</td>
                                                        <td><a style="font-size:8px;" href="{{ route('more-doc-request-details',['more_doc_request_id'=> $application->id]) }}" class="btn btn-primary">
                                                            Reply with doc
                                                        </a></td>
                                                    </tr>
    
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                        {{ $applications->links('pagination::bootstrap-4') }}
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
