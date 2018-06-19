
//show google login popup window
Vue.component('google-login', {
  template: '#googleBtn',
  beforeCreate () {
    gapi.load('auth2', () => {
      const auth2 = gapi.auth2.init({
        client_id: 'Your_Client_ID'
      })
      auth2.attachClickHandler(this.$refs.signinBtn, {}, googleUser => {
        this.$emit('done', googleUser)
      }, error => store.commit('googleLoading'))
    })
  }
})

//set username and password if your google account is not registered
Vue.component('set-user-pw', {
  template: '#google-set-user-pw',
    props:['google_user','validation'],
    data(){
      return{
          
          user:{
              firstname: this.google_user.firstname,
              lastname: this.google_user.lastname,
              email: this.google_user.email,
              picture: this.google_user.picture,
              oauth_provider: this.google_user.oauth_provider,
              oauth_uid: this.google_user.oauth_uid,
              username: '',
              password: '',
              confirm_password: '',
          },
         
      }  
    },
    methods:{
        google_register(){
          this.$emit('register-user', this.toFormData(this.user))
        },
          toFormData: function(obj){
			var form_data = new FormData();
			for(var key in obj){
				form_data.append(key, obj[key]);
			}
			return form_data;
		},
 }
})

//modal for forgot password and register
Vue.component('modal', {
  template: '#rg-fp-modal',
})


Vue.component('message', {
  template: '#success-alert',
    props:['message'],
})
var v = new Vue({
    el:"#login",
    data:{
        userLogin:{username:'', password:''},
        message:'',
        formValidation:{},
        registerForm:false,
       
        
        
         userRegister:{firstname:'', lastname:'',username:'',email:'',password:'',confirm_password:''},
        successMSG:'',
        rValidate:{},

    },
    computed:{
       google_login(){
          return store.getters.user //pass google user info into props display to template
       }, 
        google_validation(){
            return store.state.gValidation; //get google validation in store.js using vuex
        }
        },
    methods:{
        login(){
            var userlogin = v.toFormData(v.userLogin);
            axios.post(url+'user/login', userlogin).then(function(response){
                if(response.data.error){
                    v.message = response.data.message;
                }else{
                     window.location.href = response.data.message.success;
                }
            }) //for login user
        },
         getGUserLogIn(user){
              store.dispatch('googleData', user) //getting google user info store to store.js using vuex
        },
        googleRegister(user){
          store.dispatch('googleRegister', user) //getting google user info with set username and password 
        },
         closeRegisterForm(){
            v.registerForm = false
            v.formValidation = {},
            v.rValidate=''
            v.userRegister = {
                firstname:'', 
                lastname:'',
                username:'',
                email:'',
                password:'',
                confirm_password:''} // 
         },
         register(){
            var regForm = v.toFormData(v.userRegister);
            axios.post(url+'user/register', regForm).then(function(response){
                if(response.data.success){
                    v.successMSG = response.data.message.success;
                    v.rValidate = '';
                    v.userRegister = {firstname:'', lastname:'',username:'',email:'',password:'',confirm_password:''}
                    v.registerForm = false
                     v.clearMSG()
                }else{
                   
                    v.rValidate = response.data.message;
                }
            }) // register user
        },
         clearMSG(){
            setTimeout(function(){
			 v.successMSG=''
			 },3000); //disappear alert message 
        },
        
          toFormData: function(obj){
			var form_data = new FormData();
			for(var key in obj){
				form_data.append(key, obj[key]);
			}
			return form_data;
		},
    }
})

