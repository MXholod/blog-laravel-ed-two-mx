<template>
	<div class="views">
		<slot name="views" v-if="viewsUpdated === viewsNumber"></slot>
		<span v-else class="badge bg-danger">
			{{ viewsNumber }}		
			<i class="far fa-eye"></i>
		</span>
	</div>
</template>

<script>
export default{
	data(){
		return {
			viewsUpdated: 0
		}
	},
	computed: {
		viewsNumber(){
			//return this.$store.getters.articleViews;
			return this.$store.state.article.statistics.views;
		}
	},
	created(){
		//Get slug
		let url = window.location.pathname;
		let slug = url.substring(url.lastIndexOf('/')+1);
		//Initialize 
		this.$store.commit("SET_SLUG", slug);
		this.$store.dispatch("actionViews", slug);
	},
	mounted(){
		this.viewsUpdated = this.viewsNumber;
	}
}
</script>

<style scoped>
.views{
	display:inline-block;
}
</style>