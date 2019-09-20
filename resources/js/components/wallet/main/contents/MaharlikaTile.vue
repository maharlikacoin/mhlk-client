<template>
    <div class="col-md-6">
        <div class="tile-item tile-primary">
            <div class="tile-bubbles"></div>
            <h6 class="tile-title">YOUR MHLK BALANCE</h6>
            <h1 class="tile-info">{{ balance | numberFormat('0,000.00') }} MHLK</h1>
        </div>
    </div>
</template>

<script>
	export default {
		name: "ContentsMaharlikaTile",
        props: {
            address: String
        },
        data() {
            return {
                apiBaseUrl: 'https://api.etherscan.io/api?',
                module: 'account',
                action: 'tokenbalance',
                apikey: 'GEPXM3N11F476EMB8FCXG2XVK89Y5PKMFK',
                contractAddress: '0xe3d0a162fcc5c02c9448274d7c58e18e1811385f',
                balance: 0
            }
        },
        methods: {
		    getCoinBalance() {
		        // etherscan does not require x-requested-with
                delete axios.defaults.headers.common["X-Requested-With"];
                let url = `${this.apiBaseUrl}module=${this.module}&action=${this.action}&contractaddress=${this.contractAddress}&address=${this.address}&tag=latest&apikey=${this.apikey}`;

                axios.get(url)
                    .then(response => {
                        this.balance = response.data.result/100;
                    })
                    .catch(error => {
                        console.log(error);
                        this.balance = 0;
                    });
		    }
        },
        mounted() {
            this.getCoinBalance();
        },
	}
</script>

<style scoped>

</style>
