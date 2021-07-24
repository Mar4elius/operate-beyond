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
		return LibrariesAPI.store(data).catch(error => {
            return error.response;
        });
	},

	update(context, data) {
		return LibrariesAPI.update(data).catch(error => {
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
