<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';


const form = useForm({
    title: '',
    description: '',
});

// 2. Ang Submit Command
const submit = () => {
    form.post(route('novels.store'), {
        onSuccess: () => {
            form.reset();
            alert('Story saved to database!');
        },
    });
};
</script>

<template>
    <Head title="Create" />

    <AuthenticatedLayout>
        <template #header>


            <h2
                class="text-xl font-semibold leading-tight text-gray-800"
            >
                Create Story!
            </h2>
        </template>



<div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg p-8">

                    <form @submit.prevent="submit" class="space-y-6">
                        <!-- Title Input -->
                        <div>
                            <label class="block font-medium text-sm text-gray-700">Novel Title</label>
                            <input
                                type="text"
                                v-model="form.title"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                                placeholder="e.g. The Strategic Architect"
                                required
                            />
                        </div>

                        <!-- Description/Synopsis -->
                        <div>
                            <label class="block font-medium text-sm text-gray-700">Synopsis</label>
                            <textarea
                                v-model="form.description"
                                rows="5"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                                placeholder="Describe your military fantasy world..."
                            ></textarea>
                        </div>

                        <!-- Submit Button Command -->
                        <div class="flex items-center justify-end mt-4">
                            <button
                                type="submit"
                                :disabled="form.processing"
                                class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 disabled:opacity-50 transition"
                            >
                                {{ form.processing ? 'Saving...' : 'Create Story' }}
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>



    </AuthenticatedLayout>
</template>
