@if ($fixed_or_floating == 1)
<div class="form-row">
    <div class="form-group col-md-5">
        <label for="input1" class="col-form-label">Interest % P.a</label>
        <input type="number" min="0"  required name="interest_pa" class="form-control interest_flat" id="interest_pa">
    </div>
    <div class="form-group col-md-2 d-flex pt-4 justify-content-center align-items-center">
        <h6 class="">or</h6>
    </div>
    <div class="form-group col-md-5">
        <label for="input2" class="col-form-label">Interest (flat)  % P.m</label>
        <input type="number" min="0"  required name="interest_pm" class="form-control interest_flat" id="interest_pm">
    </div>
</div>
<div class="form-row">
    <div class="form-group col-md-6">
        <label for="input7" class="col-form-label">Tenure(optional for overdraft)</label>
        <div class="row">
            <div class="col-md-3">
                <input type="number" min="0"  class="form-control" @if($loan_type != 1) required @endif name="tenure_years" placeholder="Years" id="tenure_years">
            </div>
            <div class="col-md-3">
                <input type="number" min="0"  class="form-control" @if($loan_type != 1) required @endif name="tenure_months" placeholder="Months" id="tenure_months">
            </div>
        </div>
    </div>
    <div class="form-group col-md-6">
        <label for="input7" class="col-form-label">Lock-in if any( please state final length free of any form of penalty)
        </label>
        <div class="row">
            <div class="col-md-3">
                <input type="number" min="0"  required class="form-control" name="lock_in_years" placeholder="Years" id="lock_in_years">
            </div>
            <div class="col-md-3">
                <input type="number" min="0"  required class="form-control" name="lock_in_months" placeholder="Months" id="lock_in_months">
            </div>
        </div>
    </div>
</div>
@else
    @php
    $reference_rates =allReferenceRates();
    @endphp
<h6>Please select from the following reference rate</h6>    
<div class="row">
    @foreach($reference_rates as $key => $rate)
    <div class="col-md-3">
        <div class="form-group custom-switch">
            <input type="radio" @if ($key == 0) checked @endif class="custom-control-input" value="{{$rate}}" name="reference_rate" id="reference_rate{{$key}}">
            <label class="custom-control-label" for="reference_rate{{$key}}">{{$rate}}</label>
        </div>
    </div>
    @endforeach
