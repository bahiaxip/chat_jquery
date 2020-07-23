<?php
require_once("class_chat.php");
$chat=new Chat();
$chat_actual=$chat->chat_actual();
//si existe sesión de user y trae un parámetro text insertamos mensaje
if(isset($_SESSION["user"]) && isset($_GET["text"])){
	//mínima validación con PHP para cadenas
	if(strip_tags($_GET["text"]) && strip_tags($_GET["ava"])){
		$text=strip_tags($_GET["text"]);
		$ava=strip_tags($_GET["ava"]);
		$text=filter_var($text,FILTER_SANITIZE_STRING);	
		if(isset($text) and ($text!="")){			
			$chat->insert_message($text,$ava);			
			$chat->show_messages();	
		}
	}else{
		$chat->show_messages();	
	}
//si no trae parametro text comprobamos si trae parámetro data para solo mostrar mensajes
}elseif(isset($_SESSION["user"]) && isset($_GET["data"])){
	$chat->show_messages();
}
?>