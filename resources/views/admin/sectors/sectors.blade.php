@extends('admin.layouts.master')
@section('content')
    <div class="content-page">

        <div class="content">

            <div class="container-fluid">
                <div class="page-title-box">

                    <div class="row align-items-center ">
                        <div class="col-md-8">
                            <div class="page-title-box">
                                <h4 class="page-title">Sectors</h4>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="float-right d-none d-md-block">
                                <button onclick="resetFormFields()" type="button" id="add_sector_btn" data-toggle="modal" data-target="#SectorModal" data-dismiss="modal" aria-label="Close" class="btn btn-primary "><i class="fa fa-plus-circle"></i></button>
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
                                                <th data-priority="3">Name</th>
                                                <th data-priority="1">Status</th>
                                                <th data-priority="3">Actions</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($items as $item)
                                                <tr>
                                                    <td>{{$item->name}}</td>
                                                    <td>{{ getStatus($item->status) }}</td>
                                                    <td>
                                                        <a href="#" onclick="getSectorDetail({{$item->id}})" class=" edit_sector_btn" data-toggle="tooltip" data-original-title="Edit">
                                                            <i class="m-2 fa fa-edit" aria-hidden="true"></i>
                                                        </a>
                                                        @if($item->status == 0)
                                                            <a href="{{ route('sector-status',['id'=>$item->id,'status'=>'1']) }}" msg="Are you sure to activate this csector?" class=" change_status" data-toggle="tooltip" data-original-title="Activate">
                                                                <i class="m-2 fa fa-thumbs-up"></i>
                                                            </a>
                                                        @elseif($item->status == 1)
                                                            <a href="{{ route('sector-status',['id'=>$item->id,'status'=>'0']) }}" msg="Are you sure to deactivate this sector?" class="  change_status" data-toggle="tooltip" data-original-title="Deactivate">
                                                                <i class="m-2 fa fa-thumbs-down"></i>
                                                            </a>
                                                        @endif
                                                        <a href="{{ route('sector-status',['id'=>$item->id,'status'=>'2']) }}" msg="Are you sure to delete this sector?" class=" change_status" data-toggle="tooltip" data-original-title="Delete">
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
            document.getElementById("sector-form").reset();
            $('#sector_modal_heading').html('Add sector');
            $('#sector_modal_btn').html("Add");
            $("#update_sector_id").val('');
        }
        function getSectorDetail(id) {
            $('#sector_modal_heading').html('Update sector');
            $('#sector_modal_btn').html("Update");

            $.ajax({
                method: "POST",
                url: "{{ route('sector-detail') }}",
                data: {
                    '_token': '{{ csrf_token() }}',
                    id: id,
                }
            }).done(function (data) {
                let detail = data.data.sector;
                console.log(data)
                console.log(detail)
                if (data.success === 1) {
                    $('#update_sector_id').val(detail.id);
                    $("#sector_name").val(detail.name);

                    $('#SectorModal').modal('toggle');
                    $('#SectorModal').modal('show');
                } else {
                    alert(data.message);
                }
            });
        }
    </script>
@endsection

