<template>
  <div class="container mx-auto p-6 max-w-6xl">
    <h1 class="text-2xl font-bold mb-6 text-gray-800">Список статей (Nuxt UI)</h1>

    <UCard class="w-full overflow-hidden shadow-md">
      <UTable
          :rows="posts"
          :columns="columns"
          :loading="pending"
      >
        <template #title-data="{ row }">
          <a :href="'/admin/blog/posts/' + row.id + '/edit'" class="text-blue-600 hover:underline font-semibold">
            {{ row.title }}
          </a>
        </template>

        <template #published_at-data="{ row }">
                    <span v-if="row.is_published" class="text-green-600 font-medium">
                        {{ row.published_at }}
                    </span>
          <span v-else class="text-gray-400 italic text-xs">Чернетка</span>
        </template>
      </UTable>

      <div class="flex justify-between items-center mt-4 pt-4 border-t border-gray-100">
                <span class="text-sm text-gray-500">
                    Показано сторінку {{ page }} з {{ totalPages }}
                </span>
        <UPagination
            v-model="page"
            :page-count="perPage"
            :total="totalItems"
            :max="5"
        />
      </div>
    </UCard>
  </div>
</template>

<script setup lang="ts">
import { ref, watch } from 'vue'

const page = ref(1)
const posts = ref<any[]>([])
const totalItems = ref(0)
const perPage = ref(25)
const totalPages = ref(1)
const pending = ref(false)

const columns = [
  { key: 'id', label: '#' },
  { key: 'user.name', label: 'Автор' },
  { key: 'category.title', label: 'Категорія' },
  { key: 'title', label: 'Заголовок' },
  { key: 'published_at', label: 'Дата публікації' }
]

const loadPageData = async () => {
  pending.value = true
  try {
    const response = await $fetch<any>(`http://localhost/api/admin/blog/posts?page=${page.value}`)
    posts.value = response.data
    totalItems.value = response.total
    perPage.value = response.per_page
    totalPages.value = response.last_page
  } catch (error) {
    console.error('Не вдалося завантажити дані для Nuxt UI:', error)
  } finally {
    pending.value = false
  }
}

watch(page, () => {
  loadPageData()
})

loadPageData()
</script>