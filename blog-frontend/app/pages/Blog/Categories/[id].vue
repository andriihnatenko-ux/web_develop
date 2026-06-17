<template>
    <div class="max-w-4xl mx-auto py-10 px-4">
        <UCard class="w-full">
            <template #header>
                <h1 class="text-2xl font-bold">Редагувати категорію</h1>
            </template>

            <UForm :schema="schema" :state="state" class="space-y-6" @submit="onSubmit">
                <UFormField label="Назва категорії" name="title" required>
                    <UInput v-model="state.title" size="lg" placeholder="Введіть назву..." class="w-full" />
                </UFormField>

                <UFormField label="ID Батьківської категорії" name="parent_id">
                    <UInput v-model="state.parent_id" type="number" size="lg" placeholder="Наприклад: 1" class="w-full md:w-1/2" />
                </UFormField>

                <div class="flex justify-end gap-4 pt-4 border-t border-gray-800">
                    <UButton to="/Blog/BlogCategoriesUi" color="gray" variant="ghost" size="lg">Скасувати</UButton>
                    <UButton type="submit" color="primary" size="lg" :loading="pending">Оновити</UButton>
                </div>
            </UForm>
        </UCard>
    </div>
</template>

<script setup lang="ts">
import { z } from 'zod'
import { ref, reactive } from 'vue'
import { useRoute } from 'vue-router'

const route = useRoute()
const categoryId = route.params.id

// Отримуємо базовий URL
const config = useRuntimeConfig()
const apiBase = config.public.apiBase

const schema = z.object({
    title: z.string({ required_error: 'Обов\'язкове поле' }).min(3, 'Мінімум 3 символи'),
    parent_id: z.coerce.number().optional().nullable()
})

const state = reactive({
    title: undefined,
    parent_id: undefined
})

const { data: categoryData } = await useFetch<any>(`${apiBase}/categories/${categoryId}`)

if (categoryData.value?.data) {
    state.title = categoryData.value.data.title
    state.parent_id = categoryData.value.data.parent_id || undefined
}

const pending = ref(false)

const onSubmit = async () => {
    pending.value = true
    try {
        await $fetch(`${apiBase}/categories/${categoryId}`, {
            method: 'PATCH',
            body: {
                title: state.title,
                parent_id: state.parent_id ? Number(state.parent_id) : null
            }
        })
        navigateTo('/Blog/BlogCategoriesUi')
    } catch (error) {
        console.error(error)
    } finally {
        pending.value = false
    }
}
</script>
