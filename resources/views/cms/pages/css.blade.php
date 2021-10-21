{{--<!-- Google Fonts -->--}}
{{--<link href="https://fonts.googleapis.com/css?family=Lato:100,300,400,400i,700,700i,900" rel="stylesheet">--}}
{{--<link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,700i,900" rel="stylesheet">--}}
{{--<link href="https://fonts.googleapis.com/css?family=Open+Sans:300i,400,400i,600,600i,700,700i,800" rel="stylesheet">--}}
{{--<link href="https://fonts.googleapis.com/css?family=Oleo+Script+Swash+Caps" rel="stylesheet">--}}
{{--<link href="https://fonts.googleapis.com/css?family=Lobster|Oleo+Script+Swash+Caps" rel="stylesheet">--}}
<script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
    <link
      href="https://fonts.googleapis.com/css?family=Roboto:400,500"
      rel="stylesheet"
    />

   
<script src="{{ url('/map.js') }}"></script>
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:400,500,600">


{{--<!-- LOADING FONTS AND ICONS -->--}}
{{--<link rel="stylesheet" type="text/css" href="{{ asset('assets/cms/css/pe-icon-7-stroke.css') }}">--}}
{{--<link rel="stylesheet" type="text/css" href="{{ asset('assets/cms/css/font-awesome.min.css') }}">--}}
{{-- 
<link rel="stylesheet" href="{{ asset('assets/cms/bootstrap/css/bootstrap.min.css') }}" type="text/css"> --}}
<script src="{{ asset('assets/cms/js/jquery-3.3.1.min.js') }}"></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<link rel="stylesheet" href="{{ asset('assets/cms/font-awesome/css/fontawesome-all.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/cms/css/magnific-popup.css') }}">
<link rel="stylesheet" href="{{ asset('assets/cms/css/owl.carousel.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/cms/css/style.css') }}">
<link rel="stylesheet" href="{{ asset('assets/cms/css/style01.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/sweetalert2.css') }}">
<link rel="stylesheet" href="{{ asset('toastr.min.css') }}">


<title>Find The Loan</title>
<style>
    .resize-img {
        width: 2.5em;
        height: 2.5em;
    }

</style>
{{--//Home page media query--}}
<style type="text/css">
    @media screen and (max-width: 550px) and (min-width: 300px) {
        .col-md-5.col-xl-5.text-right.align-self-center.align-items-center{
            display: flex;
            justify-content: center;
            padding-top: 50px;
        }

        .col-sm-6.col-md-6.col-xl-6.col-sm-6.col-md-6.col-xl-6{
            display: flex !important;
            justify-content: center !important;
            padding-right: 0px !important;
            padding-left: 0px !important;
        }
        .col-md-6.col-xl-6.align-self-center.align-items-center.uploadpadding.ts-fadeInUp.animated{
            padding-left: 10px !important;
        }
        .col-md-5.col-xl-5{
            padding-top: 100px;
        }
        .resrow{
            display: flex;
            flex-flow: column-reverse;
        }
        a.nav-item.nav-link.ts-scroll {
            padding: 10px;
        }
        a.btnnew1 {
            /* padding: 15px; */
        }
        /* a.btnnew2 {
            padding-top: 15px;
            padding-left: 15px;
            padding-right: 15px;
            padding-bottom: 25px;
        } */
    }

    /* NAVBAR STYLE */
    .spinner-grow{
        background: #fff;
    }
    .navbar ul li{
        /* padding: 0 0.7rem; */
        font-family: 'Poppins', sans-serif;
    }
    .navbar ul li .nav-link:hover{
        color: #3EBB60 !important;
    }
    .navbar ul li .nav-link.active {
        color: #3EBB60 !important;
    }
    .navbar .btn{
        margin-left: 0.7rem;
        margin-right: 0.7rem;
        background: #3EBB60;
        color:#fff;
    }
    .navbar .btn-h{
        margin-right: 0;
    }
    .navbar .btnnew2{
        /* margin-left: 0; */
    }
    .btn{
        background: #3EBB60;
color: #fff !important;
font-family: 'Poppins', sans-serif;
    }
    .btn:hover{
        opacity: 0.8;
    }
    /* FOOTER */
    .footer-links .social-icons{
        font-size: 1.5rem;
        color: #fff !important;
        margin-top: 0.6rem;
        margin-bottom: 0.6rem;
        display: inline-block;
    }
    .accordion-button:not(.collapsed) {
    color: #3EBB60 !important;
    background-color: #f5f5f5 !important;
}
/* FOOTER */
.contact-box__icon{
    width: 3rem;
}
footer .contact-box__info {
    font-weight: 400;
}
.footer-links li a:hover > i {
    color: #3EBB60;
}
/* ALERT */
 #cookie-img{
    width:100px
}
@media(min-width: 768px){
    .contact-box__icon{
    width: 4rem;
}
}
    @media(max-width: 800px){
        .btnnew1, .btnnew2{
            display: block;
            margin-top: 0.8rem;
            margin-bottom: 0.8rem;
        }
        .navbar .log-btn {
            /* margin-left: 0; */
        }
        .navbar .navbar-nav .nav-item .nav-link{
            border: 1px solid;
    text-align: center;
    margin-bottom: 1rem;
        }
        /* .navbar .navbar-nav{
            padding-top: 1rem;
          } */
          
    }
    @media(max-width: 533px){
    
          .navbar .navbar-nav{
            padding-left: 1.5rem;
            padding-right: 1rem;
            padding-top: 1rem;
          }
          .navbar .btn, .dropdown-menu{
        margin-left: 1.3rem;
        margin-right: 1.3rem;
    }
    .navbar .btn-h{
        margin-right: 0;
    }
    .dropdown-toggle, .dropdown-menu{
        width: -webkit-fill-available;
    }
    footer .contact-box{
        padding-left: 1rem;
    }
    footer .contact-box__info {
              padding-left: 0.8rem;
}
#cookie-img{
    width:100px;
    height: 100px;
}
    }
/* HOME CSS */


</style>
