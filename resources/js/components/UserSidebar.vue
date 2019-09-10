<template>
    <div class="user-box d-none d-lg-block" style="padding:30px;">
        <div class="user-image">
            <img src="/images/eth-qr.png" alt="adddress">
        </div>
        <h6 class="user-name">{{ address | trimAddress }}</h6>
        <ul class="btn-grp guttar-10px">
            <li><a href="#" class="btn btn-grad">TRANSFER</a></li>
            <li>
                <b-button id="toggle-button" class="btn btn-grad" :class="{ 'disable': !transferrable}"
                          :disabled="!transferrable" @click="toggleModal">Transfer</b-button>
            </li>
        </ul>

        <b-modal ref="transfer-modal" @hide="resetModal" hide-header hide-footer no-close-on-backdrop>
            <a href="#" class="modal-close" data-dismiss="modal" aria-label="Close" @click="toggleModal">
                <em class="ti ti-close"></em>
            </a>
            <div class="ath-container m-0">

                <div style="float: right; position: relative;">
                    <i class="fas fa-circle live-indicator" :class="[ {  'text-green': isConnected },'text-red']"></i>
                    <span style="color: rgb(108, 117, 125); float: right;">mainnet</span>
                </div>

                <div class="ath-body">
                    <h5 class="ath-heading title">
                        Transfer <span style='color:#a67c00;display: initial;font-weight: bold;'>MHLK</span>
                    </h5>

                    <!-- transfer to -->
                    <div class="field-item">
                        <div class="field-wrap">
                            <b-form-input v-model="transferTo" :state="isValidAddress"
                                          id="transfer-address" name="address" :disabled="busy" class="input-bordered"
                                          required placeholder="Wallet address you want to transfer to">
                            </b-form-input>
                            <b-form-invalid-feedback :state="isValidAddress">
                                Only a valid Ethereum wallet address can be entered.
                            </b-form-invalid-feedback>
                            <b-form-valid-feedback :state="isValidAddress">
                                Nice!
                            </b-form-valid-feedback>
                        </div>
                    </div>

                    <!-- amount -->
                    <div class="field-item">
                        <div class="field-wrap">
                            <b-form-input v-model="amount" :state="isValidAmount"
                                          id="transfer-amount" name="amount" :disabled="busy" type="number"
                                          class="input-bordered"
                                          required placeholder="Amount of MHLK">
                            </b-form-input>
                            <b-form-invalid-feedback :state="isValidAmount">
                                Amount (MHLK) must be greater than 0.
                            </b-form-invalid-feedback>
                            <b-form-valid-feedback :state="isValidAmount">
                                Looks Good.
                            </b-form-valid-feedback>
                        </div>
                    </div>

                    <!-- private key -->
                    <div class="field-item">
                        <div class="field-wrap">
                            <textarea class="input-bordered" name="address" v-model="privateKey"
                                   :disabled="!allowedPrivateKeyField"
                                      placeholder="Your private Key"></textarea>
                        </div>
                    </div>

                    <!-- transfer button -->
                    <b-button class="btn btn-grad w-100" :class="{ 'disable': busy }"
                              :disabled="!submittable" @click="transfer"
                              v-html="buttonLoading"></b-button>
                    <span v-show="busy" v-html="status"></span>
                </div>
            </div>
        </b-modal>
    </div>
</template>

