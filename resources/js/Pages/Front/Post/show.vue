<script setup>
import FrontLayout from '@/Layouts/FrontLayout.vue';
import Comments from '@/Components/Display/Comments.vue';
import { Head, Link } from '@inertiajs/vue3';

defineProps({
    post: Object,
    comments: Object,
    categories: Object,
    tags: Object
});
</script>

<template>
    <FrontLayout>

        <Head :title="post.title" />

        <small v-for="category in categories">
            <a :href="route('category.show', category.slug)">{{category.name}}, </a>
        </small>
        <h1>{{post.title}}</h1>

        <div v-html="post.content" class="text-content"></div>

        <span v-for="tag in tags">
            <a :href="route('tag.show', tag.slug)">#{{tag.name}}, </a>
        </span>

        <Comments :post="post" :comments="comments" />

    </FrontLayout>
</template>
