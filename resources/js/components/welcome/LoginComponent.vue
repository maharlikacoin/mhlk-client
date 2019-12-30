<template>
    <div class="cpn-btns">
        <a class="btn btn-lg btn-grad-transparent" href="#" @click="showModal = !showModal">Access your Wallet</a>
        <b-modal ref="login-modal" v-model="showModal" centered hide-header hide-footer no-close-on-backdrop>
            <a href="#" class="modal-close" data-dismiss="modal" aria-label="Close" @reset="resetModal" @click="showModal = false">
                <em class="ti ti-close"></em>
            </a>
            <div class="ath-container m-0">
                <h2 class="py-4 text-center">Welcome to <span class="text-gold">Maharlika Coin</span></h2>
                <form @submit.prevent="access">
                    <div class="field-wrap">
                        <input v-model="publicKey" id="public_key" type="text" class="input-bordered" name="address" required>
                        <label for="public_key">
                            <span class="small text-black-50">Wallet Address (example: 0x....)</span>
                        </label>
                    </div>
                    <button class="btn btn-grad w-100">Access</button>
                </form>
            </div>
        </b-modal><!-- .modal @e -->
    </div>


</template>

<script>
    import { BModal } from 'bootstrap-vue';
	export default {
		name: "LoginComponent",
        components: {
		    BModal
        },
        data() {
		    return {
		        showModal: false,
                publicKey: ''
            }
        },
        methods: {
		    access() {
		        axios.post('/wallet', this.publicKey)
                    .then(response => {
                        window.location.href = response.data.url
                    })
            },
            resetModal() {
                this.publicKey = ''
            }
        }
	}
</script>

<style scoped>
.text-gold {
    color: #dcb251;
}
</style>
