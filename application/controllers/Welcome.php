<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
    function __construct()
	{
		parent::__construct();
		
		$this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));
		$this->lang->load('auth');
	}
	
	
	public function index()
	{
	    	    	    
	    if ($this->ion_auth->logged_in() )	    
	    {
	        $id = $this->session->userdata('user_id');
	        $level = $this->ion_auth->get_users_groups($id)->row('id');
	        if ($level==NULL){
	            $data['level'] = '4';
	        } else {
	            $data['level'] = $level;
	        }
            $data['main_view'] = 'welcome_message';
	        $this->load->view('template', $data);
	    }else{
			/*
	        $data['level'] = '0';
	        $data['main_view'] = 'welcome_message';
	        $this->load->view('template', $data);
			*/
			redirect('Login','refresh');
	    }
	    		
	}
	
	public function akun()
	{
	    if ($this->ion_auth->logged_in() )
	    {
	        $id = $this->session->userdata('user_id');
	        $level = $this->ion_auth->get_users_groups($id)->row('id');
	       if ($level==NULL){
	            $data['level'] = '4';
	        } else {
	            $data['level'] = $level;
	        }
            $data['main_view'] = 'master/akun/akun_view';
            $this->load->view('template', $data);
	    }else{
	        redirect('Login','refresh');	        
	    }	    
	}	
	
	public function country()
	{
	    if ($this->ion_auth->logged_in())
	    {
	        $id = $this->session->userdata('user_id');
	        $level = $this->ion_auth->get_users_groups($id)->row('id');
	        if ($level==NULL){
	            $data['level'] = '4';
	        } else {
	            $data['level'] = $level;
	        }
	        $data['main_view'] = 'master/country/country_view';
	        $this->load->view('template', $data);
	    }else{
	        redirect('Login','refresh');
	    }
	}
	
	public function city()
	{
	    if ($this->ion_auth->logged_in())
	    {
	        $id = $this->session->userdata('user_id');
	        $level = $this->ion_auth->get_users_groups($id)->row('id');
	        if ($level==NULL){
	            $data['level'] = '4';
	        } else {
	            $data['level'] = $level;
	        }
	        $data['main_view'] = 'master/city/city_view';
	        $this->load->view('template', $data);
	    }else{
	        redirect('Login','refresh');
	    }
	}
	
	public function biaya()
	{
	    if ($this->ion_auth->logged_in())
	    {
	        $id = $this->session->userdata('user_id');
	        $level = $this->ion_auth->get_users_groups($id)->row('id');
	        if ($level==NULL){
	            $data['level'] = '4';
	        } else {
	            $data['level'] = $level;
	        }
	        $data['main_view'] = 'master/sector/sek_view';
	        $this->load->view('template', $data);
	    }else{
	        redirect('Login','refresh');
	    }
	}
	
	public function beban()
	{
	    if ($this->ion_auth->logged_in())
	    {
	        $id = $this->session->userdata('user_id');
	        $level = $this->ion_auth->get_users_groups($id)->row('id');
	        if ($level==NULL){
	            $data['level'] = '4';
	        } else {
	            $data['level'] = $level;
	        }
	        $data['main_view'] = 'master/beban/beban_view';
	        $this->load->view('template', $data);
	    }else{
	        redirect('Login','refresh');
	    }
	}
	
	public function entry()
	{
	    if ($this->ion_auth->logged_in())
	    {
	        $id = $this->session->userdata('user_id');
	        $level = $this->ion_auth->get_users_groups($id)->row('id');
	        if ($level==NULL){
	            $data['level'] = '4';
	        } else {
	            $data['level'] = $level;
	        }
	        $data['main_view'] = 'master/entry/entry_view';
	        $this->load->view('template', $data);
	    }else{
	        redirect('Login','refresh');
	    }
	}
	
	public function approval()
	{
	    if ($this->ion_auth->logged_in())
	    {
	        $id = $this->session->userdata('user_id');
	        $level = $this->ion_auth->get_users_groups($id)->row('id');
	        if ($level==NULL){
	            $data['level'] = '4';
	        } else {
	            $data['level'] = $level;
	        }
	        $data['main_view'] = 'master/approval/approval_view';
	        $this->load->view('template', $data);
	    }else{
	        redirect('Login','refresh');
	    }
	}
	
	public function report($r)
	{	
	    if ($this->ion_auth->logged_in())
	    {
	        $id = $this->session->userdata('user_id');
	        $level = $this->ion_auth->get_users_groups($id)->row('id');
	        if ($level==NULL){
	            $data['level'] = '4';
	        } else {
	            $data['level'] = $level;
	        }
			if ($r == '0'){
			$data['main_view'] = 'reports';
			$this->load->view('template', $data);
			}
			if ($r == 'rpt1')
			{
				echo($r);
			}
	    }else{
	        redirect('Login','refresh');
	    }		
	}	
	
	function logout()
	{
	    $this->data['title'] = "Logout";
	    //log the user out
	    $logout = $this->ion_auth->logout();
	    //redirect ke halaman sebelumnya
	    redirect('Login','refresh');
	}
	
}
