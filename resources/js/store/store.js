import { createStore, createLogger } from "vuex";
// modules
import books from './modules/books';

const debug = process.env.NODE_ENV !== "production";

export default createStore({
    modules: {
        books
    },
    strict: debug,
    plugins: debug ? [createLogger()] : [],
});