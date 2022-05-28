<template>
	<div>
		<ul class="list" v-if="pagesLimit >= 1">
			<li class="list__item_arrow list__item_lt-arrow"
				@click="goWithArrow('left')"
			>
				<i class="bi bi-caret-left-fill"></i>
			</li>
			<li v-for="(item,index) of list" :key="index" 
				class="list__item" 
				@click="turnThePage(((index+1)+cursor))"
			>
				{{ ((index+1)+cursor) }}
				<div :class="((index+1)+cursor) === currentPage ? 'list__item_active': ''"></div>
			</li>
			<li class="list__item_arrow list__item_rt-arrow"
				@click="goWithArrow('right')"
			>
				<i class="bi bi-caret-right-fill"></i>
			</li>
		</ul>
		<div v-else class="list-incorrect">
			Incorrect data for the pagination
		</div>
	</div>
</template>

<script>
export default{
	props:{
		paginateTotal: { type: Number },
		paginatePortion: { type: Number },
		pagesLimit: { type: Number, default: 1 }
	},
	computed:{
		//The number of buttons where each button goes to a page
		list(){
			let totalPages = Math.ceil(this.paginateTotal / this.paginatePortion);
			//If data is for one page only
			if(this.paginateTotal > 0 && this.paginateTotal <= this.paginatePortion){
				return 1;
			}//If the number of pages is less than the default
			else if(this.pagesLimit > totalPages){
				return totalPages;
			}
			else{
				//Default value
				return this.pagesLimit;
			}
		}
	},
	data(){
		return {
			currentPage:1,
			cursor:0
		}
	},
	methods:{
		turnThePage(currentPage){
			this.currentPage = currentPage;
			//Calculate start and end indexes
			let end = (this.currentPage * this.paginatePortion); 
			let start = end - this.paginatePortion;
			//Emit 'getPage' event to the parent component
			this.$emit('getPage', { start, end });
		},
		goWithArrow(arrow){
			//left arrow
			if(arrow === "left"){
				this.currentPage = this.currentPage === 1 ? 1 : this.currentPage - 1;
				//
				if(this.currentPage >= 1 && this.cursor !== 0){
					this.cursor -=1;
				}
				//console.log("Left page ",this.currentPage);
			}else{//right arrow
				const totalPages = Math.ceil(this.paginateTotal / this.paginatePortion);
				//Calculate the current page, if it last or not
				this.currentPage = this.currentPage === totalPages ? totalPages : this.currentPage + 1;
				//If the page exceeds the limit of pages: 7 or 6 > 5
				if(this.currentPage > this.pagesLimit){
					//If cursor less than difference of total pages: 0 < (7 - 5) 
					if(this.cursor < (totalPages - this.pagesLimit)){
						this.cursor += 1;
					}
				}
			}
			//Calculate start and end indexes
			let end = (this.currentPage * this.paginatePortion); 
			let start = end - this.paginatePortion;
			//Emit 'getPage' event to the parent component
			this.$emit('getPage', { start, end });
		}
	}
}
</script>

<style lang="scss" scoped>
.list{
	border:1px solid #000;
	border-radius:5px;
	background-image: linear-gradient(180deg, #99aedf, #b7b7df);
	width:30%;
	padding: .5%;
	margin: 10px auto;
	text-align:center;
}
%paginate-item{
	display:inline-block;
	padding:1% 3%;
	border:1px solid #000;
	border-radius:4px;
	margin:0 .8%;
	color:#f6f6f6;
	background-color:#7171e3;
	text-align:center;
}
.list__item{
	@extend %paginate-item;
	position:relative;
	&:hover, &:active{
		background-color:lighten(#7171e3, 10%);
		cursor:pointer;
	}
}
.list__item_active{
	background-color:lighten(#7171e3, 20%);
	position:absolute;
	top:0;
	left:0;
	opacity:0.5;
	height:100%;
	width:100%;
}
.list__item_arrow{
	@extend %paginate-item;
	position:relative;
	transition: all .5s linear;
	&:hover{
		cursor:pointer;
	}
}
.list__item_lt-arrow{
	left:0px;
	&:active{
		background-color:darken(#7171e3, 5%);
		left:-5px;
		cursor:pointer;
	}
}
.list__item_rt-arrow{
	right:0px;
	&:active{
		background-color:darken(#7171e3, 5%);
		right:-5px;
		cursor:pointer;
	}
}
.list-incorrect{
	text-align:center;
	color:red;
}
</style>