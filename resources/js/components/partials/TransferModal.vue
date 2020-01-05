<template>
    <b-modal ref="transferModal" v-model="showModal" hide-header hide-footer no-close-on-backdrop centered
             @hidden="onHide">

        <!-- close -->
        <button class="modal-close" @click="$refs.transferModal.hide()" @reset="resetModal">
            <em class="ti ti-close"></em>
        </button>

        <!-- contents -->
        <div class="ath-container m-0">
            <div class="relative text-right mr-5">
                <i class="fas fa-circle live-indicator" :class="[ {'text-green':connected}, 'text-red' ]"></i>
                <span style="color: rgb(108, 117, 125); float: right;">{{ $store.state.network }}</span>
            </div>

            <div class="ath-body">
                <h5 class="ath-heading title">
                    Transfer <span style='color:#a67c00;display: initial;font-weight: bold;'>MHLK</span>
                </h5>

                <v-observer ref="observerLoginForm" v-slot="{ invalid }"  tag="form" @submit.prevent="onSubmit">

                    <!-- To Address -->
                    <v-provider vid="transferTo" name="Wallet Address" tag="div" autocomplete="off"
                                :rules="{ required: true, ethereumAddress: address, notOwnedAddress: `${address}`}"
                                mode="aggressive" v-slot="{ errors, valid }" class="field-item"
                                :class="{ 'input-focused': transferTo.isFocused }">
                        <input v-model="transferTo.address" id="transferTo" name="transferTo" type="text" class="input-line required"
                               :class="{ 'border-danger' : errors.length }" @focus="onFocus(transferTo)" @blur="onBlur(transferTo)"/>
                        <label for="transferTo" class="field-label field-label-line">Wallet Address (Public Key)</label>
                        <span class="small text-black-50">
                            <i class="fas fa-info-circle"></i>
                            Wallet Address of the person you will send coins to
                        </span>
                        <div class="small text-danger" v-if="errors.length">{{ errors[0] }}</div>
                    </v-provider>

                    <!-- amount -->
                    <v-provider vid="amount" name="Amount" tag="div" mode="aggressive"
                                rules="required|numeric_decimal|greater_than:0"
                                v-slot="{ errors, valid }" class="field-item input-focused">
                        <vue-autonumeric :options="amount.options" id="amount" name="amount" class="input-line required"
                                         :class="{ 'border-danger' : errors.length }" autocomplete="off" v-model="amount.value">
                        </vue-autonumeric>
                        <label for="amount" class="field-label field-label-line">Amount (MHLK)</label>
                        <div class="small text-danger" v-if="errors.length">{{ errors[0] }}</div>
                    </v-provider>

                    <!-- Private -->
                    <v-provider vid="privateKey" name="Password" rules="required|min:64" tag="div" mode="aggressive"
                                v-slot="{ errors, valid }" class="field-item" :class="{ 'input-focused': private.isFocused }">
                        <input v-model="private.address" id="privateKey" name="privateKey" type="password"
                                  class="input-line required" :class="{ 'border-danger' : errors.length }"
                                  @focus="onFocus(private)" @blur="onBlur(private)"/>
                        <label for="privateKey" class="field-label field-label-line">Wallet Key (Private Key)</label>
                        <span class="small text-black-50">
                            <i class="fas fa-info-circle"></i>
                            Must be at least 64 characters
                        </span>
                        <div class="small text-danger" v-if="errors.length">{{ errors[0] }}</div>
                    </v-provider>

                    <!-- estimated cost -->
                    <div class="field-item" v-if="transactionFee">
                        <a href="#" v-show="!toggleTransactionInfo"
                           @click="toggleTransactionInfo = !toggleTransactionInfo">
                            Show more information
                        </a>
                        <a href="#" v-show="toggleTransactionInfo"
                           @click="toggleTransactionInfo = !toggleTransactionInfo">
                            Hide
                        </a>
                        <div v-if="toggleTransactionInfo">
                            <div>Gas Price: {{ gas.selected / 1e9 }} GWEI</div>
                            <div>Gas Limit: {{ gas.limit }}</div>
                        </div>
                        <div>
                            Transaction Fee: {{ transactionFee | numberFormat('0.0000') }} ETH
                            ( ${{ transactionFee * ethPrice.usd | numberFormat('0,000.00') }} )
                        </div>
                    </div>

                    <!-- recaptcha -->
                    <div class="pb-4 align-items-center d-flex flex-column">
                        <vue-recaptcha sitekey="6LehC8sUAAAAAPClZLOLeTz43VGiK6014b0KpmmQ" @verify="verifyRecaptcha"
                                       ref="createRecaptcha" :loadRecaptchaScript="true"></vue-recaptcha>
                        <div class="small text-danger" v-if="!recaptcha.verified">{{ recaptcha.message }}</div>
                    </div>

                    <button class="btn btn-grad w-100" :class="{ 'disabled': !submittable || invalid}"
                            :disabled="!submittable || invalid" v-html="buttonLoading"></button>
                    <span v-html="status"></span>
                </v-observer>
            </div>
        </div>
    </b-modal>
