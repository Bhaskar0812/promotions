<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Registrations extends CommonFront_controller {

	function __construct(){
	   parent::__construct();
	   $this->load->model(array('users/user_model','reffers/reffrence_model'));
	}

  public function create(){
    $this->check_user_session();
    $this->load->front_render('registration');
  }

  public function store(){
  	$find_email_exists = $this->user_model->find('id',array('email'=>$_POST['email']));
  	if(empty($find_email_exists)){
  		$model_obj = new user_model();
  		$model_obj->attributes = $_POST;
      $model_obj->attributes['promotion_amount'] = 1;
  		$model_obj->attributes['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);
  		$model_obj->save();
       echo json_encode(array('status'=>1,'message'=>'Successfully Registered.'));
  	}else{
        $check_is_reffered = $this->user_model->find('id,created_by',array('email'=>$_POST['email'],'password'=>'','created_by !='=>''));
        if(!empty($check_is_reffered)){
       $user_model_obj = new user_model();
        $user_model_obj->attributes = $_POST;
        $user_model_obj->attributes['id'] = $check_is_reffered['id'];
        $user_model_obj->attributes['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $user_model_obj->save();
        $get_refrence_id = $this->reffrence_model->find('id',array('user_id'=>$check_is_reffered['id']));

        $this->update_refrence($get_refrence_id['id']);

        $reffrer_info = $this->user_model->find(
                                'created_by,referer_poll,promotion_amount',
                                  array(
                                    'id'=>$check_is_reffered['created_by']
                                  )
                                );
        $check_total_refference = 
                $this->get_refrence_count($check_is_reffered,$reffrer_info); 
        if(empty($reffrer_info['created_by'])){
          if($check_total_refference['count'] == 14){
            $this->set_attributes(14,$check_is_reffered,$reffrer_info);
          }
        }else{
          if($check_total_refference['count'] == 8){
            $this->set_attributes(8,$check_is_reffered,$reffrer_info);
          }
        }
        echo json_encode(array('status'=>1,'message'=>'Successfully Registered.'));
      }else{
        echo json_encode(array('status'=>0,'message'=>'Email Already registered.'));
      }
    }
  }

  private function update_refrence($id){
    $reffrence_model_obj = new reffrence_model();
    $reffrence_model_obj->attributes['id'] = $id;
    $reffrence_model_obj->attributes['refrece_status'] = 1;
    $reffrence_model_obj->save();
  }

  private function get_poll($reffrer_info){
    if($reffrer_info['referer_poll'] == 1)$poll = 2;
    if($reffrer_info['referer_poll'] == 2)$poll = 3;
    return $poll;
  }

  private function set_attributes($refrence,$check_is_reffered,$reffrer_info){
    $user_model_obj2 = new user_model();
    $reffrence_model_obj2 = new reffrence_model();
    $user_model_obj2->attributes['id'] = $check_is_reffered['created_by'];
    $poll = $this->get_poll($reffrer_info);
    $user_model_obj2->attributes['referer_poll'] = $poll;
    $user_model_obj2->attributes['promotion_amount'] = 
                                  $reffrer_info['promotion_amount']+$refrence;

    $user_model_obj2->save();
    $reffrence_model_obj2->attributes['referer_poll'] = $poll;
    $reffrence_model_obj2->update('',
                array('created_by'=>$check_is_reffered['created_by'],
                      'refrece_status'=>0));
  }

  private function get_refrence_count($check_is_reffered,$reffrer_info){
    $reffrence_model_obj = new reffrence_model();
    return $reffrence_model_obj->find('count(id) as count',array('created_by'=>$check_is_reffered['created_by'],'refrece_status'=>1,'referer_poll'=>$reffrer_info['referer_poll']));
  }

}