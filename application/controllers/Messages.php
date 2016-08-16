<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Messages extends CI_Controller {

	var $UserID;
	var $Email;
	var $Message;
	var $Subject;
	var $sql;
    
    public function __construct() {
        parent:: __construct();
            
        $this->load->model('database'); //model
    } 
	
	public function index(){}
	
    public function ListOfMails($UserID) {
        // sql statement
        $this->sql = "SELECT * FROM messages WHERE userFromId = '$UserID'";
         
        // query db method
         $data = $this->database->db_query($this->sql);
         
        // encode the data into json
         $json = json_encode($data);  
        // output data in JSON
         echo $json; 
    }
	
	public function SendMail($email,$message,$subject)
	{						
		require_once('mailer/class.phpmailer.php');
		
		$mail = new PHPMailer();
        $mail->IsSMTP();
        $mail->SMTPDebug  = 0;                    
        $mail->SMTPAuth   = true;                 
        $mail->SMTPSecure = "ssl";                
        $mail->Host       = "smtp.gmail.com";     
        $mail->Port       = 465;                         
		$mail->AddAddress($email);
		$mail->Username="richie.rich774@gmail.com";  
		$mail->Password="aparichit";            
		$mail->SetFrom('richie.rich774@gmail.com','Dhruv Patel');
		$mail->Subject   = $subject;
		$mail->MsgHTML($message);
		$mail->Send();
		
		echo "Email sent successfully";
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
	
	
	
	
	
	