@extends('layouts.app')

@section('title') About Us @stop
@section('banner')
    <div class="header-banner bg-theme-grad">
        <div class="nk-banner">
            <div class="banner banner-page">
                <div class="banner-wrap">
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-xl-6 col-lg-9">
                                <div class="banner-caption cpn tc-light text-center">
                                    <div class="cpn-head">
                                        <h2 class="title ttu">About Us</h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- .nk-banner -->
        <div class="nk-ovm shape-a-sm"></div>
@stop
@section('content')
    <main class="nk-pages">
        <section class="section section-l bg-light">
            <div class="container">
                <div class="nk-block nk-block-blog">
                    <div class="row">
                        <div class="col-12">
                            <div class="blog-details">
                                <div class="row justify-content-center">

                                    <div class="col-xl-8 col-lg-10">
                                        <div class="col-xl-12 col-lg-12">
                                            <div class="blog-featured text-center">
                                                <img class="round" src="/images/fgf-logo.png" alt="Formula Green Foundation">
                                            </div>
                                        </div>
                                        <ul class="blog-meta">
                                            <li><a href="#">September 07, 2019</a></li>
                                            <li><a href="#">The Formula Green Foundation</a></li>
                                        </ul>
                                        <div class="blog-content text-justify height-2em">
                                            The <span class="font-weight-bold">Formula Green Foundation (FGF)</span> is
                                            a Swiss-based entity mandated by the
                                            Formula Green Corporation (FGC) and its key shareholder, the Maharlika
                                            Trust, to implement the world’s first Wealth Distribution Platform (WDP) via
                                            blockchain and cryptocurrency. Our goal is to fulfill the key aspect of
                                            enabling Philanthropic funds to reach individual and corporate beneficiaries
                                            DIRECTLY. We have chosen the Ethereum platform to accomplish this and have
                                            issued the Maharlika Coin (MHLK) backed by our own assets, ecosystems, and
                                            people movement. Our blueprint includes over 200 corporate beneficiaries and
                                            over 10 million humanitarians to replicate our goals worldwide, especially
                                            in third world countries.
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div><!-- .col -->
                    </div><!-- .row -->
                </div><!-- .nk-block -->
            </div><!-- .container -->
        </section><!-- .section -->
    </main>
@stop
