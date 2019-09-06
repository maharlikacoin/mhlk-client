<template>
    <div class="user-box d-none d-lg-block" style="padding:30px;">
        <div class="user-image">
            <img src="/images/eth-qr.png" alt="adddress">
        </div>
        <h6 class="user-name">{{ address | trimAddress }}</h6>
        <ul class="btn-grp guttar-10px">
            <li><a href="#" class="btn btn-grad">TRANSFER</a></li>
            <li>
                <b-button id="toggle-button" class="btn btn-grad" @click="toggleModal">Transfer</b-button>
            </li>
        </ul>

        <b-modal ref="transfer-modal" @hide="resetModal" hide-header hide-footer no-close-on-backdrop>
            <a href="#" class="modal-close" data-dismiss="modal" aria-label="Close" @click="toggleModal">
                <em class="ti ti-close"></em>
            </a>
            <div class="ath-container m-0">
                <div class="ath-body">
                    <h5 class="ath-heading title">Transfer</h5>

                    <!-- transfer to -->
                    <div class="field-item">
                        <div class="field-wrap">
                            <b-form-input v-model="transferTo" :state="isNotOwnAddress" id="transfer-address"
                                          name="address" :disabled="busy"
                                          class="input-bordered" required placeholder="Address you want to transfer to">
                            </b-form-input>
                            <b-form-invalid-feedback :state="isNotOwnAddress">
                                You cannot transfer to your account.
                            </b-form-invalid-feedback>
                            <b-form-valid-feedback :state="isNotOwnAddress">
                                Nice!
                            </b-form-valid-feedback>
                        </div>
                    </div>

                    <!-- amount -->
                    <div class="field-item">
                        <div class="field-wrap">
                            <b-form-input v-model="amount" :state="isValidAmount" id="transfer-amount" name="amount"
                                          class="input-bordered" required placeholder="Amount of MHLK">
                            </b-form-input>
                            <b-form-invalid-feedback :state="isValidAmount">
                                Amount must be greater than 0.
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
                                   :disabled="notAllowed || busy"
                                      placeholder="Your private Key"></textarea>
                        </div>
                    </div>

                        <!-- trnasfer button -->
                    <button class="btn btn-grad w-100" :class="{ 'disabled': busy}" @click="transfer(amount)"
                            :disable="busy"
                            v-html="buttonLoading"></button>
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
            notAllowed() {
                return this.amount === 0 || this.amount === null || this.transferTo === '' || this.transferTo === null;
            },
            isValidAmount() {
                return this.amount > 0 && this.amount < this.balance;
            },
            isNotOwnAddress() {
                return String(this.transferTo).toLowerCase() !== String(this.address).toLowerCase();
            },
        },
        data() {
            return {
                amount: 0,
                provider: 'https://ethshared.bdnodes.net?auth=uampStnJT55ABaYvG3HEg2qUFlQcgLZED9Tgw7o1GSQ',
                contractAddress: '0xE3D0a162fCc5c02C9448274D7C58E18e1811385f',
                contractAbiUrl: '/wallet/contract',
                contractAbi: [{"constant":true,"inputs":[],"name":"name","outputs":[{"name":"","type":"string"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":false,"inputs":[{"name":"spender","type":"address"},{"name":"value","type":"uint256"}],"name":"approve","outputs":[{"name":"","type":"bool"}],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":false,"inputs":[{"name":"to","type":"address"},{"name":"value","type":"uint256"},{"name":"_sender","type":"address"}],"name":"mint","outputs":[{"name":"","type":"bool"}],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":true,"inputs":[],"name":"totalSupply","outputs":[{"name":"","type":"uint256"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":false,"inputs":[{"name":"from","type":"address"},{"name":"to","type":"address"},{"name":"value","type":"uint256"}],"name":"transferFrom","outputs":[{"name":"","type":"bool"}],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":true,"inputs":[],"name":"decimals","outputs":[{"name":"","type":"uint8"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":false,"inputs":[{"name":"spender","type":"address"},{"name":"addedValue","type":"uint256"}],"name":"increaseAllowance","outputs":[{"name":"success","type":"bool"}],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":false,"inputs":[],"name":"unpause","outputs":[],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":true,"inputs":[{"name":"account","type":"address"}],"name":"isPauser","outputs":[{"name":"","type":"bool"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[],"name":"paused","outputs":[{"name":"","type":"bool"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[],"name":"getAssetAddress","outputs":[{"name":"","type":"address"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":false,"inputs":[],"name":"renouncePauser","outputs":[],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":true,"inputs":[{"name":"owner","type":"address"}],"name":"balanceOf","outputs":[{"name":"","type":"uint256"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":false,"inputs":[],"name":"renounceOwnership","outputs":[],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":false,"inputs":[{"name":"account","type":"address"}],"name":"addPauser","outputs":[],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":false,"inputs":[],"name":"pause","outputs":[],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":true,"inputs":[],"name":"owner","outputs":[{"name":"","type":"address"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[],"name":"isOwner","outputs":[{"name":"","type":"bool"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[],"name":"symbol","outputs":[{"name":"","type":"string"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":false,"inputs":[{"name":"account","type":"address"}],"name":"addMinter","outputs":[],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":false,"inputs":[],"name":"renounceMinter","outputs":[],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":false,"inputs":[{"name":"spender","type":"address"},{"name":"subtractedValue","type":"uint256"}],"name":"decreaseAllowance","outputs":[{"name":"success","type":"bool"}],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":true,"inputs":[],"name":"RESTRICTED_AREA","outputs":[{"name":"","type":"string"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":false,"inputs":[{"name":"to","type":"address"},{"name":"value","type":"uint256"}],"name":"transfer","outputs":[{"name":"","type":"bool"}],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":true,"inputs":[{"name":"account","type":"address"}],"name":"isMinter","outputs":[{"name":"","type":"bool"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":false,"inputs":[{"name":"to","type":"address"},{"name":"value","type":"uint256"},{"name":"_sender","type":"address"}],"name":"burn","outputs":[{"name":"","type":"bool"}],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":true,"inputs":[],"name":"ONLY_OWNER","outputs":[{"name":"","type":"string"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[{"name":"owner","type":"address"},{"name":"spender","type":"address"}],"name":"allowance","outputs":[{"name":"","type":"uint256"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":false,"inputs":[{"name":"newOwner","type":"address"}],"name":"transferOwnership","outputs":[],"payable":false,"stateMutability":"nonpayable","type":"function"},{"anonymous":false,"inputs":[{"indexed":true,"name":"previousOwner","type":"address"},{"indexed":true,"name":"newOwner","type":"address"}],"name":"OwnershipTransferred","type":"event"},{"anonymous":false,"inputs":[{"indexed":false,"name":"account","type":"address"}],"name":"Paused","type":"event"},{"anonymous":false,"inputs":[{"indexed":false,"name":"account","type":"address"}],"name":"Unpaused","type":"event"},{"anonymous":false,"inputs":[{"indexed":true,"name":"account","type":"address"}],"name":"PauserAdded","type":"event"},{"anonymous":false,"inputs":[{"indexed":true,"name":"account","type":"address"}],"name":"PauserRemoved","type":"event"},{"anonymous":false,"inputs":[{"indexed":true,"name":"account","type":"address"}],"name":"MinterAdded","type":"event"},{"anonymous":false,"inputs":[{"indexed":true,"name":"account","type":"address"}],"name":"MinterRemoved","type":"event"},{"anonymous":false,"inputs":[{"indexed":true,"name":"from","type":"address"},{"indexed":true,"name":"to","type":"address"},{"indexed":false,"name":"value","type":"uint256"}],"name":"MaharlikaTransfer","type":"event"},{"anonymous":false,"inputs":[{"indexed":true,"name":"from","type":"address"},{"indexed":true,"name":"to","type":"address"},{"indexed":false,"name":"value","type":"uint256"}],"name":"Transfer","type":"event"},{"anonymous":false,"inputs":[{"indexed":true,"name":"owner","type":"address"},{"indexed":true,"name":"spender","type":"address"},{"indexed":false,"name":"value","type":"uint256"}],"name":"Approval","type":"event"},{"constant":false,"inputs":[{"name":"name","type":"string"},{"name":"symbol","type":"string"},{"name":"decimals","type":"uint8"}],"name":"initialize","outputs":[],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":false,"inputs":[{"name":"name","type":"string"},{"name":"symbol","type":"string"},{"name":"decimals","type":"uint8"},{"name":"initialSupply","type":"uint256"},{"name":"initialHolder","type":"address"},{"name":"minters","type":"address[]"},{"name":"pausers","type":"address[]"}],"name":"initialize","outputs":[],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":false,"inputs":[{"name":"sender","type":"address"}],"name":"initialize","outputs":[],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":false,"inputs":[{"name":"_address","type":"address"}],"name":"removeMinter","outputs":[],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":false,"inputs":[{"name":"_address","type":"address"}],"name":"removePauser","outputs":[],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":false,"inputs":[{"name":"_erc721Address","type":"address"}],"name":"setAssetAddress","outputs":[],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":false,"inputs":[{"name":"name","type":"string"}],"name":"setName","outputs":[],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":false,"inputs":[{"name":"name","type":"string"}],"name":"setSymbol","outputs":[],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":false,"inputs":[{"name":"_value","type":"uint256"},{"name":"_sender","type":"address"}],"name":"increaseTotalSupply","outputs":[{"name":"","type":"bool"}],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":false,"inputs":[{"name":"_value","type":"uint256"},{"name":"_sender","type":"address"}],"name":"decreaseTotalSupply","outputs":[{"name":"","type":"bool"}],"payable":false,"stateMutability":"nonpayable","type":"function"}],
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
                balance: 0
            }
        },
        methods: {
		    resetButtonLoading() {
		        this.buttonLoading = 'Send MHLK';
                this.tries = 0;
                setTimeout(() => {
                        this.status = 'Status: Idle';
                        this.busy = !this.busy;
                    }, 900)
            },
            resetModal() {
                this.amount = 0;
                this.transferTo = '';
                this.privateKey = '';
            },
            toggleModal() {
                this.$refs['transfer-modal'].toggle('#toggle-button')
            },
            connectToProvider() {
                let nodeProvider = new Web3.providers.HttpProvider(this.provider);
                return new Web3(nodeProvider);
            },
            maharlikaContract() {
                return new this.web3.eth.Contract(this.contractAbi, this.contractAddress, {from: this.address});
            },
            transfer(amount) {
                this.busy = true;
                this.buttonLoading = '<i class="fas fa-spinner fa-spin"></i>';
                this.status = 'Status: <span style="color:#ffc107">transacting...</span>';
                this.getContractAbi();

        }
	}
</script>
