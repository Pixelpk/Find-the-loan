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

<!--Google map-->

<script>
    var latitude = 34.038405;
    var longitude = -117.946944;
    var markerImage = "{{ asset('assets/cms/img/map-marker.png') }}";
    var mapElement = "map";
    var mapStyle = [{"featureType":"administrative","elementType":"labels.text.fill","stylers":[{"color":"#444444"}]},{"featureType":"landscape","elementType":"all","stylers":[{"color":"#f2f2f2"}]},{"featureType":"poi","elementType":"all","stylers":[{"visibility":"off"}]},{"featureType":"poi","elementType":"labels.text","stylers":[{"visibility":"off"}]},{"featureType":"road","elementType":"all","stylers":[{"saturation":-100},{"lightness":45}]},{"featureType":"road.highway","elementType":"all","stylers":[{"visibility":"simplified"}]},{"featureType":"road.arterial","elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"transit","elementType":"all","stylers":[{"visibility":"off"}]},{"featureType":"water","elementType":"all","stylers":[{"color":"#dbdbdb"},{"visibility":"on"}]}];
    google.maps.event.addDomListener(window, 'load', simpleMap(latitude, longitude, markerImage, mapStyle, mapElement));


</script>



