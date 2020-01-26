<template>
    <div class="col-md-6">
        <div class="tile-item tile-light">
            <div class="tile-bubbles"></div>
            <h6 class="tile-title">YOUR ETH BALANCE</h6>
            <h1 class="tile-info color-dark">
                {{ $store.state.balances.ether | numberFormat('0.000000') }} ETH
                <span class="small text-black-50">
                    (${{ $store.state.balances.ether * $store.state.prices.etherInUsd | numberFormat('0.00')}})
                </span>
            </h1>
        </div>
    </div>
</template>

<script>
	export default {
		name: "ContentsEtherTile"
	}
</script>

<style scoped>

</style>
