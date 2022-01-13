@extends('admin.layouts.master')
@section('content')
    <div class="content-page">

        <div class="content">

            <div class="container-fluid">
                <div class="page-title-box">

                    <div class="row align-items-center ">
                        <div class="col-md-8">
                            <div class="page-title-box">
                                <h4 class="page-title">All Glossaries</h4>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="float-right d-none d-md-block">
                                <button onclick="resetFormFields()" type="button" id="add_glossary_btn" data-toggle="modal" data-target="#GlossaryModal" data-dismiss="modal" aria-label="Close" class="btn admin-btn "><i class="fa fa-plus-circle"></i></button>
                            </div>
                            {{-- <div class="float-right mr-2 d-none d-md-block">
                                <button type="button" id="sort_faq" data-toggle="modal" data-target="#sortGlossaryModal" data-dismiss="modal" aria-label="Close" class="btn admin-btn ">Sort</button>
                            </div> --}}
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
                                                <th data-priority="1">Title</th>
                                                <th data-priority="3">Description</th>
                                                {{-- <th data-priority="1">Status</th> --}}
                                                <th data-priority="3">Actions</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($items as $item)
                                            <tr>
                                                <td>{{$item->title}}</td>
                                                <td>{!! $item->description !!}</td>
                                                <td>{{ getStatus($item->status) }}</td>
                                                <td>
                                                    <a href="#" onclick="getGlossaryDetail({{$item->id}})" class=" edit_glossary_btn icons-td" data-toggle="tooltip" data-original-title="Edit">
                                                        <i class="m-2 fa fa-edit" aria-hidden="true"></i>
                                                    </a>
                                                    @if($item->status == 0)
                                                        <a href="{{ route('change-glossary-status',['id'=>$item->id,'status'=>'1']) }}" msg="Are you sure to activate this glossary?" class=" change_status icons-td" data-toggle="tooltip" data-original-title="Activate">
                                                            <i class="m-2 fa fa-thumbs-up"></i>
                                                        </a>
                                                    @elseif($item->status == 1)
                                                        <a href="{{ route('change-glossary-status',['id'=>$item->id,'status'=>'0']) }}" msg="Are you sure to deactivate this glossary?" class="  change_status icons-td" data-toggle="tooltip" data-original-title="Deactivate">
                                                            <i class="m-2 fa fa-thumbs-down"></i>
                                                        </a>
                                                    @endif
                                                    <a href="{{ route('change-glossary-status',['id'=>$item->id,'status'=>'2']) }}" msg="Are you sure to delete this glossary?" class=" change_status icons-td" data-toggle="tooltip" data-original-title="Delete">
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
        function resetFormFields(){
            document.getElementById("glossary-form").reset();
            $('#glossary_modal_heading').html('Add Glossary');
            $('#glossary_modal_btn').html("Add");
            $('#update_glossary_id').val('');
            $("#glossary_image").attr("src", "{{ asset('assets/images/no_image.png') }}");
        }

        function getGlossaryDetail(id) {
            $('#glossary_modal_heading').html('Update Glossary');
            $('#glossary_modal_btn').html("Update");
            $.ajax({
                method: "POST",
                url: "{{ route('glossary-detail') }}",
                data: {
                    '_token': '{{ csrf_token() }}',
                    id: id,
                }
            }).done(function (data) {
                let detail = data.data.glossary;
                console.log(data)
                console.log(detail)
                if (data.success === 1) {
                    $('#update_glossary_id').val(detail.id);
                    $("#glossary_title").val(detail.title);
                    CKEDITOR.instances['glossary_description'].setData(detail.description);

                    $('#GlossaryModal').modal('toggle');
                    $('#GlossaryModal').modal('show');
                } else {
                    alert(data.message);
                }
            });
        }
    </script>
@endsection

