<script setup>
defineProps({
    type: {
        type: String,
        default: 'submit',
    },
    processing: {
        type: Boolean
    }
});
</script>

<template>
    <button
        :type="type"
        class="btn btn-primary"
        :disabled="processing"
    >
        <div v-if="processing">
            <span class="spinner-grow spinner-grow-sm"></span>Loading...
        </div>
        <div v-else><slot /></div>        
    </button>
</template>
