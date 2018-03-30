<template lang="html">
  <div id="project-comment-actions">
    <ul class="list">
      <!-- {{project.id}} -->
      <li>
        Number of Votes: {{noOfRating}}
      </li>
      <li>
        <button class="btn btn-primary" v-on:click="upVote"></button>
      </li>
    </ul>
    <pre>{{rating}}</pre>
    <!-- <ul class="list">
          <li>Votes: {{comment.votes}}
              <a v-if="!comment.votedByUser" v-on:click="voteComment(comment.commentid,'directcomment',index,0,'up')">Up Votes</a>
              <a v-if="!comment.votedByUser" v-on:click="voteComment(comment.commentid,'directcomment',index,0,'down')">Down Votes</a>
          </li>
          <li>
              <a v-on:click="spamComment(comment.commentId,'directcomment',index,0)">Spam</a>
          </li>
          <li>
              <a v-on:click="openComment(index)">Reply</a>
          </li>
      </ul> -->
  </div>
</template>

<script>
import {apiDomain} from '../../config'
export default {
  props:['project'],
  data(){
    return {
      rating:{
        project_id:"",
        user_id:""
      },
      noOfRating:0
    }
  },
  mounted(){


  },created(){
    console.log(apiDomain+"api/getNoProjectRating/"+this.rating.project_id);
    axios.get(apiDomain+"api/getNoProjectRating/"+this.project.project_id)
    .then(response=>{
        this.noOfRating = response.data[0];
      }
    ).catch(function (error) {
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
    upVote(){
      // console.log('+ Vote for project Id ' + this.project.id);
      // this.noOfRating++;
      this.rating.project_id = this.project.id;
      this.rating.user_id = this.project.user_id;

      axios.post(apiDomain+"api/addProjectRating",this.rating)
      .then(response=>{
          this.noOfRating++;
          //console.log(response.data);
          //console.log(this.user);
        }
      ).catch(function (error) {
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
    // getNoOfProjectRating(){
    //
    //   axios.get(apiDomain+"api/getNoProjectRating/"+this.rating.project_id)
    //   .then(response=>{
    //
    //     }
    //   ).catch(function (error) {
    //    if (error.response) {
    //      // The request was made and the server responded with a status code
    //      // that falls out of the range of 2xx
    //      console.log(error.response.data);
    //      console.log(error.response.status);
    //      console.log(error.response.headers);
    //    } else if (error.request) {
    //      // The request was made but no response was received
    //      // `error.request` is an instance of XMLHttpRequest in the browser and an instance of
    //      // http.ClientRequest in node.js
    //      console.log(error.request);
    //    } else {
    //      // Something happened in setting up the request that triggered an Error
    //      console.log('Error', error.message);
    //    }
    //    console.log(error.config);
    //  });
    // }
  }
}
</script>

<style lang="css">
</style>
