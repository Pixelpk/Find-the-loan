@extends('admin.layouts.master')
@section('content')
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

                        <!-- <div class="col-md-4">
                            <div class="float-right d-none d-md-block">
                                <button onclick="resetFormFields()" type="button" id="add_loan_type_btn" data-toggle="modal" data-target="#LoanTypeModal" data-dismiss="modal" aria-label="Close" class="btn admin-btn"><i class="fa fa-plus-circle"></i></button>
                            </div>
                        </div>  -->
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
                                                <th data-priority="1">Main Type</th>
                                                <th data-priority="3">Sub Type</th>
                                                <th data-priority="1">Status</th>
                                                <th data-priority="3">Actions</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($items as $item)
                                                <tr>
                                                    <td>{{getProfile($item->profile)}}</td>
                                                    <td>{{$item->mainType ?  $item->mainType->main_type : ''}}</td>
                                                    <td>{{$item->sub_type}}</td>
                                                    <td>{{ getStatus($item->status) }}</td>
                                                    <td>
                                                        <!-- <a class="icons-td" href="{{ route('loan-subtypes',['id'=>$item->id]) }}" data-original-title="Sub types">
                                                            <i class="m-2 fa fa-eye" aria-hidden="true"></i>
                                                        </a> -->
                                                        <a href="#" onclick="getLoanTypeDetail({{$item->id}}); getLoanMainType({{ $item->profile }},{{ $item->id }})" class=" edit_loan_type_btn icons-td" data-toggle="tooltip" data-original-title="Edit">
                                                            <i class="m-2 fa fa-edit" aria-hidden="true"></i>
                                                        </a>
                                                        <!-- @if($item->status == 0)
                                                            <a href="{{ route('loan-type-status',['id'=>$item->id,'status'=>'1']) }}" msg="Are you sure to activate this loanType?" class=" change_status icons-td" data-toggle="tooltip" data-original-title="Activate">
                                                                <i class="m-2 fa fa-thumbs-up"></i>
                                                            </a>
                                                        @elseif($item->status == 1)
                                                            <a href="{{ route('loan-type-status',['id'=>$item->id,'status'=>'0']) }}" msg="Are you sure to deactivate this loanType?" class="  change_status icons-td" data-toggle="tooltip" data-original-title="Deactivate">
                                                                <i class="m-2 fa fa-thumbs-down"></i>
                                                            </a>
                                                        @endif -->
                                                        <!-- <a href="{{ route('loan-type-status',['id'=>$item->id,'status'=>'2']) }}" msg="Are you sure to delete this loanType?" class=" change_status icons-td" data-toggle="tooltip" data-original-title="Delete">
                                                            <i class="m-2 fa fa-trash"></i>
                                                        </a> -->
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
        function resetFormFields(){
            $('#loan_type_modal_heading').html('Add Loan Type');
            $('#loan_type_modal_btn').html("Add");
            document.getElementById("loan-type-form").reset();
            $("#update_loan_type_id").val('');
        }

        function getLoanTypeDetail(id) {
            $('#loan_type_modal_heading').html('Update Loan Type');
            $('#loan_type_modal_btn').html("Update");
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
                    $('#update_loan_type_id').val(detail.id);
                    $("#profile").val(detail.profile);
                    $("#sub_type").val(detail.sub_type);

                    $('#LoanTypeModal').modal('toggle');
                    $('#LoanTypeModal').modal('show');
                } else {
                    alert(data.message);
                }
            });
        }
     
        function getLoanMainType(main_type, id) {
            
            if(main_type){
                var main_type = main_type
                var loan_type_id = id;
            }else{
                loan_type_id =0;
                var main_type = document.getElementById("profile").value;
            }
            $.ajax({
                method: "GET",
                url: "{{ route('get-main-type', '') }}"+"/"+main_type + '?loan_type_id='+loan_type_id,
                success : function(data){
                $('#main_type').html(data); 
                }
            })
        }
    </script>
@endsection

