<template lang="html">

  <div>
    <project-comment-log></project-comment-log>
    <project-comment-composer v-bind:projectId="project.id"></project-comment-composer>
    <pre>{{project}}</pre>
  </div>

</template>

<script>
import ProjectCommentLog from './ProjectCommentLog.vue';
import ProjectCommentComposer from './ProjectCommentComposer.vue';
import {apiDomain} from '../../../config';
export default {
  props:['project'],
  components:{
    'project-comment-log':ProjectCommentLog,
    'project-comment-composer':ProjectCommentComposer
  },
  data(){
    return{
      project_comments:[],
      p_id:""
    }
  },
  created(){
    //this.p_id =project.id;
    console.log(this.id);
    console.log(apiDomain+"api/getProjectCommentsByPId/"+this.p_id);
  },
  mounted(){
    console.log(apiDomain+"api/getProjectCommentsByPId/"+this.project_id);
  },
  methods:{

  }
}
</script>

<style lang="css">
</style>
