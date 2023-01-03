<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/inertia-vue3';

const props = defineProps(['product', 'image'])
</script>

<template>
    <Head :title="product.name" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ product.name }}</h2>
        </template>

        <div class="py-3">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="max-w-sm rounded overflow-hidden shadow-lg">
                    <img class="w-full" :src="image" :alt="product.name">
                    <div class="px-6 py-4">
                        <div class="font-bold text-xl mb-2">{{ product.name }}</div>
                        <p class="text-gray-700 text-base">
                            {{ product.category.name }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
