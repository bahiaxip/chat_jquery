<?php
require_once("class_chat.php");
$chat=new Chat();
$chat_actual=$chat->chat_actual();

//si la sesión es menor quiere decir que existe un nuevo chat
if(isset($_SESSION["id_chat"]) && $_SESSION["id_chat"]<$chat_actual["id_chat"] ){
	
//si existe un nuevo chat se actualiza el chat y se comprueba si es el autor del último chat
	$_SESSION["id_chat"]=$chat_actual["id_chat"];	
	//se actualizan los mensajes a todos los usuarios excepto al autor ya que 
	//al insertar se actualizan los mensajes
	if($_SESSION["user"]!=$chat_actual["usuario"])
		echo "true";	
//si la sesión no es menor quiere decir que no hay chats nuevos y no se hace nada
}
?>
