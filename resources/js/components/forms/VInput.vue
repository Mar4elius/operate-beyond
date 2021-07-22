<template>
  <div class="relative w-full mb-6">
    <label
      class="block mb-2 md:mb-3 w-full text-md font-medium text-gray-700"
      :for="name"
      >{{ label }}</label
    >
    <input
      :name="name"
      :id="name"
      :type="type"
      :value="value"
      v-model.lazy="inputValue"
      :disabled="isDisabled"
      class="
        appearance-none
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
        ease-in-out
      "
      :class="{ 'bg-red-200': false }"
      :maxlength="maxlength"
    />
  </div>
</template>

<script>
import { computed, defineComponent } from 'vue';
export default {
  emits: ['update:value'],

  props: {
    type: {
      type: String,
      default: 'text',
    },

    value: {
      type: String,
      default: '',
    },

    name: {
      type: String,
      required: true,
    },

    label: {
      type: String,
      required: true,
    },

    isDisabled: {
      type: Boolean,
      default: false,
    },

    maxlength: {
        type: Number,
        default: '524288'
    }
  },
  setup(props, { emit }) {
    const inputValue = computed({
      get() {
        return props.value;
      },
      set(val) {
        emit('update:value', {
          key: props.name,
          value: val,
        });
      },
    });
    return {
      inputValue,
    };
  },
};
</script>
