<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/inertia-vue3';
import Table from '@/Components/Table.vue';
import THead from '@/Components/THead.vue';
import TData from '@/Components/TData.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import DangerButton from '@/Components/DangerButton.vue';
import ConfirmModal from '@/Components/ConfirmModal.vue';
import { Link } from '@inertiajs/inertia-vue3';
import { ref } from 'vue'

const props = defineProps(['categories'])

const dialog = ref('')

const modal = () => {
    dialog.value = false
}

modal()
</script>

<template>

    <Head title="Categories" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Categories</h2>
        </template>

        <div class="py-3">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="overflow-hidden shadow-sm sm:rounded-lg">

                    <div class="mb-2 flex justify-end">
                        <Link :href="route('categories.create')">
                            <PrimaryButton>
                                New Category
                            </PrimaryButton>
                        </Link>
                    </div>

                    <Table>
                        <template #headColumns>
                            <THead label="Name" />
                            <THead label="Edit" />
                        </template>
                        <template #tableRows>
                            <tr v-for="category in categories" :key="category.id"
                                class="bg-white border-b hover:bg-gray-200">
                                <TData type="first">
                                    <Link :href="route('categories.show', category.id)" class="hover:underline">
                                        {{ category.name }}
                                    </Link>
                                </TData>

                                <TData type="normal">
                                    <Link :href="route('categories.edit', category.id)">
                                    <PrimaryButton>
                                        Edit
                                    </PrimaryButton>
                                    </Link>

                                    <DangerButton @click="dialog = true">
                                        Delete
                                    <ConfirmModal :dialog="dialog" message="Are you sure?" :url="route('categories.destroy', category.id)">
                                    </ConfirmModal>
                                    </DangerButton>
                                </TData>
                            </tr>
                        </template>
                    </Table>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
