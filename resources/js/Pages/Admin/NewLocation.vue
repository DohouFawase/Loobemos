<script setup>
import AdminAuthenticatedLayout from "@/Layouts/AdminAuthenticatedLayout.vue";
import { Head } from "@inertiajs/vue3";
import { computed, reactive, ref } from "vue";
import { router, useForm } from "@inertiajs/vue3";
import { useNotification } from '@/Stores/notification.js';

const store = useNotification();

const processingForm = ref(false);

const currentStep = ref(1);
const errors = ref({});

const selectedImages = ref([]);

const steps = reactive({
  TYPELOCATION: 1,
  INFOS: 2,
  LOCALISATION: 3,
  DESCRIPTIONCOURT: 4,
  CONDITIONS: 5,
  DESCRIPTIONLONG: 6,
  IMAGES: 7,
  RECAPITULATIF: 8,
});

const totalSteps = computed(() => {
  return Object.keys(steps).length;
});

defineProps({
  zones: Object,
});

const form = useForm({
  type: "",
  pieces: "",
  cuisine: "",
  douches: "",
  wc: "",
  descriptionshort: "",
  loyer: "",
  pays: "",
  ville: "",
  zone: "",
  avances: "",
  prepayes: "",
  cautions: "",
  commission: "",
  descriptionlong: "",
  images: [],
});

const handleFileChange = (e) => {
  form.images = Array.from(e.target.files);
  selectedImages.value = Array.from(e.target.files).map((file) =>
    URL.createObjectURL(file)
  );
};

const nextStep = (e) => {
  if (validateStep()) {
    errors.value = {};
    currentStep.value++;
    e.preventDefault();
    

  }
};

const previousStep = () => {
  currentStep.value--;
  e.preventDefault();
};

const validateStep = () => {
  errors.value = {};
  let isValid = true;

  if (currentStep.value === 1) {
    if (form.type === "") {
      errors.value.type = "Veuillez choisir un type de location.";
      isValid = false;
    }
  } else if (currentStep.value === 2) {
    if (form.pieces === "") {
      errors.value.pieces = "Veuillez choisir le nombre de pièces.";
      isValid = false;
    }
    if (form.cuisine === "") {
      errors.value.cuisine = "Veuillez choisir le nombre de cuisines.";
      isValid = false;
    }
    if (form.douches === "") {
      errors.value.douches = "Veuillez choisir le nombre de salles de bains.";
      isValid = false;
    }
    if (form.wc === "") {
      errors.value.wc = "Veuillez choisir le nombre de WC.";
      isValid = false;
    }
  }else if (currentStep.value === 3) {
    if (form.pays === "") {
      errors.value.pays = "Veuillez choisir un pays.";
      isValid = false;
    }
    if (form.ville === "") {
      errors.value.ville = "Veuillez choisir une ville.";
      isValid = false;
    }
    if (form.zone === "") {
      errors.value.zone = "Veuillez choisir une zone.";
      isValid = false;
    }
    
  }else if (currentStep.value === 4) {
    if (form.descriptionshort === "") {
      errors.value.descriptionshort =
        "Veuillez entrer une courte description de votre location.";
      isValid = false;
    }
  } else if (currentStep.value === 5) {
    if (form.loyer === "") {
      errors.value.loyer = "Veuillez entrer le prix du loyer.";
      isValid = false;
    }
    if (form.avances === "") {
      errors.value.avances = "Veuillez choisir le nombre d'avances.";
      isValid = false;
    }
    if (form.prepayes === "") {
      errors.value.prepayes = "Veuillez entrer le prépayé.";
      isValid = false;
    }
    if (form.cautions === "") {
      errors.value.cautions = "Veuillez entrer la caution.";
      isValid = false;
    }
    if (form.commission === "") {
      errors.value.commission = "Veuillez choisir le nombre de commissions.";
      isValid = false;
    }
  } else if (currentStep.value === 6) {
    if (form.descriptionlong === "") {
      errors.value.descriptionlong =
        "Veuillez entrer une description détaillée du logement.";
      isValid = false;
    }
  } else if (currentStep.value === 7) {
    if (form.images.length == 0) {
      errors.value.images = "Veuillez sélectionner au moins une image.";
      isValid = false;
    }
  }

  return isValid;
};

