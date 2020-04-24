<?php
class Reffer_model extends BaseModel {
  protected $table_name = 'users';
  	
  public function __construct($data=array()) {
    parent::__construct($data);

  }

  public function get_users(){
  	if($_SESSION[USER_SESS_KEY]['user_type'] == 1){
  		$where = array('users.id !='=>1);
  	}
  	$this->db->select('users.*');
  	if(!empty($where))
  		$this->db->where($where);
  	$query = $this->db->get($this->table_name);
  	return $query->result_array();
  }

  public function get_reffers(){
  	$where = array('users.created_by' => $_SESSION[USER_SESS_KEY]['user_id'],'users.id !='=>1);
  	$this->db->select('users.*,reffers.created_at as refrance_date,reffers.refrece_status as reffrence_status,reffers.referer_poll');
  	$this->db->join('reffers','users.id = reffers.user_id','INNER');
  	if(!empty($where))
  		$this->db->where($where);
  	$query = $this->db->get($this->table_name);
 
  	return $query->result_array();
  }

  public function after_save(){
  	$get_poll = $this->find('referer_poll',array('id'=>$this->attributes['created_by']));
  	$model_obj = new reffrence_model();

  	$model_obj->attributes['created_by'] 		= $this->attributes['created_by'];
  	$model_obj->attributes['user_id'] 			= $this->attributes['id'];
  	$model_obj->attributes['referer_poll'] 	= $get_poll['referer_poll'];
  	$model_obj->attributes['refrece_status']= 0;
  	$model_obj->save();
  	return true;
  }
}