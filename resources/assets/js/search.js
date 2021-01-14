/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

const { default: Axios } = require('axios');

require('./../../js/bootstrap');

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */


const app = new Vue({
    el: '#search_form_area',
    data: {
       tournament_id: '0',
       knockout_id: '0',
       group_id: '',
       team_id: '',
       outcome: '',
       isDisplay: 'none',
       isDisplay2: 'none',
       isDisplay3: 'none',

       teams: 'test',
       groups: 'test',

       gmap: null,
       marker: []
    },

    mounted: async function () {
        await this.sleep(1000);   // wait until loading google map javascript
        this.gmap = new google.maps.Map(document.getElementById("map"), {
            center: { lat: 0, lng: 0 },
            zoom: 1
        });
    },

    methods: {
        knockoutChange: function(){
            if(this.knockout_id == 2){
            this.isDisplay = 'block';
            }else{
                this.isDisplay='none';
            }
        },

        outcomeChange: function(){
            if(this.team_id != "0"){
                this.isDisplay2 = 'block';
            }else{
                this.isDisplay2 = 'none';
        }
     },
        tournamentChange: function(){
            if(this.tournament_id != "0"){
                this.isDisplay3 = 'block';
            }else{
                this.isDisplay3 = 'none';
            }
        },
        updateTeams: async function(){
            //選択した大会名に応じてチームタブを動的に変化させる。
            var t_id = this.tournament_id;
            var k_id = this.knockout_id;
            let url = `/ui/search/update_Teams/${t_id}/${k_id}`;
            let result = await axios.get(url); //resultはjsonデータになっている
            this.teams = result.data;
            
        }, 

        updateGroups: async function(){
            var t_id = this.tournament_id;
            let url = `/ui/search/update_Groups/${t_id}`;
            let result = await axios.get(url);
            this.groups = result.data;
            
        },

        sleep: function (msec) {
            return new Promise((resolve) => {
                setTimeout(() => { resolve() }, msec);
            })
        },
    }
    
});

