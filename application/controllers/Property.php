<?php

class Property extends CI_Controller {

    public function __construct() {
    	 parent::__construct();
    	$this->load->helper(array('form', 'url','security', 'string','file'));
        $this->load->library(array('form_validation','session','upload'));  
        $this->load->model('property_model');   
        $this->load->model('user_activity_model');   
  		error_reporting(0);  

    }

    public function property_master(){
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
        if(!in_array("Property Master",$role1)) {
         $msg = $session_data['username']." ".'Try To Access Add Property Page This Page Access is Not Given to the'." ".$session_data['username'].'.';
        $this->user_activity_model->add('no_access',$msg,$session_data['username'],$session_data['admin_id']);       
        redirect('Admin/auth_error');
        }

        $data['property_type'] = $this->property_model->view_property_type();
        $data['unit'] = $this->property_model->view_unit();
        $data['jurisdiction'] = $this->property_model->view_jurisdiction();
        $data['property_status'] = $this->property_model->view_property_status();
        $data['land_type'] = $this->property_model->view_land_type();
        $data['property_controller'] = $this->property_model->get_property_controller();
        $data['property_group'] = $this->property_model->view_property_group();
        $data['broker'] = $this->property_model->get_broker();
        $data['lessor'] = $this->property_model->get_lessor();
        $data['lesse'] = $this->property_model->get_lesse();
        $data['seller'] = $this->property_model->get_seller();
        $data['purchaser'] = $this->property_model->get_purchaser();
        $data['fixed_expense'] = $this->property_model->view_fixed_expense_type();
        $msg = $session_data['username']." ".'Visited Add Property Page.';
        $this->user_activity_model->add('visited_page',$msg,$session_data['username'],$session_data['admin_id']);
    	$this->load->view('add_property',$this->security->xss_clean($data));
    }


