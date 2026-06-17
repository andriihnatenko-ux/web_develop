<template>
  <div class="container mx-auto p-4">
    <div class="flex justify-center">
      <div class="w-full">
        <nav class="navbar bg-gray-100 p-3 rounded mb-4 flex justify-between items-center">
          <span class="font-bold text-gray-700">Керування статтями</span>
          <a href="/admin/blog/posts/create" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded text-sm transition">Додати</a>
        </nav>
        <div class="card bg-white shadow rounded-lg overflow-hidden">
          <div class="card-body p-4">
            <table class="table-auto w-full text-left border-collapse">
              <thead>
              <tr class="bg-gray-50 border-b border-gray-200 text-gray-600 text-sm uppercase font-semibold">
                <th class="p-3">#</th>
                <th class="p-3">Автор</th>
                <th class="p-3">Категорія</th>
                <th class="p-3">Заголовок</th>
                <th class="p-3">Дата публікації</th>
              </tr>
              </thead>
              <tbody class="text-gray-700 text-sm">
              <tr v-for="post in posts" :key="post.id" class="border-b border-gray-100 hover:bg-gray-50 transition">
                <td class="p-3 font-medium">{{ post.id }}</td>
                <td class="p-3">{{ post.user?.name || 'Невідомий' }}</td>
                <td class="p-3">{{ post.category?.title || 'Без категорії' }}</td>
                <td class="p-3">
                  <a :href="'/admin/blog/posts/' + post.id + '/edit'" class="text-blue-600 hover:underline font-medium">
                    {{ post.title }}
                  </a>
                </td>
                <td class="p-3">
                                        <span v-if="post.is_published" class="text-green-600 bg-green-50 px-2 py-1 rounded text-xs">
                                            {{ post.published_at }}
                                        </span>
                  <span v-else class="text-gray-400 italic text-xs">Чернетка</span>
                </td>
              </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup lang="ts">
import { ref } from 'vue'

const posts = ref<any[]>([])

const getPosts = async () => {
  try {
    // Звертаємося до твого Laravel API
    const response = await $fetch<any>('http://localhost/api/admin/blog/posts')
    posts.value = response.data
  } catch (error) {
    console.error('Помилка завантаження постів:', error)
  }
}

getPosts()
</script>