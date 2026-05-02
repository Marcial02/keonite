<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/vue3';

defineProps({
    novel: Object,
});
</script>

<template>
    <Head :title="novel.title + ' - Manuscript'" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex justify-between items-center">
                <h2 class="text-xl font-semibold leading-tight text-gray-800">
                    {{ novel.title }}
                </h2>
                <Link :href="route('dashboard')" class="text-sm text-gray-600 hover:underline">
                    Back to Dashboard
                </Link>
            </div>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-4xl sm:px-6 lg:px-8">
                <div class="bg-white p-10 shadow-sm sm:rounded-lg prose max-w-none">
                    <!-- Book Header -->
                    <div class="text-center mb-20">
                        <h1 class="text-4xl font-bold mb-4">{{ novel.title }}</h1>
                        <p class="text-gray-500 italic">{{ novel.description }}</p>
                        <div class="border-b-2 w-24 mx-auto mt-8"></div>
                    </div>

                    <!-- Chapters Loop -->
                    <div v-for="(chapter, index) in novel.chapters" :key="chapter.id" class="mb-16">
                        <h2 class="text-2xl font-semibold mb-6">
                            Chapter {{ index + 1 }}: {{ chapter.title }}
                        </h2>
                        <!-- v-html gamit natin kasi HTML string ang sinesave ng Tiptap -->
                        <div v-html="chapter.content" class="chapter-content text-lg leading-relaxed"></div>
                        <div class="mt-10 border-b border-gray-100"></div>
                    </div>

                    <div v-if="novel.chapters.length === 0" class="text-center text-gray-400 italic">
                        This novel has no chapters yet.
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<style scoped>
/* Para magmukhang libro ang spacing ng paragraphs mula sa Tiptap */
.chapter-content :deep(p) {
    margin-bottom: 1.5rem;
}
</style>
