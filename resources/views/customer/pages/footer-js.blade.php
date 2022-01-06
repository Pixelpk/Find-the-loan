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
@livewireScripts


{{-- Hide Quotation No Longer Required Modal--}}
<script type="text/javascript">
    window.livewire.on('alert', () => {
        // $('#exampleModal').modal('hide');
        $(".modal-backdrop").remove();
    });
</script>

<script type="text/javascript">

    $(document).ready(function(){

        $(".mdi-arrow-left").click(function(){
            $('.mdi-arrow-right').removeClass('d-none');
            $('.mdi-arrow-left').addClass('d-none');

        });

        $(".mdi-arrow-right").click(function(){
            $('.mdi-arrow-left').removeClass('d-none');
            $('.mdi-arrow-right').addClass('d-none');

        });

    });

</script>

<script>
    let todayDate = new Date();
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
<script>
    $('.datetime-picker').datetimepicker({
        minuteStep:5,
        weekStart: 0,
    });
    $('.date-picker').datetimepicker({
        minView: 2,
        format: 'yyyy-mm-dd',
        pickTime:false
    });

    window.livewire.on('alert', param => {
        toastr.options = {
        "positionClass": "toast-top-right",
        }
        toastr.success(param['message'])
    });
    window.livewire.on('danger', param => {
        toastr.options = {
        "positionClass": "toast-top-right",
        }
        toastr.error(param['message'])
    });


</script>


