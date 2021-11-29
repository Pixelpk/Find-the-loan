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
    @include('admin.pages.header')
    @include('customer.layouts.navbar')
    {{ $slot }}
</div>
<!-- END wrapper -->
@include('admin.pages.modals')
@include('admin.pages.footer-js')
@livewireScripts
</body>
</html>
