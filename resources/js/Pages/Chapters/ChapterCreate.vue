<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';
import { Editor, EditorContent } from '@tiptap/vue-3';
import StarterKit from '@tiptap/starter-kit';
import { onMounted, onBeforeUnmount } from 'vue';

const props = defineProps({
    novel: Object, // Para alam natin kung saang novel ikakabit ang chapter
});

const form = useForm({
    novel_id: props.novel.id,
    chapter_number: '',
    title: '',
    content: '', // Dito papasok ang HTML mula sa Tiptap
});

let editor;

onMounted(() => {
    editor = new Editor({
        content: '',
        extensions: [StarterKit],
        editorProps: {
            attributes: {
                class: 'prose max-w-none focus:outline-none min-h-[300px] p-4 border rounded-md bg-white',
            },
        },
        onUpdate: ({ editor }) => {
            form.content = editor.getHTML();
        },
    });
});

onBeforeUnmount(() => {
    editor.destroy();
});

const submit = () => {
    form.post(route('chapters.store'));
};
</script>

<template>
    <Head title="Write Chapter" />
    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Writing for: {{ novel.title }}
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-5xl sm:px-6 lg:px-8">
                <form @submit.prevent="submit" class="space-y-6">
                    <div class="flex gap-4">
                        <div class="w-1/4">
                            <label class="block font-medium text-sm text-gray-700">Chapter #</label>
                            <input v-model="form.chapter_number" type="number" class="w-full border-gray-300 rounded-md shadow-sm" required />
                        </div>
                        <div class="w-3/4">
                            <label class="block font-medium text-sm text-gray-700">Chapter Title</label>
                            <input v-model="form.title" type="text" class="w-full border-gray-300 rounded-md shadow-sm" required />
                        </div>
                    </div>

                    <div>
                        <label class="block font-medium text-sm text-gray-700 mb-2">Manuscript</label>
                        <!-- Tiptap Editor Render Here -->
                        <editor-content :editor="editor" />
                    </div>

                    <div class="flex justify-end">
                        <button type="submit" class="bg-indigo-600 text-white px-6 py-2 rounded-md hover:bg-indigo-700" :disabled="form.processing">
                            Save Chapter Draft
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
