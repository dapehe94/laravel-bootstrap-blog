<script setup>
import DashboardLayout from '@/Layouts/DashboardLayout.vue';
import InputError from '@/Components/Form/InputError.vue';
import InputLabel from '@/Components/Form/InputLabel.vue';
import PrimaryButton from '@/Components/Form/PrimaryButton.vue';
import TextInput from '@/Components/Form/TextInput.vue';
import TextareaInput from '@/Components/Form/TextareaInput.vue';
import Table from '@/Components/Display/Table.vue';
import { Head, useForm } from '@inertiajs/vue3';
import { computed, ref } from 'vue';

const props = defineProps({
    categories: Object
});

const fields = [
  { key: 'name', label: 'Name', sortable: true },
  { key: 'description', label: 'Description', sortable: true },
  { key: 'slug', label: 'Slug', sortable: false }
];

const search = ref('');

const form = useForm({
    name: '',
    description: ''
});

const submit = () => {
    form.post(route('category.store'), {
        //onFinish: () => form.reset(),
    });
};

const filteredItems = computed(() => {
  return props.categories.filter((category) => {
    return category.name.toLowerCase().includes(search.value.toLowerCase())
  });
});
</script>

<template>
    <DashboardLayout>
        <Head title="Category" />
        
        <div class="container-fluid pt-5 pb-2">

            <div class="row">
                <div class="col-4">                    

                    <h5><i class="bi bi-archive"></i> Categories</h5>

                    <form @submit.prevent="submit" class="pt-3">

                        <div class="row mb-3">
                            <div class="col">
                                <InputLabel for="name" value="Name" />
                                <TextInput id="name" type="text" v-model="form.name" autofocus autocomplete="name" placeholder="Category name" />
                                <InputError :message="form.errors.name" />
                            </div>
                        </div> 

                        <div class="row mb-3">
                            <div class="col">
                                <InputLabel for="description" value="Description" />
                                <TextareaInput id="description" v-model="form.description" placeholder="Category description"></TextareaInput>
                                <InputError :message="form.errors.description" />
                            </div>
                        </div>

                        <PrimaryButton :processing="form.processing">Create category</PrimaryButton>

                    </form>
                    
                </div>
                <div class="col-8">

                    <Table :items="filteredItems" :fields="fields" v-model:search="search" />
                    
                </div>
            </div>


        </div>

    </DashboardLayout>
</template>