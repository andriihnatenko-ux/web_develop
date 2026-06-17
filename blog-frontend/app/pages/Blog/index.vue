<template>
    <div class="min-h-screen flex items-center justify-center bg-gray-50 p-4">
        <UCard class="max-w-lg w-full text-center shadow-xl">
            <template #header>
                <UIcon name="i-heroicons-home-modern" class="w-16 h-16 text-blue-500 mx-auto mb-2" />
                <h1 class="text-3xl font-extrabold text-gray-800">Головна сторінка</h1>
            </template>

            <p class="text-gray-600 text-lg mb-6">
                Вітаю! Це фронтенд частина мого проєкту на Nuxt.js.
                Тут реалізовано підключення до Laravel API, вивід таблиці статей та перегляд окремого поста.
            </p>

            <template #footer>
                <UButton
                    to="/BlogPostsUi"
                    color="blue"
                    size="xl"
                    icon="i-heroicons-list-bullet"
                    class="w-full justify-center font-bold"
                >
                    Перейти до списку статей
                </UButton>
            </template>
        </UCard>
    </div>
</template>

<script setup lang="ts">
// Тут нам навіть логіка не потрібна, Nuxt сам усе відмалює
</script>
