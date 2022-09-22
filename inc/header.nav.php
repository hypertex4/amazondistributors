<?php
include_once('controllers/config/database.php');
include_once('controllers/classes/Customer.class.php');

$db = new Database();
$connection = $db->connect();
$user = new Customer($connection);

?>
<!DOCTYPE html>
<html class="no-js" lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Amazon Distributors | Logistics Best Solution | Delivery</title>
    <meta name="description" content="Best Logistics Service in Lagos | Logistics Best Solution | Delivery">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="manifest" href="">
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.png">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="assets/css/animate.css">
    <link rel="stylesheet" href="assets/css/magnific-popup.css">
    <link rel="stylesheet" href="assets/css/all.min.css">
    <link rel="stylesheet" href="assets/css/font.css">
    <link rel="stylesheet" href="assets/css/metisMenu.css">
    <link rel="stylesheet" href="assets/css/nice-select.css">
    <link rel="stylesheet" href="assets/css/spacing.css">
    <link rel="stylesheet" href="assets/css/main.css">
    <link rel="stylesheet" href="assets/js/vendor/pnotify/pnotify.custom.css">
    <link rel="stylesheet" href="assets/js/vendor/jquery-confirm/jquery-confirm.min.css">
    <style>
        form .error {color: #e74c3c;border-color: #e74c3c !important;}
        form label.error{font-size: 0.7rem;}
    </style>
</head>
<body>
<div id="preloader">
    <div class="preloader">
        <span></span>
        <span></span>
    </div>
</div>
<header>
    <div id="hideshow-sticky-menu">
        <div id="theme-menu-three" class="main-header-area menu-style-3 pt-20 pb-10">
            <div class="container-fluid">
                <div class="row align-items-center justify-content-between">
                    <div class="col-xl-3 col-lg-2 col-6">
                        <div class="logo-area d-flex align-items-center justify-content-between">
                            <div class="logo-img">
                                <a href="./"><img class="img-fluid" src="assets/img/logo/header_logo_one.png" alt=""></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-5 col-lg-9 text-start d-none d-lg-inline-block">
                        <nav id="topheader" class="navbar navbar-expand-lg">
                            <div class="nav-container">
                                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                                    <ul class="navbar-nav list-style-none">
                                        <li class="nav-item"><a class="nav-link" href="./" role="button" aria-expanded="false">Home</a></li>
                                        <li class="nav-item"><a class="nav-link" href="about-us" role="button" aria-expanded="false">About Us</a></li>
                                        <li class="nav-item"><a class="nav-link" href="services" role="button" aria-expanded="false">Our Services</a></li>
                                        <li class="nav-item"><a class="nav-link" href="contact-us" role="button" aria-expanded="false">Contact Us</a></li>
                                    </ul>
                                </div>
                            </div>
                        </nav>
                    </div>
                    <div class="col-xl-4 col-lg-1 col-6">
                        <div class="right-nav d-flex align-items-center justify-content-end">
                            <ul class="list-style-none right-btn d-flex align-items-center">
                                <li>
                                    <div class="call-to d-flex align-items-center">
                                        <a class="link-dark d-flex align-items-center" href="tel:08078191641">
                                            <img src="assets/img/icon/phone-1.svg" alt="Phone Icon">
                                            <div class="call-text">
                                                <span>call now</span>
                                                <h4 class="number">08078191641</h4>
                                            </div>
                                        </a>
                                    </div>
                                </li>
                                <li><a class="theme_btn theme_btn_border style-2b d-none d-lg-inline-block" href="ship-request">Ship Now</a></li>
                            </ul>
                            <div class="hamburger-menu d-md-inline-block d-lg-none text-right ml-15">
                                <a href="javascript:void(0);"><i class="far fa-bars"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
<!-- slide-bar start -->
<aside class="slide-bar">
    <div class="close-mobile-menu">
        <a href="javascript:void(0);"><i class="fas fa-times"></i></a>
    </div>
    <nav class="side-mobile-menu">
        <ul id="mobile-menu-active">
            <li><a href="./">Home</a></li>
            <li><a href="about-us">About</a></li>
            <li><a href="services">Our Services</a></li>
            <li><a href="contact-us">Contacts Us</a></li>
            <li><a href="ship-request">Ship Now</a></li>
        </ul>
    </nav>
</aside>
<div class="body-overlay"></div>
<!-- slide-bar end -->