const submit = () => {
  if (validateStep()) {
    form.post(route("newLocation.store"), {
      onSuccess: (res) => {
                console.log("Res", res);
                store.addToast({message: res.props.flash.toast});
            },
            onError: (errors) => {
                for (let key in errors)
                {
                    store.addToast({message: errors[key], type: 'error'});
                }   
            }
    });
  }
};
</script>

<template>

  <Head title="Nouvelle location" />

  <AdminAuthenticatedLayout>
    <template #header>
      <h2
        class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight"
      >
        Tableau de bord
      </h2>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div
          class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg"
        >
          <div class="p-6 text-gray-900 dark:text-gray-100">
            <h4>Nouvelle location</h4>
            <br />

            <form @submit.prevent="submit">
              <div v-if="currentStep == steps.TYPELOCATION" class="p-5">
                <h2 class="mb-2 text-2xl font-bold text-gray-700">
                  Type de logement
                </h2>
                <br />
                <select
                  v-model="form.type"
                  id=""
                  class="rounded-md  text-black shadow bg[#f3f4f6] block p-2 w-full focus:ring-blue-500 focus:border-5"
                >
                  <option value="">Sélectionnez votre type de logement</option>
                  <option value="Chambres salons">Chambres salons</option>
                  <option value="Appartements">Appartements</option>
                  <option value="Maisons personnelles">
                    Maisons personnelles
                  </option>
                  <option value="Entrées personnelles">
                    Entrées personnelles
                  </option>
                  <option value="Entrées coucher">Entrées coucher</option>
                  <option value="Locaux commerciaux">Locaux commerciaux</option>
                  <option value="Bureaux">Bureaux</option>
                  <option value="Boutiques">Boutiques</option>
                  <option value="Studios">Studios</option>
                  <option value="Villas">Villas</option>
                </select>
                <span
                  v-if="errors.type"
                  class="error my-2 text-red ph-text-italic-thin text-italic"
                  >{{ errors.type }}</span
                ><br /><br />
              </div>

              <div v-if="currentStep == steps.INFOS" class="p-5">
                <h2 class="mb-2 text-2xl font-bold text-gray-700">
                  Détails du logement
                </h2>
                <br />

                <label
                  for="pieces"
                  class="block mb-2 text-sm font-medium text-gray-500"
                  >Nombres de pièces</label
                >
                <select
                  v-model="form.pieces"
                  id="pieces"
                  class="rounded-md text-black shadow bg[#f3f4f6] block p-2 w-full focus:ring-blue-500 focus:border-5"
                >
                  <option value="">Sélectionnez le nombre de pieces</option>
                  <option value="1">1</option>
                  <option value="2">2</option>
                  <option value="3">3</option>
                  <option value="4">4</option>
                  <option value="5">5</option>
                  <option value="6">6</option>
                  <option value="7">7</option>
                  <option value="8">8</option>
                  <option value="9">9</option>
                </select>
                <span
                  v-if="errors.pieces"
                  class="error my-2 text-red ph-text-italic-thin text-italic"
                  >{{ errors.pieces }}</span
                ><br /><br />

                <label
                  for="cuisine"
                  class="block mb-2 text-sm font-medium text-gray-500"
                  >Cuisine</label
                >
                <select
                  v-model="form.cuisine"
                  id="cuisine"
                  class="rounded-md  text-black shadow bg[#f3f4f6] block p-2 w-full focus:ring-blue-500 focus:border-5"
                >
                  <option value="">Sélectionnez le nombre de cuisine</option>
                  <option value="1">1</option>
                  <option value="2">2</option>
                  <option value="3">3</option>
                </select>
                <span
                  v-if="errors.cuisine"
                  class="error my-2 text-red ph-text-italic-thin text-italic"
                  >{{ errors.cuisine }}</span
                ><br /><br />

                <label
                  for="douches"
                  class="block mb-2 text-sm font-medium text-gray-500"
                  >Nombre de salle de bains</label
                >
                <select
                  v-model="form.douches"
                  id="douches"
                  class="rounded-md text-black shadow bg[#f3f4f6] block p-2 w-full focus:ring-blue-500 focus:border-5"
                >
                  <option value="">Sélectionnez le nombre de douches</option>
                  <option value="1">1</option>
                  <option value="2">2</option>
                  <option value="3">3</option>
                </select>
                <span
                  v-if="errors.douches"
                  class="error my-2 text-red ph-text-italic-thin text-italic"
                  >{{ errors.douches }}</span
                ><br /><br />

                <label
                  for="wc"
                  class="block mb-2 text-sm font-medium text-gray-500"
                  >Nombre de wc</label
                >
                <select
                  v-model="form.wc"
                  id="wc"
                  class="rounded-md shadow bg[#f3f4f6] block  text-black p-2 w-full focus:ring-blue-500 focus:border-5"
                >
                  <option value="">Sélectionnez le nombre de wc</option>
                  <option value="1">1</option>
                  <option value="2">2</option>
                  <option value="3">3</option>
                </select>
                <span
                  v-if="errors.wc"
                  class="error my-2 text-red ph-text-italic-thin text-italic"
                  >{{ errors.wc }}</span
                ><br /><br />
              </div>
              <div v-if="currentStep == steps.LOCALISATION" class="p-5">
                <h2 class="mb-2 text-2xl font-bold text-gray-700">
                  Localisation
                </h2>
                <br />
                <label
                  for="pays"
                  class="block mb-2 text-sm font-medium text-gray-500"
                  >Pays</label
                >
                <select
                  v-model="form.pays"
                  id="pays"
                  class="text-black rounded-md shadow bg[#f3f4f6] block p-2 w-full focus:ring-blue-500 focus:border-5"
                >
                  <option value="">Sélectionnez un pays</option>
                  <option value="Afghanistan">Afghanistan</option>
                  <option value="Albania">Albania</option>
                  <option value="Algeria">Algeria</option>
                  <option value="American Samoa">American Samoa</option>
                  <option value="Angola">Angola</option>
                  <option value="Anguilla">Anguilla</option>
                  <option value="Antartica">Antartica</option>
                  <option value="Antigua and Barbuda">
                    Antigua and Barbuda
                  </option>
                  <option value="Argentina">Argentina</option>
                  <option value="Armenia">Armenia</option>
                  <option value="Aruba">Aruba</option>
                  <option value="Ashmore and Cartier Island">
                    Ashmore and Cartier Island
                  </option>
                  <option value="Australia">Australia</option>
                  <option value="Austria">Austria</option>
                  <option value="Azerbaijan">Azerbaijan</option>
                  <option value="Bahamas">Bahamas</option>
                  <option value="Bahrain">Bahrain</option>
                  <option value="Bangladesh">Bangladesh</option>
                  <option value="Barbados">Barbados</option>
                  <option value="Belarus">Belarus</option>
                  <option value="Belgium">Belgium</option>
                  <option value="Belize">Belize</option>
                  <option value="Benin">Benin</option>
                  <option value="Bermuda">Bermuda</option>
                  <option value="Bhutan">Bhutan</option>
                  <option value="Bolivia">Bolivia</option>
                  <option value="Bosnia and Herzegovina">
                    Bosnia and Herzegovina
                  </option>
                  <option value="Botswana">Botswana</option>
                  <option value="Brazil">Brazil</option>
                  <option value="British Virgin Islands">
                    British Virgin Islands
                  </option>
                  <option value="Brunei">Brunei</option>
                  <option value="Bulgaria">Bulgaria</option>
                  <option value="Burkina Faso">Burkina Faso</option>
                  <option value="Burma">Burma</option>
                  <option value="Burundi">Burundi</option>
                  <option value="Cambodia">Cambodia</option>
                  <option value="Cameroon">Cameroon</option>
                  <option value="Canada">Canada</option>
                  <option value="Cape Verde">Cape Verde</option>
                  <option value="Cayman Islands">Cayman Islands</option>
                  <option value="Central African Republic">
                    Central African Republic
                  </option>
                  <option value="Chad">Chad</option>
                  <option value="Chile">Chile</option>
                  <option value="China">China</option>
                  <option value="Christmas Island">Christmas Island</option>
                  <option value="Clipperton Island">Clipperton Island</option>
                  <option value="Cocos (Keeling) Islands">
                    Cocos (Keeling) Islands
                  </option>
                  <option value="Colombia">Colombia</option>
                  <option value="Comoros">Comoros</option>
                  <option value="Congo, Democratic Republic of the">
                    Congo, Democratic Republic of the
                  </option>
                  <option value="Congo, Republic of the">
                    Congo, Republic of the
                  </option>
                  <option value="Cook Islands">Cook Islands</option>
                  <option value="Costa Rica">Costa Rica</option>
                  <option value="Cote d'Ivoire">Cote d'Ivoire</option>
                  <option value="Croatia">Croatia</option>
                  <option value="Cuba">Cuba</option>
                  <option value="Cyprus">Cyprus</option>
                  <option value="Czeck Republic">Czeck Republic</option>
                  <option value="Denmark">Denmark</option>
                  <option value="Djibouti">Djibouti</option>
                  <option value="Dominica">Dominica</option>
                  <option value="Dominican Republic">Dominican Republic</option>
                  <option value="Ecuador">Ecuador</option>
                  <option value="Egypt">Egypt</option>
                  <option value="El Salvador">El Salvador</option>
                  <option value="Equatorial Guinea">Equatorial Guinea</option>
                  <option value="Eritrea">Eritrea</option>
                  <option value="Estonia">Estonia</option>
                  <option value="Ethiopia">Ethiopia</option>
                  <option value="Europa Island">Europa Island</option>
                  <option value="Falkland Islands (Islas Malvinas)">
                    Falkland Islands (Islas Malvinas)
                  </option>
                  <option value="Faroe Islands">Faroe Islands</option>
                  <option value="Fiji">Fiji</option>
                  <option value="Finland">Finland</option>
                  <option value="France">France</option>
                  <option value="French Guiana">French Guiana</option>
                  <option value="French Polynesia">French Polynesia</option>
                  <option value="French Southern and Antarctic Lands">
                    French Southern and Antarctic Lands
                  </option>
                  <option value="Gabon">Gabon</option>
                  <option value="Gambia, The">Gambia, The</option>
                  <option value="Gaza Strip">Gaza Strip</option>
                  <option value="Georgia">Georgia</option>
                  <option value="Germany">Germany</option>
                  <option value="Ghana">Ghana</option>
                  <option value="Gibraltar">Gibraltar</option>
                  <option value="Glorioso Islands">Glorioso Islands</option>
                  <option value="Greece">Greece</option>
                  <option value="Greenland">Greenland</option>
                  <option value="Grenada">Grenada</option>
                  <option value="Guadeloupe">Guadeloupe</option>
                  <option value="Guam">Guam</option>
                  <option value="Guatemala">Guatemala</option>
                  <option value="Guernsey">Guernsey</option>
                  <option value="Guinea">Guinea</option>
                  <option value="Guinea-Bissau">Guinea-Bissau</option>
                  <option value="Guyana">Guyana</option>
                  <option value="Haiti">Haiti</option>
                  <option value="Heard Island and McDonald Islands">
                    Heard Island and McDonald Islands
                  </option>
                  <option value="Holy See (Vatican City)">
                    Holy See (Vatican City)
                  </option>
                  <option value="Honduras">Honduras</option>
                  <option value="Hong Kong">Hong Kong</option>
                  <option value="Howland Island">Howland Island</option>
                  <option value="Hungary">Hungary</option>
                  <option value="Iceland">Iceland</option>
                  <option value="India">India</option>
                  <option value="Indonesia">Indonesia</option>
                  <option value="Iran">Iran</option>
                  <option value="Iraq">Iraq</option>
                  <option value="Ireland">Ireland</option>
                  <option value="Ireland, Northern">Ireland, Northern</option>
                  <option value="Israel">Israel</option>
                  <option value="Italy">Italy</option>
                  <option value="Jamaica">Jamaica</option>
                  <option value="Jan Mayen">Jan Mayen</option>
                  <option value="Japan">Japan</option>
                  <option value="Jarvis Island">Jarvis Island</option>
                  <option value="Jersey">Jersey</option>
                  <option value="Johnston Atoll">Johnston Atoll</option>
                  <option value="Jordan">Jordan</option>
                  <option value="Juan de Nova Island">
                    Juan de Nova Island
                  </option>
                  <option value="Kazakhstan">Kazakhstan</option>
                  <option value="Kenya">Kenya</option>
                  <option value="Kiribati">Kiribati</option>
                  <option value="Korea, North">Korea, North</option>
                  <option value="Korea, South">Korea, South</option>
                  <option value="Kuwait">Kuwait</option>
                  <option value="Kyrgyzstan">Kyrgyzstan</option>
                  <option value="Laos">Laos</option>
                  <option value="Latvia">Latvia</option>
                  <option value="Lebanon">Lebanon</option>
                  <option value="Lesotho">Lesotho</option>
                  <option value="Liberia">Liberia</option>
                  <option value="Libya">Libya</option>
                  <option value="Liechtenstein">Liechtenstein</option>
                  <option value="Lithuania">Lithuania</option>
                  <option value="Luxembourg">Luxembourg</option>
                  <option value="Macau">Macau</option>
                  <option value="Macedonia, Former Yugoslav Republic of">
                    Macedonia, Former Yugoslav Republic of
                  </option>
                  <option value="Madagascar">Madagascar</option>
                  <option value="Malawi">Malawi</option>
                  <option value="Malaysia">Malaysia</option>
                  <option value="Maldives">Maldives</option>
                  <option value="Mali">Mali</option>
                  <option value="Malta">Malta</option>
                  <option value="Man, Isle of">Man, Isle of</option>
                  <option value="Marshall Islands">Marshall Islands</option>
                  <option value="Martinique">Martinique</option>
                  <option value="Mauritania">Mauritania</option>
                  <option value="Mauritius">Mauritius</option>
                  <option value="Mayotte">Mayotte</option>
                  <option value="Mexico">Mexico</option>
                  <option value="Micronesia, Federated States of">
                    Micronesia, Federated States of
                  </option>
                  <option value="Midway Islands">Midway Islands</option>
                  <option value="Moldova">Moldova</option>
                  <option value="Monaco">Monaco</option>
                  <option value="Mongolia">Mongolia</option>
                  <option value="Montserrat">Montserrat</option>
                  <option value="Morocco">Morocco</option>
                  <option value="Mozambique">Mozambique</option>
                  <option value="Namibia">Namibia</option>
                  <option value="Nauru">Nauru</option>
                  <option value="Nepal">Nepal</option>
                  <option value="Netherlands">Netherlands</option>
                  <option value="Netherlands Antilles">
                    Netherlands Antilles
                  </option>
                  <option value="New Caledonia">New Caledonia</option>
                  <option value="New Zealand">New Zealand</option>
                  <option value="Nicaragua">Nicaragua</option>
                  <option value="Niger">Niger</option>
                  <option value="Nigeria">Nigeria</option>
                  <option value="Niue">Niue</option>
                  <option value="Norfolk Island">Norfolk Island</option>
                  <option value="Northern Mariana Islands">
                    Northern Mariana Islands
                  </option>
                  <option value="Norway">Norway</option>
                  <option value="Oman">Oman</option>
                  <option value="Pakistan">Pakistan</option>
                  <option value="Palau">Palau</option>
                  <option value="Panama">Panama</option>
                  <option value="Papua New Guinea">Papua New Guinea</option>
                  <option value="Paraguay">Paraguay</option>
                  <option value="Peru">Peru</option>
                  <option value="Philippines">Philippines</option>
                  <option value="Pitcaim Islands">Pitcaim Islands</option>
                  <option value="Poland">Poland</option>
                  <option value="Portugal">Portugal</option>
                  <option value="Puerto Rico">Puerto Rico</option>
                  <option value="Qatar">Qatar</option>
                  <option value="Reunion">Reunion</option>
                  <option value="Romainia">Romainia</option>
                  <option value="Russia">Russia</option>
                  <option value="Rwanda">Rwanda</option>
                  <option value="Saint Helena">Saint Helena</option>
                  <option value="Saint Kitts and Nevis">
                    Saint Kitts and Nevis
                  </option>
                  <option value="Saint Lucia">Saint Lucia</option>
                  <option value="Saint Pierre and Miquelon">
                    Saint Pierre and Miquelon
                  </option>
                  <option value="Saint Vincent and the Grenadines">
                    Saint Vincent and the Grenadines
                  </option>
                  <option value="Samoa">Samoa</option>
                  <option value="San Marino">San Marino</option>
                  <option value="Sao Tome and Principe">
                    Sao Tome and Principe
                  </option>
                  <option value="Saudi Arabia">Saudi Arabia</option>
                  <option value="Scotland">Scotland</option>
                  <option value="Senegal">Senegal</option>
                  <option value="Seychelles">Seychelles</option>
                  <option value="Sierra Leone">Sierra Leone</option>
                  <option value="Singapore">Singapore</option>
                  <option value="Slovakia">Slovakia</option>
                  <option value="Slovenia">Slovenia</option>
                  <option value="Solomon Islands">Solomon Islands</option>
                  <option value="Somalia">Somalia</option>
                  <option value="South Africa">South Africa</option>
                  <option value="South Georgia and South Sandwich Islands">
                    South Georgia and South Sandwich Islands
                  </option>
                  <option value="Spain">Spain</option>
                  <option value="Spratly Islands">Spratly Islands</option>
                  <option value="Sri Lanka">Sri Lanka</option>
                  <option value="Sudan">Sudan</option>
                  <option value="Suriname">Suriname</option>
                  <option value="Svalbard">Svalbard</option>
                  <option value="Swaziland">Swaziland</option>
                  <option value="Sweden">Sweden</option>
                  <option value="Switzerland">Switzerland</option>
                  <option value="Syria">Syria</option>
                  <option value="Taiwan">Taiwan</option>
                  <option value="Tajikistan">Tajikistan</option>
                  <option value="Tanzania">Tanzania</option>
                  <option value="Thailand">Thailand</option>
                  <option value="Tobago">Tobago</option>
                  <option value="Toga">Toga</option>
                  <option value="Tokelau">Tokelau</option>
                  <option value="Tonga">Tonga</option>
                  <option value="Trinidad">Trinidad</option>
                  <option value="Tunisia">Tunisia</option>
                  <option value="Turkey">Turkey</option>
                  <option value="Turkmenistan">Turkmenistan</option>
                  <option value="Tuvalu">Tuvalu</option>
                  <option value="Uganda">Uganda</option>
                  <option value="Ukraine">Ukraine</option>
                  <option value="United Arab Emirates">
                    United Arab Emirates
                  </option>
                  <option value="United Kingdom">United Kingdom</option>
                  <option value="Uruguay">Uruguay</option>
                  <option value="USA">USA</option>
                  <option value="Uzbekistan">Uzbekistan</option>
                  <option value="Vanuatu">Vanuatu</option>
                  <option value="Venezuela">Venezuela</option>
                  <option value="Vietnam">Vietnam</option>
                  <option value="Virgin Islands">Virgin Islands</option>
                  <option value="Wales">Wales</option>
                  <option value="Wallis and Futuna">Wallis and Futuna</option>
                  <option value="West Bank">West Bank</option>
                  <option value="Western Sahara">Western Sahara</option>
                  <option value="Yemen">Yemen</option>
                  <option value="Yugoslavia">Yugoslavia</option>
                  <option value="Zambia">Zambia</option>
                  <option value="Zimbabwe">Zimbabwe</option>
                </select>
                <span
                  v-if="errors.pays"
                  class="error my-2 text-red ph-text-italic-thin text-italic"
                  >{{ errors.pays }}</span
                ><br />
                <label
                  for="ville"
                  class="block mb-2 text-sm font-medium text-gray-500"
                  >Ville</label
                >
                <select
                  v-model="form.ville"
                  id="ville"
                  class=" text-black rounded-md shadow bg[#f3f4f6] block p-2 w-full focus:ring-blue-500 focus:border-5"
                >
                  <option value="">Sélectionnez une ville</option>
                  <option value="Cotonou">Cotonou</option>
                </select>
                <span
                  v-if="errors.ville"
                  class="error my-2 text-red ph-text-italic-thin text-italic"
                  >{{ errors.ville }}</span
                ><br />
                <label for="zone" class="block mb-2 text-sm font-medium text-gray-500">Zone</label>
                <select
                  v-model="form.zone"
                  id="zone"
                  class="rounded-md shadow bg[#f3f4f6] block p-2 w-full focus:ring-blue-500 focus:border-5"
                >
                  <option value="">Sélectionnez une zone</option>
                  <option v-for="zone in zones" :key="zone.id" :value="zone.zone">{{ zone.zone }}</option>
                </select>
                <span
                  v-if="errors.zone"
                  class="error my-2 text-red ph-text-italic-thin text-italic"
                  >{{ errors.zone }}</span
                ><br />
              </div>

              <div v-if="currentStep == steps.DESCRIPTIONCOURT" class="p-5">
                <h2 class="mb-2 text-2xl font-bold text-gray-700">
                  Courte description du logement
                </h2>
                <br />

                <textarea
                  v-model="form.descriptionshort"
                  cols="30"
                  rows="10"
                  class=" text-black rounded-md shadow bg[#f3f4f6] block p-2 w-full focus:ring-blue-500 focus:border-5"
                ></textarea>
                <span
                  v-if="errors.descriptionshort"
                  class="error my-2 text-red ph-text-italic-thin text-italic"
                  >{{ errors.descriptionshort }}</span
                ><br /><br />
              </div>

              <div v-if="currentStep == steps.CONDITIONS" class="p-5">
                <h2 class="mb-2 text-2xl font-bold text-gray-700">
                  Conditions du logement
                </h2>
                <br />

                <label
                  for="loyer"
                  class="block mb-2 text-sm font-medium text-gray-500"
                  >Loyer</label
                >
                <input
                  v-model="form.loyer"
                  id="loyer"
                  type="number"
                  placeholder="Veuillez entrer le prix du loyer"
                  class="rounded-md shadow bg[#f3f4f6] block p-2 w-full focus:ring-blue-500 focus:border-5"
                /><br />
                <span
                  v-if="errors.loyer"
                  class="error my-2 text-red ph-text-italic-thin text-italic"
                  >{{ errors.loyer }}</span
                ><br />

                <label
                  for="avances"
                  class="block mb-2 text-sm font-medium text-gray-500"
                  >Avances</label
                >
                <select
                  v-model="form.avances"
                  id="avances"
                  class="rounded-md shadow bg[#f3f4f6] block p-2 w-full focus:ring-blue-500 focus:border-5"
                >
                  <option value="">Sélectionnez le nombre d'avances</option>
                  <option value="1">1</option>
                  <option value="2">2</option>
                  <option value="3">3</option>
                  <option value="4">4</option>
                  <option value="5">5</option>
                  <option value="6">6</option>
                </select>
                <span
                  v-if="errors.avances"
                  class="error my-2 text-red ph-text-italic-thin text-italic"
                  >{{ errors.avances }}</span
                ><br />

                <label
                  for="prepayes"
                  class="block mb-2 text-sm font-medium text-gray-500"
                  >Prépayés</label
                >
                <input
                  v-model="form.prepayes"
                  id="prepayes"
                  type="number"
                  placeholder="Veuillez entrer le prepayés"
                  class="rounded-md shadow bg[#f3f4f6] block p-2 w-full focus:ring-blue-500 focus:border-5"
                /><br />
                <span
                  v-if="errors.prepayes"
                  class="error my-2 text-red ph-text-italic-thin text-italic"
                  >{{ errors.prepayes }}</span
                ><br />

                <label
                  for="cautions"
                  class="block mb-2 text-sm font-medium text-gray-500"
                  >Caution</label
                >
                <input
                  v-model="form.cautions"
                  id="cautions"
                  type="number"
                  placeholder="Veuillez entrer la caution"
                  class="rounded-md shadow bg[#f3f4f6] block p-2 w-full focus:ring-blue-500 focus:border-5"
                /><br />
                <span
                  v-if="errors.cautions"
                  class="error my-2 text-red ph-text-italic-thin text-italic"
                  >{{ errors.cautions }}</span
                ><br />

                <label
                  for="commissions"
                  class="block mb-2 text-sm font-medium text-gray-500"
                  >Commissions</label
                >
                <select
                  v-model="form.commission"
                  id="commissions"
                  class="rounded-md shadow bg[#f3f4f6] block p-2 w-full focus:ring-blue-500 focus:border-5"
                >
                  <option value="">
                    Sélectionnez le nombre de commissions
                  </option>
                  <option value="1">1</option>
                  <option value="2">2</option>
                  <option value="3">3</option>
                  <option value="4">4</option>
                  <option value="5">5</option>
                </select>
                <span
                  v-if="errors.commission"
                  class="error my-2 text-red ph-text-italic-thin text-italic"
                  >{{ errors.commission }}</span
                ><br /><br />
              </div>

              <div v-if="currentStep == steps.DESCRIPTIONLONG" class="p-5">
                <h2 class="mb-2 text-2xl font-bold text-gray-700">
                  Longue description du logement
                </h2>
                <br />

                <textarea
                  v-model="form.descriptionlong"
                  cols="30"
                  rows="10"
                  class="rounded-md shadow bg[#f3f4f6] block p-2 w-full focus:ring-blue-500 focus:border-5"
                ></textarea>
                <span
                  v-if="errors.descriptionlong"
                  class="error my-2 text-red ph-text-italic-thin text-italic"
                  >{{ errors.descriptionlong }}</span
                ><br /><br />
              </div>

              <div v-if="currentStep == steps.IMAGES">
                <h2 class="mb-2 text-2xl font-bold text-gray-700">
                  Images du logement
                </h2>
                <br />
                <input
                  type="file"
                  @change="handleFileChange"
                  class="rounded-md shadow bg[#f3f4f6] block p-2 w-full focus:ring-blue-500 focus:border-5"
                  multiple
                />
                <span
                  v-if="errors.images"
                  class="error my-2 text-red ph-text-italic-thin"
                  >{{ errors.images }}</span
                >
                <br />
              </div>

              <div v-if="currentStep == steps.RECAPITULATIF">
                <h2 class="mb-2 text-2xl font-bold text-gray-700">
                  Récapitulatif
                </h2>
                <p><strong>Type de location :</strong> {{ form.type }}</p>
                <br />
                <h4 class="mb-2 text-xl font-bold text-gray-700">
                  Détails du logement
                </h4>
                <p class="ml-4 mb-1 text-sm">
                  <strong>Nombre de pièces :</strong> {{ form.pieces }}
                </p>
                <p class="ml-4 mb-1 text-sm">
                  <strong>Nombre de cuisine :</strong> {{ form.cuisine }}
                </p>
                <p class="ml-4 mb-1 text-sm">
                  <strong>Nombre de salle de bains :</strong> {{ form.douches }}
                </p>
                <p class="ml-4 mb-1 text-sm">
                  <strong>Nombre de wc :</strong> {{ form.wc }}
                </p>
                <br />
                <h4 class="mb-2 text-xl font-bold text-gray-700">
                  Courte description du logement
                </h4>
                <p class="ml-4 mb-1 text-sm">{{ form.descriptionshort }}</p>
                <br />
                <h4 class="mb-2 text-xl font-bold text-gray-700">
                  Conditions du logement
                </h4>
                <p class="ml-4 mb-1 text-sm">
                  <strong>Avances :</strong> {{ form.avances }}
                </p>
                <p class="ml-4 mb-1 text-sm">
                  <strong>Prepayés :</strong> {{ form.prepayes }}
                </p>
                <p class="ml-4 mb-1 text-sm">
                  <strong>Caution :</strong> {{ form.cautions }}
                </p>
                <p class="ml-4 mb-1 text-sm">
                  <strong>Commissions :</strong> {{ form.commission }}
                </p>
                <h4 class="mb-2 text-xl font-bold text-gray-700">
                  Longue description du logement
                </h4>
                <p class="ml-4 mb-1 text-sm">{{ form.descriptionlong }}</p>
                <br />
                <h4 class="mb-2 text-xl font-bold text-gray-700">
                  Images du logement
                </h4>
                <div class="flex flex-wrap">
                  <img
                    v-for="image in selectedImages"
                    :key="image"
                    :src="image"
                    alt="Selected Image"
                    class="w-32 h-32 object-cover mr-2 mb-2"
                  />
                </div>
              </div>
              <div class="flex justify-between align-middle mt-2">
                <button
                  v-if="currentStep > 1"
                  @click="previousStep"
                  class="inline-flex items-left py-2 ml-4 px-6 bg-light-900 shadow-lg rounded text-sm font-medium hover:bg-light-500"
                  type="button"
                >
                  Précédent
                </button>
                <button
                  @click="nextStep"
                  v-if="currentStep < totalSteps"
                  class="inline-flex items-right py-2 mr-4 px-6 bg-blue-700 text-white shadow-lg rounded text-sm font-medium hover:bg-blue-900 ml-10"
                  type="button"
                >
                  Suivant
                </button>
                <button
                  type="submit"
                  v-if="currentStep === totalSteps"
                  class="inline-flex items-right py-2 mr-4 px-6 bg-green-700 text-white shadow-lg rounded text-sm font-medium hover:bg-green-900 ml-10"
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
  </AdminAuthenticatedLayout>
</template>

<style>
.error {
  color: red;
}
</style>
