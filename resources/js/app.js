require('./bootstrap');

import { createApp } from 'vue';
// Routes
import router from './routes';
// Store
import store from './store/store';
// declare global vue components
import App from './App.vue';

createApp(App).use(router).use(store).mount('#app');
