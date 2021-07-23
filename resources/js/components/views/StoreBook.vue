<template>
        <h4>Create a New Book</h4>
        <div class="w-full">
            <validation-errors :errors="state.validationErrors" />
        </div>
        <div class="w-full px-4 sm:px-6">
            <div class="w-full">
                <h6 class="text-indigo-500">Book Details</h6>
                <div class="flex justify-start">
                    <div class="w-1/2 mr-5">
                        <v-input name="book-name" label="Book Name" :value="state.book.name" @update:value="state.book.name = $event.value" />
                    </div>
                    <div class="w-1/5">
                        <v-input name="book-year" label="Book Year" :value="state.book.year" @update:value="state.book.year = $event.value" maxlength="4" />
                    </div>
                </div>
            </div>

            <div class="w-full">
                <h6 class="text-indigo-500">Book Author</h6>
                <div class="flex justify-between items-center">
                    <div class="w-1/2 mr-5 flex py-5">
                        <v-button id="add-book" size="regular" @btnOnClickEvent="displayNewAuthorFields">{{authorButtonText}}</v-button>
                    </div>
                    <div class="w-1/5 flex" v-if="!showNewAuthorFields">
                        <span>OR</span>
                    </div>
                    <div class="w-1/2 " v-if="!showNewAuthorFields">
                        <label class="block mb-2 md:mb-3 w-full text-md font-medium text-gray-700">Select from existing authors:</label>
                        <Multiselect
                            v-model="state.author"
                            :options="state.authors"
                            label="name"
                            value-prop="id" />
                    </div>
                </div>
                <div class="flex justify-between" v-if="showNewAuthorFields">
                    <div class="w-1/2 mr-5">
                        <v-input name="author-name" label="Author Name" :value="state.author.name" @update:value="state.author.name = $event.value" />
                    </div>
                    <div class="w-1/5 mr-5">
                        <label class="block mb-2 md:mb-3 w-full text-md font-medium text-gray-700">Author Birth Date</label>
                        <date-picker v-model="state.author.birth_date">
                            <template v-slot="{ inputValue, inputEvents }">
                                <input
                                class="appearance-none
                                        border border-gray-300
                                        placeholder-gray-500
                                        text-gray-900
                                        w-full
                                        px-3
                                        py-2
                                        rounded
                                        mb-2
                                        focus:outline-none
                                        focus:ring-indigo-500
                                        focus:border-indigo-300
                                        focus:z-10
                                        sm:text-sm
                                        transition-colors
                                        duration-300
                                        ease-in-out"
                                :value="inputValue"
                                v-on="inputEvents"
                                />
                            </template>
                        </date-picker>
                    </div>
                    <div class="w-1/5">
                        <label class="block mb-2 md:mb-3 w-full text-md font-medium text-gray-700">Author Genre</label>
                        <Multiselect
                            v-model="state.author.genre"
                            :options="genres" />
                    </div>
                </div>
            </div>

            <div class="w-full">
                <h6 class="text-indigo-500">Library</h6>
                <div class="flex justify-between items-center">
                    <div class="w-1/2 mr-5 py-5">
                        <v-button id="add-book" size="regular" @btnOnClickEvent="displayNewLibraryFields">{{libraryButtonText}}</v-button>
                    </div>
                    <div class="w-1/5 flex" v-if="!showNewLibraryFields">
                        <span>OR</span>
                    </div>
                    <div class="w-1/2 " v-if="!showNewLibraryFields">
                        <label class="block mb-2 md:mb-3 w-full text-md font-medium text-gray-700">Select from existing Libraries:</label>
                        <Multiselect
                            v-model="state.library"
                            :options="state.libraries"
                            label="name"
                            value-prop="id" />
                    </div>
                </div>
                <div class="flex justify-start" v-if="showNewLibraryFields">
                    <div class="w-1/2 mr-5">
                        <v-input name="library-name" label="Library Name" :value="state.library.name" @update:value="state.library.name = $event.value" />
                    </div>
                    <div class="w-1/2 mr-5">
                        <v-input name="library-address" label="Library Address" :value="state.library.address" @update:value="state.library.address = $event.value" />
                    </div>
                </div>
            </div>

            <div class="w-full flex justify-center my-10">
                <v-button id="add-book" size="regular" classes="mr-5" @btnOnClickEvent="storeBook">Create</v-button>
                <v-button id="add-book" size="regular" type="danger" @btnOnClickEvent="closeModal">Cancel</v-button>
            </div>
        </div>
