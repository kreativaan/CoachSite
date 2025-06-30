console.log('Vue is working!');

import './bootstrap';
import { createApp } from 'vue';
import ExampleComponent from './components/ExampleComponent.vue';
import TrainerProfile from './components/TrainerProfile.vue';
import ContactForm from './components/ContactForm.vue';
import NavBar from './components/NavBar.vue';
import BlogForm from './components/BlogForm.vue';
import BlogList from './components/BlogList.vue';
import BlogPost from './components/BlogPost.vue';
import EditPost from './components/EditPost.vue';
import BlogPreview from './components/BlogPreview.vue';

const app = createApp({});
app.component('blog-preview', BlogPreview)
app.component('edit-post', EditPost)
app.component('blog-post', BlogPost)
app.component('blog-list', BlogList)
app.component('blog-form', BlogForm);
app.component('nav-bar', NavBar);
app.component('trainer-profile', TrainerProfile);
app.component('example-component', ExampleComponent);
app.component('contact-form', ContactForm);
app.mount('#app');
