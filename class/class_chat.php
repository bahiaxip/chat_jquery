<?php
require_once("connection.php");

class Chat
{
	private $chat;
	private $con;
	//conexión a la db
	public function __construct(){		
		$this->con=Connection::connect();
	}
	//mostrar mensajes en html
	public function show_messages(){
		$sql="select * from chat order by id_chat desc";
		$res = $this->con->query($sql);
		if(Chat::total_messages()==0){
			echo "No hay mensajes";
		}				
		while($reg=$res->fetch_array()){
			echo "<img width='64' height='64' src=".$reg["foto"].">";
			echo "<p class='mensajito'>".$reg["usuario"]." dice: </p>  ";
			echo "<p class='texto'>".$reg["texto"]."</p><br><br>";
			echo "<p class='fecha'>".$reg["fecha"]."</p>";			
			echo "<hr><br>";			
		}		
	}
	//mostrar formulario de inicio de sesión
	public function show_form(){

		echo'<form name="form_user" id="form_user">
				<label for="name_session">Ingresar Usuario</label><br><br>
				<input type="text" name="name_session" id="name_session"><br><br>
				<input type="button" id="button_form_user" name="button_form_user" class="boton azul" onclick="insertUser(this)" value="Ingresar">
			</form>';
	}
	//ingresar nuevo mensaje
	public function insert_message($t,$ava){
		//obtenemos la cantidad total de mensajes
		$chat=Chat::total_messages();
		//si existen más de 200 eliminamos el último
		if($chat>200){
			//seleccionamos el último registro
			$sql="select * from chat order by id_chat asc limit 0,1";			
			$res=$this->con->query($sql);
			$reg=$res->fetch_assoc();			
			//eliminamos el último registro
			$sql2="delete from chat where id_chat=".$reg["id_chat"];			
			$res=$this->con->query($sql2);
			//insertamos el nuevo mensaje
			$user=$_SESSION["user"];
			//filtramos datos antes de insertar
			$data1=$this->con->real_escape_string(strip_tags($t));
			$data2=$this->con->real_escape_string($ava);
			$sql3=sprintf("insert into chat values(null,'%s','$user','%s',now())",$data1,$data2);
			$res=$this->con->query($sql3);
		}else{
		//si no ha llegado al límite de 200 insertamos
			$user=$_SESSION["user"];
			$data1=$this->con->real_escape_string(strip_tags($t));
			$data2=$this->con->real_escape_string($ava);
			$sql=sprintf("insert into chat values(null,'%s','$user','%s',now())",$data1,$data2);
			$res=$this->con->query($sql);
		}		
	}
	//obtener cantidad de mensajes
	public function total_messages(){
		$sql="select count(*) as total from chat";
		$res = $this->con->query($sql);		
		if($reg=$res->fetch_assoc()){
			$count=$reg["total"];
			return $count;
		}
	}
	//obtener el registro del último mensaje del chat
	public function chat_actual(){		
		$sql="select * from chat order by id_chat desc limit 0,1";
		$res = $this->con->query($sql);		
		if($reg=$res->fetch_array()){			
			return $reg;		

		}else{
			//en caso de estar la tabla vacía siendo el primer mensaje			
			$reg["id_chat"]="0";
			return $reg;
		}
	}
}
?>