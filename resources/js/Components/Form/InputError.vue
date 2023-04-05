<script setup>
defineProps(['message']);
</script>

<template>
    <div v-show="message" class="form-text text-danger">
        {{ message }}
    </div>
</template>
