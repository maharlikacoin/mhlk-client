import { utils, Wallet } from 'ethers';

const maharlikaMethods = {
    onFocus(field) {
        field.isFocused = true;
    },
    onBlur(field){
        field.hasOwnProperty('address') ? (field.isFocused = field.address !== '') : false;
        field.hasOwnProperty('value') ? (field.isFocused = (document.getElementById('amount')).value !== '') : false;
        if(field.hasOwnProperty('value')) {
            let stringValue = (document.getElementById('amount')).value;
            stringValue = stringValue.replace(this.amount.options.currencySymbol, "");

            field.isFocused = stringValue !== ''
        }
    },
    verifyRecaptcha() {
        this.recaptcha.message = '';
        this.recaptcha.verified = true;
    },

    // GWeiPrice = GasCost * GasPrice
    // ETH = GWeiPrice/ 1B Gwei

    // varies from the mode of transaction
    // required input transferTo address and amount
    // needs for transaction fee computation
    getGasCost() {
        if (this.modeIsEther)
            // remember to set gasLimit to 21000
            return this.$store.state.provider
                .estimateGas({to: this.transferTo.address, value: utils.parseEther(this.amount.value)})
                .then(gasCost => this.gas.limit.ether = Number(gasCost));
        else{
            let convertedValue = utils.hexlify(this.amount.value * (10**this.$store.state.balances.decimals));
            let transaction = {
                from: this.address,
                gasLimit: 55048 + (55048 * 0.2),
                gasPrice: utils.bigNumberify(this.gas.price.selected),
                value: utils.parseEther("0")
            };

            return this.$store.state
                .maharlika.estimate
                .transfer(this.transferTo.address, convertedValue, transaction)
                .then(gasLimit => this.gas.limit.mhlk = Number(gasLimit));

            // All properties are optional

            // this.rawTransaction = {
            //     "from": this.address,
            //     "gasPrice":web3.utils.toHex(this.gas.price.selected),
            //     "gasLimit":web3.utils.toHex(this.gas.limit),
            //     "to": this.usedConfig.contractAddress,
            //     "value":"0x0",
            //     "data": contract.methods.transfer(this.transferTo, hexAmount).encodeABI(),
            //     "nonce":web3.utils.toHex(this.count)
            // };
        }
    },

    // varies from the miner, using ethgasstation.info to get price ranges
    // needs for transaction fee computation
    getGasPrice() {
        // use https://docs.ethers.io/ethers.js/html/api-providers.html?highlight=limit
        // delete axios.defaults.headers.common["X-Requested-With"];
        return axios.get('https://ethgasstation.info/json/ethgasAPI.json') // in GWEI
            .then(response => {
                let data = response.data;
                this.gas.price = {
                    fast: data.fast /10,
                    average: data.average /10,
                    slow: data.safeLow /10,
                };

                // set default gas price
                this.gas.price.selected = this.gas.price.average;
            });
    },

    // EtherPrice - varies. data from etherscan
    // needs for transaction fee computation
    updateEtherPrice() {
        this.$store.dispatch('updateEtherPrice');
        axios.get(`${this.conversionURL}/?q=USD_PHP&compact=ultra&apiKey=${process.env.MIX_CURRENCY_CONVERSION_API}`)
            .then(res=> this.fee.php.rate = this.$store.state.prices.etherInUsd * res.data.USD_PHP);
        axios.get(`${this.conversionURL}/?q=USD_EUR&compact=ultra&apiKey=${process.env.MIX_CURRENCY_CONVERSION_API}`)
            .then(res=> this.fee.euro.rate = this.$store.state.prices.etherInUsd * res.data.USD_EUR);
        this.fee.usd.rate = this.$store.state.prices.etherInUsd;
    },

    isValidAddress(vm) {
        try {
            utils.getAddress(this.transferTo.address);
            vm.transferTo.isValid = true;
        }catch(e) {
            console.log(e);
            console.log(vm)
            console.log(vm.transferTo)
            vm.transferTo.isValid = false
        }
    },
    // will try to update ether price globally, plan is to after last change on either transferTo | amount
    prepareToComputeFee: _.debounce((vm) => {
        vm.isValidAddress(vm);
        vm.computeTransactionFee()
    }, 300),

    // https://docs.ethers.io/ethers.js/html/notes.html?highlight=gettransactioncount
    computeTransactionFee() {

        if(this.transferTo.isValid && this.isValidAmount && this.hasEnoughCoins) {
            this.updateEtherPrice();
            let allPromises = Promise.all([
                this.getGasPrice(),
                this.getGasCost(),
            ]);

            allPromises.then(() => {
                // dependent on getGasPrice() & getGasCost()
                // (gasPrice / 1e18) * gasCost
                let limit = this.modeIsEther ? this.gas.limit.ether : this.gas.limit.mhlk;
                let etherValue = (this.gas.price.selected * limit) / 1e9; // in GWEI
                this.fee.ether.value = etherValue;
                this.setCurrency(etherValue, this.fee.selectedCurrency);
            });
        }
        else this.setCurrency(0, this.fee.selectedCurrency);

    },

    setCurrency(etherValue, selectedCurrency) {
        this.fee.selectedCurrency = selectedCurrency;
        this.fee.shown = this.fee[selectedCurrency];
        this.fee.shown.value = etherValue * this.fee.shown.rate;
        // if(this.currencyIsEther)  {
        //     this.fee.ether.value = etherValue;
        //     this.fee.ether.currencySymbol = '  ETH';
        //     this.fee.ether.format= '0.[00000000]a';
        // }
        // else {
        //     this.fee.value = etherValue * this.$store.state.prices.etherInUsd;
        //     this.fee.usd.currencySymbol = '$ ';
        //     this.fee.usd.format= '0,0[.]00a';
        // }
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
    reset() {
        this.amount = 0;
        this.transferTo = '';
        this.privateKey = '';
        this.resetStatus();
        this.resetButtonLoading();
    },

    // https://docs.ethers.io/ethers.js/html/api-contract.html?highlight=wallet
    onSubmit() {
        console.log('Start Transaction');
        if (!this.submittable) return;

        // update button
        this.busy = true;
        this.buttonLoading = '<i class="fas fa-spinner fa-spin"></i>';
        this.status = 'Status: <span style="color:#ffc107">transacting...</span>';


        let state = this.$store.state,
            wallet = new Wallet(this.private.address, state.provider),
            signedContract = state.maharlika.connect(wallet),
            hexAmount = utils.hexlify(this.amount.value * 10**state.balances.decimals);

        // transfer coins
        signedContract.transfer(this.transferTo.address, hexAmount)
            .then(res => {
                console.log(Number(res.gasPrice));

                console.log('Successfully Transact', res);
                this.status = 'Status: <span style="color:#28a745">Successfully Transferred MHLK</span>';
                this.count++;
                this.resetButtonLoading();
                // this.resetFields();

                this.$store.dispatch('toggleTransferModal', false);
                this.$store.dispatch('updateCoin', this.address);
            })
            .catch(err => {
                console.log(err.message);
                this.status = 'Status: <span style="color:#dc3545">Failed transferring token. Check your private and public keys</span>';
                this.resetButtonLoading();
            });
    },
    getNonce() {
        return this.$store.state.provider.getTransactionCount(this.address)
    },
};

export default maharlikaMethods
