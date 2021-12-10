<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <title>Find the loan</title>
    <meta content="Responsive admin theme build on top of Bootstrap 4" name="description" />
    <meta content="Themesdesign" name="author" />
    @include('admin.pages.css')
    @livewireStyles
</head>
<body>
<div id="wrapper">
    @include('customer.layouts.header')
    @include('customer.layouts.navbar')
    {{ $slot }}
</div>
<!-- END wrapper -->
@include('admin.pages.modals')
@include('admin.pages.footer-js')
@livewireScripts
<script>
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

    // window.livewire.on('clearInput', param => {
    //     let field_class = param['class'];
    //     alert(field_class);
    //     document.getElementsByClassName("replied_docs").val() = "";

    // });
</script>
</body>
</html>
