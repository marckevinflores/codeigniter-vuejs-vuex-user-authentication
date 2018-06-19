<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Accounts extends My_Controller {

	public function view($page = 'index')
{
        if ( ! file_exists(APPPATH.'views/'.$page.'.php'))
        { show_404(); 
        }
        $data['google_user'] = $this->session->userdata('google_user');
        if($page == 'index'){
            $this->loggedIn();
        }else{
            $this->notLoggedIn();
            $data['userData'] = $this->user_model->get_userdata($this->session->userdata('user_id'));
        }
        $this->load->view('includes/head');
        $this->load->view($page, $data);
        $this->load->view('includes/foot');
} 

}
