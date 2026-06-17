export default defineNuxtConfig({
    modules: ['@nuxt/ui'],

    // Додаємо глобальну змінну для API
    runtimeConfig: {
        public: {
            apiBase: 'http://localhost/api/admin/blog' // Твій бекенд працює без порту 8000
        }
    },

    compatibilityDate: '2025-01-01',
})
