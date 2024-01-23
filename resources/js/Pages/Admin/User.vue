<script setup>
import AdminAuthenticatedLayout from "@/Layouts/AdminAuthenticatedLayout.vue";
import { Head } from "@inertiajs/vue3";
import { computed, reactive, ref } from "vue";
import { router, useForm } from "@inertiajs/vue3";
import { useNotification } from '@/Stores/notification.js';

const store = useNotification();

defineProps({
    users: Object,
});
</script>

<template>
    <AdminAuthenticatedLayout>
        <Head title="Utisateur" />
        <template #header>
            <h2
        class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight"
      >
        Liste des Utilisateur
      </h2>
        </template>

        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                        
                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-8 py-3">
                                        #ID
                                    </th>
                                    <th scope="col" class="px-8 py-3">
                                        name
                                    </th>
                                    <th scope="col" class="px-8 py-3">
                                       mail 
                                    </th>
                                    <th scope="col" class="px-8 py-3">
                                        date de naisances
                                    </th>
                                    <th scope="col" class="px-8 py-3">
                                        contact
                                    </th>
                                    <th scope="col" class="px-8 py-3">
                                        photo
                                    </th>
                                    
                                    <th scope="col" class="px-8 py-3">
                                        cart
                                    </th>
                                    <th scope="col" class="px-8 py-3">
                                        Activer - Desactiver
                                    </th>
                                    <th scope="col" class="px-8 py-3">
                                        Modifier/Suppression
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="user in users" :key="user.id" class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                     <td class="px-8 py-4">
                                        {{ user.id_users }}
                                      
                                    </td>
                                    <td class="px-8 py-4">
                                        {{ user.name }}
                                      
                                    </td>
                                    <th scope="row" class="px-8 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{ user.email }}
                                        
                                    </th>
                                    <td class="px-8 py-4">
                                        {{ user.naissance }}
                                        
                                    </td>
                                    <td class="px-8 py-4">
                                        {{ user.contact }}
                                    </td>
                                     <td class="px-8 py-4">
                                        {{ user.profession }}

                                    </td>
                                

                                    <td class="px-8 py-4">
                                        
                                    </td>
                                    <td class="px-8 py-4 text-right">
                                        
                                    </td>
                                    <td class="px-8 py-4 text-right">
                                        
                                    </td>
                                </tr>
                                
                            </tbody>
                        </table>
                    </div>


    </AdminAuthenticatedLayout>
</template>