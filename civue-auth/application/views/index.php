 <body class="app flex-row align-items-center">
    <div id="login" class="container">
      <div class="row justify-content-center mt-5">
        <div class="col-md-8">
         
          <div class="card-group"> 
          <message :message="successMSG" v-if="successMSG"></message>
          <message :message="store.state.successMSG" v-if="store.state.successMSG"></message>
            <div class="card p-4">
              <div class="card-body">
                <h1>Login</h1>
                   <p class="text-danger text-center" v-html="message.failed" v-if="message.failed"></p>
                  <p v-else class="text-muted text-center">Sign In to your account</p>
                  
                <div class="input-group mt-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text">
                      <i class="fa fa-user"></i>
                    </span>
                  </div>
                  <input type="text" class="form-control red-tooltip" placeholder="Username" name="username"v-model="userLogin.username">
                </div>
                <p class="text-danger" v-if="message.username" v-html="message.username"></p>
                
                
                <div class="input-group mt-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text">
                      <i class="fa fa-lock"></i>
                    </span>
                  </div>
                  <input type="password" class="form-control" placeholder="Password" name="password"v-model="userLogin.password" id="password">
                </div>
                
                
                <p class="text-danger" v-if="message.password" v-html="message.password"></p>
             
                <div class="input-group mt-3">
                   <div class="form-check">
                    </div>
                    <input type="submit" class="btn btn-primary btn-block mt-2"  value="Login" @click="login()">
                </div>
                <hr>
                <div class="row">
                    <google-login @done="getGUserLogIn" class="mx-5" /> 
                </div>
              </div>
            </div>
            <message :message="successMSG" v-if="successMSG"></message>
          <message :message="store.state.successMSG" v-if="store.state.successMSG"></message>
            <div class="card text-white bg-primary py-5 d-md-down-none">
              <div class="card-body text-center" >
                
                  <h2>Sign up</h2>
                  <p class="fa fa-users" style="font-size:70px"></p><br>
                  <a class="btn btn-primary active mt-3" @click="registerForm=true">Register Now!</a><br>
                  
                  
            
              </div>
              <div class="card-body text-center">
                       <button class="btn btn-primary" @click="store.state.forgotPassword = true">Forgot your password?</button>
                 
              </div>
            </div>
          </div>
        </div>
      </div>
       <transition 
          enter-active-class="animated rubberBand"
    leave-active-class="animated bounceOut">
     <set-user-pw v-if="store.state.setUserPassword" @close="store.commit('closeSetUserPw'); store.commit('googleLoading')" :google_user='google_login' :validation="google_validation" @register-user = 'googleRegister'>
     </set-user-pw>
     </transition>
     
     
    <?php include'includes/modal.php'?>
    </div> <!-- end el:#login -->
    
    <?php include'includes/vue_templates.php';?>
    
  