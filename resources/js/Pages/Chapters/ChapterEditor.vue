<script setup>
import { useEditor, EditorContent } from '@tiptap/vue-3';
import StarterKit from '@tiptap/starter-kit';
import { watch } from 'vue'
import axios from 'axios';
import { debounce } from 'lodash'; // Install mo muna: npm install lodash

const props = defineProps({
    modelValue: String,
    chapterId: [Number, String], // Kailangan natin 'to para malaman kung anong chapter ang i-auautosave
})

const emit = defineEmits(['update:modelValue'])

// 1. Ang Auto-save function
const handleAutosave = debounce((content) => {
    if (!props.chapterId) return; // Wag mag-save kung wala pang ID

    axios.post(`/api/chapters/${props.chapterId}/autosave`, {
        content: content
    })
    .then(() => console.log('Draft saved!'))
    .catch(err => console.error('Autosave failed:', err));
}, 3000); // Mag-aantay ng 3 seconds bago mag-save

const editor = useEditor({
    content: props.modelValue,
    extensions: [StarterKit],
    onUpdate: ({ editor }) => {
       const html = editor.getHTML()

        // 1. Oks na 'to para sa main form (Inertia)
        emit('update:modelValue', html)

        // 2. DAGDAG MO 'TO: Para tumawag sa API auto-save
        handleAutosave(html)
    },
})

// Update editor content kung nagbago ang prop sa labas
watch(() => props.modelValue, (value) => {
    const isSame = editor.value.getHTML() === value
    if (!isSame) {
        editor.value.commands.setContent(value, false)
    }
})
</script>

<template>
    <div class="border rounded-md p-4 bg-white min-h-[300px]">
        <!-- Toolbar (Optional: Pwede mong dagdagan ng bold/italic buttons dito) -->
        <div v-if="editor" class="mb-4 border-b pb-2 flex gap-2">
            <button @click="editor.chain().focus().toggleBold().run()" :class="{ 'bg-gray-200': editor.isActive('bold') }" class="p-1 px-2 rounded">B</button>
            <button @click="editor.chain().focus().toggleItalic().run()" :class="{ 'bg-gray-200': editor.isActive('italic') }" class="p-1 px-2 rounded">I</button>
        </div>

        <editor-content :editor="editor" class="prose max-w-none focus:outline-none" />
    </div>
</template>

<style>
.tiptap p.is-editor-empty:first-child::before {
  content: attr(data-placeholder);
  float: left;
  color: #adb5bd;
  pointer-events: none;
  height: 0;
}
</style>
