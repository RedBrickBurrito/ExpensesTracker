<template>
    <main>
        <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">
                    <!-- llamamos al logo de Vue -->
                    <img src="https://cdn.worldvectorlogo.com/logos/google-finance.svg" alt="" width="30" height="24">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <router-link exact-active-class="active" to="/home" class="nav-link active" aria-current="page">Home</router-link>
                    </li>
                    <li class="nav-item">
                        <router-link exact-active-class="active" to="/expenses" class="nav-link">Expense Tracker</router-link>
                    </li>           
                </ul>
                <form class="d-flex">
                        <button type="submit" class="btn btn-danger" @click="logout()" v-if="isLogged">
                            Logout
                        </button>
                </form>
                </div>
            </div>
        </nav>
        <div class="container mt-5">
            <router-view></router-view>
        </div>
    </main>
</template>
 
<script>
    import {mapGetters} from 'vuex';
    export default {
        computed: {
            ...mapGetters([
                'isLogged'
            ])
        },
        methods: {
            logout() {
                this.$store.dispatch('logout')
            }
        }
    }
</script>