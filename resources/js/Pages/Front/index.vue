<script setup>
import FrontLayout from '@/Layouts/FrontLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
import { ref } from 'vue';

defineProps({
    canLogin: Boolean,
    canRegister: Boolean,
    posts: Object,
});

</script>

<template>
    <FrontLayout>

        <Head title="Welcome" />
        
        <h1>Wellcome to {{$page.props.appName}}</h1>

        <div class="pb-4" v-for="post in posts">

            <small v-for="category in post.categories">
                <Link :href="route('category.show', category.slug)">{{category.name}}, </Link>
            </small>            

            <h2><Link :href="route('post.show', post.slug)">{{post.title}}</Link></h2>
            {{post.excerpt}} - <small>{{ $filters.fromnow(post.created_at) }}</small>

            <span v-for="tag in post.tags">
                <Link :href="route('tag.show', tag.slug)">#{{tag.name}}, </Link>
            </span>       
                  
        </div>
        
    </FrontLayout>
</template>
