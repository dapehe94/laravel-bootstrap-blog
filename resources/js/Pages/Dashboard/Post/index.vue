<script setup>
import DashboardLayout from '@/Layouts/DashboardLayout.vue';
import Table from '@/Components/Display/Table.vue';
import { Head, Link } from '@inertiajs/vue3';
import { computed, ref } from 'vue';

const props = defineProps({
    posts: Object
});

const fields = [
  { key: 'title', label: 'Title', sortable: true },
  { key: 'user_id', label: 'User', sortable: true },
  { key: 'categories', label: 'Categories', sortable: true },
  { key: 'tags', label: 'Tags', sortable: true },
  { key: 'comments_count', label: 'Comments', sortable: true, badge: 'bg-secondary' },
  { key: 'status', label: 'Status', sortable: true },  
  { key: 'created_at', label: 'Created', sortable: true },
  { key: 'delete', label: '', action: true, routing: 'post.destroy' },
  { key: 'edit', label: '', action: true, routing: 'post.edit' },  
];

const search = ref('');

const filteredItems = computed(() => {
  return props.posts.filter((post) => {
    return post.title.toLowerCase().includes(search.value.toLowerCase())
  });
});
</script>

<template>
    <DashboardLayout>

        <Head title="Posts" />

        <div class="container-fluid pt-5 pb-3">

            <div v-if="$page.props.flash.message" class="alert alert-info alert-dismissible fade show">
                {{ $page.props.flash.message }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        
            <div class="row">
                <div class="col-4">
                  <h5><i class="bi bi-pin-angle"></i> Posts</h5>
                </div>
                <div class="col-8">
                  <Link :href="route('post.create')" class="btn btn-outline-primary float-end"><i class="bi bi-plus-lg"></i> Create</Link>                    
                </div>
            </div>        
        </div>

        <Table :items="filteredItems" :fields="fields" v-model:search="search" />

    </DashboardLayout>
</template>