<template>
  <div>
    <!-- <transition name="fade"> -->
      <p>Add Project</p>
      <div class="container">
        <div class="form-group">
          <label for="cover_img" class="label-control">Cover Image:</label>
          <input type="file" id="cover_img" name="cover_img" value="" class="form-control" v-on:change="onFileChanged">
        </div>
        <div class="form-group">
          <label for="name" class="label-control">Name:</label>
          <input type="text" id="name" name="name" value="" class="form-control" v-model="project.name">
        </div>
        <div class="form-group">
          <label for="skill" class="label-control">Description:</label>
          <input type="text" name="description" id="description" value="" class="form-control" v-model="project.description">
        </div>
        <!-- <div class="form-group">
              <input type="file" id="project_images[]" v-on:change="onMultiFileChanged" multiple>
        </div> -->

        <div class="form-group">
          <label> Project categories:</label>
          <label class="checkbox-inline" v-for="category in categories">

            <input type="radio" name="category" v-bind:value="category.id" v-model="project.category_id">{{category.name}}
            <!-- <p>{{category}}</p> -->
          </label>
        </div>

          <button type="button" name="button" v-on:click="addProject">Add Project</button>
          <pre>
            {{project}}
          </pre>
          <pre>
            {{categories}}
          </pre>

    </div>
    <!-- </transition> -->
  </div>
</template>
<script>
import {apiDomain} from '../../config';
export default{

  data(){
    return{
      project:{
        user_id:parseInt(this.$auth.getUserId()),
        name:"",
        description:"",
        cover_img:"",
        category_id:"",
      },
      project_images:[],
      form: new FormData(),
      project_image:null,
      categories:{},
      error:{},
      isProssessing:false
    }
  },
  created(){
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
  },
  methods:{
    addProject(){
      var user_id= this.$auth.getUserId();
      axios.post(apiDomain+"api/addProject",this.project)
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
      console.log(this.project);
    },
    onFileChanged(event){
      const files = event.target.files;
      const fileReader = new FileReader();

      fileReader.readAsDataURL(event.target.files[0]);
      fileReader.onload = (event)=>{
        this.project.cover_img = event.target.result
      }

      //console.log(this.user);
      // let filename = files[0].filename;
      // //checks where the extenstion is
      // if (filename.lastIndexOf('.')<=0) {
      //     return alert('Please ad valid file')
      // }
      // ///js filereader api
      //
      // console.log(fileReader.readAsDataURL(files[0]));
    },
    onMultiFileChanged(event){
      var selectedImgFiles = event.target.files;

      this.project_images = selectedImgFiles;
      console.log(this.project_images);
      //var multifileReader = new FileReader();


      // for (var i = 0; i < selectedImgFiles.length; i++) {
      //   // console.log(files[i]);
      //
      //
      //   this.project.project_images.push(selectedImgFiles[i]);
      //   //console.log(this.project_image);
      //
      // }
      // console.log(this.project.project_images);
      //console.log(files);
      //
      // fileReader.readAsDataURL(event.target.files[0]);
      // fileReader.onload = (event)=>{
      //   this.project.cover_img = event.target.result
      // }
      //console.log("Multiple Files Seleted",event);

      //console.log(this.user);
      // let filename = files[0].filename;
      // //checks where the extenstion is
      // if (filename.lastIndexOf('.')<=0) {
      //     return alert('Please ad valid file')
      // }
      // ///js filereader api
      //
      // console.log(fileReader.readAsDataURL(files[0]));
    },
    // uploadProject(){
    //   this.form.append('normal-data'.this.project)
    //   this.form.append('project_images',this.project_images);
    //   var config = {headers:{'Content-Type':'multipart/formdata'}}
    //   var user_id= this.$auth.getUserId();
    //   axios.post(apiDomain+"api/addProject",this.form,config)
    //        .then(response=>{
    //          console.log(response.data);
    //          // this.$router.push({name:"projects_view"});
    //        }).catch(function (error) {
    //         if (error.response) {
    //           // The request was made and the server responded with a status code
    //           // that falls out of the range of 2xx
    //           console.log(error.response.data);
    //           console.log(error.response.status);
    //           console.log(error.response.headers);
    //         } else if (error.request) {
    //           // The request was made but no response was received
    //           // `error.request` is an instance of XMLHttpRequest in the browser and an instance of
    //           // http.ClientRequest in node.js
    //           console.log(error.request);
    //         } else {
    //           // Something happened in setting up the request that triggered an Error
    //           console.log('Error', error.message);
    //         }
    //         console.log(error.config);
    //       });
    //   console.log(this.project);
    //
    // }
  }
}
</script>
<style>
</style>
