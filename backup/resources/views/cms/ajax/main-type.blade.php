<div id="display">
<div class="row">
    @foreach($mainTypes as $item)
    <div class="col-md-3" style="padding-top:30px;">
        <div class="list-group">
            <a href="#" class="list-group-item list-group-item-action active">
                {{ $item->main_type }}
            </a>
            @foreach($item->subTypes as $subType)
            <a class="list-group-item list-group-item-action">
                <div class="form-check form-switch">

                    <input id="mychk{{ $subType->id }}" onchange="LoanTypeId({{ $subType->id }})" name="val"
                        value="{{ $subType->id }}" class="form-check-input singleCheck" type="checkbox" id="{{ $subType->id }}"
                        @if(request()->get('loanId') == $subType->id)
                    checked
                    @endif
                    />

                    <label class="form-check-label" for="{{ $subType->id }}">{{ $subType->sub_type }}</label>
                </div>
            </a>
            @endforeach
        </div>
    </div>
    @endforeach
    <input type="hidden" id="loanTypeId">
    <input type="hidden" id="statuscheck">
    <div class="col-md-12 text-center">
        <button class="btn btn-light" onclick="getLoanReason()">Next</button>
    </div>

</div>
</div>
<div id="showReason"></div>
<script>
    $(document).on('click', '.singleCheck', function() {
        $('.singleCheck').not(this).prop('checked', false);     
    });
    function LoanTypeId(id) {
        var mychk = document.getElementById("mychk" + id)
        var checked = mychk.checked
        document.getElementById('loanTypeId').value = id;
        document.getElementById('statuscheck').value = checked;
    }
    function getLoanReason() {
        var loan_type_id = document.getElementById('loanTypeId').value
        var checked = document.getElementById('statuscheck').value
        if (checked == 'true') {
            $.ajax({
                method: "POST",
                url: "{{ route('loan-reason') }}",
                data: {
                    '_token': '{{ csrf_token() }}',
                    id: loan_type_id,
                }
            }).done(function (data) {
                document.getElementById("display").style.display = "none";
                $('#showReason').html(data)

            });
        } else {
            Swal.fire('Please select loan type')
        }
    }

</script>
