<script setup>
import DashboardLayout from '@/Layouts/DashboardLayout.vue';
import DeleteUserForm from './Partials/DeleteUserForm.vue';
import UpdatePasswordForm from './Partials/UpdatePasswordForm.vue';
import UpdateProfileInformationForm from './Partials/UpdateProfileInformationForm.vue';
import { Head } from '@inertiajs/vue3';

defineProps({
    mustVerifyEmail: Boolean,
    status: String,
});
</script>

<template>
    <Head title="Profile" />

    <DashboardLayout>

        <h5 class="pt-5 pb-2"><i class="bi bi-person"></i> Profile</h5>

        <div class="container-fluid pt-2">

                <div class="row">
                    <UpdateProfileInformationForm
                        :must-verify-email="mustVerifyEmail"
                        :status="status"
                    />                        
                </div>

                <div class="row mt-5">
                    <UpdatePasswordForm />
                </div>

                <div class="row mt-5">
                    <DeleteUserForm />
                </div>

        </div>
    </DashboardLayout>
</template>