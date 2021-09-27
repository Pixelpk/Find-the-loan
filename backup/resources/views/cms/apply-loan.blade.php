@extends('cms.layouts.master')
@section('content')
@php
$main_types = loanProfile();
@endphp
<section class="section-white small-padding">
    <div class="container">
        <br>
        <br>
        <br>
        <br>
        @if(request()->get('profile') != 1)
        <div style="padding: 15px;" class="card">
            <div class="row">
                @for($i=1;$i<count($main_types);$i++) <div class="col-md-6">
                    <button onclick="getProfileData({{ $i }})" style="width: 90%;"
                        class="btn btn-light">{{ getProfile($i) }}</button>
            </div>
            @endfor
        </div>
    </div>
    @endif
    <input type="hidden" id="profile">
    <div id="mainTypeShow"></div>
    </div>
</section>
<script>
    function getProfileData(id) {
        $.ajax({
            method: "POST",
            url: "{{ route('get-loan-main-type') }}",
            data: {
                '_token': '{{ csrf_token() }}',
                id: id,
            }
        }).done(function (data) {
            document.getElementById("profile").value = id
            $('#mainTypeShow').html(data)
        });
    }

    function getLoanType(main_type, id) {
        if (main_type) {
            var loan_type_id = main_type
            var loan_reason_id = id;
        } else {
            loan_reason_id = 0;
            var loan_type_id = document.getElementById("loan_main_type").value;
        }
        $.ajax({
            method: "GET",
            url: "{{ route('get-loan-type', '') }}" + "/" + loan_type_id + '?loan_reason_id=' + loan_reason_id,
            success: function (data) {
                $('#loanType').html(data);
            }
        })
    }

</script>
@endsection
