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
                <i class="fas fa-circle live-indicator" :class="[ {  'text-green': isConnected },'text-red']"></i>
                <span style="color: rgb(108, 117, 125); float: right;">{{ chain }}</span>
            </div>

            <div class="ath-body">
                <h5 class="ath-heading title">
                    Transfer <span style='color:#a67c00;display: initial;font-weight: bold;'>MHLK</span>
                </h5>

                <v-observer ref="observerLoginForm" v-slot="{ invalid }"  tag="form" @submit.prevent="onSubmit">

                    <!-- To Address -->
                    <v-provider vid="transferTo" name="Wallet Address" tag="div"
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
                                :rules="{required:true, numeric_decimal: /^[0-9][\.\d]*(,\d+)?$/, greater_than:0}"
                                v-slot="{ errors, valid }" class="field-item" :class="{ 'input-focused': amount.isFocused }">
                        <vue-autonumeric :options="amount.options" id="amount" name="amount" class="input-line required"
                                         :class="{ 'border-danger' : errors.length }" @focus="onFocus(amount)" @blur="onBlur(amount)"
                                         v-model="amount.value">
                        </vue-autonumeric>
                        <label for="amount" class="field-label field-label-line">Amount (MHLK)</label>
                        <div class="small text-danger" v-if="errors.length">{{ errors[0] }}</div>
                    </v-provider>

                    <!-- Private -->
                    <v-provider vid="privateKey" name="Password" rules="required|min:64" tag="div" mode="aggressive"
                                v-slot="{ errors, valid }" class="field-item" :class="{ 'input-focused': private.isFocused }">
                        <input v-model="private.address" id="privateKey" name="privateKey" type="password" class="input-line required"
                               :class="{ 'border-danger' : errors.length }" @focus="onFocus(private)" @blur="onBlur(private)"/>
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

                    <button class="btn btn-grad w-100" :class="{ 'disabled': !submittable || !recaptcha.verified }"
                            :disabled="!submittable || !recaptcha.verified" v-html="buttonLoading"></button>
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
        props: {
            address: String
        },
        computed: {
            transactionFee() {
                if (this.submittable &&  !this.isGasLimitZero) return (this.gas.selected/1e18) * this.gas.limit;
                else return 0;
            },
            submittable() {
                if( this.transferrable &&
                    this.isConnected &&
                    this.allowedPrivateKeyField &&
                    this.privateKey !== '' &&
                    this.web3 !== null &&
                    this.maharlikaContract !== null ){

                    this.estimateGasLimit(this.web3, this.maharlikaContract());
                    return true;
                }
                else return false;
            },
            isGasLimitZero() {
                return this.gas.limit === 0 || this.gas.limit === null;
            },
            isConnected() {
                return this.web3 !== null;
            },
            transferrable() {
                return this.balances.ether > 0 && this.balances.coin > 0;
            },
            allowedPrivateKeyField() {
                return  this.isValidAmount &&
                    this.isValidAddress &&
                    !this.busy &&
                    this.hasAmount;
            },
            isValidPrivateKey() {
                let key = this.privateKey;
                return key.length !== 0 && key.length === 64 ;
            },
            hasAmount() {
                return (Number(this.amount) !== 0 || Number(this.amount) !== null);
            },
            isValidAmount() {
                return Number(this.amount) > 0 && Number(this.amount) < this.balances.coin;
            },
            isValidAddress() {
                let transferTo = String(this.transferTo);
                return !this.isOwnAddress && this.web3 !== null && this.web3.utils.isAddress(transferTo);

            },
            isOwnAddress() {
                return String(this.transferTo).toLowerCase() === String(this.address).toLowerCase();
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
                    isFocused: true,
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

                decimals: 2,

                chain: 'mainnet',
                config: {
                    mainnet: {
                        provider: 'https://ethshared.bdnodes.net?auth=trtq2YNHtEU2rvJabEwqcV4BEE1M8lnpOrEV6EICHT4',
                        contractAddress: '0xE3D0a162fCc5c02C9448274D7C58E18e1811385f',
                    },
                    ropsten: {
                        provider: 'https://ropstenshared.bdnodes.net/?auth=M0olBBbNBAhkVrlZLFmlN93AF_BonbAOiHAaFr4wjr0',
                        contractAddress: '',
                    },
                    kovan: {
                        provider: 'https://kovan.infura.io/v3/befbc2de01464c24b2d9012752e5877e',
                        contractAddress: '0x66cD341f464d7c7555Cee3305e68F75AfFBb1F96',
                    }
                },
                usedConfig: null,
                contractAbiUrl: '/wallet/contract',
                contractAbi: [],

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
                web3: null,
                balances: {
                    coin: 0,
                    ether: 0
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
            getContractAbi() {
                return axios.get(this.contractAbiUrl)
                    .then(response => this.contractAbi = response.data )
            },
            connectToProvider() {
                let nodeProvider = new Web3.providers.HttpProvider(this.usedConfig.provider);
                return new Web3(nodeProvider);
            },
            maharlikaContract() {
                return new this.web3.eth.Contract(this.contractAbi, this.usedConfig.contractAddress, {from: this.address});
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
                let hexAmount = web3.utils.toHex(this.amount * 10**this.decimals);
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
                let transaction = new Tx(this.rawTransaction, { chain: this.chain, hardfork: 'petersburg' });
                transaction.sign(new Buffer(this.privateKey, 'hex'));

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

                        this.getCoinBalance();
                        console.log(this.balances.coin);
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
                let hexAmount = web3.utils.toHex(this.amount * 10**this.decimals);

                contract.methods
                    .transfer(this.transferTo, hexAmount)
                    .estimateGas({ from: this.address})
                    .then(limit => {
                        this.gas.limit = limit;
                    })
                    .catch(err => console.log(err));
            },
            getNonce() {
                // get transaction count, later will used as nonce
                return this.web3.eth.getTransactionCount(this.address)
                    .then((v) => {
                        this.count = v;
                        console.log(`nonce: ${this.count}`);
                    });
            },
            getCoinBalance() {
                this.maharlikaContract().methods.balanceOf(this.address)
                    .call().then(coinBalance => this.balances.coin = coinBalance/10**this.decimals);

            },
            getEtherBalance() {
                this.web3.eth.getBalance(this.address)
                    .then(balance => {
                        this.balances.ether = this.web3.utils.fromWei(balance, 'ether');
                    });
            },
        },
        mounted() {
            this.usedConfig = (this.config[this.chain]);
            this.getDollarPrice();
            this.getGasPrices();
            this.getContractAbi().then(() => {
                this.web3 = this.connectToProvider();
                this.getCoinBalance();
                this.getEtherBalance();
            });

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
