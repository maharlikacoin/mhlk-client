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
                value: '',
                description: '$0.00',
                options: {
                    digitGroupSeparator: ',',
                    decimalCharacter: '.',
                    decimalPlaces: 6,
                    currencySymbol: '  ETH',
                    currencySymbolPlacement: 's',
                    roundingMethod: 'U',
                    minimumValue: '0'
                }
            },
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
                selected: '',
                limits: {
                    ether: '',
                    mhlk: ''
                },
                costs: {
                    ether: '',
                    mhlk: ''
                },
                prices: {
                    fast: '',
                    average: '',
                    slow: '',
                }
            },
            currencyIsEther: false,
            modeIsEther: false,
            count: 0,
            buttonLoading: 'Send MHLK',
            busy: false,
            tries: 0,
            status: 'Status: Idle',


            // chain: 'mainnet',
            rawTransaction: null,
            transacting: false,
            toggleTransactionInfo: false,
        }
    };

export default initialdata
