<template>
    <div v-if="show" class="fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-75">
      <div class="bg-white p-6 rounded-lg shadow-lg">
        <button @click="close" class="absolute top-0 right-0 m-4 text-gray-600">&times;</button>
        <slot></slot>
      </div>
    </div>
  </template>

  <script setup>
  import { ref } from 'vue';

  const props = defineProps({
    show: Boolean,
  });

  const emit = defineEmits(['close']);

  function close() {
    emit('close');
  }
  </script>
