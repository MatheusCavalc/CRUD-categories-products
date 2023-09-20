<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/inertia-vue3';

const props = defineProps(['category', 'image'])
</script>

<template>
    <Head :title="category.name" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">{{ category.name }}</h2>
        </template>

        <div class="py-3">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="w-full overflow-hidden rounded shadow-lg">
                    <div class="flex justify-center p-3">
                        <div class="p-3 bg-white">
                            <img class="w-full" :src="image" :alt="category.name">
                            <div class="py-4">
                                <div class="mb-2 text-xl font-bold">{{ category.name }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
