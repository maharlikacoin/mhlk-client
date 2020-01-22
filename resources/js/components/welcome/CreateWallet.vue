<template>
    <div>
        <div class="cpn-btns">
            <button class="btn btn-lg btn-grad-borderless shadow-none" @click="showModal = !showModal">Create Wallet</button>
        </div>

        <b-modal ref="create-wallet-modal" @hide="resetModal" v-model="showModal"
                 centered hide-header hide-footer no-close-on-backdrop>
            <button class="modal-close" @click="showModal = false">
                <em class="ti ti-close"></em>
            </button>
            <div class="ath-container m-0">

                <div class="ath-body pad-0">
                    <h5 class="ath-heading title py-4">Create Wallet</h5>

                    <div class="field-item input-focused">
                        <button id="publicKey" class="key input-line text-left text-wrap" v-clipboard:copy="keys.public"
                                v-clipboard:success="onCopy" v-clipboard:error="onError"> {{ keys.public }}
                        </button>
                        <label for="publicKey" class="field-label field-label-line">Wallet Address (Public Key)</label>
                    </div>

                    <div class="field-item input-focused">
                        <button id="privateKey" class="key input-line text-left text-wrap" v-clipboard:copy="keys.private"
                                v-clipboard:success="onCopy" v-clipboard:error="onError"> {{ keys.private }}
                        </button>
                        <label for="privateKey" class="field-label field-label-line">Wallet Key (Private Key)</label>
                    </div>

                    <!-- recaptcha -->
                    <div class="pb-4 d-flex flex-column align-items-center">
                        <vue-recaptcha sitekey="6LehC8sUAAAAAPClZLOLeTz43VGiK6014b0KpmmQ" @verify="verifyRecaptcha"
                                       ref="createRecaptcha" :loadRecaptchaScript="true"></vue-recaptcha>
                        <div class="small text-danger" v-if="!recaptcha.verified">{{ recaptcha.message }}</div>
                    </div>

                    <!-- Create button -->
                    <b-button class="btn btn-grad w-100 border-0" :class="{ 'disabled': busy || !recaptcha.verified }"
                              @click="create" :disabled="busy || !recaptcha.verified"
                              v-html="buttonLoading"></b-button>

                    <span v-show="busy" v-html="status"></span>
                </div>
            </div>
        </b-modal>
    </div>
</template>

<script>
    import {BModal, BButton} from 'bootstrap-vue';
    import wallet from 'ethereumjs-wallet';
    import VueRecaptcha from 'vue-recaptcha'

    export default {
        name: "CreateWallet",
        components: {
            BModal,
            BButton,
            VueRecaptcha
        },
        data() {
            return {
                showModal: false,
                busy: false,
                buttonLoading: 'Create',
                keys: {
                    public: '',
                    private: ''
                },
                status: 'Please wait ...',
                recaptcha: {
                    verified: false,
                    message: ''
                }
            }
        },
        methods: {
            onCopy(e) {
                alert('Successfully copied: ' + e.text);
            },
            onError(){
                alert('Failed to copy. Try again.');
            },
            resetModal(){
                this.keys.public = '';
                this.keys.private = '';
            },
            create() {
                if(!this.recaptcha.verified) {
                    this.recaptcha.message = 'Please let us know that you are not a Robot.';
                    return;
                }

                let myWallet = wallet.generate();
                this.keys.public = myWallet.getAddressString();
                this.keys.private = myWallet.getPrivateKeyString().substring(2);
                this.$refs.createRecaptcha.reset();
                this.recaptcha.message = '';
                this.recaptcha.verified = false;
            },
            verifyRecaptcha() {
                this.recaptcha.message = '';
                this.recaptcha.verified = true;
            }
        }
    }
</script>

<style scoped>

    button.key {
        outline-color: transparent;
        cursor: pointer;
        position: relative;
        z-index: 2;
        background: rgba(0, 0, 0, 0.1);
        padding: 30px 15px 15px;
        color: #415076;
    }

    button.key + label {
        padding-left: 15px;
        padding-top: 3px;
        top: 0;
    }

    .input-line:focus {
        border-bottom-color: #ffc107;
    }
</style>
