	
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
import VModal from 'vue-js-modal'





require('vue-toastr/src/vue-toastr.scss');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('latex-editor', require('./components/LatexEditor.vue').default);
Vue.component('platex', require('./components/LatexParagraph.vue').default);
Vue.component('mark-as-read', require('./components/MarkAsRead.vue').default);
Vue.component('rate-wiki', require('./components/RateWiki.vue').default);
Vue.component('practice-problems', require('./components/PracticeProblems.vue').default);
Vue.component('new-thread', require('./components/NewThread.vue').default);
Vue.component('edit-thread', require('./components/EditThread.vue').default);
Vue.component('thread-reply', require('./components/ThreadReply.vue').default);
Vue.component('book-chapter', require('./components/BookChapter.vue').default);
Vue.component('course-problem', require('./components/CourseProblem.vue').default);
Vue.component('course-section', require('./components/CourseSection.vue').default);
Vue.component('wiki-problems', require('./components/WikiProblems.vue').default);

Vue.use(PortalVue)
Vue.use(Toastr);
Vue.use(require('vue-moment').default);
Vue.use(VModal);


const app = new Vue({

    el: '#app',

    components: {
    	'vue-core-image-upload': VueCoreImageUpload,
	},

	data() {
	    return {
	      src: 'http://img1.vued.vanthink.cn/vued0a233185b6027244f9d43e653227439a.png',
	      showSidebar: true
	    }
	},



	methods: {

	    imageuploaded(res) {
	    	// console.log(res);
	        insertAtCaret('![alt text]('+ res.src + ' "Image Title")');

	    },

	     showModal (name) {
   			 this.$modal.show(name);
		  },
		  hideModal () {
		    this.$modal.hide(name);
		  },

		  openUrl(url)
		  {
		  	window.location = url;
		  }
	}
});




