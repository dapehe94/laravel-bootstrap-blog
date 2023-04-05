<script setup>
import { ref, onMounted } from "vue";

const props = defineProps({
    fields: {
        type: Array,
        default: () => [],
    },
    modelValue: {
        type: Array
    },
    checkedvalues: {
        type: Array,
        default: () => []
    },        
});

const emit = defineEmits(['update:modelValue']);

const handleOnChange = (event) => {

    const target = parseInt(event.target.value);

    props.checkedvalues.includes(target) === true 
            ? props.checkedvalues.splice(props.checkedvalues.indexOf(target), 1) 
            : props.checkedvalues.push(target);

    emit('update:modelValue', props.checkedvalues);

};
</script>

<template>
    <div class="overflow-auto border p-2" 
         style="max-width: 360px; max-height: 180px;">
            <li class="list-unstyled" v-for="field in fields" :key="field.id">
                <label class="form-check-label pointer" :for="field.value">
                    <input class="form-check-input me-1 pointer" type="checkbox" 
                        :id="field.id"
                        :value="field.id"
                        :checked="props.checkedvalues.includes(field.id)"
                        @change="handleOnChange">
                    {{ field.value }}
                </label>
            </li>
    </div>
</template>