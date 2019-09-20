import WalletHeader from './components/wallet/WalletHeader';
import Welcome from './components/welcome/index';
import Transactions from './components/Transactions';
import MaharlikaTile from './components/MaharlikaTile';
import EtherTile from './components/EtherTile';
import UserSidebar from './components/UserSidebar';
import CreateWallet from './components/CreateWallet';
import numFormat from 'vue-filter-number-format';
import VueClipboard from 'vue-clipboard2';
import PerfectScrollbar from "vue2-perfect-scrollbar";

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

Vue.use(PerfectScrollbar);
VueClipboard.config.autoSetContainer = true;
Vue.use(require('vue-moment'));
Vue.use(VueClipboard);

new Vue({
    el: '#app',
    components: {
        WalletHeader,
        Welcome,
        Transactions,
        MaharlikaTile,
        EtherTile,
        UserSidebar,
        CreateWallet
    }
});
