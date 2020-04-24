<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
/*
 * Common Model
 * Consist common DB methods which will be commonly used throughout the project
 */
class Common_model extends CI_Model {
    function isLogin($data,$password,$table){  
    //login function common 
      $this->db->select("*");
      $this->db->where($data);
      $query = $this->db->get($table);
      if($query->num_rows()>0){
          $user = $query->row();
          $userId = $user->id;
      
          if(password_verify($password, $user->password)){
             $session_data['user_id']     =       $user->id ;
              $session_data['email']      =       $user->email;
              $session_data['name']       =       $user->name;
              $session_data['isLogin']    =       TRUE;
              $session_data['user_type']  =       $user->user_type;
              $_SESSION[USER_SESS_KEY]    = $session_data;
          
              return TRUE;
          }
          else{
              return FALSE; 
          }
      }
       return FALSE;
    }//END OF FUNCTION..

    function is_data_exists($table, $where){
      $this->db->from($table);
      $this->db->where($where);
      $query = $this->db->get();
      $rowcount = $query->num_rows();
      if($rowcount==0){
          return false;
      }
      else {
          return true;
      }
    }
   
}//END OF CLASS..