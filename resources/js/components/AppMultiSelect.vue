<script setup lang="ts">
import { ref, computed, watch } from 'vue';
import { Combobox } from '@headlessui/vue';

// Props
const props = defineProps<{
  modelValue: any[],
  options: { id: number | string, label: string }[],
  placeholder?: string
}>();

const emit = defineEmits(['update:modelValue']);

const selectedOptions = ref([...props.modelValue]);
const query = ref('');

watch(selectedOptions, (val) => {
  emit('update:modelValue', val);
});

watch(() => props.modelValue, (val) => {
  selectedOptions.value = [...val];
});

const filteredOptions = computed(() => {
  if (query.value === '') return props.options;
  return props.options.filter((option) =>
    option.label.toLowerCase().includes(query.value.toLowerCase())
  );
});

function toggleSelection(option: { id: number | string, label: string }) {
  const exists = selectedOptions.value.some((o) => o.id === option.id);
  if (exists) {
    selectedOptions.value = selectedOptions.value.filter((o) => o.id !== option.id);
  } else {
    selectedOptions.value.push(option);
  }
}
</script>

<template>
  <div class="w-full max-w-sm">
    <Combobox v-model="selectedOptions" multiple>
      <div class="relative">
        <div class="flex flex-wrap gap-1 mb-1">
          <span
            v-for="item in selectedOptions"
            :key="item.id"
            class="bg-muted px-2 py-1 rounded-full text-sm"
          >
            {{ item.label }}
          </span>
        </div>

        <Combobox.Input
          class="w-full border rounded-md py-2 px-3"
          v-model="query"
          :placeholder="props.placeholder || 'Search...'"
        />

        <Combobox.Options class="absolute mt-1 w-full bg-popover border rounded-md max-h-60 overflow-auto z-10">
          <Combobox.Option
            v-for="option in filteredOptions"
            :key="option.id"
            :value="option"
            as="template"
          >
            <li
              @click="toggleSelection(option)"
              class="cursor-pointer px-4 py-2 hover:bg-muted"
              :class="{ 'bg-muted': selectedOptions.some((o) => o.id === option.id) }"
            >
              {{ option.label }}
            </li>
          </Combobox.Option>
        </Combobox.Options>
      </div>
    </Combobox>
  </div>
</template>

