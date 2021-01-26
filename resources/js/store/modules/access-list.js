import axios from 'axios';

const state = {
    accessList: [],
    accessListAll: []
}

const actions = {
    getAccessList({commit,rootState}, data){
        axios.post('/api/access-list/store', data)
        .then((res) => {
            commit('setAccessList', res.data);
        }).catch((error) => {
            rootState.snackbar.snackbar = {
                text: 'Ha ocurrido un error',
                color:'red',
                showing: true
            }
        })
    },
    getAccessListAll({commit,rootState}, data){
        axios.post('/api/access-list/all', data)
        .then((res) => {
            commit('setAccessListAll', res.data);
        }).catch((error) => {
            rootState.snackbar.snackbar = {
                text: 'Ha ocurrido un error',
                color:'red',
                showing: true
            }
        })
    },
    addEntry({rootState}, data){
        axios.post('/api/access-list/entry', data)
        .then((res) => {
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
    addExit({rootState}, data){
        axios.post('/api/access-list/exit', data)
        .then((res) => {
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
}

const mutations = {
    setAccessList(state, payload) {
        state.accessList = payload
    },
    setAccessListAll(state, payload) {
        state.accessListAll = payload
    }
}

export default {
    state,
    actions,
    mutations
}