<template>
    <div class="wgs wgs-menu">
        <h6 class="wgs-title">Company</h6>
        <div class="wgs-body">
            <ul class="wgs-links">
                <li><a href="/about-us">About Us</a></li>
                <li><a href="/team" @click.prevent="navigate('/team')">Meet Our Team</a></li>
                <li><a href="mailto:support@maharlikacoin.com">Contact Us</a></li>
            </ul>
        </div>
    </div>
</template>

<script>
	export default {
		name: "company",
        methods: {
		    navigate(url) {
		        if(!this.$store.state.authenticated)
		            this.$store.dispatch('toggleLogin', true);

		        else window.location.href = url
            }
        }
	}
</script>

<style scoped>

</style>
