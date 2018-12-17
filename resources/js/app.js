
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
window.FilePond = require('../../node_modules/filepond');
window.FilePondPluginImagePreview = require('../../node_modules/filepond-plugin-image-preview');
//import * as FilePond from '../../node_modules/filepond';

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

Vue.component('example-component', require('./components/ExampleComponent.vue'));

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key)))

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app'
});

FilePond.registerPlugin(
	FilePondPluginImagePreview
	);

const inputElement = document.querySelector('input[type="file"]');
const pond = FilePond.create( 
	inputElement,
	{
		allowImagePreview: true
	} 
);
            
FilePond.setOptions({
    server: {
        url: '/upload',
        process: {
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        }
    }
});

/*const sharp = require('sharp');
const inputFile = document.getElementById('#imageUpload').value;

let width = 100;
let height = 100;
let fileName = inputFile.split(/(\\|\/)/g).pop();

sharp(inputFile).resize(width, height).toFile('storage/app/thumb'+fileName, function(err){
    if(!err) {
        console.log('Sharp funktoniert');
    } else {
        console.log(err);
    }
});*/

