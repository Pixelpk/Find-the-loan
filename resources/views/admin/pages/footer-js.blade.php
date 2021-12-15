<!-- jQuery  -->
<script src="{{ asset('assets/js/jquery.min.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets/js/metismenu.min.js') }}"></script>
<script src="{{ asset('assets/js/jquery.slimscroll.js') }}"></script>
<script src="{{ asset('assets/js/waves.min.js') }}"></script>
<script src="{{ asset('assets/plugins/apexchart/apexcharts.min.js') }}"></script>
<script src="{{ asset('assets/plugins/raphael/raphael.min.js') }}"></script>
{{-- <script src="{{ asset('assets/pages/dashboard.init.js') }}"></script> --}}
<script src="{{ asset('assets/js/app.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap-notify.js') }}"></script>
<script src="{{ asset('assets/ckeditor/ckeditor.js') }}"></script>
<script src="{{ asset('assets/ckeditor/adapters/jquery.js') }}"></script>

<script src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/vendor/jquery-datatable/buttons/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('assets/vendor/jquery-datatable/buttons/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/vendor/jquery-datatable/buttons/buttons.colVis.min.js') }}"></script>
<script src="{{ asset('assets/vendor/jquery-datatable/buttons/buttons.html5.min.js') }}"></script>
<script src="{{ asset('assets/vendor/jquery-datatable/buttons/buttons.print.min.js') }}"></script>
<script src="{{ asset('assets/vendor/jquery-datatable/buttons/jszip.min.js') }}"></script>

<script src="{{ asset('assets/js/sweetalert2.min.js') }}"></script>
<script src="{{ asset('assets/js/select2.min.js') }}"></script>
<script src="{{ asset('assets/datetimepicker/js/bootstrap-datetimepicker.min.js') }}"></script>
<script src="{{ asset('assets/js/jquery-ui.js') }}"></script>
<script src="{{ asset('toastr.min.js') }}"></script>

<script>
    let todayDate = new Date();
    let quoteEndDate= new Date(new Date().setDate(todayDate.getDate() + 29));
    function showNotificationModal(message,colorName,placementFrom,placementAlign){
        // if (text === null || text === '') { text = 'Turning standard Bootstrap alerts'; }
        var allowDismiss = true;

        $.notify({
                message: message
            },
            {
                type: colorName,
                allow_dismiss: allowDismiss,
                newest_on_top: true,
                timer: 1000,
                placement: {
                    from: placementFrom,
                    align: placementAlign
                },
                animate: {
                    enter: 'animated fadeInDown',
                    exit: "animated fadeOutUp"
                },
                template: '<div data-notify="container" class="bootstrap-notify-container alert alert-dismissible {0} ' + (allowDismiss ? "p-r-35" : "") + '" role="alert">' +
                    '<button type="button" aria-hidden="true" class="close" data-notify="dismiss">×</button>' +
                    '<span data-notify="icon"></span> ' +
                    '<span data-notify="title">{1}</span> ' +
                    '<span data-notify="message">{2}</span>' +
                    '<div class="progress" data-notify="progressbar">' +
                    '<div class="progress-bar progress-bar-{0}" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;"></div>' +
                    '</div>' +
                    '<a href="{3}" target="{4}" data-notify="url"></a>' +
                    '</div>'
            });
    }
