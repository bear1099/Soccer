//require('./bootstrap');
import './bootstrap'
import Vue from 'vue'
import './../assets/js/components/HelloWorldPropsComponent'

const app = new Vue({
    el: '#app',
    components:{
        HelloWorldPropsComponent,
    }
})