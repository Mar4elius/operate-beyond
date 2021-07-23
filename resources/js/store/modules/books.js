import BooksApi from './../../api/books';
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
		return BooksApi.search();
	},

    store(context, data) {
        return BooksApi.store(data).catch(error => {
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
