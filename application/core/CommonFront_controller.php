<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . "third_party/MX/Controller.php";

class CommonFront_controller extends MX_Controller {

    public $filedata = "";
    var $user_session_key = USER_SESS_KEY; //user session key
    var $tbl_users = USERS;
    public function __construct(){
        parent::__construct();
         //users table
    }
    

    public function check_user_session(){

        $page_slug = $this->router->fetch_method();
        $allowed_pages = array('index','create','store'); //these pages/methods do not require user authentication
        $allowed_control = array('users','registrations'); //methods of this controller does not require authentication
        $current_control = $this->router->fetch_class(); // get current controller, class = controller
        
        if(!is_user_logged_in() && (in_array($page_slug,$allowed_pages)) && (in_array($current_control,$allowed_control))){
            return TRUE; //session is empty and pages is not restricted
        }else{

            //either page is resticted or session exist
            if(!is_user_logged_in()){
                redirect(base_url()); //redirect to home/login if session not exit
            }
            
            //user session exists
            $user_sess_data = $_SESSION[ $this->user_session_key ]; //user session array
            $session_u_id = $user_sess_data['user_id']; //user ID
            $where = array('id'=>$session_u_id); //status:0 means active 
            $check = $this->common_model->is_data_exists($this->tbl_users,$where);
           
            if($check === FALSE){
               //user is either deleted or is inactivated
               //$this->logout(); //force logout
            }
            
            if(empty($page_slug)){
               return TRUE; //if slug is empty and session is set
            }
            
             $after_auth = array('index','create','store');  //restrict access to these pages if session is set
            if(in_array($page_slug,$after_auth) && (in_array($current_control,$allowed_control))){
                redirect('reffers/reffers');
            }else{
                return TRUE; 
            }
            
        } 
    }
    
    function logout($is_redirect=TRUE){
        unset($_SESSION[USER_SESS_KEY]); 
        if($is_redirect){
            redirect('users'); 
        }
    }

}
