import Vuex from 'vuex'
import abi from './core/MaharlikaContract'
import { utils, providers, Contract } from 'ethers';
Vue.use(Vuex);

export default new Vuex.Store({
    state: {
        address: '',
        authenticated: false,
        network: 'mainnet',
        config: {
            mainnet: {
                providerUrl: process.env.MIX_MAINNET,
                address: process.env.MIX_MAINNET_CONTRACT,
            },
            ropsten: {
                providerUrl: process.env.MIX_ROPSTEN,
                address: process.env.MIX_ROPSTEN_CONTRACT,
            },
            kovan: {
                providerUrl: process.env.MIX_KOVAN,
                address: process.env.MIX_KOVAN_CONTRACT,
            },
            used: {}
        },
        etherscan: '',
        maharlika: '',
        provider: '',
        prices: {
            etherInUsd: ''
        },
        balances: {
            ether: 0,
            coin: 0,
            decimals:2
        },
        modal: {
            transfer: false,
            login: false
        }
    },
    mutations: {
        CHANGENETWORK(state, network) { state.network = network },
        SETCONTRACT(state, contract) { state.maharlika = contract },
        SETBALANCEETHER(state, ether) { state.balances.ether = ether },
        SETPROVIDER(state, provider) { state.provider = provider },
        SETETHERSCANPROVIDER(state, provider) {state.etherscan = provider},
        SETETHERPRICE(state, price) {state.prices.etherInUsd = price},
        SETETHER: (state, ether) => state.balances.ether = ether,
        SETCOIN(state, coin) { state.balances.coin = coin },
        TOGGLETRANSFERMODAL(state, status) { state.modal.transfer = status},
        SETAUTH: (state, status) => state.authenticated = status,
        TOGGLELOGIN: (state, status) => state.modal.login = status,
        SETADDRESS: (state, address) => state.address = address
    },
    actions: {
        changeNetwork({commit}, network) {
            commit('CHANGENETWORK', network)
        },
        connect({commit, dispatch}, payload) {
            // connect to provider
            let usedConfig = payload.usedConfig,
                address = payload.public_address,
                web3 = new Web3(new Web3.providers.HttpProvider(usedConfig.provider));
            let provider = new providers.Web3Provider(web3.currentProvider),
                etherscanProvider = new providers.EtherscanProvider(),
                signer = provider.getSigner(usedConfig.address);

            commit('SETPROVIDER', provider);
            dispatch('updateEther', address);

            commit('SETCONTRACT', (new Contract(usedConfig.address, MHLK, signer)));
            dispatch('updateCoin', address);

            commit('SETADDRESS', address);
            commit('SETETHERSCANPROVIDER', etherscanProvider);
            dispatch('updateEtherPrice');
        },
        updateEther({commit, state}, address) {
            state.provider.getBalance(address)
                .then((balance) => commit('SETETHER', Number(utils.formatEther(balance)) ) );
        },
        updateCoin({commit, state}, address) {
            state.maharlika.balanceOf(address)
                .then((balance) => commit('SETCOIN', balance/10**state.balances.decimals))
        },
        updateEtherPrice({commit, state}) {
            state.etherscan.getEtherPrice()
                .then(price => commit("SETETHERPRICE", price))
        },
        toggleTransferModal: ({commit}, status) => commit('TOGGLETRANSFERMODAL', status),
        setAuth: ({commit}, status) => commit('SETAUTH', status),
        toggleLogin: ({commit}, status) => commit('TOGGLELOGIN', status)
    },
    getters: {
        getConfiguration: state => {return state.config},
        getNetwork: state => {return state.network},
        getProvider: state => {return state.provider},
        maharlika: state => {return state.maharlika},
        getEther: state => {return state.balances.ether},
        getCoin: state => {return state.balances.coin},
        isShownTransferModal: state => {return state.modal.transfer}
    }
})
