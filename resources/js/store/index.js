import Vue from 'vue';
import Vuex from 'vuex';
Vue.use(Vuex);

export default new Vuex.Store({
	state:{
		article:{
			statistics:{
				views: 0,
				likes: 0
			},
			slug:''
		}
	},
	actions:{
		actionViews(context, payload){
			let domen = window.location.protocol+'//'+window.location.host;
			let uri = domen+"/api/article-views";
			setTimeout(()=>{
				window.axios.put(uri, { slug: payload })
					.then((response)=>{
						context.commit('SET_ARTICLE_VIEWS', response.data.statistics);
					})
					.catch((e)=>{
						console.log("Error!!! ",e);
					});
			},5000);
		},
		actionLikes(context, payload){
			let domen = window.location.protocol+'//'+window.location.host;
			let uri = domen+"/api/article-likes";
			setTimeout(()=>{
				window.axios.put(uri, { userId: payload.userId, slug: payload.slug })
					.then((response)=>{
						context.commit('SET_ARTICLE_LIKES', response.data.statistics);
					})
					.catch((e)=>{
						console.log("Error!!! ",e);
						result = false;
					});
			},3000);
		}
	},
	mutations:{
		SET_ARTICLE_VIEWS(state, payload){
			return state.article.statistics.views = payload.views;
		},
		SET_ARTICLE_LIKES(state, payload){
			return state.article.statistics.likes = payload.likes;
		},
		SET_SLUG(state, payload){
			return state.article.slug = payload;
		}
	},
	getters:{
		articleViews(state){
			return state.article.statistics.views;
		},
		articleLikes(state){
			return state.article.statistics.likes;
		}
	}
});

