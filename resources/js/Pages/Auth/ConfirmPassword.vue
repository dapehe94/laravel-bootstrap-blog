<script setup>
import AuthLayout from '@/Layouts/AuthLayout.vue';
import InputError from '@/Components/Form/InputError.vue';
import InputLabel from '@/Components/Form/InputLabel.vue';
import PrimaryButton from '@/Components/Form/PrimaryButton.vue';
import PasswordInput from '@/Components/Form/PasswordInput.vue';
import { Head, useForm } from '@inertiajs/vue3';

const form = useForm({
    password: '',
});

const submit = () => {
    form.post(route('password.confirm'), {
        onFinish: () => form.reset(),
    });
};
</script>

<template>
    <AuthLayout>
        <Head title="Confirm Password" />

        <div class="container-fluid">

            <div class="row mb-5 mt-3">
                <div class="col">
                    This is a secure area of the application. Please confirm your password before continuing.
                </div>
            </div>

            <form @submit.prevent="submit">

                <div class="row mb-3">
                    <div class="col">
                        <InputLabel for="password" value="Password" />
                        <PasswordInput id="password" v-model="form.password" />
                        <InputError :message="form.errors.password" />
                    </div>
                </div> 

                <PrimaryButton :processing="form.processing">Confirm</PrimaryButton>

            </form>

        </div>        
    </AuthLayout>
</template>
