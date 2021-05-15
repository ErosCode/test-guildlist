<template>
<div class="btn-flex-end" >

<b-button variant="primary" @click="$bvModal.show('modal-scoped')">Ajouter un personnage</b-button>

  <b-modal id="modal-scoped" hide-footer>
    <template #modal-header="{ close }">
      <!-- Emulate built in modal header close button action -->
      <b-button size="sm" variant="outline-danger" @click="close()">
        Fermer
      </b-button>
      <h5>Ajouter un personnage</h5>
    </template>

    <template >
      <b-form @reset="onReset" v-if="show">
        <b-form-group
          id="input-group-1"
          label="Pseudo:"
          label-for="input-1"
          label-class="custom-label"
          description="Pseudo du personnage"
        >
          <b-form-input
            id="input-1"
            v-model="form.pseudo"
            type="text"
            placeholder="Enter pseudo"
            required
          ></b-form-input>
        </b-form-group>

        <b-form-group id="input-group-2" label="Race:" label-for="input-2">
          <select
            id="input-2"
            v-model="form.race"
            required
          >
          <option disabled>{{form.race}}</option>
          <option v-for="race in races" :key="race.id" >{{race.name}}</option>
          </select>
        </b-form-group>

        <b-form-group id="input-group-3" label-class="custom-label" label="Classe:" label-for="input-3">
          <select
            id="input-3"
            v-model="form.classe"
            required
          >
          <option disabled>{{form.classe}}</option>
          <option @change="selectedClass = classe.id" v-for="classe in classes" :key="classe.id" :value="classe.name">{{classe.name}}</option>
          </select>
        </b-form-group>

        <b-form-group v-if="form.classe !== 'Choisissez la classe' || null || '' " label-class="custom-label" id="input-group-4" label="Spécialisation:" label-for="input-4">
          <select
            id="input-4"
            v-model="form.spec"
            required
          >
          
          <option disabled>{{form.spec}}</option>
          <option v-for="filteredSpec in filteredSpecsByClass" :key="filteredSpec.id" :value="filteredSpec.name">{{filteredSpec.name}}</option>
          </select>

        </b-form-group>
                <b-form-group id="input-group-5" label="Armure:" label-for="input-5">
          <select
            id="input-5"
            v-model="form.armor"
            required
          >
          <option disabled>{{form.armor}}</option>
          <option v-for="armor in armors" :key="armor.id" :value="armor.name">{{armor.name}}</option>
          </select>
        </b-form-group>

        <b-form-group id="input-group-6" label="Propriétaire:" label-for="input-6">
          <b-form-input
            id="input-6"
            v-model="form.proprietaire"
            type="text"
            placeholder="Propriétaire du personnage"
            required
          ></b-form-input>
        </b-form-group>

        <div class="btn-options">
        <b-button @click="onSubmit" variant="success">Ajouter</b-button>
        <b-button type="reset" variant="danger">Reset</b-button>
        </div>
        
      </b-form>
    </template>
  </b-modal>

</div>
</template>
<script>
export default {
  props: ['races', 'armors', 'classes', 'specs'],
    data() {
      return {
          form: {
          race: 'Choisissez la race',
          classe: 'Choisissez la classe',
          spec: 'Choisissez sa spécialisation',
          armor: 'Choisissez son armure',
          pseudo: '',
          proprietaire: '',
          detail: '',
        },
        requiredMessage: 'Veuillez renseigner tous les champs requis',
        show: true,
      }
    },
    methods: {
      onSubmit() {
        if(this.form.classe === 'Choisissez la classe' || '' || null) {
          alert(this.requiredMessage)
          return
        }
        if(this.form.pseudo === '' || null) {
          alert(this.requiredMessage)
          return
        }
        if( this.form.race === 'Choisissez la race') {
            this.form.race = '';
        }
        if( this.form.spec === 'Choisissez sa spécialisation') {
          alert(this.requiredMessage)
          return
        }
        if(this.form.armor === 'Choisissez son armure') {
          this.form.armor = '';
        }
        axios.post('http://localhost/api/char/store', {
          char: {
            char_pseudo: this.form.pseudo,
            race: this.form.race,
            classe: this.form.classe,
            spec: this.form.spec,
            armor: this.form.armor,
            proprietaire: this.form.proprietaire,
            detail: this.form.detail
          }
        })
          .then( response => {
            if( response.status == 201 ) {
              this.form.pseudo = '';
              this.form.race = 'Choisissez la race';
              this.form.classe = 'Choisissez la classe';
              this.form.spec = 'Choisissez sa spécialisation';
              this.form.armor = 'Choisissez son armure';
              this.form.proprietaire = '';
              this.form.detail = '';
              this.$bvModal.hide("modal-scoped");
              this.$parent.getChars();
            }
          })
          .catch( error => {
            this.onReset(event);
            alert('Une erreur est survenue')
            return
          })
      },
      onReset(event) {
        event.preventDefault()
        // Reset our form values
        this.form.pseudo = ''
        this.form.race = 'Choisissez la race'
        this.form.classe = 'Choisissez la classe'
        this.form.spec = 'Choisissez sa spécialisation'
        this.form.armor = 'Choisissez son armure'
        this.form.proprietaire = ''
        this.form.detail = ''
        
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
    },
    computed: {
    filteredSpecsByClass() {
        if(this.form.classe === 'Guerrier'){
          return this.specs.filter(x => x.id === 1 || x.id === 2 || x.id === 3 )
        }
        if(this.form.classe === 'Mage'){
          return this.specs.filter(x => x.id === 4 || x.id === 5 || x.id === 6 )
        }
        if(this.form.classe === 'Prêtre'){
          return this.specs.filter(x => x.id === 7 || x.id === 8 || x.id ===  9)
        }
        if(this.form.classe === 'Chasseur'){
          return this.specs.filter(x => x.id === 10 || x.id === 11 || x.id === 12 )
        }
      else {
        return;
      }
    }
  }
  
}

</script>
<style>
  .custom-label:after{
    content: ' *';
    color: red;
  }
  .btn-flex-end {
    display: flex;
    justify-content: flex-end;
    margin: 1em;
  }
</style>    