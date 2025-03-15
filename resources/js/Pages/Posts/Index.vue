<script setup>
import { defineProps } from "vue";
import { Link } from "@inertiajs/vue3";

defineProps({
  posts: Object,
});

function deletePost(id) {
  if (confirm("Are you sure you want to delete this post?")) {
    axios.delete(`/posts/${id}`).then(() => {
      window.location.reload();
    });
  }
}
</script>

<template>
  <div>
    <div class="text-center">
      <Link
        href="/posts/create"
        class="mt-4 px-4 py-2 bg-green-600 text-white font-medium rounded-md hover:bg-green-700"
      >
        Create Post
      </Link>
    </div>

    <div class="mt-6 rounded-lg border border-gray-200">
      <table class="min-w-full divide-y-2 divide-gray-200 bg-white text-sm">
        <thead>
          <tr>
            <th class="px-4 py-2 font-medium text-gray-900">#</th>
            <th class="px-4 py-2 font-medium text-gray-900">Image</th>
            <th class="px-4 py-2 font-medium text-gray-900">Title</th>
            <th class="px-4 py-2 font-medium text-gray-900">Title Slug</th>
            <th class="px-4 py-2 font-medium text-gray-900">Posted By</th>
            <th class="px-4 py-2 font-medium text-gray-900">Created At</th>
            <th class="px-4 py-2 font-medium text-gray-900">Actions</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="post in posts.data" :key="post.id">
            <td class="px-4 py-2">{{ post.id }}</td>
            <td class="px-4 py-2">
              <img
                v-if="post.image"
                :src="post.image"
                alt="Post Image"
                width="150"
                height="150"
              />
              <span v-else class="text-gray-400">No Image</span>
            </td>
            <td class="px-4 py-2">{{ post.title }}</td>
            <td class="px-4 py-2">{{ post.slug }}</td>
            <td class="px-4 py-2">
              {{ post.user ? post.user.name : "User Not Found" }}
            </td>
            <td class="px-4 py-2">
              {{ new Date(post.created_at).toLocaleDateString() }}
            </td>
            <td class="px-4 py-2 space-x-2">
              <Link
                :href="`/posts/${post.id}`"
                class="px-4 py-1 bg-blue-500 text-white rounded"
                >View</Link
              >
              <Link
                :href="`/posts/${post.id}/edit`"
                class="px-4 py-1 bg-yellow-500 text-white rounded"
                >Edit</Link
              >
              <button
                @click="deletePost(post.id)"
                class="px-4 py-1 bg-red-500 text-white rounded"
              >
                Delete
              </button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>

    <!-- Pagination -->
    <div class="mt-4">
      <button
        v-if="posts.prev_page_url"
        @click="$inertia.get(posts.prev_page_url)"
        class="px-4 py-2 bg-gray-500 text-white rounded"
      >
        Previous
      </button>
      <button
        v-if="posts.next_page_url"
        @click="$inertia.get(posts.next_page_url)"
        class="ml-2 px-4 py-2 bg-gray-500 text-white rounded"
      >
        Next
      </button>
    </div>
  </div>
</template>
