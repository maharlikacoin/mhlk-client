<template>
    <div class="col-md-6">
        <div class="tile-item tile-primary">
            <div class="tile-bubbles"></div>
            <h6 class="tile-title">YOUR MHLK BALANCE</h6>
            <h1 class="tile-info">
                {{ $store.state.balances.coin | numberFormat('0,000.00') }} MHLK
                <span class="small text-white-50">
                    (€{{ $store.state.balances.coin | numberFormat('0,000.00') }})
                </span>
            </h1>
        </div>
    </div>
</template>

<script>
	export default {
		name: "ContentsMaharlikaTile"
	}
</script>

<style scoped>

</style>
