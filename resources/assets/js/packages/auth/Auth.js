export default function (Vue) {
  Vue.auth={
    //set tokens
    setToken(token,expiration,user_id){
      localStorage.setItem('token',token);
      localStorage.setItem('expiration',expiration);
      localStorage.setItem('user_id',user_id);
    },
    //get token
    getToken(){
      var token = localStorage.getItem('token');
      var expiration = localStorage.getItem('expiration');
      var user_id = localStorage.getItem('user_id');

      var user_credentionals ={
        'token' : token,
        'expiration' : expiration,
        'user_id' : user_id,
      }
      if (!token || !expiration||!user_id) {
        return null;
      } else {
        //checks if the token has expired
        if (Date.now() > parseInt(expiration)) {
          this.destroyToken();
        }else {
          return token;
        }
      }
    },
    //destroy token will be used to log out
    destroyToken(){
      localStorage.removeItem('token');
      localStorage.removeItem('expiration');
      localStorage.removeItem('user_id');

      return true;
    },
    getUserId(){
      var user_id = localStorage.getItem('user_id');
      return user_id;
    },
    //isAuthenticate
    isAuthenticated() {
      if (this.getToken()) {
        return true;
      }else {
        return false;
      }
    },
    logout(){
      if (this.destroyToken()) {
        return true;
      }else{
        return false;
      }
    }
  }
  //defines the properties of the vue properties
  //allows for the use of the $auth propert
  Object.defineProperties(Vue.prototype,{
    $auth:{
      get:()=>{
        return Vue.auth;
      }
    }
  })
};
