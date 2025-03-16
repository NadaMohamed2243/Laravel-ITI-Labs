<template>
    <div>
        <h1 class="text-center text-2xl font-bold mb-4">ITI Blog Post</h1>
        <div class="text-center mb-4">
            <button @click="createPost"
                class="mt-4 px-4 py-2 bg-green-600 text-white font-medium rounded-md hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                Create Post
            </button>
        </div>

        <!-- Table Component -->
        <div class="mt-6 rounded-lg border border-gray-200">
            <div class="overflow-x-auto rounded-t-lg">
                <table class="min-w-full divide-y-2 divide-gray-200 bg-white text-sm">
                    <thead class="text-left">
                        <tr>
                            <th class="px-4 py-2 font-medium whitespace-nowrap text-gray-900">#</th>
                            <th class="px-4 py-2 font-medium whitespace-nowrap text-gray-900">Image</th>
                            <th class="px-4 py-2 font-medium whitespace-nowrap text-gray-900">Title</th>
                            <th class="px-4 py-2 font-medium whitespace-nowrap text-gray-900">Title Slug</th>
                            <th class="px-4 py-2 font-medium whitespace-nowrap text-gray-900">Posted By</th>
                            <th class="px-4 py-2 font-medium whitespace-nowrap text-gray-900">Created At</th>
                            <th class="px-4 py-2 font-medium whitespace-nowrap text-gray-900">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        <tr v-for="post in paginatedPosts" :key="post.id">
                            <td class="px-4 py-2 font-medium whitespace-nowrap text-gray-900">{{ post.id }}</td>
                            <td class="px-4 py-2 whitespace-nowrap text-gray-700">
                                <img v-if="post.image" :src="`${post.image}`" alt="Post Image" width="150" height="150">
                                <span v-else class="text-gray-400">No Image</span>
                            </td>
                            <td class="px-4 py-2 whitespace-nowrap text-gray-700">{{ post.title }}</td>
                            <td class="px-4 py-2 whitespace-nowrap text-gray-700">{{ post.slug }}</td>
                            <td class="px-4 py-2 whitespace-nowrap text-gray-700">
                                {{ post.user ? post.user.name : 'User Not Found' }}
                            </td>
                            <td class="px-4 py-2 whitespace-nowrap text-gray-700">
                                {{ formatDate(post.created_at) }}
                            </td>
                            <td class="px-4 py-2 whitespace-nowrap text-gray-700 space-x-2">
                                <button @click="viewPost(post.id)" class="px-4 py-2 bg-blue-600 text-white rounded">View</button>
                                <button @click="editPost(post.id)" class="px-4 py-2 bg-yellow-600 text-white rounded">Edit</button>
                                <button @click="deletePost(post.id)" class="px-4 py-2 bg-red-600 text-white rounded">Delete</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="flex justify-between items-center p-4 bg-white border-t">
                <button @click="prevPage" :disabled="currentPage === 1"
                    class="px-4 py-2 bg-gray-300 text-gray-700 rounded disabled:opacity-50">
                    Previous
                </button>
                <span>Page {{ currentPage }} of {{ totalPages }}</span>
                <button @click="nextPage" :disabled="currentPage === totalPages"
                    class="px-4 py-2 bg-gray-300 text-gray-700 rounded disabled:opacity-50">
                    Next
                </button>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        posts: Object // Change the prop type to Object
    },
    data() {
        return {
            currentPage: this.posts.current_page || 1,
            postsPerPage: this.posts.per_page || 10
        };
    },
    computed: {
        totalPages() {
            return this.posts.last_page || 1;
        },
        paginatedPosts() {
            return this.posts.data || []; // Use the `data` key for the posts array
        }
    },
    methods: {
        nextPage() {
            if (this.currentPage < this.totalPages) {
                this.currentPage++;
                this.$inertia.visit(`/posts?page=${this.currentPage}`);
            }
        },
        prevPage() {
            if (this.currentPage > 1) {
                this.currentPage--;
                this.$inertia.visit(`/posts?page=${this.currentPage}`);
            }
        },
        createPost() {
            this.$inertia.visit('/posts/create');
        },
        viewPost(id) {
            this.$inertia.visit(`/posts/${id}`);
        },
        editPost(id) {
            this.$inertia.visit(`/posts/${id}/edit`);
        },
        deletePost(id) {
            if (confirm('Are you sure you want to delete this post?')) {
                this.$inertia.delete(`/posts/${id}`);
            }
        },
        formatDate(date) {
            return new Date(date).toLocaleDateString();
        }
    }
};
</script>

<style scoped>
/* Add any component-specific styles here */
</style>
