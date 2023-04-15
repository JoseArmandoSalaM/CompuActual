import './bootstrap';
import Oruga from '@oruga-ui/oruga-next'
import '@oruga-ui/oruga-next/dist/oruga.css'
import '@oruga-ui/oruga-next/dist/oruga-full.css'

import { createApp } from "vue";

const app = createApp({});

//import Progress from "./components/OrderProgress.vue";
import auto from "./components/autorizacion.vue";
import image from "./components/imagen.vue";

//------
import ProyectoNew from './components/ProyectoNew.vue';
import Diagnostico from './components/Diagnostico.vue';
import Autorizar from './components/Autorizar.vue';

app.component('diagnostico', Diagnostico);
app.component('autorizar', Autorizar);
app.component('example-component', ProyectoNew);
//--------

//app.component('progress-vue', Progress);
app.component('auto', auto);
app.component('imagen', image).use(Oruga);

app.mount('#app');



const app2 = createApp({});
import Progress from "./components/OrderProgress.vue";

app2.component('progress-vue', Progress);
app2.mount('#app2');