</template>

<script>
    import { BModal } from 'bootstrap-vue'
    import 'vue-autonumeric'
    import { utils } from 'ethers';
    import { ValidationObserver, ValidationProvider} from 'vee-validate';
    import VueRecaptcha from 'vue-recaptcha'
    let Tx = require('ethereumjs-tx').Transaction;

    Vue.component('VObserver', ValidationObserver);
    Vue.component('VProvider', ValidationProvider);

    export default {
        name: "TransferModal",
        components: {
            VueRecaptcha,
            BModal
        },
        props: ['address'],
        computed: {
            transactionFee() {
                return (this.submittable &&  !this.isGasLimitZero) ?
                    ((this.gas.selected/1e18) * this.gas.limit): 0;
            },
            connected() {
                return this.$store.state.provider !== '' && this.$store.state.maharlika
            },
            transferrable() {
                return this.$store.state.balances.ether > 0 && this.$store.state.balances.coin > 0;
            },
            submittable() {
                return this.transferrable && this.private.address !== '' &&
                    this.recaptcha.verified && this.connected !== ''
            },
            isGasLimitZero() {
                return this.gas.limit === 0 || this.gas.limit === null;
            }
        },
        data() {
            return {
                transferTo: {
                    address: '',
                    isFocused: false,
                },
                private: {
                    address: '',
                    isFocused: false,
                },
                amount: {
                    value: 0,
                    options:{
                        digitGroupSeparator: ',',
                        decimalCharacter: '.',
                        currencySymbol: '  MHLK',
                        currencySymbolPlacement: 's',
                        roundingMethod: 'U',
                        minimumValue: '0'
                    }
                },
                recaptcha: {
                    verified: false,
                    message: ''
                },
                showModal: false,

                count: 0,
                buttonLoading: 'Send MHLK',
                busy: false,
                tries: 0,
                status: 'Status: Idle',

                gas: {
                    selected: null,
                    prices: {
                        fastest: 0,
                        fast: 0,
                        average: 0,
                        slow: 0,
                        slowest: 0,
                    },
                    limit: 0
                },

                // chain: 'mainnet',
                rawTransaction: null,
                transacting: false,
                toggleTransactionInfo: false,
                ethPrice: {
                    usd: 0
                },
            }
        },
        methods: {
            onHide() {
                this.$store.dispatch('toggleTransferModal', false)
            },
            onFocus(field) {
                field.isFocused = true;
            },
            onBlur(field){
                field.hasOwnProperty('address') ? field.isFocused = field.address !== '' : false;
                field.hasOwnProperty('value') ? field.isFocused = field.value !== '' : false;
            },
            verifyRecaptcha() {
                this.recaptcha.message = '';
                this.recaptcha.verified = true;
            },

            resetStatus() {
                this.status = 'Status: New Transaction'
            },
            resetFields() {
                setTimeout(() => {
                    this.transferTo = '';
                    this.amount = 0;
                }, 2000)
            },
            resetButtonLoading() {
                this.transacting = false;
                this.buttonLoading = 'Send MHLK';
                this.tries = 0;
                this.busy = false;
            },
            resetModal() {
                this.amount = 0;
                this.transferTo = '';
                this.privateKey = '';
                this.resetStatus();
                this.resetButtonLoading();
            },
            onSubmit() {
                console.log('Start Transaction');
                if (!this.submittable) return;
                this.busy = true;
                this.buttonLoading = '<i class="fas fa-spinner fa-spin"></i>';
                this.status = 'Status: <span style="color:#ffc107">transacting...</span>';

                this.getNonce()
                    .then(() => {
                        if(this.transacting) {
                            console.log('you are still transacting');
                            return;
                        }
                        this.transact(this.web3, this.maharlikaContract());
                    })
                    .catch(err => {
                        this.status = 'Status: <span style="color:#dc3545">Please check your public and private keys</span>';
                        this.resetButtonLoading();
                        console.log(err.message)
                    });
            },
            transact(web3, contract) {
                this.transacting = true;
                let hexAmount = web3.utils.toHex(this.amount * 10**this.$store.state.balances.decimals);
                this.rawTransaction = {
                    "from": this.address,
                    "gasPrice":web3.utils.toHex(this.gas.selected),
                    "gasLimit":web3.utils.toHex(this.gas.limit),
                    "to": this.usedConfig.contractAddress,
                    "value":"0x0",
                    "data": contract.methods.transfer(this.transferTo, hexAmount).encodeABI(),
                    "nonce":web3.utils.toHex(this.count)
                };

                //sign transaction
                let transaction = new Tx(this.rawTransaction, { chain: this.$store.state.network, hardfork: 'petersburg' });
                transaction.sign(new Buffer(this.private.address, 'hex'));

                this.sendTransaction(transaction);

            },
            sendTransaction(transaction) {
                // send transaction
                this.web3.eth
                    .sendSignedTransaction(`0x${transaction.serialize().toString('hex')}`)
                    .then(response => {
                        console.log('Successfully Transact', response);
                        this.status = 'Status: <span style="color:#28a745">Successfully Transferred MHLK</span>';
                        this.count++;
                        this.resetButtonLoading();
                        this.resetFields();

                        this.$store.dispatch('updateCoin', this.address);
                        console.log(this.$store.state.balances.coin);
                    })
                    .catch(err => {
                        console.log(err.message);
                        this.status = 'Status: <span style="color:#dc3545">Failed transferring token. Check your private and public keys</span>';
                        this.resetButtonLoading();
                    });
            },
            getDollarPrice() {
                delete axios.defaults.headers.common["X-Requested-With"];
                axios.get('https://api.etherscan.io/api?module=stats&action=ethprice')
                    .then(response => {
                        this.ethPrice.usd = response.data.result.ethusd;
                        console.log(this.ethPrice.usd)
                    })
            },
            getGasPrices() {
                delete axios.defaults.headers.common["X-Requested-With"];
                axios.get('https://ethgasstation.info/json/ethgasAPI.json')
                    .then(response => {
                        let data = response.data;
                        this.gas.prices = {
                            fastest: data.fastest * 1e8,
                            fast: data.fast * 1e8,
                            average: data.average * 1e8,
                            slow: data.safeLow * 1e8,
                            slowest: data.safeLowWait * 1e8,
                        };

                        this.gas.selected = this.gas.prices.fastest;
                    })
            },
            estimateGasLimit(web3, contract) {
                let hexAmount = web3.utils.toHex(this.amount * 10**this.$store.state.balances.decimals);

                contract.methods
                    .transfer(this.transferTo, hexAmount)
                    .estimateGas({ from: this.address})
                    .then(limit => {
                        this.gas.limit = limit;
                    })
                    .catch(err => console.log(err));

                return true
            },
            getNonce() {
                // get transaction count, later will used as nonce
                return this.web3.eth.getTransactionCount(this.address)
                    .then((v) => {
                        this.count = v;
                        console.log(`nonce: ${this.count}`);
                    });
            },
            getEtherBalance() {
                this.web3.eth.getBalance(this.address)
                    .then(balance => {
                        this.balances.ether = this.web3.utils.fromWei(balance, 'ether');
                    });
            },
        },
        mounted() {
            this.usedConfig = this.$store.state.config.used;
            this.getDollarPrice();
            this.getGasPrices();
            // this.getContractAbi().then(() => {
            //     this.web3 = this.connectToProvider();
            // });

            this.$store.subscribe((mutation, state) => {
                if(mutation.type === 'TOGGLETRANSFERMODAL' && mutation.payload)
                    this.showModal = mutation.payload

            })
        },
        watch: {
            'private.address': function(value) {
                let firstTwoCharacters = value.substring(0, 2);
                if(firstTwoCharacters === '0x')
                    this.private.address = value.slice(2);
            },
        }
    }
</script>
<style scoped>
</style>
