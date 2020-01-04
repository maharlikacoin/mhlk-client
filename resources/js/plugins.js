import VueGtm from "vue-gtm";
import PerfectScrollbar from "vue2-perfect-scrollbar";
import VueClipboard from "vue-clipboard2";

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
