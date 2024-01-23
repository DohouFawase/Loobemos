<script setup>
import AdminAuthenticatedLayout from "@/Layouts/AdminAuthenticatedLayout.vue";
import { Head,Link } from "@inertiajs/vue3";
import { computed, reactive, ref } from "vue";
import { router, useForm } from "@inertiajs/vue3";
import { useNotification } from '@/Stores/notification.js';

const store = useNotification();
//store.addToast({ message: 'Please select a correct date range', type: 'error' });
const processingForm = ref(false);

defineProps({
  zones: Object,
});

const form = useForm({
  zone: "",
});

const submit = () => {
  form.post(route("addZone.store"), {
     preserveScroll: true,
            onSuccess: (res) => {
                console.log("Res", res);
                store.addToast({message: res.props.flash.toast});
            },
            onError: (err) => {
                for (let key in err)
                {
                    store.addToast({message: err[key], type: 'error'});
                }   
            }
  });
};


</script>

<template>
  <Head title="Nouvelle zone" />

  <AdminAuthenticatedLayout>
    <template #header>
      <h2
        class="font-semibold text-xl text-gray-800 leading-tight"
      >
        Nouvelle zone
      </h2>
    </template>

    <div class="py-6">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div
          class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg"
        >
          <div class="p-6 text-gray-900 dark:text-gray-100">
            <h4>Nouvelle zone</h4>
            <br />

            <form @submit.prevent="submit">
              <div class="mb-6">
                <label
                  for="zone"
                  class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                  >zone</label
                >
                <input
                  type="text"
                  id="zone"
                  v-model="form.zone"
                  class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light"
                  placeholder="zogbadjè"
                  required
                />
                <InputError class="mt-2" :message="form.errors.zone" />
              </div>
              <button
                type="submit"
                :disabled="processingForm"
                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
              >
                <i class="fa fa-plus"></i>
                nouvelle zone
              </button>
              
            </form>
          </div>
        </div>
      </div>
    </div>
    <div class="py-6">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div
          class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg"
        >
          <div class="p-6 text-gray-900 dark:text-gray-100">
            <h4>Liste des zones</h4>
            <br />

            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
              <table
                class="w-full text-sm text-left text-gray-500 dark:text-gray-400"
              >
                <thead
                  class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400"
                >
                  <tr>
                    <th scope="col" class="px-6 py-3">#</th>
                    <th scope="col" class="px-6 py-3">Zone</th>
                    <th scope="col" class="px-6 py-3">Suppression</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="zone in zones" :key="zone.id" class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                    <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-black" >
                      {{ zone.id }}
                    </td>
                    <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-black" >
                      {{ zone.zone }}
                    </td>
                    <td class="px-6 py-4 text-right">
                      <Link :href="route('addZone.delete',zone.id)" class="font-medium text-light bg-red-600 px-4 py-2 hover:shadow-xl  rounded-lg  dark:text-red-500"> 
                      <i class="fa fa-trash-alt"></i> supprimer
                      </Link>
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

<style>
.error {
  color: red;
}
</style>
