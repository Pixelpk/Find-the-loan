<link rel="shortcut icon" href="{{ asset('assets/images/logo.png') }}">
{{--<link href="{{ asset('plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css') }}" rel="stylesheet">--}}
<!--Morris Chart CSS -->
{{--<link rel="stylesheet" href="{{ asset('plugins/morris/morris.css') }}">--}}

<link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
<link href="{{ asset('assets/css/metismenu.min.css') }}" rel="stylesheet" type="text/css">
<link href="{{ asset('assets/css/icons.css') }}" rel="stylesheet" type="text/css">
<link href="{{ asset('assets/css/style.css') }}" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="{{ asset('assets/css/sweetalert2.css') }}">

<style>
    .resize-img {
        width: 2.5em;
        height: 2.5em;
    }

    /*blinking*/
    .blinking{
        animation:blinkingText 1.2s infinite;
    }
    @keyframes blinkingText{
        0%{     color: #27b34d;    }
        49%{    color: #27b34d; }
        60%{    color: transparent; }
        99%{    color:transparent;  }
        100%{   color: #27b34d;    }
    }
    /*blinking end*/

</style>
