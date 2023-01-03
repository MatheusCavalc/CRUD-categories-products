<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm } from '@inertiajs/inertia-vue3';
import { Inertia } from '@inertiajs/inertia';
import TextInput from '@/Components/TextInput.vue';
import InputLabel from '@/Components/InputLabel.vue';
import InputError from '@/Components/InputError.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';

const props = defineProps(['category', 'image']);

const form = useForm({
    name: props.category.name,
    image: props.category.image
})

const submit = () => {
    Inertia.post(`/categories/${props.category.id}`, {
        _method: 'put',
        name: form.name,
        image: form.image
    })
}

</script>

<template>
    <Head title="Edit Category" />

    <AuthenticatedLayout>
        <div class="py-6">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">

                        <h1 class="text-3xl">Edit Category</h1>

                        <form @submit.prevent="submit">

                                <div class="mb-3">
                                    <InputLabel for="name" value="Name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-black" />
                                    <TextInput id="name" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" v-model="form.name" required />
                                    <InputError class="mt-2" :message="form.errors.name" />
                                </div>

                                <div class="mb-3">
                                    <InputLabel for="image" value="Image" class="block mb-2 text-sm font-medium text-gray-900 dark:text-black" />
                                    <div class="m-2 p-2">
                                        <img :src="image" class="w-32 h-32">
                                    </div>
                                    <TextInput  id="image"
                                                type="file"
                                                @input="form.image = $event.target.files[0]"
                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                                />
                                    <InputError class="mt-2" :message="form.errors.image" />
                                </div>

                                <PrimaryButton class="text-black bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                                    Submit
                                </PrimaryButton>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
