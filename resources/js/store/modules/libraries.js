import LibrariesAPI from './../../api/libraries.js';
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
		return LibrariesAPI.search();
	},

	store(context, data) {
        console.log(data);
		return LibrariesAPI.store(data);
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
