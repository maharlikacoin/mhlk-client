import Vue from 'vue'
import Vuex from 'vuex'
import MHLK from '../core/MaharlikaContract'
import { utils, providers, Contract } from "ethers";

Vue.use(Vuex);

export default new Vuex.Store({
    state: {
        network: 'mainnet',
        config: {
            mainnet: {
                provider: 'https://ethshared.bdnodes.net?auth=trtq2YNHtEU2rvJabEwqcV4BEE1M8lnpOrEV6EICHT4',
                address: '0xE3D0a162fCc5c02C9448274D7C58E18e1811385f',
            },
            ropsten: {
                provider: 'https://ropstenshared.bdnodes.net/?auth=M0olBBbNBAhkVrlZLFmlN93AF_BonbAOiHAaFr4wjr0',
                address: '',
            },
            kovan: {
                provider: 'https://kovan.infura.io/v3/befbc2de01464c24b2d9012752e5877e',
                address: '0x66cD341f464d7c7555Cee3305e68F75AfFBb1F96',
            },
            used: {}
        },
        maharlika: '',
        provider: '',
        balances: {
            ether: 0,
            coin: 0
        }
    },
    mutations: {
        CHANGENETWORK(state, network) { state.network = network },
        SETCONTRACT(state, contract) { state.maharlika = contract },
        SETBALANCEETHER(state, ether) { state.balances.ether = ether },
        SETPROVIDER(state, provider) { state.provider = provider },
        SETETHER(state, ether) { state.balances.ether = ether },
        SETCOIN(state, coin) { state.balances.coin = coin }
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
                signer = provider.getSigner(usedConfig.address);

            commit('SETPROVIDER', provider);
            dispatch('updateEther', address);

            commit('SETCONTRACT', (new Contract(usedConfig.address, MHLK, signer)));
            dispatch('updateCoin', address)
        },
        updateEther({commit, state}, address) {
            state.provider.getBalance(address)
                .then((balance) => commit('SETETHER', utils.formatEther(balance)));
        },
        updateCoin({commit, state}, address) {
            let decimals = 2;
            state.maharlika.balanceOf(address)
                .then((balance) => commit('SETCOIN', balance/10**decimals))
        }
    },
    getters: {
        getConfiguration: state => {return state.config},
        getNetwork: state => {return state.network},
        getProvider: state => {return state.provider},
        maharlika: state => {return state.maharlika},
        getEther: state => {return state.balances.ether},
        getCoin: state => {return state.balances.coin}
    }
})
