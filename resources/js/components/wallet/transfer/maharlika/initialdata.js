const initialdata = () => {
        return {
            transferTo: {
                address: '',
                isFocused: false,
                isValid: false,
            },
            private: {
                address: '',
                isFocused: false,
            },
            amount: {
                value: '',
                isFocused: false,
                hasValue: false,
                options: {
                    digitGroupSeparator: ',',
                    decimalCharacter: '.',
                    currencySymbol: '  MHLK',
                    currencySymbolPlacement: 's',
                    roundingMethod: 'U',
                    minimumValue: '0'
                }
            },

            fee: {
                currencies: [ 'usd', 'ether', 'php', 'euro' ],
                shown: {},
                sub: {},
                selectedCurrency:'usd',
                usd: {
                    value: '0',
                    currencySymbol: '$',
                    format: '0,0[.]00a',
                    rate: 1
                },
                ether: {
                    value: '0',
                    currencySymbol: 'ETH',
                    format: '0.[00000000]a',
                    rate: 1
                },
                php: {
                    value: '0',
                    currencySymbol: '₱',
                    format: '0,0[.]00a',
                    rate: 1
                },
                euro: {
                    value: '0',
                    currencySymbol: '€',
                    format: '0,0[.]00a',
                    rate: 1
                }
            },
            conversionURL: 'https://free.currconv.com/api/v7/convert',
            recaptcha: {
                verified: false,
                message: ''
            },

            convertFromEth: {
                toUsd: 0,
                toEuro: 0,
                toPeso: 0
            },

            gas: {
                limit: {
                    ether: '',
                    mhlk: ''
                },
                price: {
                    fast: '',
                    average: '',
                    slow: '',
                    selected: '',
                }
            },
            currencyIsEther: true, // default is showing $ on transaction fee
            modeIsEther: false, // default is transaction on MHLK
            count: 0,
            buttonLoading: 'Send MHLK',
            busy: false,
            tries: 0,
            status: 'Status: Idle',

            rawTransaction: null,
            transacting: false,
            toggleTransactionInfo: false,
        }
    };

export default initialdata
