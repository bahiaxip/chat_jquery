<?php
session_start();
class Connection
{
	public static function connect(){
		$con=new mysqli("127.0.0.1","root","cali","chat_jquery");
		return $con;
	}
}
?>
