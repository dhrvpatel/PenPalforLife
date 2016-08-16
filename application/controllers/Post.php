<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Subject extends CI_Controller {


	var $sql;
    
    public function __construct() {
        parent:: __construct();
            
        $this->load->model('database'); //model
    } 
	
	public function index(){}
	
	
	//CLEAR THIS FUNCTION
	public function ListPostByUser($PostID) {
        // sql statement
        $this->sql = "SELECT * FROM post p INNER JOIN usergifts ug ON p.PostID = g.id WHERE ug.userId = '$UserID' ";
         
        // query db method
         $data = $this->database->db_query($this->sql);
         
        // encode the data into json
         $json = json_encode($data);  
        // output data in JSON
         echo $json; 
    }
	
	   
    public function GetPost($PostID) {
        // sql statement
        $this->sql = "SELECT * FROM post WHERE id = $PostID";
         
        // query db method
         $data = $this->database->db_query($this->sql);
         
        // encode the data into json
         $json = json_encode($data);  
        // output data in JSON
         echo $json; 
    }
	
	   
    public function AddPost($values) {
        // sql statement
        $this->sql = "INSERT INTO post ('Values') VALUES ('$Values')";
        $bool = $this->database->insert2db($this->sql); 
        
        echo $bool;
		return $bool;
    }

	public function EditPost($objGift) {
		
        // convert JSON data to array
        $post_object = json_decode($objGift, True);
        
        // loop the properties of the group object to generate sql statement        
        foreach($post_object as $key => $item){
            $sql_condition .= $key . " = '$item', ";            
        }
        
        // Remove characters from the right side of a string:
        $sql_condition = rtrim($sql_condition,", ");
        
        $this->sql = "update post set $sql_condition WHERE id = '".$objPost["id"]."'";
        $bool = $this->database->insert2db($this->sql); 
        
        echo $bool;
	    return $bool;
    }
	
	public function DeletePost$PostID) {
        // sql statement
        $this->sql = "Delete from post where id = '$PostID' ";
        $bool = $this->database->insert2db($this->sql); 
        
        echo $bool;
		return $bool;            
        
    }
    
}
	
	
	