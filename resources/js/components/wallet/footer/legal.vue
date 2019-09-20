<template>
    <div class="wgs wgs-menu">
        <h6 class="wgs-title">Legal</h6>
        <div class="wgs-body">
            <ul class="wgs-links">
                <li><a :href="terms">Terms & Conditions</a></li>
                <li><a :href="privacy">Privacy</a></li>
                <li><a :href="whitepaper" target="_blank">Whitepaper</a></li>
            </ul>
        </div>
    </div>
</template>

<script>
	export default {
		name: "legal",
        props: {
		    terms: String,
            privacy: String,
            whitepaper: String,
        }
	}
</script>

<style scoped>

</style>
