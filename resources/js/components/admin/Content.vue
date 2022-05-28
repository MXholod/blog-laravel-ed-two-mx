<template>
  <div class="my-vue">
    <div v-if="!!commentsLeft && commentDeletion">
		<div class="comments-block">
			<ul class="list-group">
				<li v-for="comment of allComments" :key="comment.id" class="list-group-item">
					<div><b>User: </b>{{ comment.user_name }}</div>
					<div>
						<b>Subject: </b>
						{{ comment.subject }}
					</div>
					<div><b>Comment: </b>{{ comment.body }}</div>
					<div class="edit-delete-block">
						<div class="edit-delete-block__panel" 
							:class="comment.edit ? 'edit-delete-block__panel-show' : 'edit-delete-block__panel-hide'">
							<div>
								<span>{{ comment.user_warning === 0 ? 'Warn user?' : 'User warned' }}</span>
								<i v-if="comment.loaderChangeState" class="bi bi-flower3 rotate-before-data"></i>
								<div v-if="comment.errorApi" class="api-error">Something went wrong...</div>
							</div>
							<div>
								<button type="button"
									v-bind:style="{ backgroundColor: comment.user_warning === 0 ? 'lime' : 'pink' }"
									@click="function(){ changeStatus(comment.id) }"
									:disabled="comment.loaderChangeState"
								>
									{{ comment.user_warning === 0 ? 'Accept' : 'Decline' }}
								</button>
								<button type="button" @click="()=>closeEditComment(comment.id)">
									Close
								</button>
							</div>
						</div>
						<span>Warn user: </span>
						<button @click="()=>editComment(comment.id)"
							:disabled="comment.loaderChangeState"
						>
							<i class="bi bi-pencil-fill"
								:class="comment.loaderChangeState ? 'icon-transparent' : ''"></i>
						</button>
						<button @click="()=>deleteComment(comment.id)"
							:disabled="comment.loaderChangeState"
						>
							<i class="bi bi-trash-fill"
								:class="comment.loaderChangeState ? 'icon-transparent' : ''"></i>
						</button>
					</div>
				</li>
			</ul>
			<div class="loader" :class="loader ? 'loader-show' : 'loader-hide'">
				<i class="bi bi-flower3"></i>
			</div>
			<Pagination 
				:paginateTotal="commentsLeft" 
				:paginatePortion="paginate"
				:pagesLimit="5"
				@getPage="displayPage"			
			/>
		</div>
	</div>
	<div v-else>
		<h3>Comments are absent</h3>
	</div>
  </div>
</template>

