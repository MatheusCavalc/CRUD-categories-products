<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/inertia-vue3';

const props = defineProps(['product', 'image'])
</script>

<template>
    <Head :title="product.name" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">{{ product.name }}</h2>
        </template>

        <div class="py-3">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="w-full overflow-hidden rounded shadow-lg">
                    <div class="flex justify-center p-3">
                        <div class="p-3 bg-white">
                            <img class="w-40 h-40" :src="image" :alt="product.name">
                            <div class="py-4">
                                <div class="mb-2 text-xl font-bold">{{ product.name }}</div>
                                <p class="text-base text-gray-700">
                                    {{ product.category.name }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
