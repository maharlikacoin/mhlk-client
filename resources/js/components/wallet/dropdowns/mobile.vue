<template>
    <div class="topbar-md d-lg-none">
        <div class="container">
            <div class="d-flex align-items-center justify-content-between">

                <!-- site-logo -->
                <div class="site-logo">
                    <a href="/" class="site-brand">
                        <img src="images/logo.png" alt="logo" srcset="images/logo2x.png 2x" style="width:15em;">
                    </a>
            </div>

                <!-- action -->
                <div class="dropdown topbar-action-item topbar-action-user">
                    <img class="icon my-2" src="/images/profile.png" alt="default" @click="showDropdown = !showDropdown">

                    <div class="border-0 dropdown-menu dropdown-menu-right show" v-show="showDropdown">
                        <div class="user-dropdown">
                            <div class="user-dropdown-head d-flex align-items-center justify-content-center">
                                <a :href="etherscanBaseUrl + address" target="_blank">{{ address | trimAddress }}</a>
                                <button class="bg-transparent border-0 pointer outline-0"
                                        v-clipboard:copy="address"
                                        v-clipboard:success="onCopy"
                                        v-clipboard:error="onError">
                                    <i class="fas fa-copy text-white"></i>
                                </button>
                            </div>
                            <div class="user-dropdown-balance">
                                <h6>MHLK Balance</h6>
                                <h1 class="tile-info color-dark" v-html="$options.filters.reduceSizeDecimal(balances.coin)"></h1>
                            </div>
                            <ul class="user-dropdown-btns btn-grp guttar-10px">
                                <li>
                                    <button class="btn btn-grad border-0" :class="{ 'disable': !transferrable}"
                                              :disabled="!transferrable" @click="openTransferModal">
                                        Transfer
                                    </button>
                                </li>
                            </ul>
                            <div class="gaps-1x"></div>
                            <ul class="user-dropdown-links">
                                <li><a href="/"><i class="ti ti-home"></i>Home</a></li>
                                <li><a :href="logout"><i class="ti ti-power-off"></i>Logout</a></li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- .toggle-action -->
            </div><!-- .container -->
        </div><!-- .container -->
    </div><!-- .topbar-md -->

</template>

<script>
    import TransferModal from '../transfer'

    export default {
		name: "DropdownMobile",
        components: {
            TransferModal
        },
        props: {
		    logout: String,
            address: String,
            etherscanBaseUrl: String
        },
        computed: {
            transferrable() {
                return this.balances.ether > 0 && this.balances.coin > 0
            }
        },
        data() {
            return {
                showDropdown: false,
                balances: {
                    ether: 0,
                    coin: 0
                }
            }
        },
        methods: {
		    openTransferModal() {
                this.$store.dispatch('toggleTransferModal', true)
            },

            onCopy(e) {
                alert('Successfully copied: ' + e.text);
            },
            onError(){
                alert('Failed to copy. Try again.');
            }
        },
        mounted() {
            this.$store.subscribe((mutation) => {
                if(mutation.type === 'SETETHER') this.balances.ether = mutation.payload;
                if(mutation.type === 'SETCOIN') this.balances.coin = mutation.payload;
            });
        }
	}
</script>

<style scoped>
    .modal-content .modal-close .fa,
    .modal-content .modal-close .ti {
        color: #c08f3e;
    }
    .user-dropdown-head:after {
        border-bottom-color: #c08f3e;
    }
    .user-dropdown-head {
        background: #c08f3e;
    }
    a {
        color:white;
    }
    a.status {
        padding: 0;
        border: 0;
        color: #007bff;
        text-decoration: none;
        background-color: transparent;
    }
    a.status:hover {
        color: #0056b3;
        text-decoration: underline;
    }
    .user-dropdown-links, .user-dropdown-btns {
        border-top: white
    }
    .topbar-action-user > img {
        height: 30px;
        width: 30px;
        border-radius: 50%;
    }
</style>
