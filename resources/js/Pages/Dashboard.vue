<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head,Link } from '@inertiajs/vue3';
defineProps({
  reservations: Object,
});
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800  leading-tight">Tableau de bord</h2>
            <div class="py-6">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white  overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <h4 class="text-sm text-black-800">Listes des reservations</h4>
                    </div>
                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                        
                        <table class="w-full text-sm text-left text-gray-500 ">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 ">
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
                                  
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="reservation in reservations" :key="reservation.id" class="bg-white border-b dark:bg-gray-800 dark:border-gray-700" >
                                     <td class="px-8 py-4">
                                        {{ reservation.id }}
                                    </td>
                                   
                                    <th scope="row" class="px-8 py-4 font-medium text-gray-900 whitespace-nowrap">
                                        {{ reservation.date }}
                                        
                                    </th>
                                    <td class="px-8 py-4 font-medium text-gray-900 whitespace-nowrap">
                                        {{ reservation.heure }}
                                        
                                    </td>
                                    <td class="px-8 py-4 font-medium text-gray-900 whitespace-nowrap">
                                        {{ reservation.tel }}
                                      
                                    </td>
                                    
                                
                                </tr>
                                
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100" v-if="$page.props.auth.user.statut == 0">
                        <center>
                            <img src="assets/images/validation.jpg" style="width:150px;" alt="">
                            <br><br>
                            <Link :href="route('validation.store')">
                                <button class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-[#4663ff]-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                                    Vous devez compléter votre profil !
                                </button> 
                            </Link>
                            
                           
                        </center>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
