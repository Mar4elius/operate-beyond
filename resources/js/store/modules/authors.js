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

	store(context, data) {
		return AuthorsApi.store(data);
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
