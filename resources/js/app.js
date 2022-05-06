import { createApp } from "vue";
import App from './App.vue';
import router from "./router";
import store from './store';
import Toast from "vue-toastification";

import { library } from "@fortawesome/fontawesome-svg-core";
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'
import { faCompass, faPlusSquare, faHeart, faComment } from '@fortawesome/free-regular-svg-icons'
import { faGripVertical } from '@fortawesome/free-solid-svg-icons'

import "vue-toastification/dist/index.css";

library.add(faCompass)
library.add(faPlusSquare)
library.add(faHeart)
library.add(faComment)
library.add(faGripVertical)

const app = createApp(App)

app.component('font-awesome-icon', FontAwesomeIcon)

app.use(router)
app.use(store)
app.use(Toast)
app.mount('#app');

require('./bootstrap')