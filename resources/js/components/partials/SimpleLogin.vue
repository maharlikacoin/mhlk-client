<template>
    <div class="cpn-btns cpn-btns d-flex justify-content-center">
        <button class="border-0 btn btn-grad btn-lg shadow-lg" @click="showModal = true">
            <i class="fas fa-lock"></i> View Document
        </button>

        <b-modal ref="simpleLogin-modal" v-model="showModal" centered hide-header hide-footer no-close-on-backdrop @hidden="onHide">
            <button class="modal-close"
                    data-dismiss="modal" aria-label="Close" @reset="resetModal(this)" @click="showModal = false">
                <em class="ti ti-close"></em>
            </button>
            <div class="ath-container p-4">
                <h2 class="pt-2 pb-5 text-center text-red text-uppercase font-weight-bolder">
                    <i class="fas fa-exclamation-circle"></i> Highly Confidential
                </h2>
                <v-observer ref="observerSimpleLoginForm" v-slot="{ invalid }"  tag="form" @submit.prevent="access">

                    <v-provider vid="password" name="Wallet Address" rules="required" tag="div" mode="aggressive"
                                v-slot="{ errors, valid }" class="field-item" :class="{ 'input-focused': isFocused }">
                        <input v-model="password" id="password" name="password" type="password" class="input-line required"
                               :class="{ 'border-danger' : errors.length }" @focus="isFocused = true" @blur="isFocused = password !== ''"/>
                        <label for="password" class="field-label field-label-line">Password</label>
                        <span class="small text-black-50">Request access from
                            <a href="mailto:inquiries@formulagreencorp.com">inquiries@formulagreencorp.com</a>
                        </span>
                        <div class="small text-danger" v-if="errors.length">{{ errors[0] }}</div>
                    </v-provider>

                     <!--recaptcha-->
                    <div class="pb-4 d-flex flex-column align-items-center">
                        <vue-recaptcha sitekey="6LehC8sUAAAAAPClZLOLeTz43VGiK6014b0KpmmQ" @verify="verifyRecaptcha"
                                       @expired="expireRecaptcha"
                                       ref="createRecaptcha" :loadRecaptchaScript="true"></vue-recaptcha>
                        <div class="small text-danger" v-if="!recaptcha.verified">{{ recaptcha.message }}</div>
                    </div>

                    <button class="btn btn-grad w-100 border-0" :class="{ 'disabled': invalid || busy || !recaptcha.verified }"
                            :disabled="invalid || busy || !recaptcha.verified" v-html="button"></button>
                    <div class="small text-danger" v-if="account.error">{{ account.message }}</div>
                </v-observer>
            </div>
        </b-modal><!-- .modal @e -->
    </div>


</template>

<script>
    import { BModal } from 'bootstrap-vue'
    import { ValidationObserver, ValidationProvider} from 'vee-validate'
    import VueRecaptcha from 'vue-recaptcha'

    Vue.component('VObserver', ValidationObserver);
    Vue.component('VProvider', ValidationProvider);

    function initialState() {
        return {
            showModal: false,
            isFocused: false,
            password : '',
            account: {
                error: false,
                message: ''
            },
            button: 'Access',
            busy: false,
            recaptcha: {
                verified: false,
                message: ''
            }
        }
    }
    export default {
        name: "SimpleLogin",
        components: {
            BModal,
            VueRecaptcha
        },
        data() {
            return initialState()
        },
        methods: {
            onHide() {
                this.showModal = false
            },
            access() {
                // if(!this.recaptcha.verified) {
                //     this.recaptcha.message = 'Please let us know that you are not a Robot.';
                //     return;
                // }
                this.verify(this)
            },
            verify: _.debounce((vm) => {
                try {
                    if( vm.password === process.env.MIX_DOSSIER_PASSWORD) {
                        vm.$emit('input', vm.password);
                        vm.resetModal(vm)
                    }
                    else {
                        vm.showError('Be careful, this session is being monitored for high security purposes.');
                        vm.$emit('input', null);
                    }
                }catch (e) {
                    vm.showError('Something went wrong. Please try again later.');
                    vm.$emit('input', null);
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
            resetModal(vm) {
                Object.assign(vm.$data, initialState());
            },
            verifyRecaptcha() {
                this.recaptcha.message = '';
                this.recaptcha.verified = true;
            },
            expireRecaptcha() {
                this.recaptcha.message = 'Recaptcha expired, check the checkbox again.';
                this.recaptcha.verified = false;
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
</style>
