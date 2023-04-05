<script setup>
import { onMounted, ref } from 'vue';

defineProps(['modelValue']);

defineEmits(['update:modelValue']);

const input = ref(null);
const FieldType = ref('password');
const visible = ref(false);

onMounted(() => {
    if (input.value.hasAttribute('autofocus')) {
        input.value.focus();
    }
});

defineExpose({ focus: () => input.value.focus() });

const switchVisibility = () => {
    FieldType.value = FieldType.value === "password" ? "text" : "password";
    visible.value = !visible.value;
};
</script>

<template>
    <div class="input-group mb-3">
        <input
            :type="FieldType"
            class="form-control border-end-0"
            :value="modelValue"
            @input="$emit('update:modelValue', $event.target.value)"
            ref="input"
            autocomplete="new-password" 
            placeholder="6+ characters"
        />
        <span class="input-group-text pointer bg-white border border-start-0" id="basic-addon2" @click.prevent="switchVisibility">
            <i class="bi" :class="{ 'bi-eye-slash-fill': !visible, 'bi-eye-fill': visible }"></i>            
        </span>

    </div>
</template>

