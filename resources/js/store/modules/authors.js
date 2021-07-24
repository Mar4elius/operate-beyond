import AuthorsApi from './../../api/authors';
// initial State
const state = {
	active: null,
	all: []
};

// getters
const getters = {
	//
};

// actions
const actions = {
	search() {
        return AuthorsApi.search();
	},

	async store(context, data) {
		return AuthorsApi.store(data).catch(error => {
            return error.response;
        });
	},

	async update(context, data) {
		return AuthorsApi.update(data).catch(error => {
            return error.response;
        });
	}
};

const mutations = {
	//
};

export default {
	namespaced: true,
	state,
	getters,
	actions,
	mutations
};
