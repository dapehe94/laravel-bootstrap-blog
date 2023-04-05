<script setup>
import TextareaInput from '@/Components/Form/TextareaInput.vue';
import InputLabel from '@/Components/Form/InputLabel.vue';
import InputError from '@/Components/Form/InputError.vue';
import PrimaryButton from '@/Components/Form/PrimaryButton.vue';
import { useForm } from '@inertiajs/vue3';
import { computed } from 'vue';

const props = defineProps({
    comments: Object,
    post: Object
});

const form = useForm({
    post_id: props.post.id,
    content: '',
});

const submit = () => {
    form.post(route('comment.store'), {
        preserveScroll: true,
        onSuccess: () => form.reset('content'),
    });
};
</script>

<template>
    <hr/>

    <h5 v-if="comments">{{ post.comments_count }} <span v-if="post.comments_count === 1">comment</span><span v-else>comments</span></h5>

    <div v-for="comment in comments" :class="{'text-muted': !comment.approved}">
        {{comment.content}} - {{comment.author.name}} - {{ $filters.fromnow(comment.created_at) }} <em v-if="!comment.approved"><small>(pending approval)</small></em>
    </div>

    <div v-if="$page.props.auth.user">

        <form @submit.prevent="submit" class="pt-3">

            <div class="row mb-3">
                <div class="col">
                    <InputLabel for="comment" value="Comment" />
                    <TextareaInput id="comment" v-model="form.content" placeholder="Comment"></TextareaInput>
                    <InputError :message="form.errors.content" />
                </div>
            </div>
            <input type="hidden" v-model="form.post_id">
            <PrimaryButton :processing="form.processing">Comment</PrimaryButton>

        </form>        
    </div>
</template>