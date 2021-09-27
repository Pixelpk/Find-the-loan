@extends('cms.layouts.master')
@section('content')

<section class="section-white small-padding">
    <div class="container">
        <br>
        <br>
        <br>
        <br>
        <div id="loanForm">
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
                            {{-- <div class="col-md-12" style="margin-top:30px;">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="">How long has the company</span>
                                    </div>
                                    <input id="company_year" placeholder="Year" type="number" class="form-control">
                                    <input id="company_month" placeholder="Month" type="number" class="form-control">
                                </div>
                                <span class="customspan" id="companyVali"></span>
                            </div> --}}
                            {{-- <div class="col-md-12" style="margin-top:30px;">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="">Number of shareholder including parent
                                            company if any</span>
                                    </div>
                                    <input id="number_of_share_holder" type="number" class="form-control">
                                </div>
                                <span class="customspan" id="number_of_share_holderVali"></span>
                            </div> --}}
                            <div class="col-md-12" style="margin-top:30px;">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" >Sector</span>
                                    </div>
                                    <select name="" id="sector" class="form-control" style="width: 100%;">
                                        <option value="" hidden>Select</option>
                                        @foreach($sector as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                    {{-- <input id="sector" type="text" class="form-control"> --}}
                                </div>
                                <span class="customspan" id="sectorVali"></span>
                            </div>
                            <div class="col-md-12" style="margin-top:30px;">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="">Revenue (rounded up is fine)</span>
                                    </div>
                                    <input id="revenue_amount1" type="number" class="form-control" placeholder="$">
                                    <input id="revenue_amount2" type="number" class="form-control" placeholder="$">
                                </div>
                                <span class="customspan" id="revenue_amountVali"></span>
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
                                    <input id="percentage_shareholder" placeholder="%" max="100" type="number"
                                        class="form-control">
                                </div>
                                <span class="customspan" id="percentage_shareholderVali"></span>
                            </div>
                            <div class="col-md-12" style="margin-top:30px;">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="">Company structure type</span>
                                    </div>
                                    <select name="" id="company_structure_type" class="form-control">
                                        <option value="" hidden>Select</option>
                                        @foreach($company_structure as $item)
                                        <option value="{{ $item->id }}">{{ $item->structure_type }}</option>
                                        @endforeach
                                    </select>
                                    {{-- <input id="company_structure_type" type="text" class="form-control"> --}}
        
                                </div>
                                <span class="customspan" id="company_structure_typeVali"></span>
                            </div>
                            <div class="col-md-12" style="margin-top:30px;">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="">Number of full-time employee</span>
                                    </div>
                                    <input id="number_of_employees" type="number" class="form-control">
                                  
                                </div>
                                <span class="customspan" id="number_of_employeesVali"></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row" style="margin-top: 30px;">
                <div class="col-md-3"></div>
                <div class="col-md-3">
                    <button onclick="backToAmount()" class="btn btn-light">Previous</a>
                </div>
                <div class="col-md-3" style="text-align: right;">
                    <button onclick="goToCompanyDocuments()" class="btn btn-light">Next</button>
                </div>
                <div class="col-md-3"></div>
            </div>
        </div>
        <div id="goToCompanyDocument" style="display: none;">
            <form id="bankStatment" enctype="multipart/form-data" method="POST">
            @csrf
                <div style="padding: 15px;" class="card">
                    <div class="row" style="padding: 15px;">
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-12" style="margin-top:30px;">
                                    <b>6 months bank latest statement</b><br>
                                    <p style="">if it's on or over the 8th of the current Month for example 9th Jan, You Would Need
                                        To Submit Dec And Not Now As The Latest Months</p>
                                </div>
                                <div class="col-md-12" style="margin-top:30px;">
                                    <b>Add another corporate account's statement or in another currency</b><br>
                                </div>
                                <div class="col-md-12" style="margin-top:30px;">
                                    <b>If your statement is not split between months but one consolidated statement.</b><br>
                                </div>
                                <div class="col-md-12" style="margin-top:30px;">
                                    <b>Last 2 years financial statement</b><br>
                                </div>
                                <div class="col-md-12" style="margin-top:30px;">
                                    <br>
                                    <br>
                                    <b>Profitable for the last 2 accounting years</b><br>
                                </div>
        
                                <div class="col-md-12" style="margin-top:30px;">
                                    <br>
                                    <br>
                                    <b>Optional Info</b><br>
                                </div>
        
                                <div class="col-md-12" style="margin-top:30px;">
                                    <br>
                                    <br>
                                    <b>Current year</b><br>
                                </div>
                                <div class="col-md-12" style="margin-top:30px;">
                                    <b>Revenue (Rounded up is fine)</b><br>
                                </div>
                                <div class="col-md-12" style="margin-top:30px;">
                                    <b>Documents thats support reason for loan or proof of repayment ability such as contract/tender,LC,PO/Invoices etc</b><br>
                                </div>
                                <div class="col-md-12" style="margin-top:30px;">
                                    <b>Account reveiable account payable listing</b><br>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="row" style="margin-top: 20px;">
                                @for ($x = 1; $x <= 6; $x++)
                                <div class="col-md-2">
                                    <label for="formFileSm" class="form-label">@php echo date('M', strtotime( "-".$x."month")) @endphp</label>
                                    <input style="font-size: 13px;" accept="image/png, image/jpeg,image/jpg" required id="image-input" name="last_6_month_bank_statement[{{ date('M', strtotime( "-".$x."month")) }}]" class="form-control form-control-sm" id="formFileSm" type="file" />
                                </div>
                                @endfor
                            </div>
                            <div class="row" style="margin-top: 20px;">
                                @for ($x = 1; $x <= 6; $x++)
                                <div class="col-md-2">
                                    <label for="formFileSm" class="form-label">@php echo date('M', strtotime( "-".$x."month")) @endphp</label>
                                    <input  style="font-size: 13px;" accept="image/png, image/jpeg,image/jpg" required id="image-input" name="last_6_month_statement_another_currency[{{ date('M', strtotime( "-".$x."month")) }}]" class="form-control form-control-sm" id="formFileSm" type="file" />
                                </div>
                                @endfor
                            </div>
                            <div class="row">
                                <div class="col-md-2">
                                    <label for="formFileSm" class="form-label"> </label>
                                    <input  style="font-size: 13px;" accept="image/png, image/jpeg,image/jpg" required id="image-input" name="statement" class="form-control form-control-sm" id="formFileSm" type="file" />
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2" id="latest_year">
                                    <label for="formFileSm" class="form-label"> </label>
                                    <input  style="font-size: 13px;" accept="image/png, image/jpeg,image/jpg"  id="image-input" name="latest_year" class="form-control form-control-sm" id="formFileSm" type="file" />
                                </div>
                                <div class="col-md-2">
                                    <label for="formFileSm" class="form-label"> </label>
                                    <input  style="font-size: 13px;" accept="image/png, image/jpeg,image/jpg" required id="image-input" name="year_before" class="form-control form-control-sm" id="formFileSm" type="file" />
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">
                                    <br>
                                    <br>
                                    <label for="formFileSm" class="form-label">Latest year</label>
                                    <select required name="" id="profitable_latest_year" class="form-control">
                                        <option value="" hidden>Select</option>
                                        <option value="1">Yes</option>
                                        <option value="0">No</option>
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <br>
                                    <br>
                                    <label for="formFileSm" class="form-label">Year before</label>
                                    <select required name="" id="profitable_before_year" class="form-control">
                                        <option value="" hidden>Select</option>
                                        <option value="1">Yes</option>
                                        <option value="0">No</option>
                                    </select>
                                </div>
                             
                            </div>
                            <div class="row">
                                <div class="col-md-2">
                                    <br>
                                    <br>
                                    <br>
                                    <br>
                                    <br>
                                    <label for="formFileSm" class="form-label"> </label>
                                    <input  style="font-size: 13px;" accept="image/png, image/jpeg,image/jpg"  id="image-input" name="current_year" class="form-control form-control-sm" id="formFileSm" type="file" />
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">
                                    <br>
                                    <input  type="number" placeholder="$" id="revenuee" class="form-control">
                                </div>
                            </div>
                            <div class="row">
                               
                                <div class="col-md-2">
                                    <label for="formFileSm" class="form-label"> </label>
                                    <input  style="font-size: 13px;" accept="image/png, image/jpeg,image/jpg"  id="image-input" name="optional_documents" class="form-control form-control-sm" id="formFileSm" type="file" />
                                </div>
                            </div>
                            <div class="row">
                               
                                <div class="col-md-2">
                                    <label for="formFileSm" class="form-label"> </label>
                                    <br>
                                    <br>
                                    <input  style="font-size: 13px;" accept="image/png, image/jpeg,image/jpg"  id="image-input" name="reveivable_payable_listing" class="form-control form-control-sm" id="formFileSm" type="file" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row" style="margin-top: 30px;">
                    <div class="col-md-3"></div>
                    <div class="col-md-3">
                        <a onclick="backToCompanyDetail()" class="btn btn-light">Previous</a>
                    </div>
                    <div class="col-md-3" style="text-align: right;">
                        <button type="submit" class="btn btn-light">Next</button>
                    </div>
                    <div class="col-md-3"></div>
                </div>
            </form>
        </div>
        <div id="showShareholderScreen">
    
    </div>
</section>

    
</div>
<script>
    var reasons = [];
    function previosu() {
        document.getElementById("display").style.display = "block";
        document.getElementById("reasonDisplay").style.display = "none";
    }
    function pushVal(id) {
        var mychk = document.getElementById("reasonchk" + id)
        var checked = mychk.checked
        if (checked && reasons.indexOf(id) === -1) {
            this.reasons.push(id);
            console.log(this.reasons);
        } else {
            const index = reasons.indexOf(id);
            if (index > -1) {
                reasons.splice(index, 1);
            }
        }

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

    function next() {
        if (reasons.length > 0) {
            document.getElementById("reasonDisplay").style.display = "none";
            document.getElementById("loanAmount").style.display = "block";
        } else {
            Swal.fire('Please select loan reasons')
        }
    }

    function previousLoanReason() {
        document.getElementById("reasonDisplay").style.display = "block";
        document.getElementById("loanAmount").style.display = "none";
    }

    function nextLoanForm() {
        var amount = document.getElementById('amount').value
        if (!amount) {
            document.getElementById('amountVali').innerHTML = 'Amount required'
        } else {
            document.getElementById('amountVali').innerHTML = ''
            document.getElementById("loanAmount").style.display = "none";
            document.getElementById("loanForm").style.display = "block";
        }
        
    }

    function backToAmount() {
        document.getElementById("loanAmount").style.display = "block";
        document.getElementById("loanForm").style.display = "none";
    }

    function getDate() {
        var today = new Date();
        var dd = String(today.getDate()).padStart(2, '0');
        var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
        var yyyy = today.getFullYear();
        return today = yyyy + '-' + mm + '-' + dd;
    }
    function backToCompanyDetail(){
        document.getElementById("loanForm").style.display = "block";
        document.getElementById("goToCompanyDocument").style.display = "none";
    }
    

    function goToCompanyDocuments() {
        var company_year = document.getElementById('company_year').value
        var company_month = document.getElementById('company_month').value
        var number_of_share_holder = document.getElementById('number_of_share_holder').value
        var sector = document.getElementById('sector').value
        var revenue_amount1 = document.getElementById('revenue_amount1').value
        var revenue_amount2 = document.getElementById('revenue_amount2').value
        var percentage_shareholder = document.getElementById('percentage_shareholder').value
        var company_structure_type = document.getElementById('company_structure_type').value
        var number_of_employees = document.getElementById('number_of_employees').value
        if (!company_year || !company_month) {
            document.getElementById('companyVali').innerHTML = 'Company field is required'
        }else{
            document.getElementById('companyVali').innerHTML = ''
        }
        if (!sector) {
            document.getElementById('sectorVali').innerHTML = 'Sector required'
        } else {
            document.getElementById('sectorVali').innerHTML = ''
        }
        if (!revenue_amount1 || !revenue_amount2) {
            document.getElementById('revenue_amountVali').innerHTML = 'Revenue required'
        } else {
            document.getElementById('revenue_amountVali').innerHTML = ''
        }
        if (!percentage_shareholder) {
            document.getElementById('percentage_shareholderVali').innerHTML = 'Local shareholder required'
        } else {
            document.getElementById('percentage_shareholderVali').innerHTML = ''
        }
        if (!company_structure_type) {
            document.getElementById('company_structure_typeVali').innerHTML = 'Company structure required'
        } else {
            document.getElementById('company_structure_typeVali').innerHTML = ''
        }
        if (!number_of_employees) {
            document.getElementById('number_of_employeesVali').innerHTML = 'Number of employee required'
        } else {
            document.getElementById('number_of_employeesVali').innerHTML = ''
        }
        !number_of_share_holder ? document.getElementById('number_of_share_holderVali').innerHTML =
            'Share holder required' : document.getElementById('number_of_share_holderVali').innerHTML = ''
        if (company_year && company_month && number_of_share_holder && sector && revenue_amount1 && revenue_amount2 && percentage_shareholder && company_structure_type && number_of_employees) {
            
            document.getElementById("loanForm").style.display = "none";
            document.getElementById("goToCompanyDocument").style.display = "block";
            if(company_year <= 2){
                document.getElementById("latest_year").style.display = "none";
            }else{
                document.getElementById("latest_year").style.display = "block";
            }
        }
    }

</script>
<script>
    var apply_loan_id = 0;
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
        });
        ////////
        $('#bankStatment').submit(function(e) {
            e.preventDefault();
            var profile = document.getElementById("profile").value
            var loanTypeId =document.getElementById('loanTypeId').value
            var amount =document.getElementById('amount').value
            var profitable_latest_year =document.getElementById('profitable_before_year').value
            var profitable_latest_year =document.getElementById('profitable_latest_year').value
            var company_year = document.getElementById('company_year').value
            var company_month = document.getElementById('company_month').value
            var number_of_share_holder = document.getElementById('number_of_share_holder').value
            var sector = document.getElementById('sector').value
            var revenue_amount1 = document.getElementById('revenue_amount1').value
            var revenue_amount2 = document.getElementById('revenue_amount2').value
            var percentage_shareholder = document.getElementById('percentage_shareholder').value
            var company_structure_type = document.getElementById('company_structure_type').value
            var number_of_employees = document.getElementById('number_of_employees').value
            var profitable_latest_year = document.getElementById('profitable_latest_year').value
            var profitable_before_year = document.getElementById('profitable_before_year').value
            var revenuee = document.getElementById('revenuee').value
            let formData = new FormData(this);
            formData.append("reasons", reasons);
            formData.append("profile", profile);
            formData.append("loanTypeId", loanTypeId);
            formData.append("amount", amount);
            formData.append("profitable_before_year", profitable_before_year);
            formData.append("profitable_latest_year", profitable_latest_year);
            formData.append("company_year", company_year);
            formData.append("company_month", company_month);
            formData.append("number_of_share_holder", number_of_share_holder);
            formData.append("revenue_amount1", revenue_amount1);
            formData.append("revenue_amount2", revenue_amount2);
            formData.append("percentage_shareholder", percentage_shareholder);
            formData.append("company_structure_type", company_structure_type);
            formData.append("sector", sector);
            formData.append("profitable_latest_year", profitable_latest_year);
            formData.append("profitable_before_year", profitable_before_year);
            formData.append("number_of_employees", number_of_employees);
            formData.append("revenuee", revenuee);
            $('#image-input-error').text('');
            $.ajax({
                type:'POST',
                url: "{{ route('apply-loan-store') }}",
                data: formData,
                contentType: false,
                processData: false,
                success: (response) => {
                    if (response) {
                        this.reset();
                        apply_loan_id = response.apply_loan_id
                        document.getElementById("goToCompanyDocument").style.display = "none";
                        $.ajax({
                            method: "POST",
                            url: "{{ route('get-share-holder-screen') }}",
                            data: {
                                '_token': '{{ csrf_token() }}',
                                id: apply_loan_id,
                            }
                        }).done(function (data) {
                            document.getElementById("display").style.display = "none";
                            $('#showShareholderScreen').html(data)

                        });
                    }
                },
                
                error: function(response){
                    console.log(response.responseJSON)
                    $('#image-input-error').text(response.responseJSON.errors.file);
                }
            });
        });
        /////////

        
</script>
@endsection
