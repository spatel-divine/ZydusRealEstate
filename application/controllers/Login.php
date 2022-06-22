<?php

class Login extends CI_Controller {

    public function __construct() {
    	 parent::__construct();
    	$this->load->helper(array('form', 'url','captcha','security'));
        $this->load->library('session');
        $this->load->model('user_model');
        $this->load->library('form_validation');

        $this->load->helper('captcha');
		error_reporting(0);
    }

    public function index() {

        $this->load->view('index');

    }

    public function logon() {
        $this->load->library('form_validation');
        
        $this->form_validation->set_rules('username', 'username', 'required');

        $this->form_validation->set_rules('password', 'password', 'required|callback_check_database');

        $this->form_validation->set_rules('no2', 'Code', 'required');

		if ($this->form_validation->run() == FALSE) {

			  $username = $this->input->post('username');
		        $result = $this->user_model->get_user_data($username);
		         foreach ($result as $row) {
		            $admin_id1 = $row['admin_id'];
		            $admin_username = $row['username'];
		          }  

		          $pwd_result = $this->user_model->view_password_by_id($admin_id1);
		         foreach ($pwd_result as $pwd) {
		            $histroy_pwd = $pwd['password'];
		            $added_date = $pwd['pwd_added_date'];
		          }  

             if(!empty($this->input->cookie('log_cookie')) && !empty($this->input->cookie('log_uname'))){

                if($admin_username !== $this->input->post('username')){
                    $this->session->set_flashdata("login_fail","Username Does Not Exists");


                } else {  

                	if($this->input->cookie('log_uname') == base64_encode($this->input->post('username'))){

                		$cookie_data = base64_decode($this->input->cookie('log_cookie'));
                        $count = $cookie_data + 1;

                        setcookie("log_cookie",base64_encode($count),time()+60*60);

                	}

                	else {
                		//setcookie("log_cookie", "", time() - 3600);
                        //setcookie("log_uname", "", time() - 3600);
                		setcookie("log_cookie",base64_encode(1),time()+60*60);
                        setcookie("log_uname",base64_encode($admin_username),time()+60*60);

                	}

                  
                }   

            } else {

                if($admin_username !== $this->input->post('username')){
                    $this->session->set_flashdata("login_fail","Username Does Not Exists");


                } else {
                  //setcookie("log_cookie", "", time() - 3600);
                  //setcookie("log_uname", "", time() - 3600);	
                  setcookie("log_cookie",base64_encode(1),time()+60*60);
                  setcookie("log_uname",base64_encode($admin_username),time()+60*60);
                }

            }
                  if(base64_decode($this->input->cookie('log_cookie')) >= 5){
                    if($admin_username !== $this->input->post('username')){
                    
                        $this->session->set_flashdata("login_fail","Username Does Not Exists");
                        $this->load->view('index.php');


                    }  else {

                    	if($this->input->post('username') == base64_decode($this->input->cookie('log_uname'))){
                    		$this->user_model->update_user_status($admin_id1);
                    	    $this->session->set_flashdata("account_lock","Your Account is locked after 5 consecutive fail attempt");
                    	    setcookie("log_cookie", "", time() - 3600);
                     		setcookie("log_uname", "", time() - 3600);
                    	    //$this->load->view('index.php');
                    	    redirect('Login/index','refresh');
                    	} else {

                    		$this->session->set_flashdata("login_fail","Username or Password may be wrong or Your Account is Locked out");	
                    		$this->load->view('index.php');

                    	}
                    	
            

                    }                 
                    
                  }
              if(base64_decode($this->input->cookie('log_cookie')) <= 4){  

                    if($admin_username !== $this->input->post('username')){

                        $this->session->set_flashdata("login_fail","Username Does Not Exists");
                        $this->load->view('index.php');


                    } 
                    else {

                    
                    			$this->session->set_flashdata("login_fail","Username or Password may be wrong or Your Account is Locked out");	
                                $this->load->view('index.php');

					       
                    }
                }

		          //$expiry_date = date('Y-m-d',strtotime($added_date. ' + 90 days')); 

		          $current_date = date('Y-m-d');

		          // Calculating the difference in timestamps
		            $diff = strtotime($current_date) - strtotime($added_date);
		            
		            // 1 day = 24 hours
		            // 24 * 60 * 60 = 86400 seconds
		            $final_date = abs(round($diff / 86400));

                if(!empty($this->input->post('username'))){

                  if($final_date >= 90 AND $admin_username == $this->input->post('username')){
                $this->session->set_flashdata("change_password","Password is Expired Change Your Password For Login");
                redirect('Login/change_password/'.base64_encode($admin_id1));

              }

                }

      	 } else {


          	 if ($this->session->userdata('logged_in')) {
                $session_data = $this->session->userdata('logged_in');
                
            $data['admin_id'] = $session_data['admin_id'];
            $data['username'] = $session_data['username'];
            $data['roles'] = $session_data['roles'];
            $data['prop_access'] = $session_data['prop_access'];
            
            }

              $username = $this->input->post('username');
                $result = $this->user_model->get_user_data($username);
                 foreach ($result as $row) {
                    $admin_id1 = $row['admin_id'];
                    $admin_username = $row['username'];
                  }  

                  $pwd_result = $this->user_model->view_password_by_id($admin_id1);
                 foreach ($pwd_result as $pwd) {
                    $histroy_pwd = $pwd['password'];
                    $added_date = $pwd['pwd_added_date'];
                  }  


                    $current_date = date('Y-m-d');

                  // Calculating the difference in timestamps
                    $diff = strtotime($current_date) - strtotime($added_date);
                    
                    // 1 day = 24 hours
                    // 24 * 60 * 60 = 86400 seconds
                    $final_date = abs(round($diff / 86400));

                  if($final_date >= 90 AND $admin_username == $this->input->post('username')){
                    $this->session->set_flashdata("change_password","Password is Expired Change Your Password For Login");
                    redirect('Login/change_password/'.base64_encode($admin_id1));

                  } else {
                       $this->load->model('user_activity_model');

                     $msg = $data['username']." ".'logged in to the System.';
                     $this->user_activity_model->add('logged_in',$msg,$data['username'],$data['admin_id']);
                     setcookie("log_cookie", "", time() - 3600);
                     setcookie("log_uname", "", time() - 3600);
                     redirect('Admin/dashboard');

                    } 

                  }


    }
        
