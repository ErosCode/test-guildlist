<template>
    <div v-if="char">
      <b-form @reset="onReset">
        <b-form-group
          id="input-group-1"
          label="Pseudo:"
          label-for="input-1"
          label-class="custom-label"
          description="Pseudo du personnage"
        >
          <b-form-input
            id="input-1"
            v-model="char.char_pseudo"
            type="text"
            placeholder="Enter pseudo"
            required
          ></b-form-input>
        </b-form-group>

        <b-form-group id="input-group-2" label="Race:" label-for="input-2">
          <select
            id="input-2"
            v-model="char.race"
            required
            click="getconsole" 
          >
          <option disabled>{{char.race}}</option>
          <option v-for="race in races" :key="race.id" >{{race.name}}</option>
          </select>
        </b-form-group>

        <b-form-group id="input-group-3" label-class="custom-label" label="Classe:" label-for="input-3">
          <select
            id="input-3"
            v-model="char.classe"
            required
            @change="onChange($event)"
          >
          <option disabled>{{char.classe}}</option>
          <option @change="selectedClass = classe.id" v-for="classe in classes" :key="classe.id" :value="classe.name">{{classe.name}}</option>
          </select>
        </b-form-group>

        <b-form-group v-if="char.classe !== 'Choisissez la classe' || null || '' " label-class="custom-label" id="input-group-4" label="Spécialisation:" label-for="input-4">
          <select
            id="input-4"
            v-model="char.spec"
            required
          >
          
          <option disabled>{{char.spec}}</option>
          <option v-for="filteredSpec in filteredSpecsByClass" :key="filteredSpec.id" :value="filteredSpec.name">{{filteredSpec.name}}</option>
          </select>

        </b-form-group>
                <b-form-group id="input-group-5" label="Armure:" label-for="input-5">
          <select
            id="input-5"
            v-model="char.armor"
            required
          >
          <option disabled>{{char.armor}}</option>
          <option v-for="armor in armors" :key="armor.id" :value="armor.name">{{armor.name}}</option>
          </select>
        </b-form-group>

        <b-form-group id="input-group-6" label="Propriétaire:" label-for="input-6">
          <b-form-input
            id="input-6"
            v-model="char.proprietaire"
            type="text"
            placeholder="Propriétaire du personnage"
            required
          ></b-form-input>
        </b-form-group>

        <div class="btn-options">
        <b-button @click="onSubmit"  variant="success">Modifier</b-button>
        <b-button type="reset" variant="danger">Reset</b-button>
        </div>

      </b-form>
    </div>
    <div v-else>Loading...</div>
</template>

<script>
export default {
    props: ['char', 'id', 'races', 'armors', 'classes', 'specs'],
    data() {
      return {
          form: {
        },
        show: true
      }
    },
    methods : {
      onChange(event) {
        this.char.spec = 'Choisissez une spécialisation'
      },
      onSubmit(evt) {
          if( this.char.spec === 'Choisissez une spécialisation') {
          alert('Veuillez renseignez tous les champs requis')
          return
        }
        axios.put( 'api/char/' + this.id, {
          char: {
            char_pseudo: this.char.char_pseudo,
            race: this.char.race,
            classe: this.char.classe,
            spec: this.char.spec,
            armor: this.char.armor,
            proprietaire: this.char.proprietaire,
            detail: this.char.detail
          }
        })
          .then( response => {        
              alert('Personnage modifié!')
                this.$router.replace({ name : 'home' });
          })
          .catch( error => {
            evt.preventDefault();
            alert('Veuillez renseigner tous les champs requis')
          return
          })
      },
      onReset(event) {
        event.preventDefault()
        // Reset our form values
        this.char.char_pseudo = ''
        this.char.race = null
        this.char.classe = null
        this.char.spec = null
        this.char.armor = null
        this.char.proprietaire = ''
        this.char.detail = ''
        
        // Trick to reset/clear native browser form validation state
        this.show = false
        this.$nextTick(() => {
          this.show = true
        })
      },
      handleOk(bvModalEvt) {
        // Prevent modal from closing
        bvModalEvt.preventDefault()
        // Trigger submit handler
        this.handleSubmit()
      },
      checkSpec() {
        setTimeout(()=> {
        if(this.char.spec ===  null)
        {
          return this.char.spec = 'Choisissez sa spécialisation'
        }
        return
        }, 100)
      }
    },
    computed: {
      filteredSpecsByClass() {
          if(this.char.classe === 'Guerrier'){
            return this.specs.filter(x => x.id === 1 || x.id === 2 || x.id === 3 )
          }
          if(this.char.classe === 'Mage'){
            return this.specs.filter(x => x.id === 4 || x.id === 5 || x.id === 6 )
          }
          if(this.char.classe === 'Prêtre'){
            return this.specs.filter(x => x.id === 7 || x.id === 8 || x.id ===  9)
          }
          if(this.char.classe === 'Chasseur'){
            return this.specs.filter(x => x.id === 10 || x.id === 11 || x.id === 12 )
          }
        else {
          return;
        }
      }
    },
    created() {
      this.checkSpec();
    },
}

</script>