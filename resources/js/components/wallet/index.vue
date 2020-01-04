<template>
    <div>
        <wallet-header :address="address"></wallet-header>
        <wallet-main :address="address"></wallet-main>
        <wallet-footer></wallet-footer>
        <transfer-modal :address="address"></transfer-modal>
    </div>
</template>


<script>
    import WalletHeader from './WalletHeader';
    import WalletMain from './main/index';
    import WalletFooter from './FooterComponent';
    import TransferModal from '../partials/TransferModal'

    export default {
        props: ["address"],
        components: {
            WalletHeader,
            WalletMain,
            WalletFooter,
            TransferModal
        },
        name: "WalletIndex",
        mounted() {
            let store = this.$store,
                getters = store.getters,
                config = getters.getConfiguration,
                network = getters.getNetwork,
                usedConfig = config[network];

            store.dispatch('connect', { usedConfig: usedConfig, public_address: this.address});
        }
    }
</script>
<style scoped>

</style>
