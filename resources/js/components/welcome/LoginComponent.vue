<template>
    <div class="cpn-btns">
        <button class="btn btn-lg btn-grad grant border-0" @click="$store.dispatch('toggleLogin', true)">Access your Wallet</button>
        <b-modal ref="login-modal" v-model="showModal" centered hide-header hide-footer no-close-on-backdrop @hidden="onHide">
            <button class="modal-close"
                    data-dismiss="modal" aria-label="Close" @reset="resetModal" @click="showModal = false">
                <em class="ti ti-close"></em>
            </button>
            <div class="ath-container p-4">
                <h2 class="pt-2 pb-5 text-center">Welcome to <span style="color:goldenrod">Maharlika Coin</span></h2>
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

                    <!-- hcaptcha -->
                    <div class="pb-4 d-flex flex-column align-items-center">
                        <vue-hcaptcha :sitekey="hcaptcha.siteKey" ref="createHcaptcha"
                                      @error="onHcaptchaError" @verify="verifyHcaptcha" @expired="onHcaptchaExpire">
                        </vue-hcaptcha>
                        <div class="small text-danger" v-if="!hcaptcha.verified">{{ hcaptcha.message }}</div>
                    </div>

                    <!-- Access Button-->
                    <button class="btn btn-grad w-100 border-0 btn-lg" :class="{ 'disabled': invalid || busy || !hcaptcha.verified }"
                            :disabled="invalid || busy || !hcaptcha.verified" v-html="button"></button>
                    <div class="small text-danger" v-if="account.error">{{ account.message }}</div>

                    <!-- Dont have wallet -->
                    <div class="create small text-muted pointer mt-3" @click="dontHaveWallet">Don't have wallet yet?</div>
                </v-observer>
            </div>
        </b-modal><!-- .modal @e -->
    </div>


</template>

<script>
    import { BModal } from 'bootstrap-vue';
    import { utils } from 'ethers';
    import { ValidationObserver, ValidationProvider} from 'vee-validate';
    import VueHcaptcha from '@hcaptcha/vue-hcaptcha';

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
                message: ''
            },
            button: 'Access',
            busy: false,
            hcaptcha: {
                verified: false,
                message: '',
                siteKey: process.env.MIX_HCAPTCHA_SITE_KEY
            }
        }
    }
	export default {
		name: "LoginComponent",
        components: {
		    BModal,
            VueHcaptcha
        },
        data() {
		    return initialState()
        },
        methods: {
		    dontHaveWallet() {
                this.$store.dispatch('toggleLogin', false);
                setTimeout(()=>this.$store.dispatch('toggleCreate', true),300);
            },
		    onHide() {
		        this.$store.dispatch('toggleLogin', false)
            },
		    onFocus(field) {
                field.isFocused = true;
            },
            onBlur(field){
                field.isFocused = field.key !== '';
            },
		    access() {
                if(!this.hcaptcha.verified) {
                    this.hcaptcha.message = 'Please let us know that you are a human.';
                    return;
                }
		       this.verify(this)
            },
            verify: _.debounce((vm) => {
		        try {
                    vm.button = '<em class="fas fa-spinner fa-spin"></em>';
                    vm.busy = true;

                    if (vm.private.key !== 66 && vm.private.key.substring(0,2) !== "0x") {
                        vm.private.key = `0x${vm.private.key}`
                    }

                    let computed = utils.computeAddress(vm.private.key),
                        addr = utils.getAddress(vm.public.key);

                    if( computed === addr ) {
                        axios.post('/wallet', { address: addr})
                            .then(response => {
                                let url = response.data.url;
                                if(url !== '')
                                    window.location.href = url;

                                else
                                    vm.showError('Something went wrong. Please try again.');
                            })
                            .catch(err => {
                                if(err.response.status === 419){
                                    vm.showError('Please reload your browser.');
                                }

                            })
                    }
                    else vm.showError('Try again. Please be cautious, your account may get locked after massive multiple retries.');
                }catch (e) {
                    vm.showError('Try again. Please be cautious, your account may get locked after massive multiple retries.');
                }
            }, 100),
            showError(message) {
                // show error then hide after 5sec
                this.button = 'Access';
                this.busy = false;
                this.account.message = message;
                this.account.error = true;
                setTimeout(() =>this.account.error = false, 5000)
            },
            resetModal() {
                Object.assign(this.$data, initialState());
                requestAnimationFrame(() => this.$refs.observer.reset());
            },
            verifyHcaptcha() {
                this.hcaptcha.message = '';
                this.hcaptcha.verified = true;
            },
            onHcaptchaExpire() {
                alert('Captcha Expired. Please answer again');
                this.hcaptcha.message = '';
                this.hcaptcha.verified = false;
            },
            onHcaptchaError() {
                alert('Captcha Fails.');
                this.hcaptcha.message = '';
                this.hcaptcha.verified = false;
            }
        },
        mounted() {
		    this.$store.subscribe((mutation) => {
		        this.showModal = (mutation.type === 'TOGGLELOGIN' && mutation.payload)
            })
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
    div.create:hover{
        color: darkgoldenrod !important;
    }
</style>
