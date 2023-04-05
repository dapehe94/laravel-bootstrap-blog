<script setup>
import DashboardLayout from '@/Layouts/DashboardLayout.vue';
import { Head } from '@inertiajs/vue3';
</script>

<template>
    <DashboardLayout>
        <Head title="Dashboard" />

        <h5 class="pt-5 pb-2 border-bottom"><i class="bi bi-speedometer2"></i> Dashboard, {{ $page.props.auth.user.name }}</h5>

    </DashboardLayout>
</template>
