<template>
  <nav class="navbar navbar-default">
    <div class="container-fluid">
      <div class="navbar-header">
        <a class="navbar-brand" href="#">Collabrate</a>
      </div>
      <ul class="nav navbar-nav">
        <!-- template rendered iff authed -->
          <li><router-link :to="{name:'login'}">Login</router-link></li>
          <li><router-link :to="{name:'register'}">Register</router-link></li>
      </ul>
    </div>
  </nav>
</template>

<script>
    export default {
      data() {
        return {
          isAuth: this.$auth.isAuthenticated()
        }
      },
      methods:{
        logout(){
          this.$auth.destroyToken();
          if (!this.$auth.isAuthenticated()) {
            this.isAuth = this.$auth.isAuthenticated()
          }

          this.$router.push({name:"login"});
        }
      }
    }
</script>
