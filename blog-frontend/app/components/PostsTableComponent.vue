<template>
    <div class="container mx-auto px-4 py-8">

        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-white">Список постів</h1>
            <a href="/admin/blog/posts/create" class="px-4 py-2 bg-primary-500 hover:bg-primary-600 text-white text-sm font-medium rounded-lg transition-colors">
                + Додати пост
            </a>
        </div>

        <div class="bg-gray-900 border border-gray-800 rounded-xl overflow-hidden shadow-lg">
            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm text-gray-300">

                    <thead class="bg-gray-800/50 text-gray-400 uppercase text-xs border-b border-gray-800">
                    <tr>
                        <th class="px-6 py-4 font-semibold">#</th>
                        <th class="px-6 py-4 font-semibold">Автор</th>
                        <th class="px-6 py-4 font-semibold">Категорія</th>
                        <th class="px-6 py-4 font-semibold">Заголовок</th>
                        <th class="px-6 py-4 font-semibold">Дата публікації</th>
                    </tr>
                    </thead>

                    <tbody class="divide-y divide-gray-800">
                    <tr v-for="post in posts" :key="post.id" class="hover:bg-gray-800 transition-colors">

                        <td class="px-6 py-4 text-gray-500">{{ post.id }}</td>

                        <td class="px-6 py-4 font-medium text-gray-200">
                            {{ post.user?.name  'Невідомий автор' }}
                        </td>

                        <td class="px-6 py-4">
                <span class="px-2.5 py-1 bg-gray-800 text-gray-300 rounded-md text-xs border border-gray-700">
                  {{ post.category?.title  'Без категорії' }}
                </span>
                        </td>

                        <td class="px-6 py-4">
                            <a :href="'/admin/blog/posts/' + post.id + '/edit'" class="text-primary-400 hover:text-primary-300 transition-colors font-medium">
                                {{ post.title }}
                            </a>
                        </td>

                        <td class="px-6 py-4 text-gray-500">
                            {{ post.published_at || 'Не опубліковано' }}
                        </td>

                    </tr>
                    </tbody>

                </table>
            </div>
        </div>

    </div>
</template>

<script setup lang="ts">
import { ref } from 'vue';

const posts = ref([]);

const getPosts = () => {
    $fetch('http://127.0.0.1:8000/api/admin/blog/posts')
        .then(response => {
            posts.value = response.data;
        });
};

getPosts();
</script>
