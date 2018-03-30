<template>
  <section id="reg">
 <div>


                    <div class="section-title">
                         <h3 class="text-center">Edit Profile</h3>
                        <hr>
                        <h2 class="text-center">Personalise Your Profile</h2>
                    </div>
<div class="col-md-offset-1 col-md-10 col-sm-12">
    <div class="container">

      <div class="form-group">
        <label for="profile_img" class="label-control"></label>
        <input type="file" id="profile_img" name="profile_img" value="" class="form-control" v-on:change="onFileChanged">
      </div>
      <div class="form-group">
        <label for="disable-img">
          Keep Currnent image
          <input type="checkbox" name="disable-img" id="disable-img" v-model="disableImg">
        </label>
      </div>



	  <div class="col-md-6 col-sm-6">
      <div class="form-group">
        <label for="name" class="label-control">Name</label>
        <input type="text" id="name" name="name" value="" class="form-control" v-model="user.name">
      </div>
	  </div>
	 <!-- <div class="col-md-6 col-sm-6">
      <div class="form-group">
        <label for="password" class="label-control">Password</label>
        <input type="text" name="password" id="password" value="" class="form-control" v-model="user.password">
      </div>
	  </div>-->
	  <div class="col-md-6 col-sm-6">
      <div class="form-group">
        <label for="skill" class="label-control">Skill</label>
        <input type="text" name="skill" id="skill" value="" class="form-control" v-model="user.skill">
      </div>
	  </div>
	  <div class="col-md-6 col-sm-6">
      <div class="form-group">
        <label for="country" class="label-control">Country</label>
        <input type="text" name="country" id="country" value="" class="form-control" v-model="user.country">
      </div>
	  </div>
	  <div class="col-md-6 col-sm-6">
      <div class="form-group">
        <label for="city" class="label-control">City</label>
        <input type="text" name="city" id="city" value="" class="form-control" v-model="user.city">
      </div>
	  </div>
	  <div class="col-md-6 col-sm-6">
      <div class="form-group">
        <label for="profession" class="label-control">Profession</label>
        <input type="text" name="profession" id="profession" value="" class="form-control" v-model="user.profession">
      </div>
	  </div>
	  <div class="col-md-6 col-sm-6">
      <div class="form-group">
        <label for="interest" class="label-control">Main Interest</label>
        <input type="text" name="interest" id="interest" value="" class="form-control" v-model="user.main_intrest">
      </div>
	  </div>
	 <div class="col-md-12 col-sm-12">
      <div class="form-group">
        <label for="biography" class="label-control">Biography</label>
        <!--<input type="text" name="biography" id="biography" value="" class="form-control" v-model="user.biography">-->
		<textarea class="form-control" rows="5" placeholder="Biography" v-model="user.biography"></textarea>
      </div>
	  </div>

      <div class="form-group">
        <!-- <label for="role" class="label-control">Role</label>-->

        <!--<input type="checkbox" name="role"  value="" class="form-control" v-model="user.role_id"> -->
      </div>
      <div class="form-group">
        <label class="label-control">Role
          <!-- {{this.roles}} -->
          <label class="checkbox-inline" v-for="role in roles">
            <input type="radio" name="role" v-bind:value="role.id" v-model="user.role_id">{{role.title}}
          </label>
        </label>
      </div>
	   <div class="col-md-2 col-sm-4">

        <button type="button" class="form-control pull-center text-center submit" name="button"  v-on:click="editProfile">Update</button>
		 </div>

    </div>
    <pre>
      {{user}}
    </pre>
    <pre>
      {{disableImg}}
    </pre>
  </div>
  </div>
   </section>
</template>
<script>
import {apiDomain} from '../../config';
export default{

  data(){
    return{
      user:{
        user_id:parseInt(this.$auth.getUserId()),
        name:"",
        skill:"",
        country:"",
        city:"",
        profession:"",
        main_interest:"",
        biography:"",
        profile_img:"",
        role_id:"",
      },
      disableImg:"",
      error:{},
      roles:{},
      isProssessing:false
    }
  },
  created(){
    //console.log(apiDomain+'api/getUserRoles');
    axios.get(apiDomain+'api/getUserRoles')
         .then(response=>{
           this.roles= response.data.roles;
          console.log(this.roles);
         }
       )
       console.log(apiDomain+'api/showProfile/'+this.$auth.getUserId());
       axios.get(apiDomain+'api/showProfile/'+this.$auth.getUserId())
            .then(response=>{
              //this.roles= response.data.roles;
              this.user = response.data[0];

             console.log('Currnent User Info :'+this.user);
            }
          )
  },
  methods:{
    editProfile(){
      var user_id= this.$auth.getUserId();

      if (this.disableImg) {
        //console.log('Image Wont be updated');
        this.user.profile_img = "";
      }
      axios.post(apiDomain+"api/editProfile",this.user)
           .then(response=>{
             console.log(response.data);
             this.$router.push({name:"profile"});
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
      console.log(this.user);
      // if (event.target.files.length <=0) {
      //   this.user.profile_img = "";
      // }
      // axios.post(apiDomain+"api/editProfile",this.user)
      //      .then(response=>{
      //        console.log(response.data);
      //        this.$router.push({name:"profile"});
      //      }).catch(function (error) {
      //       if (error.response) {
      //         // The request was made and the server responded with a status code
      //         // that falls out of the range of 2xx
      //         console.log(error.response.data);
      //         console.log(error.response.status);
      //         console.log(error.response.headers);
      //       } else if (error.request) {
      //         // The request was made but no response was received
      //         // `error.request` is an instance of XMLHttpRequest in the browser and an instance of
      //         // http.ClientRequest in node.js
      //         console.log(error.request);
      //       } else {
      //         // Something happened in setting up the request that triggered an Error
      //         console.log('Error', error.message);
      //       }
      //       console.log(error.config);
      //     });
      //console.log(this.user);
    },
    onFileChanged(event){
      //const files = event.target.files;
      const fileReader = new FileReader();

      fileReader.readAsDataURL(event.target.files[0]);
      fileReader.onload = (event)=>{
        this.user.profile_img = event.target.result
      }

      console.log(this.user);
      // let filename = files[0].filename;
      // //checks where the extenstion is
      // if (filename.lastIndexOf('.')<=0) {
      //     return alert('Please ad valid file')
      // }
      //
      // console.log(fileReader.readAsDataURL(files[0]));
    },
  }
}
</script>
<style>



#reg .col-md-6,
#reg .col-md-12 {
  padding-left: 0px;
}

#reg .form-control {
  border: 1px solid #f0f0f0;
  box-shadow: none;
  margin-bottom: 10px;
  transition: all 0.4s ease-in-out;
}

#reg .form-control:hover {
  border-color: #777;
}

#reg input,
#reg select {
  height: 50px;
}

#reg .submit {
  background: #222;
  border-radius: 100px;
  border: none;
  color: #ffffff;
  font-weight: 400;
  transition: all 0.4s ease-in-out;
}

#reg .submit:hover {
  background: #000;
}

</style>
