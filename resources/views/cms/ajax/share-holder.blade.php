
<form id="shareholderform" enctype="multipart/form-data" method="POST">
    @csrf
    @php $sr = 1; 
        $no =  $companyDetail->number_of_share_holder - 1
    @endphp; 
    @for ($x = 0; $x <= $no; $x++)
    <div style="padding: 15px;" class="card">
        <div class="row" style="padding: 15px;">
            <div class="col-md-12">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="companyCheck">
                    <label class="form-check-label" for="companyCheck">
                        Company
                    </label>
                </div>
            </div>
            <div class="col-md-12" style="padding-left: 0px;margin-top:30px;">
                <button class="btn btn-light">Share holder {{ $sr++ }}</button>
            </div>

            <div class="col-md-2" style="padding-left: 0px;margin-top:30px;">
                <b>NRIC</b>
            </div>
            <div class="col-md-1" style="padding-left: 0px;margin-top:20px;">
                <label for="">Front</label>
                <input style="font-size: 13px;" accept="image/png, image/jpeg,image/jpg" required id="image-input"
                    name="nric_front[{{ $x }}]" class="form-control form-control-sm" id="formFileSm" type="file" />
            </div>
            <div class="col-md-1" style="padding-left: 0px;margin-top:20px;">
                <label for="">Back</label>
                <input style="font-size: 13px;" accept="image/png, image/jpeg,image/jpg" required id="image-input"
                    name="nric_back[{{ $x }}]" class="form-control form-control-sm" id="formFileSm" type="file" />
            </div>
            <div class="col-md-2" style="padding-left: 0px;margin-top:30px;">
                <b>Personal NOA</b>
                <p>(Notice of Assessment) (2 Years)</p>
            </div>
            <div class="col-md-1" style="padding-left: 0px;margin-top:20px;">
                <label for="">Lastest</label>
                <input style="font-size: 13px;" accept="image/png, image/jpeg,image/jpg" required id="image-input"
                    name="nao_latest[{{ $x }}]" class="form-control form-control-sm" id="formFileSm" type="file" />
            </div>
            <div class="col-md-1" style="padding-left: 0px;margin-top:20px;">
                <label for="">Older</label>
                <input style="font-size: 13px;" accept="image/png, image/jpeg,image/jpg" required id="image-input"
                    name="nao_older[{{ $x }}]" class="form-control form-control-sm" id="formFileSm" type="file" />
            </div>
            <div class="col-md-1"></div>
            <div class="col-md-2" style="padding-left: 0px;margin-top:30px;">
                <b>CBS</b>
                <p>(Download within the last 30 days) Optional</p>
            </div>
            <div class="col-md-1" style="padding-left: 0px;margin-top:35px;">
                {{-- <label for="">Older</label> --}}
                <input style="font-size: 13px;" accept="image/png, image/jpeg,image/jpg" required id="image-input"
                    name="cbs[{{ $x }}]" class="form-control form-control-sm" id="formFileSm" type="file" />
            </div>

        </div>
    </div>
    @endfor
    <div class="row" style="margin-top: 30px;">
        <div class="col-md-3"></div>
        <div class="col-md-3">
            <button onclick="backToAmount()" class="btn btn-light">Previous</a>
        </div>
        <div class="col-md-3" style="text-align: right;">
            <button  class="btn btn-light">Next</button>
        </div>
        <div class="col-md-3"></div>
    </div>
</form>
<script>
    $('#shareholderform').submit(function (e) {
        e.preventDefault();
        // var profitable_before_year = document.getElementById('profitable_before_year').value
        // var revenuee = document.getElementById('revenuee').value
        let formData = new FormData(this);
        formData.append("apply_loan_id", 1);
        $('#image-input-error').text('');
        $.ajax({
            type: 'POST',
            url: "{{ route('loan-share-holder-store') }}",
            data: formData,
            contentType: false,
            processData: false,
            success: (response) => {
                if (response) {
                    showNotificationModal('Data add successfully','alert-success',"top","right");
                }
            },
            error: function (response) {
                showNotificationModal(response.responseJSON.nric_front[0],'alert-danger',"top","right");
                showNotificationModal(response.responseJSON.nric_back[0],'alert-danger',"top","right");
                showNotificationModal(response.responseJSON.nao_older[0],'alert-danger',"top","right");
                showNotificationModal(response.responseJSON.nao_latest[0],'alert-danger',"top","right");
                showNotificationModal(response.responseJSON.cbs[0],'alert-danger',"top","right");
            }
        });
    });

</script>

