<script setup>
import { ref, watch, nextTick, onMounted, computed } from "vue";

const props = defineProps({
    name: { type: String, default: "" },
    modelValue: { type: Array, default: () => [] },
    options: { type: [Array, Boolean], default: false },
    allowCustom: { type: Boolean, default: true },
    showCount: { type: Boolean, default: false }
});

const tags = ref(props.modelValue);
const newTag = ref("");
const id = Math.random().toString(36).substring(7);

const addTag = (tag) => {
  if (!tag) return; // prevent empty tag
  // only allow predefined tags when allowCustom is false
  if (!props.allowCustom && !props.options.includes(tag)) return;
  // return early if duplicate
  if (tags.value.includes(tag)) {
    handleDuplicate(tag);
    return;
  }
  tags.value.push(tag);
  newTag.value = ""; // reset newTag
};

const removeTag = (index) => {
  tags.value.splice(index, 1);
};

const emit = defineEmits(['update:modelValue']);

// handling duplicates
const duplicate = ref(null);
const handleDuplicate = (tag) => {
  duplicate.value = tag;
  setTimeout(() => (duplicate.value = null), 1000);
  newTag.value = "";
};

const onTagsChange = () => {
  // emit value on tags change
  emit("update:modelValue", tags.value);
};

watch(tags, () => nextTick(onTagsChange), { deep: true });

onMounted(onTagsChange);

// options
const availableOptions = computed(() => {
  if (!props.options) return false;
  return props.options.filter((option) => !tags.value.includes(option));
});

</script>

<template>
  <div class="tag-input" :class="{ 'with-count': showCount }">
    <input
      v-model="newTag"
      type="text"
      :list="id"
      autocomplete="off"
      @keydown.prevent.enter="addTag(newTag)"
      @keydown.prevent.tab="addTag(newTag)"
      @keydown.delete="newTag.length || removeTag(tags.length - 1)"
      class="form-control mb-3"
    />

    <datalist v-if="options" :id="id">
      <option v-for="option in availableOptions" :key="option" :value="option.text">
        {{ option.text }}
      </option>
    </datalist>

    <ul class="list-unstyled mt-3" ref="tagsUl" style="display:inline;">
      <li
        v-for="(tag, index) in tags"
        :key="tag"
        style="display:inline;"
        class="pe-2"
        :class="{ duplicate: tag === duplicate }"
      >
        <i class="bi bi-x-circle-fill pointer close-tag" @click="removeTag(index)"></i>
        {{ tag }}
      </li>
    </ul>
    <div v-if="showCount" class="count">
      <span>{{ tags.length }}</span> tags
    </div>
  </div>
</template>