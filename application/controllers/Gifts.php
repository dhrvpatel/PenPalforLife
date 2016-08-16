<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class G extends CI_Controller {

	var $UserId;
	var $FriendId;
	var $GiftId;
	var $GiftName;
	var $PointValue;
	var	$GifImage;
	
	
	var $sql;
    
    public function __construct() {
        parent:: __construct();
            
        $this->load->model('database'); //model
    } 
	
	public function index(){}
	
	
	//CLEAR THIS FUNCTION
	public function ListGiftsByUser($UserID) {
        // sql statement
        $this->sql = "SELECT * FROM gifts WHERE id = '$UserID'";
         
        // query db method
         $data = $this->database->db_query($this->sql);
         
        // encode the data into json
         $json = json_encode($data);  
        // output data in JSON
         echo $json; 
    }
	
	   
    public function GetGift($GiftID) {
        // sql statement
        $this->sql = "SELECT * FROM gifts WHERE id = '$GiftID";
         
        // query db method
         $data = $this->database->db_query($this->sql);
         
        // encode the data into json
         $json = json_encode($data);  
        // output data in JSON
         echo $json; 
    }
	
	   
    public function AddGift($GiftName, $PointValue, $GifImage) {
        // sql statement
        $this->sql = "INSERT INTO gifts VALUES ('$GiftName', '$PointValue', '$GifImage')";
        $bool = $this->database->insert2db($this->sql); 
        
        // prints database feedback
        echo $this->dbFeedBack($bool);    
    }

	public function UpdateGift($objGift) {
        // convert JSON data to array
        $gift_object = json_decode($objGift, True);
        
        // loop the properties of the group object to generate sql statement        
        foreach($group_object as $key => $item){
            $sql_condition .= $key . " = '$item', ";            
        }
        
        // Remove characters from the right side of a string:
        $sql_condition = rtrim($sql_condition,", ");
        
        $this->sql = "update gifts set $sql_condition WHERE id = '".$objGift["id"]."'";
        $bool = $this->database->insert2db($this->sql); 
        
        // prints database feedback
        echo $this->dbFeedBack($bool);
    }
	
	public function DeleteGift($GiftId) {
        // sql statement
        $this->sql = "Delete from gifts where id = '$GiftId' ";
        $bool = $this->database->insert2db($this->sql); 
        
        // prints database feedback
        echo $this->dbFeedBack($bool);            
        
    }
    
}
	
	
	