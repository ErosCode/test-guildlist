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
            axios.get('api/char/' + this.id)
            .then( response => {
                this.char = response.data
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