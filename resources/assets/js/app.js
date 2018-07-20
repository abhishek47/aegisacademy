
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');


import VueCoreImageUpload from 'vue-core-image-upload';
import PortalVue from 'portal-vue'
import Toastr from 'vue-toastr';

require('vue-toastr/src/vue-toastr.scss');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('example-component', require('./components/ExampleComponent.vue'));
Vue.component('latex-editor', require('./components/LatexEditor.vue'));
Vue.component('platex', require('./components/LatexParagraph.vue'));

Vue.use(PortalVue)
Vue.use(Toastr);


const app = new Vue({

    el: '#app',

    components: {
    	'vue-core-image-upload': VueCoreImageUpload,
	},
	  
	data() {
	    return {
	      src: 'http://img1.vued.vanthink.cn/vued0a233185b6027244f9d43e653227439a.png',
	    }
	},
	
	methods: {
	
	    imageuploaded(res) {
	    	console.log(res);
	        insertAtCaret('![alt text]('+ res.src + ' "Image Title")');
	      
	    },

	}
});




