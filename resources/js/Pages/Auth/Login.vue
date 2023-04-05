<script setup>
import AuthLayout from '@/Layouts/AuthLayout.vue';
import Checkbox from '@/Components/Form/Checkbox.vue';
import InputError from '@/Components/Form/InputError.vue';
import InputHelp from '@/Components/Form/InputHelp.vue';
import InputLabel from '@/Components/Form/InputLabel.vue';
import PrimaryButton from '@/Components/Form/PrimaryButton.vue';
import TextInput from '@/Components/Form/TextInput.vue';
import PasswordInput from '@/Components/Form/PasswordInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import { ref } from 'vue';

defineProps({
    canResetPassword: Boolean,
    status: String
});

const form = useForm({
    email: '',
    password: '',
    remember: false,
});

const app_name = ref(import.meta.env.VITE_APP_NAME);

const submit = () => {
    form.post(route('login'), {
        onFinish: () => form.reset('password'),
    });
};
</script>

<template>
    <AuthLayout>
        <Head title="Log in" />

            <div class="container-fluid">

                <div class="row mb-5 mt-3">
                    <div class="col">
                        <div class="float-end">Not a member? <Link :href="route('register')">Sign up now</Link></div>
                    </div>
                </div>

                <h2 class="mb-4">Sign in to {{ app_name }}</h2>

                <div v-if="status" class="alert alert-secondary">{{ status }}</div>

                <form @submit.prevent="submit">

                    <div class="row mb-3">
                        <div class="col">
                            <InputLabel for="email" value="Email address" />
                            <TextInput id="email" type="email" v-model="form.email" autofocus autocomplete="username"  placeholder="e.g. john@your-domain.com" />
                            <InputHelp :message="'We will never share your email with anyone else.'" />
                            <InputError :message="form.errors.email" />
                        </div>
                    </div>                

                    <div class="row mb-3">
                        <div class="col">
                            <InputLabel for="password" value="Password" />
                            <PasswordInput v-model="form.password" />
                            <InputError :message="form.errors.password" />
                        </div>
                    </div> 

                    <div class="row mb-3">
                        <div class="col">
                            <label class="form-check-label" for="remember">
                                <Checkbox name="remember" v-model:checked="form.remember" />
                                <span class="form-text"> Remember</span>
                            </label>
                        </div>
                    </div> 

                    <PrimaryButton :processing="form.processing">Sign in</PrimaryButton>

                </form>

                <div class="row mb-3 mt-3">
                    <div class="col">
                        <div class="float-end">
                            <Link v-if="canResetPassword" :href="route('password.request')">Forgot your password?</Link>                            
                        </div>
                    </div>
                </div>

            </div>
        
    </AuthLayout>
</template>
