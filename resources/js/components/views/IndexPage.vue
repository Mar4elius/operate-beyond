<template>
  <div class="w-full text-center">
    <h1>Available Books</h1>
  </div>

  <div class="w-full bg-gray-600 flex justify-evenly">
    <p>Book Name</p>
    <p>Book Year</p>
    <p>Author Name</p>
    <p>Authore Genre</p>
    <p>Library Name</p>
    <p>Library Address</p>
    <p>Actions</p>
  </div>

  <!-- <div
    class="grid grid-cols-4 gap-4 bg-gray-800 px-4 py-2 mt-6"
    v-for="token in tokens"
    :key="token.address"
  >
    <div>{{ token.symbol }}</div>
    <div>{{ token.address }}</div>
    <div class="text-right">{{ token.price }}</div>
    <div class="text-center">
      <button @click="displayAlertsModal(token)">
        <svg
          xmlns="http://www.w3.org/2000/svg"
          class="h-6 w-6 mr-5"
          fill="none"
          viewBox="0 0 24 24"
          stroke="currentColor"
        >
          <path
            stroke-linecap="round"
            stroke-linejoin="round"
            stroke-width="2"
            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"
          />
        </svg>
      </button>
      <button @click="displayConfirmationModal(token)">
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
    </div>
  </div> -->
</template>

<script>
//
import { onMounted } from '@vue/runtime-core';
import { useStore } from 'vuex';

export default {
  setup() {
      //
      const store = useStore();
      onMounted(() => {
          store.dispatch('books/search');
      })
  }
};
</script>
