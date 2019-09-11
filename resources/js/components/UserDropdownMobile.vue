<template>
    <div class="dropdown topbar-action-item topbar-action-user">
        <a href="#" data-toggle="dropdown" @click="toggleDropdown">
            <img class="icon" src="/images/profile.png" alt="thumb">
        </a>
        <div class="dropdown-menu dropdown-menu-right show" v-show="showDropdown" x-placement="bottom-end">
            <div class="user-dropdown">
                <div class="user-dropdown-head">
                    <h6 class="user-name">
                        <a href="#">{{ address | trimAddress }}</a>
                    </h6>
                </div>
                <div class="user-dropdown-balance">
                    <h6>MHLK Balance</h6>
                    <h1 class="tile-info color-dark" v-html="$options.filters.reduceSizeDecimal(balances.coin)"></h1>
                </div>
                <ul class="user-dropdown-btns btn-grp guttar-10px">
                    <li>
                        <b-button id="toggle-button" class="btn btn-grad" :class="{ 'disable': !transferrable}"
                                  :disabled="!transferrable" @click="toggleModal">Transfer</b-button>
                    </li>
                </ul>
                <div class="gaps-1x"></div>
                <ul class="user-dropdown-links">
                    <li><a href="/"><i class="ti ti-home"></i>Home</a></li>
                    <li><a :href="route"><i class="ti ti-power-off"></i>Logout</a></li>
                </ul>
            </div>
        </div>
    </div>

</template>

<script>
    import { BButton } from 'bootstrap-vue'
	export default {
		name: "UserDropdown",
        components: {
		    BButton
        },
        props: {
		    route: String,
            address: String
        },
        computed: {
		    transferrable() {

            }
        },
        data() {
		    return {
		        showDropdown: false,
		        balances: {
		            coin: 0,
                    ether: 0
                }
            }
        },
        methods: {
		    hideDropdown() {
		        this.showDropdown = false;
            },
            toggleDropdown() {
                  this.showDropdown = !this.showDropdown;
            },
            connectToProvider() {
                let nodeProvider = new Web3.providers.HttpProvider(this.provider);
                return new Web3(nodeProvider);
            },
            maharlikaContract() {
                return new this.web3.eth.Contract(this.contractAbi, this.contractAddress, {from: this.address});
            },
            getContractAbi() {
                axios.get(this.contractAbiUrl)
                    .then(response => {
                        this.contractAbi = response.data;
                    })
            },
            getCoinBalance() {
                this.maharlikaContract().methods.balanceOf(this.address)
                    .call().then(coinBalance => this.balances.coin = coinBalance);

            },
            async getEtherBalance() {
                let weiBalance = await this.web3.eth.getBalance(this.address);
                this.balances.ether = this.web3.utils.fromWei(weiBalance, 'ether');
            },


		    toggleModal() {

            }
        }
	}
</script>

<style scoped>
    .user-dropdown-head:after {
        border-bottom-color: #c08f3e;
    }
    .user-dropdown-head {
        background: #c08f3e;
    }
    a {
        color:white;
    }
    .user-dropdown-links, .user-dropdown-btns {
        border-top: white
    }
</style>
