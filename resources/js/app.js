// components
import WalletIndex from './components/wallet/index';
import WelcomeIndex from './components/welcome/index';
import TeamIndex from './components/team/index';

// vendors
import './vendors/vee-validate'
import './vendors/vue-sweetalert2'
import store from './store'
import './vendors/filters'
import './plugins'

new Vue({
    el: '#app',
    store,
    components: {
        WalletIndex,
        WelcomeIndex,
        TeamIndex
    },
});
