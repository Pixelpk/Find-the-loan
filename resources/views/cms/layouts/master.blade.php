<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="author" content="ThemeStarz">
    
    @include('cms.pages.css')
    @livewireStyles
</head>
<body data-spy="scroll" data-target=".navbar" class="has-loading-screen">
<div class="ts-page-wrapper" id="page-top">
@include('cms.pages.header')
    {{ $slot }}
    @include('cms.pages.footer')
</div>
<!--end page-->
@include('cms.pages.footer-js')
<script
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAs45RA1WjaLHCScHiERJ0v2c3I3R6ddT4&callback=initAutocomplete&libraries=places&v=weekly"
      async
    ></script>
@livewireScripts
<script>
window.livewire.on('alert', param => {
    toastr.success(param['message'])
});
window.livewire.on('danger', param => {
    toastr.error(param['message'])
});
</script>

</body>
</html>
