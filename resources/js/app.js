// components
import WalletIndex from './components/wallet/index';
import WelcomeIndex from './components/welcome/index';
import TeamIndex from './components/team/index';
import PrivacyIndex from './components/privacy';
import TermsIndex from './components/terms';
import AboutUsIndex from './components/about-us';
import Whitepaper from './components/partials/whitepaper';
import FooterComponent from './components/welcome/FooterComponent';

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
        PrivacyIndex,
        TermsIndex,
        AboutUsIndex,
        FooterComponent
    },
});
