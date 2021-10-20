<!-- jQuery  -->
<script src="{{ asset('assets/js/jquery.min.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets/js/metismenu.min.js') }}"></script>
<script src="{{ asset('assets/js/jquery.slimscroll.js') }}"></script>
<script src="{{ asset('assets/js/waves.min.js') }}"></script>
<script src="{{ asset('assets/plugins/apexchart/apexcharts.min.js') }}"></script>
<script src="{{ asset('assets/plugins/raphael/raphael.min.js') }}"></script>
{{--<script src="{{ asset('assets/pages/dashboard.init.js') }}"></script>--}}
<script src="{{ asset('assets/js/app.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap-notify.js') }}"></script>
<script src="{{ asset('assets/ckeditor/ckeditor.js') }}"></script>
<script src="{{ asset('assets/ckeditor/adapters/jquery.js') }}"></script>

<script src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
{{--<script src="{{ asset('assets/plugins/datatables/dataTables.bootstrap4.min.js') }}"></script>--}}

<script src="{{ asset('assets/js/sweetalert2.min.js') }}"></script>
<script src="{{ asset('assets/js/select2.min.js') }}"></script>
<script src="{{ asset('assets/datetimepicker/js/bootstrap-datetimepicker.min.js') }}"></script>
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
    let more_doc_message_array = [];
    let remove_more_doc_message_array = [];
    let more_doc_msg_index = 0;
    $(document).ready(function() {
        $( '.ckeditor.editor' ).ckeditor();

        $('#loan_application_table').DataTable({
            paging: false,
            searching: false,
            "info": false,
            order: [[4, 'desc'],[5,'desc']],
            columnDefs: [
                {
                    "orderable": false,
                    "targets": [0,1,2,3,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20],
                },
            ]
        });

        $('.select2').select2();

        // $('#internal').change(function (){
        //     if (reason_auto_select_count == 0){
        //         reason_auto_select_count ++;
        //         index = $("#internal").prop('selectedIndex');
        //         $('#shown_to_customer option').eq(index).prop('selected', true);
        //     }
        // });
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

        $('.search-user').keyup(function (event) {
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

        $("#bulk_assign").click(function (event) {
            event.preventDefault();
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
                window.location.href = "{{ route('loan-applications') }}";
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
        
        $('#invoice_based_on').change(function(){
            var value = $(this).val();
            if(value == 3){
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
                confirmButtonColor: '#feb800',
                cancelButtonColor: '#d33',
                confirmButtonText: "Yes"
            }).then((result) => {
                if (result.value) {
                    window.location.href = url;
                }
            })
        });


         //put quotation validations and submit
        $('.interest_flat').keyup(function(){
            console.log($(this).val().length)
            if($(this).val().length < 1){
                $(".interest_reducing_balance").prop('disabled', false);
                $(".interest_board_rate").prop('disabled', false);
                $(".flat_fee_regardless").prop('disabled', false);
            }else{
                $(".interest_reducing_balance").prop('disabled', true);
                $(".interest_board_rate").prop('disabled', true);
                $(".flat_fee_regardless").prop('disabled', true);
            }
        });

        $('.interest_reducing_balance').keyup(function(){
            console.log($(this).val().length)
            if($(this).val().length < 1){
                $(".interest_flat").prop('disabled', false);
                $(".interest_board_rate").prop('disabled', false);
                $(".flat_fee_regardless").prop('disabled', false);
            }else{
                $(".interest_flat").prop('disabled', true);
                $(".interest_board_rate").prop('disabled', true);
                $(".flat_fee_regardless").prop('disabled', true);
            }
        });

        $('.interest_board_rate').keyup(function(){
            console.log($(this).val().length)
            if($(this).val().length < 1){
                $(".interest_flat").prop('disabled', false);
                $(".interest_reducing_balance").prop('disabled', false);
                $(".flat_fee_regardless").prop('disabled', false);
            }else{
                $(".interest_flat").prop('disabled', true);
                $(".interest_reducing_balance").prop('disabled', true);
                $(".flat_fee_regardless").prop('disabled', true);
            }
        });
        $('.flat_fee_regardless').keyup(function(){
            console.log($(this).val().length)
            if($(this).val().length < 1){
                $(".interest_flat").prop('disabled', false);
                $(".interest_reducing_balance").prop('disabled', false);
                $(".interest_board_rate").prop('disabled', false);
            }else{
                $(".interest_flat").prop('disabled', true);
                $(".interest_reducing_balance").prop('disabled', true);
                $(".interest_board_rate").prop('disabled', true);
            }
        });
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

        $('#add_more_message_desc').click(function(e){
            e.preventDefault();
             new_obj = {};
             new_obj.if_any = $('#if_any').val();
             new_obj.from = $('#from').val();
             new_obj.to = $('#from').val();
             new_obj.within_days = $('#within_days').val();
             new_obj.past_months = $('#past_months').val();
             new_obj.valid_for = $('#valid_for').val();
             new_obj.latest = $('#latest').val();
             new_obj.required_company_stamp = $('#required_company_stamp').val();
             new_obj.need_notarized = $('#need_notarized').val();
             new_obj.signature_borrower = $('#signature_borrower').val();
             new_obj.signature_borrowers_customer = $('#signature_borrowers_customer').val();
             new_obj.more_doc_reasons = $('#more_doc_reasons').val();
             new_obj.document_of = $('#document_of').val();
             new_obj.point_to_any_specific_doc = $('#point_to_any_specific_doc').val();
            more_doc_message_array.push(new_obj);
            console.log(more_doc_message_array);

            var html = "<tr index="+more_doc_msg_index+">"
            +"<td><a href='#' index='"+more_doc_msg_index+"' data-original-title='Delete'><i class='m-2 remove_more_doc_msg fa fa-trash'></i></a></td>"
            +"<td>"+new_obj.if_any+"</td>"
            +"<td>"+new_obj.from+"</td>"
            +"<td>"+new_obj.to+"</td>"
            +"<td>"+new_obj.within_days+"</td>"
            +"<td>"+new_obj.past_months+"</td>"
            +"<td>"+new_obj.valid_for+"</td>"
            +"<td>"+new_obj.latest+"</td>"
            +"<td>"+new_obj.required_company_stamp+"</td>"
            +"<td>"+new_obj.need_notarized+"</td>"
            +"<td>"+new_obj.signature_borrower+"</td>"
            +"<td>"+new_obj.signature_borrowers_customer+"</td>"
            +"<td>"+new_obj.more_doc_reasons+"</td>"
            +"<td>"+new_obj.document_of+"</td>"
            +"<td>"+new_obj.point_to_any_specific_doc+"</td>"
            +"</tr>";
            $('#more_doc_msg_table').append(html);
            more_doc_msg_index++;
            if(more_doc_message_array.length > 0){
                $('#more_doc_msg_list').show();
            }
        });
        $(document).on("click", '.remove_more_doc_msg', function(event) { 
            var index = $(this).closest('tr').attr('index');
            $(this).closest('tr').remove();
            remove_more_doc_message_array.push(index);
            // more_doc_message_array.splice(index,1);

            if(more_doc_message_array.length < 1){
                $('#more_doc_msg_list').hide();
            }
            console.log('after remove'+remove_more_doc_message_array);
        });
        $('#more_doc_request_btn').click(function(){
            if(remove_more_doc_message_array.length > 0){
                $.each(remove_more_doc_message_array, function(index, item) {
                    more_doc_message_array.splice(index,1);
                });
            }
            console.log("on submit"+more_doc_message_array);
            return false;
        });

    });

    function rejectApplication(loan_apply_id){
        reason_auto_select_count = 0;
        console.log(loan_apply_id)
        $("#reject_loan_id").val(loan_apply_id)
        $('#RejectReasonModel').modal('show');
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


