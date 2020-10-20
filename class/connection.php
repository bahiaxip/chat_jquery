<?php
session_start();
class Connection
{
	public static function connect(){
		$con=new mysqli("127.0.0.1","root","cali","chat_jquery");
		return $con;
	}
	//anulada imágenes en con rutas absolutas en db
	/*
	public static function url(){
	    $url="https://chatjquery.bahiaxip.com/";
	    return $url;
	}
	*/
}
?>
