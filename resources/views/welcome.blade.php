@extends('layouts.app')

@section('contents')
    <div class="nk-wrap">
        <header class="nk-header page-header is-transparent is-sticky is-shrink" id="header">
            <!-- Header @s -->
            {{--<div class="header-main">--}}
                {{--<div class="header-container container">--}}
                    {{--<div class="header-wrap">--}}
                        {{--<!-- Logo @s -->--}}
                        {{--<div class="header-logo logo">--}}
                            {{--<a href="./" class="logo-link">--}}
                                {{--<img class="logo-dark" src="/images/logo.png" srcset="images/logo2x.png 2x" alt="logo">--}}
                                {{--<img class="logo-light" src="/images/logo-full-white.png" srcset="images/logo-full-white2x.png 2x" alt="logo">--}}
                            {{--</a>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div><!-- .header-main @e -->--}}

            <!-- Banner @s -->
            <div class="header-banner bg-theme-grad">
                <div class="nk-banner">
                    <div class="banner banner-fs banner-single banner-gap-b2">
                        <div class="banner-wrap">
                            <div class="container">
                                <div class="row align-items-center justify-content-center">
                                    <div class="col-lg-5 order-lg-last">
                                        <div class="banner-gfx banner-gfx-re-s1">
                                            <div class="row align-items-center justify-content-center">
                                                <img style="width: 30em;" src="/images/maharlika-logo-white.png" alt="Maharlika Coin">
                                            </div>
                                        </div>
                                    </div><!-- .col -->
                                    <div class="col-lg-7 col-sm-10 text-center text-lg-left">
                                        <div class="banner-caption cpn tc-light">
                                            <div class="cpn-head">
                                                <h1 class="title">
                                                    Decentralizing<br>The World's Most Basic Resources through a
                                                    <span class="font-weight-bold">Shared Resources Economy</span>
                                                </h1>
                                            </div>
                                            <div class="cpn-text">
                                                <p>The <span class="font-weight-bolder">Maharlika Coin</span> was created and designed to bring assets and
                                                    basic resources together for the benefit of humanity and world peace.</p>
                                            </div>
                                            <div class="cpn-action">
                                                <div class="cpn-btns">
                                                    <a class="btn btn-grad" href="#">Login to your Wallet</a>
                                                </div>
                                                <ul class="cpn-links">
                                                    <li><a class="link" href="#">Create your Wallet</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div><!-- .col -->
                                </div><!-- .row -->
                            </div>
                        </div>
                    </div>
                </div><!-- .nk-banner -->
                <div class="nk-ovm mask-a shape-a"></div>

                <!-- Place Particle Js -->
                <div id="particles-bg" class="particles-container particles-bg"></div>
            </div>
            <!-- .header-banner @e -->
        </header>

        <main class="nk-pages">
            <!-- // -->
            <section class="section bg-light section-l section-about" id="about">

                <div class="container">
                    <!-- Block @s -->
                    <div class="nk-block nk-block-about">
                        <div class="row align-items-center gutter-vr-30px pdb-l">
                            <div class="col-lg-6">
                                <div class="nk-block-text">
                                    <h2 class="title"><span class="font-weight-lighter">About</span> The Maharlika Coin</h2>
                                    <p>Deployed by the <strong>Formula Green Foundation (FGF),</strong>
                                        The Maharlika Coin (MHLK) was created as a mode of trade used to fully develop a
                                        “Shared Resources Economy.” FGF believes that the most critical resources for humanity,
                                        such as energy, water, food, shelter, and livelihood, should be shared through the best of
                                        human capital, starting with the development of fusion energy and the availability of basic water.
                                        Backed by global resources, MHLK will be accessible to millions of people with the ability
                                        to transact and utilize the coin on our growing ecosystem built on partnerships worldwide.
                                </div>
                            </div>
                            <div class="col-lg-6">
                                {{--<div class="nk-block-video">--}}
                                    {{--<img src="images/video/a.png" alt="video">--}}
                                    {{--<a href="https://www.youtube.com/watch?v=SSo_EIwHSd4" class="nk-block-video-play video-popup btn-play btn-play-light"><em class="fas fa-play"></em></a>--}}
                                {{--</div>--}}
                            </div>
                        </div>
                    </div><!-- .block @e -->
                    <!-- Section Head @s -->
                    {{--<div class="section-head">--}}
                        {{--<h2 class="title title-lg">Key features of Maharlika Coin</h2>--}}
                    {{--</div><!-- .section-head @e -->--}}
                    {{--<!-- Block @s -->--}}
                    {{--<div class="nk-block nk-block-features mgb-m30">--}}
                        {{--<div class="row">--}}
                            {{--<div class="col-lg-4">--}}
                                {{--<div class="feature">--}}
                                    {{--<div class="feature-icon dot">--}}
                                        {{--<em class="icon ikon ikon-paricle-alt"></em>--}}
                                    {{--</div>--}}
                                    {{--<div class="feature-text">--}}
                                        {{--<h5 class="title title-sm">Create a secure decentralize</h5>--}}
                                        {{--<p>Tempore, cum soluta nobis est eligendi optiocum que nihil maxime placeat facere possimus.</p>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                            {{--<div class="col-lg-4">--}}
                                {{--<div class="feature">--}}
                                    {{--<div class="feature-icon dot">--}}
                                        {{--<em class="icon ikon ikon-donught"></em>--}}
                                    {{--</div>--}}
                                    {{--<div class="feature-text">--}}
                                        {{--<h5 class="title title-sm">Solving small business problems</h5>--}}
                                        {{--<p>Placeat facere possimus, omnis voluptas assum enda est, omnis dolor repellendus. </p>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                            {{--<div class="col-lg-4">--}}
                                {{--<div class="feature">--}}
                                    {{--<div class="feature-icon dot">--}}
                                        {{--<em class="icon ikon ikon-document"></em>--}}
                                    {{--</div>--}}
                                    {{--<div class="feature-text">--}}
                                        {{--<h5 class="title title-sm">Personal data must be isolated</h5>--}}
                                        {{--<p>Nam libero tempore, cum soluta nobis est optio cumque nihil impedit quo minus id quod.</p>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</div><!-- .block @s -->--}}
                </div>

            </section>
        </main>

        <footer class="nk-footer bg-theme-grad">
            <!-- // -->
            <section class="section section-footer section-l tc-light bg-transparent">

                <div class="container">
                    <!-- Block @s -->
                    <div class="nk-block block-contact">
                        <div class="row justify-content-center no-gutters">
                            <div class="col-lg-6">
                                <div class="contact-wrap split split-left split-lg-left bg-white">
                                    <h5 class="title title-md">Contact Us</h5>
                                    <form class="nk-form-submit" action="form/contact.php" method="post">
                                        <div class="field-item">
                                            <input name="contact-name" type="text" class="input-line required" placeholder="Your Name">
                                            <label class="field-label field-label-line">Your Name</label>
                                        </div>
                                        <div class="field-item">
                                            <input name="contact-email" type="email" class="input-line required email" placeholder="Your Email">
                                            <label class="field-label field-label-line">Your Email</label>
                                        </div>
                                        <div class="field-item">
                                            <textarea name="contact-message" class="input-line input-textarea required" placeholder="Your Message"></textarea>
                                            <label class="field-label field-label-line">Your Message</label>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <button type="submit" class="btn btn-lg btn-grad">Submit</button>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="form-results"></div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div><!-- .col -->
                            <div class="col-lg-4">
                                <div class="contact-wrap split split-right split-lg-right bg-genitian bg-theme tc-light">
                                    <div class="d-flex flex-column justify-content-between h-100">
                                        <ul class="contact-list">
                                            <li>
                                                <a href="#">
                                                    <i class="fas fa-building"></i>
                                                </a>
                                                <div class="contact-text">
                                                    <h6>Formula Green Foundation</h6>
                                                    <span>Zug, Switzerland</span>
                                                </div>
                                            </li>
                                            <li>
                                                <a href="info@maharlikacoin.com">
                                                    <i class="fas fa-envelope-square"></i>
                                                </a>

                                                <div class="contact-text">
                                                    <span>info@maharlikacoin.com</span>
                                                </div>
                                            </li>
                                        </ul>
                                        <div class="contact-social">
                                            <h6>Be a part of our community</h6>
                                            <ul class="social-links">
                                                <li><a href="https://www.facebook.com/maharlikacoin" target="_blank"><i class="fab fa-facebook-square"></i></a></li>
                                                <li><a href="https://medium.com/@maharlikacoin" target="_blank"><i class="fab fa-medium"></i></a></li>
                                                <li><a href="https://twitter.com/maharlikacoin" target="_blank"><i class="fab fa-twitter-square"></i></a></li>
                                                <li><a href="https://t.me/themaharlikacoin" target="_blank"><i class="fab fa-telegram-plane"></i></a></li>
                                                <li><a href="https://www.reddit.com/user/maharlikacoin" target="_blank"><i class="fab fa-reddit-square"></i></a></li>
                                                <li><a href="https://github.com/maharlikacoin" target="_blank"><i class="fab fa-github-square"></i></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- .col -->
                        </div><!-- .row -->
                    </div><!-- .block @e -->
                    <!-- Block @s -->
                    <div class="nk-block block-footer">
                        <div class="row">
                            <div class="col-lg-2 col-sm-4 mb-4 mb-sm-0">
                                <div class="wgs wgs-menu">
                                    <h6 class="wgs-title">Company</h6>
                                    <div class="wgs-body">
                                        <ul class="wgs-links">
                                            <li><a href="#">About Us</a></li>
                                            <li><a href="#">Meet Our Team</a></li>
                                            <li><a href="#">Contact Us</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div><!-- .col -->
                            <div class="col-lg-2 col-sm-4 mb-4 mb-sm-0">
                                <div class="wgs wgs-menu">
                                    <h6 class="wgs-title">Legal</h6>
                                    <div class="wgs-body">
                                        <ul class="wgs-links">
                                            <li><a href="#">Disclaimer</a></li>
                                            <li><a href="/whitepaper">Whitepaper</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div><!-- .col -->
                            <div class="col-lg-8 mb-4 mb-lg-0 order-lg-first">
                                <div class="wgs wgs-text">
                                    <div class="wgs-body">
                                        <a href="./" class="wgs-logo">
                                            <img src="images/logo-full-white.png" srcset="images/logo-full-white2x.png 2x" alt="logo">
                                        </a>
                                        <p>Copyright © 2019 Formula Green Foundation <br>All rights reserved. </p>
                                    </div>
                                </div>
                            </div><!-- .col -->
                        </div><!-- .row -->
                    </div><!-- .block @e -->
                </div>

            </section>
            <div class="nk-ovm shape-b"></div>
        </footer>
    </div>

    <!-- Modal @s -->
    <div class="modal fade" id="login-popup">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <a href="#" class="modal-close" data-dismiss="modal" aria-label="Close"><em class="ti ti-close"></em></a>
                <div class="ath-container m-0">
                    <div class="ath-body">
                        <h5 class="ath-heading title">Sign in <small class="tc-default">with your ICO Account</small></h5>
                        <form action="#">
                            <div class="field-item">
                                <div class="field-wrap">
                                    <input type="text" class="input-bordered" placeholder="Your Email">
                                </div>
                            </div>
                            <div class="field-item">
                                <div class="field-wrap">
                                    <input type="password" class="input-bordered" placeholder="Password">
                                </div>
                            </div>
                            <div class="field-item d-flex justify-content-between align-items-center">
                                <div class="field-item pb-0">
                                    <input class="input-checkbox" id="remember-me-100" type="checkbox">
                                    <label for="remember-me-100">Remember Me</label>
                                </div>
                                <div class="forget-link fz-6">
                                    <a href="#" data-toggle="modal" data-dismiss="modal" data-target="#reset-popup">Forgot password?</a>
                                </div>
                            </div>
                            <button class="btn btn-primary btn-block btn-md">Sign In</button>
                        </form>
                        <div class="sap-text"><span>Or Sign In With</span></div>

                        <ul class="row gutter-20px gutter-vr-20px">
                            <li class="col"><a href="#" class="btn btn-md btn-facebook btn-block"><em class="icon fab fa-facebook-f"></em><span>Facebook</span></a></li>
                            <li class="col"><a href="#" class="btn btn-md btn-google btn-block"><em class="icon fab fa-google"></em><span>Google</span></a></li>
                        </ul>
                        <div class="ath-note text-center">
                            Don’t have an account? <a href="#" data-toggle="modal" data-dismiss="modal" data-target="#register-popup"> <strong>Sign up here</strong></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- .modal @e -->

    <!-- Modal @s -->
    <div class="modal fade" id="reset-popup">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <a href="#" class="modal-close" data-dismiss="modal" aria-label="Close"><em class="ti ti-close"></em></a>
                <div class="ath-container m-0">
                    <div class="ath-body">
                        <h5 class="ath-heading title">Reset <small class="tc-default">with your Email</small></h5>
                        <form action="#">
                            <div class="field-item">
                                <div class="field-wrap">
                                    <input type="text" class="input-bordered" placeholder="Your Email">
                                </div>
                            </div>
                            <button class="btn btn-primary btn-block btn-md">Reset Password</button>
                            <div class="ath-note text-center">
                                Remembered? <a href="#" data-toggle="modal" data-dismiss="modal" data-target="#login-popup"> <strong>Sign in here</strong></a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- .modal @e -->

    {{--<div class="preloader"><span class="spinner spinner-round"></span></div>--}}
@endsection
