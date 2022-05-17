<template>
  <div class="container">
    <div class="row">
      <div class="col-md-6 mt-5 mx-auto">
        <form v-on:submit.prevent="register">
          <h1 class="h1 mb-3 font-weight-bold">Register</h1>

          <h4 class="errorText">{{ errors }}</h4>

          <div class="form-group">
            <label class="labels" for="first_name"> First Name</label>
            <input type="text" v-model="first_name" class="form-control" name="first_name" placeholder="First name">
          </div>

          <div class="form-group">
            <label class="labels" for="last_name"> Last Name</label>
            <input type="text" v-model="last_name" class="form-control" name="last_name" placeholder="Last name">
          </div>

          <div class="form-group">
            <label class="labels" for="email"> Email Address</label>
            <input type="email" v-model="email" class="form-control" name="email" placeholder="Email Address">
          </div>

          <div class="form-group">
            <label class="labels" for="password"> Password</label>
            <input type="password" v-model="password" class="form-control" name="password" placeholder="Password">
          </div>

            <div class="form-group">
            <label class="labels" for="password_confirmation"> Confirm Password</label>
            <input type="password" v-model="password_confirmation" class="form-control" name="password_confirmation" placeholder="Confirm Password">
          </div>

          <button class="btn btn-lg btn-primary btn-block">Register</button>
          <p class="accountText">Already have an account? </p><router-link exact-active-class="active" to="/" >Login</router-link>
        </form>
      </div>
    </div>
  </div>

</template>

<style>
    .btn {
        margin-top: 3%;
    }

    .form-group {
        margin-bottom: 2%;
    }

    .labels {
    margin-bottom: 1%;
    }

  .errorText {
    color: red;
    font-size: 1rem;
  }

    .accountText {
    margin-top: 3%;
  }

</style>


<script>
    import axios from 'axios'

    export default{
        data(){
            return {
                first_name: '',
                last_name: '',
                email: '',
                password: '',
                password_confirmation: '',
                errors: ''
            }
        },

        methods:{
            register() {
                axios.post('/api/register',
                    {
                        name:this.first_name +' '+ this.last_name,
                        email:this.email,
                        password:this.password,
                        password_confirmation:this.password_confirmation
                    })
                    .then((res) => {
                        console.log(JSON.stringify(res.data.msg));
                        this.$router.push({name: 'login'})
                    })
                    .catch((err) => {
                        this.errors = err.response.data.message;
                        console.log(JSON.stringify(this.errors))
                    })
            },


        }
    }
</script>