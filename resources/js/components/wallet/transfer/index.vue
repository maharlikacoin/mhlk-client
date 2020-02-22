<template>
    <b-modal ref="transferModal" v-model="showModal" hide-header hide-footer no-close-on-backdrop centered
             @hidden="onHide">

        <!-- close -->
        <button class="modal-close" @click="$refs.transferModal.hide()" @reset="reset">
            <em class="ti ti-close"></em>
        </button>

        <!-- contents -->
        <div class="ath-container m-0">
            <div class="relative text-right mr-5">
                <i class="fas fa-circle live-indicator" :class="[ {'text-green':connected}, 'text-red' ]"></i>
                <span style="color: rgb(108, 117, 125); float: right;">{{ $store.state.network }}</span>
            </div>

            <maharlika ref="maharlikaTransfer" :connected="connected"></maharlika>
        </div>
    </b-modal>
</template>

<script>
    import { BModal } from 'bootstrap-vue'
    import Maharlika from './maharlika'

    export default {
        name: "TransferModal",
        components: {
            BModal,
            Maharlika
        },
        computed: {
            connected() {
                return this.$store.state.provider !== '' && this.$store.state.maharlika
            },

        },
        data() {
            return {
                showModal: false
            }
        },
        methods: {
            onHide() {
                this.$store.dispatch('toggleTransferModal', false)
            },
            reset() {
                this.$refs.transferMaharlika.reset()
            }
        },
        mounted() {
            this.$store.subscribe((mutation) => {
                if(mutation.type === 'TOGGLETRANSFERMODAL')
                    this.showModal = mutation.payload

            })
        }
    }
</script>
<style scoped>
</style>
