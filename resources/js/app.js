import Vue from 'vue';
import router from './router';

import vuetify from './plugins/vuetify';

import VueMoment from 'vue-moment';
import moment from 'moment';

Vue.use(VueMoment, {
    moment,
})

import App from './components/App';

import store from './store/index';

require('./bootstrap');

Vue.config.productionTip = false;

const app = new Vue({
    el: '#app',
    components: {
        App
    },
    router,
    store:store,
    vuetify
});