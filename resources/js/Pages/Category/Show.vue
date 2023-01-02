<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';

const props = defineProps(['category', 'image'])

</script>

<template>
    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ category.name }}</h2>
        </template>

        <div class="py-3">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="max-w-sm rounded overflow-hidden shadow-lg">
                    <img class="w-full" :src="image" :alt="category.name">
                    <div class="px-6 py-4">
                        <div class="font-bold text-xl mb-2">{{ category.name }}</div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
