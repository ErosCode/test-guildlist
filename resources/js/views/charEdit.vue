<template>
    <div class="charEditContainer">
        <h5>Modifier un personnage</h5>
        <char-detail :char="char" :id="id" :armors="armors" :classes="classes" :races="races" :specs="specs"/>
    </div>
</template>

<script>
import charDetail from './charDetail';

export default {
    props: ['id'],
    components: { charDetail },
    data() {
      return {
          char: [],
          races: [],
          armors: [],
          classes: [],
          specs: [],
      }
    },
    methods: {
        getChar () {
            axios.get('http://localhost/api/char/' + this.id)
            .then( response => {
                this.char = response.data
            })
            .catch( error => {
                console.log( error );
            })
        },
        getRaces () {
            axios.get('http://localhost/api/races')
            .then( response => {
                this.races = response.data
            })
            .catch( error => {
                console.log( error );
            })
        },
        getClasses () {
            axios.get('http://localhost/api/classes')
            .then( response => {
                this.classes = response.data
            })
            .catch( error => {
                console.log( error );
            })
        },
        getSpecs () {
            axios.get('http://localhost/api/specs')
            .then( response => {
                this.specs = response.data
            })
            .catch( error => {
                console.log( error );
            })
        },
        getArmors () {
            axios.get('http://localhost/api/armors')
            .then( response => {
            this.armors = response.data
            })
            .catch( error => {
                console.log( error );
            })
        },
    },
    created () {
        this.getChar();
        this.getArmors();
        this.getRaces();
        this.getClasses();
        this.getSpecs();
    },
        
}

</script>

<style>
    .charEditContainer {
        border: 1px solid grey;
        border-radius: 20px;
        margin: 1em;
        padding: 2em;
    }
</style>