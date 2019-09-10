<header class="nk-header page-header is-transparent is-sticky is-shrink" id="header">
    <!-- Banner @s -->
    <div class="header-banner bg-theme-grad">
        <div class="nk-banner">
            <div class="banner banner-fs banner-single banner-gap-b2">
                <div class="banner-wrap">
                    <div class="container">
                        <div class="row align-items-center justify-content-center">
                            <div class="col-lg-4 order-lg-last">
                                <div class="banner-gfx banner-gfx-re-s1">
                                    <div class="row align-items-center justify-content-center">
                                        <img class="logo-width-sm logo-width-lg" src="/images/maharlika-logo-white.png"
                                             alt="Maharlika Coin">
                                    </div>
                                </div>
                            </div><!-- .col -->
                            <div class="col-lg-8 col-sm-10 text-center text-lg-left">
                                <div class="banner-caption cpn tc-light">
                                    <div class="cpn-head">
                                        <h1 class="title">
                                            The World's First <br>
                                            <strong>Resource-Based Economy Cryptocurrency</strong><br>
                                            Advocating A Dividend System <br>For Humanity
                                        </h1>
                                    </div>
                                    <div class="cpn-text">
                                        <p>The <span class="font-weight-bolder">Maharlika Coin (MHLK)</span> was created
                                            to distribute the value of resources to
                                            the people and selected organizations directly benefiting them to ensure
                                            transparency and corporate governance.
                                        </p>
                                    </div>
                                    <div class="cpn-action">
                                        @if(!session('authAddress'))
                                            <div class="cpn-btns">
                                                <a class="btn btn-grad" href="#" data-toggle="modal"
                                                   data-target="#login-popup">Access your Wallet</a>
                                            </div>
                                        @else
                                            <div class="cpn-btns">
                                                <a class="btn btn-grad" href="/wallet">Go back to your Wallet</a>
                                            </div>
                                        @endif
                                        <ul class="cpn-links">
                                            <create-wallet></create-wallet>
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
