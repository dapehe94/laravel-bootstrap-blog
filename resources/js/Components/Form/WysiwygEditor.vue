<script setup>
import { onMounted, ref } from 'vue';
import Editor from '@tinymce/tinymce-vue';

const props = defineProps(['modelValue']);

const emit = defineEmits(['update:modelValue']);

const TINY_API_KEY = import.meta.env.VITE_TINY_API_KEY;

const config = {
    menubar: false,
    plugins: 'lists link image table code help wordcount fullscreen',
    toolbar: 'undo redo | blocks | bold italic | alignleft aligncenter alignright alignjustify bullist numlist outdent indent fullscreen'
};

const handleChange = (editor) => { 
    emit('update:modelValue', editor.level.content)
};
const handleInit = (editor) => { 
    tinymce.activeEditor.setContent(props.modelValue);
};

</script>
<template>
    <Editor
        @init="handleInit"
        @change="handleChange"   
        :value="modelValue"
        :api-key="TINY_API_KEY"
        :init="config"
    />    
</template>
