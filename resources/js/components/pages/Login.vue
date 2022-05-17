<template>
  <div class="container">
    <div class="row">
        <div class="col-md-6 mt-5 mx-auto">
            <form @submit.prevent="login">
              <h1 class="h1 mb-3 font-weight-bold">Sign in</h1>

              <h4 class="errorText">{{ errors }}</h4>

              <div class="form-group">
                <label class="labels" for="email"> Email Address</label>
                <input type="email" v-model="form.email" class="form-control" name="email" placeholder="Email Address">
              </div>

              <div class="form-group">
                <label class="labels" for="password"> Password</label>
                <input type="password" v-model="form.password" class="form-control" name="password" placeholder="Password">
              </div>

              <button class="btn btn-lg btn-primary btn-block">Sign in</button>
              <p class="accountText">Don't have an account? </p><router-link exact-active-class="active" to="/register" >Register</router-link>
            </form>
      </div>
    </div>
  </div>

</template>

<style>

  .accountText {
    margin-top: 3%;
  }

  .btn {
    margin-top: 1.5%;
  }

  .form-group {
    margin-bottom: 2%;
  }

  .labels {
    margin-bottom: 1%;
  }

  .errorText {
    color: red;
    font-size: 1.2rem;
  }

</style>

<script>

export default {
    data() {
        return {
            form: {
                email: '',
                password: '',
            },
            errors: ''
        }
    },
    methods: {
        login() {
            this.$store
                .dispatch('login', {
                    email: this.form.email,
                    password: this.form.password
                })
                .then(() => {
                    this.$router.push({name: 'home'})
                })
                .catch(err => {
                    this.errors = err.response.data.msg;
                    console.log(JSON.stringify(this.errors))
                })
        }
    }
}
</script>
