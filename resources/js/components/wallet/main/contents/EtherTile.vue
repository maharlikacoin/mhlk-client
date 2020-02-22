<template>
    <div class="col-md-6">
        <div class="tile-item tile-light">
            <div class="tile-bubbles"></div>
            <h6 class="tile-title">YOUR ETH BALANCE</h6>
            <div class="tile-info color-dark relative z-1">
                <!-- crypto -->
                <span class="text-uppercase pointer" v-if="!showWholeEther" @click="showWholeEther = !showWholeEther">
                    {{ $store.state.balances.ether | numberFormat('0.[00000000]a') }} ETH</span>
                <span class="text-uppercase pointer" v-if="showWholeEther" @click="showWholeEther = !showWholeEther">
                    {{ $store.state.balances.ether | numberFormat('0.00000000') }} ETH</span>

                <!-- value -->
                <span class="small text-black-50 text-uppercase pointer"
                      v-if="!showWholeEtherValue" @click="showWholeEtherValue = !showWholeEtherValue">
                    (${{ $store.state.balances.ether * $store.state.prices.etherInUsd | numberFormat('0,0.[00]a') }})
                </span>
                <span class="small text-black-50 text-uppercase pointer"
                      v-if="showWholeEtherValue" @click="showWholeEtherValue = !showWholeEtherValue">
                    (${{ $store.state.balances.ether * $store.state.prices.etherInUsd | numberFormat('0,0.00') }})
                </span>
            </div>
        </div>
    </div>
</template>

<script>
	export default {
		name: "ContentsEtherTile",
        data: ()=> {
            return {
                showWholeEther: false,
                showWholeEtherValue: false
            }
        }
	}
</script>

<style scoped>
    .tile-bubbles {
        background: #b9932e12;
    }
    .tile-bubbles:before, .tile-bubbles:after {
        background: rgba(185, 147, 46, 0.06);
    }
</style>
