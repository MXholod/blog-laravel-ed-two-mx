require('./bootstrap');
import Vue from 'vue';

import store from './store';
//Load components by root sections: Header, Sidebar, Content, Footer
import Content from './components/Content.vue';
import ArticleViews from './components/ArticleViews.vue';
import ArticleLikes from './components/ArticleLikes.vue';

const app = new Vue({
    el: '#app',
	store,
    components: { 
		MxContent: Content,
		ArticleViews,
		ArticleLikes
	},
	/*created(){
		//Get slug
		let url = window.location.pathname;
		let index = url.lastIndexOf('/')+1;
		let slug = url.substring(index);
		//Initialize 
		//this.$store.commit("SET_SLUG", slug);
		//this.$store.dispatch("actionViews", slug);
	}*/
});
