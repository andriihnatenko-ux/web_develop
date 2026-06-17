<template>
    <div class="container mx-auto p-4">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold mb-4">Список категорій</h1>
            <UButton to="/Blog/Categories/create" color="primary" size="lg" icon="i-heroicons-plus">Створити категорію</UButton>
        </div>

        <UTable :data="categories" :columns="columns" :loading="pending" />

        <div class="flex justify-end mt-4">
            <UPagination v-model="page" :items-per-page="perPage" :total="total" />
        </div>
    </div>
</template>

<script setup lang="ts">
import { h, resolveComponent, ref, computed } from 'vue'

const UButton = resolveComponent('UButton')
const UDropdownMenu = resolveComponent('UDropdownMenu')

// Отримуємо базовий URL
const config = useRuntimeConfig()
const apiBase = config.public.apiBase

const page = ref(1)

const { data: response, pending, refresh } = await useFetch(`${apiBase}/categories`, {
    query: { page }
})

const categories = computed(() => response.value?.data || [])
const total = computed(() => response.value?.meta?.total || 0)
const perPage = computed(() => response.value?.meta?.per_page || 25)

const columns = [
    { accessorKey: 'id', header: '#' },
    { accessorKey: 'title', header: 'Назва' },
    { accessorKey: 'parent_id', header: 'ID Батька' },
    {
        id: 'actions',
        header: 'Дії',
        cell: ({ row }: { row: any }) => h(
            UDropdownMenu,
            {
                items: [
                    [
                        { label: 'Редагувати', icon: 'i-heroicons-pencil-square', onSelect: () => navigateTo(`/Blog/Categories/${row.original.id}`) },
                        { label: 'Видалити', icon: 'i-heroicons-trash', onSelect: () => deleteCategory(row.original.id), color: 'red' }
                    ]
                ]
            },
            () => h(UButton, { icon: 'i-heroicons-ellipsis-horizontal', color: 'gray', variant: 'ghost' })
        )
    }
]

const deleteCategory = async (id: number) => {
    if (!confirm('Ви впевнені, що хочете видалити категорію?')) return
    try {
        await $fetch(`${apiBase}/categories/${id}`, { method: 'DELETE' })
        refresh()
    } catch (error) {
        console.error(error)
    }
}
</script>
