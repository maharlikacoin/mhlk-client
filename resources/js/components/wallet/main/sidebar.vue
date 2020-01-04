<template>
    <div class="user-box d-none d-lg-block user-panel" style="min-height: inherit;">
        <div>
            <vue-qr :text="address" logoSrc="/images/maharlika-coin-gold.png" :size="800" :logoCornerRadius="100"
                    :logoMargin="15" :margin="0"></vue-qr>
        </div>
        <div class="d-flex align-items-center justify-content-center">
            <h6 class="user-name">{{ address | trimAddress }}</h6>
            <button class="bg-transparent border-0 pointer outline-0" v-clipboard:copy="address" v-clipboard:success="onCopy"
                    v-clipboard:error="onError">
                <i class="fas fa-copy"></i>
            </button>
        </div>
        <ul class="btn-grp guttar-10px">
            <li><button class="btn btn-grad border-0" :class="{ 'disable': !transferrable}"
                          :disabled="!transferrable" @click="openModal">Transfer</button>
            </li>
        </ul>
    </div>
</template>

<script>
    import VueQr from 'vue-qr'

    export default {
        name: "SidebarComponent",
        components: {
            VueQr,
        },
        props: {
            address: String
        },
        computed: {
            transferrable() {
                return this.balances.ether > 0 && this.balances.coin > 0
            }
        },
        data() {
            return {
                balances: {
                    ether: 0,
                    coin: 0
                }
            }
        },
        methods: {
            openModal() {
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
    .user-image img {
        width: 130px;
    }
    .outline-0:focus {
        outline: 0;
    }
</style>
