<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('page-title') - {{ setting('app_name') }}</title>

    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="{{ asset('frontend/images/icons/apple-touch-icon-144x144.png') }}" />
    <link rel="apple-touch-icon-precomposed" sizes="152x152" href="{{ asset('frontend/images/icons/apple-touch-icon-152x152.png') }}" />

    <!-- CSS Start -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/vendor/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/fonts/font-awesome-4.7.0/css/font-awesome.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/vendor/animate/animate.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/vendor/css-hamburgers/hamburgers.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/vendor/animsition/css/animsition.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/vendor/slick/slick.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/util.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/main.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/theme.css') }}">
    <!-- CSS END -->

</head>
<body class="animsition">

<!-- First Fold Start -->
<section class="firstFold">
    <!-- Header -->
    <header class="header">
        <!-- Header desktop -->
        <div class="container-menu-header">
            <div class="topbar">
                <!-- Logo -->
                <a href="{{ route('frontend.index') }}" class="logo">
                    <img src="{{ asset('frontend/img/logo.png') }}" alt="{{ setting('app_name') }}" title="{{ setting('app_name') }}">
                </a>

                <div class="email">
                    <!-- Search -->
                    <form>
                        <div class="pos-relative bo11 of-hidden">
                            <input class="s-text7 size16 p-l-23 p-r-50" type="search" name="search-product" placeholder="Search" autocomplete="off">
                            <button class="flex-c-m size5 ab-r-m" type="submit">
                                <i class="fs-20 fa fa-search" aria-hidden="true"></i>
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Header Icon -->
                <div class="header-icons">
                    <!-- My Account Start -->
                    <div class="header-wrapicon2 my-account">
                        <span class="js-show-header-dropdown dropdown-toggle">
                            <img src="{{ asset('frontend/img/userIcon.png') }}" class="header-icon1 " alt="ico-myaccount">
                            <span class="p-l-5"> My Account</span>
                        </span>
                        <!-- My Account Notification -->
                        <div class="account-option header-dropdown">
                            <ul class="">
                                <li class=""><a href="#">My Settings</a></li>
                                <li class=""><a href="#">My Profile</a></li>
                                <li class=""><a href="#">Sign Out</a></li>
                            </ul>
                        </div>
                    </div>

                    <span class="linedivide1"></span>

                    <div class="cart-info">
                        <img src="{{ asset('frontend/img/cart.png') }}" class="header-icon1 js-show-header-dropdown" alt="ICON">
                        <span class="header-icons-noti">0</span>
                        <!-- Header cart notification -->
                        <div class="header-cart header-dropdown">
                            <ul class="header-cart-wrapitem">
                                <li class="header-cart-item">
                                    <div class="header-cart-item-img">
                                        <img src="{{ asset('frontend/images/item-cart-01.jpg') }}" alt="IMG">
                                    </div>

                                    <div class="header-cart-item-txt">
                                        <a href="#" class="header-cart-item-name">
                                            Driving Exam Fees
                                        </a>

                                        <span class="header-cart-item-info">
												<i class="fa fa-inr" aria-hidden="true"></i> 1000.00
											</span>
                                    </div>
                                </li>
                                <li class="header-cart-item">
                                    <div class="header-cart-item-img">
                                        <img src="{{ asset('frontend/images/item-cart-03.jpg') }}" alt="IMG">
                                    </div>

                                    <div class="header-cart-item-txt">
                                        <a href="#" class="header-cart-item-name">
                                            House Maid Exam Fees
                                        </a>

                                        <span class="header-cart-item-info">
												<i class="fa fa-inr" aria-hidden="true"></i> 850.00
											</span>
                                    </div>
                                </li>
                            </ul>

                            <div class="header-cart-total">
                                Total: <i class="fa fa-inr" aria-hidden="true"></i> 1850.00
                            </div>

                            <div class="header-cart-buttons">
                                <div class="header-cart-wrapbtn">
                                    <!-- Button -->
                                    <a href="#" class="flex-c-m size1 bg1 bo-rad-20 hov1 s-text1 trans-0-4">
                                        View Cart
                                    </a>
                                </div>

                                <div class="header-cart-wrapbtn">
                                    <!-- Button -->
                                    <a href="#" class="flex-c-m size1 bg1 bo-rad-20 hov1 s-text1 trans-0-4">
                                        Check Out
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="wrap_header">
                <div class="wrap_menu">
                    <nav class="menu" id="primary_menu">
                        <ul class="main_menu">
                            <li><a href="{{ route('frontend.index') }}">Home</a></li>
                            <li><a href="#">About</a></li>
                            <li>
                                <a href="#">Exams</a>
                                <ul class="sub_menu">
                                    <li><a href="#">Online</a></li>
                                    <li><a href="#">Offline</a></li>
                                    <li><a href="#">Re-Exam</a></li>
                                </ul>
                            </li>
                            <li><a href="#">Certification</a></li>
                            <li><a href="#">Services</a></li>
                            <li><a href="#">Contact</a></li>
                        </ul>
                    </nav>
                </div>
                <a class="btn btn-primary test-now" href="#" role="button">Test now</a>
            </div>
        </div>

        <!-- Header Mobile -->
        <div class="wrap_header_mobile">
            <!-- Button show menu -->
            <div class="btn-show-menu">

                <div class="btn-show-menu-mobile hamburger hamburger--squeeze">
						<span class="hamburger-box">
							<span class="hamburger-inner"></span>
						</span>
                </div>
            </div>
        </div>
    </header>
