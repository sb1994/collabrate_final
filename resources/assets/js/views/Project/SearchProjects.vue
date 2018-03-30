<template lang="html">
  <div id="search">
    <loggedin-navbar></loggedin-navbar>
    <input type="text" id="search-box" v-model="searchText" v-on:keyup="getSelectedProjects()" placeholder="Search Project Term">
    <!-- <select v-model="selectedCategory" on:change="getFilteredProjects()">
      <option disabled selected :value"">Selet category</option>
      <option v-for="category in categories" :value="category.id">{{category.name}}</option>
    </select> -->
    <!-- <project-thumbnail v-for="project in projects" :project="project" :key="project.id"></project-thumbnail> -->
    <div class="row">
        <search-results v-for="project in projects" :project="project" :key="project.id"></search-results>
    </div>
    <!-- <search-results v-for="project in projects" ></search-results> -->
    <!-- <pre>{{searchText}}</pre>
    <pre>{{selectedCategory}}</pre>
    <pre>{{projects}}</pre> -->

    <!-- <pre>{{categories}}</pre> -->
  </div>
</template>

<script>
  import {apiDomain} from '../../config';
  import LoggedinNavBar from '../../components/LoggedinNavBar.vue';
  import SearchResults from './SearchResults.vue';
export default {

  data(){
    return{
      projects:[],
      searchText:'',
      categories:[],
      selectedCategory:''
    }
  },
  components:{
    'search-results':SearchResults,
    'loggedin-navbar':LoggedinNavBar
  },
  created(){
    this.path = apiDomain;
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
    axios.get(apiDomain+'api/getAllProjects')
      .then(response=>{
              this.projects = response.data.projects;
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
    getSelectedProjects(){
      //var searchInput = this.searchInput;
      //console.log(this.searchText);

      //console.log(this.searchInput);
      //console.log(apiDomain+"api/getSelectedProjects/"+this.searchText);
    if(this.searchText.length > 1){
        axios.get(apiDomain+'api/getSelectedProjects/'+this.searchText)
        .then(response=>{
              this.projects = response.data.projects.data;
              //console.log(response.data);
              console.log(this.projects);
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
      }else {
        axios.get(apiDomain+'api/getAllProjects/')
        .then(response=>{
              this.projects = response.data.projects;
              //console.log(response.data);
              console.log(this.projects);
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
      }
    },
    getFilteredProjects(){
      if(this.searchText.length > 1 && this.selectedCategory !== ""){
        console.log("Project Term: " + this.searchText + " Selected category_id: " + selectedCategory);
        //   axios.get(apiDomain+'api/getSelectedProjects/'+this.searchText)
        //   .then(response=>{
        //         this.projects = response.data.projects.data;
        //         //console.log(response.data);
        //         console.log(this.projects);
        //       }
        //   ).catch(function (error) {
        //      if (error.response) {
        //        // The request was made and the server responded with a status code
        //        // that falls out of the range of 2xx
        //        console.log(error.response.data);
        //        console.log(error.response.status);
        //        console.log(error.response.headers);
        //      } else if (error.request) {
        //        // The request was made but no response was received
        //        // `error.request` is an instance of XMLHttpRequest in the browser and an instance of
        //        // http.ClientRequest in node.js
        //        console.log(error.request);
        //      } else {
        //        // Something happened in setting up the request that triggered an Error
        //        console.log('Error', error.message);
        //      }
        //      console.log(error.config);
        //    });
        // }else {
        //   axios.get(apiDomain+'api/getAllProjects/')
        //   .then(response=>{
        //         this.projects = response.data.projects;
        //         //console.log(response.data);
        //         console.log(this.projects);
        //       }
        //   ).catch(function (error) {
        //      if (error.response) {
        //        // The request was made and the server responded with a status code
        //        // that falls out of the range of 2xx
        //        console.log(error.response.data);
        //        console.log(error.response.status);
        //        console.log(error.response.headers);
        //      } else if (error.request) {
        //        // The request was made but no response was received
        //        // `error.request` is an instance of XMLHttpRequest in the browser and an instance of
        //        // http.ClientRequest in node.js
        //        console.log(error.request);
        //      } else {
        //        // Something happened in setting up the request that triggered an Error
        //        console.log('Error', error.message);
        //      }
        //      console.log(error.config);
        //    });
      }
  },
}
}
</script>

<style lang="css">
</style>
