<script setup>
import { ref } from "vue";
import axios from "axios";

const props = defineProps({
    id: Number, // The post ID passed from the parent component
});

const post = ref(null);
const isLoading = ref(false);
const isOpen = ref(false);

const fetchPost = async () => {
    isLoading.value = true;
    try {
        const response = await axios.get(`/api/posts/${props.id}`);
        post.value = response.data;
        isOpen.value = true; // Open modal when data is loaded
    } catch (error) {
        console.error("Error fetching post:", error);
    } finally {
        isLoading.value = false;
    }
};

const closeModal = () => {
    isOpen.value = false;
};
</script>

<template>
    <div>
        <button @click="fetchPost" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
        View Post
    </button>

    <div v-if="isOpen" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50">
        <div class="bg-white p-6 rounded-lg shadow-lg w-96">
            <h2 class="text-lg font-semibold">Post Details</h2>
            <div v-if="isLoading" class="text-gray-500">Loading...</div>
            <div v-else-if="post">
                <p><strong>Title:</strong> {{ post.title }}</p>
                <p><strong>Description:</strong> {{ post.description }}</p>
                <p><strong>Author:</strong> {{ post.username }}</p>
                <p><strong>Email:</strong> {{ post.useremail }}</p>
            </div>
            <button @click="closeModal" class="mt-4 px-4 py-2 bg-red-600 text-white rounded-md">
                Close
            </button>
        </div>
    </div>
    </div>
</template>

