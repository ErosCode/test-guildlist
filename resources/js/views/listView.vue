<template>
    <div class="table-responsive">

    <table class="table table-striped table-bordered">
        <thead>
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
                <td>{{char.char_pseudo}}</td>
                <td>{{char.race}}</td>
                <td>{{char.armor}}</td>
                <td v-bind:class="getClass(char.classe)">
                        {{char.classe}}
                </td>
                <td>{{char.spec}}</td>
                <td>{{char.proprietaire}}</td>
                <td>{{getClassMethod(char.classe, char.spec)}}</td>
                <td><router-view name="char"/>
                    <router-link :to="{name: 'detail', params: { id: char.id }}">Modifier</router-link>
                    <button @click="deleteChar(char.id)">Supprimer</button>
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
    },


}
</script>
<style>
    table {
        margin: 1em;
    }
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
/*Guerrier • Coup préféré
• Cri_de_guerre()
Cri_de_guerre() renvoie par exemple :
“Je suis un guerrier avec la spécialisation arme”
Mage • Sort préféré
• Murmure_de_magie()
Murmure_de_magie() renvoie par exemple :
“Je suis un mage avec la spécialisation arcane”
Prêtre • Soin préféré
• Hymne_divin()
Hymne_divin() renvoie par exemple :
“Je suis un prêtre avec la spécialisation sacré”
Chasseur • Coup préféré
• Hurlement_de_la_bête()
Hurlement_de_la_bête() renvoie par exemple :
“Je suis un chasseur avec la spécialisation survie”*/
</style>