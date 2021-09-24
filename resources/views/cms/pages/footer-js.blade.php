<script>
    if( document.getElementsByClassName("ts-full-screen").length ) {
        document.getElementsByClassName("ts-full-screen")[0].style.height = window.innerHeight + "px";
    }
</script>
<script src="{{ asset('assets/cms/js/jquery-3.3.1.min.js') }}"></script>

<script src="{{ asset('assets/cms/js/popper.min.js') }}"></script>
<script src="{{ asset('assets/cms/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/cms/js/imagesloaded.pkgd.min.js') }}"></script>
<script src="http://maps.google.com/maps/api/js?key=AIzaSyBEDfNcQRmKQEyulDN8nGWjLYPm8s4YB58"></script>
<script src="{{ asset('assets/cms/js/isInViewport.jquery.js') }}"></script>
<script src="{{ asset('assets/cms/js/jquery.magnific-popup.min.js') }}"></script>
<script src="{{ asset('assets/cms/js/owl.carousel.min.js') }}"></script>
<script src="{{ asset('assets/cms/js/scrolla.jquery.min.js') }}"></script>
<script src="{{ asset('assets/cms/js/jquery.validate.min.js') }}"></script>
<script src="{{ asset('assets/cms/js/jquery-validate.bootstrap-tooltip.min.js') }}"></script>
<script src="{{ asset('assets/cms/js/custom.js') }}"></script>
<script src="{{ asset('assets/js/sweetalert2.min.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap-notify.js') }}"></script>
<script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
<!--Google map-->

<script>
    var latitude = 34.038405;
    var longitude = -117.946944;
    var markerImage = "{{ asset('assets/cms/img/map-marker.png') }}";
    var mapElement = "map";
    var mapStyle = [{"featureType":"administrative","elementType":"labels.text.fill","stylers":[{"color":"#444444"}]},{"featureType":"landscape","elementType":"all","stylers":[{"color":"#f2f2f2"}]},{"featureType":"poi","elementType":"all","stylers":[{"visibility":"off"}]},{"featureType":"poi","elementType":"labels.text","stylers":[{"visibility":"off"}]},{"featureType":"road","elementType":"all","stylers":[{"saturation":-100},{"lightness":45}]},{"featureType":"road.highway","elementType":"all","stylers":[{"visibility":"simplified"}]},{"featureType":"road.arterial","elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"transit","elementType":"all","stylers":[{"visibility":"off"}]},{"featureType":"water","elementType":"all","stylers":[{"color":"#dbdbdb"},{"visibility":"on"}]}];
    google.maps.event.addDomListener(window, 'load', simpleMap(latitude, longitude, markerImage, mapStyle, mapElement));


</script>
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
<script>
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


