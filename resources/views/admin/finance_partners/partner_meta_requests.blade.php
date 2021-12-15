@extends('admin.layouts.master')
@section('content')
    <div class="content-page">

        <div class="content">

            <div class="container-fluid">
                <div class="page-title-box">

                    <div class="row align-items-center ">
                        <div class="col-md-12">
                            <div class="page-title-box">
                                <h4 class="page-title">Partner Requests</h4>
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
                                                <th data-priority="1">Requested details</th>
                                                <th data-priority="3">Actions</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($meta_requests as $item)
                                                <tr>
                                                    <td>{{$item->finance_partner->name}}</td>
                                                    <td>
                                                        @isset($item->requested_data['terms_condition'])
                                                            @if ($item->requested_data['terms_condition'] != "")
                                                            <b style="font-weight: 900">Terms & Conditions:</b>
                                                            {!! $item->requested_data['terms_condition'] !!}
                                                            @endif
                                                        @endisset
                                                        @isset($item->requested_data['promo'])
                                                            @if ($item->requested_data['promo'] != "")
                                                            <b style="font-weight: 900">Promo:</b>
                                                            {!! $item->requested_data['promo'] !!}
                                                            @endif
                                                        @endisset
                                                        @isset($item->requested_data['subsidy_features'])
                                                            @if ($item->requested_data['subsidy_features'] != "")
                                                            <b style="font-weight: 900">Subsidy & Features:</b>
                                                            {!! $item->requested_data['subsidy_features'] !!}
                                                            @endif
                                                        @endisset
                                                        @isset($item->requested_data['board_rate'])
                                                            @if ($item->requested_data['board_rate'] != "")
                                                            <b style="font-weight: 900">Board rate:</b><br>
                                                            @foreach ($item->requested_data['board_rate'] as $key=>$board_rate)
                                                                {{$board_rate['date']}} : {{$board_rate['rate']}}<br>
                                                            @endforeach
                                                            @endif
                                                        @endisset
                                                    </td>
                                                    <td>
                                                        <a href="{{ route('accept-meta-request',['id'=>$item->id,'status'=>'1']) }}" msg="Are you sure to approve this request?" class=" change_status icons-td" data-toggle="tooltip" data-original-title="Approve">
                                                            <i class="m-2 fa fa-thumbs-up"></i>
                                                        </a>
                                                        <a href="{{ route('accept-meta-request',['id'=>$item->id,'status'=>'0']) }}" msg="Are you sure to reject this request?" class="  change_status icons-td" data-toggle="tooltip" data-original-title="Reject">
                                                            <i class="m-2 fa fa-thumbs-down"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
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

