<template>
    <div class="wgs wgs-menu">
        <h6 class="wgs-title">Company</h6>
        <div class="wgs-body">
            <ul class="wgs-links">
                <li><a :href="aboutUs">About Us</a></li>
                <li><a :href="team">Meet Our Team</a></li>
                <li><a href="mailto:support@maharlikacoin.com">Contact Us</a></li>
            </ul>
        </div>
    </div>

</template>

<script>
	export default {
		name: "company",
        props: {
		    aboutUs: String,
            team: String
        }
	}
</script>

<style scoped>

</style>
