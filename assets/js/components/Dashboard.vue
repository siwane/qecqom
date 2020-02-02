<template>
    <div>

        <div v-if="error">:
            <span class="alert alert-danger d-block">{{ error.message }}</span>
        </div>

        <div class="container recipe-card">

<!--            <form>-->
<!--                <label for="begin">Jour de début</label>-->
<!--                <input name="begin" />-->
<!--                <label for="day_number">Nombre de jour</label>-->
<!--                <input name="day_number" />-->
<!--                <input name="submit" type="submit" value="Filter"/>-->
<!--            </form>-->

            <table class="table dashboard">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Midi</th>
                        <th scope="col">Soir</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(recipesByDay, date) in recipes" >
                        <th scope="row">{{ date }}</th>
                        <td v-for="(recipe, lunch) in recipesByDay" class="col-md-4 align-middle">
                             {{ recipe.title }}
                            <span class="tools-box fa-stack float-right" aria-hidden="true" @click="refreshRecipe(date, lunch)">
                                <i class="fa fa-refresh"></i>
                            </span>
                        </td>
                    </tr>
                </tbody>
            </table>

        </div>

    </div>
</template>

<script>
    import axios from 'axios';

    export default {
        name: 'Dashboard',
        data() {
            return {
                recipes: null,
                error: null
            }
        },
        created () {
            axios
                .get('http://qecqom.test/api/menu/generate')
                .then(response => (this.recipes = response.data))
                .catch(error => (this.error = error));
        },
        methods: {
            refreshRecipe : function(date, lunch) {
                // console.log("/search/" + encodeURIComponent(this.searchText).replace(/[!'()*]/g, escape));
                // this.$router.push("/search/" + encodeURIComponent(this.searchText).replace(/[!'()*]/g, escape));
                // this.searchText = '';
                // event.stopPropagation();
                //
                let recipe;
                axios
                    .get('http://qecqom.test/api/menu/random')
                    .then((response) => {
                        recipe = response.data;
                        console.log(response.data);
                        this.recipes[date][lunch] = recipe;

                        // if (response.data === 0) {
                        //     this.error = "Pas de résultat pour cette recherche.";
                        // } else {
                        //     this.recipes = response.data;
                        //     this.error = '';
                        // }
                    })
                    .catch(error => (this.error = error));
            }
        }
    };
</script>