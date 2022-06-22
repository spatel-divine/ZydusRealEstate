<?php

class Chrone extends CI_Controller {
    public function __construct() {
    	 parent::__construct();
         $this->load->helper(array('form', 'url','security'));
         $this->load->model('chrone_model');
         $this->load->library(array('form_validation','session'));
         $this->load->library('user_agent'); 
         error_reporting(0);
    }

    //if property is sold than installment reminder not need to send

    // if payment day/date is 31 and payment month has 30 days than its payment day for that month is 30 same for 28 days month

    // 1. Lease(Payable/Receivable) Insamination First if increment date is match with current date than done to not done flag and increment amount logic and then Not Done to Done flag change.(not need to set chrone job on expired lease) (Done / Not Done) and cut and paste amount increment code from admin controller ,model to chrone 

    //2. Document Renewal and mail(According to notifcation day) (0/1)
    public function document_list_renewal(){

    	/*if ($this->session->userdata('logged_in')) {                
            $session_data = $this->session->userdata('logged_in');
                
            $data['admin_id'] = $session_data['admin_id'];
            $data['username'] = $session_data['username'];
            $data['roles'] = $session_data['roles'];

        }
        else
        {
            redirect('Login','refresh');
        }*/

    	$data['document_renew'] = $this->chrone_model->view_document_renewal_data();

    	foreach($data['document_renew'] as $renew){

    		$renew_flag = $renew['is_renewed'];
    		$upload_id = $renew['upload_document_id'];

    		if($renew_flag == 1 AND !empty($renew['renewal_date'])){

    			$date=date_create($renew['renewal_date']);	
				date_sub($date,date_interval_create_from_date_string("30 days"));
											
				$ren_date =  date_format($date,"Y-m-d"); // renewal date 30 days before next Renewal date

				date_default_timezone_set("Asia/Kolkata");
				$current_date = date('Y-m-d');

				if($ren_date === $current_date){ // on this date it is running for multiple times how to stop this only run for onces

					$this->chrone_model->update_uploaded_document_detail($upload_id);

				}

    		}
    	}
    }

    // 3. Loan Installment Chrone and mail(Reminder Day & Payment Day)(not need to set chrone job on fully paid)(Not Paid / Paid / Fully Paid) if user (add prvious start date and end date which is in past so set Fully Paid automatically ?? )

    // 4. Rent Payable installment chrone and mail (Payment Day & reminder day(not stored in db))(not need to set chrone job on expired lease)(Paid / Not Paid)

    // 5. Rent Receivable installment Chrone and mail (Payment Day & reminder day(not stored in db))(not need to set chrone job on expired lease) (Paid / Not Paid)

    // 6. Update Property Financial Property Status according to property contract if lease given is expired count == 0(and if multiple entry for particular propery for lease than according to that)

    // 7. Lease Expiration Mail (reminder day(not stored in db) and end date)

    // 8. Insurance Renewal (reminder day(not stored in db) and Renewal Date)(not need to set chrone job on closed insurance) (0(Pending)/1(Renewed)/2(Closed))

    // 9. Insurance Expiration / Closed Mail (reminder day(not stored in db) and Expiry date)

    // 10. Loan Completion Mail (If Fully Paid) 

    // 11 . Recurring Income Reminder Mail/Notification

    // 12 . Recurring Expense Reminder Mail/Notification

    // 13 . Chrone job for updating lease given total area and given area if lease is expired

    // on expiry lease given entry plus given area on lease and update financial status if lease given property expire count is all the same id property is done on deleting lease given

    // 14. Broker Payment Reminder if not paid / partically paid reminder mail notification on dashboard and after pay change status not paid to paid

    //15. Change loan_lean_status form Lean Mark to No Status After Expiring Loan / fully paid and check count == 0 for expiring / fully paid the loan on property 

    //16. Next Hearing Notification & Mail 

    //17. claim pass,rejected,processing mail

    //18. Property Sold mail ??
}    
