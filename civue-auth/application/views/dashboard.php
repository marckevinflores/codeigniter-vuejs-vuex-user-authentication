
<body style="padding-top:5rem" class="bg-white">
          <nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top">
          <div class="collapse navbar-collapse justify-content-md-center">
              <a class="navbar-brand" href="#">Welcome, <?php echo $userData->firstname.' '.$userData->lastname;?></a>
          </div>
      
        <a href="user/logout" class="btn btn-primary active ml-auto">Logout</a>
    </nav>
    <div  class="container" >
      <div style="padding:1rem 1.5rem; text-align:center">
    <div class="container-fluid">
       
       
       
       
       
        <ul class="nav nav-tabs justify-content-center">
  <li class="nav-item">
    <a class="nav-link active" href="#profile" data-toggle="tab">Profile</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="#post" data-toggle="tab">Post</a>
  </li>
</ul>
 
     <div class="tab-content">
     <div class="tab-pane active" id="profile" role="tabpanel" role="tab">
        <div class="container bg-white">
            <div class="row">
                <div class="col-md-4">
                  <img src="<?php echo ($userData->picture == '' ? base_url().'assets/img/no_image.png' : $userData->picture );?>" class="img-fluid img-thumbnail bg-primary rounded-circle w-100 h-100">
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="firstname">Firstname:</label>
                        <h3><?php echo $userData->firstname;?></h3>
                    </div>
                    <div class="form-group">
                       <label for="firstname">Lastname:</label>
                        <h3><?php echo $userData->lastname;?></h3>
                    </div>
                    <div class="form-group">
                        <label for="firstname">Username:</label>
                        <h3><?php echo $userData->username;?></h3>
                    </div>
                    <div class="form-group">
                       <label for="firstname">Email:</label>
                        <h3><?php echo $userData->email;?></h3>
                    </div>
                </div>
                <div class="col-md-4">
                     <div class="form-group">
                        <label for="firstname">Provider:</label>
                        <h3><?php echo ($userData->oauth_provider =='' ? 'Not Google User':$userData->oauth_provider);?></h3>
                    </div>
                    <div class="form-group">
                       <label for="firstname">Google ID:</label>
                        <h3><?php echo ($userData->oauth_uid =='' ? 'Not Google User':$userData->oauth_uid);?></h3>
                    </div>
                    </div>
                </div>
                
            </div>
        </div>
         <div class="tab-pane" id="post" role="tabpanel" role="tab">
        <h1 class="jumbotron bg-primary text-white">Hello, Programmers, Developers :)</h1>
    </div>
        </div>
        
        </div>
    </div>

    </div>