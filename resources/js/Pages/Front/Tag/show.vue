<script setup>
import FrontLayout from '@/Layouts/FrontLayout.vue';
import { Head, Link } from '@inertiajs/vue3';

defineProps({
    tag: Object,
    posts: Object    
});
</script>

<template>
    <FrontLayout>

        <Head :title="tag.name" />
        
        <h1>{{tag.name}}</h1>
        {{tag.description}}

        <div class="pb-4" v-for="post in posts">
            <h2><a :href="route('post.show', post.slug)">{{post.title}}</a></h2>
            {{post.excerpt}}            
        </div>     
    </FrontLayout>
</template>