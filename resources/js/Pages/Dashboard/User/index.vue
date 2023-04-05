<script setup>
import DashboardLayout from '@/Layouts/DashboardLayout.vue';
import Table from '@/Components/Display/Table.vue';
import { Head, Link } from '@inertiajs/vue3';
import { computed, ref } from 'vue';

const props = defineProps({
    users: Object
});

const fields = [
  { key: 'name', label: 'Name', sortable: true },
  { key: 'email', label: 'Email', sortable: true }
];

const search = ref('');

const filteredItems = computed(() => {
  return props.users.filter((user) => {
    return user.name.toLowerCase().includes(search.value.toLowerCase())
  });
});
</script>

<template>
    <DashboardLayout>

        <Head title="Users" />
        
        <h5 class="pt-5 pb-2"><i class="bi bi-people"></i> Users</h5>   

        <Table :items="filteredItems" :fields="fields" v-model:search="search" />

    </DashboardLayout>
</template>