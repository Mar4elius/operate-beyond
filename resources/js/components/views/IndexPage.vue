<template>
	<div class="w-full text-center">
		<h1>Available Books</h1>
	</div>

	<div class="flex flex-col">
		<div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
			<div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                <div class="w-full flex justify-end mb-5">
                    <v-button id="add-book" size="regular" @btnOnClickEvent="displayAddBookModal">Add Book</v-button>
                </div>
				<div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
					<table class="min-w-full divide-y divide-gray-200">
						<thead class="bg-gray-50">
							<tr>
								<th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
									Book Name
								</th>
								<th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
									Book Year
								</th>
								<th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
									Author Name
								</th>
								<th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
									Author Genre
								</th>
								<th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
									Library Name
								</th>
								<th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
									Library Address
								</th>
								<th scope="col" class="relative px-6 py-3">
									<span class="sr-only">Actions</span>
								</th>
							</tr>
						</thead>
						<tbody class="bg-white divide-y divide-gray-200">
							<tr v-for="book in state.books" :key="book.id">
								<td class="px-6 py-4 whitespace-nowrap">
									<div class="text-sm text-gray-900">
										{{ book.name }}
									</div>
								</td>
								<td class="px-6 py-4 whitespace-nowrap">
									<div class="text-sm text-gray-900">
										{{ book.year }}
									</div>
								</td>
								<td class="px-6 py-4 whitespace-nowrap">
									<div class="text-sm text-gray-900">
										{{ book.author.name }}
									</div>
								</td>
								<td class="px-6 py-4 whitespace-nowrap">
									<div class="text-sm text-gray-900">
										{{ book.author.genre }}
									</div>
								</td>
								<td class="px-6 py-4 whitespace-nowrap">
									<div class="text-sm text-gray-900" v-for="library in book.libraries" :key="library.id">
										{{ library.name || 'Not avaialbe' }}
									</div>
								</td>
								<td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
									<div class="text-sm text-gray-900" v-for="library in book.libraries" :key="library.id">
										{{ library.address }}
									</div>
								</td>
								<td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
									<button @click="displayEditModal(book)">
										<svg
											xmlns="http://www.w3.org/2000/svg"
											class="h-6 w-6"
											fill="none"
											viewBox="0 0 24 24"
											stroke="currentColor"
										>
											<path
												stroke-linecap="round"
												stroke-linejoin="round"
												stroke-width="2"
												d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"
											/>
										</svg>
									</button>
									<button @click="displayDestroyModal(book)">
										<svg
											xmlns="http://www.w3.org/2000/svg"
											class="h-6 w-6 text-red-500"
											fill="none"
											viewBox="0 0 24 24"
											stroke="currentColor"
										>
											<path
												stroke-linecap="round"
												stroke-linejoin="round"
												stroke-width="2"
												d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"
											/>
										</svg>
									</button>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
    <!-- Store modal -->
    <modal-layout :show="showAddBookModal" @close-modal="showAddBookModal = false">
        <store-book @close-modal="showAddBookModal = false" @refresh-table="searchBooks"/>
    </modal-layout>
    <!-- Edit modal -->
    <modal-layout :show="showEditBookModal" @close-modal="showEditBookModal = false">
        <edit-book @close-modal="showEditBookModal = false" @refresh-table="searchBooks" :book="state.selectedBook"/>
    </modal-layout>
    <!-- Destroy modal -->
    <modal-layout :show="showDestroyBookModal" @close-modal="showDestroyBookModal = false">
        <destroy-book :book="state.selectedBook" @close-modal="showDestroyBookModal = false" @refresh-table="searchBooks"/>
    </modal-layout>
</template>

<script>
	// Vue
    import { onMounted, reactive, ref } from '@vue/runtime-core';
	import { useStore } from 'vuex';
    // Components
    import VButton from '../forms/VButton.vue';
    import ModalLayout from '../layouts/ModalLayout.vue'
    import StoreBook from '../views/StoreBook.vue'
    import DestroyBook from '../views/DestroyBook.vue'
    import EditBook from '../views/EditBook.vue'

	export default {
        components: {
            DestroyBook,
            ModalLayout,
            VButton,
            StoreBook,
            EditBook
        },

		setup() {
			//
			const store = useStore();
			const state = reactive({
				books: null,
                selectedBook: null
			});
            const showAddBookModal = ref(false);
            const showDestroyBookModal = ref(false);
            const showEditBookModal = ref(false);

			onMounted(() => searchBooks());

            async function searchBooks() {
                const response = await store.dispatch('books/search');
				state.books = response.data.books;
            }

			function displayEditModal(book) {
                state.selectedBook = book;
				showEditBookModal.value = true;
			}

			function displayDestroyModal(book) {
				state.selectedBook = book;
                showDestroyBookModal.value = true;
			}

            function displayAddBookModal() {
                showAddBookModal.value = true;
            }

			return {
                displayAddBookModal,
                displayDestroyModal,
                displayEditModal,
                showAddBookModal,
                showDestroyBookModal,
				showEditBookModal,
				state,
                searchBooks
			};
		}
	};
</script>
