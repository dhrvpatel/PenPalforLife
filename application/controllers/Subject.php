<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Interest extends CI_Controller {


	var $sql;
    
    public function __construct() {
        parent:: __construct();
            
        $this->load->model('database'); //model
    } 
	
	public function index(){}
	
	   
    public function GetSubject($SubjectID) {
        // sql statement
        $this->sql = "SELECT * FROM subject WHERE id = $SubjectID";
         
        // query db method
         $data = $this->database->db_query($this->sql);
         
        // encode the data into json
         $json = json_encode($data);  
        // output data in JSON
         echo $json; 
    }
	
	   
    public function AddSubject($SubjectName) {
        // sql statement
        $this->sql = "INSERT INTO subjecr (name) VALUES ('$SubjectName')";
        $bool = $this->database->insert2db($this->sql); 
        
        echo $bool;
		return $bool;
    }

	public function EditSubject($objSubject) {
		
        // convert JSON data to array
        $subject_object = json_decode($objSubject, True);
        
        // loop the properties of the group object to generate sql statement        
        foreach($subject_object as $key => $item){
            $sql_condition .= $key . " = '$item', ";            
        }
        
        // Remove characters from the right side of a string:
        $sql_condition = rtrim($sql_condition,", ");
        
        $this->sql = "update subject set $sql_condition WHERE id = '".$objSubject["id"]."'";
        $bool = $this->database->insert2db($this->sql); 
        
        echo $bool;
	    return $bool;
    }
	
	public function DeleteSubject($SubjectID) {
        // sql statement
        $this->sql = "Delete from subject where id = '$SubjectID' ";
        $bool = $this->database->insert2db($this->sql); 
        
        echo $bool;
		return $bool;            
        
    }
    
}
	
	
	