<script>
	export default {
    import { BForm, BFormInput, BButton, BModal, BFormValidFeedback, BFormInvalidFeedback } from 'bootstrap-vue'
    let Tx = require('ethereumjs-tx').Transaction;

    export default {
		name: "UserSidebar",
        components: {
            BFormInvalidFeedback,
            BFormValidFeedback,
		    BModal,
            BButton,
            BFormInput,
            BForm
        },
        props: {
		    address: String
        },
        beforeCreate() {
        computed: {
		    submittable() {
                return this.transferrable &&
                    this.isConnected &&
                    this.allowedPrivateKeyField &&
                    this.privateKey !== '';
            },
            isConnected() {
                return this.web3 !== null;
            },
		    transferrable() {
                return this.balances.ether > 0;
            },
            allowedPrivateKeyField() {
                return  this.isValidAmount &&
                    this.isValidAddress &&
                    !this.busy &&
                    (Number(this.amount) !== 0 || Number(this.amount) !== null);
            },
            isValidAmount() {
                return Number(this.amount) > 0 && Number(this.amount) < this.balances.coin;
            },
            isValidAddress() {
		        let transferTo = String(this.transferTo);
		        return !this.isOwnAddress &&  (transferTo !== '');
            },
            isOwnAddress() {
                return String(this.transferTo).toLowerCase() === String(this.address).toLowerCase();
            },
        },
        data() {
            return {
                decimals: 2,
                provider: 'https://ethshared.bdnodes.net?auth=uampStnJT55ABaYvG3HEg2qUFlQcgLZED9Tgw7o1GSQ',
                contractAddress: '0xE3D0a162fCc5c02C9448274D7C58E18e1811385f',
                contractAbiUrl: '/wallet/contract',
                contractAbi: [],
                amount: 0,
                transferTo: '',
                privateKey: '',
                count: 0,
                buttonLoading: 'Send MHLK',
                busy: false,
                tries: 0,
                status: 'Status: Idle',
                web3: null,
                etherScanApiBaseUrl: 'https://api.etherscan.io/api?',
                module: 'account',
                action: 'tokenbalance',
                etherscanApikey: 'GEPXM3N11F476EMB8FCXG2XVK89Y5PKMFK',
                balances: {
                    coin: 0,
                    ether: 0
                },
                chain: 'mainnet',
                rawTransaction: null,
            }
        },
        methods: {
		    resetButtonLoading() {
		        this.buttonLoading = 'Send MHLK';
                this.tries = 0;
                setTimeout(() => {
                        this.status = 'Status: Idle';
                        this.busy = !this.busy;
                    }, 2000)
            },
            resetModal() {
                this.amount = 0;
                this.transferTo = '';
                this.privateKey = '';
            },
            toggleModal() {
                this.$refs['transfer-modal'].toggle('#toggle-button')
            },

            getContractAbi() {
                return axios.get(this.contractAbiUrl)
                    .then(response => this.contractAbi = response.data)
            },
            connectToProvider() {
                let nodeProvider = new Web3.providers.HttpProvider(this.provider);
                return new Web3(nodeProvider);
            },
            maharlikaContract() {
                return new this.web3.eth.Contract(this.contractAbi, this.contractAddress, {from: this.address});
            },
            transfer() {
                console.log('Start Transaction');
                if (!this.transferrable) return;
                this.busy = true;
                this.buttonLoading = '<i class="fas fa-spinner fa-spin"></i>';
                this.status = 'Status: <span style="color:#ffc107">transacting...</span>';

                this.getNonce()
                    .then(() => {
                        this.transact(this.web3, this.maharlikaContract());

                    });
            },
            transact(web3, contract) {
		        let hexAmount = this.web3.utils.toHex(this.amount * 10**this.decimals);
                this.rawTransaction = {
                    "from": this.address,
                    "gasPrice":web3.utils.toHex(5 * 1e10),
                    "gasLimit":web3.utils.toHex(8000000),
                    "to": this.contractAddress,
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

                        this.maharlikaContract().methods.balanceOf(this.address)
                            .call()
                            .then( balance => console.log(balance/10**this.decimals));
                    })
                    .catch(err => {
                        if(this.tries < 3){
                            console.log('Failed to transact:' +err);
                            console.log('tries: ' + this.tries);
                            this.tries++;
                            this.count++;
                            this.transact(
                                this.web3,
                                this.maharlikaContract()
                            );
                        }
                        else {
                            this.status = 'Status: <span style="color:#dc3545">Failed transferring token</span>';
                            this.resetButtonLoading();
                        }
                    });
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
            async getEtherBalance() {
		        let weiBalance = await this.web3.eth.getBalance(this.address);
                this.balances.ether = this.web3.utils.fromWei(weiBalance, 'ether');
            }
        },
        mounted() {
            this.getContractAbi().then(() => {
                this.web3 = this.connectToProvider();
                this.getCoinBalance();
                this.getEtherBalance();
            });
        }
	}
</script>
<style scoped>
</style>
