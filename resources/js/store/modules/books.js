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