<?php

class Email_model extends CI_Model 
{
	/*
	*	Send an email
	*	@param string $table
	* 	@param string $where
	*
	*/
	public function send_mail($receiver, $sender, $message)
	{
		$this->load->library('email');
<<<<<<< HEAD
		$this->email->initialize(array(
		 'mailtype' => 'html',
		 'validate' => TRUE,
		));
	
		$this->email->from($sender['email'], $sender['name']);
		$this->email->to($receiver['email']);
		$this->email->bcc('alvaromasitsa104@yahoo.com'); 
		$this->email->subject($message['subject']);
		$this->email->message($message['text']);
		if ($this->email->send()) {
			return TRUE;
		}else{
			return FALSE;
			//echo($this->email->print_debugger()); //Display errors if any
		}
=======

		$this->email->from($sender['email'], $sender['name']);
		$this->email->to($receiver['email']);
		
		$this->email->subject($message['subject']);
		$this->email->message($message['text']);
		
		$this->email->send();
		
		return TRUE;
>>>>>>> 440b632956276893c42653c41e62545e66db29dd
	}
}
?>