</script>
@include('admin.pages.flash-message')
<script>
    // let more_doc_array = [];
    let more_doc_message_array = [];
    let remove_more_doc_message_array = [];
    let more_doc_msg_index = 0;
    let floating_count = 0;

    @if(Route::currentRouteName() == 'update-partner-meta')
        let board_rate_count = 0;

        @if(isset($partner_meta['board_rate']))
            board_rate_count = {{count($partner_meta['board_rate'])}}-1;
        @endif
    @endif
    
    $(document).ready(function() {

        var pass_array = [];
       $( "#sortable" ).sortable({
           update: function () {
               pass_array = $(this).sortable('toArray');
           }
       });
       pass_array = $("#sortable").sortable('toArray');
       $( "#sortable" ).disableSelection();
       $("#submitFaqSort").click(function (argument) {
        //    console.log(pass_array)
        //    return false;
           $.ajax({
               method: "POST",
               url:"{{route('sort-faq-submitted')}}",
               data:{
                   "_token": "{{csrf_token()}}",
                   "pass_array": pass_array
               }
           }).done(function(data) {
               if(data.status && data.status == '1') {
                   window.location = "{{route('faq')}}";
               }
           });
       });
        
        $( '.ckeditor.editor' ).ckeditor();
        @if(Route::currentRouteName() == 'loan-application-summary')
        fixedOrFloating(1);
        @endif

        $('#loan_application_table .loan_application_row').click(function () {
            let href = $(this).attr("url");
            console.log(href)
            if(href) window.location = href;
        });

        $('#loan_application_table input:checkbox').click(function (e) {
            // button's stuff
            e.stopImmediatePropagation();
        });
        

        $('#internal').change(function (){
            console.log($(this).val())
            if ($(this).val() == 35){
                $('#reject_other_reasons').prop('disabled',false);
            }else{
                $('#reject_other_reasons').prop('disabled',true);
            }
        });

        $('#fixed_or_floating').change(function (event) {
            let fixed_or_floating = $(this).val();
            console.log(fixed_or_floating)
            fixedOrFloating(fixed_or_floating);
        });

        $('#shown_to_customer').change(function (){
            // if (reason_auto_select_count == 0){
            //     reason_auto_select_count ++;
                index = $("#shown_to_customer").prop('selectedIndex');
                $('#internal option').eq(index).prop('selected', true);
            // }
        });

        $('.datetime-picker').datetimepicker({
            minuteStep:5,
            weekStart: 0,
        });
        $('.date-picker').datetimepicker({
            minView: 2,
            format: 'yyyy-mm-dd',
            pickTime:false
        });
        
        $('.date-picker-quote').datetimepicker({
            minView: 2,
            format: 'yyyy-mm-dd',
            pickTime:false,
            startDate: todayDate,
            endDate: quoteEndDate
        });

        $('.search-enquiries').keyup(function (event) {
            let search = $(this).val();
            let profile = $('#application_profile_tab').val();
            console.log(search)
            $.ajax({
                method: 'POST',
                url: "{{route('application-search')}}",
                data: {
                    '_token': '{{ csrf_token()}}',
                    'search': search,
                    'profile': profile,
                }
            }).done(function (data) {
                console.log(data)
                $('#search_list').html('');
                $('#search_list').html(data);
                $('#search_list').css('display', 'block');
            });
        });

        // $('.selected_application').click(function(e){
        //     e.preventDefault();
        //     e.stopPropagation();
        //     return false;
        // });
        

        $("#bulk_assign").click(function (event) {
            console.log('asdfasdf')
            event.preventDefault();
            event.stopPropagation();
            var user_id = $('#assign_user_id').val();
            var SelectedList = [];
            $("input:checkbox[name=selected_application]:checked").each(function(){
                SelectedList.push($(this).val());
            });

            if (SelectedList.length <= 0){
                $('#assign_error').show();
                return false;
            }else {
                $('#assign_error').hide();
            }
            $.ajax({
                method: "POST",
                url: "{{ route('assign-application') }}",
                data: {
                    '_token': '{{ csrf_token() }}',
                    'user_id':user_id,
                    'selected_list':SelectedList
                }
            }).done(function (data) {
                window.location.href = "{{ route('loan-applications',['profile'=>$_GET['profile']]) }}";
            });
        });
        // $('#application_filter_btn').click(function (){
        //    $('#application_filter_form').toggle();
        // });
        $(document).on('click', '#application_filter_form', function (e) {
            e.stopPropagation();
        });

        $('#loan_profile').change(function (){
           var main_type = $(this).val();
           console.log(main_type)
            if (main_type == 1){
                $('#loanType').hide();
            }else {
                $('#loanType').show();
                getLoanType(main_type);
            }
        });
        
        $('#is_joint_account_required').change(function(){
            var value = $(this).val();
            if ( $(this).is(':checked') ){
                $('#joint_account_days').prop({'disabled':false, 'required':true});
                $('#joint_account_cost_from').prop({'disabled':false, 'required':true});
                $('#joint_account_cost_to').prop({'disabled':false, 'required':true});
            }else{
                $('#joint_account_days').prop('disabled',true);
                $('#joint_account_cost_from').prop('disabled',true);
                $('#joint_account_cost_to').prop('disabled',true);
            }
            
        });

        $("#mobile-dropdown .dropdown-toggle").click(function() {
            $(this).dropdown("toggle");
            return false;
        });

        $(".change_status").click(function (event) {
            event.preventDefault();
            var msg = ($(this).attr('msg'));
            var type = ($(this).attr('type'));
            var url = ($(this).attr('href'));
            Swal.fire({
                title: msg,
                type: type,
                showCancelButton: true,
                cancelButtonText: "No",
                confirmButtonColor: 'rgb(221, 51, 51)',
                cancelButtonColor: '#d33',
                confirmButtonText: "Yes"
            }).then((result) => {
                if (result.value) {
                    window.location.href = url;
                }
            })
        });


        //put quotation fee section validations starting
        $(document).on("input", '#one_time_fee_value', function(event) { 
            console.log($(this).val().length)
            if($(this).val().length < 1){
                $("#one_time_fee_percent").prop('disabled', false);
            }else{
                $("#one_time_fee_percent").prop('disabled', true);
            }
        });

        $(document).on("input", '#one_time_fee_percent', function(event) { 
            console.log($(this).val().length)
            if($(this).val().length < 1){
                $("#one_time_fee_value").prop('disabled', false);
            }else{
                $("#one_time_fee_value").prop('disabled', true);
            }
        });
        
        $(document).on("input", '#monthly_fee_value', function(event) { 
            console.log($(this).val().length)
            if($(this).val().length < 1){
                $("#monthly_fee_percent").prop('disabled', false);
            }else{
                $("#monthly_fee_percent").prop('disabled', true);
            }
        });

        $(document).on("input", '#monthly_fee_percent', function(event) { 
            console.log($(this).val().length)
            if($(this).val().length < 1){
                $("#monthly_fee_value").prop('disabled', false);
            }else{
                $("#monthly_fee_value").prop('disabled', true);
            }
        });

        $(document).on("input", '#annual_fee_value', function(event) { 
            console.log($(this).val().length)
            if($(this).val().length < 1){
                $("#annual_fee_percent").prop('disabled', false);
            }else{
                $("#annual_fee_percent").prop('disabled', true);
            }
        });

        $(document).on("input", '#annual_fee_percent', function(event) { 
            console.log($(this).val().length)
            if($(this).val().length < 1){
                $("#annual_fee_value").prop('disabled', false);
            }else{
                $("#annual_fee_value").prop('disabled', true);
            }
        });

        $(document).on("input", '.if_insurance_required_value', function(event) { 
            console.log($(this).val().length)
            if($(this).val().length < 1){
                $(".if_insurance_required_percent").prop('disabled', false);
            }else{
                $(".if_insurance_required_percent").prop('disabled', true);
            }
        });

        $(document).on("input", '.if_insurance_required_percent', function(event) { 
            console.log($(this).val().length)
            if($(this).val().length < 1){
                $(".if_insurance_required_value").prop('disabled', false);
            }else{
                $(".if_insurance_required_value").prop('disabled', true);
            }
        });

        $(document).on("input", '#eir_pa', function(event) { 
            console.log($(this).val().length)
            if($(this).val().length < 1){
                $("#eir_pm").prop('disabled', false);
            }else{
                $("#eir_pm").prop('disabled', true);
            }
        });

        $(document).on("input", '#eir_pm', function(event) { 
            console.log($(this).val().length)
            if($(this).val().length < 1){
                $("#eir_pa").prop('disabled', false);
            }else{
                $("#eir_pa").prop('disabled', true);
            }
        });

        $(document).on("input", '#interest_pa', function(event) { 
            console.log($(this).val().length)
            if($(this).val().length < 1){
                $("#interest_pm").prop('disabled', false);
            }else{
                $("#interest_pm").prop('disabled', true);
            }
        });

        $(document).on("input", '#interest_pm', function(event) { 
            console.log($(this).val().length)
            if($(this).val().length < 1){
                $("#interest_pa").prop('disabled', false);
            }else{
                $("#interest_pa").prop('disabled', true);
            }
        });
        //---------------
        //put quotation floating pa months and spread input validation
        $(document).on("input", '.pa_months', function(event) { 
            let row_index = $(this).attr('row_index');
            if($(this).val().length < 1){
                $(".pa_spread[row_index='"+row_index+"']").prop('disabled', false);
            }else{
                $(".pa_spread[row_index='"+row_index+"']").prop('disabled', true);
            }
        });

        $(document).on("input",'#current_value_indicative',function(event){
            let current_value_indivative = $(this).val();
            let sum = 0;
            $('.calculated_spread_pa').each(function(){           
                let row_index = $(this).attr('row_index');
                let current_value = $(".pa_spread[row_index='"+row_index+"']").val();

                let sum = parseInt(current_value) + parseInt(current_value_indivative);
                $(".calculated_spread_pa[row_index='"+row_index+"']").val(sum);
                let checking_value = $(".calculated_spread_pa[row_index='"+row_index+"']").val();
                console.log("checking_value"+checking_value)
                $(".calculated_spread_pa_span[row_index='"+row_index+"']").html(sum);


            });
        });

        $(document).on("input", '.pa_spread', function(event) { 
            $('#current_value_indicative_error').html('');
            let current_value_indicative = $('#current_value_indicative').val();
            let row_index = $(this).attr('row_index');
            let pa_spread_value = $(this).val();
            if(current_value_indicative.length == ""){
                $('#current_value_indicative_error').html('First add current value');
                return false;
            }
            
            let calculated_spread_pa = parseInt(pa_spread_value) + parseInt(current_value_indicative);
            console.log("calculated_spread_pa"+calculated_spread_pa)

            if($(this).val().length < 1){
                $(".pa_months[row_index='"+row_index+"']").prop('disabled', false);

            }else{
                $(".pa_months[row_index='"+row_index+"']").prop('disabled', true);
                $(".calculated_spread_pa_span[row_index='"+row_index+"']").html(calculated_spread_pa);
                $(".calculated_spread_pa[row_index='"+row_index+"']").val(calculated_spread_pa);
            }
        });

        $(document).on("input", '#thereafter_pa', function(event) { 
            console.log($(this).val().length)
            if($(this).val().length < 1){
                $("#thereafter_spread").prop('disabled', false);
            }else{
                $("#thereafter_spread").prop('disabled', true);
            }
        });

        $(document).on("input", '#thereafter_spread', function(event) { 
            console.log($(this).val().length)
            if($(this).val().length < 1){
                $("#thereafter_pa").prop('disabled', false);
            }else{
                $("#thereafter_pa").prop('disabled', true);
            }
        });
        //put quotation fee section validations ending

        // $('.interest_reducing_balance').keyup(function(){
        //     console.log($(this).val().length)
        //     if($(this).val().length < 1){
        //         $(".interest_flat").prop('disabled', false);
        //         $(".interest_board_rate").prop('disabled', false);
        //         $(".flat_fee_regardless").prop('disabled', false);
        //     }else{
        //         $(".interest_flat").prop('disabled', true);
        //         $(".interest_board_rate").prop('disabled', true);
        //         $(".flat_fee_regardless").prop('disabled', true);
        //     }
        // });

        // $('.interest_board_rate').keyup(function(){
        //     console.log($(this).val().length)
        //     if($(this).val().length < 1){
        //         $(".interest_flat").prop('disabled', false);
        //         $(".interest_reducing_balance").prop('disabled', false);
        //         $(".flat_fee_regardless").prop('disabled', false);
        //     }else{
        //         $(".interest_flat").prop('disabled', true);
        //         $(".interest_reducing_balance").prop('disabled', true);
        //         $(".flat_fee_regardless").prop('disabled', true);
        //     }
        // });
        // $('.flat_fee_regardless').keyup(function(){
        //     console.log($(this).val().length)
        //     if($(this).val().length < 1){
        //         $(".interest_flat").prop('disabled', false);
        //         $(".interest_reducing_balance").prop('disabled', false);
        //         $(".interest_board_rate").prop('disabled', false);
        //     }else{
        //         $(".interest_flat").prop('disabled', true);
        //         $(".interest_reducing_balance").prop('disabled', true);
        //         $(".interest_board_rate").prop('disabled', true);
        //     }
        // });
        // $('#submit_quotation').click(function(event){
        //     event.preventDefault();
        //     var inputs = $('#quotationForm :input');
        //     var values = {};
        //     inputs.each(function() {
        //         values[this.name] = $(this).val();
        //     });
        //     console.log(values);
        //     $.ajax({
        //         method: "POST",
        //         url: "{{ route('submit-quotation') }}",
        //         data: values
        //     }).done(function (result) {

        //         console.log(result)
        //         return false;
        //     });
        // });
        $(document).on("click", '#months_add_row', function(event) { 
            floating_count ++;
            event.preventDefault();
            
            var append_html = '<div class="row " >'+
            '    <div class="form-group col-md-2">'+
            '        <label class="col-form-label">'+
            '            From month'+
            '        </label>'+
            '        <input type="number" min="1" row_index="'+floating_count+'" name="pa['+floating_count+']['+'from_month'+']" class="form-control pa_months" >'+
            '    </div>'+
            '    <div class="form-group col-md-2">'+
            '        <label class="col-form-label">'+
            '            To month'+
            '        </label>'+
            '        <input type="number" min="1" row_index="'+floating_count+'" name="pa['+floating_count+']['+'to_month'+']" class="form-control pa_months" >'+
            '    </div>'+
            '    <div class="form-group col-md-2">'+
            '        <label class="col-form-label">'+
            '            %p.a'+
            '        </label>'+
            '        <input type="number" min="1" row_index="'+floating_count+'" name="pa['+floating_count+']['+'month_vise_pa'+']" class="form-control pa_months" >'+
            '    </div>'+
            '    <span class="mt-5">OR</span>'+
            '    <div class="form-group col-md-3">'+
            '        <label class="col-form-label">'+
            '            yyy xxx + (spread) %'+
            '        </label>'+
            '        <input type="number" min="1" row_index="'+floating_count+'" placeholder="Spread (%)" name="pa['+floating_count+']['+'spread'+']" class="form-control pa_spread" >'+
            '    </div>'+
            '    <div class="form-group col-md-1">'+
            '        <label class="col-form-label">'+
            '            = %p.a'+
            '        </label>'+
            '   <span class="calculated_spread_pa_span" row_index="'+floating_count+'"></span>'+
            '        <input type="number" min="1" row_index="'+floating_count+'" hidden name="pa['+floating_count+']['+'calculated_spread_pa'+']" class="form-control calculated_spread_pa" >'+
            '    </div>'+
            '    <div class="form-group col-md-1">'+
            '        <label class="col-form-label">'+
            '            '+
            '        </label>'+
            '   <a href="javascript:void(0)"  data-original-title="Delete"><i class="mt-5 remove_month_vise_pa_or_spread fa fa-trash"></i></a>'
            '    </div>'+
            '</div>';
	

            console.log('afdfadsf')
            $('.month_vise_pa_or_spread').append(append_html);   
        });

        $(document).on("click", '#add_board_rate_row', function(event) { 
            board_rate_count ++;
            event.preventDefault();
            
            var append_html = '<div class="row " >'+
            '    <div class="form-group col-md-4">'+
            '        <label class="col-form-label">'+
            '            Date'+
            '        </label>'+
            '        <input type="text" class="form-control date-picker" row_index="'+board_rate_count+'" name="board_rate['+board_rate_count+']['+'date'+']" >'+
            '    </div>'+
            '    <div class="form-group col-md-4">'+
            '        <label class="col-form-label">'+
            '            Rate'+
            '        </label>'+
            '        <input type="number" min="1" row_index="'+board_rate_count+'" name="board_rate['+board_rate_count+']['+'rate'+']" class="form-control" >'+
            '    </div>'+
            '    <div class="form-group col-md-1">'+
            '        <label class="col-form-label">'+
            '            '+
            '        </label>'+
            '   <a href="javascript:void(0)"  data-original-title="Remove"><i class="mt-5 remove_board_rate_row fa fa-trash"></i></a>'
            '    </div>'+
            '</div>';
	
            $('.add_board_rate_div').append(append_html);   
        });

        $(document).on("click", '.remove_board_rate_row', function(event) { 
            $(this).closest('div .row').remove();
        });

        $('#add_more_message_desc').click(function(e){
            e.preventDefault();
            var document_of = $("input[name='document_of']:checked").val();
            // var more_doc_reasons = $('#more_doc_reasons').val();
            var more_doc_reasons = [];
            var more_doc_reasons_text = [];
            $('input[name=more_doc_reasons]:checked').map(function() {
                more_doc_reasons.push($(this).val());
                more_doc_reasons_text.push($(this).next('label').text());
            });
            var quote_additional_doc_id = $("input[name='quote_additional_doc_id']:checked").val();
            // var quote_additional_doc_id = $('#quote_additional_doc_id:checked').val();

            if(document_of == ""){
                $("#document_of_error").html("Document of field is required");
                return false;
            }
            if(more_doc_reasons == ""){
                $("#more_doc_reasons_error").html("Reason is required");
                return false;
            }
            if(quote_additional_doc_id == ""){
                $("#add_doc_id_error").html("Document field is required");
                return false;
            }
            
             new_obj = {};
             new_obj.if_any = $('#if_any').prop('checked');
             new_obj.from = $('#from').val();
             new_obj.to = $('#to').val();
             new_obj.within_days = $('#within_days').val();
             new_obj.past_months = $('#past_months').val();
             new_obj.valid_for = $('#valid_for').val();
            //  new_obj.latest = $('#latest').prop('checked');
            //  new_obj.required_company_stamp = $('#required_company_stamp').prop('checked');
            //  new_obj.need_notarized = $('#need_notarized').prop('checked');
            //  new_obj.signature_borrower = $('#signature_borrower').prop('checked');
            //  new_obj.signature_borrowers_customer = $('#signature_borrowers_customer').prop('checked');
             new_obj.more_doc_reasons = more_doc_reasons;
             new_obj.document_of = document_of;
             new_obj.quote_additional_doc_id = quote_additional_doc_id;
            more_doc_message_array.push(new_obj);
            console.log(more_doc_message_array);

            var html = "<tr index="+more_doc_msg_index+">"
            +"<td><a href='javascript:void(0)' index='"+more_doc_msg_index+"' data-original-title='Delete'><i class='m-2 remove_more_doc_msg fa fa-trash'></i></a></td>"
            +"<td>"+$("input[name='quote_additional_doc_id']:checked").next('label').text()+"</td>"
            +"<td>"+$("input[name='document_of']:checked").next('label').text()+"</td>"
            +"<td>"+more_doc_reasons_text+"</td>" //+"<td>"+$("#more_doc_reasons option:selected").text();+"</td>"
            +"<td>"+new_obj.within_days+"</td>"
            +"<td>"+new_obj.past_months+"</td>"
            +"<td>"+new_obj.valid_for+"</td>"
            +"<td>"+new_obj.from+"</td>"
            +"<td>"+new_obj.to+"</td>"
            +"<td>"+new_obj.if_any+"</td>"
            // +"<td>"+new_obj.latest+"</td>"
            // +"<td>"+new_obj.required_company_stamp+"</td>"
            // +"<td>"+new_obj.need_notarized+"</td>"
            // +"<td>"+new_obj.signature_borrower+"</td>"
            // +"<td>"+new_obj.signature_borrowers_customer+"</td>"
            +"</tr>";
            $('#more_doc_msg_table').append(html);
            more_doc_msg_index++;
            if(more_doc_message_array.length > 0){
                $('#more_doc_msg_list').show();
            }
            $( '#more_doc_form' ).each(function(){
                this.reset();
            });
        });

        $(document).on("click", '.remove_more_doc_msg', function(event) { 
            var index = $(this).closest('tr').attr('index');
            console.log("index of"+index)
            $(this).closest('tr').remove();
            remove_more_doc_message_array.push(index);
            if(more_doc_message_array.length < 1){
                $('#more_doc_msg_list').hide();
            }
            console.log('after remove'+remove_more_doc_message_array);
        });

        $(document).on("click", '.remove_month_vise_pa_or_spread', function(event) { 
            $(this).closest('div .row').remove();
        });
        // $('#quote_additional_doc_idz').change(function(e){
        //     e.preventDefault();
        //     $('#point_to_any_specific_doc').html();
        //     var append_html = "";
        //     $("#quote_additional_doc_idz option:selected").each(function() {
        //         append_html+="<option value='"+this.value+"'>"+this.text+"</option>";
        //         console.log(this.value+"="+this.text)        //
        //     });
        //     console.log(append_html)
        //     $('#point_to_any_specific_doc').html(append_html);
        //     // alert($('#quote_additional_doc_idz option:selected').text());
        // });

        $('#more_doc_request_btn').click(function(e){
            e.preventDefault();
            $("#add_doc_id_error").html("");
            $("#more_doc_error").html("");
            console.log("remove array"+remove_more_doc_message_array)
            console.log("add array"+more_doc_message_array)
            if(remove_more_doc_message_array.length > 0){
                $.each(remove_more_doc_message_array, function(index, item) {
                    more_doc_message_array.splice(index,1);
                    console.log("item is"+item)
                    index_of_remove_array = remove_more_doc_message_array.indexOf(item)
                    remove_more_doc_message_array.splice(index_of_remove_array,1);

                });
                console.log('after removing'+remove_more_doc_message_array)
            }

            if(more_doc_message_array.length <=0){
                console.log("submit array")
                console.log(more_doc_message_array)
                $('#more_doc_error').html('Please select any doc with reason and add.');
                return false;
            }
            
            // return false; //remove this line after debug
            var apply_loan_id = $('#apply_loan_id').val();

            $.ajax({
                method: "POST",
                url: "{{ route('more-doc-request') }}",
                data: {
                    '_token': '{{ csrf_token() }}',
                    'apply_loan_id':apply_loan_id,
                    // 'quote_additional_doc_idz':quote_additional_doc_idz,
                    'msg_desc_section':more_doc_message_array
                }
            }).done(function (data) {
                console.log(data)
                if(data.success == 1){
                    window.location.href = data.redirect;
                }
            });

            console.log("on submit"+more_doc_message_array);
            
        });

        // $('.js-exportable').DataTable({
        //     dom: 'Bfrtip',
        //     buttons: [
        //         'copy', 'excel'
        //     ]
        // });
        

        // $('#partner_sales_report').DataTable({
        //     paging: false,
        //     searching: false,
        //     "info": false,
        //     buttons: [
        //     'copy', 'csv', 'excel', 'pdf', 'print'
        // ]
        // });

        $('#loan_application_table').DataTable({
            paging: false,
            searching: false,
            "info": false,
            order: [[4, 'desc'],[5,'desc']],
            
            columnDefs: [
                {
                    "orderable": false,
                    "targets": [0,1,2,3,6,7,8,9,10,11,12,13,14,15,16,17,18],
                },
            ]
        });

        $('.select2').select2();

    });

    function rejectApplication(loan_apply_id){
        reason_auto_select_count = 0;
        console.log(loan_apply_id)
        $("#reject_loan_id").val(loan_apply_id)
        $('#RejectReasonModel').modal('show');
    }

    function fixedOrFloating(fixed_or_floating){
        let apply_loan_id = $('#apply_loan_id').val();

        $.ajax({
                method: 'POST',
                url: "{{route('fixed-or-floating')}}",
                data: {
                    '_token': '{{ csrf_token()}}',
                    'fixed_or_floating': fixed_or_floating,
                    'apply_loan_id': apply_loan_id,
                }
            }).done(function (data) {
                // console.log(data)
                $('#fixed_floating_div').html('');
                $('#fixed_floating_div').html(data);
            });
    }

    function showImage(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $(input).siblings('.avatar')
                    .attr('src', e.target.result)
                    .width(150)
                    .height(150);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }

</script>


