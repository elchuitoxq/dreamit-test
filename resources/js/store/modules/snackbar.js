const state = {
    snackbar:{
        showing: false,
        text:'',
        color:'',
        timeout: 5000
    }
}

const mutations = {
    setSnack (state, snack) {
        state.snackbar = snack
    }
}

export default {
	state,
	mutations
}