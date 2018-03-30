<template>
  <nav class="navbar navbar-default">
    <div class="container-fluid">
      <div class="navbar-header">
        <a class="navbar-brand" href="#">Collabrate</a>
      </div>
      <ul class="nav navbar-nav">
        <!-- template rendered iff authed -->
          <li><router-link :to="{name:'profile'}">Profile</router-link></li>
          <li><router-link :to="{name:'search-projects'}">Search Projects</router-link></li>
          <li><button class="btn" v-on:click="logout" > Logout</button></li>
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
