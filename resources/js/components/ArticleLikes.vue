<template>
	<div class="likes" 
		:class="elementDisable ? 'disable-elem' : ''" 
		:disabled="elementDisable"
		@click="changeLikeState"	
	>
			<slot name="likes" v-if="!likesUpdated"></slot>
			<span v-else class="badge bg-primary" >
				{{ likesNumber }}
				<i class="far fa-thumbs-up"></i>
			</span>
	</div>
</template>

<script>
export default {
	props:{
		user: null,
		likes: { type: Number }
	},
	data(){
		return {
			likesUpdated: false,
			elementDisable: false
		}
	},
	computed: {
		likesNumber(){
			return this.$store.getters.articleLikes;
		},
		articleSlug(){
			return this.$store.state.article.slug;
		}
	},
	methods:{
		changeLikeState(){
			if(!this.elementDisable){
				//Disable clicked element
				this.elementDisable = true;
				const data = {userId : this.user.userId, slug: this.articleSlug };
				//Update article state
				this.$store.dispatch("actionLikes", data);
				setTimeout(()=>{
					//Enable clicked element
					this.elementDisable = false;
				},3000);
			}
			if(this.likesUpdated === false){
				this.likesUpdated = true;
			}
		}
	},
	created(){
		//Get slug
		let url = window.location.pathname;
		let slug = url.substring(url.lastIndexOf('/')+1);
		//Initialize slug 
		this.$store.commit("SET_SLUG", slug);
		//Initialize likes
		this.$store.commit("SET_ARTICLE_LIKES", { likes: this.likes });
	}
}
</script>

<style scoped>
.likes{
	display:inline-block;
}
.disable-elem{
	opacity:0.7!important;
}
</style>