</section>
<!-- First Fold End -->


<!-- Slide1 -->
<section class="slide1">
    <div class="wrap-slick1">
        <div class="slick1">
            <div class="item-slick1 item1-slick1" style="background-image: url({{ asset('frontend/img/banner-01.jpg') }});">
                <div class="wrap-content-slide1 sizefull flex-col-c-m">
						<span class="caption1-slide1 m-text1 animated visible-false" data-appear="fadeInDown">
							Just like the real thing. More effective than the driving manual.
						</span>

                    <h2 class="caption2-slide1 animated visible-false m-b-37" data-appear="fadeInUp">
                        Get your Driving Exam Certificate
                    </h2>

                    <div class="wrap-btn-slide1 w-size1 animated visible-false" data-appear="zoomIn">
                        <!-- Button -->
                        <a href="#" class="flex-c-m size2 bo-rad-23 s-text2 bgwhite hov1 trans-0-4">
                            get started now
                        </a>
                    </div>
                </div>
            </div>

            <div class="item-slick1 item1-slick1" style="background-image: url({{ asset('frontend/img/banner-02.jpg') }});">
                <div class="wrap-content-slide1 sizefull flex-col-c-m">
						<span class="caption1-slide1 m-text1 animated visible-false" data-appear="fadeInDown">
							Just like the real thing. More effective than the driving manual.
						</span>

                    <h2 class="caption2-slide1 animated visible-false m-b-37" data-appear="fadeInUp">
                        Get your Driving Exam Certificate
                    </h2>

                    <div class="wrap-btn-slide1 w-size1 animated visible-false" data-appear="zoomIn">
                        <!-- Button -->
                        <a href="#" class="flex-c-m size2 bo-rad-23 s-text2 bgwhite hov1 trans-0-4">
                            get started now
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<!-- Popular Exam -->
<section class="popularExam bgwhite p-t-40 p-b-40">
    <div class="container">
        <div class="row p-b-40">
            <div class="col-sm-12">
                <div class="titleBlock">
                    <h2>Popular Exams</h2>
                    <p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. </p>
                </div>
            </div>
        </div>
        <div class="row p-b-40">
            <div class="col-sm-10 col-md-8 col-lg-4 m-l-r-auto">
                <div class="block2">
                    <div class="block2-img wrap-pic-w of-hidden pos-relative">
                        <img src="{{ asset('frontend/img/exam-01.jpg') }}" alt="IMG-BENNER">
                        <div class="block2-txt p-t-20">
                            <a href="#" class="block2-name dis-block s-text3 p-b-5">Driving Exams Certificate</a>
                            <span class="certificate"><img src="{{ asset('frontend/img/certificate.jpg') }}" alt=""></span>
                        </div>

                        <div class="block2-overlay trans-0-4">
                            <div class="block2-btn-addcart w-size1 trans-0-4">
                                <!-- Button -->
                                <button class="flex-c-m size1 bg4 bo-rad-23 hov1 s-text1 trans-0-4">Test Now</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-10 col-md-8 col-lg-4 m-l-r-auto">
                <div class="block2">
                    <div class="block2-img wrap-pic-w of-hidden pos-relative">
                        <img src="{{ asset('frontend/img/exam-02.jpg') }}" alt="IMG-BENNER">
                        <div class="block2-txt p-t-20">
                            <a href="#" class="block2-name dis-block s-text3 p-b-5">House Maid Exams Certificate</a>
                            <span class="certificate"><img src="{{ asset('frontend/img/certificate.jpg') }}" alt=""></span>
                        </div>

                        <div class="block2-overlay trans-0-4">
                            <div class="block2-btn-addcart w-size1 trans-0-4">
                                <!-- Button -->
                                <button class="flex-c-m size1 bg4 bo-rad-23 hov1 s-text1 trans-0-4">Test Now</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-10 col-md-8 col-lg-4 m-l-r-auto">
                <div class="block2">
                    <div class="block2-img wrap-pic-w of-hidden pos-relative">
                        <img src="{{ asset('frontend/img/exam-03.jpg') }}" alt="IMG-BENNER">
                        <div class="block2-txt p-t-20">
                            <a href="#" class="block2-name dis-block s-text3 p-b-5">Personal Assistant Exams Certificate</a>
                            <span class="certificate"><img src="{{ asset('frontend/img/certificate.jpg') }}" alt=""></span>
                        </div>

                        <div class="block2-overlay trans-0-4">
                            <div class="block2-btn-addcart w-size1 trans-0-4">
                                <!-- Button -->
                                <button class="flex-c-m size1 bg4 bo-rad-23 hov1 s-text1 trans-0-4">Test Now</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row text-center">
            <div class="col-sm-12">
                <a class="btn btn-primary greenBtn" href="#" role="button">more Exams</a>
            </div>
        </div>
    </div>
