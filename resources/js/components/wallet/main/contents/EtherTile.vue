<template>
    <div class="col-md-6">
        <div class="tile-item tile-light">
            <div class="tile-bubbles"></div>
            <h6 class="tile-title">YOUR ETH BALANCE</h6>
            <h1 class="tile-info color-dark">{{ balance | numberFormat('0.0000') }} ETH</h1>
        </div>
    </div>
</template>

<script>
	export default {
		name: "ContentsEtherTile",
        computed: {
		    balance() {
		        return this.$store.getters.getEther;
            }
        }
	}
</script>

<style scoped>

</style>
