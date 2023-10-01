import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();


import { createApp } from 'vue';
import ExampleComponent from './ExampleComponent.vue';

const app = createApp();
app.component('example-component', ExampleComponent);
app.mount('#app');