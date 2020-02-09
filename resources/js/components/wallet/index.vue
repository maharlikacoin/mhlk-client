<template>
    <div class="d-flex mx-auto flex-column h-screen">
        <main role="main" class="flex-grow-1">
            <wallet-header :address="address"></wallet-header>
            <wallet-main :address="address"></wallet-main>
            <transfer-modal></transfer-modal>
        </main>
        <wallet-footer></wallet-footer>
    </div>
</template>


<script>
    import WalletHeader from './WalletHeader';
    import WalletMain from './main/index';
    import WalletFooter from './FooterComponent';
    import TransferModal from './transfer'

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

            store.dispatch('setAuth', true);
            store.dispatch('connect', { usedConfig: usedConfig, public_address: this.address});
        }
    }
</script>
<style scoped>

</style>
