<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Teacher extends CI_Controller {

	var $Email;
	var $Password;
	var $UserId;
	
	var $sql;
    
    public function __construct() {
        parent:: __construct();
            
        $this->load->model('database'); //model
    } 
	
	public function signin($email, $password) {
        // hashing the password
        $password = md5($password);        
        
        // sql statement
        $this->sql = "SELECT * FROM USER WHERE EMAIL = '$email' AND PASSWORD = '$password'";
         
        // query db method
         $data = $this->database->db_query($this->sql);
         
        // encode the data into json
         $json = json_encode($data);  
        // output data in JSON
         echo $json;
         
    }
	
	public function GetTeacher($UserID) {
        // sql statement
        $this->sql = "SELECT * FROM USER WHERE UserID = '$UserID'";
         
        // query db method
         $data = $this->database->db_query($this->sql);
         
        // encode the data into json
         $json = json_encode($data);  
        // output data in JSON
         echo $json;
    }
	
	///helper function to output json-boolean feedbck
    private function dbFeedBack($bool){
        if($bool == FALSE){
           //display '0' as false
           return "{0}";            
        }
        else{
           //display 1 as true
           return "{1}";
        }   
    }
    //check for record in db        
    private function db_record_check($data) {
          // count lenght of array
         $array_lenght = count($data);
         
         //if lenght is less than 1, means user account isnt verified
         if($array_lenght == 0){
             echo $this->dbFeedBack(FALSE);
         }  
         else {
             echo $this->dbFeedBack(TRUE);
         }       
    }
}
	