<script setup>
import { Link } from '@inertiajs/inertia-vue3';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { Dialog, DialogPanel, DialogTitle, TransitionChild, TransitionRoot } from '@headlessui/vue'
import { TrashIcon } from '@heroicons/vue/24/outline'

const emit = defineEmits(['closeModal'])

const props = defineProps({
    dialog: {
        default: false
    },
    message: {
        type: String
    },
    url: {
        type: String
    }
})

const submit = () => {
    props.dialog = false
}

const deleteItem = () => {
    props.dialog = false
    emit('closeModal')
}
</script>

<template>
    <TransitionRoot as="template" :show="dialog">
        <Dialog as="div" class="relative z-10" @close="open = false">
            <TransitionChild as="template" enter="ease-out duration-300" enter-from="opacity-0" enter-to="opacity-100"
                leave="ease-in duration-200" leave-from="opacity-100" leave-to="opacity-0">
                <div class="fixed inset-0 transition-opacity bg-gray-500 bg-opacity-75" />
            </TransitionChild>

            <div class="fixed inset-0 z-10 overflow-y-auto">
                <div class="flex items-end justify-center min-h-full p-4 text-center sm:items-center sm:p-0">
                    <TransitionChild as="template" enter="ease-out duration-300"
                        enter-from="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                        enter-to="opacity-100 translate-y-0 sm:scale-100" leave="ease-in duration-200"
                        leave-from="opacity-100 translate-y-0 sm:scale-100"
                        leave-to="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">
                        <DialogPanel
                            class="relative px-4 pt-5 pb-4 overflow-hidden text-left transition-all transform bg-white rounded-lg shadow-xl sm:my-8 sm:w-full sm:max-w-sm sm:p-6">
                            <div>
                                <div
                                    class="flex items-center justify-center w-12 h-12 mx-auto bg-green-100 rounded-full">
                                    <TrashIcon class="w-6 h-6 text-red-600" aria-hidden="true" />
                                </div>
                                <div class="mt-3 text-center sm:mt-5">
                                    <DialogTitle as="h3" class="text-lg font-medium leading-6 text-gray-900">
                                        {{ message }}
                                    </DialogTitle>
                                </div>
                            </div>
                            <div class="flex justify-center gap-2 mt-5 sm:mt-6">
                                    <Link @click="submit">
                                    <PrimaryButton @click="dialog = false">
                                        Back
                                    </PrimaryButton>
                                    </Link>

                                    <Link :href="url" method="delete" as="button" @click="deleteItem">
                                    <PrimaryButton>
                                        Yes
                                    </PrimaryButton>
                                    </Link>
                            </div>
                        </DialogPanel>
                    </TransitionChild>
                </div>
            </div>
        </Dialog>
    </TransitionRoot>
</template>
