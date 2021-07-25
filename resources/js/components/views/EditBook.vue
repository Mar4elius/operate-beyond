<template>
        <h4>Edit Book</h4>
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
                    <div class="w-1/2 mb-5">
                        <label class="block mb-2 md:mb-3 w-full text-md font-medium text-gray-700">Select from existing authors:</label>
                        <Multiselect
                            v-model="state.book.author_id"
                            :options="state.authors"
                            @input="assignAuthorValues"
                            label="name"
                            value-prop="id" />
                    </div>
                    <v-button id="add-book" size="regular" @btnOnClickEvent="updateAuthor">Update Author</v-button>
                </div>
                <div class="flex justify-between">
                    <div class="w-1/4 mr-5">
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
                <div class="flex justify-between items-end mb-5">
                    <div class="w-1/2">
                        <label class="block mb-2 md:mb-3 w-full text-md font-medium text-gray-700">Add another library to book:</label>
                        <Multiselect
                            v-model="state.book.library_id"
                            :options="notSelectedLibraries"
                            label="name"
                            value-prop="id" />
                    </div>
                </div>
                <div class="flex justify-start items-center" v-for="library in state.libraries" :key="library.id">
                    <div class="w-1/3 mr-5">
                        <v-input :name="`library-name${library.name}`" label="Library Name" :value="library.name" @update:value="library.name = $event.value" />
                    </div>
                    <div class="w-2/3 mr-5">
                        <v-input :name="`library-address${library.address}`" label="Library Address" :value="library.address" @update:value="library.address = $event.value" />
                    </div>
                    <v-button id="add-book" size="regular" :classes="`mr-5`" @btnOnClickEvent="updateLibarary(library)">Update</v-button>
                    <v-button id="remove-book" size="regular" type="danger" @btnOnClickEvent="removeLibrary(library)">Remove</v-button>
                </div>
            </div>

            <div class="w-full flex justify-center my-10">
                <v-button id="add-book" size="regular" classes="mr-5" @btnOnClickEvent="updateBook">Update</v-button>
                <v-button id="add-book" size="regular" type="danger" @btnOnClickEvent="closeModal">Cancel</v-button>
            </div>
        </div>
</template>
<script>
// Vue
import { reactive } from '@vue/reactivity';
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

    props: {
        book: {
            type: Object,
            required: true
        }
    },

    setup(props, {emit}) {
        const store = useStore();
        const state = reactive({
            book: {
                id: null,
                name: null,
                year: null,
                author_id: null,
                library_id: null,
            },
            author: {
                id: null,
                name: null,
                birth_date: null,
                genre: null
            },
            libraries: [], // array of objects
            authors: null,
            allLibraries: [],
            genres: null,
            validationErrors: {
                errorsFor: '',
                errors: [],
            }
        })

        const genres = ['Fiction', 'Novel', 'Science Fiction', 'Narrative', 'Mystery'];
        const notSelectedLibraries = computed(() => state.allLibraries.filter(library => {
            const ids = state.libraries.map(l => l.id);
            return !ids.includes(library.id)
        }));

        onMounted(async () => {
            const authoresResponse = await store.dispatch('authors/search');
            state.authors = authoresResponse.data.authors;
            const librariesResponse = await store.dispatch('libraries/search');
            state.allLibraries = librariesResponse.data.libraries;

            Object.keys(state.book).forEach(key => {
                return state.book[key] = props.book[key];
            });

            assignAuthorValues(props.book.author_id);
            // if libraries for the books exist
            if (props.book.libraries.length) {
                const librariesIds = props.book.libraries.map(library => library.id);
                assignLibraryValues(librariesIds);
            }
        });

        function assignAuthorValues(author_id) {
            const selectedAuthor = state.authors.find(author => author.id === author_id);
            Object.keys(state.author).forEach(key => {
                return state.author[key] = selectedAuthor[key];
            });
        }

        function assignLibraryValues(ids) {
            // reset all values before assigning new
            state.libraries = [];
            ids.forEach(id => {
                const library = state.allLibraries.find(library => library.id === id);

                state.libraries.push({
                    id: library.id,
                    name: library.name,
                    address: library.address
                });
            });
        }

        function closeModal() {
            emit('closeModal');
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

        async function updateBook() {
            const data = {
                ...state.book,
                libraries: state.libraries
            }

            const bookUpdateResponse = await store.dispatch('books/update', data);
            if (bookUpdateResponse.status === 422) {
                createValidationErrorsObject('Book', bookUpdateResponse.data.errors);
            } else {
                resetValidationErrors();
                emit('refresh-table');
                if (state.book.library_id) {
                    const library = state.allLibraries.find(l => l.id === state.book.library_id);
                    state.book.library_id = null;
                    state.libraries.push(library);
                }
            }
        }

        async function updateAuthor() {
            const authoresUpdateResponse = await store.dispatch('authors/update', state.author);
            if (authoresUpdateResponse.status === 422) {
                createValidationErrorsObject('Author', authoresUpdateResponse.data.errors);
            } else {
                resetValidationErrors();
                const authorSearchResponse = await store.dispatch('authors/search');
                state.authors = authorSearchResponse.data.authors;
                emit('refreshTable');
            }
        }

        async function updateLibarary(library) {
            const librariesUpdateResponse = await store.dispatch('libraries/update', library);
            if (librariesUpdateResponse.status === 422) {
                createValidationErrorsObject(`Library ${library.name}`, librariesUpdateResponse.data.errors);
            } else {
                resetValidationErrors();
                const librariesSearchResponse = await store.dispatch('libraries/search');
                state.allLibraries = librariesSearchResponse.data.libraries;
                emit('refreshTable');
            }
        }

        function removeLibrary(library) {
            state.libraries = state.libraries.filter(l => l.id !== library.id);
        }

        return {
            assignAuthorValues,
            notSelectedLibraries,
            closeModal,
            genres,
            state,
            updateBook,
            updateAuthor,
            updateLibarary,
            removeLibrary
        }
    },
}
</script>
<style src="@vueform/multiselect/themes/default.css"></style>
