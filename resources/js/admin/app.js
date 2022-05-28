require('./../bootstrap');
import Vue from 'vue';

//Load components by root sections: Header, Sidebar, Content, Footer
import Content from './../components/admin/Content.vue';

const app = new Vue({
    el: '#app',
    components: { MxContent: Content }
});
console.log("Admin");
