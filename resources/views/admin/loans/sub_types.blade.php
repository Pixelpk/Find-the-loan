@extends('admin.layouts.master')
@section('content')
    <div class="content-page">

        <div class="content">

            <div class="container-fluid">
                <div class="page-title-box">

                    <div class="row align-items-center ">
                        <div class="col-md-8">
                            <div class="page-title-box">
                                <h4 class="page-title">{{ $loan_type_name }} sub types</h4>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="float-right d-none d-md-block">
                                <button onclick="resetFormFields()" type="button" id="add_loan_subtype_btn" data-toggle="modal" data-target="#LoanSubTypeModal" data-dismiss="modal" aria-label="Close" class="btn admin-btn"><i class="fa fa-plus-circle"></i></button>
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
                                                <th data-priority="3">Type name</th>
                                                <th data-priority="1">Status</th>
                                                <th data-priority="3">Actions</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($items as $item)
                                                <tr>
                                                    <td>{{$item->type_name}}</td>
                                                    <td>{{ getStatus($item->status) }}</td>
                                                    <td>
                                                        <a href="#" onclick="getLoanTypeDetail({{$item->id}})" class="icons-td edit_loan_subtype_btn" data-toggle="tooltip" data-original-title="Edit">
                                                            <i class="m-2 fa fa-edit" aria-hidden="true"></i>
                                                        </a>
                                                        @if($item->status == 0)
                                                            <a href="{{ route('loan-type-status',['id'=>$item->id,'status'=>'1']) }}" msg="Are you sure to activate this loanType?" class=" change_status icons-td" data-toggle="tooltip" data-original-title="Activate">
                                                                <i class="m-2 fa fa-thumbs-up"></i>
                                                            </a>
                                                        @elseif($item->status == 1)
                                                            <a href="{{ route('loan-type-status',['id'=>$item->id,'status'=>'0']) }}" msg="Are you sure to deactivate this loanType?" class="  change_status icons-td" data-toggle="tooltip" data-original-title="Deactivate">
                                                                <i class="m-2 fa fa-thumbs-down"></i>
                                                            </a>
                                                        @endif
                                                        <a href="{{ route('loan-type-status',['id'=>$item->id,'status'=>'2']) }}" msg="Are you sure to delete this loanType?" class=" change_status icons-td" data-toggle="tooltip" data-original-title="Delete">
                                                            <i class="m-2 fa fa-trash"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    {{ $items->links() }}
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
        function resetFormFields(){
            $('#loan_subtype_modal_heading').html('Add Loan subType');
            $('#loan_subtype_modal_btn').html("Add");
            document.getElementById("loan-subtype-form").reset();
            $("#update_loan_subtype_id").val('');
        }

        function getLoanTypeDetail(id) {
            $('#loan_subtype_modal_heading').html('Update Loan subType');
            $('#loan_subtype_modal_btn').html("Update");
            $.ajax({
                method: "POST",
                url: "{{ route('loan-type-detail') }}",
                data: {
                    '_token': '{{ csrf_token() }}',
                    id: id,
                }
            }).done(function (data) {
                let detail = data.data.loan_type;
                console.log(data)
                console.log(detail)
                if (data.success === 1) {
                    $('#update_loan_subtype_id').val(detail.id);
                    $("#loan_subtype_name").val(detail.type_name);

                    $('#LoanSubTypeModal').modal('toggle');
                    $('#LoanSubTypeModal').modal('show');
                } else {
                    alert(data.message);
                }
            });
        }
    </script>
@endsection

