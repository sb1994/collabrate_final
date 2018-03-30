<template>
  <div>
    <loggedout-navbar></loggedout-navbar>
    <div class="container">
      <p>Login Vue</p>
      <div class="form-group">
        <label for="email" class="label-control">Email</label>
        <input type="text" id="email" name="email" value="" class="form-control" v-model="email">
      </div>
      <div class="form-group">
        <label for="password" class="label-control">Password</label>
        <input type="text" name="password" id="password" value="" class="form-control" v-model="password">
      </div>
      <button type="button" name="button"  v-on:click="loginUser">Login</button>
    </div>
    <!-- <pre>
      {{user}}
    </pre> -->
  </div>
</template>
<script>
import {loginUrl,getHeader,userUrl,authenticateUrl} from "../../config";
import LoggedoutNavBar from '../../components/LoggedoutNavBar.vue';
export default{
  components:{
    'loggedout-navbar':LoggedoutNavBar
  },
  data(){
    return {
        email:"",
        password:""
    }
  },
  methods:{
    loginUser(){
      var backUpClient ="ZLuTFyqCAJPIZx0X766mwdAmO5RZunTdFqk0ODEr";
      var data={
        client_id:2,
        client_secret:'hbfWnj3My4YWr2vl0THmaUKsjVGT1yHMlKIX4sWS',
        grant_type:'password',
        username:this.email,
        password:this.password
      }
      //console.log(data);
      //testing how to access the api routes
      axios.post(authenticateUrl,data)
            //es6 syntax
            .then(response=>{
              if (response.status===200) {
                var user={
                  'email':this.email,
                  'password':this.password
                }
                //console.log('user',user);
                axios.post(loginUrl,user)
                     .then(res=>{
                       //console.log(res.data.user_id);
                       this.$auth.setToken(response.data.access_token,response.data.expires_in+Date.now(),res.data.user_id);
                       this.$router.push('/profile');
                     })
              }
            })
           // .then(function (response) {
           //   console.log(response);
           // });
    },

  }
}
</script>
<style>
</style>
