<script setup>
import AuthLayout from '@/Layouts/AuthLayout.vue';
import InputError from '@/Components/Form/InputError.vue';
import InputLabel from '@/Components/Form/InputLabel.vue';
import PrimaryButton from '@/Components/Form/PrimaryButton.vue';
import TextInput from '@/Components/Form/TextInput.vue';
import PasswordInput from '@/Components/Form/PasswordInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import { ref } from 'vue';

const form = useForm({
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
    terms: false,
});

const app_name = ref(import.meta.env.VITE_APP_NAME);

const submit = () => {
    form.post(route('register'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};
</script>

<template>
    <AuthLayout>
        <Head title="Register" />

        <div class="container-fluid">

            <div class="row mb-5 mt-3">
                <div class="col">
                    <div class="float-end">Already a member? <Link :href="route('login')">Sign In</Link></div>
                </div>
            </div>

            <h2 class="mb-4">Sign up to {{ app_name }}</h2>

            <div v-if="status" class="alert alert-secondary">{{ status }}</div>

            <form @submit.prevent="submit">


                <div class="row mb-3">
                    <div class="col">
                        <InputLabel for="name" value="Name" />
                        <TextInput id="name" type="text" v-model="form.name" autofocus autocomplete="name" placeholder="e.g. John Smith" />
                        <InputError :message="form.errors.name" />
                    </div>
                </div> 

                <div class="row mb-3">
                    <div class="col">
                        <InputLabel for="email" value="Email" />
                        <TextInput id="email" type="email" v-model="form.email" autocomplete="username" placeholder="e.g. john@your-domain.com" />
                        <InputError :message="form.errors.email" />
                    </div>
                </div> 

                <div class="row mb-3">
                    <div class="col">
                        <InputLabel for="password" value="Password" />
                        <PasswordInput id="password" v-model="form.password" />
                        <InputError :message="form.errors.password" />
                    </div>
                </div> 

                <div class="row mb-3">
                    <div class="col">
                        <InputLabel for="password_confirmation" value="Confirm Password" />
                        <PasswordInput id="password_confirmation" v-model="form.password_confirmation" />
                        <InputError :message="form.errors.password_confirmation" />
                    </div>
                </div>                         

                <PrimaryButton :processing="form.processing">Sign up</PrimaryButton>

            </form>
        
        </div>

    </AuthLayout>
</template>
