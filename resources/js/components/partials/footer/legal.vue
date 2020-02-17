<template>
    <div class="wgs wgs-menu">
        <h6 class="wgs-title">Legal</h6>
        <div class="wgs-body">
            <ul class="wgs-links">
                <li><a href="/terms-and-conditions">Terms & Conditions</a></li>
                <li><a href="/privacy-policy">Privacy</a></li>
                <li><a href="/whitepaper" @click.prevent="navigate('/whitepaper')">Whitepaper</a></li>
            </ul>
        </div>
    </div>
</template>

<script>
	export default {
		name: "legal",
        methods: {
            navigate(url) {
                if(!this.$store.state.authenticated)
                    this.$store.dispatch('toggleLogin', true);

                else window.open(url)
            }
        }
	}
</script>

<style scoped>

</style>
