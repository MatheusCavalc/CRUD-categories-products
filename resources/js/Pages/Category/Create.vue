<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, useForm } from '@inertiajs/inertia-vue3';
import TextInput from '@/Components/TextInput.vue';
import InputLabel from '@/Components/InputLabel.vue';
import InputError from '@/Components/InputError.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';

const form = useForm({
    name: '',
    image: ''
})

const submit = () => {
    form.post(route('categories.store'));
}

</script>

<template>

    <Head title="Create Category" />

    <AuthenticatedLayout>
        <div class="py-6">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">

                        <h1 class="text-3xl">Create New Category</h1>

                        <form @submit.prevent="submit">

                            <div class="mb-3">
                                <InputLabel for="name" value="Name"
                                    class="block mb-2 text-sm font-medium text-gray-900" />
                                <TextInput id="name" type="text"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                    v-model="form.name" required />
                                <InputError class="mt-2" :message="form.errors.name" />
                            </div>

                            <div class="mb-3">
                                <InputLabel for="image" value="Image"
                                    class="block mb-2 text-sm font-medium text-gray-900" />
                                <TextInput id="image" type="file" @input="form.image = $event.target.files[0]"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" />
                                <InputError class="mt-2" :message="form.errors.image" />
                            </div>

                            <PrimaryButton
                                class="text-black bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center"
                                :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                                Submit
                            </PrimaryButton>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
