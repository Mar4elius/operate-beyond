<template>
    <div v-if="validationErrors.length" class="bg-red-500 text-white py-2 px-4 pr-0 rounded font-bold mb-4 shadow-lg">
        <h6>Errors in {{errors.errorsFor}}</h6>
        <ul class="">
            <li v-for="value in validationErrors" :key="value">*{{ value }}</li>
        </ul>
    </div>
</template>

<script>
import { computed } from '@vue/runtime-core'
export default {
    props: {
        header: {
            type: String,
            default: ''
        },

        errors: {
            type: Object,
            default: () => ({})
        }
    },

    setup(props) {
        const validationErrors = computed(() => Object.values(props.errors.errors).flat());

        return {
            validationErrors
        }
    },
}
</script>
