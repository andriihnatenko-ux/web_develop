<template>
    <div class="container mx-auto px-4 py-8 max-w-3xl">
        <div class="mb-6">
            <NuxtLink to="/Blog/BlogPosts" class="text-sm text-primary-400 hover:text-primary-300 flex items-center gap-2 transition-colors">
                ← Назад до списку
            </NuxtLink>
        </div>

        <div v-if="status === 'pending'" class="text-center py-12 text-gray-400">
            Завантаження поста...
        </div>

        <article v-else-if="post" class="bg-gray-900 border border-gray-800 rounded-xl p-6 shadow-lg">
            <div class="flex flex-wrap gap-4 items-center text-xs text-gray-400 mb-4 border-b border-gray-800 pb-4">
        <span class="px-2.5 py-1 bg-gray-800 text-gray-300 rounded-md border border-gray-700">
          {{ post.category?.title || 'Без категорії' }}
        </span>
                <span>•</span>
                <span>Автор: <strong class="text-gray-200">{{ post.user?.name || 'Невідомий' }}</strong></span>
                <span>•</span>
                <span>Опубліковано: {{ post.published_at || 'Чернетка' }}</span>
            </div>

            <h1 class="text-3xl font-extrabold text-white mb-6 leading-tight">
                {{ post.title }}
            </h1>

            <div class="text-gray-300 space-y-4 leading-relaxed whitespace-pre-line">
                {{ post.content_raw || post.content_html || post.content || 'Текст статті порожній або відсутній у базі даних.' }}
            </div>
        </article>

        <div v-else class="text-center py-12 text-red-400 bg-red-950/20 border border-red-900 rounded-xl">
            Пост не знайдено або стався збій сервера.
        </div>
    </div>
</template>

<script setup lang="ts">
import { useRoute } from 'vue-router';
import { computed } from 'vue';

const route = useRoute();
const postId = route.params.id;

// Отримуємо базовий URL
const config = useRuntimeConfig()
const apiBase = config.public.apiBase

const { data: response, status } = await useFetch<any>(`${apiBase}/posts/${postId}`);

const post = computed(() => response.value?.data || null);
</script>
