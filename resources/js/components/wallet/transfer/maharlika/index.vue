<template>
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

            <div class="row">
                <!-- amount -->
                <div class="col-sm">
                    <v-provider vid="amount" name="Amount" tag="div" class="field-item" ref="transferAmount"
                                rules="required|numeric_decimal|greater_than:0|not_enough_coin"
                                mode="aggressive" v-slot="{ errors, valid }" :class="{ 'input-focused': amount.isFocused}">
                        <vue-autonumeric :options="amount.options" id="amount" name="amount"
                                         class="input-line required" @blur="onBlur(amount)" @focus="onFocus(amount)"
                                         :class="{ 'border-danger':errors.length, 'disabled':busy }"
                                         autocomplete="off" v-model="amount.value"></vue-autonumeric>
                        <label for="amount" class="field-label field-label-line">Amount (MHLK)</label>
                        <div class="small text-danger" v-if="errors.length">{{ errors[0] }}</div>
                    </v-provider>
                </div>


                <!-- transaction fee -->
                <div class="col-sm">
                    <div class="field-item input-focused">
                        <vue-autonumeric :options="fee.options" id="fee" name="fee" class="disabled input-line"
                                         contenteditable="false" readonly disabled="disabled"
                                         v-model="fee.value">
                        </vue-autonumeric>
                        <label for="fee" class="field-label field-label-line">
                            Transaction Fee ( {{ fee.description }} )
                        </label>
                        <span class="position-absolute pointer" v-if="fee.value">Advance</span>
                        <!--<a href="#" v-show="!toggleTransactionInfo"-->
                        <!--@click="toggleTransactionInfo = !toggleTransactionInfo">-->
                        <!--Show more information-->
                        <!--</a>-->
                        <!--<a href="#" v-show="toggleTransactionInfo"-->
                        <!--@click="toggleTransactionInfo = !toggleTransactionInfo">-->
                        <!--Hide-->
                        <!--</a>-->
                        <!--<div v-if="toggleTransactionInfo">-->
                        <!--<div>Gas Price: {{ gas.selected / 1e9 }} GWEI</div>-->
                        <!--<div>Gas Limit: {{ gas.limit }}</div>-->
                        <!--</div>-->
                        <!--<div>-->
                        <!--Transaction Fee: {{ transactionFee | numberFormat('0.0000') }} ETH-->
                        <!--( ${{ transactionFee * ethPrice.usd | numberFormat('0,000.00') }} )-->
                        <!--</div>-->
                    </div>
                </div>
            </div>

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
</template>

<script>
    import VueAutonumeric from '../../../partials/VueAutonumeric'
    import { ValidationObserver, ValidationProvider} from 'vee-validate';
    import VueRecaptcha from 'vue-recaptcha'
    import initialData from './initialdata'
    import maharlikaMethods from './methods'

    Vue.component('VObserver', ValidationObserver);
    Vue.component('VProvider', ValidationProvider);


	export default {
		name: "maharlika",
        props: ['connected'],
        components: {
            VueRecaptcha,
            VueAutonumeric,
        },
        computed: {
		    // fee: {
		    //     get: (vm) => {
		    //         let eth = '',
            //             usd = '',
            //             val = '';
		    //         if( vm.connected !== '' ) {
            //             eth = (this.gas.selected / 1e18) * this.gas.limit;
            //             usd = ether * vm.ethToUsd;
            //
            //             val = vm.currencyIsEther ? eth : usd;
            //         }
            //         return {
            //             value: val,
            //             description: vm.currencyIsEther? `${eth} ETH` : `$ ${dollar}`
		    //         }
            //     },
            //     set: (value) => {
		    //         return value;
		    //     }
            // },
            transferrable() {
                return this.$store.state.balances.ether > 0 && this.$store.state.balances.coin > 0;
            },
            submittable() {
                return this.transferrable && this.private.address !== '' &&
                    this.recaptcha.verified && this.connected !== ''
            },
            isGasLimitZero() {
                return this.gas.limit === 0 || this.gas.limit === null;
            },
            address() {
                return this.$store.state.address
            },

        },
        data: initialData,
        methods: maharlikaMethods,
        mounted() {
            // this.usedConfig = this.$store.state.config.used;

            // GasPrice - varies from the miner, using ethgasstation.info to get price ranges

        },
        watch: {
		    connected: (isConnected) => {
		        if( isConnected ){
                    // this.getEtherPrice() // get ether price (in usd)
                    //     .getGasPrice() // get gas price (in wei)
                }
            },
            'private.address': function(value) {
                let firstTwoCharacters = value.substring(0, 2);
                if(firstTwoCharacters === '0x')
                    this.private.address = value.slice(2);
            },
            'amount.value': function(newValue) {
                if(newValue === 0 ) this.amount.value = 0;
            },
            'transferTo.address': function(newValue) {

            }
        }
	}
</script>

<style scoped>
    #fee.disabled {
        outline-color: transparent;
        position: relative;
        z-index: 1;
        background: rgba(0, 0, 0, 0.1);
        color: #415076;
        top: -10px;
        height: 55px;
        padding-left: 5px;
    }
    #fee.disabled~span {
        position: absolute;
        top: -6px;
        font-size: 0.7rem!important;
        right: 10px;
        color: #a67c00;
        z-index: 2;
        -webkit-transition: all .5s ease;
        transition: all .5s ease;
        -webkit-transform-origin: left;
        transform-origin: left;
    }
    .input-focused .field-label-line{
        left: 5px;
    }
</style>
