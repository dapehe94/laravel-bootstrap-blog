<script setup>
import DashboardLayout from '@/Layouts/DashboardLayout.vue';
import Table from '@/Components/Display/Table.vue';
import { Head, Link } from '@inertiajs/vue3';
import { computed, ref } from 'vue';

const props = defineProps({
    comments: Object
});

const fields = [
  { key: 'user_id', label: 'Author', sortable: true },    
  { key: 'content', label: 'Comment', sortable: true },
  { key: 'approved', label: 'Approved', sortable: true },
  { key: 'post_id', label: 'In reply to', sortable: true },  
  { key: 'created_at', label: 'Sent', sortable: true },
  { key: 'delete', label: '', action: true, routing: 'comment.destroy' },
  { key: 'approve', label: '', action: true, routing: 'comment.update' }
];

const search = ref('');

const filteredItems = computed(() => {
  return props.comments.filter((comment) => {
    return comment.content.toLowerCase().includes(search.value.toLowerCase())
  });
});
</script>

<template>
    <DashboardLayout>

        <Head title="Comments" />

        <div class="container-fluid pt-5 pb-3">

            <div class="row">
                <div class="col-4">
                  <h5><i class="bi bi-chat-square-text"></i> Comments</h5> 
                </div>
            </div>        
        </div>

        <Table :items="filteredItems" :fields="fields" v-model:search="search" />

    </DashboardLayout>
</template>