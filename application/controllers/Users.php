<?php
class Users extends CI_Controller {

    public function __construct() {
    	 parent::__construct();


    	$this->load->helper(array('form', 'url','security'));
        $this->load->model('user_model');
        $this->load->model('user_activity_model');
        $this->load->library(array('form_validation','session'));
        $this->load->library('pagination');
        $this->load->library('upload');
        $this->load->library('user_agent'); 
        error_reporting(0);
    } 

    public function download_pancard(){

      if ($this->session->userdata('logged_in')) {
                $session_data = $this->session->userdata('logged_in');
                
                 $data['admin_id'] = $session_data['admin_id'];
            $data['username'] = $session_data['username'];
            $data['roles'] = $session_data['roles'];
            $data['prop_access'] = $session_data['prop_access'];

            
            }
              else
        {
                redirect('Login','refresh');
        }

        $role1 = explode(",",$data['roles']);

        $user_id = base64_decode($this->uri->segment(3));
       
      $data['user']=$this->user_model->view_user_detail($user_id);
       foreach($data['user'] as $user){
          $user_name = $user['username'];
          $u_id = $user['user_id'];
        }

          if(($user_id == null OR $user_id == '') OR (!isset($u_id) OR $u_id !== $user_id OR $u_id == null OR $u_id == '')){

           show_404();
          exit();
          }


        if(!in_array("View Users List",$role1)) {
        $msg = $session_data['username']." ".'Try To Download Pancard for'." ".$user_name." ".'Pancard Download Access is Not Given to the'." ".$session_data['username'].'.';
        $this->user_activity_model->add('no_access',$msg,$session_data['username'],$session_data['admin_id']);  
        redirect('Admin/auth_error');
        }

    	  if(!empty($user_id)){
            //load download helper
            $this->load->helper('download');
            
            //get file info from database
            $fileInfo = $this->user_model->download_detail($user_id);
            $fileInfo1 = base64_decode($fileInfo);
            
            //file path
            $file = file_get_contents(base_url().'assets/images/uploads/pancard/'.$fileInfo1);

            $msg = $data['username']." ".'Downloaed Pancard For'." ".$user_name.'.';
                  $this->user_activity_model->add('download_document',$msg,$data['username'],$data['admin_id']);

            //download file from directory
            force_download($fileInfo1, $file);
            redirect('Users/view_user_detail/'.$this->security->xss_clean($user_id)); 
        }
    }

    public function download_aadharcard(){

      if ($this->session->userdata('logged_in')) {
                $session_data = $this->session->userdata('logged_in');
                
                $data['admin_id'] = $session_data['admin_id'];
            $data['username'] = $session_data['username'];
            $data['roles'] = $session_data['roles'];
            $data['prop_access'] = $session_data['prop_access'];

            
            }
              else
        {
                redirect('Login','refresh');
        }

       $role1 = explode(",",$data['roles']);

        $user_id = base64_decode($this->uri->segment(3));
      $data['user']=$this->user_model->view_user_detail($user_id);
       foreach($data['user'] as $user){
          $user_name = $user['username'];
          $u_id = $user['user_id'];
        }

          if(($user_id == null OR $user_id == '') OR (!isset($u_id) OR $u_id !== $user_id OR $u_id == null OR $u_id == '')){

           show_404();
          exit();
          }



        if(!in_array("View Users List",$role1)) {
        $msg = $session_data['username']." ".'Try To Download Aadhar Card for'." ".$user_name." ".'Aadhar Card Download Access is Not Given to the'." ".$session_data['username'].'.';
        $this->user_activity_model->add('no_access',$msg,$session_data['username'],$session_data['admin_id']);    
        redirect('Admin/auth_error');
        }

    
    	  if(!empty($user_id)){
            //load download helper
            $this->load->helper('download');
            
            //get file info from database
            $fileInfo = $this->user_model->download_detail_adhar($user_id);
            $fileInfo1 = base64_decode($fileInfo);
            
            //file path
            $file = file_get_contents(base_url().'assets/images/uploads/adharcard/'.$fileInfo1);

             $msg = $data['username']." ".'Downloaed Aadhar Card For'." ".$user_name.'.';
                  $this->user_activity_model->add('download_document',$msg,$data['username'],$data['admin_id']);

            //download file from directory
            force_download($fileInfo1, $file);
            redirect('Users/view_user_detail/'.$this->security->xss_clean($user_id));
        }
    }