</div>
<div class="row">
    <div class="form-group col-md-6">
        <label class="col-form-label">
            Other publicly used financial indicators/rates
        </label>
        <input type="number" pattern="/^-?\d+\.?\d*$/" name="other_financial_rates" class="form-control" onKeyPress="if(this.value.length==12) return false;" />
    </div>
    <div class="form-group col-md-6">
        <label class="col-form-label">
            Months (if any)
        </label>
        <input type="number" min="0" name="months_if_any" class="form-control" >
    </div>
    <div class="col-md-6">
        <label for="input7" class="col-form-label">Currency based on (if any)
        </label>
        <select required name="currency" class="form-control">
        <option>Select currency</option>
        <option value="AFN">Afghan Afghani</option>
        <option value="ALL">Albanian Lek</option>
        <option value="DZD">Algerian Dinar</option>
        <option value="AOA">Angolan Kwanza</option>
        <option value="ARS">Argentine Peso</option>
        <option value="AMD">Armenian Dram</option>
        <option value="AWG">Aruban Florin</option>
        <option value="AUD">Australian Dollar</option>
        <option value="AZN">Azerbaijani Manat</option>
        <option value="BSD">Bahamian Dollar</option>
        <option value="BHD">Bahraini Dinar</option>
        <option value="BDT">Bangladeshi Taka</option>
        <option value="BBD">Barbadian Dollar</option>
        <option value="BYR">Belarusian Ruble</option>
        <option value="BEF">Belgian Franc</option>
        <option value="BZD">Belize Dollar</option>
        <option value="BMD">Bermudan Dollar</option>
        <option value="BTN">Bhutanese Ngultrum</option>
        <option value="BTC">Bitcoin</option>
        <option value="BOB">Bolivian Boliviano</option>
        <option value="BAM">Bosnia-Herzegovina Convertible Mark</option>
        <option value="BWP">Botswanan Pula</option>
        <option value="BRL">Brazilian Real</option>
        <option value="GBP">British Pound Sterling</option>
        <option value="BND">Brunei Dollar</option>
        <option value="BGN">Bulgarian Lev</option>
        <option value="BIF">Burundian Franc</option>
        <option value="KHR">Cambodian Riel</option>
        <option value="CAD">Canadian Dollar</option>
        <option value="CVE">Cape Verdean Escudo</option>
        <option value="KYD">Cayman Islands Dollar</option>
        <option value="XOF">CFA Franc BCEAO</option>
        <option value="XAF">CFA Franc BEAC</option>
        <option value="XPF">CFP Franc</option>
        <option value="CLP">Chilean Peso</option>
        <option value="CNY">Chinese Yuan</option>
        <option value="COP">Colombian Peso</option>
        <option value="KMF">Comorian Franc</option>
        <option value="CDF">Congolese Franc</option>
        <option value="CRC">Costa Rican ColÃ³n</option>
        <option value="HRK">Croatian Kuna</option>
        <option value="CUC">Cuban Convertible Peso</option>
        <option value="CZK">Czech Republic Koruna</option>
        <option value="DKK">Danish Krone</option>
        <option value="DJF">Djiboutian Franc</option>
        <option value="DOP">Dominican Peso</option>
        <option value="XCD">East Caribbean Dollar</option>
        <option value="EGP">Egyptian Pound</option>
        <option value="ERN">Eritrean Nakfa</option>
        <option value="EEK">Estonian Kroon</option>
        <option value="ETB">Ethiopian Birr</option>
        <option value="EUR">Euro</option>
        <option value="FKP">Falkland Islands Pound</option>
        <option value="FJD">Fijian Dollar</option>
        <option value="GMD">Gambian Dalasi</option>
        <option value="GEL">Georgian Lari</option>
        <option value="DEM">German Mark</option>
        <option value="GHS">Ghanaian Cedi</option>
        <option value="GIP">Gibraltar Pound</option>
        <option value="GRD">Greek Drachma</option>
        <option value="GTQ">Guatemalan Quetzal</option>
        <option value="GNF">Guinean Franc</option>
        <option value="GYD">Guyanaese Dollar</option>
        <option value="HTG">Haitian Gourde</option>
        <option value="HNL">Honduran Lempira</option>
        <option value="HKD">Hong Kong Dollar</option>
        <option value="HUF">Hungarian Forint</option>
        <option value="ISK">Icelandic KrÃ³na</option>
        <option value="INR">Indian Rupee</option>
        <option value="IDR">Indonesian Rupiah</option>
        <option value="IRR">Iranian Rial</option>
        <option value="IQD">Iraqi Dinar</option>
        <option value="ILS">Israeli New Sheqel</option>
        <option value="ITL">Italian Lira</option>
        <option value="JMD">Jamaican Dollar</option>
        <option value="JPY">Japanese Yen</option>
        <option value="JOD">Jordanian Dinar</option>
        <option value="KZT">Kazakhstani Tenge</option>
        <option value="KES">Kenyan Shilling</option>
        <option value="KWD">Kuwaiti Dinar</option>
        <option value="KGS">Kyrgystani Som</option>
        <option value="LAK">Laotian Kip</option>
        <option value="LVL">Latvian Lats</option>
        <option value="LBP">Lebanese Pound</option>
        <option value="LSL">Lesotho Loti</option>
        <option value="LRD">Liberian Dollar</option>
        <option value="LYD">Libyan Dinar</option>
        <option value="LTL">Lithuanian Litas</option>
        <option value="MOP">Macanese Pataca</option>
        <option value="MKD">Macedonian Denar</option>
        <option value="MGA">Malagasy Ariary</option>
        <option value="MWK">Malawian Kwacha</option>
        <option value="MYR">Malaysian Ringgit</option>
        <option value="MVR">Maldivian Rufiyaa</option>
        <option value="MRO">Mauritanian Ouguiya</option>
        <option value="MUR">Mauritian Rupee</option>
        <option value="MXN">Mexican Peso</option>
        <option value="MDL">Moldovan Leu</option>
        <option value="MNT">Mongolian Tugrik</option>
        <option value="MAD">Moroccan Dirham</option>
        <option value="MZM">Mozambican Metical</option>
        <option value="MMK">Myanmar Kyat</option>
        <option value="NAD">Namibian Dollar</option>
        <option value="NPR">Nepalese Rupee</option>
        <option value="ANG">Netherlands Antillean Guilder</option>
        <option value="TWD">New Taiwan Dollar</option>
        <option value="NZD">New Zealand Dollar</option>
        <option value="NIO">Nicaraguan CÃ³rdoba</option>
        <option value="NGN">Nigerian Naira</option>
        <option value="KPW">North Korean Won</option>
        <option value="NOK">Norwegian Krone</option>
        <option value="OMR">Omani Rial</option>
        <option value="PKR">Pakistani Rupee</option>
        <option value="PAB">Panamanian Balboa</option>
        <option value="PGK">Papua New Guinean Kina</option>
        <option value="PYG">Paraguayan Guarani</option>
        <option value="PEN">Peruvian Nuevo Sol</option>
        <option value="PHP">Philippine Peso</option>
        <option value="PLN">Polish Zloty</option>
        <option value="QAR">Qatari Rial</option>
        <option value="RON">Romanian Leu</option>
        <option value="RUB">Russian Ruble</option>
        <option value="RWF">Rwandan Franc</option>
        <option value="SVC">Salvadoran ColÃ³n</option>
        <option value="WST">Samoan Tala</option>
        <option value="SAR">Saudi Riyal</option>
        <option value="RSD">Serbian Dinar</option>
        <option value="SCR">Seychellois Rupee</option>
        <option value="SLL">Sierra Leonean Leone</option>
        <option value="SGD">Singapore Dollar</option>
        <option value="SKK">Slovak Koruna</option>
        <option value="SBD">Solomon Islands Dollar</option>
        <option value="SOS">Somali Shilling</option>
        <option value="ZAR">South African Rand</option>
        <option value="KRW">South Korean Won</option>
        <option value="XDR">Special Drawing Rights</option>
        <option value="LKR">Sri Lankan Rupee</option>
        <option value="SHP">St. Helena Pound</option>
        <option value="SDG">Sudanese Pound</option>
        <option value="SRD">Surinamese Dollar</option>
        <option value="SZL">Swazi Lilangeni</option>
        <option value="SEK">Swedish Krona</option>
        <option value="CHF">Swiss Franc</option>
        <option value="SYP">Syrian Pound</option>
        <option value="STD">São Tomé and Príncipe Dobra</option>
        <option value="TJS">Tajikistani Somoni</option>
        <option value="TZS">Tanzanian Shilling</option>
        <option value="THB">Thai Baht</option>
        <option value="TOP">Tongan pa'anga</option>
        <option value="TTD">Trinidad & Tobago Dollar</option>
        <option value="TND">Tunisian Dinar</option>
        <option value="TRY">Turkish Lira</option>
        <option value="TMT">Turkmenistani Manat</option>
        <option value="UGX">Ugandan Shilling</option>
        <option value="UAH">Ukrainian Hryvnia</option>
        <option value="AED">United Arab Emirates Dirham</option>
        <option value="UYU">Uruguayan Peso</option>
        <option value="USD">US Dollar</option>
        <option value="UZS">Uzbekistan Som</option>
        <option value="VUV">Vanuatu Vatu</option>
        <option value="VEF">Venezuelan BolÃ­var</option>
        <option value="VND">Vietnamese Dong</option>
        <option value="YER">Yemeni Rial</option>
        <option value="ZMK">Zambian Kwacha</option>
        </select>
    </div>
    <div class="form-group col-md-6">
        <label class="col-form-label">
            Current value (indicative)
        </label>
        <input type="number" id="current_value_indicative" name="current_value_indicative" class="form-control" >
        <span style="color: red" id="current_value_indicative_error"></span>
    </div>
