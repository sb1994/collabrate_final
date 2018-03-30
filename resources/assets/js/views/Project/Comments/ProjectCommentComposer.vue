<template lang="html">
  <div class="comment-form"  v-if="this.$auth.isAuthenticated()">
    <div class="form">
      <div class="form-row">
        <textarea class="input" placeholder="Add comment..." required v-model="comment.comment"></textarea>
        <span class="input" v-if="errorComment" style="color:red">{{errorComment}}</span>
      </div>
      <div class="form-row">
        <input type="button" class="btn" v-on:click="addComment(projectId)" value="Add Comment">
      </div>
    </div>
    <pre>{{comment}}</pre>
  </div>
</template>

<script>
import {apiDomain} from '../../../config';
export default {
  props:['projectId'],
  data(){
    return{
      comment:{
        comment:"",
        p_id:"",
        user_id:this.$auth.getUserId()
      },
      errorComment:"",
    }
  },
  methods:{
    addComment(projectId){
      this.comment.p_id = this.projectId

      if (this.comment.comment == "") {
        this.errorComment = "Please enter Message"
      }else {
        this.errorComment =""
        axios.post(apiDomain+"api/addProjectComment",this.comment)
             .then(response=>{
               console.log(response.data);
               this.comment.comment = "";
               this.$emit('commentAdded');
               //this.$router.push({name:"projects_view"});
             }).catch(function (error) {
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
      }
      //console.log(this.comment.p_id);

    }
  }
}
</script>

<style lang="css">
</style>
