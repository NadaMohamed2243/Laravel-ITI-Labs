<template>
    <div>
      <button @click="fetchPost" class="px-4 py-1 bg-blue-500 text-white rounded">View</button>
      <Modal :show="showModal" @close="showModal = false">
        <div v-if="post">
          <h2 class="text-xl font-bold">{{ post.title }}</h2>
          <p>{{ post.description }}</p>
          <p><strong>Username:</strong> {{ post.user.name }}</p>
          <p><strong>Email:</strong> {{ post.user.email }}</p>
        </div>
      </Modal>
    </div>
  </template>
  
  <script setup>
  import { ref } from 'vue';
  import axios from 'axios';
  import Modal from '@/Components/Modal.vue';
  
  const props = defineProps({
    id: Number,
  });
  
  const showModal = ref(false);
  const post = ref(null);
  
  function fetchPost() {
    axios.get(`/api/posts/${props.id}`).then(response => {
      post.value = response.data;
      showModal.value = true;
    });
  }
  </script>