</div>
<hr>
<div class="month_vise_pa_or_spread">
    <div class="row" >
        <div class="form-group col-md-2">
            <label class="col-form-label">
                From month
            </label>
            <input type="number" min="1" required name="pa[0][from_month]" row_index="0" class="form-control pa_months" >
        </div>
        <div class="form-group col-md-2">
            <label class="col-form-label">
                To month
            </label>
            <input type="number" min="1" required name="pa[0][to_month]" row_index="0" class="form-control pa_months" >
        </div>
        <div class="form-group col-md-2">
            <label class="col-form-label">
                %p.a
            </label>
            <input type="number" min="1" required name="pa[0][month_vise_pa]" row_index="0" class="form-control pa_months" >
        </div>
        {{-- <div class="form-group mt-auto col-md-1"> --}}
            <span class="mt-5">OR</span>
        {{-- </div> --}}
        <div class="form-group col-md-3">
            <label class="col-form-label">
                yyy xxx + (spread) %
            </label>
            <input type="number" min="1" required placeholder="Spread (%)" row_index="0" name="pa[0][spread]" class="form-control pa_spread" >
        </div>
        <div class="form-group col-md-1">
            <label class="col-form-label">
                = %p.a
            </label>
            <span class="calculated_spread_pa_span" row_index="0"></span>
            <input type="number" min="1" hidden name="pa[0][calculated_spread_pa]" row_index="0" class="form-control calculated_spread_pa" >
        </div>
        {{-- <div class="form-group col-md-1">
            <label class="col-form-label">
            </label>
            <a href="javascript:void(0)"  data-original-title="Delete">
                <i class="mt-5 remove_month_vise_pa_or_spread fa fa-trash"></i>
            </a>
        </div> --}}
    </div>
</div>

<div class="row">
    <div class="col-md-12 form-group mt-1">
            <button type="button" id="months_add_row" class="btn btn-primary waves-effect waves-light">
                Add row
            </button>
    </div>
</div>
<div class="row">
    <div class="form-group col-md-4">
        <label class="col-form-label">
            %p.a(Thereafter if any)
        </label>
        <input type="number" min="1" required name="thereafter_pa" id="thereafter_pa" class="form-control" >
    </div>
    {{-- <div class="form-group mt-auto col-md-1"> --}}
        <span class="mt-5">OR</span>
    {{-- </div> --}}
    <div class="form-group col-md-4 ">
        <label class="col-form-label">
            yyy xxx + (spread) %
        </label>
        <input type="number" min="1" required placeholder="Spread (%)" id="thereafter_spread" name="thereafter_spread" class="form-control" >
    </div>
    <div class="form-group col-md-2">
        <label class="col-form-label">
            = %p.a
        </label>
        <input type="number" min="1" readonly name="thereafter_spread_pa" id="thereafter_spread_pa" class="form-control" >
    </div>
</div>
{{-- </div> --}}
@endif