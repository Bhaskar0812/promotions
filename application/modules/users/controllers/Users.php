<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CommonFront_controller {

  function __construct(){
      parent::__construct();
  }

  function index(){//landing page view
      $this->check_user_session();
      $this->load->front_render('login');
  }//end of get tvshow according to country api

  public function login(){  //LOGIN FUNCION..
      $res =array();
      $this->form_validation->set_rules('email', 'Username/Email', 'trim|required');
      $this->form_validation->set_rules('password', 'Password', 'trim|required');
      if ($this->form_validation->run() == FALSE){
          $error = $this->form_validation->error_string(); //validation error
          $response = array('status'=>0,'message'=>$error);
          echo json_encode($response);exit;    
      }
      $password     =        $this->input->post('password');
      $email        =        $this->input->post('email');
      $where        =        array('email'=>$email);
      $isLogin      =        $this->common_model->isLogin($where,$password, USERS);
     
      if($isLogin == TRUE){
          $response = array('status'=>1,'message'=>'Login successfull.');
      }else{
         $response = array('status'=>0,'message'=>'Invalid email id or password.');
      }
      echo json_encode($response); //USED JSON ENCODE TO SHOW ERROR THROUGH AJAX.
  }//END OF FUNCTION


  function insertHash(){
      $password = 123456;
      $passwordw['password'] = password_hash($password, PASSWORD_DEFAULT);
      $this->common_model->insertData(USERS,$passwordw);

  }

  function logout_site(){
      $this->check_user_session();
      $this->logout();
  }

  public function add_refferer(){
    $data['title'] = 'Add';
    $this->load->front_render('form',$data);
  }
}
