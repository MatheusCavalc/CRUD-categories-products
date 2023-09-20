<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/inertia-vue3';
import Table from '@/Components/Table.vue';
import THead from '@/Components/THead.vue';
import TData from '@/Components/TData.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import ConfirmModal from '@/Components/ConfirmModal.vue';
import DangerButton from '@/Components/DangerButton.vue';
import { Link } from '@inertiajs/inertia-vue3';
import { ref } from 'vue'

const props = defineProps(['products'])

const dialog = ref('')

const modal = () => {
    dialog.value = false
}

modal()
</script>

<template>
    <Head title="Products" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">Products</h2>
        </template>

        <div class="py-3">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden shadow-sm sm:rounded-lg">

                    <div class="flex justify-end m-2">
                        <Link :href="route('products.create')">
                        <PrimaryButton>
                            New Product
                        </PrimaryButton>
                        </Link>
                    </div>

                    <Table>
                        <template #headColumns>
                            <THead label="Name" />
                            <THead label="Category" />
                            <THead label="Edit" />
                        </template>
                        <template #tableRows>
                            <tr v-for="product in products" :key="product.id" class="bg-white border-b hover:bg-gray-200">
                                <TData type="first">
                                    <Link :href="route('products.show', product.id)" class="hover:underline">
                                    {{ product.name }}
                                    </Link>
                                </TData>

                                <TData type="normal">
                                    <Link :href="route('categories.show', product.category.id)" class="hover:underline">
                                    {{ product.category.name }}
                                    </Link>
                                </TData>

                                <TData type="normal">
                                    <div class="flex gap-2">
                                        <Link :href="route('products.edit', product.id)">
                                        <PrimaryButton>
                                            Edit
                                        </PrimaryButton>
                                        </Link>

                                        <DangerButton @click="dialog = true">
                                            Delete
                                            <ConfirmModal :dialog="dialog" message="Are you sure?" @close-modal="modal"
                                                :url="route('products.destroy', product.id)">
                                            </ConfirmModal>
                                        </DangerButton>
                                    </div>
                                </TData>
                            </tr>
                        </template>
                    </Table>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
