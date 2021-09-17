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
                    <a href="{{ route('applyLoan', ['profile' => $i]); }}" style="width: 90%;"
                        class="btn btn-light">{{ getProfile($i) }}</a>
            </div>
            @endfor
        </div>
    </div>
    @endif
    @if(request()->get('profile') == 1)
    <div class="row">
        <div class="col-md-12" style="text-align: center">
            <b style="font-size: 20px;">Please select the loan type you are looking at</b>
        </div>
        @foreach($mainTypes as $item)
        <div class="col-md-3" style="padding-top:30px;">
            <div class="list-group">
                <a href="#" class="list-group-item list-group-item-action active">
                    {{ $item->main_type }}
                </a>
                
                @foreach($item->subTypes as $subType)
               
                <a  class="list-group-item list-group-item-action">
                    <div class="form-check form-switch">
                        <input value="{{ $subType->id }}" class="form-check-input" type="checkbox" id="{{ $subType->id }}" />
                        <label class="form-check-label" for="{{ $subType->id }}"
                          >{{ $subType->sub_type }}</label
                        >
                      </div>
                </a>
                @endforeach
            </div>
        </div>
        @endforeach
    </div>
    @else
    <div style="padding: 15px;" class="card">
        <div class="row" style="padding: 15px;">
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                            <label class="form-check-label" for="flexCheckDefault">
                                This is a listed company
                            </label>
                        </div>
                    </div>
                    <div class="col-md-12" style="margin-top:30px;">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="">How long has the company</span>
                            </div>
                            <input placeholder="Year" type="number" class="form-control">
                            <input placeholder="Month" type="number" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-12" style="margin-top:30px;">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="">Number of shareholder including parent
                                    company if any</span>
                            </div>
                            <input type="number" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-12" style="margin-top:30px;">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="">Sector</span>
                            </div>
                            <input type="text" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-12" style="margin-top:30px;">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="">Revenue (rounded up is fine)</span>
                            </div>
                            <input type="number" class="form-control" placeholder="$">
                            <input type="number" class="form-control" placeholder="$">
                        </div>
                    </div>

                </div>
            </div>
            <div class="col-md-6">
                <div class="row" style="margin-top: 20px;">
                    <div class="col-md-12" style="margin-top:30px;">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="">% of local shareholding</span>
                            </div>
                            <input placeholder="%" max="100" type="number" class="form-control">

                        </div>
                    </div>
                    <div class="col-md-12" style="margin-top:30px;">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="">Company structure type</span>
                            </div>
                            <input type="text" class="form-control">

                        </div>
                    </div>
                    <div class="col-md-12" style="margin-top:30px;">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="">Number of full-time employee</span>
                            </div>
                            <input type="number" class="form-control">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    @endif
    </div>
</section>
<script>
    $(document).on('click', 'input[type="checkbox"]', function() {      
    $('input[type="checkbox"]').not(this).prop('checked', false);      
    });
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
