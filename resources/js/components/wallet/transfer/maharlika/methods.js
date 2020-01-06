const maharlikaMethods = {
    onFocus(field) {
        field.isFocused = true;
    },
    onBlur(field){
        field.hasOwnProperty('address') ? (field.isFocused = field.address !== '') : false;
        field.hasOwnProperty('value') ? (field.isFocused = (document.getElementById('amount')).value !== '') : false;
        if(field.hasOwnProperty('value')) {
            let stringValue = (document.getElementById('amount')).value;
            stringValue = stringValue.replace(this.numericOptions.amount.currencySymbol, "");

            field.isFocused = stringValue !== ''
        }
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
    reset() {
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
    }
};

export default maharlikaMethods
