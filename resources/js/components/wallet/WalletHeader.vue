<template>
    <div class="topbar">
        <!-- mobile -->
        <user-dropdown-mobile :logout="logout" :address="address"></user-dropdown-mobile>

        <!-- desktop -->
        <user-dropdown-desktop :logout="logout" :address="address"></user-dropdown-desktop>
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
