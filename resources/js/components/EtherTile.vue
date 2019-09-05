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
		name: "EtherTile",
        props: {
            address: String
        },
        data() {
            return {
                apiBaseUrl: 'https://api.etherscan.io/api?',
                module: 'account',
                action: 'balance',
                apikey: 'GEPXM3N11F476EMB8FCXG2XVK89Y5PKMFK',
                balance: 0
            }
        },
        methods: {
            getEtherBalance() {
                // etherscan does not require x-requested-with
                delete axios.defaults.headers.common["X-Requested-With"];
                let url = `${this.apiBaseUrl}module=${this.module}&action=${this.action}&address=${this.address}&tag=latest&apikey=${this.apikey}`;

                axios.get(url)
                    .then(response => {
                        this.balance = response.data.result/1000000000000000000;
                    })
                    .catch(error => {
                        console.log(error);
                        this.balance = 0;
                    });
            }
        },
        mounted() {
            this.getEtherBalance();
        },
	}
</script>

<style scoped>

</style>
