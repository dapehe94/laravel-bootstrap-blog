<script setup>
defineProps(['message']);
</script>

<template>
    <div v-show="message" class="form-text">
        {{ message }}
    </div>
</template>