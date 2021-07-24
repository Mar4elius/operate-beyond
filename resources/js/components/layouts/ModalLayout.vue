<template>
  <teleport to="body">
    <transition
      enter-active-class="transition ease-out duration-200 transform"
      enter-from-class="opacity-0"
      enter-to-class="opacity-100"
      leave-active-class="transition ease-in duration-200 transform"
      leave-from-class="opacity-100"
      leave-to-class="opacity-0"
    >
      <div
        v-if="showModal"
        ref="modal-backdrop"
        class="fixed z-10 inset-0 overflow-y-auto bg-gray-500 bg-opacity-50"
      >
        <div
          class="flex items-start justify-center min-h-screen pt-24 text-center"
          ref="modal_outside"
        >
          <transition
            enter-active-class="transition ease-out duration-300 transform "
            enter-from-class="opacity-0 translate-y-10 scale-95"
            enter-to-class="opacity-100 translate-y-0 scale-100"
            leave-active-class="ease-in duration-200"
            leave-from-class="opacity-100 translate-y-0 scale-100"
            leave-to-class="opacity-0 translate-y-10 translate-y-0 scale-95"
          >
            <div
              class="
                w-1/2
                bg-white
                rounded-lg
                text-left
                overflow-hidden
                shadow-xl
              "
              role="dialog"
              ref="modal"
              aria-modal="true"
              aria-labelledby="modal-headline"
            >
              <div class="w-full flex justify-end">
                <button class="m-4" @click="closeModal">
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
                      d="M6 18L18 6M6 6l12 12"
                    />
                  </svg>
                </button>
              </div>
              <div class="m-4">
                <slot>I'm modal slot. Don't forget to add content!</slot>
              </div>
            </div>
          </transition>
        </div>
      </div>
    </transition>
  </teleport>
</template>

<script>
import { ref } from '@vue/reactivity';
import { watch } from '@vue/runtime-core';

export default {
  props: {
    show: {
      type: Boolean,
      default: false,
    },
  },

  emits: ['closeModal'],

  setup(props, { emit }) {
    const modal_outside = ref(null);
    const showModal = ref(false);

    function closeModal() {
      showModal.value = false;
      emit('closeModal');
    }

    const onClickOutside = (event) => {
      if (modal_outside.value === event.target) {
        closeModal();
      }
    };

    watch(
      () => props.show,
      (show) => {
        if (show) {
          window.addEventListener('click', onClickOutside);
        } else {
          window.removeEventListener('click', onClickOutside);
        }
        showModal.value = show;
      },
    );

    return {
      closeModal,
      onClickOutside,
      modal_outside,
      showModal,
    };
  },
};
</script>
