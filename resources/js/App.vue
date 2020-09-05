<template>
<b-container class="mt-5">
    <b-row>
        <b-col>
            <b-button v-b-modal.add-movie class="float-right" variant="outline-success" small>New Movie</b-button>
            <add-movie :movies="movies"></add-movie>
             <table-movie class="mt-5" :movies="movies" :per-page="movies.per_page" :current-page="movies.current_page"></table-movie>
            <b-pagination class="float-right"
            v-model="movies.current_page"
            :total-rows="movies.total"
            :per-page="movies.per_page"
            @change="allMovies"
            aria-controls="movie-table"
             align="fill"
            first-number
            last-number
            ></b-pagination>
        </b-col>
    </b-row>
</b-container>
</template>

<script>
import addMovie  from "./components/AddMovie";
import tableMovie from './components/TableMovie'
    export default {
        components:{addMovie, tableMovie},
        data(){
            return{
                 movies:{
                     per_page: 10,
                     current_page: 1,
                     total: 0
                 },
            }
        },
        mounted() {
           this.allMovies();
        },
        methods:{
            allMovies(){
                 var vm = this;
                axios.get(`/api/movies?per_page=${vm.movies.per_page}&current_page=${vm.movies.current_page}`).then(function(response){
                    vm.movies = response.data;
                });
            }
        }
    }
</script>
