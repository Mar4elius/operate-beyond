<template>
    <div class="w-full text-center">
        <p>Are you sure you want to delete <span class="font-bold">{{book.name}}</span>?</p>
    </div>
    <div class="w-full flex justify-center my-10">
        <v-button id="add-book" size="regular" classes="mr-5" @btnOnClickEvent="destroyBook">Confirm</v-button>
        <v-button id="add-book" size="regular" type="danger" @btnOnClickEvent="closeModal">Cancel</v-button>
    </div>
</template>
<script>
import { useStore } from 'vuex';
import VButton from '../forms/VButton.vue';
export default {
    components: {
        VButton
    },

    props: {
        book: {
            type: Object,
            required: true
        }
    },

    setup(props, {emit}) {
        const store = useStore();

        async function destroyBook() {
            await store.dispatch('books/destroy', props.book);
            emit('refreshTable');
            closeModal();
        }

        function closeModal() {
            emit('closeModal');
        }

        return {
            closeModal,
            destroyBook
        }
    },
}
</script>