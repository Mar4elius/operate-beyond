import { createStore, createLogger } from "vuex";
// modules

const debug = process.env.NODE_ENV !== "production";

export default createStore({
    modules: {
        //
    },
    strict: debug,
    plugins: debug ? [createLogger()] : [],
});