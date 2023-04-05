<script setup>
import AuthLayout from '@/Layouts/AuthLayout.vue';
import InputError from '@/Components/Form/InputError.vue';
import InputLabel from '@/Components/Form/InputLabel.vue';
import PrimaryButton from '@/Components/Form/PrimaryButton.vue';
import TextInput from '@/Components/Form/TextInput.vue';
import { Head, useForm } from '@inertiajs/vue3';

defineProps({
    status: String,
});

const form = useForm({
    email: '',
});

const submit = () => {
    form.post(route('password.email'));
};
</script>

<template>
    <AuthLayout>
        <Head title="Forgot Password" />

        <div class="container-fluid">

            <div class="row mb-5 mt-3">
                <div class="col">
                    <div>
                        <h2>Forgot your password? No problem.</h2> Just let us know your email address and we will email you a password reset
                        link that will allow you to choose a new one.
                    </div>                    
                </div>
            </div>
        
            <div v-if="status" class="alert alert-secondary">{{ status }}</div>

            <form @submit.prevent="submit">

                <div class="row mb-3">
                    <div class="col">
                        <InputLabel for="email" value="Email address" />
                        <TextInput id="email" type="email" v-model="form.email" autofocus autocomplete="username" placeholder="e.g. john@your-domain.com" />
                        <InputError :message="form.errors.email" />
                    </div>
                </div>

                <PrimaryButton :processing="form.processing">Email Password Reset Link</PrimaryButton>
                
            </form>

        </div>

    </AuthLayout>
</template>
