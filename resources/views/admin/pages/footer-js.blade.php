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

<script src="{{ asset('assets/js/sweetalert2.min.js') }}"></script>
<script>
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
    $(document).ready(function() {
        $( '.ckeditor.editor' ).ckeditor();

        // $('.date_picker').bootstrapMaterialDatePicker({
        //     format: 'Y-MM-DD',
        //     okButton:false,
        //     // From Today
        //     // minDate: moment(),
        //     time: false
        // });
        // $('.datetime-picker').bootstrapMaterialDatePicker({
        //     format: 'Y-MM-DD H:mm:ss',
        //     // clearButton: true,
        //     // switchOnClick:true,
        //     okButton:false,
        //     // From Today
        //     // minDate: moment(),
        // });

        $(".bulk_assign").click(function (event) {
            var SelectedList = [];
            $("input:checkbox[name=selected_application]:checked").each(function(){
                SelectedList.push($(this).val());
            });
            console.log(SelectedList)
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

    });
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


