import WalletHeader from './components/wallet/WalletHeader';
import WalletMain from './components/wallet/main/index';
import WalletFooter from './components/wallet/FooterComponent';

import WelcomeIndex from './components/welcome/index';

import numFormat from 'vue-filter-number-format';
import VueClipboard from 'vue-clipboard2';
import PerfectScrollbar from "vue2-perfect-scrollbar";
import VueGtm from 'vue-gtm';

import './vendors/vee-validate';
import './vendors/vue-sweetalert2'

window.numeral = require('numeral');

Vue.filter('numberFormat', numFormat(numeral));
Vue.filter('trimAddress', function (value) {
    let text = value.replace(/(<([^>]+)>)/ig, '');
    return text.substring(0, 7) + '...' + text.substr(value.length - 4 );
});
Vue.filter('reduceSizeDecimal', (number) => {
    number = numeral(number).format('0,000.00');
    let stringNumber = number.toString(),
        wholeNumber = stringNumber.slice(0, stringNumber.length-3),
        decimals = stringNumber.slice(stringNumber.length-3, stringNumber.length);

    return `<p>
                ${wholeNumber}<span class="currency-decimals">${decimals}</span>
                <span class="currency-symbol">MHLK</span>
            </p>`;
});

Vue.use(VueGtm, {
    id: 'GTM-MPF64Q7',
    enabled: true,
    debug: true,
    loadScript: true
});
Vue.use(PerfectScrollbar);
VueClipboard.config.autoSetContainer = true;
Vue.use(require('vue-moment'));
Vue.use(VueClipboard);

new Vue({
    el: '#app',
    components: {
        WalletHeader,
        WalletMain,
        WalletFooter,
        WelcomeIndex,
    }
});
