import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();


import { createApp } from 'vue';
import ExampleComponent from './ExampleComponent.vue';
import TestComponent from './TestComponent.vue';
import DatabseComponent from './DatabseComponent.vue';
const app = createApp();
app.component('example-component', ExampleComponent);
app.component('databse-component', DatabseComponent);
app.component('test-component', TestComponent);
app.mount('#app');