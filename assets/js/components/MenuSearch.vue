<template>
    <div>
        <form class="form-inline md-form form-sm active-cyan-2" v-on:submit.prevent="search">
            <input class="form-control form-control-sm mr-3 w-75" type="text" placeholder="Recette, ingrédient, idée..."
                   aria-label="Search" name="searchText" id="searchText" v-model="searchText">
            <button v-on:click="search" class="float-md-right btn btn-outline-light my-2 my-sm-0" type="submit">
                <i class="fa fa-search" aria-hidden="true"></i>
            </button>
        </form>
    </div>
</template>

<script>

    export default {
        name: 'MenuSearch',
        data() {
            return {
                'searchText': '',
            }
        },
        methods: {
            search: function (event) {
                let params = {name: 'search-query'};
                if (this.searchText !== '') {
                    params.query = { q: encodeURIComponent(this.searchText).replace(/[!'()*]/g, escape) };
                }
                this.$router.push(params);
            }
        }
    };

</script>