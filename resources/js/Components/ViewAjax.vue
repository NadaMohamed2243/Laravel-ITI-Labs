<template>
    <div>
        <button @click="fetchPost" class="px-4 py-2 bg-blue-600 text-white rounded">View Ajax</button>

        <div v-if="showModal" class="fixed inset-0 bg-[rgba(128,128,166,0.4)] flex items-center justify-center">
            <div class="bg-white p-6 rounded-lg shadow-lg max-w-sm w-full">
                <h2 class="text-lg font-semibold text-gray-800">{{ post.title }}</h2>
                <p class="text-gray-600 mt-2">{{ post.description }}</p>
                <p class="text-gray-600 mt-2">Posted by: {{ post.user.name }} ({{ post.user.email }})</p>
                <div class="mt-4 flex justify-end space-x-2">
                    <button @click="showModal = false" class="px-4 py-2 bg-gray-300 text-gray-700 rounded cursor-pointer">Close</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    props: ['id'],
    data() {
        return {
            showModal: false,
            post: {}
        };
    },
    methods: {
        fetchPost() {
            axios.get(`/posts/${this.id}`)
                .then(response => {
                    this.post = response.data;
                    this.showModal = true;
                })
                .catch(error => {
                    console.error('Error fetching post:', error);
                });
        }
    }
};
</script>

<style scoped>
/* Add any component-specific styles here */
</style>
