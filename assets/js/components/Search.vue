<template>
    <div class="container">
        <div class="row">

            <div class="col-md-9">

                <div>
                    <h3>Trouver le prochain menu!</h3>
                    <form class="active-cyan-2" v-on:submit.prevent="search">
                        <div class="input-group">
                            <input class="form-control input-lg" type="text" placeholder="Recette, ingrédient, idée..."
                                   aria-label="Search" name="searchText" id="searchText" v-model="searchText">
                            <div class="input-group-btn">
                                <button class="btn btn-default" type="submit">
                                    <a v-on:click="searchQuery" class="float-lg-right"><i class="fa fa-search" aria-hidden="true"></i></a>
                                </button>
                            </div>
                        </div>
                    </form>
                    <hr class="my-4">
                </div>

                <div v-if = "error">
                    <span class="alert alert-danger d-block">{{ error }}</span>
                </div>

                <div v-else>
                    <div v-for="(recipe) in recipes">
                        <div class="card-block">
                            <div class="row">
                                <div class="col-md-4">
                                    <img class="card-img-top" :src="recipe.image" alt="Card image cap" width="230" height="100">
                                </div>
                                <div class="col-md-8">
                                    <h5 class="card-subtitle">{{ recipe.title }}</h5>
                                    <br/>
                                    <p class="card-text" v-html="recipe.description"></p>
                                    <div class="row">
                                        <p class="col-md-6 card-text alert"><span v-if="recipe.note">{{ recipe.note }} / 5</span></p>
                                        <p class="col-md-6">
                                            <a :href="recipe.link" target="_blank" class="btn btn-link active float-md-right" role="button" aria-pressed="true">Plus ></a>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr/>
                    </div>
                </div>

            </div>

            <!-- Side weekly menu -->
            <!-- <div class="col-md-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title">Day 1</div>
                            <p>Midi</p>
                            <p>Soir</p>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title">Day 1</div>
                            <p>Midi</p>
                            <p>Soir</p>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title">Day 1</div>
                            <p>Midi</p>
                            <p>Soir</p>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title">Day 1</div>
                            <p>Midi</p>
                            <p>Soir</p>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title">Day 1</div>
                            <p>Midi</p>
                            <p>Soir</p>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title">Day 1</div>
                            <p>Midi</p>
                            <p>Soir</p>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title">Day 1</div>
                            <p>Midi</p>
                            <p>Soir</p>
                        </div>
                    </div>
                </div>
            </div>-->

        </div>

    </div>
</template>

<script>
    import axios from 'axios';

    export default {
        name: 'Search',
        data() {
            return {
                'searchText': '',
                'recipes': '',
                'error': ''
            };
        },
        created: function () {
            this.search();
        },
        methods: {
            searchQuery: function(e) {
                let query =  {};
                if (this.searchText !== '') {
                    query = {q: encodeURIComponent(this.searchText).replace(/[!'()*]/g, escape)};
                }
                this.$router.push({query: query});
            },
            search: function () {
                if (typeof this.$route.query.q === 'undefined') {
                    this.searchText = '';
                    this.recipes = '';
                    this.error = '';
                    return;
                }
                this.searchText = decodeURIComponent(this.$route.query.q);
                axios
                    .get('http://qecqom.test/api/search', {
                        params: {'search': this.searchText}}
                    )
                    .then((response) => {
                        if (response.data.length === 0) {
                            this.error = "Pas de résultat pour cette recherche.";
                        } else {
                            this.recipes = response.data;
                            this.error = '';
                        }
                    })
                    .catch(error => (this.error = error));
            }
        },
        watch: {
            '$route.query.q'() {
                this.search();
            }
        }
    };
</script>