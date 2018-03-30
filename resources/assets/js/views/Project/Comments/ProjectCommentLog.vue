<template lang="html">
  <section>
    <!-- <project-comment v-for="project_comment in project_comments"  :key="project_comment.id"></project-comment> -->
    <div class="chat" v-for="project_comment in project_comments">
      <project-comment v-bind:project_comment="project_comment"></project-comment>
    </div>
  </section>
</template>

<script>
import ProjectComment from './ProjectComment.vue';

export default {
  props:['project_comments'],
  components:{
    'project-comment':ProjectComment
  },
  data(){
    return{
      //project_comments:[]
    }
  }
}
</script>

<style lang="css">
</style>
