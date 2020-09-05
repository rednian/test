<template>
    <b-modal id="add-movie" title="New Movie"  @ok="handleOk" hide-backdrop >
        <form ref="form" @submit.stop.prevent="addMovie">
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
</template>

<script>
    export default {
        name:'addMovie',
        props:['movies'],
        data(){
          return{
              form:{
                  title: null,
                  genre: null,
                  duration: null,
                  release_date: null,
              }
          }  
        },
        methods:{
            addMovie(){
                var vm = this;
                axios.post('/api/movies',this.form)
                .then(function(response){
                    if(response.status == 201){
                        vm.form = {};
                        vm.$bvModal.hide();
                    }
                }).catch(function(error){
                    console.log(error)
                });
            },
            handleOk(e){
                e.preventDefault();
                this.addMovie();
            }
        },
        mounted() {
            
        }
    }
</script>
