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
                    <div class="container field-label-line pointer position-absolute text-right text-uppercase"
                         style="top: -6px; font-size: x-small; padding-right: 20px;">
                            <span v-for="(currency, index) in fee.currencies" :key="index" class="currencies"
                                  :class="{ 'text-gold': fee.selectedCurrency === currency}"
                                  @click="setCurrency(fee.ether.value, currency)">
                                {{ currency }}
                            </span>
                    </div>
                    <div class="field-item input-focused">
                        <span id="fee" class="disabled input-line">{{ displayFee }}</span>
                        <label for="fee" class="field-label field-label-line">Transaction Fee</label>
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

            <button class="btn btn-grad w-100 btn-lg" :class="{ 'disabled': !submittable || invalid}"
                    :disabled="!submittable || invalid" v-html="buttonLoading"></button>
            <span v-html="status"></span>
        </v-observer>
    </div>
</template>

<script>
    import VueAutonumeric from '../../../partials/VueAutonumeric'
    import {ValidationObserver, ValidationProvider} from 'vee-validate';
    import VueRecaptcha from 'vue-recaptcha'
    import initialData from './initialdata'
    import maharlikaMethods from './methods'
    import {utils} from 'ethers'

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
            transferrable() {
                return this.$store.state.balances.ether > 0 && this.$store.state.balances.coin > 0;
            },
            isValidAmount() {
                return this.amount.value !== undefined && this.amount.value !== '' && this.amount.value > 0
            },
            submittable() {
                return this.transferrable && this.private.address !== '' && this.transferTo.isValid
                    && this.recaptcha.verified && this.connected !== '' && this.isValidAmount
            },
            address() {
                return this.$store.state.address
            },
            hasEnoughCoins() {
                return this.amount.value <= this.$store.state.balances.coin;
            },
            displayFee() {
                let value = this.$options.filters.numberFormat(this.fee.shown.value, this.fee.shown.format),
                    symbol = this.fee.shown.currencySymbol;

                return this.fee.selectedCurrency !== 'ether' ? `${symbol} ${value}` : ` ${value} ${symbol}`;
            }
        },
        data: initialData,
        methods: maharlikaMethods,
        mounted() {
            this.updateEtherPrice();
            this.getGasPrice();
            this.fee.shown = this.fee.usd;
        },
        watch: {
            'private.address': function(value) {
                let firstTwoCharacters = value.substring(0, 2);
                if(firstTwoCharacters === '0x')
                    this.private.address = value.slice(2);
            },
            'transferTo.address': function(newValue) {
                this.prepareToComputeFee(this, newValue)
            },
            'amount.value': function() {
                this.prepareToComputeFee(this, this.transferTo.address)
            },
            currencyIsEther() {
                this.prepareToComputeFee(this, this.transferTo.address);
            }
        }
	}
</script>

<style scoped>
    #fee.disabled {
        display: inline-block;
        padding: 26px 0 8px 5px;
        outline-color: transparent;
        position: relative;
        z-index: 1;
        background: rgba(0, 0, 0, 0.1);
        color: #415076;
        top: -10px;
        height: 55px;
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
    span.currencies:hover{
        color: #a67c01;
    }
    .text-gold {
        color: #a67c01;
    }
</style>
