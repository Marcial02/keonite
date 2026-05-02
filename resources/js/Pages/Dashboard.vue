<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/vue3';

defineProps({
    novels: {
        type: Array,
        default: () => []
    },
});
</script>
<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Dashboard
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg p-6">

                    <div class="p-6 text-gray-900 border-b mb-6">
                        You're logged in! Ready for your writing journey?
                    </div>

                    <!-- Isang v-for lang dapat, teh! -->
                    <div v-if="novels.length > 0" class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div v-for="novel in novels" :key="novel.id" class="p-4 border rounded-lg bg-gray-50 flex flex-col justify-between">
                            <div>
                                <h3 class="text-lg font-bold text-indigo-700">{{ novel.title }}</h3>
                                <p class="text-gray-600 text-sm mt-2 line-clamp-2">{{ novel.description }}</p>
                                <p class="text-xs text-gray-400 mt-2">Created: {{ new Date(novel.created_at).toLocaleDateString() }}</p>
                            </div>

                            <div class="mt-4 flex gap-2">
                                <!-- Button para sa bagong chapter -->
                                <Link
    :href="route('chapters.create', { novel: novel.id })"
    class="relative z-10 text-xs bg-green-600 text-white px-3 py-2 rounded hover:bg-green-700 transition cursor-pointer"
>
    + Add Chapter
</Link>

                                <Link class="text-xs text-indigo-500 font-semibold border border-indigo-500 px-3 py-2 rounded hover:bg-indigo-50"
                                :href="route('novels.manuscript', { novel: novel.id })">
                                    View Manuscript
                                </Link>
                            </div>
                        </div>
                    </div>

                    <!-- Message kapag empty -->
                    <div v-else class="text-center py-10 text-gray-500 italic">
                        No stories found. Start building your world!
                    </div>

                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
