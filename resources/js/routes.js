import { createRouter, createWebHistory } from 'vue-router';
import IndexPage from './components/views/IndexPage.vue';

const routes = [
	{
		path: '/',
		component: IndexPage,
		name: 'index',
		meta: {
			title: 'Home'
		}
	}
];

const router = createRouter({
	history: createWebHistory(),
	routes: routes
});

export default router;
