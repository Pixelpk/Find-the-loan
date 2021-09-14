@extends('admin.layouts.master')
@section('content')
    <div class="content-page">

        <div class="content">

            <div class="container-fluid">
                <div class="page-title-box">

                    <div class="row align-items-center ">
                        <div class="col-md-8">
                            <div class="page-title-box">
                                <h4 class="page-title">Testimonials</h4>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="float-right d-none d-md-block">
                                <button onclick="resetFormFields()" type="button" id="add_testimonial_btn" data-toggle="modal" data-target="#TestimonialModal" data-dismiss="modal" aria-label="Close" class="btn btn-primary "><i class="fa fa-plus-circle"></i></button>
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
                                                <th data-priority="1">Reviewer Images</th>
                                                <th data-priority="3">Review By</th>
                                                <th data-priority="3">Review</th>
                                                <th data-priority="1">Status</th>
                                                <th data-priority="3">Actions</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($items as $item)
                                                <tr>
                                                    <td>
                                                        @if (file_exists(base_path('uploads/testimonialImages/'.$item->reviewer_image)) && $item->reviewer_image != '')
                                                            <img class="justify-content-center resize-img"
                                                                 src="{{ url('uploads/testimonialImages/'.$item->reviewer_image) }}"/>
                                                        @else
                                                            <img class="justify-content-center resize-img"
                                                                 src="{{url('assets/images/no_image.png')}}"/>
                                                        @endif
                                                    </td>
                                                    <td>{{$item->review_by}}</td>
                                                    <td>{!! $item->review !!}</td>
                                                    {{--                                                    <td>{!! $item->description !!}</td>--}}
                                                    <td>{{ getStatus($item->status) }}</td>
                                                    <td>
                                                        <a href="#" onclick="getTestimonialDetail({{$item->id}})" class="edit_testimonial_btn" data-toggle="tooltip" data-original-title="Edit">
                                                            <i class="m-2 fa fa-edit" aria-hidden="true"></i>
                                                        </a>
                                                        @if($item->status == 0)
                                                            <a href="{{ route('change-testimonial-status',['id'=>$item->id,'status'=>'1']) }}" msg="Are you sure to activate this testimonial?" class=" change_status" data-toggle="tooltip" data-original-title="Activate">
                                                                <i class="m-2 fa fa-thumbs-up"></i>
                                                            </a>
                                                        @elseif($item->status == 1)
                                                            <a href="{{ route('change-testimonial-status',['id'=>$item->id,'status'=>'0']) }}" msg="Are you sure to deactivate this testimonial?" class="  change_status" data-toggle="tooltip" data-original-title="Deactivate">
                                                                <i class="m-2 fa fa-thumbs-down"></i>
                                                            </a>
                                                        @endif
                                                        <a href="{{ route('change-testimonial-status',['id'=>$item->id,'status'=>'2']) }}" msg="Are you sure to delete this testimonial?" class=" change_status" data-toggle="tooltip" data-original-title="Delete">
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
            document.getElementById("testimonial-form").reset();
            $('#testimonial_modal_heading').html('Add testimonial');
            $('#testimonial_modal_btn').html("Add");
            $('#update_testimonial_id').val('');
            $("#testimonial_image").attr("src", "{{ asset('assets/images/no_image.png') }}");
        }
        function getTestimonialDetail(id) {
            $('#testimonial_modal_heading').html('Update testimonial');
            $('#testimonial_modal_btn').html("Update");
            $.ajax({
                method: "POST",
                url: "{{ route('testimonial-detail') }}",
                data: {
                    '_token': '{{ csrf_token() }}',
                    id: id,
                }
            }).done(function (data) {
                let detail = data.data.testimonial;
                console.log(data)
                console.log(detail)
                if (data.success === 1) {
                    $('#update_testimonial_id').val(detail.id);
                    $("#review_by").val(detail.review_by);
                    $('#review').val(detail.review);
                    // CKEDITOR.instances['review'].setData(detail.review);
                    if (detail.reviewer_image != "") {
                        var imgsrc = detail.reviewer_image;
                        var src = "{{ url('uploads/testimonialImages/') }}" + "/" + imgsrc;
                        console.log(src)
                        $('#reviewer_image').attr("src", src);
                    }

                    document.querySelector('#reviewer-image-file').required = false;
                    $('#TestimonialModal').modal('toggle');
                    $('#TestimonialModal').modal('show');
                } else {
                    alert(data.message);
                }
            });
        }
    </script>
@endsection

