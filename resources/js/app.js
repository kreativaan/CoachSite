console.log('Vue is working!');

import Alpine from 'alpinejs';
window.Alpine = Alpine;
Alpine.start();
import './bootstrap';
import { createApp } from 'vue';

import Servises from './components/Servises.vue';
import TrainerProfile from './components/TrainerProfile.vue';
import ContactForm from './components/ContactForm.vue';
import NavBar from './components/NavBar.vue';
import BlogForm from './components/BlogForm.vue';
import BlogList from './components/BlogList.vue';
import BlogPost from './components/BlogPost.vue';
import EditPost from './components/EditPost.vue';
import BlogPreview from './components/BlogPreview.vue';

const app = createApp({});

app.component('services', Servises);
app.component('trainer-profile', TrainerProfile);
app.component('contact-form', ContactForm);
app.component('nav-bar', NavBar);
app.component('blog-form', BlogForm);
app.component('blog-list', BlogList);
app.component('blog-post', BlogPost);
app.component('edit-post', EditPost);
app.component('blog-preview', BlogPreview);

app.mount('#app');
