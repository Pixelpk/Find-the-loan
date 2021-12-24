<link rel="shortcut icon" href="{{ asset('assets/images/logo.png') }}">
<link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
<link href="{{ asset('assets/css/metismenu.min.css') }}" rel="stylesheet" type="text/css">
<link href="{{ asset('assets/css/icons.css') }}" rel="stylesheet" type="text/css">
<link href="{{ asset('assets/css/style.css?v1') }}" rel="stylesheet" type="text/css">
<link href="{{ asset('assets/plugins/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/plugins/datatables/buttons.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="{{ asset('assets/css/sweetalert2.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/jquery-ui.css') }}">
<link rel="stylesheet" href="{{ asset('assets/datetimepicker/css/bootstrap-datetimepicker.min.css') }}">
<link rel="stylesheet" href="{{ asset('toastr.min.css') }}">

<style>
    .select2-results__group{
        font-size: 1.3em !important;
    }
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

    .shake {
        animation: shake 1.2s infinite cubic-bezier(.36, .07, .19, .97) both;
        transform: translate3d(0, 0, 0);
        backface-visibility: hidden;
        perspective: 1000px;
        background-color: #2db552 !important;;
    }

    @keyframes shake {
        10%, 90% {
            transform: translate3d(-1px, 0, 0);
        }

        20%, 80% {
            transform: translate3d(2px, 0, 0);
        }

        30%, 50%, 70% {
            transform: translate3d(-4px, 0, 0);
        }

        40%, 60% {
            transform: translate3d(4px, 0, 0);
        }
    }
    /*blinking end*/

    /* sorting style */
    #sortable { list-style-type: none; margin: 0; padding: 0; width: 100%;cursor: pointer; }
    #sortable li { margin: 0 3px 3px 3px; padding: 0.4em; padding-left: 1.5em; font-size: 15px; height: 45px;color: white;background-color: #27b34d;border-radius: 5px; }
    #sortable li span { position: absolute; margin-left: -1.3em; }

    .content-page{
        min-height: 100vh; 
    }

</style>
