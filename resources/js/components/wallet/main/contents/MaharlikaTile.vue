<template>
    <div class="col-md-6">
        <div class="tile-item tile-primary">
            <div class="tile-bubbles"></div>
            <h6 class="tile-title">YOUR MHLK BALANCE</h6>
            <div class="tile-info relative z-1">
                <!-- crypto -->
                <span class="text-uppercase pointer" v-if="!showWholeCoin" @click="showWholeCoin = !showWholeCoin">
                    MHLK {{ $store.state.balances.coin | numberFormat('0,0.[00]a') }}</span>
                <span class="text-uppercase pointer" v-if="showWholeCoin" @click="showWholeCoin = !showWholeCoin">
                    MHLK {{ $store.state.balances.coin | numberFormat('0,0.00') }}</span>

                <!-- value -->
                <span class="small text-white-50 text-uppercase pointer"
                      v-if="!showWholeCoinValue" @click="showWholeCoinValue = !showWholeCoinValue">
                    (€{{ $store.state.balances.coin | numberFormat('0,0.[00]a') }})
                </span>
                <span class="small text-white-50 text-uppercase pointer"
                      v-if="showWholeCoinValue" @click="showWholeCoinValue = !showWholeCoinValue">
                    (€{{ $store.state.balances.coin | numberFormat('0,0.00') }})
                </span>
            </div>
        </div>
    </div>
</template>

<script>
	export default {
		name: "ContentsMaharlikaTile",
        data: ()=> {
            return {
                showWholeCoin: false,
                showWholeCoinValue: false
            }
        }
	}
</script>

<style scoped>

</style>
