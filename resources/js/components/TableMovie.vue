<template>
  <div>
    <b-table
    
    id="movie-table"
    bordered 
    small 
    striped 
    hover :items="movies.data" 
    :fields="fields"
    :current-page="movies.current_page"
    :per-page="movies.per_page"
    
    >
    <template v-slot:cell(action)="row">
        <b-button variant="outline-primary" size="sm" @click="edit(row, row.index, $event.target)" class="mr-1">
        <b-icon icon="pencil-square"></b-icon>
        </b-button>
        <b-button variant="outline-danger" size="sm" @click="remove(row, $event.target)" class="mr-1">
          <b-icon icon="x"></b-icon>
        </b-button>
    </template>
    </b-table>
    <b-modal :id="infoModal.id" :title="`${form.title}-Edit`" @ok="handleOk" @hide="resetInfoModal" hide-backdrop  ref="edit-movie">
        <form ref="form" @submit.stop.prevent="update">
            <b-form-group
            id="input-group-1"
            label="Movie Title"
            >
            <b-form-input
            id="input-1"
            v-model="form.title"
            type="text"
            required
            ></b-form-input>
            </b-form-group>
            <b-form-group
            id="input-group-1"
            label="Genre"
            >
            <b-form-input
            id="input-1"
            v-model="form.genre"
            type="text"
            required
            ></b-form-input>
            </b-form-group>

            <section class="row form-group">
                <div class="col-sm-6">
                    <b-form-group
                    id="input-group-1"
                    label="Release Date"
                    >
                    <b-form-input
                    id="input-1"
                    v-model="form.release_date"
                    type="date"
                    required
                    ></b-form-input>
                    </b-form-group>
                </div>
                <div class="col-sm-6">
                    
                    <b-form-group
                    id="input-group-1"
                    label="Duration"
                    >
                    <b-form-input
                    id="input-1"
                    v-model="form.duration"
                    type="text"
                    required
                    ></b-form-input>
                    </b-form-group>
                </div>
            </section>


      </form>
    </b-modal>
  </div>
</template>

<script>
    export default {
        props:['movies'],
         data() {
            return {
                 fields: [
                     { key: 'title',  sortable: true},
                     { key: 'genre',  sortable: true},
                     { key: 'duration',  sortable: true},
                     { key: 'release_date',  sortable: true},
                     'Action'
                ],
                infoModal: {
                id: 'info-modal',
                title: '',
                content: ''
              },
               form:{
                  title: null,
                  genre: null,
                  duration: null,
                  release_date: null,
                  id: null
              }
               
            }
        },

        methods:{

             edit(row, index, button) {
              this.infoModal.title = `Row index: ${index}`
              this.form = row.item;
             
              // this.$root.$emit('bv::show::modal', this.infoModal.id, button)
              },

              handleOk(e){
                  e.preventDefault();
                  this.update();
              },

              update(){
                var vm = this;
                axios.patch('/api/movies/'+this.form.id, this.form, {method:'post'}).then(function(response){
                  if(response.status == 200){
                    vm.resetInfoModal();
                    //  vm.$refs['edit-modal'].hide();
                  }
                  
                });
              },

             remove(row, button) {
               var vm = this;
               axios.delete('/api/movies/'+row.item.id, {method: 'post'}).then(function(response){
                 if(response.status  == 200){
                   vm.$parent.allMovies();
                 }
               });
            },

             resetInfoModal() {
              this.form ={};
            },

        },
        mounted() {
           
        }
    }
</script>
