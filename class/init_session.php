<?php
require_once("class_chat.php");
$chat=new Chat();
$chat_actual=$chat->chat_actual();
//validación de string (nombre de usuario que inicia sesión)
if(!isset($_GET["name"]) || !strip_tags($_GET["name"]) || !filter_var($_GET["name"],FILTER_SANITIZE_STRING)){
	echo "No se ha podido iniciar sesión";
}else{
	$_SESSION["user"]=$_GET["name"];	
	$_SESSION["id_chat"]=$chat_actual["id_chat"];		
	$chat->show_messages();
}
?>