    public function add_user() {
    	if ($this->session->userdata('logged_in')) {
                $session_data = $this->session->userdata('logged_in');
                
            $data['admin_id'] = $session_data['admin_id'];
            $data['username'] = $session_data['username'];
            $data['roles'] = $session_data['roles'];
            $data['prop_access'] = $session_data['prop_access'];

            }
              else
        {
                redirect('Login','refresh');
        }

        $role1 = explode(",",$data['roles']);

        if(!in_array("Users Master",$role1)) {
          $msg = $session_data['username']." ".'Try To Access Add User Page This Page Access is Not Given to the'." ".$session_data['username'].'.';
         $this->user_activity_model->add('no_access',$msg,$session_data['username'],$session_data['admin_id']);
        redirect('Admin/auth_error');
        }

         $msg = $session_data['username']." ".'Visited Add User Page.';
         $this->user_activity_model->add('visited_page',$msg,$session_data['username'],$session_data['admin_id']);
         $data['user_types'] = $this->user_model->view_user_type();
          $this->load->view('users_master',$this->security->xss_clean($data));

  }


    public function add_user_redirect() {
      if ($this->session->userdata('logged_in')) {
                $session_data = $this->session->userdata('logged_in');
                
                $data['admin_id'] = $session_data['admin_id'];
            $data['username'] = $session_data['username'];
           $data['roles'] = $session_data['roles'];
           $data['prop_access'] = $session_data['prop_access'];

            
            }
              else
        {
                redirect('Login','refresh');
        }
        $role1 = explode(",",$data['roles']);

        if(!in_array("Users Master",$role1)) {
         $msg = $session_data['username']." ".'Try To Access Add User Page This Page Access is Not Given to the'." ".$session_data['username'].'.';
         $this->user_activity_model->add('no_access',$msg,$session_data['username'],$session_data['admin_id']);  
        redirect('Admin/auth_error');
        }

         $data['user_types'] = $this->user_model->view_user_type();

          $this->form_validation->set_rules('user_type','User Type','required');
           $this->form_validation->set_rules('username','Username','required');
           $this->form_validation->set_rules('email', 'email', 'required|valid_email|is_unique[user_master.email]');
             $this->form_validation->set_rules('mobileno','Mobile No','required|regex_match[/^[0-9]{10}$/]');
             $this->form_validation->set_rules('address','Address','required');
             //$this->form_validation->set_rules('comapny_name','Company Name','required');
             $this->form_validation->set_rules('city','City','required');
             $this->form_validation->set_rules('state','State','required');
              $this->form_validation->set_rules('pincode','PinCode','required|regex_match[/^[1-9]{1}[0-9]{2}\\s{0,1}[0-9]{3}$/]');
              $this->form_validation->set_rules('gst_number','GST Number','regex_match[/^[0-9]{2}[A-Z]{5}[0-9]{4}[A-Z]{1}[1-9A-Z]{1}Z[0-9A-Z]{1}$/]');

             if($this->form_validation->run() === FALSE)
            {
             $this->load->view('users_master',$this->security->xss_clean($data));
            }
            else{

                 $this->user_model->add_user();
                 $this->session->set_flashdata("user","User Added Successfully");
                  $msg = $data['username']." ".'Added'." ".$this->input->post('username')." ".'User Details.';
                  $this->user_activity_model->add('added',$msg,$data['username'],$data['admin_id']);
                  if(in_array("View Users List",$role1)) {
                    redirect('Users/view_user');
                  } else {
                    redirect('Users/add_user');

                  }
            }   
      }  
     


      public function view_user() {
      	if ($this->session->userdata('logged_in')) {
                $session_data = $this->session->userdata('logged_in');
                
                $data['admin_id'] = $session_data['admin_id'];
            $data['username'] = $session_data['username'];
            $data['roles'] = $session_data['roles'];
            $data['prop_access'] = $session_data['prop_access'];

            
            }
              else
        {
                redirect('Login','refresh');
        }

        $role1 = explode(",",$data['roles']);

        if(!in_array("View Users List",$role1)) {
        $msg = $session_data['username']." ".'Try To Access View User List Page This Page Access is Not Given to the'." ".$session_data['username'].'.';
         $this->user_activity_model->add('no_access',$msg,$session_data['username'],$session_data['admin_id']);    
        redirect('Admin/auth_error');
        }

        $data['users'] = $this->user_model->view_user();
        $data['user_types'] = $this->user_model->view_user_type();
        $this->load->view('view_users_list',$this->security->xss_clean($data));
        $msg = $session_data['username']." ".'Visited View User List Page.';
        $this->user_activity_model->add('visited_page',$msg,$session_data['username'],$session_data['admin_id']);

    }

