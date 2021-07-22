<template>
            <h4>Create a New Book</h4>
        <div class="w-full px-4 sm:px-6">
            <div class="w-full">
                <h6 class="text-indigo-500">Book Details</h6>
                <div class="flex justify-start">
                    <div class="w-1/2 mr-5">
                        <v-input name="book-name" label="Book Name" :value="state.book.name" @update:value="state.book.name = $event.value" />
                    </div>
                    <div class="w-1/5">
                        <v-input name="book-year" label="Book Year" :value="state.book.year" @update:value="state.book.year = $event.value" />
                    </div>
                </div>
            </div>

            <div class="w-full">
                <h6 class="text-indigo-500">Book Author</h6>
                <div class="flex justify-start">
                    <div class="w-1/2 mr-5">
                        <v-input name="author-name" label="Author Name" :value="state.author.name" @update:value="state.author.name = $event.value" />
                    </div>
                    <div class="w-1/5 mr-5">
                        <v-input name="author-birth-date" label="Author Birth Date" :value="state.author.birth_date" @update:value="state.author.birth_date = $event.value" />
                    </div>
                    <div class="w-1/5">
                        <v-input name="author-genre" label="Author Genre" :value="state.author.genre" @update:value="state.author.genre = $event.value" />
                    </div>
                </div>
            </div>
        </div>
</template>
<script>
import { reactive } from '@vue/reactivity';
// Components
import VInput from '../forms/VInput.vue';
export default {
    components: {
        VInput
    },

    setup() {
        const state = reactive({
            book: {
                name: null,
                year: null
            },
            author: {
                name: null,
                birth_date: null,
                genre: null
            }
        })

        return {
            state
        }
    },
}
</script>