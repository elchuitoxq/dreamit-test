import axios from 'axios';

const state = {
    blockList: []
};

const actions = {
    getBlockList({commit, rootState}){
        axios.post('/api/block-list')
        .then((res) => {
            commit('setBlockList', res.data.blockList);
        }).catch((error) => {
            rootState.snackbar.snackbar = {
                text: 'Ha ocurrido un error',
                color:'red',
                showing: true
            }
        })
    },
    addBlockList({commit, rootState},data){
        axios.post('/api/block-list/create',data)
        .then((res) => {
            commit('setBlockList', res.data.users);
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
    delBlockList({commit, rootState},data){
        axios.post('/api/block-list/delete',data)
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
    }
}

const mutations = {
    setBlockList(state, payload) {
        state.blockList = payload
    }
}

export default {
	state,
	actions,
	mutations
}