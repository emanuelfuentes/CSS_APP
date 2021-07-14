
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
Vue.component('recordatorio', require('./components/Recordatorio.vue'));
Vue.component('perfil', require('./components/Perfil.vue'));
Vue.component('historial-proyectos', require('./components/ProyectosHistorial.vue'));
Vue.component('todos-proyectos', require('./components/ProyectosDisponibles.vue'));
Vue.component('mis-proyectos', require('./components/ProyectosAplicados.vue'));
Vue.component('admin-proyectos', require('./components/ProyectosAdmin.vue'));
Vue.component('admin-estudiantes', require('./components/EstudiantesAdmin.vue'));
Vue.component('spinner', require('./components/Spinner.vue'));
Vue.component('table-loader', require('./components/TableLoader.vue'));


const app = new Vue({
    el: '#app',
    data :{
        menu: 0,
        amenu: 0
    }
});
