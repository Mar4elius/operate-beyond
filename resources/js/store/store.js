import { createStore, createLogger } from 'vuex';
// modules
import authors from './modules/authors';
import books from './modules/books';
import libraries from './modules/libraries';

const debug = process.env.NODE_ENV !== 'production';

export default createStore({
	modules: {
        authors,
		books,
        libraries
	},
	strict: debug,
	plugins: debug ? [createLogger()] : []
});
