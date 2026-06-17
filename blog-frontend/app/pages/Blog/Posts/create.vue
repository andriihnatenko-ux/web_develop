<template>
    <div class="max-w-4xl mx-auto py-10 px-4">
        <UCard class="w-full">
            <template #header>
                <h1 class="text-2xl font-bold">Створити пост</h1>
            </template>

            <UForm :schema="schema" :state="state" class="space-y-6" @submit="onSubmit">
                <UFormField label="Заголовок" name="title">
                    <UInput v-model="state.title" size="lg" placeholder="Введіть заголовок..." class="w-full" />
                </UFormField>

                <UFormField label="ID Категорії" name="category_id">
                    <UInput v-model="state.category_id" type="number" size="lg" placeholder="Наприклад: 1" class="w-full md:w-1/2" />
                </UFormField>

                <UFormField label="Текст поста" name="content_raw">
                    <UTextarea v-model="state.content_raw" size="lg" :rows="12" placeholder="Пишіть текст тут..." class="w-full" autoresize />
                </UFormField>

                <UFormField name="is_published">
                    <UCheckbox v-model="state.is_published" label="Опублікувати пост?" />
                </UFormField>

                <div class="flex justify-end gap-4 pt-4 border-t border-gray-800">
                    <UButton to="/Blog/BlogPosts" color="gray" variant="ghost" size="lg">Скасувати</UButton>
                    <UButton type="submit" color="primary" size="lg" :loading="pending">Зберегти пост</UButton>
                </div>
            </UForm>
        </UCard>
    </div>
</template>

<script setup lang="ts">
import { z } from 'zod'
import { ref, reactive } from 'vue'

const schema = z.object({
    title: z.string({ required_error: 'Обов\'язкове поле' }).min(3, 'Мінімум 3 символи'),
    category_id: z.coerce.number({ invalid_type_error: 'Введіть число', required_error: 'Обов\'язкове поле' }).positive('Має бути більше 0'),
    content_raw: z.string({ required_error: 'Обов\'язкове поле' }).min(10, 'Текст має бути довшим за 10 символів'),
    is_published: z.boolean()
})

const state = reactive({
    title: undefined,
    category_id: undefined,
    content_raw: undefined,
    is_published: false
})

const pending = ref(false)

// Отримуємо базовий URL
const config = useRuntimeConfig()
const apiBase = config.public.apiBase

const onSubmit = async () => {
    pending.value = true
    try {
        await $fetch(`${apiBase}/posts`, {
            method: 'POST',
            body: {
                title: state.title,
                category_id: state.category_id,
                content_raw: state.content_raw,
                is_published: state.is_published
            }
        })
        navigateTo('/Blog/BlogPosts')
    } catch (error) {
        console.error(error)
    } finally {
        pending.value = false
    }
}
</script>
