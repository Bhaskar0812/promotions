<?php
class User_model extends BaseModel {
  protected $table_name = 'users';
  	
  public function __construct($data=array()) {
    parent::__construct($data);
  }
}