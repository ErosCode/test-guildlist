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
            <tr v-for="char in chars" :key="char.charId">
                <td class="randomColors">{{char.char_pseudo}}</td>
                <td v-bind:class="getClass(char.classe)">{{char.race}}</td>
                <td v-bind:class="getClass(char.classe)">{{char.armor}}</td>
                <td v-bind:class="getClass(char.classe)">{{char.classe}}</td>
                <td v-bind:class="getClass(char.classe)">{{char.spec}}</td>
                <td v-bind:class="getClass(char.classe)">{{char.proprietaire}}</td>
                <td v-bind:class="getClass(char.classe)">
                    <font-awesome-icon  v-if="char.classe === 'Guerrier' " icon="jedi" />
                    <font-awesome-icon  v-if="char.classe === 'Mage' " icon="hat-wizard" />
                    <font-awesome-icon  v-if="char.classe === 'Prêtre' " icon="cross" />
                    <font-awesome-icon  v-if="char.classe === 'Chasseur' " icon="compress-arrows-alt" />
                    {{getClassMethod(char.classe, char.favorite_skill, char.spec)}}
                </td>
                <td><router-view name="char"/>
                <button class="btn-edit">
                    <router-link :to="{name: 'detail', params: { id: char.charId }}">Modifier</router-link>
                    <font-awesome-icon icon="edit" />
                </button>
                    /
                    <button @click="deleteChar(char.charId)" class="btn-delete">
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
    props: ['chars', 'classes'],
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
        getClassMethod (charClass, classSkill, charSpec) {
            if( charClass === 'Guerrier'){
                return this.Cri_de_guerre(charClass, classSkill, charSpec)
            }            
            if( charClass === 'Mage'){
                return this.Cri_de_guerre(charClass, classSkill, charSpec)
            }
            if( charClass === 'Prêtre'){
                return this.Cri_de_guerre(charClass, classSkill, charSpec)
            } 
            if( charClass === 'Chasseur'){
                return this.Cri_de_guerre(charClass, classSkill, charSpec)
            }
        },
        Cri_de_guerre(charClass, classSkill, charSpec) {
            return  'Je suis un ' + charClass + ' avec la spécialisation ' + charSpec +' et mon ' + classSkill + ' est Cri de guerre';
        },
        Murmure_de_magie(charClass, classSkill, charSpec) {
            return 'Je suis un ' + charClass + ' avec la spécialisation ' + charSpec +' et mon ' + classSkill + ' est Murmure de magie';
        },
        Hymne_divin(charClass, classSkill, charSpec) {
            return 'Je suis un ' + charClass + ' avec la spécialisation ' + charSpec +' et mon ' + classSkill + ' est Hymne Divin';
        },
        Hurlement_de_la_bête(charClass, classSkill, charSpec) {
            return 'Je suis un ' + charClass + ' avec la spécialisation ' + charSpec +' et mon ' + classSkill + ' est Hurlement de la bête';
        },
        getRandomColors () {
            setTimeout(()=> {
                var par = document.querySelectorAll(".randomColors");
                var colors = ["red", "blue", "green", "orange", "black", "grey"];
                for (let i = 0; i < par.length; i++) {
                    par[i].innerHTML = par[i].innerHTML.split('').map(function(c) {
                    return "<span class='" + colors[Math.floor(Math.random() * colors.length)] + 
                    " bolder'" + ">" + c + "</span>"
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
    }.bolder {
        font-weight: bolder;
    }
</style>