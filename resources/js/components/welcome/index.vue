<template>
    <div @contextmenu.prevent="">
        <div class="nk-wrap">
            <header-component></header-component>
            <main-component></main-component>
            <footer-component></footer-component>
        </div>

        <div class="preloader"><span class="spinner spinner-round"></span></div>
    </div>
</template>

<script>
    import HeaderComponent from './HeaderComponent';
    import MainComponent from './MainComponent';
    import FooterComponent from './FooterComponent';

	export default {
		name: "WelcomeIndex",
        props: {
		    isLoggedIn: Boolean,
        },
        components: {
            HeaderComponent,
            MainComponent,
            FooterComponent,
        },
        mounted() {
		    this.$store.dispatch('setAuth', this.isLoggedIn);
        }
	}
</script>

<style scoped>

</style>
