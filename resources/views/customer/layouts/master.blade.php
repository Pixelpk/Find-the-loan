<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
        <title>Find the loan</title>
        <meta content="Responsive admin theme build on top of Bootstrap 4" name="description" />
        <meta content="Themesdesign" name="author" />
        @include('customer.pages.css')
        @livewireStyles
    </head>
    <body>
        <div id="wrapper">
            @include('customer.layouts.header')
            @include('customer.layouts.navbar')
            {{ $slot }}
        </div>
        <!-- END wrapper -->
        @include('customer.pages.modals')
        @include('customer.pages.flash-message')
        @include('customer.pages.footer-js')
    </body>
</html>
