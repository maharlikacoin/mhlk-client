<template>
    <div class="user-wraper">
        <div class="container">
            <div class="d-flex">
                <div class="user-sidebar">
                    <sidebar :address="address"></sidebar><!-- .user-box -->
                </div><!-- .user-sidebar -->

                <div class="user-content">
                    <div class="user-panel">
                        <div class="row align-items-center">
                            <maharlika-tile :address="address"></maharlika-tile>
                            <ether-tile :address="address"></ether-tile>
                        </div><!-- .row -->
                        <transactions-table :address="address"></transactions-table>

                    </div><!-- .user-panel -->
                </div><!-- .user-content -->
            </div><!-- .d-flex -->
        </div><!-- .container -->
    </div>
    <!-- UserWrapper End -->
</template>

<script>
    import Sidebar from './sidebar';
    import MaharlikaTile from './contents/MaharlikaTile';
    import EtherTile from './contents/EtherTile';
    import TransactionsTable from './contents/TransactionsTable';
	export default {
		name: "WalletMain",
        components: {
            Sidebar,
            MaharlikaTile,
            EtherTile,
            TransactionsTable
        },
        props: {
            address: String
        }
	}
</script>

<style scoped>

</style>
