<!-- google button-->
       <template id="googleBtn">
        <button ref="signinBtn" class="btn btn-danger btn-block" @click="store.state.googleLoading = true"><i class="fa fa-refresh fa-spin mx-2"  v-if="store.state.googleLoading"></i><i class="fa fa-google-plus mr-2" v-else></i> Sign in with Google</button>
    </template>
    
   
<!--modal for google set username and password-->
  <template id="google-set-user-pw">
      <div class="modal d-md-block mt-5">
<div class="modal-dialog">
    <div class="modal-content text-white">
      <div class="modal-header bg-danger">
       
        <div class="container">
           <div class="col-md-12">
               <div class="row">
                <img :src="user.picture" alt="" class="img-fluid rounded-circle img-thumbnail" width="100" height="100" style="margin-top:-50px;">
                   <p class="m-3">Hi, <b>{{user.firstname}} {{user.lastname}}</b></p>
            <p class="m-3 h5 text-center"><i class="fa fa-google-plus fa-lg mr-3"></i>Set your username and password before you login to your account.</p>
            </div>
            </div>
        </div>
        <button type="button" class="close text-white" @click="$emit('close')">
          <span aria-hidden="true" >&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="col-md-12">
        <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text">
                      <i class="fa fa-user"></i>
                    </span>
                  </div>
                  <input type="text" class="form-control"  placeholder="Enter Username" v-model="user.username" name="username">
                </div>
                <p class="text-danger" v-html="validation.username"></p>
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text">
                      <i class="fa fa-lock"></i>
                    </span>
                  </div>
                  <input type="password" class="form-control"  placeholder="Your password"  v-model="user.password" name="password">
                </div>
                <p class="text-danger" v-html="validation.password"></p>
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text">
                      <i class="fa fa-lock"></i>
                    </span>
                  </div>
                  <input type="password" class="form-control" placeholder="Retype password"  v-model="user.confirm_password" name="confirm_password">
                </div>
      <p class="text-danger" v-html="validation.confirm_password"></p>
                <div class="row">
                  <div class="col-12">
                      <input type="submit" class="btn btn-danger btn-block px-4" @click="google_register()" value="Register" >
                  </div>
                </div>
                      </div>
                    </div>
                  </div>
                         </div>
                     </div>
  </template>
  
 
<!--modal of register, forgot password, enter code, reset password-->
<template id="rg-fp-modal">
    <transition 
          enter-active-class="animated fadeInLeft"
    leave-active-class="animated rollOut"><div class="modal d-md-block mt-5" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title"><slot name="head"></slot></h5>
        <button type="button" class="close text-white" @click="$emit('close')">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <slot name="body"></slot>
      </div>
      <div class="modal-footer">
       <slot name="foot"></slot>
      </div>
    </div>
  </div>
</div></transition>
</template>


<!--success alert of register and forgot password-->
<template id="success-alert">
    <transition 
          enter-active-class="animated fadeIn"
    leave-active-class="animated fadeOut"> 
<p class='alert alert-success position-absolute w-50' style="z-index:1">{{message}}</p>
</transition>
</template>