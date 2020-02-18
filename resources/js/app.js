// components
import WalletIndex from './components/wallet/index';
import WelcomeIndex from './components/welcome/index';
import TeamIndex from './components/team/index';
import Whitepaper from './components/partials/whitepaper';
import Dossier from './components/partials/dossier';

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
        TeamIndex,
        Whitepaper,
        Dossier
    },
});
