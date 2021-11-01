<link rel="shortcut icon" href="{{ asset('assets/images/logo.png') }}">
{{--<link href="{{ asset('plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css') }}" rel="stylesheet">--}}
<!--Morris Chart CSS -->
{{--<link rel="stylesheet" href="{{ asset('plugins/morris/morris.css') }}">--}}

<link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
<link href="{{ asset('assets/css/metismenu.min.css') }}" rel="stylesheet" type="text/css">
<link href="{{ asset('assets/css/icons.css') }}" rel="stylesheet" type="text/css">
<link href="{{ asset('assets/css/style.css?v1') }}" rel="stylesheet" type="text/css">
<link href="{{ asset('assets/plugins/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
{{--<link href="{{ asset('assets/plugins/datatables/buttons.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />--}}

<link rel="stylesheet" href="{{ asset('assets/css/sweetalert2.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/selectize.bootstrap4.css') }}">
<link rel="stylesheet" href="{{ asset('assets/datetimepicker/css/bootstrap-datetimepicker.min.css') }}">


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
    /*blinking end*/

    /*start autocomplete*/
    .autocomplete-items {
        position: absolute;
        border: 1px solid #d4d4d4;
        border-bottom: none;
        border-top: none;
        z-index: 99;
        /*position the autocomplete items to be the same width as the container:*/
        top: 100%;
        left: 16px;
        right: 14px;
    }

    .search-link {
        display: block;
        padding: 10px;
        cursor: pointer;
        background-color: #fff;
        border-bottom: 1px solid #d4d4d4;
    }

    .autocomplete-items div:hover {
        /*when hovering an item:*/
        background-color: #e9e9e9;
    }

    .autocomplete-active {
        /*when navigating through the items using the arrow keys:*/
        background-color: DodgerBlue !important;
        color: #ffffff;
    }
    /*end autocomplete*/

/* SUMMRY NAV */
.sum-nav li{
    margin-left: 1rem;
}

</style>
