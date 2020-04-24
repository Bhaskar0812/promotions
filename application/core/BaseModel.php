<?php 
class BaseModel extends CI_Model {
  protected $table_name = '';
  public $attributes  = array();
  public function __construct($data=array()) {
    parent::__construct();
  }

  public function find($select="*",$conditions=array(),$join=array()){
    $this->db->select($select);
    if(!empty($join))
      $this->db->join($join);
    if(!empty($conditions))
      $this->db->where($conditions);
    $query = $this->db->get($this->table_name);
    return $query->row_array();
  }

  public function save(){
    if(!empty($this->attributes['id'])){
      $this->update($this->attributes['id']);
    }else{
      $this->store();
    }
  }

  public function store(){
    $this->attributes['created_at'] = date('Y-m-d H:i:s');
    $this->attributes['created_by'] = @$_SESSION[USER_SESS_KEY]['user_id'];
    $this->db->insert($this->table_name,$this->attributes);
    $insert_id = $this->db->insert_id();
    $this->attributes['id'] = $insert_id;
    $this->after_save();
  }

  public function update($id="",$conditions=array()){
    if(!empty($conditions))
      $this->db->where($conditions);
    else
      $this->db->where('id',$id);
    unset($this->attributes['id']);
    $this->attributes['updated_at'] = date('Y-m-d H:i:s');
    $this->db->update($this->table_name,$this->attributes);
  }

  public function after_save(){}
}
