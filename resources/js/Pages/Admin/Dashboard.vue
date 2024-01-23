<script setup>
import AdminAuthenticatedLayout from '@/Layouts/AdminAuthenticatedLayout.vue';
import { Head,Link } from '@inertiajs/vue3';

defineProps({
  locations: Object,
  reservations: Object,
  locationsTotal: Number,
  reservationTotal: Number,                           
});
</script>

<template>
    <Head title="Admin Tableau de bord"/>

    <AdminAuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Tableau de bord Administrateur</h2>
        </template>
        

        <div class="py-6">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <h4 class="text-sm text-black-800">Statistique</h4>
                    </div>
                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                        <div class="flex px-6 py-3 ">
                            <div class=" text-center p-2 w-64  shadow-sm rounded-sm h-64 text-gray-900 ">
                                <p class="text-bold text-base text-indigo-800">Total de Locations</p>

                                <p></p>
                            </div>

                            <div class=" text-center p-2 w-64  shadow-sm rounded-sm h-64 text-gray-900 ">
                                <p class="text-bold text-base text-indigo-800">Total de Reservations</p>

                                <p>{{ $reservationTotal }}</p>
                            </div>
                        </div>
                      
                    </div>

                </div>
            </div>
        </div>

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
                                        #ID
                                    </th>
                                    <th scope="col" class="px-8 py-3">
                                    Date
                                    </th>

                                    <th scope="col" class="px-8 py-3">
                                    Heurs
                                    </th>

                                    <th scope="col" class="px-8 py-3">
                                    Numéro
                                    </th>
                                    
                                    <th scope="col" class="px-8 py-3">
                                        Modifier/Suppression
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="reservation in reservations" :key="reservation.id" class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                     <td class="px-8 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-black">
                                        {{ reservation.id }}
                                    </td>
                                   
                                    <th scope="row" class="px-8 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-black">
                                        {{ reservation.date  }}
                                        
                                    </th>

                                  
                                    <td class="px-8 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-black">
                                        {{ reservation.heure }}
                                        
                                    </td>
                                    <td class="px-8 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-black">
                                        {{ reservation.tel }}
                                      
                                    </td>
                                    
                                    <td class="px-8 py-4  font-medium text-gray-900 whitespace-nowrap dark:text-black">
                                       
                                        <a href="" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Delete</a>
                                    </td>
                                </tr>
                                
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>


        <div class="py-6">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <div class="p-5 text-lg font-semibold text-left text-gray-900 bg-white dark:text-white dark:bg-gray-800">
                            Les locations
                            <p class="mt-1 text-sm font-normal italic text-gray-500 dark:text-gray-400">Ici vous avez la liste de toutes les locations en ligne</p>
                        </div>
                        <br>
                        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                        
                            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                    <tr>
                                        <th scope="col" class="px-8 py-3">
                                            #ID
                                        </th>
                                        <th scope="col" class="px-8 py-3">
                                            Photo
                                        </th>
                                        <th scope="col" class="px-8 py-3">
                                           Type 
                                        </th>
                                        <th scope="col" class="px-8 py-3">
                                            Pieces
                                        </th>
                                        <th scope="col" class="px-8 py-3">
                                            Loyer
                                        </th>
                                        <th scope="col" class="px-8 py-3">
                                            Localisation
                                        </th>
                                        
                                        <th scope="col" class="px-8 py-3">
                                            Par
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
                                    <tr v-for="location in locations" :key="location.id" class="bg-white font-medium text-gray-900 whitespace-nowrap dark:text-black border-b dark:bg-gray-800 dark:border-gray-700">
                                         <td class="px-8 py-4">
                                            {{ location.locations_id }}
                                        </td>
                                        <td class="px-8 py-4">
                                            <Link :href="`/locations_images/${location.images[0].images}`">
                                                <img class="w-10 h-10 rounded-sm" :src="`/locations_images/${location.images[0].images}`" :alt="location.type">
                                            </Link>
                                        </td>
                                        <th scope="row" class="px-8 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            
                                        </th>
                                        <td class="px-8 py-4">
                                            {{ location.pieces }}
                                        </td>
                                        <td class="px-8 py-4">
                                            XOF {{ location.loyer }}
                                        </td>
                                         <td class="px-8 py-4">
                                            {{ location.pays+' , '+location.ville+' , '+location.zone }}
                                        </td>
                                        <td class="px-8 py-4">
                                            {{ location.auteur_name }}
                                        </td>

                                        <td class="px-8 py-4">
                                        </td>
                                        <td class="px-8 py-4 text-right">
                                            <Link :href="route('locations.edit',location.locations_id)" class="inline-flex items-center px-4 py-2 bg-blue-700 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-blue-700 dark:hover:bg-blue-900 focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                                            <i></i> Modifier
                                            </Link>
                                            <a href="" class="font-medium text-blue-600 dark:text-blue-500 hover:underline"></a>
                                        </td>
                                    </tr>
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AdminAuthenticatedLayout>
</template>
