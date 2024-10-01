require("./bootstrap");
require("./index");

window.Vue = require("vue");

import Swal from "sweetalert2";
import VueRouter from "vue-router";
import Multiselect from "vue-multiselect";
import VueGoodTablePlugin from "vue-good-table";
import VueTheMask from "vue-the-mask";
// import { LMap, LTileLayer, LMarker } from 'vue2-leaflet';
// import 'leaflet/dist/leaflet.css';

import router from "./router";
import Roles from "./mixins/Roles.vue";
import SideBar from "./components/SideBar.vue";
import BottomTab from "./components/BottomTab.vue";
import ProfileButton from "./components/ProfileButton.vue";
import BackButton from "./components/BackButton";
import Loader from "./components/Loader";
import Footer from "./components/Footer";

import Home from "./pages/Home/Home.vue";
import Login from "./pages/Auth/Login.vue";

// Signup form steps
import Step0 from "./pages/Auth/Signup/Step0.vue";
import Step1 from "./pages/Auth/Signup/Step1.vue";
import Step2 from "./pages/Auth/Signup/Step2.vue";
import Step3 from "./pages/Auth/Signup/Step3.vue";
import Step4 from "./pages/Auth/Signup/Step4.vue";
import Step5 from "./pages/Auth/Signup/Step5.vue";

// Add operational unit form steps
import FormStep1 from "./pages/Strata/AddOperationalUnitSteps/FormStep1.vue";
import FormStep2 from "./pages/Strata/AddOperationalUnitSteps/FormStep2.vue";
import FormStep3 from "./pages/Strata/AddOperationalUnitSteps/FormStep3.vue";
import FormStep4 from "./pages/Strata/AddOperationalUnitSteps/FormStep4.vue";
import FormStep5 from "./pages/Strata/AddOperationalUnitSteps/FormStep5.vue";
import FormStep6 from "./pages/Strata/AddOperationalUnitSteps/FormStep6.vue";

// Edit operational unit form steps
import EditFormStep1 from "./pages/Blocks/EditBlockSteps/FormStep1.vue";
import EditFormStep2 from "./pages/Blocks/EditBlockSteps/FormStep2.vue";
import EditFormStep3 from "./pages/Blocks/EditBlockSteps/FormStep3.vue";
import EditFormStep4 from "./pages/Blocks/EditBlockSteps/FormStep4.vue";
import EditFormStep5 from "./pages/Blocks/EditBlockSteps/FormStep5.vue";
import EditFormStep6 from "./pages/Blocks/EditBlockSteps/FormStep6.vue";

// styles
import "vue-good-table/dist/vue-good-table.css";

window.Swal = Swal;

Vue.use(VueRouter);
Vue.use(VueTheMask);
Vue.use(VueGoodTablePlugin);

Vue.mixin(Roles);

Vue.component("home", Home);
Vue.component("sidebar", SideBar);
Vue.component("bottom-tab", BottomTab);
Vue.component("profile-button", ProfileButton);
Vue.component("back-button", BackButton);
Vue.component("loader", Loader);
Vue.component("footer-component", Footer);
Vue.component("login", Login);

Vue.component("step-0", Step0);
Vue.component("step-1", Step1);
Vue.component("step-2", Step2);
Vue.component("step-3", Step3);
Vue.component("step-4", Step4);
Vue.component("step-5", Step5);

Vue.component("add-operational-unit-step-1", FormStep1);
Vue.component("add-operational-unit-step-2", FormStep2);
Vue.component("add-operational-unit-step-3", FormStep3);
Vue.component("add-operational-unit-step-4", FormStep4);
Vue.component("add-operational-unit-step-5", FormStep5);
Vue.component("add-operational-unit-step-6", FormStep6);

Vue.component("edit-operational-unit-step-1", EditFormStep1);
Vue.component("edit-operational-unit-step-2", EditFormStep2);
Vue.component("edit-operational-unit-step-3", EditFormStep3);
Vue.component("edit-operational-unit-step-4", EditFormStep4);
Vue.component("edit-operational-unit-step-5", EditFormStep5);
Vue.component("edit-operational-unit-step-6", EditFormStep6);

Vue.component('l-map', window.Vue2Leaflet.LMap);
Vue.component('l-tile-layer', window.Vue2Leaflet.LTileLayer);
Vue.component('l-marker', window.Vue2Leaflet.LMarker);
Vue.component('l-icon', window.Vue2Leaflet.LIcon);

Vue.component("multiselect", Multiselect);

const app = new Vue({
	router,
	el: "#app"
});