    /*function check_database() {

      $username = $this->input->post('username');
      $password = base64_encode($this->input->post('password'));
   

      $recaptchaResponse = trim($this->input->post('g-recaptcha-response'));
       
      $userIp=$this->input->ip_address();
         
      $secret=$this->config->item('google_secret');
       
      $credential = array(
            'secret' => $secret,
            'response' => $this->input->post('g-recaptcha-response')
        );

       $verify = curl_init();
      curl_setopt($verify, CURLOPT_URL, "https://www.google.com/recaptcha/api/siteverify");
      curl_setopt($verify, CURLOPT_POST, true);
      curl_setopt($verify, CURLOPT_POSTFIELDS, http_build_query($credential));
      curl_setopt($verify, CURLOPT_SSL_VERIFYPEER, false);
      curl_setopt($verify, CURLOPT_RETURNTRANSFER, true);
      $response = curl_exec($verify);
 
      $status= json_decode($response, true);

       if(!$status['success']){
        $this->session->set_flashdata('message', 'Sorry Google Recaptcha Unsuccessful!!');
      }

     

      if($status['success']){

        $result = $this->user_model->logon($username, $password);

                  if ($result) {
                      $sess_array = array();
                      foreach ($result as $row) {
                          $sess_array = array(
                              'admin_id'=>$row->admin_id,
                              'username'=>$row->username,
                              'password' => $row->password,
                              'role_name' => $row->role_name,
                              'roles' => $row->roles,
                              'prop_access' => $row->property_access,
                          );

                          
                          $this->session->set_userdata('logged_in', $sess_array);
                      }
                      return TRUE;  
      }  

                
        }
    }*/

    function check_database(){

      $code1 = $this->input->post('no1');
      $code2 = $this->input->post('no2');

      $username = $this->input->post('username');
      $password = base64_encode($this->input->post('password'));

      if($code1 !== $code2){
        $this->session->set_flashdata('message', 'Sorry Enter Valid Captcha Code');
      }

      if($code1 == $code2){

        $result = $this->user_model->logon($username, $password);

                  if ($result) {
                      $sess_array = array();
                      foreach ($result as $row) {
                          $sess_array = array(
                              'admin_id'=>$row->admin_id,
                              'username'=>$row->username,
                              'password' => $row->password,
                              'role_name' => $row->role_name,
                              'roles' => $row->roles,
                              'prop_access' => $row->property_access,
                          );

                          
                          $this->session->set_userdata('logged_in', $sess_array);
                      }
                      return TRUE;  
       }

      } 
        

    }

    public function change_password(){

       $user_id = base64_decode($this->uri->segment(3)); 
       $data['result'] = $this->user_model->get_user_data1($user_id);
       $this->session->set_flashdata("pwd_expire","Your Password is Expire Please Change Your Password By Using this Form");
       $this->load->view('change_password',$this->security->xss_clean($data));

    }

     public function change_password_redirect(){

       $user_id = base64_decode($this->uri->segment(3)); 
       $data['result'] = $this->user_model->get_user_data1($user_id);
       $this->session->set_flashdata("pwd_expire","Your Password is Expire Please Change Your Password By Using this Form");

        $this->form_validation->set_rules('new_password','New Password','required|min_length[9]|max_length[15]|regex_match[/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%^&*_=+-]).{9,15}$/]',array('regex_match' => 'Passowrd Must Contain Upper Case,Lower Case,Special Characters and Numerals'));
        $this->form_validation->set_rules('conf_password','Confrim Password','required|matches[new_password]');
        $data['pwd_histroy'] = $this->user_model->view_password_for_change_pwd($user_id);
        $pwd = array();

        foreach($data['pwd_histroy'] as $histroy){

                $pwd[] = $histroy['password'];

                
        }

        $conf_pwd[] = base64_encode($this->input->post('conf_password'));

        $common_pwd = array_intersect($conf_pwd,$pwd);

        $count_common_pwd = count($common_pwd);
      
         if($this->form_validation->run() === FALSE)
        {
             $this->load->view('change_password',$data);
        } else{

        	 if($count_common_pwd >= 1){
                $this->session->set_flashdata("pwd_present","New Password should be different from last 5 saved password");
                $this->load->view('change_password',$this->security->xss_clean($data));

            } else {


	           $this->user_model->update_password($user_id);
	           $this->user_model->add_pwd_histroy($user_id);

	            $this->session->set_flashdata("relogin",$this->input->post('username')." ".'Your Password Updated Successfully Please Relogin');
	            redirect('Login/index');

            }

        }
      

    }
}    	