<header class="nk-header page-header is-transparent is-sticky is-shrink relative overflow-hidden" id="header">
    <!-- Banner @s -->
    <div class="nk-banner">
        <div class="banner banner-fs banner-single banner-gap-b2 header-polka-mask">
            <div class="banner-wrap">
                <div class="container">
                    <div class="row align-items-center justify-content-center">
                        <div class="col-lg-4 order-lg-last">
                            <div class="banner-gfx banner-gfx-re-s1">
                                <div class="row align-items-center justify-content-center">
                                    <img class="logo"
                                         src="/images/maharlika-logo-white.png"
                                         alt="Maharlika Coin">
                                </div>
                            </div>
                        </div><!-- .col -->
                        <div class="col-lg-8 col-sm-10 text-center text-lg-left">
                            <div class="banner-caption cpn tc-light">
                                <div class="cpn-head">
                                    <h1 class="title">
                                        The World's First <br>
                                        <strong>Asset-Backed Cryptocurrency</strong><br>
                                        advocating a Resource Based Economy for Humanity.
                                    </h1>
                                </div>
                                <div class="cpn-text">
                                    <p>The <span class="font-weight-bolder">Maharlika Coin (MHLK)</span> was created
                                        to distribute the value of natural resources and selected philanthropic assets
                                        directly to the people and organizations to ensure that Humanity has a stake in
                                        the protection and conservation of our planet. We invite everyone to use the
                                        MHLK to advocate best practices for world peace.
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
                                    <a class="btn btn-services" href="https://grants.maharlikacoin.com">Other Services</a>
                                </div>
                            </div>
                        </div><!-- .col -->
                    </div><!-- .row -->
                </div>
            </div>
        </div>
    </div><!-- .nk-banner -->
    <!-- Place Particle Js -->
    <div id="particles-bg" class="particles-container particles-bg z-1"></div>
    <div class="header-banner bg-theme-grad header-curved-mask"></div>
    <!-- .header-banner @e -->
</header>
