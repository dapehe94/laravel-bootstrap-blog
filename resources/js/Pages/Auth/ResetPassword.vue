<script setup>
import AuthLayout from '@/Layouts/AuthLayout.vue';
import InputError from '@/Components/Form/InputError.vue';
import InputLabel from '@/Components/Form/InputLabel.vue';
import PrimaryButton from '@/Components/Form/PrimaryButton.vue';
import TextInput from '@/Components/Form/TextInput.vue';
import { Head, useForm } from '@inertiajs/vue3';

const props = defineProps({
    email: String,
    token: String,
});

const form = useForm({
    token: props.token,
    email: props.email,
    password: '',
    password_confirmation: '',
});

const submit = () => {
    form.post(route('password.store'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};
</script>

<template>
    <AuthLayout>
        <Head title="Reset Password" />

        <div class="container-fluid mt-5">

            <h2 class="mb-4">Reset your password</h2>

            <form @submit.prevent="submit">

                <div class="row mb-3">
                    <div class="col">
                        <InputLabel for="email" value="Email address" />
                        <TextInput id="email" type="email" v-model="form.email" autofocus autocomplete="username" placeholder="e.g. john@your-domain.com" />
                        <InputError :message="form.errors.email" />
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col">
                        <InputLabel for="password" value="Password" />
                        <TextInput id="password" type="password" v-model="form.password" autocomplete="new-password" placeholder="6+ characters" />
                        <InputError :message="form.errors.password" />
                    </div>
                </div> 

                <div class="row mb-3">
                    <div class="col">
                        <InputLabel for="password_confirmation" value="Confirm Password" />
                        <TextInput id="password_confirmation" type="password" v-model="form.password_confirmation" autocomplete="new-password" placeholder="6+ characters" />
                        <InputError :message="form.errors.password_confirmation" />
                    </div>
                </div> 

                <PrimaryButton :processing="form.processing">Reset Password</PrimaryButton>

            </form>
        </div>

    </AuthLayout>
</template>
