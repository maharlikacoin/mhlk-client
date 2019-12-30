<template>
    <div>
        <div class="cpn-btns">
            <a class="btn btn-lg btn-grad-borderless shadow-none" href="#" @click="showModal = !showModal">Create Wallet</a>
        </div>

        <b-modal ref="create-wallet-modal" @hide="resetModal" v-model="showModal"
                 centered hide-header hide-footer no-close-on-backdrop>
            <a href="#" class="modal-close" data-dismiss="modal" aria-label="Close" @click="showModal = false">
                <em class="ti ti-close"></em>
            </a>
            <div class="ath-container m-0">

                <div class="ath-body pad-0">
                    <h5 class="ath-heading title">Create Wallet</h5>

                    <!-- private key -->
                    <div class="field-item">
                        <div class="field-wrap">
                            <div class="input-group">
                                <input class="input-bordered form-control" name="address" v-model="keys.public"
                                       disabled placeholder="Copy your created wallet address (public key)"/>
                                <div class="input-group-append">
                                    <button class="btn btn-sm clipboard-button"
                                            :class="{ 'disabled': keys.public === ''}"
                                            :disabled="keys.public === ''"
                                            v-clipboard:copy="keys.public"
                                            v-clipboard:success="onCopy"
                                            v-clipboard:error="onError">
                                        <i class="fas fa-copy clipboard-icon"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- private key -->
                    <div class="field-item">
                        <div class="field-wrap">
                            <div class="input-group">
                            <textarea class="input-bordered form-control" name="privateKey" v-model="keys.private"
                                      disabled placeholder="Copy your generated private key"></textarea>
                                <div class="input-group-append">
                                    <button class="btn btn-sm clipboard-button"
                                            :class="{ 'disabled': keys.private === '' }"
                                            :disabled="keys.private === ''"
                                            v-clipboard:copy="keys.private"
                                            v-clipboard:success="onCopy"
                                            v-clipboard:error="onError">
                                        <i class="fas fa-copy clipboard-icon"></i>
                                    </button>
                                </div>
                            </div>

                        </div>
                    </div>

                    <!-- Create button -->
                    <b-button class="btn btn-grad w-100" :class="{ 'disable': busy }" @click="create"
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

    export default {
        name: "CreateWallet",
        components: {
            BModal,
            BButton,
        },
        data() {
            return {
                showModal: false,
                busy: false,
                buttonLoading: 'Create Wallet',
                keys: {
                    public: '',
                    private: ''
                },
                status: 'Please wait ...'
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
                let myWallet = wallet.generate();
                this.keys.public = myWallet.getAddressString();
                this.keys.private = myWallet.getPrivateKeyString().substring(2);
            }
        }
    }
</script>

<style scoped>
    button.btn.btn-sm.clipboard-button:focus {
        box-shadow: 0 0 0 0.2rem rgba(255, 255, 255, 0.05);
    }
    .clipboard-button {
        min-width: 45px;
        border: 1px solid #d3e0f3;
        width: 10px !important;
    }
    .clipboard-icon {
        margin: 0;
        color: black;
    }
</style>