</template>
<script>
// Vue
import { reactive, ref } from '@vue/reactivity';
import { useStore } from 'vuex';
import { computed, onMounted } from '@vue/runtime-core';
// Components
import VInput from '../forms/VInput.vue';
import Multiselect from '@vueform/multiselect'
import VButton from '../forms/VButton.vue';
import { DatePicker } from 'v-calendar';
import ValidationErrors from '../forms/ValidationErrors.vue';
export default {
    components: {
        DatePicker,
        Multiselect,
        ValidationErrors,
        VButton,
        VInput
    },

    setup(props, {emit}) {
        const store = useStore();
        const state = reactive({
            book: {
                name: null,
                year: null,
                author_id: null,
                library_id: null
            },
            author: {
                name: null,
                birth_date: null,
                genre: null
            },
            library: {
                name: null,
                address: null
            },
            authors: null,
            libraries: null,
            genres: null,
            validationErrors: {
                errorsFor: '',
                errors: [],
            }
        })

        const genres = ['Fiction', 'Novel', 'Science Fiction', 'Narrative', 'Mystery']
        const showNewAuthorFields = ref(false);
        const showNewLibraryFields = ref(false);

        const authorButtonText = computed(() => showNewAuthorFields.value ? 'Cancel' : 'Create New Author')
        const libraryButtonText = computed(() => showNewLibraryFields.value ? 'Cancel' : 'Create New Library')

        onMounted(async () => {
            const authoresResponse = await store.dispatch('authors/search');
            state.authors = authoresResponse.data.authors;
            const librariesResponse = await store.dispatch('libraries/search');
            state.libraries = librariesResponse.data.libraries;
        })

        function displayNewAuthorFields() {
            state.author = {
                name: null,
                birth_date: null,
                genre: null
            };

            showNewAuthorFields.value = !showNewAuthorFields.value;
        }

        function displayNewLibraryFields() {
            state.library = {
                name: null,
                address: null
            };

            showNewLibraryFields.value = !showNewLibraryFields.value;
        }

        function closeModal() {
            emit('closeModal');
        }

        async function storeBook() {
            // Store author first
            // not a number. User creates a new author
            if (!Number.isInteger(state.author)) {
                const authorsResponse = await store.dispatch('authors/store', state.author);
                if (authorsResponse.status === 422) {
                    createValidationErrorsObject('Author', authorsResponse.data.errors);
                    return;
                } else {
                    resetValidationErrors();
                    state.book.author_id = authorsResponse.data.author.id;
                }
            } else {
                resetValidationErrors();
                // assigne selected author to book
                state.book.author_id = state.author;
            }

            // Store library
            const libraryHasValue = Object.keys(state.library).some(key => state.library[key] !== null);
            if (libraryHasValue) {
                const libraryResponse = await store.dispatch('libraries/store', state.library);
                if (libraryResponse.status === 422) {
                    createValidationErrorsObject('Library', libraryResponse.data.errors);
                    return;
                } else {
                    resetValidationErrors();
                    state.book.library_id = libraryResponse.data.library.id;
                }
            } else if (Number.isInteger(state.library)) {
                state.book.library_id = state.library;
            }

            // Store Book
            const bookResponse = await store.dispatch('books/store', state.book);
            if (bookResponse.status === 422) {
                createValidationErrorsObject('Book', bookResponse.data.errors);
            } else {
                resetValidationErrors();
                // refresh table
                await store.dispatch('books/search');
                closeModal();
            }
        }

        function createValidationErrorsObject(who, errors) {
            state.validationErrors = {
                errorsFor: who,
                errors: errors,
            }
        }

        function resetValidationErrors() {
            state.validationErrors = {
                errorsFor: '',
                errors: [],
            };
        }

        return {
            authorButtonText,
            closeModal,
            displayNewAuthorFields,
            displayNewLibraryFields,
            genres,
            libraryButtonText,
            showNewAuthorFields,
            showNewLibraryFields,
            state,
            storeBook
        }
    },
}
</script>
<style src="@vueform/multiselect/themes/default.css"></style>