</section>


<!-- More Exams -->
<section class="moreExams bgwhite p-t-45 p-b-50">
    <div class="container">
        <!-- Slide2 -->
        <div class="wrap-slick2">
            <div class="slick2">

                <div class="item-slick2 p-l-15 p-r-15">
                    <!-- Block2 -->
                    <div class="block2">
                        <a href="#">
                            <div class="block2-img wrap-pic-w of-hidden pos-relative">
                                <img src="{{ asset('frontend/img/more-exam-01.jpg') }}" alt="IMG-PRODUCT">

                                <div class="block2-overlay trans-0-4">
                                    <h4>House keeping</h4>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>

                <div class="item-slick2 p-l-15 p-r-15">
                    <!-- Block2 -->
                    <div class="block2">
                        <a href="#">
                            <div class="block2-img wrap-pic-w of-hidden pos-relative">
                                <img src="{{ asset('frontend/img/more-exam-02.jpg') }}" alt="IMG-PRODUCT">

                                <div class="block2-overlay trans-0-4">
                                    <h4>Driving</h4>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>

                <div class="item-slick2 p-l-15 p-r-15">
                    <!-- Block2 -->
                    <div class="block2">
                        <a href="#">
                            <div class="block2-img wrap-pic-w of-hidden pos-relative">
                                <img src="{{ asset('frontend/img/more-exam-03.jpg') }}" alt="IMG-PRODUCT">
                                <div class="block2-overlay trans-0-4">
                                    <h4>Cooks</h4>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>

                <div class="item-slick2 p-l-15 p-r-15">
                    <!-- Block2 -->
                    <div class="block2">
                        <a href="#">
                            <div class="block2-img wrap-pic-w of-hidden pos-relative">
                                <img src="{{ asset('frontend/img/more-exam-04.jpg') }}" alt="IMG-PRODUCT">

                                <div class="block2-overlay trans-0-4">
                                    <h4>Child care</h4>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>

            </div>
        </div>

    </div>
