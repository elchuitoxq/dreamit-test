import axios from 'axios';

const state = {
    buildings: []
};

const actions = {
    getBuildings({commit, rootState }){
        axios.post('/api/buildings')
        .then((res) => {
            commit('setBuildings', res.data.buildings);
        }).catch(() => {
            rootState.snackbar.snackbar = {
                text: 'Ha ocurrido un error',
                color:'red',
                showing: true
            }
        })
    },
    editBuilding({commit, rootState},data){
        axios.post('/api/buildings/edit',data)
        .then((res) => {
            commit('setBuildings', res.data.buildings);
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
        }).catch(() => {
            rootState.snackbar.snackbar = {
                text: 'Ha ocurrido un error',
                color:'red',
                showing: true
            }
        })
    },
    addBuilding({commit, rootState},data){
        axios.post('/api/buildings/create',data)
        .then((res) => {
            commit('setBuildings', res.data.buildings);
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
        }).catch(() => {
            rootState.snackbar.snackbar = {
                text: 'Ha ocurrido un error',
                color:'red',
                showing: true
            }
        })
    },
    delBuilding({commit, rootState},data){
        axios.post('/api/buildings/delete',data)
        .then((res) => {
            commit('setBuildings', res.data.buildings);
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
        }).catch(() => {
            rootState.snackbar.snackbar = {
                text: 'Ha ocurrido un error',
                color:'red',
                showing: true
            }
        })
    }
}

const mutations = {
    setBuildings(state, payload) {
        state.buildings = payload
    }
}

export default {
	state,
	actions,
	mutations
}