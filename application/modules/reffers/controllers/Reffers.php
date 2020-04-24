<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reffers extends CommonFront_controller {

	function __construct(){
	   parent::__construct();
	   $this->load->model(array('reffers/reffer_model','reffers/reffrence_model'));
     $this->check_user_session();
	}

  public function create(){
     $this->load->front_render('form');
  }

  public function index(){
    if($_SESSION[USER_SESS_KEY]['user_id'] != 1){
      redirect(base_url().'reffers/refferes');
    }
    $data['users'] = $this->reffer_model->get_users();
    $data['title'] = 'Users';
    $this->load->front_render('index',$data);
  }

  public function refferes(){
    $data['users'] = $this->reffer_model->get_reffers();
    $data['title'] = 'Reffers';
    $this->load->front_render('reffers',$data);
  }

  public function add_refferer(){
    $data['title'] = 'Add Reffers';
    //$this->reffer_model->get_user_for_reffer();
    $this->load->front_render('form',$data);
  }

  public function add(){
    $find_already_reffered = $this->reffer_model->find('id',array('email'=>$_POST['email']));
    if(!empty($find_already_reffered)){
      echo json_encode(array('status'=>0,'message'=>'Email Already Exists.'));
    }else{
      $model_obj = new reffer_model();
      $model_obj->attributes = $_POST;
      $model_obj->save();
      echo json_encode(array('status'=>1,'message'=>'Reference Done.'));
    }
  }

}