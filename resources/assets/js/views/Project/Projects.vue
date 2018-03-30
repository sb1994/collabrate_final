<template lang="html">
  <div class="projects-view">
    <h1>Projects</h1>
    <!-- <div id="projecta" v-for="project in projects"><p>{{project.id}}</p></div> -->
      <div class="row">
        <project-thumbnail v-for="project in projects" :project="project" :key="project.id" @requestDelete="deleteProject"></project-thumbnail>
      </div>
    <!-- {{projects}} -->
    <!-- <router-link :to="{name:'project_create'}">Create Project</router-link> -->
    <!-- <div id="projects" v-for="project in projects">
      </div> -->
  </div>
</template>

<script>
import {apiDomain} from '../../config';
import _ from "lodash";//used for working with arrays
import ProjectThumbnail from './ProjectThumbnail.vue';
export default {
  data(){
    return {
      projects:[]
    }
  },
  components:{
    'project-thumbnail':ProjectThumbnail
  },
  created(){
    var user_id =this.$auth.getUserId();
    var apiCallDomain=apiDomain+'api/getUserProjects/'+user_id;

    axios.get(apiCallDomain)
          .then(response=>{
              this.projects = response.data;
              //console.log(response.data);
              console.log(this.projects);
            }
          )
          .catch(function (error) {
           if (error.response) {
             // The request was made and the server responded with a status code
             // that falls out of the range of 2xx
             console.log(error.response.data);
             console.log(error.response.status);
             console.log(error.response.headers);
           } else if (error.request) {
             // The request was made but no response was received
             // `error.request` is an instance of XMLHttpRequest in the browser and an instance of
             // http.ClientRequest in node.js
             console.log(error.request);
           } else {
             // Something happened in setting up the request that triggered an Error
             console.log('Error', error.message);
           }
           console.log(error.config);
         });

  },
  methods:{
    deleteProject:function(project) {
      //delete object from array using lodash
      //console.log(project);
      this.projects = _.without(this.projects,project);
    }
  }
}
</script>

<style lang="css">
</style>
