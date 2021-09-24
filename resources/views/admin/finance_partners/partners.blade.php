@extends('admin.layouts.master')
@section('content')
    <div class="content-page">

        <div class="content">

            <div class="container-fluid">
                <div class="page-title-box">

                    <div class="row align-items-center ">
                        <div class="col-md-8">
                            <div class="page-title-box">
                                <h4 class="page-title">Finance partners</h4>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="float-right d-none d-md-block">
                                <button onclick="resetFormFields()" type="button" id="add_partner_btn" data-toggle="modal" data-target="#FinancePartnerModal" data-dismiss="modal" aria-label="Close" class="btn btn-primary "><i class="fa fa-plus-circle"></i></button>
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
                                                <th data-priority="1">Image</th>
                                                <th data-priority="3">Name</th>
                                                <th data-priority="3">Email</th>
                                                <th data-priority="3">Phone</th>
                                                <th data-priority="1">Status</th>
                                                <th data-priority="3">Actions</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($items as $item)
                                                <tr>
                                                    <td>
                                                        @if (file_exists(public_path('uploads/financePartnerImages/'.$item->image)) && $item->image != '')
                                                            <img class="justify-content-center resize-img"
                                                                 src="{{ asset('uploads/financePartnerImages/'.$item->image) }}"/>
                                                        @else
                                                            <img class="justify-content-center resize-img"
                                                                 src="{{asset('assets/images/no_image.png')}}"/>
                                                        @endif
                                                    </td>
                                                    <td>{{$item->name}}</td>
                                                    <td>{{$item->email}}</td>
                                                    <td>{{$item->phone}}</td>
                                                    <td>{{ getStatus($item->status) }}</td>
                                                    <td>
                                                        <a href="#" onclick="getFinancePartnerDetail({{$item->id}})" class="edit_partner_btn" data-toggle="tooltip" data-original-title="Edit">
                                                            <i class="m-2 fa fa-edit" aria-hidden="true"></i>
                                                        </a>
                                                        @if($item->status == 0)
                                                            <a href="{{ route('change-partner-status',['id'=>$item->id,'status'=>'1']) }}" msg="Are you sure to activate this partner?" class=" change_status" data-toggle="tooltip" data-original-title="Activate">
                                                                <i class="m-2 fa fa-thumbs-up"></i>
                                                            </a>
                                                        @elseif($item->status == 1)
                                                            <a href="{{ route('change-partner-status',['id'=>$item->id,'status'=>'0']) }}" msg="Are you sure to deactivate this partner?" class="  change_status" data-toggle="tooltip" data-original-title="Deactivate">
                                                                <i class="m-2 fa fa-thumbs-down"></i>
                                                            </a>
                                                        @endif
                                                        <a href="{{ route('change-partner-status',['id'=>$item->id,'status'=>'2']) }}" msg="Are you sure to delete this partner?" class=" change_status" data-toggle="tooltip" data-original-title="Delete">
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
            document.getElementById("partner-form").reset();
            $('#partner_modal_heading').html('Add Finance partner');
            $('#partner_modal_btn').html("Add");
            $('#update_partner_id').val('');
            $("#partner_image").attr("src", "{{ asset('assets/images/no_image.png') }}");
        }
        function getFinancePartnerDetail(id) {
            $('#partner_modal_heading').html('Update Finance partner');
            $('#partner_modal_btn').html("Update");
            $.ajax({
                method: "POST",
                url: "{{ route('partner-detail') }}",
                data: {
                    '_token': '{{ csrf_token() }}',
                    id: id,
                }
            }).done(function (data) {
                let detail = data.data.partner;
                console.log(data)
                console.log(detail)
                if (data.success === 1) {
                    $('#update_partner_id').val(detail.id);
                    $("#edit_partner_type").val(detail.type);
                    $("#edit_partner_password").val('');
                    $("#edit_partner_name").val(detail.name);
                    $("#edit_partner_phone").val(detail.phone);
                    $("#edit_min_quantum").val(detail.min_quantum);
                    $("#edit_max_quantum").val(detail.max_quantum);
                    $("#edit_partner_company_structure").val(detail.company_structure_id);
                    $("#edit_partner_loan_type").val(detail.loan_type_id);
                    $("#edit_length_of_incorporation").val(detail.length_of_incorporation);
                    $("#edit_local_shareholding").val(detail.local_shareholding);
                    $("#edit_subsidiaries").val(detail.subsidiaries);
                    CKEDITOR.instances['edit_partner_terms_condition'].setData(detail.terms_condition);
                    if (detail.image != "") {
                        var imgsrc = detail.image;
                        var src = "{{ url('uploads/financePartnerImages/') }}" + "/" + imgsrc;
                        console.log(src)
                        $('#edit_partner_image').attr("src", src);
                    }

                    $('#EditFinancePartnerModal').modal('toggle');
                    $('#EditFinancePartnerModal').modal('show');
                } else {
                    alert(data.message);
                }
            });
        }
    </script>
@endsection

