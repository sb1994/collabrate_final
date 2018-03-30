<template>

  <div>
    <loggedin-navbar></loggedin-navbar>
    <p>Edit Project</p>
    <div class="container">
      <div class="form-group">
        <label for="cover_img" class="label-control">Cover Image:</label>
        <input type="file" id="cover_img" name="cover_img" value="" class="form-control" v-on:change="onFileChanged">
        <label for="disable-img">
          Keep Currnent image
          <input type="checkbox" name="disable-img" id="disable-img" v-model="disableImg">
        </label>
      </div>
      <div class="form-group">
        <label for="name" class="label-control">Name:</label>
        <input type="text" id="name" name="name" value="" class="form-control" v-model="project.name">
      </div>
      <div class="form-group">
        <label for="skill" class="label-control">Description:</label>
        <input type="text" name="description" id="description" value="" class="form-control" v-model="project.description">
      </div>

        <button type="button" name="button" v-on:click="editProject">Edit Project</button>
    </div>
    <pre>
      {{project}}
    </pre>
    <pre>
      {{disableImg}}
    </pre>

  </div>
</template>
<script>
import {apiDomain} from '../../config';
import LoggedinNavBar from '../../components/LoggedinNavBar.vue';
export default{
  components:{
    'loggedin-navbar':LoggedinNavBar
  },
  data(){

    return{
      project:{
        id:this.$route.params.id,
        name:"",
        description:"",
        cover_img:"",

      },
      disableImg:"",
      categories:[],
      error:{},
      isProssessing:false
    }
  },
  created(){
    //console.log(this.$route.params.id);
    console.log(apiDomain+"api/getProjectCategories");
    axios.get(apiDomain+"api/getProjectCategories")
         .then(response=>{
           this.categories=response.data.categories;
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
    console.log(apiDomain+'api/getUserProject/'+this.$route.params.id);
    axios.get(apiDomain+'api/getUserProject/'+this.$route.params.id)
         .then(response=>{
           this.project= response.data[0];
          //console.log(this.stored_data);
         }
       )
  },
  methods:{
    onFileChanged(event){
      //const files = event.target.files;
      const fileReader = new FileReader();

      fileReader.readAsDataURL(event.target.files[0]);
      fileReader.onload = (event)=>{
        this.project.cover_img = event.target.result
      }
    },
    editProject(){
      if (this.disableImg) {
        //console.log('Image Wont be updated');
        this.project.cover_img = "";
      }
      axios.post(apiDomain+"api/editProject",this.project)
           .then(response=>{
             console.log(response.data);
             this.$router.push({name:"projects_view"});
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
  }
}
</script>
<style>
</style>
