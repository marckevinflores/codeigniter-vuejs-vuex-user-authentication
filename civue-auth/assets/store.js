const store = new Vuex.Store({
        state:{
             gUser:{firstname:'', lastname:'',email:'',oauth_provider:'Google',oauth_uid:'', picture:''},
            setUserPassword : false,
            gValidation:[],
            
            loadingBtn:false, //send mail loading
            googleLoading:false, //google loading
            
            //forgot password
            forgotPassword: false,
            sendMail:{email:''},
            emailValidate:'',
            //enter code
            showEnterCode:false,
            checkCode:{code:'', email:''},
            codeValidation:'',
            //reset password
            showResetPw:false,
            resetPw:{pw:'', c_pw:''},
            resetPwValidation:'',
           
            userInfo:{},
            successMSG:'' //show message if completely change your password
        },
        mutations:{
            googleLoading(state){ 
              state.googleLoading = false  
            },
            closeSetUserPw(state){
              state.setUserPassword = false
                 state.gValidation = []
                
            },
            google_user(state, user){ //getting google user info pass to state.gUser
                  var profile = user.getBasicProfile()
                state.gUser.firstname = profile.getGivenName();
                state.gUser.lastname = profile.getFamilyName();
                state.gUser.email = profile.getEmail();
                state.gUser.oauth_uid = profile.getId();
                state.gUser.picture = profile.getImageUrl();
            },
            loadingBtn(state){ 
              state.loadingBtn = false  
            },
            closeForgotPw(state){
                state.forgotPassword = false,
                state.sendMail.email=''
                state.emailValidate = ''
            },
            closeEnterCode(state){
                state.showEnterCode = false,
                state.checkCode = {code:'', email:''}
                state.codeValidation = ''
            },
            closeResetPw(state){
                state.showResetPw = false,
                state.resetPw = {pw:'', c_pw:''}
                state.resetPwValidation = ''
            },
            showEnterCode(state, bl){
             return state.showEnterCode = bl
            },
            showSetUserPassword(state, bl){
             return state.setUserPassword = bl
            },
            showResetPassword(state, bl){
             return state.showResetPw = bl
            },
            showValidationForm(state, msg){
                return state.gValidation = msg
            },
            emailValidate(state, msg){
                return state.emailValidate = msg
            },
            codeValidate(state, msg){
                return state.codeValidation = msg
            },
             resetValidation(state, msg){
                return state.resetPwValidation = msg
            },
             getEmail(state, info){
                 state.checkCode.email = info //get user email then pass to enter code modal
            },
             getInfo(state, info){
                 state.userInfo = info //get userinfo from json data response, controller: user/check_for_code, pass info to reset password 
            },
            successMessage(state, msg){
                state.successMSG =  msg
            },
            clearMSG(state){
         setTimeout(function(){
			  state.successMSG =  ''
			 },3000);  //disappear alert message when 
    }
            
        },
      actions: {
          googleData(context, user) {
            const params = new URLSearchParams();
            var profile = user.getBasicProfile()
            params.append('firstname', profile.getGivenName());
            params.append('lastname', profile.getFamilyName());
            params.append('oauth_uid', profile.getId());
            params.append('picture', profile.getImageUrl());
            params.append('email', profile.getEmail());
    axios.post(url+'user/check_google_user', params).then(function(response){
            if(response.data.user_exists){
                window.location.href = response.data.redirect;
                context.commit('showSetUserPassword', false)  
            }else{
                context.commit('google_user', user)
                context.commit('showSetUserPassword', true)
            }
        }).catch(function(err) {
        console.log(err.response.data);
        }); 
    },
          
          
          
    googleRegister(context, user){
         axios.post(url+'user/google_user_register', user).then(function(response){
                if(response.data.error){
                    context.commit('showValidationForm', response.data.message)
                   
                }else{
                    context.commit('googleLoading')
                      context.commit('showSetUserPassword', false)
                     window.location.href = response.data.redirect;
                }
            })
    },
              sendEmail(state){
          const data = new URLSearchParams();
            data.append('email', this.state.sendMail.email);
           axios.post(url+'user/forgot_password', data).then(function(response){
                if(response.data.error){
                    state.commit('emailValidate', response.data.message)
                    state.commit('loadingBtn')
                }else{
                    state.commit('emailValidate', '')
                    state.commit('loadingBtn')
                    state.commit('getEmail', response.data.email)
                    state.commit('showEnterCode', true)
                    
                }
            })
        },
    enterCode(state){
        const data = new URLSearchParams();
            data.append('email', this.state.checkCode.email);
            data.append('code', this.state.checkCode.code);
        axios.post(url+'user/check_for_code', data).then(function(response){
                if(response.data.error){
                    state.commit('codeValidate', response.data.message)
                }else{
                    state.commit('codeValidate', '')
                    state.commit('getInfo', response.data.user_info)
                    state.commit('showResetPassword', true)
                }
            })
    },
    resetPassword(state){
         const data = new URLSearchParams();
            data.append('id', this.state.userInfo.id);
            data.append('password', this.state.resetPw.pw);
            data.append('confirm_password', this.state.resetPw.c_pw);
         axios.post(url+'user/change_password', data).then(function(response){
                if(response.data.error){
                    state.commit('resetValidation', response.data.message)
                }else{
                    state.commit('closeForgotPw');
                    state.commit('closeEnterCode');
                    state.commit('closeResetPw');
                    state.commit('clearMSG');
                    state.commit('successMessage', response.data.message);
                  
                }
            })
    },
          
  },
        getters:{
          user(state){
              return state.gUser; //pass gUser to auth.js
          },
        
        }
    
    })