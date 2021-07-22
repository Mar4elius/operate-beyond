<template>
	<app-layout>
		<template v-slot:header> </template>

		<template v-slot:main>
			<router-view></router-view>
		</template>
	</app-layout>
</template>

<script>
	import AppLayout from './components/layouts/AppLayout.vue';
	export default {
		components: {
			AppLayout
		}
	};
</script>
