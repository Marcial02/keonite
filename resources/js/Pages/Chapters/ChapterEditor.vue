<script setup>
import { Editor, EditorContent } from '@tiptap/vue-3';
import StarterKit from '@tiptap/starter-kit';
import { watch } from 'vue'

const props = defineProps({
    modelValue: String,
})

const emit = defineEmits(['update:modelValue'])

const editor = useEditor({
    content: props.modelValue,
    extensions: [StarterKit],
    onUpdate: ({ editor }) => {
        // Ipinapasa ang content pabalik sa form
        emit('update:modelValue', editor.getHTML())
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
