<template>
    <div class="table-responsive div-table">
    <table class="table table-striped table-bordered">
        <thead class="table-header">
            <tr>
            <th scope="col">Pseudo</th>
            <th scope="col">Race</th>
            <th scope="col">Armure</th>
            <th scope="col">Classe</th>
            <th scope="col">Spécialisation</th>
            <th scope="col">Propriétaire</th>
            <th scope="col">Détail</th>
            <th scope="col">Options</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="char in chars" :key="char.id">
                <td class="randomColors">{{char.char_pseudo}}</td>
                <td v-bind:class="getClass(char.classe)">{{char.race}}</td>
                <td v-bind:class="getClass(char.classe)">{{char.armor}}</td>
                <td v-bind:class="getClass(char.classe)">{{char.classe}}</td>
                <td v-bind:class="getClass(char.classe)">{{char.spec}}</td>
                <td v-bind:class="getClass(char.classe)">{{char.proprietaire}}</td>
                <td v-bind:class="getClass(char.classe)">{{getClassMethod(char.classe, char.spec)}}</td>
                <td><router-view name="char"/>
                <button class="btn-edit">
                    <router-link :to="{name: 'detail', params: { id: char.id }}">Modifier</router-link>
                    <font-awesome-icon icon="edit" />
                </button>
                    /
                    <button @click="deleteChar(char.id)" class="btn-delete">
                        Supprimer 
                        <font-awesome-icon  class="trashcan" icon="trash" />
                    </button>
                </td>
            </tr>
        </tbody>
    </table>
    </div>
</template>
<script>

export default {
    props: ['chars'],
    methods: {
        deleteChar(id) {
            axios.delete('api/char/' + id )
            .then( response => {
                if( response.status == 200 ) {
                    this.$parent.getChars();
                    console.log(response)
                }
            })
            .catch( error => {
                console.log( error );
            })
        },
        getClass (charClass) {
            if(charClass === 'Guerrier'){
                return 'warClass'
            }
            if(charClass === 'Mage'){
                return 'bg-info'
            }
            if(charClass === 'Prêtre'){
                return 'bg-light'
            }
            if(charClass === 'Chasseur'){
                return 'bg-success'
            }
        },
        getClassMethod (charClass, charSpec) {
            if( charClass === 'Guerrier'){
                console.log('bjr')
                return this.Cri_de_guerre(charClass, charSpec)
            }            
            if( charClass === 'Mage'){
                console.log('bjr')
                return this.Cri_de_guerre(charClass, charSpec)
            }
            if( charClass === 'Prêtre'){
                console.log('bjr')
                return this.Cri_de_guerre(charClass, charSpec)
            } 
            if( charClass === 'Chasseur'){
                console.log('bjr')
                return this.Cri_de_guerre(charClass, charSpec)
            }
        },
        Cri_de_guerre(charClass, charSpec) {
            console.log('coucou')
            return 'Je suis un ' + charClass +' avec la spécialisation ' +charSpec;
        },
        Murmure_de_magie(charClass, charSpec) {
            return 'Je suis un ' + charClass +' avec la spécialisation ' +charSpec;
        },
        Hymne_divin(charClass, charSpec) {
            return 'Je suis un ' + charClass +' avec la spécialisation ' +charSpec;
        },
        Hurlement_de_la_bête(charClass, charSpec) {
            return 'Je suis un ' + charClass +' avec la spécialisation ' +charSpec;
        },
        getRandomColors () {
            setTimeout(()=> {
                var par = document.querySelectorAll(".randomColors");
                var colors = ["red", "blue", "green", "orange", "black", "grey"];
                for (let i = 0; i < par.length; i++) {
                    par[i].innerHTML = par[i].innerHTML.split('').map(function(c) {
                    return "<span class='" + colors[Math.floor(Math.random() * colors.length)] + 
                    "'" + ">" + c + "</span>"
                }).join('');
                }
            }, 200)
        },
    },
    created() {
        this.getRandomColors();
    }
}
</script>
<style>
    table > tbody > tr> td.warClass {
         background-color: #A52A2A;
    }
    table > tbody > tr:nth-child(3) > td.mageClass {
        background-color: lightskyblue;
    }
    table > tbody > tr:nth-child(3) > td.priestClass {
        background-color: white;
    }
    table > tbody > tr:nth-child(3) > td.hunterClass {
        background-color: green;
    }
    .div-table {
        margin: 1em;
    }
    table > * {
        font-weight: bold;
        text-align: center;
    }
    .table-header {
        color: white;
        background-color: black;
    }
    .btn-delete {
        background-color: transparent;
        color: black;
        border: none;
        outline: none;
    }
    .btn-delete:hover {
        text-decoration: underline;
        color: blue;
    }
    .trashcan {
        background-color: transparent;
        color: red;
        border: none;
        outline: none;
    }
    .btn-edit {
        background-color: transparent;
        color: orange;
        border: none;
        outline: none;
    }
    .btn-edit > a{
        color: black;
        text-decoration: none;
    }
    .btn-edit > a:hover{
        color: blue;
        text-decoration: underline;
    }
    /* colors for random letter color on character name*/
    .red {
        color: red;
    }.blue {
        color: blue;
    }.green {
        color: green;
    }.orange {
        color: orange;
    }.black {
        color: black;
    }.grey {
        color: grey;
    }
</style>