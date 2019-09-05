import Transactions from './components/Transactions';
import MaharlikaTile from './components/MaharlikaTile';
import EtherTile from './components/EtherTile';
import UserSidebar from './components/UserSidebar';
import numeral from 'numeral';
import numFormat from 'vue-filter-number-format';

Vue.filter('numberFormat', numFormat(numeral));
Vue.filter('trimAddress', function (value) {
    let text = value.replace(/(<([^>]+)>)/ig, '');
    return text.substring(0, 7) + '...' + text.substr(value.length - 4 );
});

Vue.filter('upperAddress', (text) => {
    return text.slice(0,2) + text.slice(3, 22).toUpperCase() + text.slice(23, text.length).toUpperCase();
});
Vue.use(moment);

new Vue({
    el: '#app',
    components: {
        Transactions,
        MaharlikaTile,
        EtherTile,
        UserSidebar
    }
});
