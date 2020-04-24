<?php
defined('BASEPATH') OR exit('No direct script access allowed');



class Tv_api{

    public function get_scheduleShow($url){

        $headers = array(
        );
        $ch = curl_init();
        curl_setopt( $ch, CURLOPT_URL, $url); 
        //curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
        curl_setopt( $ch, CURLOPT_CUSTOMREQUEST, 'GET');
        curl_setopt( $ch,CURLOPT_POST, true );
        curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers ); 
        curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
        curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );   
        //curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fields ) )
        $result = curl_exec($ch);
        curl_close( $ch );
        return $result;//return response in the form of json data
        
        
    }

    
}