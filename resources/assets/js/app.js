import Vue from 'vue';

/**
 * First we will load all of this project's JavaScript dependencies which
 * include Vue and Vue Resource. This gives a great starting point for
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
require('./keyboard');
require('./click');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

import Buttons from './components/Buttons.vue';
import Button from './components/Button.vue';

Vue.component('buttons', Buttons);
Vue.component('button', Button);

const app = new Vue({
    el: '#app'
});