<script>
import Pagination from './Pagination.vue';
export default {
  props: {
	comments: { type: Array, default: function(){ return [] } },
	paginate: { type: Number, default: 1 }
  },
  components:{
	Pagination
  },
  computed: {
	commentDeletion(){
		if(this.commentsLeft > 0 && this.allComments.length === 0){
			//Calculate amount of pages
			let allPages = Math.ceil(this.commentsLeft / this.paginate);
			let startIndex = (allPages * 5) - this.paginate;
			let endIndex = (allPages * 5);
			//Rewrite all comments on the current page
			this.allComments = this.comments.slice(startIndex, endIndex);
			return true;
		}
		return !!this.commentsLeft;
	}
  },
  data() {
      return {
		allComments: [],
	    edit: false,
        loader: false,
		commentsLeft: 0, // Number of comments on the article left after deletion
      }
  },
  methods: {
	editComment(id){
		this.allComments = this.allComments.map((comment)=>{
			if(comment.id === id){
				comment.edit = true;
			}
			return comment;
		});
	},
	closeEditComment(id){
		this.allComments = this.allComments.map((comment)=>{
			if(comment.id === id){
				comment.edit = false;
				comment.errorApi = false;
			}
			return comment;
		});
	},
	displayPage(pageData){
		this.commentDeletion;
		this.loader = true;
		setTimeout(()=>{
			this.loader = false;
			this.allComments = this.comments.slice(pageData.start, pageData.end);
		},1500);
	},
	async changeStatus(comId){
		//
		this.allComments = this.allComments.map(function(comment){
			if(comment.id === comId){
				comment.loaderChangeState = true;
			}
			return comment;
		});
		let domen = window.location.protocol+"//"+window.location.host;
		// 
		let url = domen+"/api/article-comments/"+comId;
		try{
			let response = await window.axios.patch(url);
			if(response && response.status === 200){
				window.setTimeout(function(){
					this.allComments = this.allComments.map(function(comment){
						if(comment.id === comId){
							comment.user_warning = comment.user_warning === 0 ? 1 : 0;
							comment.loaderChangeState = false;
						}
						return comment;
					});
				}.bind(this),2000);
			}
		}catch(e){
			this.allComments = this.allComments.map(function(comment){
				if(comment.id === comId){
					comment.errorApi = true;
					comment.loaderChangeState = false;
				}
				return comment;
			});
		}
	},
	async deleteComment(comId){
		if(!window.confirm("Delete this comment?")){
			return false;
		}
		this.allComments = this.allComments.map(function(comment){
			if(comment.id === comId){
				comment.loaderChangeState = true;
			}
			return comment;
		});
		let domen = window.location.protocol+"//"+window.location.host;
		// 
		let url = domen+"/api/article-comments/"+comId;
		try{
			let response = await window.axios.delete(url);
			if(response && response.status === 200){
				window.setTimeout(function(){
					this.allComments = this.allComments.filter(function(comment){
						if(comment.id === comId){
							return false;
						}
						return true;
					});
					//Get the number of comments left
					this.commentsLeft = response.data.comments.totalComments;
				}.bind(this),2000);
			}
		}catch(e){
			//console.log(e);
			window.alert("Something went wrong...");
			this.allComments = this.allComments.map(function(comment){
				if(comment.id === comId){
					comment.loaderChangeState = false;
				}
				return comment;
			});
		}
	}
  },
  created(){
	//Add 'edit' property to all comments
	this.comments.forEach((comment, i)=>{
		this.$set(this.comments[i], 'edit', false);
		this.$set(this.comments[i], 'loaderChangeState', false);
		this.$set(this.comments[i], 'errorApi', false);
	});
	if(this.comments.length !== 0){
		this.allComments = this.comments.slice(0,(this.paginate));
		//The rest of comment initialized as comments length
		this.commentsLeft = this.comments.length;
	}
  }
};
</script>

<style lang="scss" scoped>
.edit-delete-block{
	position: relative;
}
.edit-delete-block__panel-show{
	display:flex;
}
.edit-delete-block__panel-hide{
	display:none;
}
.edit-delete-block__panel{
	position: absolute;
	top:-100%;
	left:0;
	width:40%;
	height:50px;
	background-color:#f6f6f6;
	border: 2px solid lightgrey;
	& div:first-child{
		flex-basis:70%;
		padding-left:5px;
		position: relative;
		.api-error{
			position: absolute;
			top:55%;
			font-size:.9em;
			color: red;
			padding-left:5px;
		}
	}
	& div:last-child{
		flex-basis:30%;
		display:flex;
		flex-direction:column;
		& button:first-child{
			font-size:.8em;
			&:disabled{
				opacity:.6;
			}
		}
		& button:last-child{
			font-size:.8em;
			background-color: #e73646;
			color:#fff;
			margin-top: 8px;
		}
	}
}
.comments-block{
	position:relative;
}
@keyframes rotateIt{
	0% { transform: rotate(0deg); }
	50% { transform: rotate(90deg); }
	100% { transform: rotate(180deg); }
}
.loader{
	position:absolute;
	top:0;
	left:0;
	right:0;
	bottom:0;
	background-color:rgba(0,0,0, .5);
	display:flex;
	justify-content:center;
	align-items:center;
	z-index:999;
	i{
		font-size:3em;
		color:#000;
		animation-name: rotateIt;
		animation-duration: 1s;
		animation-iteration-count: infinite;
		animation-direction: normal;
		animation-timing-function: linear;
	}
}
.loader-show{
	visibility:visible;
}
.loader-hide{
	visibility:hidden;
}
.rotate-before-data{
	display:block;
	position:relative;
	top:-10px;
	left:50%;
	width:10px;
	height:10px;
	transform-origin: 50% 50% 0;
	animation-name: rotateIt;
	animation-duration: 1s;
	animation-iteration-count: infinite;
	animation-direction: normal;
	animation-timing-function: linear;
	&:before{
		transform: translate(-20%, -45%);
	}
}
.icon-transparent{
	color: rgba(0,0,0, .6);
}
</style>
