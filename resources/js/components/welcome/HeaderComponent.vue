<template>
    <header class="nk-header page-header is-transparent is-sticky is-shrink relative overflow-hidden" id="header">
        <!-- Banner @s -->
        <div class="nk-banner">
            <div class="banner banner-fs banner-single banner-gap-b2 header-polka-mask">
                <div class="banner-wrap">
                    <div class="container">
                        <div class="row align-items-center justify-content-center">

                            <!-- header Logo -->
                            <div class="col-lg-4 order-lg-last">
                                <div class="banner-gfx banner-gfx-re-s1">
                                    <div class="row align-items-center justify-content-center">
                                        <img class="logo" src="/images/maharlika-logo-white.png" alt="Maharlika Coin">
                                    </div>
                                </div>
                            </div>

                            <!-- header contents -->
                            <div class="col-lg-8 col-sm-10 text-center text-lg-left">
                                <div class="banner-caption cpn tc-light">
                                    <div class="cpn-head">
                                        <h1 class="title font-weight-bold">
                                            For The Benefit and Future of Humanity
                                        </h1>
                                    </div>

                                    <!-- description -->
                                    <div class="cpn-text">
                                        <p>The <span class="font-weight-bolder">Maharlika Coin (MHLK)</span> was created
                                            to distribute the value of its intellectual property, natural resources, and
                                            selected physical assets directly for the benefit of humanity. We believe
                                            that all people have the right to clean air and water, the sustainable use
                                            of natural resources, and safe, clean, and abundant energy.
                                        </p>
                                    </div>

                                    <!-- actions -->
                                    <div class="cpn-action">
                                        <div class="d-flex flex-column alignment-items">
                                            <login-modal v-if="!this.$store.state.authenticated"></login-modal>
                                            <div class="cpn-btns" v-if="this.$store.state.authenticated">
                                                <a class="btn btn-lg btn-grad grant border-0 d-flex align-items-center"
                                                   href="/wallet">Your Wallet</a>
                                            </div>

                                            <create-wallet></create-wallet>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div><!-- .col -->
                    </div><!-- .row -->
                </div>
            </div>
        </div>

        <!-- particles -->
        <div id="particles-bg" class="particles-container particles-bg z-1"></div>

        <!-- background gold-->
        <div class="header-banner bg-theme-grad header-curved-mask"></div>
        <!-- .header-banner @e -->
    </header>
</template>

<script>
    import CreateWallet from './CreateWallet';
    import LoginModal from './LoginComponent';

    export default {
        name: 'HeaderComponent',
        components: {
            CreateWallet,
            LoginModal
        }
    };
</script>
