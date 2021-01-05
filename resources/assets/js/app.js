
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

//Vue.component('student-dashboard',require('./components/Estudiante.vue'));
//Vue.component('admin-dashboard', require('./components/Admin.vue'));
Vue.component('todos-proyectos', require('./components/ProyectosDisponibles.vue'));
const app = new Vue({
    el: '#app',
    data :{
        menu: 0,
        amenu: 0
    }
});