</section>


<!-- Information Area -->
<section class="infoArea bgwhite p-b-65">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-sm-10 col-md-4 p-b-30 m-l-r-auto">
                <ul class="list-group text-center">
                    <li class="list-group-item">
                        <div class="iconArea">
                            <img src="{{ asset('frontend/img/icon-01.png') }}" alt="">
                        </div>
                        <h4>Free Online Exams & Certifications</h4>
                        <p>Choose what you'd like to learn from our extensive subscription library.</p>
                    </li>
                    <li class="list-group-item">
                        <div class="iconArea">
                            <img src="{{ asset('frontend/img/icon-02.png') }}" alt="">
                        </div>
                        <h4>Dynamic Resume</h4>
                        <p>Choose what you'd like to learn from our extensive subscription library.</p>
                    </li>
                    <li class="list-group-item">
                        <div class="iconArea">
                            <img src="{{ asset('frontend/img/icon-03.png') }}" alt="">
                        </div>
                        <h4>Get Hired</h4>
                        <p>Choose what you'd like to learn from our extensive subscription library.</p>
                    </li>
                </ul>
            </div>

            <div class="col-sm-10 col-md-8 p-b-30 m-l-r-auto">
                <!-- Block3 -->
                <div class="block3 p-l-60">
                    <div class="block3-txt p-t-14">
                        <div class="titleBlock">
                            <h2>Why choose us</h2>
                        </div>
                        <div class="content-area p-b-40">
                            <p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source.</p>
                        </div>
                        <a class="btn btn-primary greenBtn" href="#" role="button">learn more</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<!-- Testimonial -->
<section class="testimonialArea">
    <div class="container">

        <div class="titleBlock">
            <h2>What our users are saying</h2>
        </div>

        <div class="testimonial-slider">
            <div class="slide">
                <div class="user-photo">
                    <img src="{{ asset('frontend/img/user.png') }}" alt="">
                </div>
                <div class="slide-text">
                    <h5>Sai Jayanth Peravali 1</h5>
                    <p>These sample tests really do help you to stay updated in terms of the knowledge required and practical skills that will come handy, which in turn builds confidence.</p>
                </div>
            </div>

            <div class="slide">
                <div class="user-photo">
                    <img src="{{ asset('frontend/img/user.png') }}" alt="">
                </div>
                <div class="slide-text">
                    <h5>Sai Jayanth Peravali 2</h5>
                    <p>These sample tests really do help you to stay updated in terms of the knowledge required and practical skills that will come handy, which in turn builds confidence.</p>
                </div>
            </div>

            <div class="slide">
                <div class="user-photo">
                    <img src="{{ asset('frontend/img/user.png') }}" alt="">
                </div>
                <div class="slide-text">
                    <h5>Sai Jayanth Peravali 3</h5>
                    <p>These sample tests really do help you to stay updated in terms of the knowledge required and practical skills that will come handy, which in turn builds confidence.</p>
                </div>
            </div>
        </div>
    </div>
</section>


<!-- Companies List Start -->
<section class="companiesList bgwhite p-t-45 p-b-43">
    <div class="container text-center">
        <div class="row">
            <div class="col-sm-12">
                <h3 class="m-b-40">Trusted by companies of all sizes</h3>

                <ul>
                    <li><img src="{{ asset('frontend/img/c-1.png') }}" alt=""></li>
                    <li><img src="{{ asset('frontend/img/c-2.png') }}" alt=""></li>
                    <li><img src="{{ asset('frontend/img/c-3.png') }}" alt=""></li>
                    <li><img src="{{ asset('frontend/img/c-4.png') }}" alt=""></li>
                    <li><img src="{{ asset('frontend/img/c-5.png') }}" alt=""></li>
                    <li><img src="{{ asset('frontend/img/c-6.png') }}" alt=""></li>
                    <li><img src="{{ asset('frontend/img/c-7.png') }}" alt=""></li>
                </ul>
            </div>
        </div>
    </div>
</section>


