<template>
    <div class="topbar">
        <!-- mobile -->
        <user-dropdown-mobile :logout="logout" :address="address" :etherscanBaseUrl="etherscanBaseUrl"></user-dropdown-mobile>

        <!-- desktop -->
        <user-dropdown-desktop :logout="logout" :address="address" :etherscanBaseUrl="etherscanBaseUrl"></user-dropdown-desktop>
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
		        logout: '/wallet/logout',
                etherscanBaseUrl: 'https://etherscan.io/address/'
            }
        }
	}
</script>

<style scoped>

</style>
