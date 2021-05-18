<template>
    <div class="charsListContainer">
        <div class="heading">
            <h2 class="title">Liste des personnages</h2>
            <add-char-form :races="races" :armors="armors" :classes="classes" :specs="specs" />
            <list-view :chars="chars" />
        </div>
    </div>
</template>

<script>
import addCharForm from "./addCharForm"
import listView from "./listView"

export default {
    components: {
        addCharForm,
        listView
    },
    data () {
        return {
           chars: [],
           races: [],
           armors: [],
           classes: [],
           specs: [],
        }
    },
    methods: {
        getChars () {
            axios.get('api/chars')
            .then( response => {
                this.chars = response.data
            })
            .catch( error => {
                console.log( error );
            })
        },
        getArmors () {
            axios.get('api/armors')
            .then( response => {
                this.armors = response.data
            })
            .catch( error => {
                console.log( error );
            })
        },
        getRaces () {
            axios.get('api/races')
            .then( response => {
                this.races = response.data
            })
            .catch( error => {
                console.log( error );
            })
        },
        getClasses () {
            axios.get('api/classes')
            .then( response => {
                this.classes = response.data
            })
            .catch( error => {
                console.log( error );
            })
        },
        getSpecs () {
            axios.get('api/specs')
            .then( response => {
                this.specs = response.data
            })
            .catch( error => {
                console.log( error );
            })
        }
    },
    created () {
        this.getChars();
        this.getArmors();
        this.getRaces();
        this.getClasses();
        this.getSpecs();
    }
    
}

</script>
<style>
   .title {
       margin-top: 2em;
       text-align: center;
   }
   .btn-options {
       margin-top: 1em;
   }
</style>    