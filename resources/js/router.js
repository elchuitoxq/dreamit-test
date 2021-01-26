import Vue from 'vue';
import VueRouter from 'vue-router';

import HomeComponent from './components/access-list/AccessControl';
import UserComponent from './components/users/Users';
import BuildingsComponent from './components/buildings/Buildings';
import AccessListComponent from './components/access-list/AccessList';
import AccessListAllComponent from './components/access-list/AccessListAll';
import BlockListComponent from './components/block-list/BlockList';

Vue.use(VueRouter);

export default new VueRouter({
    routes: [
        { path: '*', redirect: '/home' },
        { path: '/home', component: HomeComponent, name: 'home' },
        { path: '/users', component: UserComponent, name: 'users' },
        { path: '/buildings', component: BuildingsComponent, name: 'buildings' },
        { path: '/access-list', component: AccessListComponent, name: 'accessList' },
        { path: '/access-list-all', component: AccessListAllComponent, name: 'accessListAll' },
        { path: '/block-list', component: BlockListComponent, name: 'blockList' },
    ],
    mode: "history"
});