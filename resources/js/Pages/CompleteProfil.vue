<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/vue3";
import { computed, reactive, ref } from "vue";
import { router, useForm } from "@inertiajs/vue3";
import { useNotification } from "@/Stores/notification.js";
import InputError from "@/Components/InputError.vue";

const store = useNotification();

const processingForm = ref(false);

const selectedImages = ref([]);

const form = useForm({
    naissance: "",
    contact: "",
    profession: "",
    photo: "",
    carte: "",
});

const handleFileChange = (e) => {
    form.photo = e.target.files;
};

const handleFileChange2 = (t) => {
    form.carte = t.target.files;
};

const submit = () => {
    console.log(form);

    form.post(route("validation.store"), {
        preserveScroll: true,
        onSuccess: (res) => {
            store.addToast({
                message: "Votre profil à été soumis avec succes",
            });
        },
        // Supprimer le code de gestion des erreurs
    });
};
</script>

<template>
    <Head title="Authentification de mon compte" />

    <AuthenticatedLayout>
        <template #header>
            <h2
                class="font-semibold text-xl text-gray-800 leading-tight"
            >
                Validation de mon compte
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 p-4 lg:px-8">
                <div
                    class="bg-white  overflow-hidden shadow-md sm:rounded-lg"
                >
                    <div class="p-6 text-gray-900 ">
                        <div class="w-full max-w">
                            <form
                                enctype="multipart/form-data"
                                class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4"
                                @submit.prevent="submit"
                                
                            >
                                <div class="mb-4">
                                    <label
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                        for="naissance"
                                    >
                                        Date de naissance
                                    </label>
                                    <input
                                        class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light"
                                        id="naissance"
                                        v-model="form.naissance"
                                        type="date"
                                        placeholder="Date de naissance"
                                    />
                                    <InputError
                                        class="mt-2"
                                        :message="form.errors.naissance"
                                    />
                                </div>

                                <div class="mb-4">
                                    <label
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                        for="contact"
                                    >
                                        Contact
                                    </label>
                                    <input
                                        class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light"
                                        id="contact"
                                        v-model="form.contact"
                                        type="tel"
                                        placeholder="Votre contact"
                                    />
                                    <InputError
                                        class="mt-2"
                                        :message="form.errors.contact"
                                    />
                                </div>
                                <div class="mb-4">
                                    <label
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                        for="profession"
                                    >
                                        Profession
                                    </label>
                                    <input
                                        class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light"
                                        id="profession"
                                        v-model="form.profession"
                                        type="text"
                                        placeholder="Votre profession"
                                    />
                                    <InputError
                                        class="mt-2"
                                        :message="form.errors.profession"
                                    />
                                </div>
                                <div class="mb-6">
                                    <label
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                        for="photo"
                                    >
                                        Photo
                                    </label>
                                    <input
                                        class="shadow appearance-none border w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline"
                                        id="photo"
                                        type="file"
                                        @change="handleFileChange"
                                        accept="image/jpeg, image/png, image/jpg, image/gif"
                                    />
                                    <InputError
                                        class="mt-2"
                                        :message="form.errors.photo"
                                    />
                                </div>
                                <div class="mb-6">
                                    <label
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                        for="carte"
                                    >
                                        Carte d'identité / CIP
                                    </label>
                                    <input
                                        class="shadow appearance-none border w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline"
                                        id="carte"
                                        type="file"
                                        @change="handleFileChange2"
                                        accept="pdf,docx"
                                    />
                                    <InputError
                                        class="mt-2"
                                        :message="form.errors.carte"
                                    />
                                </div>
                                <div class="flex items-center justify-between">
                                    <button
                                        type="submit"
                                        class="inline-flex items-center px-4 py-2 bg-blue-800 dark:bg-[#4663ff]-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150"
                                        :disabled="processingForm"
                                    >
                                        Soummettre
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
