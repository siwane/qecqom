<template>
    <nav class="navbar navbar-expand-lg navbar-primary navbar-dark bg-primary">

        <router-link tag='div' to="/" class="navbar-brand">
            <img :src="require('./../../img/qecqom.png')" width="180" height="90" alt="logo"/>
            <p class="small font-italic">Qu'est ce qu'on mange?</p>
        </router-link>

<!--        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">-->
<!--            <span class="navbar-toggler-icon"></span>-->
<!--        </button>-->

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item active">
<!--                    <router-link tag='div' to="/search" class="nav-link">Search <span class="sr-only"></span></router-link>-->
                </li>
<!--                <li class="nav-item">-->
<!--                     <router-link tag='div' to="hello" class="nav-link">Features</router-link>-->
<!--                </li>-->
            </ul>
        </div>

        <div class="col-md-3"><MenuSearch></MenuSearch></div>

    </nav>
</template>

<script>
    import MenuSearch from "./MenuSearch";
    export default {
        name: 'Menu',
        components: {MenuSearch}
    }
</script>