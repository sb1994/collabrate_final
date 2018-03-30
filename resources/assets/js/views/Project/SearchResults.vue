<template>
  <div class="col-md-3 col-sm-3">
    <p>{{project.name}}</p>
    <img v-bind:src='path + "storage/img/cover_img/"+project.cover_img' class="img-responsive" alt="">
    <p>{{project.cover_img}}</p>
    <router-link :to="{name:'project_show',params:{id:project.id}}">Show Project</router-link>
  </div>
</template>

<script>
import {apiDomain} from '../../config';
export default {
    props:['project'],
    data(){
      return{
        path:apiDomain,
        //project:[]
      }
    },
    created(){
      // this.project = 
    },
    methods:{
      
    }
}
</script>

<style lang="css">
</style>