     public function user_filter()
    {
        if ($this->session->userdata('logged_in')) {
                $session_data = $this->session->userdata('logged_in');
                
                $data['admin_id'] = $session_data['admin_id'];
            $data['username'] = $session_data['username'];
            $data['roles'] = $session_data['roles'];
            $data['prop_access'] = $session_data['prop_access'];

            
            }
              else
        {
                redirect('Login','refresh');
        }

         $role1 = explode(",",$data['roles']);

        if(!in_array("View Users List",$role1)) {
        redirect('Admin/auth_error');
        }

        $data['users'] = $this->user_model->view_user();
        $data['user_types'] = $this->user_model->view_user_type();

        $user_type = $this->input->post('user_type');

        if($user_type !== ""){

        $query1 = $this->db->join('user_type_master','user_master.user_type_id = user_type_master.user_type_id');
        $query1 = $this->db->from('user_master');

        $where = "user_master.user_type_id='".$this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$user_type))."' AND activation_status = '".$this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",'Activated'))."'";

         $this->db->where($where);
         $query1 = $this->db->get();
         $data['users']  = $query1->result_array();

         $this->load->view('view_users_list',$this->security->xss_clean($data));

        } else {
          $this->session->set_flashdata("select_data","Please Select Any Filter Field For Search");
            redirect('Users/view_user/',$this->security->xss_clean($data));
        }

       

    }    

    public function user_document_upload(){


    	if ($this->session->userdata('logged_in')) {
                $session_data = $this->session->userdata('logged_in');
                
                 $data['admin_id'] = $session_data['admin_id'];
            $data['username'] = $session_data['username'];
            $data['roles'] = $session_data['roles'];
            $data['prop_access'] = $session_data['prop_access'];

            
            }
              else
        {
                redirect('Login','refresh');
        }
         $role1 = explode(",",$data['roles']);

        $user_id = base64_decode($this->uri->segment(3));
        $data['user']=$this->user_model->view_user_detail($user_id);
        foreach($data['user'] as $user){
          $user_name = $user['username'];
          $u_id = $user['user_id'];
        }

          if(($user_id == null OR $user_id == '') OR (!isset($u_id) OR $u_id !== $user_id OR $u_id == null OR $u_id == '')){

           show_404();
          exit();
          }


        if(!in_array("View Users List",$role1)) {
        $msg = $session_data['username']." ".'Try To Access Upload User Document Page For'." ".$user_name." ".' This Page Access is Not Given to the'." ".$session_data['username'].'.';
        $this->user_activity_model->add('no_access',$msg,$session_data['username'],$session_data['admin_id']);  
        redirect('Admin/auth_error');
        }

        $msg = $session_data['username']." ".'Visited Upload User Document Page For'." ".$user_name.".";
        $this->user_activity_model->add('visited_page',$msg,$session_data['username'],$session_data['admin_id']);
        $this->load->view('upload_user_document',$this->security->xss_clean($data));
    }	

    public function user_document_upload_redirect(){
    	if ($this->session->userdata('logged_in')) {
                $session_data = $this->session->userdata('logged_in');
                
                 $data['admin_id'] = $session_data['admin_id'];
            $data['username'] = $session_data['username'];
            $data['roles'] = $session_data['roles'];
            $data['prop_access'] = $session_data['prop_access'];

            
            }
              else
        {
                redirect('Login','refresh');
        }

         $role1 = explode(",",$data['roles']);

        if(!in_array("View Users List",$role1)) {
          $msg = $session_data['username']." ".'Try To Access Upload User Document Page For'." ".$user_name." ".' This Page Access is Not Given to the'." ".$session_data['username'].'.';
        $this->user_activity_model->add('no_access',$msg,$session_data['username'],$session_data['admin_id']);   
        redirect('Admin/auth_error');
        }

       // $this->form_validation->set_rules('pancard_no','Pancard No','regex_match[/^([a-zA-Z]){5}([0-9]){4}([a-zA-Z]){1}?$/]',array('regex_match' => 'Right Format is : 5letters,4digits,1letter'));
        $this->form_validation->set_rules('pancard_no','Pancard No','regex_match[/^([a-zA-Z]){5}([0-9]){4}([a-zA-Z]){1}?$/]');
        $this->form_validation->set_rules('adharcard_no','Aadhar Card No','numeric|min_length[12]|max_length[12]');


        $user_id = base64_decode($this->uri->segment(3));
        $data['user']=$this->user_model->view_user_detail($user_id);

        foreach($data['user'] as $user){
          $pancard_image1 = $user['pancard_image'];
          $pancard_no1 = $user['pancard_no'];
          $adharcard_image1 = $user['adharcard_image'];
          $adharcard_no1 = $user['adharcard_no'];
          $u_id = $user['user_id'];
        }

          if(($user_id == null OR $user_id == '') OR (!isset($u_id) OR $u_id !== $user_id OR $u_id == null OR $u_id == '')){

           show_404();
          exit();
          }

        if($this->form_validation->run() === FALSE)
        {
           $this->load->view('upload_user_document',$this->security->xss_clean($data));
        }
        else{

        	$pancard = $_FILES["pancard"]["name"];
            $adharcard = $_FILES["adharcard"]["name"];

             if ($pancard !== '') {
                $config['upload_path'] = './assets/images/uploads/pancard';
                $config['log_threshold'] = 1;
                $config['allowed_types'] = 'jpg|jpeg|png|pdf';
                $config['max_size'] = '2048';
                $config['max_width'] = '2048';
                $config['max_height'] = '2048';
                $config['encrypt_name'] = TRUE;
                $pancard = str_replace(' ', '_', $pancard);
                $config['file_name'] =$pancard;
                //$config['overwrite'] = true;
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                if (!$this->upload->do_upload('pancard')) {
                    $error = array('error' => $this->upload->display_errors());
                   $msg = 'pancard';
                   $this->session->set_flashdata('notsuccess',2);
                   redirect('Users/user_document_upload/'.$this->uri->segment(3));
                } else {
                	$ipath = ('assets/images/uploads/pancard/'.base64_decode($pancard_image1));
                     unlink($ipath);
                    $data1 = array('upload_data' => $this->upload->data());

                    $file_name = $upload_data['file_name'];
                    //$file_name1 = $data["upload_data1"]["file_name1"];
                }
            }
            
            if ($adharcard !== '') {
                $adharcard = str_replace(' ', '_', $adharcard);
                $config['file_name'] =$adharcard;
                $config['upload_path'] = './assets/images/uploads/adharcard';
                $config['allowed_types'] = 'jpg|jpeg|png|pdf';
                $config['max_size'] = '2048';
                $config['max_width'] = '2048';
                $config['max_height'] = '2048';
                $config['encrypt_name'] = TRUE;
                //$config['overwrite'] = TRUE;
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                if (!$this->upload->do_upload('adharcard')) {
                    $error = array('error' => $this->upload->display_errors());
                    //print_r($error);
                    $msg1 = 'adhar';
                    $this->session->set_flashdata('unsuccess',1);
                    redirect('Users/user_document_upload/'.$this->uri->segment(3));
                } else {
                	$ipath1 = ('assets/images/uploads/adharcard/'.base64_decode($adharcard_image1));
                     unlink($ipath1);
                   $data = array('upload_data1' => $this->upload->data());
                     //$file_name1 = $upload_data1['file_name'];

                 
                 }

            }
	            if(!empty($data1['upload_data']['file_name'])){
	            	$pancard_image = base64_encode($data1['upload_data']['file_name']);
	        	}else{
	        		$pancard_image = $pancard_image1;
	         	} 	

	         	 if(!empty($data['upload_data1']['file_name'])){
	            	$adharcard_image = base64_encode($data['upload_data1']['file_name']);
	        	}else{
	        		$adharcard_image = $adharcard_image1;
	         	}

	         	if(!empty($this->input->post('pancard_no'))){
	         		$pancard_no = $this->input->post('pancard_no');	
	         	}else{
	         		$pancard_no = $pancard_no1;
	         	} 


	         	if(!empty($this->input->post('adharcard_no'))){
	         		$adharcard_no = $this->input->post('adharcard_no');	
	         	}else{
	         		$adharcard_no = $adharcard_no1;
	         	} 
          $msg = $session_data['username']." ".'Uploaded Document For'." ".$user['username']. '.';
          $this->user_activity_model->add('uploaded_document',$msg,$session_data['username'],$session_data['admin_id']);  
	        $this->user_model->upload_user_document($user_id,$pancard_image,$adharcard_image,$pancard_no,$adharcard_no); 
	        $this->session->set_flashdata("upload_document","User Document Uploaded Successfully");
	        redirect('Users/view_user');		


        }
        	
    }

    public function add_user_type() {


          if ($this->session->userdata('logged_in')) {
                $session_data = $this->session->userdata('logged_in');
                
                 $data['admin_id'] = $session_data['admin_id'];
            $data['username'] = $session_data['username'];
            $data['roles'] = $session_data['roles'];
            $data['prop_access'] = $session_data['prop_access'];

            
            }
              else
        {
                redirect('Login','refresh');
        }

         $role1 = explode(",",$data['roles']);

        if(!in_array("User Type Master",$role1)) {
        $msg = $session_data['username']." ".'Try To Access User Type Master Page This Page Access is Not Given to the'." ".$session_data['username'].'.';
        $this->user_activity_model->add('no_access',$msg,$session_data['username'],$session_data['admin_id']);
        redirect('Admin/auth_error');
        }

           $data['users'] = $this->user_model->view_user_type();
           $msg = $session_data['username']." ".'Visited User Type Master Page.';
           $this->user_activity_model->add('visited_page',$msg,$session_data['username'],$session_data['admin_id']);
           $this->load->view('user_type_master',$this->security->xss_clean($data));
       
    }

    public function user_type_insert(){
        if ($this->session->userdata('logged_in')) {
                $session_data = $this->session->userdata('logged_in');
                
                 $data['admin_id'] = $session_data['admin_id'];
            $data['username'] = $session_data['username'];
            $data['roles'] = $session_data['roles'];
            $data['prop_access'] = $session_data['prop_access'];

            
            }
              else
        {
                redirect('Login','refresh');
        }
         $role1 = explode(",",$data['roles']);

        if(!in_array("User Type Master",$role1)) {
        $msg = $session_data['username']." ".'Try To Access User Type Master Page This Page Access is Not Given to the'." ".$session_data['username'].'.';
        $this->user_activity_model->add('no_access',$msg,$session_data['username'],$session_data['admin_id']);  
        redirect('Admin/auth_error');
        }

         $data['users'] = $this->user_model->view_user_type();
       $this->form_validation->set_rules('user_type','User Type','required');

         if($this->form_validation->run() == false)
        {
       
            $this->load->view('user_type_master',$this->security->xss_clean($data));


           
        }
        else{

            $query = $this->user_model->insertusertype();
            $this->session->set_flashdata("user_type","User Type Added Successfully");
             $msg = $data['username']." ".'Added User Type Named'." " .$this->input->post('user_type'). '.';
                  $this->user_activity_model->add('added',$msg,$data['username'],$data['admin_id']);
            redirect("Users/add_user_type","refresh",$this->security->xss_clean($data));

        }
    }


        public function delete_user_detail(){
            if ($this->session->userdata('logged_in')) {
                $session_data = $this->session->userdata('logged_in');
                
                $data['admin_id'] = $session_data['admin_id'];
            $data['username'] = $session_data['username'];
            $data['roles'] = $session_data['roles'];
            $data['prop_access'] = $session_data['prop_access'];

            
            }
           else
        {
          redirect('Login','refresh');
        }

        $role1 = explode(",",$data['roles']);

          $user_id = base64_decode($this->uri->segment(3));
         $data['user']=$this->user_model->view_user_detail($user_id);

        foreach($data['user'] as $user){
          $pancard_image = $user['pancard_image'];
          $adharcard_image = $user['adharcard_image'];
           $user_name = $user['username'];
           $u_id = $user['user_id'];
        }

          if(($user_id == null OR $user_id == '') OR (!isset($u_id) OR $u_id !== $user_id OR $u_id == null OR $u_id == '')){

           show_404();
          exit();
          }

        if(!in_array("View Users List",$role1)) {
        $msg = $session_data['username']." ".'Try To Delete User Data For'." ".$user_name." ".'User Delete Access is Not Given to the'." ".$session_data['username'].'.';
        $this->user_activity_model->add('no_access',$msg,$session_data['username'],$session_data['admin_id']);    
        redirect('Admin/auth_error');
        }
       $ipath = ('assets/images/uploads/pancard/'.base64_decode($pancard_image));
       unlink($ipath);
       $ipath1 = ('assets/images/uploads/adharcard/'.base64_decode($adharcard_image));
       unlink($ipath1);

        $this->user_model->delete_user_detail($user_id);
        $this->session->set_flashdata("user_delete","User Deleted successfully.");
        $msg = $data['username']." ".'Deleted User Details For'." ".$user['username']. '.';
          $this->user_activity_model->add('deleted',$msg,$data['username'],$data['admin_id']);
        redirect("Users/view_user","refresh");
    }

       public function view_user_detail(){

       	if ($this->session->userdata('logged_in')) {
                $session_data = $this->session->userdata('logged_in');
                
                 $data['admin_id'] = $session_data['admin_id'];
            $data['username'] = $session_data['username'];
            $data['roles'] = $session_data['roles'];
            $data['prop_access'] = $session_data['prop_access'];

            
            }
              else
        {
                redirect('Login','refresh');
        }

        $role1 = explode(",",$data['roles']);

        $user_id = base64_decode($this->uri->segment(3));
       $data['user']=$this->user_model->view_user_detail($user_id);

         foreach($data['user'] as $user){
          $user_name = $user['username'];
          $u_id = $user['user_id'];
         }

          if(($user_id == null OR $user_id == '') OR (!isset($u_id) OR $u_id !== $user_id OR $u_id == null OR $u_id == '')){

           show_404();
          exit();
          }



        if(!in_array("View Users List",$role1)) {
        $msg = $session_data['username']." ".'Try To View User Data For'." ".$user_name." ".'View User Page Access is Not Given to the'." ".$session_data['username'].'.';
        $this->user_activity_model->add('no_access',$msg,$session_data['username'],$session_data['admin_id']);      
        redirect('Admin/auth_error');
        }

        $this->load->view('view_single_user',$this->security->xss_clean($data));
        $msg = $data['username']." ".'Viewed User Details For'." ".$user_name. '.';
          $this->user_activity_model->add('viewed',$msg,$data['username'],$data['admin_id']);
    }

    public function edit_user_detail(){
    	if ($this->session->userdata('logged_in')) {
                $session_data = $this->session->userdata('logged_in');
                
                 $data['admin_id'] = $session_data['admin_id'];
            $data['username'] = $session_data['username'];
            $data['roles'] = $session_data['roles'];
            $data['prop_access'] = $session_data['prop_access'];

            
            }
              else
        {
                redirect('Login','refresh');
        }

        $role1 = explode(",",$data['roles']);

        $user_id = base64_decode($this->uri->segment(3));
      $data['users']=$this->user_model->view_user_detail($user_id);

      foreach($data['users'] as $user){
        $user_name = $user['username'];
        $u_id = $user['user_id'];
        }
          if(($user_id == null OR $user_id == '') OR (!isset($u_id) OR $u_id !== $user_id OR $u_id == null OR $u_id == '')){

           show_404();
          exit();
          }

        if(!in_array("View Users List",$role1)) {
        $msg = $session_data['username']." ".'Try To View Edit User Data Page For'." ".$user_name." ".'Edit USer Data Page Access is Not Given to the'." ".$session_data['username'].'.';
        $this->user_activity_model->add('no_access',$msg,$session_data['username'],$session_data['admin_id']);  
        redirect('Admin/auth_error');
        }

    	
    	 $data['user_types'] = $this->user_model->view_user_type();
       $msg = $session_data['username']." ".'Visited Edit User Data Page For'." ".$user_name.'.';
       $this->user_activity_model->add('visited_page',$msg,$session_data['username'],$session_data['admin_id']);
       $this->load->view('edit_user',$this->security->xss_clean($data));    
    }

     public function edit_user_redirect(){
      if ($this->session->userdata('logged_in')) {
                $session_data = $this->session->userdata('logged_in');
                
                 $data['admin_id'] = $session_data['admin_id'];
            $data['username'] = $session_data['username'];
            $data['roles'] = $session_data['roles'];
            $data['prop_access'] = $session_data['prop_access'];

            
            }
              else
        {
                redirect('Login','refresh');
        }

        $role1 = explode(",",$data['roles']);

        $user_id = base64_decode($this->uri->segment(3));
      $data['users']=$this->user_model->view_user_detail($user_id);
       $data['user_types'] = $this->user_model->view_user_type();
       //$this->load->view('edit_user',$data);
       $original_data = '';
        $is_unique = '';
       
       foreach ($data['users'] as $row) {
          $original_data = $row['email'];
          $user_name = $row['username'];
          $u_id = $row['user_id'];
        }

          if(($user_id == null OR $user_id == '') OR (!isset($u_id) OR $u_id !== $user_id OR $u_id == null OR $u_id == '')){

           show_404();
          exit();
          }


        if(!in_array("View Users List",$role1)) {
        $msg = $session_data['username']." ".'Try To View Edit User Data Page For'." ".$user_name." ".'Edit USer Data Page Access is Not Given to the'." ".$session_data['username'].'.'; 
        $this->user_activity_model->add('no_access',$msg,$session_data['username'],$session_data['admin_id']); 
        redirect('Admin/auth_error');
        }

      
    if($this->input->post('email') !== $original_data) {
           $is_unique =  '|is_unique[user_master.email]';
           
        }
        else{
          $is_unique = '';
        }
        if(empty($this->input->post('username'))){
         $this->form_validation->set_rules('username','Username','required|callback_mysql_remove_spec_char'); }
         if(empty($this->input->post('user_type')) || $this->input->post('user_type') == " "){
         $this->form_validation->set_rules('user_type','User Type','required');}
          if(empty($this->input->post('email'))){
             $this->form_validation->set_rules('email', 'email', 'required');
          }
           if(!empty($this->input->post('email'))){
             $this->form_validation->set_rules('email', 'email', 'valid_email'.$is_unique);
           }
              if(empty($this->input->post('mobileno'))){
             $this->form_validation->set_rules('mobileno','Mobile No','required');}
             if(!empty($this->input->post('mobileno'))){
             $this->form_validation->set_rules('mobileno','Mobile No','regex_match[/^[0-9]{10}$/]');}
              if(empty($this->input->post('address'))){
             $this->form_validation->set_rules('address','Address','required');}
              if(empty($this->input->post('city'))){
             $this->form_validation->set_rules('city','City','required');}
              if(empty($this->input->post('state'))){
             $this->form_validation->set_rules('state','State','required');}
              if(empty($this->input->post('pincode'))){
             $this->form_validation->set_rules('pincode','PinCode','required');}
             if(!empty($this->input->post('pincode'))){
             $this->form_validation->set_rules('pincode','PinCode','regex_match[/^[1-9]{1}[0-9]{2}\\s{0,1}[0-9]{3}$/]');}
              $this->form_validation->set_rules('gst_number','GST Number','regex_match[/^[0-9]{2}[A-Z]{5}[0-9]{4}[A-Z]{1}[1-9A-Z]{1}Z[0-9A-Z]{1}$/]');        
              //print_r(preg_replace("/[!@#$%^&*(){}:;<>,.?]/"," ",$this->input->post('username')));exit();
     if($this->input->post('submit')){  
        if ($this->form_validation->run() == FALSE)
         { 
             $this->load->view('edit_user',$this->security->xss_clean($data));
          } 

    
       else
    {

           
              
                 $query = $this->user_model->update_user($user_id);

                 $this->session->set_flashdata("user_update","User Updated Successfully");

                 $msg = $data['username']." ".'Updated'." ".$this->input->post('username'). " ".'User Details.';
                  $this->user_activity_model->add('updated',$msg,$data['username'],$data['admin_id']);

                redirect('Users/view_user');

      } }  
      else
      {
       $user_id = base64_decode($this->uri->segment(3));
      $data['users']=$this->user_model->view_user_detail($user_id);
       $data['user_types'] = $this->user_model->view_user_type();
       $this->load->view('edit_user',$this->security->xss_clean($data));
      }    
    }

    public function update_user_type(){
      if ($this->session->userdata('logged_in')) {
                $session_data = $this->session->userdata('logged_in');
                
                $data['admin_id'] = $session_data['admin_id'];
            $data['username'] = $session_data['username'];
            $data['roles'] = $session_data['roles'];
            $data['prop_access'] = $session_data['prop_access'];

            
            }
              else
        {
                redirect('Login','refresh');
        }

        $role1 = explode(",",$data['roles']);


      $user_type_id = base64_decode($this->uri->segment(3));
     
       $data['user_types'] = $this->user_model->get_user_type($user_type_id);

       foreach($data['user_types'] as $user_type){
        $user_type = $user_type['user_type'];
       }

       foreach($data['user_types'] as $user_type => $val) {
        $user_type_id1 = $val['user_type_id'];
      }
        if(($user_type_id == null OR $user_type_id == '') OR (!isset($user_type_id1) OR $user_type_id1 !== $user_type_id OR $user_type_id1 == null OR $user_type_id1 == '')){

           show_404();
          exit();
          }

        if(!in_array("User Type Master",$role1)) {
           $msg = $session_data['username']." ".'Try To Use Update User Type Page For'." ".$user_type." ".'Update User Type Page Access is Not Given to the'." ".$session_data['username'].'.'; 
        $this->user_activity_model->add('no_access',$msg,$session_data['username'],$session_data['admin_id']); 
        redirect('Admin/auth_error');
        }
        $msg = $session_data['username']." ".'Visited Update User Type Page For'." ".$user_type.'.';
       $this->user_activity_model->add('visited_page',$msg,$session_data['username'],$session_data['admin_id']);
        $this->load->view('update_user_type',$this->security->xss_clean($data));

    }

     public function update_user_type_redirect(){
      if ($this->session->userdata('logged_in')) {
                $session_data = $this->session->userdata('logged_in');
                
                $data['admin_id'] = $session_data['admin_id'];
            $data['username'] = $session_data['username'];
            $data['roles'] = $session_data['roles'];
            $data['prop_access'] = $session_data['prop_access'];

            
            }
              else
        {
                redirect('Login','refresh');
        }

        $role1 = explode(",",$data['roles']);

        $user_type_id = base64_decode($this->uri->segment(3));
       $data['user_types'] = $this->user_model->get_user_type($user_type_id);

       foreach($data['user_types'] as $user_type){
        $user_type = $user_type['user_type'];
       }

       foreach($data['user_types'] as $user_type => $val) {
        $user_type_id1 = $val['user_type_id'];
      }

        if(($user_type_id == null OR $user_type_id == '') OR (!isset($user_type_id1) OR $user_type_id1 !== $user_type_id OR $user_type_id1 == null OR $user_type_id1 == '')){

           show_404();
          exit();
          }

        if(!in_array("User Type Master",$role1)) {
        $msg = $session_data['username']." ".'Try To Use Update User Type Page For'." ".$user_type." ".'Update User Type Page Access is Not Given to the'." ".$session_data['username'].'.'; 
        $this->user_activity_model->add('no_access',$msg,$session_data['username'],$session_data['admin_id']);   
        redirect('Admin/auth_error');
        }


       $this->form_validation->set_rules('user_type','User Type','required');

        if($this->form_validation->run() == false)
        {
       
            $this->load->view('update_user_type',$this->security->xss_clean($data));


           
        }
        else{

               $query = $this->user_model->update_user_type($user_type_id);

               $this->session->set_flashdata("user_type_update","User Type Updated Successfully");

                $msg = $data['username']." ".'Updated'." ".$this->input->post('user_type'). " ".'User Type Details.';
                  $this->user_activity_model->add('updated',$msg,$data['username'],$data['admin_id']);

              redirect('Users/add_user_type');

            } 


    }

    public function add_faq(){

      if ($this->session->userdata('logged_in')) {
                $session_data = $this->session->userdata('logged_in');
                
                $data['admin_id'] = $session_data['admin_id'];
            $data['username'] = $session_data['username'];
            $data['roles'] = $session_data['roles'];
            $data['prop_access'] = $session_data['prop_access'];

            
            }
              else
        {
                redirect('Login','refresh');
        }

        $this->load->view('add_faq',$data);
        $msg = $data['username']." ".'Visited Add FAQ Page.';
        $this->user_activity_model->add('visited_page',$msg,$data['username'],$data['admin_id']);

    }

        public function add_faq_redirect(){

      if ($this->session->userdata('logged_in')) {
                $session_data = $this->session->userdata('logged_in');
                
                $data['admin_id'] = $session_data['admin_id'];
            $data['username'] = $session_data['username'];
            $data['roles'] = $session_data['roles'];
            $data['prop_access'] = $session_data['prop_access'];

            
            }
              else
        {
                redirect('Login','refresh');
        }

        $this->form_validation->set_rules('faq_title','FAQ Title','required');
        $this->form_validation->set_rules('faq_description','FAQ Description','required');

           if($this->form_validation->run() === FALSE)
        {
            $this->load->view('add_faq',$this->security->xss_clean($data));
        }
        else{
            $this->user_model->add_faq();
            $this->session->set_flashdata("add_faq","FAQ Details Added Successfully");
            $msg = $session_data['username']." ".'Added FAQ For'." ".$this->input->post('faq_title').'.';
            $this->user_activity_model->add('added',$msg,$data['username'],$data['admin_id']);
            redirect('Users/view_faq');
        } 


    }

    public function view_faq(){

      if ($this->session->userdata('logged_in')) {
                $session_data = $this->session->userdata('logged_in');
                
                $data['admin_id'] = $session_data['admin_id'];
            $data['username'] = $session_data['username'];
            $data['roles'] = $session_data['roles'];
            $data['prop_access'] = $session_data['prop_access'];

            
            }
              else
        {
                redirect('Login','refresh');
        }

        $data['view_faq'] = $this->user_model->view_faq();
        $this->load->view('view_faq',$this->security->xss_clean($data));
        $msg = $data['username']." ".'Visited View FAQ Page.';
        $this->user_activity_model->add('visited_page',$msg,$data['username'],$data['admin_id']);

    }

    public function filter_faq(){

      if ($this->session->userdata('logged_in')) {
                $session_data = $this->session->userdata('logged_in');
                
                $data['admin_id'] = $session_data['admin_id'];
            $data['username'] = $session_data['username'];
            $data['roles'] = $session_data['roles'];
            $data['prop_access'] = $session_data['prop_access'];

            
            }
              else
        {
                redirect('Login','refresh');
        }

        $faq_title = $this->input->post('faq_title');

        if($faq_title !== ""){ 
        $this->db->order_by('faq_id','desc');
        $this->db->from('faq_master');
        $this->db->like('faq_title', $this->db->escape_str(preg_replace("/[!@#$%^*(){};<>,\|=+]/"," ",$faq_title)));
         $query1 = $this->db->get();
         $data['view_faq']  = $query1->result_array();
         $this->load->view('view_faq',$this->security->xss_clean($data));

        } else {
          $this->session->set_flashdata("select_data","Please Select Any Filter Field For Search");
            redirect('Users/view_faq/',$this->security->xss_clean($data));
        }  

        $data['view_faq'] = $this->user_model->view_faq();

    }

}    	