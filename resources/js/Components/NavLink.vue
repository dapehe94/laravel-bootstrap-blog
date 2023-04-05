<script setup>
import { computed } from 'vue';
import { Link } from '@inertiajs/vue3';

const props = defineProps(['href', 'processing']);

const classes = computed(() =>
    props.processing
        ? 'btn btn-primary'
        : 'btn btn-primary'
);
</script>

<template>
    <Link :href="href" :class="classes" :disabled="processing" preserve-scroll>
        <div v-if="processing">
            <span class="spinner-grow spinner-grow-sm"></span>Loading...
        </div>
        <div v-else><slot /></div>
    </Link>
</template>
