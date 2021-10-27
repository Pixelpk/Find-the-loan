@extends('admin.layouts.master')
@section('content')
<div class="content-page">

    <div class="content">

        <div class="container-fluid">
            <div class="page-title-box">

                <div class="row align-items-center ">
                    <div class="col-md-8">
                        <div class="page-title-box">
                            <h4 class="page-title">Company structure type</h4>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="float-right d-none d-md-block">
                            <button onclick="resetFormFields()" type="button" id="add_company_structure_btn"
                                data-toggle="modal" data-target="#CompanyStructureModal" data-dismiss="modal"
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
                                                <th data-priority="3">Type</th>
                                                <th data-priority="1">Status</th>
                                                <th data-priority="3">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($items as $item)
                                            <tr>
                                                <td>{{$item->structure_type}}</td>
                                                <td>{{ getStatus($item->status) }}</td>
                                                <td>
                                                    <a href="#" onclick="getCompanyStructureDetail({{$item->id}})"
                                                        class="icons-td edit_company_structure_btn"
                                                        data-toggle="tooltip" data-original-title="Edit">
                                                        <i class="m-2 fa fa-edit" aria-hidden="true"></i>
                                                    </a>
                                                    @if($item->status == 0)
                                                    <a href="{{ route('company-structure-status',['id'=>$item->id,'status'=>'1']) }}"
                                                        msg="Are you sure to activate this company structure type?"
                                                        class="icons-td change_status" data-toggle="tooltip"
                                                        data-original-title="Activate">
                                                        <i class="m-2 fa fa-thumbs-up"></i>
                                                    </a>
                                                    @elseif($item->status == 1)
                                                    <a href="{{ route('company-structure-status',['id'=>$item->id,'status'=>'0']) }}"
                                                        msg="Are you sure to deactivate this company structure type?"
                                                        class="icons-td  change_status" data-toggle="tooltip"
                                                        data-original-title="Deactivate">
                                                        <i class="m-2 fa fa-thumbs-down"></i>
                                                    </a>
                                                    @endif
                                                    <a href="{{ route('company-structure-status',['id'=>$item->id,'status'=>'2']) }}"
                                                        msg="Are you sure to delete this company structure type?"
                                                        class="icons-td change_status" data-toggle="tooltip"
                                                        data-original-title="Delete">
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
function resetFormFields() {
    document.getElementById("company-structure-form").reset();
    $('#company_structure_modal_heading').html('Add company structure type');
    $('#company_structure_modal_btn').html("Add");
    $("#update_company_structure_id").val('');
}

function getCompanyStructureDetail(id) {
    $('#company_structure_modal_heading').html('Update company structure type');
    $('#company_structure_modal_btn').html("Update");

    $.ajax({
        method: "POST",
        url: "{{ route('company-structure-detail') }}",
        data: {
            '_token': '{{ csrf_token() }}',
            id: id,
        }
    }).done(function(data) {
        let detail = data.data.structure_type;
        console.log(data)
        console.log(detail)
        if (data.success === 1) {
            $('#update_company_structure_id').val(detail.id);
            $("#structure_type").val(detail.structure_type);

            $('#CompanyStructureModal').modal('toggle');
            $('#CompanyStructureModal').modal('show');
        } else {
            alert(data.message);
        }
    });
}
</script>
@endsection