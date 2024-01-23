<script setup>
import Layout from '@/Layouts/Layout.vue';
import { router,Link } from '@inertiajs/vue3';
import NoResults from '@/Components/listing/NoResults.vue';

defineProps({
 locations: Object,
 filters: Object
});

const querySearch = (params) => router.get(route('home'), { search: params }, { preserveScroll: true })


</script>

<template>
  <Layout title="Les locations">
  </Layout>
        <div class="px-6 mb-6  flex  items-center justify-between overflow-x-auto filter-tag ">
            <Link :href="route('home')">
                <button
                    class=" rounded mr-2 botn transition inline-flex items-center  px-4 py-2 bg-blue-600 shadow-sm text-white text-xs font-weight-bold  " >
                    <i class="fa fa-city mr-1 "></i>
                    Tout
                </button>
            </Link>
        
        <button 
            :class="filters.search == 'Appartements' ? 'border-b-blue-600 text-neutral-800 cursor-not-allowed' : 'border-transparent text-neutral-500'"
            class="  rounded mr-2 transition inline-flex items-center  px-4 py-2 bg-blue-600 shadow-sm text-white text-xs font-weight-bold botn "  @click="querySearch('Appartements')">
            <i class="fa fa-city mr-1 "></i>
            Appartements
        </button>
        <button :class="filters.search == 'Chambres salons' ? 'border-b-blue-600 text-neutral-800 cursor-not-allowed' : 'border-transparent text-neutral-500'"
            class="  rounded mr-2 transition inline-flex items-center  px-4 py-2 bg-blue-600 shadow-sm text-white text-xs font-weight-bold botn  "  @click="querySearch('Chambres salons')">
            <i class="fa fa-couch mr-1"></i>
           Chambres 
        </button>
        <button :class="filters.search == ' Maisons personnelles' ? 'border-b-blue-600 text-neutral-800 cursor-not-allowed' : 'border-transparent text-neutral-500'"
            class="  rounded mr-2 transition inline-flex items-center px-4 py-2 bg-blue-600 shadow-sm text-white text-xs font-weight-bold botn "  @click="querySearch(' Maisons personnelles')">
            <i class="fa fa-home mr-1"></i>
            Maisons 
        </button>
        <button :class="filters.search == 'Entrés couchés ' ? 'border-b-blue-600 text-neutral-800 cursor-not-allowed' : 'border-transparent text-neutral-500'"
            class="  rounded mr-2 transition inline-flex items-center px-4 py-2 bg-blue-600 shadow-sm text-white text-xs font-weight-bold botn "  @click="querySearch('Entrés couchés ')">
            <i class="fa fa-bed mr-1"></i>
            Entrés        </button>
        <button :class="filters.search == 'Entrés personnelles' ? 'border-b-blue-600 text-neutral-800 cursor-not-allowed' : 'border-transparent text-neutral-500'"
            class="  rounded mr-2 transition inline-flex items-center px-4 py-2 bg-blue-600 shadow-sm text-white text-xs font-weight-bold botn "  @click="querySearch('Entrés personnelles')">
            <i class="fa fa-door-closed mr-1"></i>
            Entrés
        </button>
        <button :class="filters.search == 'Locaux commerciaux' ? 'border-b-blue-600 text-neutral-800 cursor-not-allowed' : 'border-transparent text-neutral-500'"
            class="  rounded mr-2 transition inline-flex items-center px-4 py-2 bg-blue-600 shadow-sm text-white text-xs font-weight-bold botn "  @click="querySearch('Locaux commerciaux')">
            <i class="fa fa-building mr-1"></i>
            Locaux 
        </button>

         <button :class="filters.search == 'Boutiques' ? 'border-b-blue-600 text-neutral-800 cursor-not-allowed' : 'border-transparent text-neutral-500'"
            class="  rounded mr-2 transition inline-flex items-center px-4 py-2 bg-blue-600 shadow-sm text-white text-xs font-weight-bold botn "  @click="querySearch('Boutiques')">
            <i class="fa fa-shopping-cart mr-1"></i>
            Boutiques
        </button>
         <button :class="filters.search == 'Bureaux' ? 'border-b-blue-600 text-neutral-800 cursor-not-allowed' : 'border-transparent text-neutral-500'"
            class="  rounded mr-2 transition inline-flex items-center px-4 py-2 bg-blue-600 shadow-sm text-white text-xs font-weight-bold botn "  @click="querySearch('Bureaux')">
            <i class="fa fa-briefcase mr-1"></i>
            Bureaux
        </button>
        <button :class="filters.search == 'Villas' ? 'border-b-blue-600 text-neutral-800 cursor-not-allowed' : 'border-transparent text-neutral-500'"
            class="  rounded mr-2 transition inline-flex items-center px-4 py-2 bg-blue-600 shadow-sm text-white text-xs font-weight-bold botn "  @click="querySearch('Villas')">
            <i class="fa fa-swimming-pool mr-1"></i>
            Villas
        </button>
        <button :class="filters.search == 'Studios' ? 'border-b-blue-600 text-neutral-800 cursor-not-allowed' : 'border-transparent text-neutral-500'"
            class="  rounded mr-2 transition inline-flex items-center px-4 py-2 bg-blue-600 shadow-sm text-white text-xs font-weight-bold botn "  @click="querySearch('Studios')">
            <i class="fa fa-tv mr-1"></i>
            Studios
        </button>
        
        
        </div>

  
  <NoResults v-if="locations <= 0" />
  <div class="container-xl md:px-8">
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
           
            <listing v-for="location in locations" :key="location.id" class="block rounded-lg bg-white shadow-[0_2px_15px_-3px_rgba(0,0,0,0.07),0_10px_20px_-2px_rgba(0,0,0,0.04)] p-5">
                <Link :href="route('locations.show',location.locations_id)">
                <div class="col-span-1 cursor-pointer">
                    <div class="flex gap-2 w-full">
                        <div class="aspect-square w-full relative overflow-hidden rounded-xl">
                            <img class="object-cover h-full w-full hover:scale-110 transition"
                                rel="preload"
                                as="image"
                                :src="`/locations_images/${location.images[0].images}`"
                                alt=" location"
                                height="400"
                                width="400"
                            />
                             
                        </div>
                    </div>
                    <div class="font-semibold text-lg mt-2">
                        {{ location.type }}
                    </div>
                    <div class="font-light text-neutral-500 textline italic" >
                        <i class="fal fa-map-marker-alt mr-2 text-blue-600"></i>{{location.ville+" , "+location.zone }}
                    </div>
                    <div class="flex items-center gap-1 mt-1">
                        <div class="font-semibold">
                            <small>{{ location.loyer }} XOF </small>/ mois
                        </div>
                        <div class="font-ligth">
                          
                        </div>
                    </div>
                </div>
            </Link>
            </listing>
    </div>
  </div>
 
</template>


<style >
    .filter-tag::-webkit-scrollbar {
    width: 14px;
    height: 15px
}

.filter-tag::-webkit-scrollbar-button {
    width: 0;
    height: 0;
    display: none
}

.filter-tag::-webkit-scrollbar-corner {
    background-color: transparent
}

.filter-tag::-webkit-scrollbar-thumb {
    height: 6px;
    border: 4px solid transparent;
    background-clip: padding-box;
    -webkit-border-radius: 7px;
    background-color: rgb(247, 244, 244);
    -webkit-box-shadow: inset -1px -1px 0 rgba(0, 0, 0, .05), inset 1px 1px 0 rgba(0, 0, 0, .05)
}
.botn{
    text-align: center;
}
.botn:hover{
    background-color: white;
    color: rgb(37 99 235)!important;
    border: 1px solid rgb(37 99 235 / var(--tw-bg-opacity));
}
    
</style>