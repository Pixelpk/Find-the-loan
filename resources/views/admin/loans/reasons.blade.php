@extends('admin.layouts.master')
@section('content')
<div class="content-page">

    <div class="content">
        <div class="container-fluid">
            <div class="page-title-box">
                <div class="row align-items-center ">
                    <div class="col-md-8">
                        <div class="page-title-box">
                            <h4 class="page-title">Loan reasons</h4>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="float-right d-none d-md-block">
                            <button onclick="resetFormFields()" type="button" id="add_loan_reason_btn"
                                data-toggle="modal" data-target="#LoanReasonModal" data-dismiss="modal"
                                aria-label="Close" class="btn admin-btn"><i class="fa fa-plus-circle"></i></button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end page-title -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-rep-plugin">
                                <div class="table-responsive b-0" data-pattern="priority-columns">
                                    <table id="tech-companies-1" class="table  table-striped">
                                        <thead>
                                            <tr>
                                                <th data-priority="1">Profile</th>
                                                <th data-priority="2">Loan Type</th>
                                                <th data-priority="3">Reason</th>
                                                <th data-priority="4">Status</th>
                                                <th data-priority="5">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($items as $item)
                                            <tr>
                                                <td>
                                                    @if($item->profile==1)
                                                    Business
                                                    @elseif($item->profile==2)
                                                    Consumer
                                                    @endif
                                                </td>
                                                <td>{{ $item->loanType ? $item->loanType->sub_type : '' }}</td>
                                                <td>{{$item->reason}}</td>
                                                <td>{{ getStatus($item->status) }}</td>
                                                <td>
                                                    <a href="#" onclick="getLoanReasonDetail({{$item->id}})"
                                                        class="icons-td edit_loan_reason_btn" data-toggle="tooltip"
                                                        data-original-title="Edit">
                                                        <i class="m-2 fa fa-edit" aria-hidden="true"></i>
                                                    </a>
                                                    @if($item->status == 0)
                                                    <a href="{{ route('loan-reason-status',['id'=>$item->id,'status'=>'1']) }}"
                                                        msg="Are you sure to activate this reason?"
                                                        class=" change_status icons-td" data-toggle="tooltip"
                                                        data-original-title="Activate">
                                                        <i class="m-2 fa fa-thumbs-up"></i>
                                                    </a>
                                                    @elseif($item->status == 1)
                                                    <a href="{{ route('loan-reason-status',['id'=>$item->id,'status'=>'0']) }}"
                                                        msg="Are you sure to deactivate this reason?"
                                                        class="  change_status icons-td" data-toggle="tooltip"
                                                        data-original-title="Deactivate">
                                                        <i class="m-2 fa fa-thumbs-down"></i>
                                                    </a>
                                                    @endif
                                                    <a href="{{ route('loan-reason-status',['id'=>$item->id,'status'=>'2']) }}"
                                                        msg="Are you sure to delete this reason?"
                                                        class=" change_status icons-td" data-toggle="tooltip"
                                                        data-original-title="Delete">
                                                        <i class="m-2 fa fa-trash"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                {{ $items->links('pagination::bootstrap-4') }}
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
<script>
function resetFormFields() {
    document.getElementById("loan-reason-form").reset();
    $('#loan_reason_modal_heading').html('Add Loan reason');
    $('#loan_reason_modal_btn').html("Add");
    $('#update_loan_reason_id').val('');
    $('#loanType').hide();
}

function getLoanReasonDetail(id) {
    $('#loan_reason_modal_heading').html('Update Loan reason');
    $('#loan_reason_modal_btn').html("Update");
    $.ajax({
        method: "POST",
        url: "{{ route('loan-reason-detail') }}",
        data: {
            '_token': '{{ csrf_token() }}',
            id: id,
        }
    }).done(function(data) {
        let detail = data.data.reason;
        console.log(data)
        console.log(detail)
        if (data.success === 1) {
            $('#update_loan_reason_id').val(detail.id);
            $("#loan_reason").val(detail.reason);
            if (detail.profile == 1) {
                $("#loanType").hide();
            } else {
                $("#loanType").show();
                getLoanType(detail.profile);
                $("#loan_main_type").val(detail.loan_type_id);
            }
            $("#loan_profile").val(detail.profile);

            $('#LoanReasonModal').modal('toggle');
            $('#LoanReasonModal').modal('show');
        } else {
            alert(data.message);
        }
    });
}

function getLoanType(profile) {
    $.ajax({
        method: "get",
        url: "{{ route('get-loan-types') }}",
        data: {
            '_token': '{{ csrf_token() }}',
            profile: profile,
        }
    }).done(function(data) {
        $('#loanType').html(data);
    });
}
</script>
@endsection