import axios from 'axios';

const state = {
    user:{},
    users: []
};

const actions = {
    getAuth({commit, rootState}){
        axios.post('/api/user')
        .then((res) => {
            commit('setAuth', res.data);
        }).catch((error) => {
            rootState.snackbar.snackbar = {
                text: 'Ha ocurrido un error',
                color:'red',
                showing: true
            }
        })
    },
    getUsers({commit}){
        axios.post('/api/users')
        .then((res) => {
            commit('setUsers', res.data.users);
        }).catch((error) => {
            rootState.snackbar.snackbar = {
                text: 'Ha ocurrido un error',
                color:'red',
                showing: true
            }
        })
    },
    editUser({commit, rootState},data){
        axios.post('/api/users/edit',data)
        .then((res) => {
            commit('setUsers', res.data.users);
            if(res.data.success) {
                rootState.snackbar.snackbar = {
                    text:res.data.message,
                    color:'success',
                    showing: true
                }
            } else {
                rootState.snackbar.snackbar = {
                    text:res.data.message,
                    color:'red',
                    showing: true
                }
            }
        }).catch((error) => {
            rootState.snackbar.snackbar = {
                text: 'Ha ocurrido un error',
                color:'red',
                showing: true
            }
        })
    },
    addUser({commit, rootState},data){
        axios.post('/api/users/create',data)
        .then((res) => {
            commit('setUsers', res.data.users);
            if(res.data.success) {
                rootState.snackbar.snackbar = {
                    text:res.data.message,
                    color:'success',
                    showing: true
                }
            } else {
                rootState.snackbar.snackbar = {
                    text:res.data.message,
                    color:'red',
                    showing: true
                }
            }
        }).catch((error) => {
            rootState.snackbar.snackbar = {
                text: 'Ha ocurrido un error',
                color:'red',
                showing: true
            }
        })
    },
    delUser({commit, rootState},data){
        axios.post('/api/users/delete',data)
        .then((res) => {
            commit('setUsers', res.data.users);
            if(res.data.success) {
                rootState.snackbar.snackbar = {
                    text:res.data.message,
                    color:'success',
                    showing: true
                }
            } else {
                rootState.snackbar.snackbar = {
                    text:res.data.message,
                    color:'red',
                    showing: true
                }
            }
        }).catch((error) => {
            rootState.snackbar.snackbar = {
                text: 'Ha ocurrido un error',
                color:'red',
                showing: true
            }
        })
    }
}

const mutations = {
    setUsers(state, payload) {
        state.users = payload
    },
    setAuth(state, payload) {
        state.user = payload;
    }
}

export default {
	state,
	actions,
	mutations
}