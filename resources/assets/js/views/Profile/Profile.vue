<template>
  <div class="row">
  <loggedin-navbar></loggedin-navbar>
  <div class="container-fluid">
    <div class="col-md-3">

	<div class="container-img">
  <img v-bind:src='path + "/storage/img/profile_img/" + user.profile_img' class="img-responsive" alt="">

  <div class="centered"><h2>{{user.name}}</h2></div>
</div>

      <div class="panel panel-default">
        <div class="panel-body">
          <p></p>
          <small><h4>Profession:</h4> {{user.profession}}</small>
		  <hr>
		  <small><h4>Biography</h4></small>

		  <p>{{user.biography}}</p>
		  <hr>
          <p></p>
		  <article>
		  <small><h4>Location</h4></small>
		  <p>{{user.city}} , {{user.country}}</p>
		  <hr>



		   <small><h4>Social Networks</h4></small>

			<div class="footer-social-links">
		  <a href="#" title="Facebook" target="_blank"><i class="fa fa-facebook"></i></a>
		  <a href="#" title="Twitter" target="_blank"><i class="fa fa-twitter"></i></a>
		  <a href="#" title="Google+" target="_blank"><i class="fa fa-google-plus"></i></a>
		  <a href="#" title="LinkedIn+" target="_blank"><i class="fa fa-linkedin"></i></a>
		  <a href="#" title="Dribbble" target="_blank"><i class="fa fa-instagram"></i></a>
		  </div>

		  <hr>
		  </article>
          <p>Joined: {{user.created_at}}</p>
        <div class="btn btn-default pull-center" v-if="user.id==this.$auth.getUserId()">
              <router-link :to="{name:'profile_edit'}">Edit profile</router-link>
           </div>


        </div>
      </div>
    </div>
    <div class="col-md-9">
      <profile-navbar></profile-navbar>
      <transition appear>
      <router-view></router-view>
    </transition>

    </div>
	</div>
  <!-- {{user}} -->
  </div>

</template>
<script>
import {apiDomain} from '../../config';
import ProfileNavBar from '../../components/ProfileNavBar.vue';
import LoggedinNavBar from '../../components/LoggedinNavBar.vue';
import Projects from '../Project/Projects.vue';



import Details from './Details';
import axios from 'axios';
export default{
  components:{
    'profile-details':Details,
    'profile-navbar':ProfileNavBar,
    'loggedin-navbar':LoggedinNavBar,
    Projects
  },
  data(){
    return{
        user:{
          name: "",
          profile_img: "default.png"
        },
        path: apiDomain
    }


  },
  created(){


      //console.log("isAuthenticated:"+this.$auth.isAuthenticated());

    if (this.$auth.isAuthenticated()) {
      //console.log("logged in");
      var user_id =this.$auth.getUserId();
      var apiCallDomain=apiDomain+'api/showProfile/'+user_id;


      //console.log(apiCallDomain);
      axios.get(apiCallDomain)
            .then(response=>{
                this.user = response.data[0];
                //console.log(response.data);
                console.log(this.user);
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
    else {
      this.$router.push('/login');

      console.log("logged out");
    }

    var user = [{}];


    // console.log(apiCallDomain);
    //console.log(123);
  },
  methods:{

  }
}
</script>
<style>
body {
    margin: 0;
    padding:0;/*added this*/
    font-family: Helvetica, Arial, san-serif;
    font-size: 16px;
    color: #35342f;
}

img {border:none;}
a {text-decoration:none;}

h2{
    font-size: 22px;
    font-weight: 700;
    text-transform: uppercase;
	letter-spacing: 5px;
	line-height: 27px;
    margin:0;
    /*margin-bottom: 20px; moved to title div*/
    /*background:pink;/*for testing*/
}

p{
font-size: 14px;
line-height:22px;

}


.pull-center{
	margin-left:25%;
}

/* Container holding the image and the text */
.container-img {
    position: relative;
    text-align: center;
    color: white;
}



/* Centered text */
.centered {
    position: absolute;
    top: 80%;
    left: 50%;
    transform: translate(-50%, -50%);
}


/*social links*/


@import url("//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css");


.footer-social-links
{
    font-size: 14px;
  text-align: center;
  margin-top: 10%;
   margin-bottom: 10%;

}
.footer-social-links a
{
    width: 25px;
    height: 25px;
    line-height: 25px !important;
    position: relative;
    margin: 0 5px;
    text-align: center;
    display: inline-block;
    color: #111;

    -webkit-transition: all 0.27s cubic-bezier(0.300, 0.100, 0.580, 1.000);
    -moz-transition: all 0.27s cubic-bezier(0.300, 0.100, 0.580, 1.000);
    -o-transition: all 0.27s cubic-bezier(0.300, 0.100, 0.580, 1.000);
    -ms-transition: all 0.27s cubic-bezier(0.300, 0.100, 0.580, 1.000);
    transition: all 0.27s cubic-bezier(0.300, 0.100, 0.580, 1.000);
}
.footer-social-links a i,
.footer-social-links a span{
    position: relative;
    top: 2px;
    left: 1px;
}
.footer-social-links a:before{
    content: "";
    display: inline-block;
    width: 100%;
    height: 100%;
    position: absolute;
    top: 0;
    left: 0;
    border: 1px solid #111;

    -webkit-border-radius: 2px;
    -moz-border-radius: 2px;
    border-radius: 2px;

    -webkit-transform: rotate(45deg);
    -moz-transform: rotate(45deg);
    -o-transform: rotate(45deg);
    -ms-transform: rotate(45deg);
    transform: rotate(45deg);

    -webkit-transition: all 0.27s cubic-bezier(0.300, 0.100, 0.580, 1.000);
    -moz-transition: all 0.27s cubic-bezier(0.300, 0.100, 0.580, 1.000);
    -o-transition: all 0.27s cubic-bezier(0.300, 0.100, 0.580, 1.000);
    -ms-transition: all 0.27s cubic-bezier(0.300, 0.100, 0.580, 1.000);
    transition: all 0.27s cubic-bezier(0.300, 0.100, 0.580, 1.000);

}
.footer-social-links a:hover{
    color: #fff;
}
.footer-social-links a:hover:before{
    background: #111;
}

</style>