<!-- News Letter Start -->
<section class="newsletterSection p-t-65 p-b-65">
    <div class="container text-center">
        <div class="row">
            <div class="col-sm-12">
                <h2>Subscribe us for future updates</h2>
                <p>It is a long establisContrary to popular belief, Lorem Ipsum is not simply random text. hed fact that a reader will be distracted by the readable content of a page when looking at its layout.</p>
                <div class="newsletter-form p-t-20">
                    <form>
                        <div class="form-group">
                            <input type="text" class="form-control" name="email-newsletter" id="email-newsletter" placeholder="Enter your email id">
                        </div>
                        <button type="submit" class="btn btn-primary">Subscribe Now</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Footer -->
<footer class="page-footer p-t-45 p-b-25">
    <div class="container">
        <div class="row footer-top p-b-30">
            <div class="col-md-5">
                <div class="respon3">
                    <h4 class="s-text12 p-b-30">
                        <a href="{{ route('frontend.index') }}" class="logoFooter"><img src="{{ asset('frontend/img/footerLogo.png') }}" alt="" class="img-fluid"></a>
                    </h4>

                    <div class="social-media">
                        <div class="flex-m">
                            <a href="#" class="fs-18 color1"><i class="fa fa-facebook"></i></a>
                            <a href="#" class="fs-18 color1"><i class="fa fa-twitter"></i></a>
                            <a href="#" class="fs-18 color1"><i class="fa fa-linkedin"></i></a>
                            <a href="#" class="fs-18 color1"><i class="fa fa-google-plus"></i></a>
                            <a href="#" class="fs-18 color1"><i class="fa fa-youtube"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 offset-md-1">
                <div class="flex-w footer-menu">
                    <div class="w-size5 p-t-30 p-l-15 p-r-15 respon4">
                        <h4>COMPANY</h4>
                        <ul>
                            <li><a href="#">About</a></li>
                            <li><a href="#">Blog</a></li>
                            <li><a href="#">Career</a></li>
                            <li><a href="#">Become an Instructor</a></li>
                        </ul>
                    </div>

                    <div class="w-size5 p-t-30 p-l-15 p-r-15 respon4">
                        <h4>Products</h4>
                        <ul>
                            <li><a href="#">Our Plans</a></li>
                            <li><a href="#">Free Trial</a></li>
                            <li><a href="#">Academic Solutions</a></li>
                            <li><a href="#">Business Solutions</a></li>
                            <li><a href="#">Government Solutions</a></li>
                        </ul>
                    </div>

                    <div class="w-size5 p-t-30 p-l-15 p-r-15 respon4">
                        <h4>Support</h4>
                        <ul>
                            <li><a href="#">Support</a></li>
                            <li><a href="#">Contact Us</a></li>
                            <li><a href="#">System Requirements</a></li>
                            <li><a href="#">Register Activation Key</a></li>
                            <li><a href="#">Site Feedback</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <hr>
            </div>
        </div>

        <div class="row">
            <div class="t-center p-l-15 p-r-15 w-full">
                <div class="copyright-info">
                    <p>&copy; 2018 All rights reserved.</p>
                    <ul class="nav justify-content-center">
                        <li>
                            <a href="#">Site Map</a>
                        </li>
                        <li>
                            <a href="#">Privacy Policy</a>
                        </li>
                        <li>
                            <a href="#">Cookie Policy</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</footer>

<!-- Back to top -->
<div class="btn-back-to-top bg0-hov" id="myBtn">
		<span class="symbol-btn-back-to-top">
			<i class="fa fa-angle-double-up" aria-hidden="true"></i>
		</span>
</div>

<!-- JS Libraries -->
<script type="text/javascript" src="{{ asset('frontend/vendor/jquery/jquery-3.2.1.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('frontend/vendor/animsition/js/animsition.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('frontend/vendor/bootstrap/js/popper.js') }}"></script>
<script type="text/javascript" src="{{ asset('frontend/vendor/bootstrap/js/bootstrap.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('frontend/vendor/slick/slick.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('frontend/js/slick-custom.js') }}"></script>
<script src="{{ asset('frontend/js/app.js') }}"></script>
<script src="{{ asset('frontend/js/main.js') }}"></script>

</body>
</html>