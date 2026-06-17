<template>
    <div class="container mx-auto p-4">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold mb-4">Список постів</h1>
            <UButton to="/Blog/Posts/create" color="primary" size="lg" icon="i-heroicons-plus">Створити пост</UButton>
        </div>

        <UTable :data="posts" :columns="columns" :loading="pending" />

        <div class="flex justify-end mt-4">
            <UPagination v-model="page" :items-per-page="perPage" :total="total" />
        </div>
    </div>
</template>

<script setup lang="ts">
import { h, resolveComponent, ref, computed } from 'vue'

const UButton = resolveComponent('UButton')
const UDropdownMenu = resolveComponent('UDropdownMenu')

// Отримуємо базовий URL з конфігу
const config = useRuntimeConfig()
const apiBase = config.public.apiBase

const page = ref(1)

// Використовуємо apiBase
const { data: response, pending, refresh } = await useFetch(`${apiBase}/posts`, {
    query: { page }
})

const posts = computed(() => response.value?.data || [])
const total = computed(() => response.value?.meta?.total || 0)
const perPage = computed(() => response.value?.meta?.per_page || 25)

const columns = [
    { accessorKey: 'id', header: '#' },
    { accessorKey: 'user.name', header: 'Автор' },
    { accessorKey: 'category', header: 'Категорія', cell: ({ row }: { row: any }) => row.original.category?.title || 'Без категорії' },
    { accessorKey: 'title', header: 'Заголовок' },
    {
        id: 'actions',
        header: 'Дії',
        cell: ({ row }: { row: any }) => h(
            UDropdownMenu,
            {
                items: [
                    [
                        { label: 'Переглянути', icon: 'i-heroicons-eye', onSelect: () => navigateTo(`/Blog/Posts/view/${row.original.id}`) },
                        { label: 'Редагувати', icon: 'i-heroicons-pencil-square', onSelect: () => navigateTo(`/Blog/Posts/${row.original.id}`) },
                        { label: 'Видалити', icon: 'i-heroicons-trash', onSelect: () => deletePost(row.original.id), color: 'red' }
                    ]
                ]
            },
            () => h(UButton, { icon: 'i-heroicons-ellipsis-horizontal', color: 'gray', variant: 'ghost' })
        )
    }
]

const deletePost = async (id: number) => {
    if (!confirm('Видалити?')) return
    try {
        // Використовуємо apiBase
        await $fetch(`${apiBase}/posts/${id}`, { method: 'DELETE' })
        refresh()
    } catch (error) {
        console.error(error)
    }
}
</script>
