<script setup>
import AdminAuthenticatedLayout from "@/Layouts/AdminAuthenticatedLayout.vue";
import { Head } from "@inertiajs/vue3";
import { computed, reactive, ref } from "vue";
import { router, useForm } from "@inertiajs/vue3";
import { useNotification } from "@/Stores/notification.js";

const store = useNotification();
defineProps({
  reservations: Object,
});
</script>

<template>
    <AdminAuthenticatedLayout>
        <Head title="List Reservations" />
        <template #header>
            <h2
                class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight"
            >
                Liste des Reservation
            </h2>
        </template>
        <div class="py-6">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <h4 class="text-sm text-black-800">Listes des reservations</h4>
                    </div>
                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                        
                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-8 py-3">
                                       ID
                                    </th>
                                    
                                 <th scope="col" class="px-8 py-3">
                                        Date
                                    </th>
                                 

                                    <th scope="col" class="px-8 py-3">
                                        Heurs
                                        
                                    </th>

                                    <th scope="col" class="px-8 py-3">
                                        tel
                                    </th>
                                  
                                    <th scope="col" class="px-8 py-3">
                                        Action
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="reservation in reservations" :key="reservation.id" class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                    <td class="px-8 py-4">
                                        {{ reservation.id }}
                                    </td>
                                   
                                    <th scope="row" class="px-8 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-black">
                                        {{ reservation.date }}
                                        
                                    </th>
                                    <td class="px-8 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-black">
                                        {{ reservation.heure }}
                                        
                                    </td>
                                    <td class="px-8 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-black">
                                        {{ reservation.tel }}
                                      
                                    </td>
                                
                                </tr>
                                
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
        
    </AdminAuthenticatedLayout>
</template>
