<template>

    <div class="row">
        <div class="container-fluid col-md-8 col-md-offset-2">
            <Menu></Menu>
            <div class = "p-5">
                <router-view></router-view>
            </div>
            <Footer></Footer>
        </div>
    </div>

</template>

<script>
    import Menu from "./components/Menu";
    import Footer from "./components/Footer";
    export default {
        name: 'app',
        components: {
            Menu,
            Footer
        }
    }
</script>