    public function property_add()
    {
    	//error_reporting(0);
 

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
        if(!in_array("Property Master",$role1)) {
        $msg = $session_data['username']." ".'Try To Access Add Property Page This Page Access is Not Given to the'." ".$session_data['username'].'.';
        $this->user_activity_model->add('no_access',$msg,$session_data['username'],$session_data['admin_id']);    
        redirect('Admin/auth_error');
        }

        $data['property_type'] = $this->property_model->view_property_type();
        $data['unit'] = $this->property_model->view_unit();
        $data['jurisdiction'] = $this->property_model->view_jurisdiction();
        $data['property_status'] = $this->property_model->view_property_status();
        $data['land_type'] = $this->property_model->view_land_type();
        $data['property_controller'] = $this->property_model->get_property_controller();
        $data['property_group'] = $this->property_model->view_property_group();
        $data['broker'] = $this->property_model->get_broker();
        $data['lessor'] = $this->property_model->get_lessor();
        $data['lesse'] = $this->property_model->get_lesse();
        $data['seller'] = $this->property_model->get_seller();
        $data['purchaser'] = $this->property_model->get_purchaser();
        $data['fixed_expense'] = $this->property_model->view_fixed_expense_type();

        $type = $this->property_model->view_type($this->input->post('property_type'));

        $this->form_validation->set_rules('property_type','Property Type','required');
       $this->form_validation->set_rules('property_name','Property Name','required');
        $this->form_validation->set_rules('address','Address','required');
        $this->form_validation->set_rules('city','City','required');
        $this->form_validation->set_rules('state','State','trim|required');
        $this->form_validation->set_rules('pincode','Pincode','required');
        $this->form_validation->set_rules('unit','Unit','required');
        $this->form_validation->set_rules('property_unit','Property Unit','required');
        $this->form_validation->set_rules('property_price_per_unit','Property Price Per Unit','required');
        $this->form_validation->set_rules('property_total_price','Total Price','required');
        $this->form_validation->set_rules('property_controller','Property Controller','required');
         $this->form_validation->set_rules('property_group','Property Group','required');
        $this->form_validation->set_rules('property_jurisdiction','Property Jurisdiction','required');
        $this->form_validation->set_rules('purchase_date','Purchase Date','required');
        $this->form_validation->set_rules('status','Property Status','required');
        $this->form_validation->set_rules('broker_name','Broker Name','required');
        $this->form_validation->set_rules('commission_type','Commission Type','required');
        $this->form_validation->set_rules('brokerage_amount','Brokerage Amount','required');
        $this->form_validation->set_rules('brokerage_amount_paid','Brokerage Amount Paid','required');
        $this->form_validation->set_rules('payment_status','Payment Status','required');
        $this->form_validation->set_rules('payment_date','Payment Date','required');
        $this->form_validation->set_rules('add_expense[0]','Expense Type','required');
        	$this->form_validation->set_rules('expense_amount[0]','Expense Amount','required');

        if($this->input->post('payment_status') == 'Partically Paid'){

            $this->form_validation->set_rules('partical_amount','Partically Paid Amount','required');

        }

      /* if (empty($_FILES['userfile'][0]['name']))
        {
          $this->form_validation->set_rules('userfile[0]', 'Property Images', 'required');
        }*/



        if($this->input->post('property_contract') == 'Lease'){
        	$this->form_validation->set_rules('leasse_name[0]','Lessee Name','required');
        	$this->form_validation->set_rules('leasse_share_in_property[0]','Share in Property','required');
        	$this->form_validation->set_rules('leassor_name[0]','Lessor Name','required');
        	$this->form_validation->set_rules('leassor_share_in_property[0]','Share in Property','required');
        	
        }

        if($this->input->post('property_contract') == 'Buy'){
        	$this->form_validation->set_rules('seller_name[0]','Seller Name','required');
        	$this->form_validation->set_rules('share_in_property[0]','Share in Property','required');
        	$this->form_validation->set_rules('purchaser_name[0]','Purchaser Name','required');
        	$this->form_validation->set_rules('purchaser_share_in_property[0]','Share in Property','required');
        	
        }

              foreach($type as $type1){

        
			        if($type1 === 'Building/Warehouse/Commercial Building'){
			        	
	    						if(empty($this->input->post('rera_number'))){
	    							$this->form_validation->set_rules('rera_number','Rera Number','required');
	    						}
	    						if(empty($this->input->post('bu_number'))){

				        		 $this->form_validation->set_rules('bu_number','Bu Number','required');
				        		 
				        	}
				        	
						}


			       if($type1 === 'Agricultural Land' || $type1 === 'N/A Land'){

			        		if(empty($this->input->post('nature_of_land'))){

			        		 $this->form_validation->set_rules('nature_of_land','Nature of Land','required');
			        		}
			        		if(empty($this->input->post('type_of_land'))){

			        		 $this->form_validation->set_rules('type_of_land','Type of Land','required');
			        		}
			        }

		        }  



        if($this->form_validation->run() === FALSE)
        {
            $this->load->view('add_property',$this->security->xss_clean($data));
        }
        else{

        $purchase_date = $this->input->post('purchase_date');
           $newDate = date("Y-m-d", strtotime($purchase_date));

           if($this->input->post('property_contract') == 'Lease'){
            /* $lessee = $this->input->post('leasse_name');
             $un_arr = array_unique($lessee);
                if($lessee != $un_arr){
                    $this->session->set_flashdata("lessee_error","You Have Selected Same Lessee Name For Multiple Times");
                    $this->load->view('add_porperty',$data);
                    exit();
                }*/

                     $financial_status = 'Leased';
                     $financial_status_id = $this->property_model->get_property_financial_status($financial_status);

           }
           else
           {

            $financial_status = 'Purchased';
            $financial_status_id = $this->property_model->get_property_financial_status($financial_status);
          }

           foreach($financial_status_id as $id){
                $financial_id = $id;
            }


            
		    $rera_number= "";
            $bu_number= "";
            $nature_of_land= "";
            $type_of_land= "";
            $type = $this->property_model->view_type($this->input->post('property_type'));
            foreach($type as $type1){
	            if($type1=== 'Building/Warehouse/Commercial Building'){
		            if(!empty($this->input->post('rera_number')) AND !empty($this->input->post('bu_number'))){
		                 $rera_number = $this->input->post('rera_number');
		                 $bu_number = $this->input->post('bu_number');
		            }
	        	}

	           if($type1 === 'Agricultural Land' || $type1 === 'N/A Land'){	
		           if(!empty($this->input->post('nature_of_land')) AND !empty($this->input->post('type_of_land'))){
		                $nature_of_land = $this->input->post('nature_of_land');
		                $type_of_land = $this->input->post('type_of_land');
		            }
	           }
           }
           
            $this->db->select("*"); 
            $this->db->from('property_master');
            $this->db->like('asset_number','PR00000', 'after');
            $query = $this->db->get();
            $count = $query->num_rows();
            // echo "<pre>";print_r($count);exit;
            if($count == 0){
                $quote_number = 'PR000001';
            }else{

                $query1 = $this->db->query('SELECT asset_number from property_master ORDER BY property_id DESC LIMIT 1') ;
                $asset_result = $query1->result_array();
                foreach($asset_result as $asset){

                    $asset_no = $asset['asset_number'];

                }
                $quote_number = ++$asset_no;

            }

         $property_data = array(              
            'property_type_id' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$this->input->post('property_type'))),
            'asset_number' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$quote_number)),
            'property_name' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$this->input->post('property_name'))),
            'property_address' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>?\|=+]/"," ",$this->input->post('address'))),
            'city' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$this->input->post('city'))),
            'state' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$this->input->post('state'))),
            'pincode' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$this->input->post('pincode'))),
            'latitude' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,?\|=+]/"," ",$this->input->post('latitude'))),
            'longitude' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,?\|=+]/"," ",$this->input->post('longitude'))),
            'property_contract' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$this->input->post('property_contract'))),
            'unit' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$this->input->post('unit'))),
            'property_unit' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,?\|=+]/"," ",$this->input->post('property_unit'))),
            'property_price_per_unit' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,?\|=+]/"," ",$this->input->post('property_price_per_unit'))),
            'total_price' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,?\|=+]/"," ",$this->input->post('property_total_price'))),
            'nature_of_land' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$nature_of_land)),
            'land_type_id' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$type_of_land)),
            'rera_number' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$rera_number)),
            'bu_number' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$bu_number)),
            'property_controller_id' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$this->input->post('property_controller'))),
            'property_group_id' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$this->input->post('property_group'))),
            'property_juridiction_id' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$this->input->post('property_jurisdiction'))),
            'property_purchase_date' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$newDate)),
            'property_status_id' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$this->input->post('status'))),
            'property_remarks' => $this->db->escape_str($this->input->post('property_remark')),
            'financial_status_id' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$financial_id)),
            'mark_property_as_sold' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",'No')),
            'rent_receivable_available_unit' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$this->input->post('property_unit'))),
            'poperty_added_date' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",date('Y-m-d')))
         );            
         
         if(!empty($_FILES['userfile']['name']) && count(array_filter($_FILES['userfile']['name'])) > 0){

            //jpg|png|jpeg|JPG|PNG|JPEG

            $filename = $_FILES['userfile']['name'];
            $countFiles = count($filename);
            $ext = array();
             for($i=0;$i<$countFiles; $i++)
            {
                $ext[] =  strrchr($filename[$i],'.');
            }  

            if((in_array('.jpg',$ext)) OR (in_array('.jpeg',$ext)) OR (in_array('.png',$ext)) OR (in_array('.JPG',$ext)) OR (in_array('.JPEG',$ext)) OR (in_array('.PNG',$ext))){
                // and also check size of every file and it arrives here when all the image format and size is correct right now it arrives here if any image has right extension with wrong extension

                 //AND $_FILES['userfile']['size'] <= 375000

                $this->property_model->add_property($property_data);
                $insert_id = $this->db->insert_id();

             
            }else if((!in_array('.jpg',$ext)) OR (!in_array('.jpeg',$ext)) OR (!in_array('.png',$ext)) OR (!in_array('.JPG',$ext)) OR (!in_array('.JPEG',$ext)) OR (!in_array('.PNG',$ext))){
                //arrives here when user upload one image and its extension is wrong need to check image size here also

                 //AND $_FILES['userfile']['size'] > 375000/
                 $this->session->set_flashdata('new_in',2);
                $this->load->view('add_property',$this->security->xss_clean($data));

            }
        }
        else if(empty($_FILES['userfile'][0]['name'])){

                //$this->session->set_flashdata('no_image',3);
                //$this->load->view('add_property',$this->security->xss_clean($data));

            $this->property_model->add_property($property_data);
            $insert_id = $this->db->insert_id();

        }
        else{
              
            $this->load->view('add_property',$this->security->xss_clean($data));     
               
         }    
        

        if($insert_id == ''){
            $insert_id1 = '';
        }else{
            $insert_id1 = $insert_id;
        }

           // Broker Details

         if($insert_id1 !== ''){

            if(!empty($_FILES['userfile']['name']) && count(array_filter($_FILES['userfile']['name'])) > 0){


                                    $random_string = random_string('alnum', 10);

                                    $property_images = $this->property_model->get_property_images($property_id);
                                    foreach($property_images as $image){
                                        $image_name = $image['property_image']; 
                                    }

                                    $ipath = ('assets/images/uploads/property/'.base64_decode($image_name));
                                   
                                    $parts = explode('/', $ipath);
                                    $check_null = $parts[4] == NULL;

                                    $img_extension = strrchr($image,'.');

                                    if (!is_dir('assets/images/uploads/property/'.$check_null) AND ($parts[4] == NULL)) {
                                         mkdir('assets/images/uploads/property/' . str_replace(' ', '_', $this->input->post('property_name')).$random_string, 0777, TRUE);
                                        //echo "1";
                                        $ipath = realpath(APPPATH . '../assets/images/uploads/property/'.str_replace(' ', '_', $this->input->post('property_name').$random_string));
                                        chmod($ipath,0777);
                                    } 
                                    else {
                                        //echo "2";
                                        $ipath = ('assets/images/uploads/property/'.$parts[4]);
                                        chmod($ipath,0777);

                                    }   
                            

                        $strInputFileName = "userfile";
                        $arrFiles = $_FILES;
                        $config['upload_path'] = $ipath;
                        $config['allowed_types'] = "jpg|png|jpeg|JPG|PNG|JPEG";
                        $config['max_size'] = '3072';
                        $config['max_width'] = '3000';
                        $config['max_height'] = '3000';
                        $config['file_name'] = $this->getRandomFileName();

                            if (is_array($_FILES[$strInputFileName]['name']))
                            {
                                    $countFiles = count($_FILES[$strInputFileName]['name']);
                                    for($i=0;$i<$countFiles; $i++)
                                    {
                                        //overwrite _FILES array
                                        $_FILES[$strInputFileName]['name'] = $arrFiles[$strInputFileName]['name'][$i];
                                        $_FILES[$strInputFileName]['type'] = $arrFiles[$strInputFileName]['type'][$i];
                                        $_FILES[$strInputFileName]['tmp_name'] = $arrFiles[$strInputFileName]['tmp_name'][$i];
                                        $_FILES[$strInputFileName]['error'] = $arrFiles[$strInputFileName]['error'][$i];
                                        $_FILES[$strInputFileName]['size'] = $arrFiles[$strInputFileName]['size'][$i];
                                        $this->upload->initialize($config);
                                        if(!$this->upload->do_upload($strInputFileName))
                                        {
                                            $error = array('error' => $this->upload->display_errors());
                                            $this->session->set_flashdata('new_in',2);
                                            $this->load->view('add_property',$this->security->xss_clean($data)); 
                                        } 
                                        else 
                                        {
                                                $uploadData = $this->upload->data();
                                                 chmod($uploadData,0777);
                                            $filename = $uploadData['file_name'];
                                            $property_image = '';
                                            if(!empty($parts[4])){
                                                $property_image = base64_encode($parts[4].'/'.$filename);
                                            }else{
                                                $property_image = base64_encode(str_replace(' ', '_', $this->input->post('property_name')).$random_string.'/'.$filename);
                                            }
                                                  $image_data = array(              
                                                                            'property_id' => $insert_id,
                                                                            'property_image' => $property_image,
                                                                            'image_added_date' => date('Y-m-d')
                                                                      );                
                                            
                                            $this->property_model->add_property_images($image_data);

                                           
                                        }
                                    }
                                } 

            }    


            if($this->input->post('payment_status') == 'Partically Paid'){
                $amount = $this->input->post('partical_amount');
            }else{
                $amount = '';
            }

             $payment_date = $this->input->post('payment_date');
           $payment_date1 = date("Y-m-d", strtotime($payment_date));

            $broker_data = array(              
            'property_id' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$insert_id)),
            'broker_name' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$this->input->post('broker_name'))),
            'broker_commission_type' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$this->input->post('commission_type'))),
            'brokerage_amount' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,?\|=+]/"," ",$this->input->post('brokerage_amount'))),
            'brokerage_amount_to_paid' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,?\|=+]/"," ",$this->input->post('brokerage_amount_paid'))),
            'payment_status' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$this->input->post('payment_status'))),
            'partically_paid_amount' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,?\|=+]/"," ",$amount)),
            'payment_date' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$payment_date1)),
            'broker_added_date' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",date('Y-m-d')))
         );                                    

        $this->property_model->add_broker($broker_data);

            //seller /lessor       

            if($this->input->post('property_contract') === 'Buy'){


                for($i=0; $i< count($this->input->post('seller_name'));$i++){
                                      $seller_name = $this->input->post('seller_name')[$i];
                                       $share_in_property = $this->input->post('share_in_property')[$i];
                                   
                                            $seller_data = array(              
                                                'property_id' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$insert_id)),
                                                'seller_name' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$seller_name)),
                                                'share_in_property' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,?\|=+]/"," ",$share_in_property)),
                                                'seller_added_date' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",date('Y-m-d')))
                                            );                                    

                                        $this->property_model->add_seller($seller_data);
                                    }

                for($i=0; $i< count($this->input->post('purchaser_name'));$i++){
                                      $purchaser_name = $this->input->post('purchaser_name')[$i];
                                       $share_in_property = $this->input->post('purchaser_share_in_property')[$i];
                                   
                                            $purchaser_data = array(              
                                                'property_id' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$insert_id)),
                                                'purchaser_name' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$purchaser_name)),
                                                'share_in_property' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,?\|=+]/"," ",$share_in_property)),
                                                'purchaser_added_date' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",date('Y-m-d')))
                                            );                                    

                                        $this->property_model->add_purchaser($purchaser_data);
                                    }

            }
            else{

                for($i=0; $i< count($this->input->post('leasse_name'));$i++){
                                      $lessee_name = $this->input->post('leasse_name')[$i];
                                       $share_in_property = $this->input->post('leasse_share_in_property')[$i];
                                   
                                            $lessee_data = array(              
                                                'property_id' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$insert_id)),
                                                'lessee_name' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$lessee_name)),
                                                'share_in_property' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,?\|=+]/"," ",$share_in_property)),
                                                'lessee_added_date' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",date('Y-m-d')))
                                            );  

                                        $this->property_model->add_lessee($lessee_data);
                                    }

                for($i=0; $i< count($this->input->post('leassor_name'));$i++){
                                      $leassor_name = $this->input->post('leassor_name')[$i];
                                       $share_in_property = $this->input->post('leassor_share_in_property')[$i];
                                   
                                            $lessor_data = array(              
                                                'property_id' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$insert_id)),
                                                'lessor_name' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$leassor_name)),
                                                'share_in_property' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,?\|=+]/"," ",$share_in_property)),
                                                'lessor_added_date' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",date('Y-m-d')))
                                            );                               

                                       $this->property_model->add_lessor($lessor_data);
                                    }

            }

         
            for($i=0; $i< count($this->input->post('add_expense'));$i++){
                                      $add_expense = $this->input->post('add_expense')[$i];
                                       $expense_amount = $this->input->post('expense_amount')[$i];
                                   
                                            $expense_data = array(              
                                                'property_id' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$insert_id)),
                                                'expense_type_id' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$add_expense)),
                                                'expense_amount' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,?\|=+]/"," ",$expense_amount)),
                                                'fixed_expense_added_date' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",date('Y-m-d')))
                                            );                                    

                                        $this->property_model->add_fixed_expense($expense_data);
                                    }

            $prop_access_update = $data['prop_access'].",".$insert_id1;
            $this->property_model->update_prop_access_detail($prop_access_update,$data['admin_id']);

            $this->session->set_flashdata("insert_property","Property Details Added Successfully");
            $msg = $session_data['username']." ".'Added Property Named'." ".$this->input->post('property_name').'.';
            $this->user_activity_model->add('added',$msg,$data['username'],$data['admin_id']);

            $data['admin_data'] = $this->property_model->view_role_by_id($data['admin_id']);

            $array_items = array('password' => $session_data["password"], 'role_name' => $session_data["role_name"], 'roles' => $data['roles'], 'prop_access' => $data['prop_access']);

            $this->session->unset_userdata($array_items);
            $sess_array = array();
            foreach ($data['admin_data'] as $row) {
                $sess_array = array(
                    'admin_id' => $row['admin_id'],
                    'username' => $row['username'],
                    'password' => $row['password'],
                    'role_name' => $row['role_name'],
                    'roles' => $row['roles'],
                    'prop_access' => $row['property_access'],
                );

                if(in_array("View Property List",$role1)) {

                 redirect('Property/view_property_list',$this->session->set_userdata('logged_in', $sess_array));  

                } else {

                 redirect('Property/property_master',$this->session->set_userdata('logged_in', $sess_array));  
                } 
            }    
         }
                      
       }
    }


    private function getRandomFileName()
{
    $random = rand(1, 10000000000000000);
    return hash('sha512', $random.$this->input->post('title') . config_item("encryption_key"));
}


    public function view_property_list(){
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
        if(!in_array("View Property List",$role1)) {
        $msg = $session_data['username']." ".'Try To Access View Property List Page This Page Access is Not Given to the'." ".$session_data['username'].'.';
        $this->user_activity_model->add('no_access',$msg,$session_data['username'],$session_data['admin_id']);  
        redirect('Admin/auth_error');
        }

        $data['property'] = $this->property_model->get_property_data();
        $data['property_type'] = $this->property_model->view_property_type();
        $data['property_status'] = $this->property_model->view_property_status();
        $data['property_group'] = $this->property_model->view_property_group();
        $data['financial_status'] = $this->property_model->view_financial_status();
         $msg = $session_data['username']." ".'Visited View Property List Page.';
        $this->user_activity_model->add('visited_page',$msg,$session_data['username'],$session_data['admin_id']);
      $this->load->view('view_property_list',$this->security->xss_clean($data));
    }

    public function property_filter(){
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
        if(!in_array("View Property List",$role1)) {
        redirect('Admin/auth_error');
        }
        $data['property'] = $this->property_model->get_property_data();
        $data['property_type'] = $this->property_model->view_property_type();
        $data['property_status'] = $this->property_model->view_property_status();
        $data['property_group'] = $this->property_model->view_property_group();
        $data['financial_status'] = $this->property_model->view_financial_status();


        if (empty($_POST['property_type_id']) && empty($_POST['property_contract']) && empty($_POST['property_group_id']) && empty($_POST['financial_status_id']) && empty($_POST['property_status_id']))
        {
            $this->session->set_flashdata("select_data","Please Select Any Filter Field For Search");
            redirect('Property/view_property_list/',$this->security->xss_clean($data));
        }
        else
        {
            $property_type_id = $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$_POST['property_type_id']));
            $property_contract = $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$_POST['property_contract']));
            $property_group_id = $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$_POST['property_group_id']));
            $financial_status_id = $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$_POST['financial_status_id']));
            $property_status_id = $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$_POST['property_status_id']));
            $wheres = array();
            $sql = "SELECT pt.*,pf.*,pg.*,pm.* FROM property_master pm INNER JOIN property_type_master pt ON pt.property_type_id = pm.property_type_id INNER JOIN property_financial_status_master pf ON pf.financial_status_id = pm.financial_status_id INNER JOIN property_group_master pg ON pg.property_group_id = pm.property_group_id where ";

            if (isset($_POST['property_type_id']) and !empty($_POST['property_type_id']))
            {
                $wheres[] = "pm.property_type_id like '%{$property_type_id}%' ";
            } 

            if (isset($_POST['property_contract']) and !empty($_POST['property_contract']))
            {
                $wheres[] = "pm.property_contract = '{$property_contract}'";
            } 

            if (isset($_POST['property_group_id']) and !empty($_POST['property_group_id']))
            {
                $wheres[] = "pm.property_group_id = '{$property_group_id}' ";
            } 

            if (isset($_POST['financial_status_id']) and !empty($_POST['financial_status_id']))
            {
                $wheres[] = "pm.financial_status_id = '{$financial_status_id}' ";
            } 

            if (isset($_POST['property_status_id']) and !empty($_POST['property_status_id']))
            {
                $wheres[] = "pm.property_status_id = '{$property_status_id}' ";
            } 

            foreach ( $wheres as $where ) 
            {
            $sql .= $where . ' AND ';   //  you may want to make this an OR
              }
             $sql=rtrim($sql, "AND "); 

             $sql1 = $this->db->query($sql);

              if($sql1 == null OR $sql1 == '' OR empty($sql1)){
                $this->load->view('view_property_list',$this->security->xss_clean($data));
                echo " No Data Found";
             } else {
              $data['property']  = $sql1->result_array();  

                $this->load->view('view_property_list',$this->security->xss_clean($data));
            }   
        }
    }



    public function property_type_master(){
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
        if(!in_array("Property Type Master",$role1)) {
            $msg = $session_data['username']." ".'Try To Access Property Type Page This Page Access is Not Given to the'." ".$session_data['username'].'.';
        $this->user_activity_model->add('no_access',$msg,$session_data['username'],$session_data['admin_id']); 
        redirect('Admin/auth_error');
        }

          $data['property_type'] = $this->property_model->view_property_type();
           $msg = $session_data['username']." ".'Visited Property Type Page.';
        $this->user_activity_model->add('visited_page',$msg,$session_data['username'],$session_data['admin_id']);
        $this->load->view('property_type_master',$this->security->xss_clean($data));


    }

    public function property_type_master_insert(){
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
        if(!in_array("Property Type Master",$role1)) {
        $msg = $session_data['username']." ".'Try To Access Property Type Page This Page Access is Not Given to the'." ".$session_data['username'].'.';
        $this->user_activity_model->add('no_access',$msg,$session_data['username'],$session_data['admin_id']);     
        redirect('Admin/auth_error');
        }

          $data['property_type'] = $this->property_model->view_property_type();

        $this->form_validation->set_rules('property_type','Property Type','required');

         if($this->form_validation->run() == false)
        {
       
           
        $this->load->view('property_type_master',$this->security->xss_clean($data));


           
        }
        else{

            $query = $this->property_model->insertpropertytype();
            $this->session->set_flashdata("property_type","Property Type Added Successfully");
             $msg = $session_data['username']." ".'Added Property Type Named'." ".$this->input->post('property_type').'.';
            $this->user_activity_model->add('added',$msg,$data['username'],$data['admin_id']);
            redirect("Property/property_type_master","refresh",$this->security->xss_clean($data));

        }

    }

     public function update_property_type(){
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
         $type = base64_decode($this->uri->segment(3));
         
       $data['type'] = $this->property_model->property_type($type);  
       foreach($data['type'] as $typ){
        $prop_type = $typ['property_type'];
        $property_type_id = $typ['property_type_id'];
       }

        if(($type == null OR $type == '') OR (!isset($property_type_id) OR $property_type_id !== $type OR $property_type_id == null OR $property_type_id == '')){

           show_404();
          exit();
          }

        if(!in_array("Property Type Master",$role1)) {
        $msg = $session_data['username']." ".'Try To Access Update Property Type Page For'." ".$prop_type.".".'This Page Access is Not Given to the'." ".$session_data['username'].'.';
        $this->user_activity_model->add('no_access',$msg,$session_data['username'],$session_data['admin_id']);  
        redirect('Admin/auth_error');
        }

         $msg = $session_data['username']." ".'Visited Edit Property Type Page of'." ".$prop_type.'.';
        $this->user_activity_model->add('visited_page',$msg,$session_data['username'],$session_data['admin_id']);
        $this->load->view('update_property_type',$this->security->xss_clean($data));


    }

    public function update_property_type_redirect(){
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
         $type = base64_decode($this->uri->segment(3));
       $data['type'] = $this->property_model->property_type($type);  
       foreach($data['type'] as $typ){
        $prop_type = $typ['property_type'];
        $property_type_id = $typ['property_type_id'];
       }

        if(($type == null OR $type == '') OR (!isset($property_type_id) OR $property_type_id !== $type OR $property_type_id == null OR $property_type_id == '')){

           show_404();
          exit();
          }
        if(!in_array("Property Type Master",$role1)) {
         $msg = $session_data['username']." ".'Try To Access Update Property Type Page For'." ".$prop_type.".".'This Page Access is Not Given to the'." ".$session_data['username'].'.';
        $this->user_activity_model->add('no_access',$msg,$session_data['username'],$session_data['admin_id']);      
        redirect('Admin/auth_error');
        }

        $this->form_validation->set_rules('property_type','Property Type','required');

        if($this->form_validation->run() == false)
        {
       
           
        $this->load->view('update_property_type',$this->security->xss_clean($data));


           
        }

        else
        {

               $query = $this->property_model->update_property_type($type);

               $this->session->set_flashdata("update_property_type","Property Type Updated Successfully");
               $msg = $session_data['username']." ".'Updated Property Type Details of '." ".$this->input->post('property_type').".";
            $this->user_activity_model->add('updated',$msg,$data['username'],$data['admin_id']);

              redirect('Property/property_type_master');

        } 


    }

    public function unit_master(){
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
        if(!in_array("Unit Master",$role1)) {
         $msg = $session_data['username']." ".'Try To Access Unit Master Page This Page Access is Not Given to the'." ".$session_data['username'].'.'; 	
         $this->user_activity_model->add('no_access',$msg,$session_data['username'],$session_data['admin_id']); 
        redirect('Admin/auth_error');
        }
    	$data['unit'] = $this->property_model->view_unit();
        $msg = $session_data['username']." ".'Visited Unit Master Page.';
        $this->user_activity_model->add('visited_page',$msg,$session_data['username'],$session_data['admin_id']);   
        $this->load->view('unit_master',$this->security->xss_clean($data));

    }

    public function unit_master_insert(){
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
        if(!in_array("Unit Master",$role1)) {
         $msg = $session_data['username']." ".'Try To Access Unit Master Page This Page Access is Not Given to the'." ".$session_data['username'].'.'; 	
         $this->user_activity_model->add('no_access',$msg,$session_data['username'],$session_data['admin_id']);  	
        redirect('Admin/auth_error');
        }
        $data['unit'] = $this->property_model->view_unit();

        $this->form_validation->set_rules('unit','Unit','required');

         if($this->form_validation->run() == false)
        {
       
           
        $this->load->view('unit_master',$this->security->xss_clean($data));


           
        }
        else{

            $query = $this->property_model->insertunit();
            $this->session->set_flashdata("unit","Unit Added Successfully");
            $msg = $data['username']." ".'Added Unit Named'." " .$this->input->post('unit'). '.';
            $this->user_activity_model->add('added',$msg,$data['username'],$data['admin_id']);
            redirect("Property/unit_master","refresh",$this->security->xss_clean($data));

        }

    }



    public function update_unit(){
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

      $unit = base64_decode($this->uri->segment(3));
      
       $data['unit'] = $this->property_model->get_unit($unit);

       foreach($data['unit'] as $un){
       	$prop_unit = $un['unit'];
        $unit_id = $un['unit_id'];
       }

       if(($unit == null OR $unit == '') OR (!isset($unit_id) OR $unit_id !== $unit OR $unit_id == null OR $unit_id == '')){

           show_404();
          exit();
          }
        if(!in_array("Unit Master",$role1)) {
        $msg = $session_data['username']." ".'Try To Use Update Unit Page For'." ".$prop_unit." ".'Update Unit Page Access is Not Given to the'." ".$session_data['username'].'.'; 
        $this->user_activity_model->add('no_access',$msg,$session_data['username'],$session_data['admin_id']); 	
        redirect('Admin/auth_error');
        }
        $msg = $session_data['username']." ".'Visited Update Unit Page For'." ".$prop_unit.'.';
       $this->user_activity_model->add('visited_page',$msg,$session_data['username'],$session_data['admin_id']);
        $this->load->view('update_unit',$this->security->xss_clean($data));


    }

      public function update_unit_redirect(){
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
           $unit = base64_decode($this->uri->segment(3));
       $data['unit'] = $this->property_model->get_unit($unit);

       foreach($data['unit'] as $un){
       	$prop_unit = $un['unit'];
        $unit_id = $un['unit_id'];
       }

       if(($unit == null OR $unit == '') OR (!isset($unit_id) OR $unit_id !== $unit OR $unit_id == null OR $unit_id == '')){

           show_404();
          exit();
          }

        if(!in_array("Unit Master",$role1)) {
         $msg = $session_data['username']." ".'Try To Use Update Unit Page For'." ".$prop_unit." ".'Update Unit Page Access is Not Given to the'." ".$session_data['username'].'.'; 
        $this->user_activity_model->add('no_access',$msg,$session_data['username'],$session_data['admin_id']); 		
        redirect('Admin/auth_error');
        }

        $this->form_validation->set_rules('unit','Unit','required');

       if($this->form_validation->run() == false)
        {
       
           
        $this->load->view('update_unit',$this->security->xss_clean($data));


           
        }

        else
        {

               $query = $this->property_model->update_unit($unit);

               $this->session->set_flashdata("update_unit","Unit Updated Successfully");

               $msg = $data['username']." ".'Updated'." ".$this->input->post('unit'). " ".'Unit Details.';
                  $this->user_activity_model->add('updated',$msg,$data['username'],$data['admin_id']);

              redirect('Property/unit_master');

        } 


    }

    public function land_type_master(){
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
        if(!in_array("Land Type Master",$role1)) {
        $msg = $session_data['username']." ".'Try To Access Land Type Master Page This Page Access is Not Given to the'." ".$session_data['username'].'.';
        $this->user_activity_model->add('no_access',$msg,$session_data['username'],$session_data['admin_id']);	
        redirect('Admin/auth_error');
        }
    	
   		$data['land_type'] = $this->property_model->view_land_type();
   		$msg = $session_data['username']." ".'Visited Land Type Master Page.';
        $this->user_activity_model->add('visited_page',$msg,$session_data['username'],$session_data['admin_id']);
       	$this->load->view('land_type_master',$this->security->xss_clean($data));  

    }

    public function land_type_master_insert(){
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
        if(!in_array("Land Type Master",$role1)) {
        $msg = $session_data['username']." ".'Try To Access Land Type Master Page This Page Access is Not Given to the'." ".$session_data['username'].'.';
        $this->user_activity_model->add('no_access',$msg,$session_data['username'],$session_data['admin_id']); 	
        redirect('Admin/auth_error');
        }

        $data['land_type'] = $this->property_model->view_land_type();

        $this->form_validation->set_rules('land_type','Land Type','required');

         if($this->form_validation->run() == false)
        {

            $this->load->view('land_type_master',$this->security->xss_clean($data));  
        }
        else{

            $query = $this->property_model->insertlandtype();
            $this->session->set_flashdata("land_type","Land Type Added Successfully");
             $msg = $data['username']." ".'Added Land Type Named'." " .$this->input->post('land_type'). '.';
             $this->user_activity_model->add('added',$msg,$data['username'],$data['admin_id']);
            redirect("Property/land_type_master","refresh",$this->security->xss_clean($data));

        }

    }


    public function update_land_type(){
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
        $land_type = base64_decode($this->uri->segment(3));
       
        $data['land_type'] = $this->property_model->get_land_type($land_type);
        
        foreach($data['land_type'] as $land){
        	$type_land = $land['land_type'];
            $land_type_id = $land['land_type_id'];
        }   

         if(($land_type == null OR $land_type == '') OR (!isset($land_type_id) OR $land_type_id !== $land_type OR $land_type_id == null OR $land_type_id == '')){

           show_404();
          exit();
          } 
        if(!in_array("Land Type Master",$role1)) {
         $msg = $session_data['username']." ".'Try To Use Update Land Type Page For'." ".$type_land." ".'Update Land Type Page Access is Not Given to the'." ".$session_data['username'].'.'; 
        $this->user_activity_model->add('no_access',$msg,$session_data['username'],$session_data['admin_id']);  	
        redirect('Admin/auth_error');
        }
        $msg = $session_data['username']." ".'Visited Update Land Type Page For'." ".$type_land.'.';
       $this->user_activity_model->add('visited_page',$msg,$session_data['username'],$session_data['admin_id']);
        $this->load->view('update_land_type',$this->security->xss_clean($data));


    }

    public function update_land_type_redirect(){
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

         $land_type = base64_decode($this->uri->segment(3));
       $data['land_type'] = $this->property_model->get_land_type($land_type);

        foreach($data['land_type'] as $land){
        	$type_land = $land['land_type'];
           $land_type_id = $land['land_type_id'];
        }   

         if(($land_type == null OR $land_type == '') OR (!isset($land_type_id) OR $land_type_id !== $land_type OR $land_type_id == null OR $land_type_id == '')){

           show_404();
          exit();
          } 

        if(!in_array("Land Type Master",$role1)) {
        $msg = $session_data['username']." ".'Try To Use Update Land Type Page For'." ".$type_land." ".'Update Land Type Page Access is Not Given to the'." ".$session_data['username'].'.'; 
        $this->user_activity_model->add('no_access',$msg,$session_data['username'],$session_data['admin_id']);   	
        redirect('Admin/auth_error');
        }

       $this->form_validation->set_rules('land_type','Land Type','required');

        if($this->form_validation->run() == false)
        {
       
           
        $this->load->view('update_land_type',$this->security->xss_clean($data));


           
        }

        else
        {

               $query = $this->property_model->update_land_type($land_type);

               $this->session->set_flashdata("update_land_type","Land Type Updated Successfully");
               $msg = $data['username']." ".'Updated'." ".$this->input->post('land_type'). " ".'Land Type Details.';
                  $this->user_activity_model->add('updated',$msg,$data['username'],$data['admin_id']);
              redirect('Property/land_type_master');

        } 


    }


    public function property_jurisdiction_master(){
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
        if(!in_array("Property Jurisdiction Master",$role1)) {
        $msg = $session_data['username']." ".'Try To Access Property Jurisdiction Master Page This Page Access is Not Given to the'." ".$session_data['username'].'.';
        $this->user_activity_model->add('no_access',$msg,$session_data['username'],$session_data['admin_id']);	
        redirect('Admin/auth_error');
        }

    	$data['jurisdiction'] = $this->property_model->view_jurisdiction();
    	$msg = $session_data['username']." ".'Visited Property Jurisdiction Type Master Page.';
           $this->user_activity_model->add('visited_page',$msg,$session_data['username'],$session_data['admin_id']);
       		$this->load->view('property_jurisdiction_master',$this->security->xss_clean($data));  
    }

    public function property_jurisdiction_master_insert(){
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
        if(!in_array("Property Jurisdiction Master",$role1)) {
         $msg = $session_data['username']." ".'Try To Access Property Jurisdiction Master Page This Page Access is Not Given to the'." ".$session_data['username'].'.';
        $this->user_activity_model->add('no_access',$msg,$session_data['username'],$session_data['admin_id']);		
        redirect('Admin/auth_error');
        }

        $data['jurisdiction'] = $this->property_model->view_jurisdiction();

        $this->form_validation->set_rules('property_jurisdiction','Property Jurisdiction','required');

         if($this->form_validation->run() == false)
        {

            $this->load->view('property_jurisdiction_master',$this->security->xss_clean($data));  
        }
        else{

            $query = $this->property_model->insertpropertyjurisdiction();
            $this->session->set_flashdata("jurisdiction","Property Jurisdiction Added Successfully");
            $msg = $data['username']." ".'Added Property Jurisdiction Named'." " .$this->input->post('property_jurisdiction'). '.';
                  $this->user_activity_model->add('added',$msg,$data['username'],$data['admin_id']);
            redirect("Property/property_jurisdiction_master","refresh",$this->security->xss_clean($data));

        }
    }

    public function update_property_jurisdiction(){
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
       $jurisdiction_id = base64_decode($this->uri->segment(3));
       
       $data['jurisdiction'] = $this->property_model->get_property_jurisdiction($jurisdiction_id); 

       foreach($data['jurisdiction'] as $juri){
       	$jurisdiction_name = $juri['property_jurisdiction'];
        $jurisdiction_id1 = $juri['jurisdiction_id'];
       }

       if(($jurisdiction_id == null OR $jurisdiction_id == '') OR (!isset($jurisdiction_id1) OR $jurisdiction_id1 !== $jurisdiction_id OR $jurisdiction_id1 == null OR $jurisdiction_id1 == '')){

           show_404();
          exit();
          }

        if(!in_array("Property Jurisdiction Master",$role1)) {
        $msg = $session_data['username']." ".'Try To Use Update Property Jurisdiction Page For'." ".$jurisdiction_name." ".'This Page Access is Not Given to the'." ".$session_data['username'].'.'; 
        $this->user_activity_model->add('no_access',$msg,$session_data['username'],$session_data['admin_id']); 	
        redirect('Admin/auth_error');
        }
         $msg = $session_data['username']." ".'Visited Update Property Jurisdiction Page For'." ".$jurisdiction_name.'.';
       $this->user_activity_model->add('visited_page',$msg,$session_data['username'],$session_data['admin_id']);
        $this->load->view('update_property_jurisdiction',$this->security->xss_clean($data));


    }

    public function update_property_jurisdiction_redirect(){
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
         $jurisdiction_id = base64_decode($this->uri->segment(3));
         $data['jurisdiction'] = $this->property_model->get_property_jurisdiction($jurisdiction_id);
         foreach($data['jurisdiction'] as $juri){
       		$jurisdiction_name = $juri['property_jurisdiction'];
            $jurisdiction_id1 = $juri['jurisdiction_id'];
       }

       if(($jurisdiction_id == null OR $jurisdiction_id == '') OR (!isset($jurisdiction_id1) OR $jurisdiction_id1 !== $jurisdiction_id OR $jurisdiction_id1 == null OR $jurisdiction_id1 == '')){

           show_404();
          exit();
          }

        if(!in_array("Property Jurisdiction Master",$role1)) {
        $msg = $session_data['username']." ".'Try To Use Update Property Jurisdiction Page For'." ".$jurisdiction_name." ".'This Page Access is Not Given to the'." ".$session_data['username'].'.';  	
        $this->user_activity_model->add('no_access',$msg,$session_data['username'],$session_data['admin_id']); 
        redirect('Admin/auth_error');
        }

        $this->form_validation->set_rules('property_jurisdiction','Property Jurisdiction','required');

       if($this->form_validation->run() == false)
        {
       
           
        $this->load->view('update_property_jurisdiction',$this->security->xss_clean($data));


           
        }

        else
        {

               $query = $this->property_model->update_jurisdiction($jurisdiction_id);

               $this->session->set_flashdata("update_jurisdiction","Property Jurisdiction Updated Successfully");
               $msg = $data['username']." ".'Updated'." ".$this->input->post('property_jurisdiction'). " ".'Property Jurisdiction Details.';
                  $this->user_activity_model->add('updated',$msg,$data['username'],$data['admin_id']);
              redirect('Property/property_jurisdiction_master');

        } 


    }


    public function property_status_master(){
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
        if(!in_array("Property Status Master",$role1)) {
        $msg = $session_data['username']." ".'Try To Access Property Status Master Page This Page Access is Not Given to the'." ".$session_data['username'].'.';
        $this->user_activity_model->add('no_access',$msg,$session_data['username'],$session_data['admin_id']);	
        redirect('Admin/auth_error');
        }
    	

    	$data['property_status'] = $this->property_model->view_property_status();
    	$msg = $session_data['username']." ".'Visited Property Status Master Page.';
           $this->user_activity_model->add('visited_page',$msg,$session_data['username'],$session_data['admin_id']);
       		$this->load->view('property_status_master',$this->security->xss_clean($data));
    }

     public function property_status_master_insert(){
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
        if(!in_array("Property Status Master",$role1)) {
        $msg = $session_data['username']." ".'Try To Access Property Status Master Page This Page Access is Not Given to the'." ".$session_data['username'].'.';
        $this->user_activity_model->add('no_access',$msg,$session_data['username'],$session_data['admin_id']);		
        redirect('Admin/auth_error');
        }
        

        $data['property_status'] = $this->property_model->view_property_status();

        $this->form_validation->set_rules('status','Property Status','required');

         if($this->form_validation->run() == false)
        {

            $this->load->view('property_status_master',$this->security->xss_clean($data));
        }
        else{

            $query = $this->property_model->insertpropertystatus();
            $this->session->set_flashdata("property_status","Property Status Added Successfully");
            $msg = $data['username']." ".'Added Property Status Named'." " .$this->input->post('status'). '.';
                  $this->user_activity_model->add('added',$msg,$data['username'],$data['admin_id']);
            redirect("Property/property_status_master","refresh",$this->security->xss_clean($data));

        }
    }

    public function update_property_status(){
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
        $property_status = base64_decode($this->uri->segment(3));
         
       $data['property_status'] = $this->property_model->get_property_status($property_status);
       foreach($data['property_status'] as $status){
       	$prop_status = $status['property_status'];
        $property_status_id = $status['property_status_id'];
       }

       if(($property_status == null OR $property_status == '') OR (!isset($property_status_id) OR $property_status_id !== $property_status OR $property_status_id == null OR $property_status_id == '')){

           show_404();
          exit();
          }

        if(!in_array("Property Status Master",$role1)) {
         $msg = $session_data['username']." ".'Try To Use Update Property Status Page For'." ".$prop_status." ".'Update Property Status Page Access is Not Given to the'." ".$session_data['username'].'.'; 
        $this->user_activity_model->add('no_access',$msg,$session_data['username'],$session_data['admin_id']); 	
        redirect('Admin/auth_error');
        }
  		$msg = $session_data['username']." ".'Visited Update Property Status Page For'." ".$prop_status.'.';
       $this->user_activity_model->add('visited_page',$msg,$session_data['username'],$session_data['admin_id']);
        $this->load->view('update_property_status',$this->security->xss_clean($data));

    }

    public function update_property_status_redirect(){
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
        $property_status = base64_decode($this->uri->segment(3));
       $data['property_status'] = $this->property_model->get_property_status($property_status);
       foreach($data['property_status'] as $status){
       	$prop_status = $status['property_status'];
        $property_status_id = $status['property_status_id'];
       }

       if(($property_status == null OR $property_status == '') OR (!isset($property_status_id) OR $property_status_id !== $property_status OR $property_status_id == null OR $property_status_id == '')){

           show_404();
          exit();
          }
        if(!in_array("Property Status Master",$role1)) {
         $msg = $session_data['username']." ".'Try To Use Update Property Status Page For'." ".$prop_status." ".'Update Property Status Page Access is Not Given to the'." ".$session_data['username'].'.'; 
        $this->user_activity_model->add('no_access',$msg,$session_data['username'],$session_data['admin_id']); 		
        redirect('Admin/auth_error');
        }

        $this->form_validation->set_rules('status','Property Status','required');

        if($this->form_validation->run() == false)
        {
       
           
        $this->load->view('update_property_status',$this->security->xss_clean($data));


           
        }

        else
        {

               $query = $this->property_model->update_property_status($property_status);

               $this->session->set_flashdata("update_property_status","Property Status Updated Successfully");
               $msg = $data['username']." ".'Updated'." ".$this->input->post('status'). " ".'Property Status Details.';
                  $this->user_activity_model->add('updated',$msg,$data['username'],$data['admin_id']);
              redirect('Property/property_status_master');

        } 


    }



    public function property_fixed_expense_type(){
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
        if(!in_array("Fixed Expense Type",$role1)) {
       $msg = $session_data['username']." ".'Try To Access Property Fixed Expense Type Page This Page Access is Not Given to the'." ".$session_data['username'].'.';
        $this->user_activity_model->add('no_access',$msg,$session_data['username'],$session_data['admin_id']); 	
        redirect('Admin/auth_error');
        }

    	$data['fixed_expense'] = $this->property_model->view_fixed_expense_type();
    	 $msg = $session_data['username']." ".'Visited Property Fixed Expense Type Page.';
           $this->user_activity_model->add('visited_page',$msg,$session_data['username'],$session_data['admin_id']);
       		$this->load->view('property_fixed_expense_type',$this->security->xss_clean($data));
    }

    public function property_fixed_expense_type_insert(){
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
        if(!in_array("Fixed Expense Type",$role1)) {
        $msg = $session_data['username']." ".'Try To Access Property Fixed Expense Type Page This Page Access is Not Given to the'." ".$session_data['username'].'.';
        $this->user_activity_model->add('no_access',$msg,$session_data['username'],$session_data['admin_id']); 		
        redirect('Admin/auth_error');
        }

        $data['fixed_expense'] = $this->property_model->view_fixed_expense_type();

        $this->form_validation->set_rules('property_fixed_expense_type','Property Fixed Expense Type','required');

         if($this->form_validation->run() == false)
        {

            $this->load->view('property_fixed_expense_type',$this->security->xss_clean($data));
        }
        else{

            $query = $this->property_model->insertpropertyfixedexpensetype();
            $this->session->set_flashdata("fixed_expense","Property Fixed Expense Type Added Successfully");
            $msg = $data['username']." ".'Added Property Fixed Expense Type Named'." " .$this->input->post('property_fixed_expense_type'). '.';
                  $this->user_activity_model->add('added',$msg,$data['username'],$data['admin_id']);
            redirect("Property/property_fixed_expense_type","refresh",$this->security->xss_clean($data));

        }
    }

    public function update_fixed_expense_type(){
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
         $fixed_expense = base64_decode($this->uri->segment(3));
       
       $data['fixed_expense'] = $this->property_model->get_fixed_expense_type($fixed_expense);    

       foreach($data['fixed_expense'] as $expense){
       	$fixed_expense1 = $expense['fixed_expense'];
        $fixed_expense_id = $expense['fixed_expense_id'];
       }
         if(($fixed_expense == null OR $fixed_expense == '') OR (!isset($fixed_expense_id) OR $fixed_expense_id !== $fixed_expense OR $fixed_expense_id == null OR $fixed_expense_id == '')){

           show_404();
          exit();
          }
        if(!in_array("Fixed Expense Type",$role1)) {
        $msg = $session_data['username']." ".'Try To Use Update Property Fixed Expense Type Page For'." ".$fixed_expense1." ".'Update Property Fixed Expense Type Page Access is Not Given to the'." ".$session_data['username'].'.'; 
        $this->user_activity_model->add('no_access',$msg,$session_data['username'],$session_data['admin_id']);  	
        redirect('Admin/auth_error');
        }
         $msg = $session_data['username']." ".'Visited Update Property Fixed Expense Type Page For'." ".$fixed_expense1.'.';
       $this->user_activity_model->add('visited_page',$msg,$session_data['username'],$session_data['admin_id']);
        $this->load->view('update_fixed_expense_type',$this->security->xss_clean($data));


    }

    public function update_fixed_expense_type_redirect(){
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
          $fixed_expense = base64_decode($this->uri->segment(3));
       $data['fixed_expense'] = $this->property_model->get_fixed_expense_type($fixed_expense);

        foreach($data['fixed_expense'] as $expense){
       	$fixed_expense1 = $expense['fixed_expense'];
        $fixed_expense_id = $expense['fixed_expense_id'];
       }
         if(($fixed_expense == null OR $fixed_expense == '') OR (!isset($fixed_expense_id) OR $fixed_expense_id !== $fixed_expense OR $fixed_expense_id == null OR $fixed_expense_id == '')){

           show_404();
          exit();
          }

        if(!in_array("Fixed Expense Type",$role1)) {
        $msg = $session_data['username']." ".'Try To Use Update Property Fixed Expense Type Page For'." ".$fixed_expense1." ".'Update Property Fixed Expense Type Page Access is Not Given to the'." ".$session_data['username'].'.'; 
        $this->user_activity_model->add('no_access',$msg,$session_data['username'],$session_data['admin_id']);   	
        redirect('Admin/auth_error');
        }

        $this->form_validation->set_rules('property_fixed_expense_type','Property Fixed Expense Type','required');

        if($this->form_validation->run() == false)
        {
       
           
        $this->load->view('update_fixed_expense_type',$this->security->xss_clean($data));


           
        }

       else
        {

               $query = $this->property_model->update_fixed_expense_type($fixed_expense);

               $this->session->set_flashdata("update_fixed_expense","Fixed Expense Updated Successfully");
 			   $msg = $data['username']." ".'Updated'." ".$this->input->post('property_fixed_expense_type'). " ".'Property Fixed Expense Type Details.';
               $this->user_activity_model->add('updated',$msg,$data['username'],$data['admin_id']);
              redirect('Property/property_fixed_expense_type');

        } 


    }

    public function property_financial_status_master(){
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
        if(!in_array("Property Financial Status Master",$role1)) {
        $msg = $session_data['username']." ".'Try To Access Property Financial Status Master Page This Page Access is Not Given to the'." ".$session_data['username'].'.';
        $this->user_activity_model->add('no_access',$msg,$session_data['username'],$session_data['admin_id']);	
        redirect('Admin/auth_error');
        }
       
        $data['financial_status'] = $this->property_model->view_financial_status();
        $msg = $session_data['username']." ".'Visited Property Financial Status Master Page.';
           $this->user_activity_model->add('visited_page',$msg,$session_data['username'],$session_data['admin_id']);
       		 $this->load->view('property_financial_status_master',$this->security->xss_clean($data));
    }

    public function property_financial_status_master_insert(){
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
        if(!in_array("Property Financial Status Master",$role1)) {
        $msg = $session_data['username']." ".'Try To Access Property Financial Status Master Page This Page Access is Not Given to the'." ".$session_data['username'].'.';	
        $this->user_activity_model->add('no_access',$msg,$session_data['username'],$session_data['admin_id']);
        redirect('Admin/auth_error');
        }
       
        $data['financial_status'] = $this->property_model->view_financial_status();

        $this->form_validation->set_rules('financial_status','Property Financial Status','required');

         if($this->form_validation->run() == false)
        {

             $this->load->view('property_financial_status_master',$this->security->xss_clean($data));

        }
        else{

            $query = $this->property_model->insertfinancialstatus();
            $this->session->set_flashdata("financial_status","Property Financial Status Added Successfully");
            $msg = $data['username']." ".'Added Property Financial Status Named'." " .$this->input->post('financial_status'). '.';
                  $this->user_activity_model->add('added',$msg,$data['username'],$data['admin_id']);
            redirect("Property/property_financial_status_master","refresh",$this->security->xss_clean($data));

        }
    }

    public function update_property_financial_status(){
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
        $financial_status = base64_decode($this->uri->segment(3));
       
        $data['financial_status'] = $this->property_model->get_financial_status($financial_status);

       foreach($data['financial_status'] as $fin_status){

       	$fin_st = $fin_status['financial_status'];
        $financial_status_id = $fin_status['financial_status_id'];
       }

        if(($financial_status == null OR $financial_status == '') OR (!isset($financial_status_id) OR $financial_status_id !== $financial_status OR $financial_status_id == null OR $financial_status_id == '')){

           show_404();
          exit();
          }

        if(!in_array("Property Financial Status Master",$role1)) {
        $msg = $session_data['username']." ".'Try To Use Update Property Financial Status Master Page For'." ".$fin_st." ".'Update Property Financial Status Master Page Access is Not Given to the'." ".$session_data['username'].'.'; 
        $this->user_activity_model->add('no_access',$msg,$session_data['username'],$session_data['admin_id']); 	
        redirect('Admin/auth_error');
        }
        $msg = $session_data['username']." ".'Visited Update Property Financial Status Master Page For'." ".$fin_st.'.';
       $this->user_activity_model->add('visited_page',$msg,$session_data['username'],$session_data['admin_id']);
        $this->load->view('update_property_financial_status',$this->security->xss_clean($data));
    }

    public function update_property_financial_status_redirect(){
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

         $financial_status = base64_decode($this->uri->segment(3));
         $data['financial_status'] = $this->property_model->get_financial_status($financial_status);
        foreach($data['financial_status'] as $fin_status){

       	$fin_st = $fin_status['financial_status'];
        $financial_status_id = $fin_status['financial_status_id'];
       }

        if(($financial_status == null OR $financial_status == '') OR (!isset($financial_status_id) OR $financial_status_id !== $financial_status OR $financial_status_id == null OR $financial_status_id == '')){

           show_404();
          exit();
          }

        if(!in_array("Property Financial Status Master",$role1)) {
        $msg = $session_data['username']." ".'Try To Use Update Property Financial Status Master Page For'." ".$fin_st." ".'Update Property Financial Status Master Page Access is Not Given to the'." ".$session_data['username'].'.'; 
        $this->user_activity_model->add('no_access',$msg,$session_data['username'],$session_data['admin_id']); 		
        redirect('Admin/auth_error');
        }

        $this->form_validation->set_rules('financial_status','Property Financial Status','required');

        if($this->form_validation->run() == false)
        {
       
           
        $this->load->view('update_property_financial_status',$this->security->xss_clean($data));


           
        }

       else
        {

               $query = $this->property_model->update_financial_status($financial_status);

               $this->session->set_flashdata("update_financial_status","Property Financial Status Updated Successfully");
               $msg = $data['username']." ".'Updated'." ".$this->input->post('financial_status'). " ".'Financial Status Details.';
                  $this->user_activity_model->add('updated',$msg,$data['username'],$data['admin_id']);
              redirect('Property/property_financial_status_master');

        } 


    }


    public function view_property_data(){
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
        $property_id = base64_decode($this->uri->segment(3));
         
        $data['property'] = $this->property_model->get_property($property_id);

        foreach($data['property'] as $prop_data){

        	$property_name = $prop_data['property_name'];
            $prop_id = $prop_data['property_id'];
        }
        if(($property_id == null OR $property_id == '') OR (!isset($prop_id) OR $prop_id !== $property_id OR $prop_id == null OR $prop_id == '')){

           show_404();
          exit();
          }
        if(!in_array("View Property List",$role1)) {
        $msg = $session_data['username']." ".'Try To View Property Data For'." ".$property_name." ".'View Property Page Access is Not Given to the'." ".$session_data['username'].'.';
        $this->user_activity_model->add('no_access',$msg,$session_data['username'],$session_data['admin_id']);    	
        redirect('Admin/auth_error');
        }


        $prop_access_array = explode(",",$data['prop_access']);
        $property_array = explode(",",$property_id);

        $common_access = array_intersect($prop_access_array,$property_array);

        $final_property_access = implode(",",$common_access);

        $data['property_controller'] = $this->property_model->get_property_controller_data($property_id);
        $data['broker'] = $this->property_model->get_broker1($property_id);
        $data['seller'] = $this->property_model->get_seller1($property_id);
        $data['purchaser'] = $this->property_model->get_purchaser1($property_id);
        $data['lessee'] = $this->property_model->get_lessee1($property_id);
        $data['lessor'] = $this->property_model->get_lessor1($property_id);
        $data['fixed_expense'] = $this->property_model->get_fixed_expense($property_id);
        $data['property_images'] = $this->property_model->get_property_images($property_id);

          if($property_id == $final_property_access){
          		 $msg = $data['username']." ".'Viewed Property Details For'." ".$property_name. '.';
          $this->user_activity_model->add('viewed',$msg,$data['username'],$data['admin_id']);
                $this->load->view('view_property_data',$this->security->xss_clean($data));
            } else {
            	$msg = $session_data['username']." ".'Try To View Property Data For'." ".$property_name." ".'View Property Page Access is Not Given to the'." ".$session_data['username'].'.';
        		$this->user_activity_model->add('no_access',$msg,$session_data['username'],$session_data['admin_id']); 
            	redirect('Admin/auth_error');
            }

         

    }

     public function download_property_images(){

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

        $image_id = base64_decode($this->uri->segment(3));
        
        $image_prop_id = explode(",",$this->property_model->image_details($image_id));
        $property_id = $this->property_model->image_details($image_id);

        $data['property'] = $this->property_model->get_property($property_id);
        $data['image'] = $this->property_model->get_image_details($image_id);
        foreach($data['property'] as $prop_data){

        	$property_name = $prop_data['property_name'];
        }	

        foreach($data['image'] as $img){
            $property_image_id = $img['property_image_id'];
        }   

        if(($image_id == null OR $image_id == '') OR (!isset($property_image_id) OR $property_image_id !== $image_id OR $property_image_id == null OR $property_image_id == '')){

           show_404();
          exit();
          }

        if(!in_array("View Property List",$role1)) {
        $msg = $session_data['username']." ".'Try To Download Property Image for'." ".$property_name." ".'View Property Page Access is Not Given to the'." ".$session_data['username'].'.';
        $this->user_activity_model->add('no_access',$msg,$session_data['username'],$session_data['admin_id']);  	
        redirect('Admin/auth_error');
        }


        $prop_access_array = explode(",",$data['prop_access']);
        $common_access = array_intersect($prop_access_array,$image_prop_id);
        $final_property_access = implode(",",$common_access);
        if($property_id !== $final_property_access){
        		$msg = $session_data['username']." ".'Try To Download Property Image for'." ".$property_name." ".'That Property Access is Not Given to the'." ".$session_data['username'].'.';
       			 $this->user_activity_model->add('no_access',$msg,$session_data['username'],$session_data['admin_id']); 
            	redirect('Admin/auth_error');
            }


          if(!empty($image_id)){
            //load download helper
            $this->load->helper('download');
            
            //get file info from database
            $fileInfo = $this->property_model->download_detail($image_id);
            $fileInfo1 = base64_decode($fileInfo);
            
            //file path
            $file = file_get_contents(base_url().'assets/images/uploads/property/'.$fileInfo1);

             $msg = $data['username']." ".'Downloaded Property Image For'." ".$property_name." ".'Property.';
             $this->user_activity_model->add('download_document',$msg,$data['username'],$data['admin_id']);

            //download file from directory
            force_download($fileInfo1, $file);
            redirect('Property/view_property_data/'.$this->security->xss_clean($image_id));
        }
    }

    public function mark_property_sold(){
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

        $property_id = base64_decode($this->uri->segment(3));

        
        $data['property'] = $this->property_model->get_property($property_id);

        foreach($data['property'] as $prop_data){

        	$property_name = $prop_data['property_name'];
            $prop_id = $prop_data['property_id'];
        }	


        if(($property_id == null OR $property_id == '') OR (!isset($prop_id) OR $prop_id !== $property_id OR $prop_id == null OR $prop_id == '')){

           show_404();
          exit();
          }


        if(!in_array("View Property List",$role1)) {
        $msg = $session_data['username']." ".'Try To Sold Property Named'." ".$property_name." ".'View Property Page Access is Not Given to the'." ".$session_data['username'].'.';
        $this->user_activity_model->add('no_access',$msg,$session_data['username'],$session_data['admin_id']);  	
        redirect('Admin/auth_error');
        }

         $prop_access_array = explode(",",$data['prop_access']);
        $property_array = explode(",",$property_id);

        $common_access = array_intersect($prop_access_array,$property_array);

        $final_property_access = implode(",",$common_access);

        if($property_id == $final_property_access){

	        $data['status'] = $this->property_model->get_sold_financial_status();
	        foreach($data['status'] as $status){
	            $fin_status = $status;
	        }
	        $this->property_model->mark_property_sold($property_id,$fin_status);
	        $this->session->set_flashdata("mark_sold","Property Sold Successfully");
	        $msg = $data['username']." ".'Sold Property Named'." ".$property_name." ".'.';
             $this->user_activity_model->add('sold',$msg,$data['username'],$data['admin_id']);
	        redirect('Property/view_property_list');

        } else {
        		$msg = $session_data['username']." ".'Try To Sold Property Named'." ".$property_name." ".'That Property Access is Not Given to the'." ".$session_data['username'].'.';
       			 $this->user_activity_model->add('no_access',$msg,$session_data['username'],$session_data['admin_id']); 
            	redirect('Admin/auth_error');
          }
        
    }

        public function delete_buy_property(){
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
        
        $property_id = base64_decode($this->uri->segment(3));

         $data['property'] = $this->property_model->get_property($property_id);

        foreach($data['property'] as $prop_data){

        	$property_name = $prop_data['property_name'];
            $prop_id = $prop_data['property_id'];
        }   


        if(($property_id == null OR $property_id == '') OR (!isset($prop_id) OR $prop_id !== $property_id OR $prop_id == null OR $prop_id == '')){

           show_404();
          exit();
          }	


        if(!in_array("View Property List",$role1)) {
        $msg = $session_data['username']." ".'Try To Delete Property Named'." ".$property_name." ".'This Page Access is Not Given to the'." ".$session_data['username'].'.';
        $this->user_activity_model->add('no_access',$msg,$session_data['username'],$session_data['admin_id']);   	
        redirect('Admin/auth_error');
        }


          
          $property_id_arr = array($property_id);
		  $prop_access_array = explode(",",$data['prop_access']);
          $property_array = explode(",",$property_id);

          $common_access = array_intersect($prop_access_array,$property_array);

          $final_property_access = implode(",",$common_access);

          if($property_id !== $final_property_access){
          	$msg = $session_data['username']." ".'Try To Delete Property Named'." ".$property_name." ".'This Property Access is Not Given to the'." ".$session_data['username'].'.';
        	$this->user_activity_model->add('no_access',$msg,$session_data['username'],$session_data['admin_id']); 
           	redirect('Admin/auth_error');
            }

        $role_data = $this->property_model->view_role();
        foreach($role_data as $rdata){

            $admin_id1 = $rdata;

            $c = array_merge_recursive($admin_id1);

            $final_merege = implode(",",$c);

            $property_access_data = $this->property_model->get_property_access_data($final_merege);

            foreach($property_access_data as $access_data){
                $admin_id2 = $access_data['admin_id'];
            }


            if($final_merege == $admin_id2){

                $poperty_access_data_merege = array($access_data['property_access']);
           

            $poperty_access_data_merege1 = explode(",",$access_data['property_access']);

            $update_data_for_property_access = array_diff($poperty_access_data_merege1, $property_id_arr);

            $this->property_model->update_property_access_data($update_data_for_property_access,$admin_id2);

            }
        }

         $property_images = $this->property_model->get_property_images($property_id);
          foreach($property_images as $image){
                     $image_name = $image['property_image']; 
                     $property_id1 = $image['property_id'];
          }

          if($property_id1 == $property_id){
            $ipath = ('assets/images/uploads/property/'.base64_decode($image_name));
                                   
           $parts = explode('/', $ipath);
            $directory = 'assets/images/uploads/property/'.$parts[4];
            if($parts[4] !== ''){
	            chmod($directory,0777);
	            delete_files($directory, TRUE); 
	        }    rmdir($directory);
          }

         $this->property_model->delete_property($property_id);
         $this->property_model->delete_property_images($property_id);
         $this->property_model->delete_broker($property_id);
         $this->property_model->delete_seller($property_id);
         $this->property_model->delete_purchaser($property_id);
         $this->property_model->delete_fixed_expense($property_id);


         	 $data['admin_data'] = $this->property_model->view_role_by_id($data['admin_id']);
         	  $msg = $data['username']." ".'Deleted Property Details For'." ".$property_name. '.';
          $this->user_activity_model->add('deleted',$msg,$data['username'],$data['admin_id']);

            $array_items = array('password' => $session_data["password"], 'role_name' => $session_data["role_name"], 'roles' => $data['roles'], 'prop_access' => $data['prop_access']);

            $this->session->unset_userdata($array_items);
            $sess_array = array();
            foreach ($data['admin_data'] as $row) {
                $sess_array = array(
                    'admin_id' => $row['admin_id'],
                    'username' => $row['username'],
                    'password' => $row['password'],
                    'role_name' => $row['role_name'],
                    'roles' => $row['roles'],
                    'prop_access' => $row['property_access'],
                );
            }

        $this->session->set_flashdata("delete_property","Property Details and Associated Data With it Deleted successfully.");
        redirect("Property/view_property_list",$this->session->set_userdata('logged_in', $sess_array));        

    }

    public function delete_lease_property(){
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
        $property_id = base64_decode($this->uri->segment(3));
        $data['property'] = $this->property_model->get_property($property_id);

         foreach($data['property'] as $prop_data){

        	$property_name = $prop_data['property_name'];
            $prop_id = $prop_data['property_id'];
        }   


        if(($property_id == null OR $property_id == '') OR (!isset($prop_id) OR $prop_id !== $property_id OR $prop_id == null OR $prop_id == '')){

           show_404();
          exit();
          }


        if(!in_array("View Property List",$role1)) {
        $msg = $session_data['username']." ".'Try To Delete Property Named'." ".$property_name." ".'This Page Access is Not Given to the'." ".$session_data['username'].'.';
        $this->user_activity_model->add('no_access',$msg,$session_data['username'],$session_data['admin_id']);  	
        redirect('Admin/auth_error');
        }

        $property_id_arr = array($property_id);

        $prop_access_array = explode(",",$data['prop_access']);
          $property_array = explode(",",$property_id);

          $common_access = array_intersect($prop_access_array,$property_array);

          $final_property_access = implode(",",$common_access);

          if($property_id !== $final_property_access){
          		$msg = $session_data['username']." ".'Try To Delete Property Named'." ".$property_name." ".'This Property Access is Not Given to the'." ".$session_data['username'].'.';
        		$this->user_activity_model->add('no_access',$msg,$session_data['username'],$session_data['admin_id']);
            	redirect('Admin/auth_error');
            }

        $role_data = $this->property_model->view_role();
        foreach($role_data as $rdata){

            $admin_id1 = $rdata;

            $c = array_merge_recursive($admin_id1);

            $final_merege = implode(",",$c);

            $property_access_data = $this->property_model->get_property_access_data($final_merege);

            foreach($property_access_data as $access_data){
                $admin_id2 = $access_data['admin_id'];
            }


            if($final_merege == $admin_id2){

                $poperty_access_data_merege = array($access_data['property_access']);
           

            $poperty_access_data_merege1 = explode(",",$access_data['property_access']);

            $update_data_for_property_access = array_diff($poperty_access_data_merege1, $property_id_arr);

            $this->property_model->update_property_access_data($update_data_for_property_access,$admin_id2);

            }
        }

        $property_images = $this->property_model->get_property_images($property_id);
          foreach($property_images as $image){
           $image_name = $image['property_image']; 
           $property_id1 = $image['property_id'];
          }

          if($property_id1 == $property_id){
            $ipath = ('assets/images/uploads/property/'.base64_decode($image_name));
                                   
           $parts = explode('/', $ipath);
            $directory = 'assets/images/uploads/property/'.$parts[4];
            if($parts[4] !== ''){
	            chmod($directory,0777);
	            delete_files($directory, TRUE); 
	            rmdir($directory);
	        }    
          }
        

         $this->property_model->delete_property($property_id);
         $this->property_model->delete_property_images($property_id);
         $this->property_model->delete_broker($property_id);
         $this->property_model->delete_lessee($property_id);
         $this->property_model->delete_lessor($property_id);
         $this->property_model->delete_fixed_expense($property_id);

         $data['admin_data'] = $this->property_model->view_role_by_id($data['admin_id']);
         $msg = $data['username']." ".'Deleted Property Details For'." ".$property_name. '.';
          $this->user_activity_model->add('deleted',$msg,$data['username'],$data['admin_id']);

            $array_items = array('password' => $session_data["password"], 'role_name' => $session_data["role_name"], 'roles' => $data['roles'], 'prop_access' => $data['prop_access']);

            $this->session->unset_userdata($array_items);
            $sess_array = array();
            foreach ($data['admin_data'] as $row) {
                $sess_array = array(
                    'admin_id' => $row['admin_id'],
                    'username' => $row['username'],
                    'password' => $row['password'],
                    'role_name' => $row['role_name'],
                    'roles' => $row['roles'],
                    'prop_access' => $row['property_access'],
                );
            }

        $this->session->set_flashdata("delete_property","Property Details and Associated Data With it Deleted successfully.");
        redirect("Property/view_property_list",$this->session->set_userdata('logged_in', $sess_array));  
    }

     public function edit_property_detail(){

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
        $property_id = base64_decode($this->uri->segment(3));

        $data['property'] = $this->property_model->get_property($property_id);
      foreach($data['property'] as $property){
        $user_id = $property['property_controller_id'];
        $property_contract = $property['property_contract'];
        $property_name = $property['property_name'];
        $prop_id = $property['property_id'];
        }   


        if(($property_id == null OR $property_id == '') OR (!isset($prop_id) OR $prop_id !== $property_id OR $prop_id == null OR $prop_id == '')){

           show_404();
          exit();
          }

        if(!in_array("View Property List",$role1)) {
        $msg = $session_data['username']." ".'Try To View Edit Property Data Page For'." ".$property_name." ".'Edit Property Data Page Access is Not Given to the'." ".$session_data['username'].'.';
        $this->user_activity_model->add('no_access',$msg,$session_data['username'],$session_data['admin_id']);   	
        redirect('Admin/auth_error');
        }

       $prop_access_array = explode(",",$data['prop_access']);
        $property_array = explode(",",$property_id);

        $common_access = array_intersect($prop_access_array,$property_array);
        $final_property_access = implode(",",$common_access);

        if($property_id !== $final_property_access){

           		$msg = $session_data['username']." ".'Try To View Edit Property Data Page For'." ".$property_name." ".'This Property Data Page Access is Not Given to the'." ".$session_data['username'].'.';
        		$this->user_activity_model->add('no_access',$msg,$session_data['username'],$session_data['admin_id']);   	
            	redirect('Admin/auth_error');
            }

        $data['property_type'] = $this->property_model->view_property_type();
        $data['unit'] = $this->property_model->view_unit();
        $data['jurisdiction'] = $this->property_model->view_jurisdiction();
        $data['property_status'] = $this->property_model->view_property_status();
        $data['land_type'] = $this->property_model->view_land_type();
        $data['property_group'] = $this->property_model->view_property_group();
        $data['fixed_expense'] = $this->property_model->view_fixed_expense_type();

       $data['property_controller'] = $this->property_model->get_property_controller_for_edit($user_id);
        $data['broker1'] = $this->property_model->get_broker1($property_id);
        foreach($data['broker1'] as $broker){
        $broker_id = $broker['broker_name'];
       }
        $data['broker'] = $this->property_model->get_broker_for_edit($broker_id);
       
        if($this->input->post('property_contract') == 'Lease' OR $property_contract == 'Lease'){

            $data['lessee1'] = $this->property_model->get_lessee1($property_id);
            foreach($data['lessee1'] as $lessee){
            $lessee_id = $lessee['lessee_name'];
            $activation_status1 = $lessee['activation_status'];

	        $query1 = $this->db->join('user_type_master', 'user_master.user_type_id=user_type_master.user_type_id');   
	        $this->db->order_by('user_id','desc');
	        $where = "user_type = 'Lesse' AND activation_status = 'Activated'";
	        $user = 'user_id  = "'.$lessee_id.'"';
	        if($activation_status1 == 'Deactivated' AND $user){
	         $where1 = "user_type = 'Lesse' AND user_id  = ".$lessee_id." AND activation_status = 'Deactivated'";

	        }
	        $this->db->where($where);
	        if(!empty($where1)){
	        	$this->db->or_where($where1);
	        }       
	        $query1 = $this->db->from('user_master');
	        $query1 = $this->db->get();
	        $data['lesse'] = $query1->result_array();
           }
            $data['lessor1'] = $this->property_model->get_lessor1($property_id);
            foreach($data['lessor1'] as $lessor){
            $lessor_id = $lessor['lessor_name'];
            $activation_status = $lessor['activation_status'];

	        $query1 = $this->db->join('user_type_master', 'user_master.user_type_id=user_type_master.user_type_id');   
	        $this->db->order_by('user_id','desc');
	        $where = "user_type = 'Lessor' AND activation_status = 'Activated'";
	        $user1 = 'user_id  = "'.$lessor_id.'"';
	        if($activation_status == 'Deactivated' AND $user1){
	         $where2 = "user_type = 'Lessor' AND user_id  = ".$lessor_id." AND activation_status = 'Deactivated'";

	        }
	        $this->db->where($where);
	        if(!empty($where2)){
	        	        $this->db->or_where($where2);
	        }    
 
	        $query1 = $this->db->from('user_master');
	        $query1 = $this->db->get();
	        $data['lessor'] = $query1->result_array();
           }

       }else{

            $data['seller1'] = $this->property_model->get_seller1($property_id);
            foreach($data['seller1'] as $seller){
            $seller_id = $seller['seller_name'];
            $activation_status1 = $seller['activation_status'];

            $query1 = $this->db->join('user_type_master', 'user_master.user_type_id=user_type_master.user_type_id');   
	        $this->db->order_by('user_id','desc');
	        $where = "user_type = 'Seller' AND activation_status = 'Activated'";
	        $user1 = 'user_id  = "'.$seller_id.'"';
	        if($activation_status1 == 'Deactivated' AND $user1){
	         $where2 = "user_type = 'Seller' AND user_id  = ".$seller_id." AND activation_status = 'Deactivated'";

	        }
	        $this->db->where($where);
	        if(!empty($where2)){
	        	        $this->db->or_where($where2);
	        }       
	        $query1 = $this->db->from('user_master');
	        $query1 = $this->db->get();
	        $data['seller'] = $query1->result_array();
           }
            $data['purchaser1'] = $this->property_model->get_purchaser1($property_id);
            foreach($data['purchaser1'] as $purchaser){
            $purchaser_id = $purchaser['purchaser_name'];
            $activation_status = $purchaser['activation_status'];

	        $query1 = $this->db->join('user_type_master', 'user_master.user_type_id=user_type_master.user_type_id');   
	        $this->db->order_by('user_id','desc');
	        $where = "user_type = 'Purchaser' AND activation_status = 'Activated'";
	        $user = 'user_id  = "'.$purchaser_id.'"';
	        if($activation_status == 'Deactivated' AND $user){
	         $where1 = "user_type = 'Purchaser' AND user_id  = ".$purchaser_id." AND activation_status = 'Deactivated'";

	        }
	        $this->db->where($where);
	        if(!empty($where1)){
	        	        $this->db->or_where($where1);
	        }       
	        $query1 = $this->db->from('user_master');
	        $query1 = $this->db->get();
	        $data['purchaser'] = $query1->result_array();
           }

       }
        $data['fixed_expense1'] = $this->property_model->get_fixed_expense($property_id);
        $data['property_images'] = $this->property_model->get_property_images($property_id);
        $data['lease_own'] = $this->property_model->get_lease_own_detail($property_id);
        $data['lease_given'] = $this->property_model->get_lease_given_detail($property_id);
        $msg = $session_data['username']." ".'Visited Edit Property Data Page For'." ".$property_name.'.';
       $this->user_activity_model->add('visited_page',$msg,$session_data['username'],$session_data['admin_id']);
         $this->load->view('edit_property_details',$this->security->xss_clean($data));


    }

    public function edit_property_detail_redirect(){

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
        $property_id = base64_decode($this->uri->segment(3));

       $data['property'] = $this->property_model->get_property($property_id);
       foreach($data['property'] as $property){
        $user_id = $property['property_controller_id'];
        $property_contract = $property['property_contract'];
        $property_name = $property['property_name'];
        $prop_id = $property['property_id'];
        }   


        if(($property_id == null OR $property_id == '') OR (!isset($prop_id) OR $prop_id !== $property_id OR $prop_id == null OR $prop_id == '')){

           show_404();
          exit();
          }

        if(!in_array("View Property List",$role1)) {
         $msg = $session_data['username']." ".'Try To View Edit Property Data Page For'." ".$property_name." ".'Edit Property Data Page Access is Not Given to the'." ".$session_data['username'].'.';
        $this->user_activity_model->add('no_access',$msg,$session_data['username'],$session_data['admin_id']); 	
        redirect('Admin/auth_error');
        }

      $prop_access_array = explode(",",$data['prop_access']);
        $property_array = explode(",",$property_id);

        $common_access = array_intersect($prop_access_array,$property_array);

        $final_property_access = implode(",",$common_access);

        if($property_id !== $final_property_access){

           		$msg = $session_data['username']." ".'Try To View Edit Property Data Page For'." ".$property_name." ".'This Property Data Page Access is Not Given to the'." ".$session_data['username'].'.';
        		$this->user_activity_model->add('no_access',$msg,$session_data['username'],$session_data['admin_id']);
            	redirect('Admin/auth_error');
            }

        $data['property_type'] = $this->property_model->view_property_type();
        $data['unit'] = $this->property_model->view_unit();
        $data['jurisdiction'] = $this->property_model->view_jurisdiction();
        $data['property_status'] = $this->property_model->view_property_status();
        $data['land_type'] = $this->property_model->view_land_type();
        $data['property_group'] = $this->property_model->view_property_group();
        $data['fixed_expense'] = $this->property_model->view_fixed_expense_type();

       $data['property_controller'] = $this->property_model->get_property_controller_for_edit($user_id);
        $data['broker1'] = $this->property_model->get_broker1($property_id);
        foreach($data['broker1'] as $broker){
        $broker_id = $broker['broker_name'];
       }
        $data['broker'] = $this->property_model->get_broker_for_edit($broker_id);
       
        if($this->input->post('property_contract') == 'Lease' OR $property_contract == 'Lease'){

            $data['lessee1'] = $this->property_model->get_lessee1($property_id);
            foreach($data['lessee1'] as $lessee){
            $lessee_id = $lessee['lessee_name'];
            $activation_status1 = $lessee['activation_status'];

	        $query1 = $this->db->join('user_type_master', 'user_master.user_type_id=user_type_master.user_type_id');   
	        $this->db->order_by('user_id','desc');
	        $where = "user_type = 'Lesse' AND activation_status = 'Activated'";
	        $user = 'user_id  = "'.$lessee_id.'"';
	        if($activation_status1 == 'Deactivated' AND $user){
	         $where1 = "user_type = 'Lesse' AND user_id  = ".$lessee_id." AND activation_status = 'Deactivated'";

	        }
	        $this->db->where($where);
	        if(!empty($where1)){
	        	$this->db->or_where($where1);
	        }       
	        $query1 = $this->db->from('user_master');
	        $query1 = $this->db->get();
	        $data['lesse'] = $query1->result_array();
           }
            $data['lessor1'] = $this->property_model->get_lessor1($property_id);
            foreach($data['lessor1'] as $lessor){
            $lessor_id = $lessor['lessor_name'];
            $activation_status = $lessor['activation_status'];

	        $query1 = $this->db->join('user_type_master', 'user_master.user_type_id=user_type_master.user_type_id');   
	        $this->db->order_by('user_id','desc');
	        $where = "user_type = 'Lessor' AND activation_status = 'Activated'";
	        $user1 = 'user_id  = "'.$lessor_id.'"';
	        if($activation_status == 'Deactivated' AND $user1){
	         $where2 = "user_type = 'Lessor' AND user_id  = ".$lessor_id." AND activation_status = 'Deactivated'";

	        }
	        $this->db->where($where);
	        if(!empty($where2)){
	        	        $this->db->or_where($where2);
	        }    
 
	        $query1 = $this->db->from('user_master');
	        $query1 = $this->db->get();
	        $data['lessor'] = $query1->result_array();
           }

       }else{

            $data['seller1'] = $this->property_model->get_seller1($property_id);
            foreach($data['seller1'] as $seller){
            $seller_id = $seller['seller_name'];
            $activation_status1 = $seller['activation_status'];

            $query1 = $this->db->join('user_type_master', 'user_master.user_type_id=user_type_master.user_type_id');   
	        $this->db->order_by('user_id','desc');
	        $where = "user_type = 'Seller' AND activation_status = 'Activated'";
	        $user1 = 'user_id  = "'.$seller_id.'"';
	        if($activation_status1 == 'Deactivated' AND $user1){
	         $where2 = "user_type = 'Seller' AND user_id  = ".$seller_id." AND activation_status = 'Deactivated'";

	        }
	        $this->db->where($where);
	        if(!empty($where2)){
	        	        $this->db->or_where($where2);
	        }       
	        $query1 = $this->db->from('user_master');
	        $query1 = $this->db->get();
	        $data['seller'] = $query1->result_array();
           }
            $data['purchaser1'] = $this->property_model->get_purchaser1($property_id);
            foreach($data['purchaser1'] as $purchaser){
            $purchaser_id = $purchaser['purchaser_name'];
            $activation_status = $purchaser['activation_status'];

	        $query1 = $this->db->join('user_type_master', 'user_master.user_type_id=user_type_master.user_type_id');   
	        $this->db->order_by('user_id','desc');
	        $where = "user_type = 'Purchaser' AND activation_status = 'Activated'";
	        $user = 'user_id  = "'.$purchaser_id.'"';
	        if($activation_status == 'Deactivated' AND $user){
	         $where1 = "user_type = 'Purchaser' AND user_id  = ".$purchaser_id." AND activation_status = 'Deactivated'";

	        }
	        $this->db->where($where);
	        if(!empty($where1)){
	        	        $this->db->or_where($where1);
	        }       
	        $query1 = $this->db->from('user_master');
	        $query1 = $this->db->get();
	        $data['purchaser'] = $query1->result_array();
           }

       }
        $data['fixed_expense1'] = $this->property_model->get_fixed_expense($property_id);
        $data['property_images'] = $this->property_model->get_property_images($property_id);
        $data['lease_own'] = $this->property_model->get_lease_own_detail($property_id);
        $data['lease_given'] = $this->property_model->get_lease_given_detail($property_id);
    
         $this->form_validation->set_rules('property_type','Property Type','required');
       $this->form_validation->set_rules('property_name','Property Name','required');
        $this->form_validation->set_rules('address','Address','required');
        $this->form_validation->set_rules('city','City','required');
        $this->form_validation->set_rules('state','State','trim|required');
        $this->form_validation->set_rules('pincode','Pincode','required');
        $this->form_validation->set_rules('unit','Unit','required');
        $this->form_validation->set_rules('property_unit','Property Unit','required');
        $this->form_validation->set_rules('property_price_per_unit','Property Price Per Unit','required');
        $this->form_validation->set_rules('property_total_price','Total Price','required');
        $this->form_validation->set_rules('property_controller','Property Controller','required');
        $this->form_validation->set_rules('property_jurisdiction','Property Jurisdiction','required');
        $this->form_validation->set_rules('property_group','Property Group','required');
        $this->form_validation->set_rules('purchase_date','Purchase Date','required');
         $this->form_validation->set_rules('status','Property Status','required');
        $this->form_validation->set_rules('broker_name','Broker Name','required');
        $this->form_validation->set_rules('commission_type','Commission Type','required');
        $this->form_validation->set_rules('brokerage_amount','Brokerage Amount','required');
        $this->form_validation->set_rules('brokerage_amount_paid','Brokerage Amount Paid','required');
        $this->form_validation->set_rules('payment_status','Payment Status','required');
        $this->form_validation->set_rules('payment_date','Payment Date','required');
        $this->form_validation->set_rules('add_expense[0]','Expense Type','required');
            $this->form_validation->set_rules('expense_amount[0]','Expense Amount','required');

        if($this->input->post('payment_status') == 'Partically Paid'){

            $this->form_validation->set_rules('partical_amount','Partically Paid Amount','required');

        }

        if($this->input->post('property_contract') == 'Lease'){
            $this->form_validation->set_rules('leasse_name[0]','Lessee Name','required');
            $this->form_validation->set_rules('leasse_share_in_property[0]','Share in Property','required');
            $this->form_validation->set_rules('leassor_name[0]','Lessor Name','required');
            $this->form_validation->set_rules('leassor_share_in_property[0]','Share in Property','required');
            
        }

        if($this->input->post('property_contract') == 'Buy'){
            $this->form_validation->set_rules('seller_name[0]','Seller Name','required');
            $this->form_validation->set_rules('share_in_property[0]','Share in Property','required');
            $this->form_validation->set_rules('purchaser_name[0]','Purchaser Name','required');
            $this->form_validation->set_rules('purchaser_share_in_property[0]','Share in Property','required');
            
        }

            $type = $this->property_model->view_type($this->input->post('property_type'));

        foreach($type as $type1){

        
			        if($type1 === 'Building/Warehouse/Commercial Building'){
			        	
	    						if(empty($this->input->post('rera_number'))){
	    							$this->form_validation->set_rules('rera_number','Rera Number','required');
	    						}
	    						if(empty($this->input->post('bu_number'))){

				        		 $this->form_validation->set_rules('bu_number','Bu Number','required');
				        		 
				        	}
				        	
						}


			       if($type1 === 'Agricultural Land' || $type1 === 'N/A Land'){

			        		if(empty($this->input->post('nature_of_land'))){

			        		 $this->form_validation->set_rules('nature_of_land','Nature of Land','required');
			        		}
			        		if(empty($this->input->post('type_of_land'))){

			        		 $this->form_validation->set_rules('type_of_land','Type of Land','required');
			        		}
			        }

		        }   


        if($this->form_validation->run() === FALSE)
        {
            $this->load->view('edit_property_details',$this->security->xss_clean($data));
        }
        else{

                 	

         $purchase_date = $this->input->post('purchase_date');
           $newDate = date("Y-m-d", strtotime($purchase_date));

           /*if($this->input->post('property_contract') == 'Lease'){
            $financial_status = 'Leased';
            $financial_status_id = $this->property_model->get_property_financial_status($financial_status);

           }
           else
           {

            $financial_status = 'Purchased';
            $financial_status_id = $this->property_model->get_property_financial_status($financial_status);
          }

           foreach($financial_status_id as $id){
                $financial_id = $id;
            }*/
            $rera_number= "";
            $bu_number= "";
            $nature_of_land= "";
            $type_of_land= "";
            $type = $this->property_model->view_type($this->input->post('property_type'));
            foreach($type as $type1){
	            if($type1=== 'Building/Warehouse/Commercial Building'){
		            if(!empty($this->input->post('rera_number')) AND !empty($this->input->post('bu_number'))){
		                 $rera_number = $this->input->post('rera_number');
		                 $bu_number = $this->input->post('bu_number');
		            }
	        	}

	           if($type1 === 'Agricultural Land' || $type1 === 'N/A Land'){	
		           if(!empty($this->input->post('nature_of_land')) AND !empty($this->input->post('type_of_land'))){
		                $nature_of_land = $this->input->post('nature_of_land');
		                $type_of_land = $this->input->post('type_of_land');
		            }
	           }
       	}

         $property_data = array(              
            'property_type_id' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$this->input->post('property_type'))),
            'property_name' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$this->input->post('property_name'))),
            'property_address' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>?\|=+]/"," ",$this->input->post('address'))),
            'city' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$this->input->post('city'))),
            'state' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$this->input->post('state'))),
            'pincode' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$this->input->post('pincode'))),
            'latitude' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,?\|=+]/"," ",$this->input->post('latitude'))),
            'longitude' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,?\|=+]/"," ",$this->input->post('longitude'))),
            'nature_of_land' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$nature_of_land)), 
            'land_type_id' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$type_of_land)), 
            'rera_number' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$rera_number)), 
            'bu_number' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$bu_number)), 
            'property_controller_id' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$this->input->post('property_controller'))),
            'property_group_id' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$this->input->post('property_group'))),
            'property_juridiction_id' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$this->input->post('property_jurisdiction'))),
            'property_purchase_date' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$newDate)),
            'property_status_id' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$this->input->post('status'))),
            'property_remarks' => $this->db->escape_str($this->input->post('property_remark')),
         );    
       
         
           $this->property_model->update_property($property_data,$property_id);


          if (!empty($_FILES['userfile']['name']) && count(array_filter($_FILES['userfile']['name'])) > 0)
           {
                                
                                    $random_string = random_string('alnum', 10);

                                    $property_images = $this->property_model->get_property_images($property_id);
                                    foreach($property_images as $image){
                                        $image_name = $image['property_image']; 
                                    }

                                    $ipath = ('assets/images/uploads/property/'.base64_decode($image_name));
                                   
                                    $parts = explode('/', $ipath);
                                    $check_null = $parts[4] == NULL;

                                    if (!is_dir('assets/images/uploads/property/'.$check_null) AND ($parts[4] == NULL)) {
                                        //echo "1";
                                        mkdir('assets/images/uploads/property/' . str_replace(' ', '_', $this->input->post('property_name')).$random_string, 0777, TRUE);
                                        $ipath = realpath(APPPATH . '../assets/images/uploads/property/'.str_replace(' ', '_', $this->input->post('property_name').$random_string));
                                        chmod($ipath,0777);
                                    }
                                    else {
                                        //echo "2";
                                        $ipath = ('assets/images/uploads/property/'.$parts[4]);
                                        chmod($ipath,0777);

                                    }
                            
                                   //exit();

                        $strInputFileName = "userfile";
                        $arrFiles = $_FILES;
                        $config['upload_path'] = $ipath;
                        $config['allowed_types'] = "gif|jpg|png|jpeg|pdf|GIF|JPG|PNG|JPEG|PDF";
                        $config['max_size'] = '3072';
                        $config['max_width'] = '3000';
                        $config['max_height'] = '3000';
                        $config['file_name'] = $this->getRandomFileName();

                            if (is_array($_FILES[$strInputFileName]['name']))
                            {
                                    $countFiles = count($_FILES[$strInputFileName]['name']);
                                    for($i=0;$i<$countFiles; $i++)
                                    {
                                        //overwrite _FILES array
                                        $_FILES[$strInputFileName]['name'] = $arrFiles[$strInputFileName]['name'][$i];
                                        $_FILES[$strInputFileName]['type'] = $arrFiles[$strInputFileName]['type'][$i];
                                        $_FILES[$strInputFileName]['tmp_name'] = $arrFiles[$strInputFileName]['tmp_name'][$i];
                                        $_FILES[$strInputFileName]['error'] = $arrFiles[$strInputFileName]['error'][$i];
                                        $_FILES[$strInputFileName]['size'] = $arrFiles[$strInputFileName]['size'][$i];
                                        $this->upload->initialize($config);
                                        if(!$this->upload->do_upload($strInputFileName))
                                        {
                                         
                                            //print_r($this->upload->display_errors());
                                            //exit();
                                            $this->session->set_flashdata('new_in',2);  
                                            redirect('property/edit_property_detail_redirect/'.$this->security->xss_clean($this->uri->segment(3)));
                                        } 
                                        else 
                                        {
                                                $uploadData = $this->upload->data();
                                                 chmod($uploadData,0777);
                                            $filename = $uploadData['file_name'];
                                            $property_image = '';
                                            if(!empty($parts[4])){
                                                $property_image = base64_encode($parts[4].'/'.$filename);
                                            }else{
                                                $property_image = base64_encode(str_replace(' ', '_', $this->input->post('property_name')).$random_string.'/'.$filename);
                                            }
                                                  $image_data = array(              
                                                                            'property_id' => $property_id,
                                                                            'property_image' => $property_image,
                                                                            'image_added_date' => date('Y-m-d')
                                                                      );                
                                            
                                            $this->property_model->add_property_images($image_data);
                                        }
                                    }
                                }    
                            }    


            // Broker Details


             $payment_date = $this->input->post('payment_date');
           $payment_date1 = date("Y-m-d", strtotime($payment_date));

            $broker_data = array(              
            'broker_name' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$this->input->post('broker_name'))),
            'broker_commission_type' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$this->input->post('commission_type'))),
            'brokerage_amount' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,?\|=+]/"," ",$this->input->post('brokerage_amount'))),
            'brokerage_amount_to_paid' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,?\|=+]/"," ",$this->input->post('brokerage_amount_paid'))),
            'payment_status' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$this->input->post('payment_status'))),
            'partically_paid_amount' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,?\|=+]/"," ",$this->input->post('partical_amount'))),
            'payment_date' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$payment_date1))
         );                                    

        $this->property_model->update_broker($broker_data,$property_id);
            
            $this->property_model->delete_lessee($property_id);
            $this->property_model->delete_lessor($property_id);
            $this->property_model->delete_seller($property_id);
            $this->property_model->delete_purchaser($property_id);
            $this->property_model->delete_fixed_expense($property_id);


            if($this->input->post('property_contract') === 'Buy'){


                for($i=0; $i< count($this->input->post('seller_name'));$i++){
                                      $seller_name = $this->input->post('seller_name')[$i];
                                       $share_in_property = $this->input->post('share_in_property')[$i];
                                   
                                            $seller_data = array(              
                                                'property_id' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$property_id)),
                                                'seller_name' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$seller_name)),
                                                'share_in_property' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,?\|=+]/"," ",$share_in_property)),
                                                'seller_added_date' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",date('Y-m-d')))
                                            );                                    

                                        $this->property_model->add_seller($seller_data);
                                    }

                for($i=0; $i< count($this->input->post('purchaser_name'));$i++){
                                      $purchaser_name = $this->input->post('purchaser_name')[$i];
                                       $share_in_property = $this->input->post('purchaser_share_in_property')[$i];
                                   
                                            $purchaser_data = array(              
                                                'property_id' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$property_id)),
                                                'purchaser_name' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$purchaser_name)),
                                                'share_in_property' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,?\|=+]/"," ",$share_in_property)),
                                                'purchaser_added_date' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",date('Y-m-d')))
                                            );                                    

                                        $this->property_model->add_purchaser($purchaser_data);
                                    }

            }
            else{

                for($i=0; $i< count($this->input->post('leasse_name'));$i++){
                                      $lessee_name = $this->input->post('leasse_name')[$i];
                                       $share_in_property = $this->input->post('leasse_share_in_property')[$i];
                                   
                                            $lessee_data = array(              
                                                'property_id' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$property_id)),
                                                'lessee_name' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$lessee_name)),
                                                'share_in_property' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,?\|=+]/"," ",$share_in_property)),
                                                'lessee_added_date' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",date('Y-m-d')))
                                            );  

                                        $this->property_model->add_lessee($lessee_data);
                                    }

                for($i=0; $i< count($this->input->post('leassor_name'));$i++){
                                      $leassor_name = $this->input->post('leassor_name')[$i];
                                       $share_in_property = $this->input->post('leassor_share_in_property')[$i];
                                   
                                            $lessor_data = array(              
                                                'property_id' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$property_id)),
                                                'lessor_name' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$leassor_name)),
                                                'share_in_property' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,?\|=+]/"," ",$share_in_property)),
                                                'lessor_added_date' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",date('Y-m-d')))
                                            );                               

                                       $this->property_model->add_lessor($lessor_data);
                                    }

            }

         
            for($i=0; $i< count($this->input->post('add_expense'));$i++){
                                      $add_expense = $this->input->post('add_expense')[$i];
                                       $expense_amount = $this->input->post('expense_amount')[$i];
                                   
                                            $expense_data = array(              
                                                'property_id' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$property_id)),
                                                'expense_type_id' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",$add_expense)),
                                                'expense_amount' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,?\|=+]/"," ",$expense_amount)),
                                                'fixed_expense_added_date' => $this->db->escape_str(preg_replace("/[!@#$%^&*(){}:;<>,.?\|=+]/"," ",date('Y-m-d')))
                                            );                                    

                                        $this->property_model->add_fixed_expense($expense_data);
                                    }

        

         

         $this->session->set_flashdata("update_property","Property Details Updated Successfully");
          $msg = $data['username']." ".'Updated'." ".$this->input->post('property_name'). " ".'Property Details.';
          $this->user_activity_model->add('updated',$msg,$data['username'],$data['admin_id']);
             redirect('Property/view_property_list');    

             
       }     
     
    }

        public function delete_edit_property_images(){

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
       $property_image_id = base64_decode($this->uri->segment(3));
        
       $data['property_id'] = $this->property_model->get_property_images_property_id($property_image_id);
       $property_id = '';
       foreach($data['property_id'] as $property){
        $image_name = $property['property_image'];
        $property_id = $property['property_id'];
        $property_name = $property['property_name'];
        $prop_img_id = $property['property_image_id'];
       }

       if(($property_image_id == null OR $property_image_id == '') OR (!isset($prop_img_id) OR $prop_img_id !== $property_image_id OR $prop_img_id == null OR $prop_img_id == '')){

           show_404();
          exit();
          }

        if(!in_array("View Property List",$role1)) {
        $msg = $session_data['username']." ".'Try To Delete Image For'." ".$property_name." ".'View Property List Page Access is Not Given to the'." ".$session_data['username'].'.';
        $this->user_activity_model->add('no_access',$msg,$session_data['username'],$session_data['admin_id']);   		
        redirect('Admin/auth_error');
        }

      
       $prop_access_array = explode(",",$data['prop_access']);
        $property_array = explode(",",$property_id);

        $common_access = array_intersect($prop_access_array,$property_array);

        $final_property_access = implode(",",$common_access);

        if($property_id !== $final_property_access){
        	$msg = $session_data['username']." ".'Try To Delete Property Image For '." ".$property_name." ".'This Property Access is Not Given to the'." ".$session_data['username'].'.';
        	$this->user_activity_model->add('no_access',$msg,$session_data['username'],$session_data['admin_id']); 
            	redirect('Admin/auth_error');
            }

            
        $ipath = ('assets/images/uploads/property/'.base64_decode($image_name));
         $parts = explode('/', $ipath);

         $directory = 'assets/images/uploads/property/'.$parts[4];

        unlink($ipath);  

         $files = scandir($directory);
         $num_files = count($files)-2;

         if($num_files == 0){
            
            rmdir($directory);
         }

         $this->property_model->delete_edit_property_images($property_image_id);
       $this->session->set_flashdata("delete_property_image","Property Image Deleted successfully.");
       $msg = $data['username']." ".'Deleted Property Image For'." ".$property_name. '.';
          $this->user_activity_model->add('deleted',$msg,$data['username'],$data['admin_id']);
       redirect('Property/edit_property_detail/'.$this->security->xss_clean(base64_encode($property_id)));   
    }


    public function property_group_master(){
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
        if(!in_array("Property Group Master",$role1)) {
        $msg = $session_data['username']." ".'Try To Access Property Group Master Page This Page Access is Not Given to the'." ".$session_data['username'].'.';
        $this->user_activity_model->add('no_access',$msg,$session_data['username'],$session_data['admin_id']);	
        redirect('Admin/auth_error');
        }
    	$data['property_group'] = $this->property_model->view_property_group();
        $msg = $session_data['username']." ".'Visited Property Group Master Page.';
        $this->user_activity_model->add('visited_page',$msg,$session_data['username'],$session_data['admin_id']);   
        $this->load->view('property_group_master',$this->security->xss_clean($data));

    }

    public function property_group_master_insert(){
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
        if(!in_array("Property Group Master",$role1)) {
        $msg = $session_data['username']." ".'Try To Access Property Group Master Page This Page Access is Not Given to the'." ".$session_data['username'].'.';
        $this->user_activity_model->add('no_access',$msg,$session_data['username'],$session_data['admin_id']);		
        redirect('Admin/auth_error');
        }

        $data['property_group'] = $this->property_model->view_property_group();

        $this->form_validation->set_rules('property_group','Property Group','required');
        $this->form_validation->set_rules('group_controller','Group Controller','required');

         if($this->form_validation->run() == false)
        {
       
           
        $this->load->view('property_group_master',$this->security->xss_clean($data));


           
        }
        else{

            $query = $this->property_model->insertpropertygroup();
            $this->session->set_flashdata("property_group","Property Group Added Successfully");
            $msg = $data['username']." ".'Added Property Group Named'." " .$this->input->post('property_group'). '.';
            $this->user_activity_model->add('added',$msg,$data['username'],$data['admin_id']);
            redirect("Property/property_group_master","refresh",$this->security->xss_clean($data));

        }

    }


     public function update_property_group(){
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
       	$property_group = base64_decode($this->uri->segment(3));
       
        $data['property_group'] = $this->property_model->get_property_group($property_group);

        foreach($data['property_group'] as $prop_group){

        	$group = $prop_group['property_group'];
            $property_group_id = $prop_group['property_group_id'];
        }
         if(($property_group == null OR $property_group == '') OR (!isset($property_group_id) OR $property_group_id !== $property_group OR $property_group_id == null OR $property_group_id == '')){

           show_404();
          exit();
          }
        if(!in_array("Property Group Master",$role1)) {
         $msg = $session_data['username']." ".'Try To Use Update Property Group Page For'." ".$group." ".'Update Property Group Page Access is Not Given to the'." ".$session_data['username'].'.'; 
        $this->user_activity_model->add('no_access',$msg,$session_data['username'],$session_data['admin_id']); 	
        redirect('Admin/auth_error');
        }
        $msg = $session_data['username']." ".'Visited Update Property Group Page For'." ".$group.'.';
       $this->user_activity_model->add('visited_page',$msg,$session_data['username'],$session_data['admin_id']);
        $this->load->view('update_property_group_master',$this->security->xss_clean($data));


    }

      public function update_property_group_redirect(){
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
        $property_group = base64_decode($this->uri->segment(3));

        $data['property_group'] = $this->property_model->get_property_group($property_group);

        foreach($data['property_group'] as $prop_group){

        	$group = $prop_group['property_group'];
            $property_group_id = $prop_group['property_group_id'];
        }
         if(($property_group == null OR $property_group == '') OR (!isset($property_group_id) OR $property_group_id !== $property_group OR $property_group_id == null OR $property_group_id == '')){

           show_404();
          exit();
          }

        if(!in_array("Property Group Master",$role1)) {
         $msg = $session_data['username']." ".'Try To Use Update Property Group Page For'." ".$group." ".'Update Property Group Page Access is Not Given to the'." ".$session_data['username'].'.'; 
        $this->user_activity_model->add('no_access',$msg,$session_data['username'],$session_data['admin_id']); 		
        redirect('Admin/auth_error');
        }

        $this->form_validation->set_rules('property_group','Property Group','required');
        $this->form_validation->set_rules('group_controller','Group Controller','required');

       if($this->form_validation->run() == false)
        {
       
           
        $this->load->view('update_property_group_master',$this->security->xss_clean($data));


           
        }

        else
        {

               $query = $this->property_model->update_property_group($property_group);

               $this->session->set_flashdata("update_property_group","Property Group Updated Successfully");
                $msg = $data['username']." ".'Updated'." ".$this->input->post('property_group'). " ".'Property Group Details.';
                  $this->user_activity_model->add('updated',$msg,$data['username'],$data['admin_id']);
              redirect('Property/property_group_master');

        } 


    }

}    