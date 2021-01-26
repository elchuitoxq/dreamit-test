import Vue from 'vue';
import Vuex from 'vuex';

import Users from './modules/users';
import Buildings from './modules/buildings';
import BlockList from './modules/block-list';
import Snackbar from './modules/snackbar';
import AccessList from './modules/access-list';

Vue.use(Vuex);


const store = new Vuex.Store({
    modules: {
        users: Users,
        buildings: Buildings,
        blockList: BlockList,
        snackbar: Snackbar,
        accessList: AccessList
    }
})

export default store;