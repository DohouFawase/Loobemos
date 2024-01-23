<template>
    <DialogModal :show="showModal" @close="$emit('closeLoginForm')" maxWidth="xl">
        <template #title>
            Connexion
        </template>

        <template #content>
            <h3 class="font-bold text-lg mb-3">Bienvenue sur Lobeemo</h3>
            <form @submit.prevent="submit">
                <div class="col-span-6 sm:col-span-4">
                    <TextInput
                        id="email"
                        v-model="form.email"
                        placeholder="Adresse mail :"
                        type="text"
                        class="mt-1 block w-full"
                    />

                    <InputError :message="form.errors.email" class="mt-2" />
                </div>

                <div class="col-span-6 sm:col-span-4 mt-3">
                    <TextInput
                        type="password"
                        id="password"
                        v-model="form.password"
                        placeholder="Mot de passe:"
                        class="mt-1 block w-full"
                    />

                    <InputError :message="form.errors.password" class="mt-2" />
                </div>

                <button :disabled="form.processing" class="mt-8 w-full bg-[#4663ff] border-[#4667ff] text-white py-2 px-4 rounded-lg">
                    <div class="text-lg font-semibold">
                        Continue
                    </div>
                </button>
            </form>

            <div class="inline-flex items-center justify-center w-full">
                <hr class="w-full h-px my-8 bg-gray-200 border-0 dark:bg-gray-700">
                <span
                    class="absolute px-3 font-medium text-gray-900 -translate-x-1/2 bg-white left-1/2 dark:text-white dark:bg-gray-900">o</span>
            </div>


        </template>

    </DialogModal>
</template>

<script setup>
    import { defineProps } from 'vue';
    import DialogModal from '@/Components/DialogModal.vue';
    import TextInput from '@/Components/TextInput.vue';
    import { router, useForm } from '@inertiajs/vue3';
    import InputError from '../InputError.vue';

    import { useNotification } from '@/Stores/notification.js';

    const store = useNotification();

    const emit = defineEmits(['closeLoginForm'])

    const props = defineProps({
        showModal: { default: false, type: Boolean},
        errors: Object
    });

    const form = useForm({email: "", password: ""});

    const submit = () =>
    {
        let url = route('login');

        form.post(url, {
            onSuccess: (res) => {
                router.visit(route('home'))
                emit('closeLoginForm');
                store.addToast({message: 'Heureux de vous revoir'});
            },
            onError : (err) => {
                console.log(err);
                store.addToast({message: 'Veuillez réessayer', type: 'error'});
            }
        });

    };

</script>

