
<script setup>
import { defineProps, onMounted, ref, watch,  computed, reactive } from "vue";
import { router, Link, useForm } from "@inertiajs/vue3";

import DangerButton from "@/Components/DangerButton.vue";
import InputLabel from "@/Components/InputLabel.vue";
import { useNotification } from '@/Stores/notification.js';
import Layout from "@/Layouts/Layout.vue";

const store = useNotification();

defineProps({
  locations: Object,
  timestamp: Object
});


const form = useForm({
  date: "",
  heure: "",
  telephone: "",
  locationid : ""
});

const submit = () => {
  // Convertir l'objet en chaîne de caractères
  const locationId = document.getElementById("loid").value;
// Set the value of the locationid property in the form
  form.locationid = locationId;
  form.post(route("reservation.store"), {
    preserveScroll: true,
    onSuccess: (res) => {
      store.addToast({ message: "Votre reservation à été envoyé avec succes" });
    },
    // Supprimer le code de gestion des erreurs
  });
};
</script>
<template>
  <Layout :title="locations.type">
    <main id="content">
      <section>
        <br />
        <div class="container">
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb pt-lg-0 pb-3">
              <li class="breadcrumb-item fs-12 letter-spacing-087">
                <Link :href="route('home')">Acceuil</Link>
              </li>
              <li class="breadcrumb-item fs-12 letter-spacing-087">
                <a href="#">Locations</a>
              </li>
              <li class="breadcrumb-item fs-12 letter-spacing-087 active">
                {{ locations.type }}
              </li>
            </ol>
          </nav>
        </div>
        <div class="container-fluid">
          <div class="position-relative">
            <div class="position-absolute pos-fixed-top-right z-index-3">
              
            </div>
            <div class="row m-n1">
              
              <div class="col-lg-6 p-1">
                <div class="item item-size-4-3">
                  <div class="card p-0 hover-zoom-in">
                   <img class="" :src="`../locations_images/${locations.images[0].images}`" alt="">
                   
                  </div>
                </div>
              </div>
              <div class="col-lg-6 p-1">
                <div class="row m-n1">
                  <div class="col-md-6 p-1">
                    <div class="item item-size-4-3" v-if="locations.images[1].images">
                      <div class="card p-0 hover-zoom-in">
                        <img class=""  :src="`../locations_images/${locations.images[1].images}`" alt="">
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6 p-1">
                    <div class="item item-size-4-3" v-if="locations.images[2].images">
                      <div class="card p-0 hover-zoom-in">
                        <img class=""  :src="`../locations_images/${locations.images[2].images}`" alt="">
                      </div>
                    </div>
                  </div>
                  <div  class="col-md-6 p-1">
                    <div class="item item-size-4-3" v-if="locations.images[3].images">
                      <div class="card p-0 hover-zoom-in">
                        <img class=""  :src="`../locations_images/${locations.images[3].images}`" alt="">
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6 p-1">
                    
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="primary-content pt-8">
          <div class="container">
            <div class="row">
              <article class="col-lg-8 pr-xl-7">
                <section class="pb-7 border-bottom">
                  <ul class="list-inline d-sm-flex align-items-sm-center mb-2">
                    <li class="list-inline-item badge badge-success mr-2">
                      Disponible
                    </li>
                    <li class="list-inline-item mr-2 mt-2 mt-sm-0">
                      <i class="fal fa-clock mr-1"></i>publié {{ timestamp }}
                    </li>
                  </ul>
                  <div class="d-sm-flex justify-content-sm-between">
                    <div>
                      <h2 class="fs-35 font-weight-600 lh-15 text-heading">
                        {{ locations.type }}
                      </h2>
                      <p class="mb-0">
                        <i class="fal fa-map-marker-alt mr-2"></i
                        >{{
                          locations.pays +
                          "," +
                          locations.ville +
                          "," +
                          locations.zone
                        }}
                      </p>
                    </div>
                    <div class="mt-2 text-lg-right">
                      <p class="fs-22 text-heading font-weight-bold mb-0">
                        XOF {{ locations.loyer * locations.prepayes }}
                      </p>
                      <p class="mb-0">XOF {{ locations.loyer }}/Mois</p>
                    </div>
                  </div>
                  </section>
                  <section class="card-body px-sm-6 rounded-xl shadow-xxs-2 pb-5 pt-0 py-4 my-4">
                  <h4 class="text-sm  text-blue-600  font-weight-bold text-heading">Description</h4><br>
                  <p class="mb-0 lh-214">
                    {{ locations.court_description }}
                    <br />
                    {{ locations.longue_description }}
                  </p>
                </section>
                <section class="card-body px-sm-6 rounded-xl shadow-xxs-2 pb-5 pt-0 py-4 my-4">
                  <h4 class="text-sm  text-blue-600  font-weight-bold text-heading">
                    Informations complémentaires
                  </h4><br>
                  <div class="row">
                    <div class="col-lg-3 col-sm-4 mb-6">
                      <div class="media">
                        <div class="p-2 shadow-xxs-1 rounded-lg mr-2">
                          <i class="fa fa-bed text-primary fs-32"></i>
                        </div>
                        <div class="media-body">
                          <h5
                            class="my-1 fs-14 text-uppercase letter-spacing-093 font-weight-normal"
                          >
                            {{ locations.pieces }}
                          </h5>
                          <p class="mb-0 fs-13 font-weight-bold text-heading">
                            Chambres
                          </p>
                        </div>
                      </div>
                    </div>
                    <div class="col-lg-3 col-sm-4 mb-6">
                      <div class="media">
                        <div class="p-2 shadow-xxs-1 rounded-lg mr-2">
                          <i class="fa fa-utensils text-primary fs-32"></i>
                        </div>
                        <div class="media-body">
                          <h5
                            class="my-1 fs-14 text-uppercase letter-spacing-093 font-weight-normal"
                          >
                            {{ locations.cuisine }}
                          </h5>
                          <p class="mb-0 fs-13 font-weight-bold text-heading">
                            Cuisine
                          </p>
                        </div>
                      </div>
                    </div>
                    <div class="col-lg-3 col-sm-4 mb-6">
                      <div class="media">
                        <div class="p-2 shadow-xxs-1 rounded-lg mr-2">
                          <i class="fa fa-shower text-primary fs-32"></i>
                        </div>
                        <div class="media-body">
                          <h5
                            class="my-1 fs-14 text-uppercase letter-spacing-093 font-weight-normal"
                          >
                            {{ locations.douches }}
                          </h5>
                          <p class="mb-0 fs-13 font-weight-bold text-heading">
                            Douches
                          </p>
                        </div>
                      </div>
                    </div>
                    <div class="col-lg-3 col-sm-4 mb-6">
                      <div class="media">
                        <div class="p-2 shadow-xxs-1 rounded-lg mr-2">
                          <i class="fa fa-money-check-alt text-primary fs-32"></i>
                        </div>
                        <div class="media-body">
                          <h5
                            class="my-1 fs-14 text-uppercase letter-spacing-093 font-weight-normal"
                          >
                            {{ locations.prepayes }}
                          </h5>
                          <p class="mb-0 fs-13 font-weight-bold text-heading">
                            Prepayes
                          </p>
                        </div>
                      </div>
                    </div>
                    <div class="col-lg-3 col-sm-4 mb-6">
                      <div class="media">
                        <div class="p-2 shadow-xxs-1 rounded-lg mr-2">
                           <i class="fa fa-money-bill-alt text-primary fs-32"></i>
                        </div>
                        <div class="media-body">
                          <h5
                            class="my-1 fs-14 text-uppercase letter-spacing-093 font-weight-normal"
                          >
                            {{ locations.avances }}
                          </h5>
                          <p class="mb-0 fs-13 font-weight-bold text-heading">
                            Avances
                          </p>
                        </div>
                      </div>
                    </div>
                    <div class="col-lg-3 col-sm-4 mb-6">
                      <div class="media">
                        <div class="p-2 shadow-xxs-1 rounded-lg mr-2">
                          <i class="fa fa-money-check text-primary fs-32"></i>
                        </div>
                        <div class="media-body">
                          <h5
                            class="my-1 fs-14 text-uppercase letter-spacing-093 font-weight-normal"
                          >
                            {{ locations.cautions }}
                          </h5>
                          <p class="mb-0 fs-13 font-weight-bold text-heading">
                            Cautions
                          </p>
                        </div>
                      </div>
                    </div>
                    <div class="col-lg-3 col-sm-4 mb-6">
                      <div class="media">
                        <div class="p-2 shadow-xxs-1 rounded-lg mr-2">
                          <i class="fa fa-circle text-primary fs-32"></i>
                        </div>
                        <div class="media-body">
                          <h5
                            class="my-1 fs-14 text-uppercase letter-spacing-093 font-weight-normal"
                          >
                            Status
                          </h5>
                          <p class="mb-0 fs-13 font-weight-bold text-heading">
                            Disponible
                          </p>
                        </div>
                      </div>
                    </div>
                  </div>
                </section>
                <section class="card-body px-sm-6 rounded-xl shadow-xxs-2 pb-5 pt-0 py-4">
                  <h4 class="text-sm  text-blue-600  font-weight-bold text-heading">
                   <i class="fa fa-share"></i> Partager via les réseaux sociaux
                  </h4><br><br>
                  <ShareNetwork
                  network="facebook"
                  url="https://solve.com"
                 :title="locations.type"
                 :description="locations.descriptionshort"
                 class="text-white bg-blue-400 hover:bg-blue/90 focus:ring-4 focus:outline-none focus:ring-[#1da1f2]/50 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:focus:ring-[#1da1f2]/55 mr-2 mb-2"
                  >
                  <svg class="w-4 h-4 mr-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 8 19">
                    <path fill-rule="evenodd" d="M6.135 3H8V0H6.135a4.147 4.147 0 0 0-4.142 4.142V6H0v3h2v9.938h3V9h2.021l.592-3H5V3.591A.6.6 0 0 1 5.592 3h.543Z" clip-rule="evenodd"/>
                  </svg>
                   Facebook
                  </ShareNetwork>

                  <ShareNetwork
                  network="linkedin"
                  url="https://solve.com"
                 :title="locations.type"
                 :description="locations.descriptionshort"
                  >
                  <i class="fa fa-linkedin"></i> LinkedIn
                  </ShareNetwork>
                </section><br>
              </article>
              <aside
                class="col-lg-4 pl-xl-4 primary-sidebar sidebar-sticky"
                id="sidebar"
              >
                <div class="primary-sidebar-inner">
                  <div class="card border-0 widget-request-tour">
                   
                    <div class="card-body px-sm-6 rounded-xl shadow-xxs-2 pb-5 pt-0 py-4">
                      <div>
                        <h1 class="text-sm  text-blue-600  font-weight-bold text-heading"> <i class="fa fa-calendar"></i> Faire une reservation</h1><br>
                   
                      <form @submit.prevent="submit" v-if="$page.props.auth.user" class="py-4">
                        <div class=" shadow-none">
                          <div class="mb-6">
                            <label for="date" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Date de visite</label>
                            <input type="date" v-model="form.date" id="date" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5  dark:placeholder-gray-400  dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light"  required>
                          </div>
                          <div class="mb-6">
                            <label for="time" class="block mb-2 text-sm font-medium text-gray-900 ">Heure de visite</label>
                            <input type="time" v-model="form.heure" id="time" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5  dark:placeholder-gray-400  dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light"  required>
                          </div>
                          <div class="mb-6">
                            <label for="tel" class="block mb-2 text-sm font-medium text-gray-900 ">Votre numéro de teléphone</label>
                            <input type="tel" v-model="form.telephone" id="tel" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5  dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" placeholder="Votre contact" required>
                            <input type="hidden" :value="locations.locations_id" id="loid">
                          </div>
                            
                          <button type="submit"  class="text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm w-full py-2.5 text-center mr-2 mb-2">
                            Reserver
                          </button>

                        </div>
                      </form>
                      <div v-else>
                        <Link :href="route('login')">
                          <button type="button" class="text-white bg-gradient-to-br from-purple-600 to-blue-500 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">
                          Me connecter pour continuer
                        </button>
                        </Link>
                      </div>
                      </div>
                    </div>
                  </div>
                </div><br><br>
              </aside>
              
            </div>
          </div>
        </div>
      </section>
      <div
        class="d-flex bottom-bar-action bottom-bar-action-01 py-2 px-4 bg-gray-01 align-items-center position-fixed fixed-bottom d-sm-none"
      >
        <div class="media align-items-center">
          <img src="/../assets/images/favicon.png" style="width:40px;height:40px;border-radius:50%;" alt="Lobeemo" class="mr-4 rounded-circle"/>
          <div class="media-body">
            <a href="#" class="d-block text-dark fs-15 font-weight-500 lh-15"
              >Lobeemo</a
            >
            <span class="fs-13 lh-2">Sales Excutive</span>
          </div>
        </div>
        <div class="ml-auto">
          <button
            type="button"
            class="btn btn-primary fs-18 p-2 lh-1 mr-1 mb-1 shadow-none"
            data-toggle="modal"
            data-target="#modal-messenger"
          >
            <i class="fal fa-comment"></i>
          </button>
          <a
            href="tel:(+84)2388-969-888"
            class="btn btn-primary fs-18 p-2 lh-1 mb-1 shadow-none"
            target="_blank"
            ><i class="fal fa-phone"></i
          ></a>
        </div>
      </div>
    </main>
  </Layout>
</template>


