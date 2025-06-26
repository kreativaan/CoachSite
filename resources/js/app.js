console.log('Vue is working!');

import './bootstrap';
import { createApp } from 'vue';
import ExampleComponent from './components/ExampleComponent.vue';
import TrainerProfile from './components/TrainerProfile.vue';

const app = createApp({});
app.component('trainer-profile', TrainerProfile);
app.component('example-component', ExampleComponent);
app.mount('#app');
