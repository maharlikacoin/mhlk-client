const initialdata = () => {
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
                value: '',
                isFocused: false,
                hasValue: false,
            },
            recaptcha: {
                verified: false,
                message: ''
            },
            numericOptions: {
                amount: {
                    digitGroupSeparator: ',',
                    decimalCharacter: '.',
                    currencySymbol: '  MHLK',
                    currencySymbolPlacement: 's',
                    roundingMethod: 'U',
                    minimumValue: '0'
                },
                fee: {
                    digitGroupSeparator: ',',
                    decimalCharacter: '.',
                    decimalPlaces: 6,
                    currencySymbol: '  ETH',
                    currencySymbolPlacement: 's',
                    roundingMethod: 'U',
                    minimumValue: '0'
                }
            },

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
            }
        }
    };

export default initialdata
