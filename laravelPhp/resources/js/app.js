/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
window.Vue.config.devtools = true;
window.Vue.config.debug = true;
window.Vue.config.silent = false;



/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

Vue.component('ChatApp', require('./components/ChatApp.vue').default);


/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});



/**
 * 
 * 
 * 
 */

 
// Barba.Pjax.start();

// do not import Barba like this if you load the library through the browser
import barba from '@barba/core';

// define a global hook
barba.hooks.leave((data) => {
    // this hook will be called for each transitions
  });

// barba.init(

//     {
//         transitions: [
//           {
//             name: 'svg-circle',
//             leave(data) {
//               // retrieve the current page url
//               const from = data.current.url;
//             },
//             enter({ next }) {
//               // retrieve the next page url (short syntax)
//               const to = next.url;
//             },
//           },
//         ],
//       }

// );
