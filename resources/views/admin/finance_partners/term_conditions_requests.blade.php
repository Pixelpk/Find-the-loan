@extends('admin.layouts.master')
@section('content')
    <div class="content-page">

        <div class="content">

            <div class="container-fluid">
                <div class="page-title-box">

                    <div class="row align-items-center ">
                        <div class="col-md-12">
                            <div class="page-title-box">
                                <h4 class="page-title">Terms & Conditions approval requests</h4>
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
                                                <th data-priority="1">Finance Partner</th>
                                                <th data-priority="3">Terms & Conditions</th>
                                                <th data-priority="3">Actions</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($items as $item)
                                                <tr>
                                                    <td>{{$item->name}}</td>
                                                    <td>{!! $item->requested_terms_condition !!}</td>
                                                    <td>
                                                        <a href="{{ route('approve-request',['id'=>$item->id,'status'=>'1']) }}" msg="Are you sure to approve this request?" class=" change_status icons-td" data-toggle="tooltip" data-original-title="Approve">
                                                            <i class="m-2 fa fa-thumbs-up"></i>
                                                        </a>
                                                        <a href="{{ route('approve-request',['id'=>$item->id,'status'=>'0']) }}" msg="Are you sure to reject this request?" class="  change_status icons-td" data-toggle="tooltip" data-original-title="Reject">
                                                            <i class="m-2 fa fa-thumbs-down"></i>
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
            document.getElementById("faq-form").reset();
            $('#faq_modal_heading').html('Add Faq');
            $('#faq_modal_btn').html("Add");
            $('#update_faq_id').val('');
            $("#faq_image").attr("src", "{{ asset('assets/images/no_image.png') }}");
        }

        function getFaqDetail(id) {
            $('#faq_modal_heading').html('Update Faq');
            $('#faq_modal_btn').html("Update");
            $.ajax({
                method: "POST",
                url: "{{ route('faq-detail') }}",
                data: {
                    '_token': '{{ csrf_token() }}',
                    id: id,
                }
            }).done(function (data) {
                let detail = data.data.faq;
                console.log(data)
                console.log(detail)
                if (data.success === 1) {
                    $('#update_faq_id').val(detail.id);
                    $("#faq_question").val(detail.question);
                    $("#faq_answer").val(detail.answer);


                    $('#FaqModal').modal('toggle');
                    $('#FaqModal').modal('show');
                } else {
                    alert(data.message);
                }
            });
        }
    </script>
@endsection

