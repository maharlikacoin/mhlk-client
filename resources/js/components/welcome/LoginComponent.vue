<template>
    <div class="cpn-btns">
        <button class="btn btn-lg btn-grad-transparent" @click="showModal = !showModal">Access your Wallet</button>
        <b-modal ref="login-modal" v-model="showModal" centered hide-header hide-footer no-close-on-backdrop>
            <button class="modal-close"
                    data-dismiss="modal" aria-label="Close" @reset="resetModal" @click="closeModal">
                <em class="ti ti-close"></em>
            </button>
            <div class="ath-container m-0">
                <h2 class="pt-4 pb-5 text-center">Welcome to <span class="text-gold">Maharlika Coin</span></h2>
                <v-observer ref="observerLoginForm" v-slot="{ invalid }"  tag="form" @submit.prevent="access">

                    <v-provider vid="publicKey" name="Wallet Address" rules="required|ethereumAddress" tag="div" mode="aggressive"
                                v-slot="{ errors, valid }" class="field-item" :class="{ 'input-focused': public.isFocused }">
                        <input v-model="public.key" id="publicKey" name="publicKey" type="text" class="input-line required"
                               :class="{ 'border-danger' : errors.length }" @focus="onFocus(public)" @blur="onBlur(public)"/>
                        <label for="publicKey" class="field-label field-label-line">Wallet Address (Public Key)</label>
                        <span class="small text-black-50">Note: It always starts in 0x...</span>
                        <div class="small text-danger" v-if="errors.length">{{ errors[0] }}</div>
                    </v-provider>

                    <v-provider vid="privateKey" name="Password" rules="required|min:64" tag="div" mode="aggressive"
                                v-slot="{ errors, valid }" class="field-item" :class="{ 'input-focused': private.isFocused }">
                        <input v-model="private.key" id="privateKey" name="privateKey" type="password" class="input-line required"
                               :class="{ 'border-danger' : errors.length }" @focus="onFocus(private)" @blur="onBlur(private)"/>
                        <label for="privateKey" class="field-label field-label-line">Wallet Key (Private Key)</label>
                        <span class="small text-black-50">Must be at least 64 characters</span>
                        <div class="small text-danger" v-if="errors.length">{{ errors[0] }}</div>
                    </v-provider>

                    <div class="small text-danger pb-5" v-if="account.error">{{ account.message }}</div>
                    <button class="btn btn-grad w-100" :class="{ 'disabled': invalid || busy }" :disabled="invalid || busy" v-html="button"></button>
                </v-observer>
            </div>
        </b-modal><!-- .modal @e -->
    </div>


</template>

<script>
    import { BModal } from 'bootstrap-vue';
    import { utils } from 'ethers';
    import { ValidationObserver, ValidationProvider} from 'vee-validate';

    Vue.component('VObserver', ValidationObserver);
    Vue.component('VProvider', ValidationProvider);

    function initialState() {
        return {
            showModal: false,
            public: {
                key: '',
                isFocused: false
            },
            private: {
                key: '',
                isFocused: false
            },
            isFocused: false,
            account: {
                error: false,
                message: 'Try again. Please be cautious, your account may get locked after massive multiple retries'
            },
            button: 'Access',
            busy: false
        }
    }
	export default {
		name: "LoginComponent",
        components: {
		    BModal
        },
        data() {
		    return initialState()
        },
        methods: {
		    onFocus(field) {
                field.isFocused = true;
            },
            onBlur(field){
                field.isFocused = field.key !== '';
            },
		    access() {
		       this.verify(this)
            },
            verify: _.debounce((vm) => {
		        try {
                    vm.button = '<em class="fas fa-spinner fa-spin"></em>';
                    vm.busy = true;
                    let computed = utils.computeAddress(`0x${vm.private.key}`),
                        addr = utils.getAddress(vm.public.key);

                    if( computed === addr ) {
                        axios.post('/wallet', { address: addr})
                            .then(response => window.location.href = response.data.url)
                    }
                    else vm.showError();
                }catch (e) {
                    vm.showError();
                }
            }, 100),
            showError() {
                // show error then hide after 5sec
                this.button = 'Access';
                this.busy = false;
                this.account.error = true;
                setTimeout(() =>this.account.error = false, 5000)
            },
            resetModal() {
                Object.assign(this.$data, initialState());
                requestAnimationFrame(() => this.$refs.observer.reset());
            },
            closeModal() {
		        this.resetModal();
                this.showModal = false;
            }
        }
	}
</script>

<style scoped>
    .input-line:focus {
        border-bottom-color: #ffc107;
    }
    .text-gold {
        color: #dcb251;
    }
    .modal-close {
        border: 0;
        color: #564100;
    }
    .modal-close:hover{
        color: #a67c00;
        text-decoration: none;
        text-decoration-style: initial;
        text-decoration-color: initial;
        font-weight: 700;
    }
</style>
