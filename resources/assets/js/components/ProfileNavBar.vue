<template>
  <div id="profile-navbar">
    <nav class="navbar navbar-inverse">
      <div class="container-fluid">
        <ul class="nav navbar-nav">
          <li><router-link :to="{name:'project_create'}" >Create Project</router-link></li>
          <li><router-link :to="{name:'projects_view'}" >View Projects</router-link></li>
        </ul>
      </div>
    </nav>
  </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Profile navbar Component mounted.')
        }
    }
</script>

<style>




</style>
