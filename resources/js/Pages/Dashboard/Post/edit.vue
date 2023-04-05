<script setup>
import DashboardLayout from '@/Layouts/DashboardLayout.vue';
import InputError from '@/Components/Form/InputError.vue';
import InputLabel from '@/Components/Form/InputLabel.vue';
import PrimaryButton from '@/Components/Form/PrimaryButton.vue';
import TextInput from '@/Components/Form/TextInput.vue';
import TextareaInput from '@/Components/Form/TextareaInput.vue';
import WysiwygEditor from '@/Components/Form/WysiwygEditor.vue';
import SelectInput from '@/Components/Form/SelectInput.vue';
import CheckboxGroup from '@/Components/Form/CheckboxGroup.vue';
import TagInput from '@/Components/Form/TagInput.vue';
import { Head, useForm } from '@inertiajs/vue3';

const props = defineProps({
    post: {
        type: Object,
        default: () => ({}),
    },
    poststatus: Array,
    categories: Array,
    tags: Array
});

const pluck = (arr, key) => arr.map(i => i[key]);
//pluck(props.post.tags, 'name')

const form = useForm({
    id: props.post.id,
    title: props.post.title,
    excerpt: props.post.excerpt,    
    content: props.post.content,
    status: props.post.status,
    categories: pluck(props.post.categories, 'id'),
    tags: pluck(props.post.tags, 'name')
});

const submit = () => {
    form.post(route('post.update', form.id), {
        //onFinish: () => form.reset(),
    });
};
</script>

<template>
    <DashboardLayout>
        <Head title="Post" />
        
        <h5 class="pt-5 pb-2"><i class="bi bi-pin-angle"></i> Edit post</h5>

        <div class="container-fluid pt-2">

            <form @submit.prevent="submit">

                <div class="row">
                    <div class="col-8">

                        <div class="row mb-3">
                            <div class="col">
                                <InputLabel for="title" value="Title" />
                                <TextInput id="title" type="text" v-model="form.title" autofocus autocomplete="title" placeholder="Post title" />
                                <InputError :message="form.errors.title" />
                            </div>
                        </div> 

                        <div class="row mb-3">
                            <div class="col">
                                <InputLabel for="content" value="Content" />
                                <WysiwygEditor id="content" v-model="form.content" placeholder="Post content"></WysiwygEditor>
                                <InputError :message="form.errors.content" />
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col">
                                <InputLabel for="excerpt" value="Excerpt" />
                                <TextareaInput id="excerpt" v-model="form.excerpt" placeholder="Post excerpt"></TextareaInput>
                                <InputError :message="form.errors.excerpt" />
                            </div>
                        </div>                           

                    </div>
                    <div class="col-4">

                        <div class="row mb-3 bg-white p-2 border">
                            <div class="col">
                                <InputLabel for="status" value="Status" />
                                <SelectInput id="status" v-model="form.status" :fields="poststatus" :multiple="false" />
                                <InputError :message="form.errors.status" />
                            </div>
                            
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <PrimaryButton :processing="form.processing" class="mt-2">Update</PrimaryButton>
                            </div>                           
                        </div>    

                        <div class="row mb-3 bg-white p-2 border">
                            <div class="col">
                                <InputLabel for="categories" value="Categories" />                            
                                <CheckboxGroup id="categories" v-model="form.categories" :fields="categories" :checkedvalues="form.categories" />                        
                                <InputError :message="form.errors.categories" />
                            </div>                            
                        </div>   

                        <div class="row mb-3 bg-white p-2 border">
                            <div class="col">
                                <InputLabel for="tag_id" value="Tags" />                            
                                <TagInput id="tag_id" v-model="form.tags" :options="tags" />                        
                                <InputError :message="form.errors.tags" />
                            </div>                            
                        </div>                                             
                    </div>

                </div>

            </form>

        </div>

    </DashboardLayout>
</template>