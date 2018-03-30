<template lang>
  <transition name="fade">
  <div class="col-md-3 col-sm-3">
    <p>{{project.name}}</p>
    <img v-bind:src='path + "/storage/img/cover_img/"+project.cover_img' class="img-responsive" alt="">
    <img v-bind:src='path + "/storage/img/icons/n1.png"' class="img-responsive" alt="">
    <p>{{project.cover_img}}</p>
    <router-link :to="{name:'project_edit',params:{id:project.id}}" >Edit Project</router-link>
    <router-link :to="{name:'project_show',params:{id:project.id}}">Show Project</router-link>
    <button v-on:click="requestDelete(project)">Delete Project</button>
  </div>
</transition>
</template>

<script>
import {apiDomain} from '../../config';
export default {
    props:['project'],
    data(){
      return{
        path:apiDomain
      }
    },
    created(){
      console.log(this.path+ "storage/img/icons/n1.png");
    },
    methods:{
      requestDelete:function(project){
        //console.log("Project witht the project id :"+project_id);
        //console.log(project.id);
        var deleteProjectUrl = apiDomain+"api/deleteProject/"+project.id;
        //console.log(deleteProjectUrl );
        axios.delete(deleteProjectUrl)
             .then(
               (response)=>{
                   //console.log(response.status);
                   if (response.status == 200) {
                    this.$emit('requestDelete',project);
                   }
                 }
             )
      }
    }
}
</script>

<style lang="css">
</style>
