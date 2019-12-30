<template>
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

                    <user-dropdown-mobile :logout="logout" :address="address"></user-dropdown-mobile>

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
                <user-dropdown-desktop :logout="logout" :address="address"></user-dropdown-desktop>
            </div><!-- .d-flex -->
        </div><!-- .container -->
    </div>
    <!-- TopBar End -->
</template>

<script>
    import UserDropdownDesktop from './dropdowns/desktop';
    import UserDropdownMobile from './dropdowns/mobile';

	export default {
		name: "WalletHeader",
        components: {
		    UserDropdownDesktop,
            UserDropdownMobile
        },
        props: {
		    address: String,
        },
        data() {
		    return {
		        logout: '/wallet/logout'
            }
        }
	}
</script>

<style scoped>

</style>
