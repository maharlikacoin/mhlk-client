<div class="topbar">
    <!-- mobile -->
    <div class="topbar-md d-lg-none">
        <div class="container">
            <div class="d-flex align-items-center justify-content-between">

                <!-- site-logo -->
                <div class="site-logo">
                    <a href="/" class="site-brand">
                        <img src="images/logo.png" alt="logo" srcset="images/logo2x.png 2x" style="width:15em;">
                    </a>
                </div>

                <user-dropdown-mobile route="{{ route('wallet.logout') }}" address="{{ session('authAddress') }}"></user-dropdown-mobile>

                <!-- .toggle-action -->
            </div><!-- .container -->
        </div><!-- .container -->
    </div><!-- .topbar-md -->

    <!-- desktop -->
    <div class="container">
        <div class="d-lg-flex align-items-center justify-content-between">

            <div class="topbar-lg d-none d-lg-block">
                <div class="site-logo">
                    <a href="/" class="site-brand">
                        <img src="images/logo.png" alt="logo" srcset="images/logo2x.png 2x" style="width:15em;">
                    </a>
                </div><!-- .site-logo -->
            </div><!-- .topbar-lg -->

            <!-- topbar-action -->
            <user-dropdown-desktop route="{{ route('wallet.logout') }}" address="{{ session('authAddress') }}"></user-dropdown-desktop>
        </div><!-- .d-flex -->
    </div><!-- .container -->
</div>
<!-- TopBar End -->
