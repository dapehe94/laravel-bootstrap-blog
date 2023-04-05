<script setup>
import { onMounted, ref } from 'vue';

//const emit = defineEmits(['update:modelValue']);

defineProps({
    modelValue: {
        type: String,
    },
    fields: {
        type: [Array]
    },
    multiple: {
        type: [Boolean]
    },    
});

const input = ref(null);

onMounted(() => {
    if (input.value.hasAttribute('autofocus')) {
        input.value.focus();
    }
});

defineExpose({ focus: () => input.value.focus() });

/*
const addvalues = (event) => {
    let updatedValue = [...props.modelValue]
    updatedValue.push(event);
    emit('update:modelValue', updatedValue)
    //$emit('update:modelValue', $event.target.value)
};
*/
</script>

<template>

    <select
        class="form-select"
        :value="modelValue"
        @input="$emit('update:modelValue', $event.target.value)"
        :multiple="multiple"
        ref="input"
    >
        <option 
            v-for="field in fields"
            :key="field.id"
            :value="field.id"
        >
            {{ field.value }}
        </option>    
    </select>
</template>