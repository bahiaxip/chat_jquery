let title=document.title;
let focusDocument;
//detectar nuevo mensaje cada 5 segundos y modificar titulo de pestaña 
//en caso de no encontrarse dentro del documento
document.onreadystatechange=function(){
	if(document.readyState=="complete"){
		setInterval( ()=>{			
			testChat();
		},5000);

		$([window, document]).blur(()=> {
			focusDocument=false;

		}).focus(() => {
			focusDocument=true;

			document.title=title;
			testChat();
		})		
	}	
}
//mostrar panel
const showPanel = () => {
	panel.style.width="350px";	
	btnPanel.style.visibility="hidden";
	btnPanel.style.opacity="0";
}
//ocultar panel
const hidePanel = () => {
	panel.style.width="0";
	btnPanel.style.opacity="1";
	btnPanel.style.visibility="visible";
}
//evento tecla en textarea
const pressKey = (event) => {
	if(event.keyCode == 13 && event.shiftKey == 0){
		let text=document.querySelector("#text").value;
		let avatar = document.querySelector(".ima_profile").src;		
		chat(text,avatar);
	}
}
//ingresar nuevo mensaje
const chat = (text,avatar) => {
	let divText=document.querySelector("#text");
	divText.value="";
	divText.focus();	
	$("#message").load("class/insert_chat.php","text="+text+"&ava="+avatar);
}
//inicio sesión
const insertUser = () => {
	let name=document.querySelector("#name_session").value;	
	if(name!="" && name!=0)
		$("#message").load("class/init_session.php","name="+name,function(){
			if(!document.querySelector("#name_session")){
				let panelAvatar=document.querySelector("#avatar");
				panelAvatar.style.visibility="visible";
				panelAvatar.style.opacity="1";
			}
		});
}
//finalizar sesión
const closeSession = () => {	
	$("#message").load("class/close.php",function(){
		let panelAvatar=document.querySelector("#avatar");
		panelAvatar.style.visibility="hidden";
		panelAvatar.style.opacity="0";
	});	
}

//mantener visible el botón de Salir
const keepVisible = () => {
	let panelAvatar=document.querySelector('#avatar');
	panelAvatar.style.visibility='visible';
	panelAvatar.style.opacity='1';
}
//comprobar si se ha ingresado un nuevo mensaje
const testChat = () =>{
	$("#switch").load("class/test_chat.php",(response) => {
		//console.log("testchat");
		//si retorna true existe un nuevo chat pero es de otro usuario
		if(response=="true"){
			//comprobamos si el usuario no está en la pestaña ysi no lo está se modifica el titulo de la pestaña
			if(focusDocument==false)
				document.title="Nuevo Mensaje";
			//enviamos al archivo insert_chat el parámetro data para que actualice
			$("#message").load("class/insert_chat.php","data=upload",()=> {
				//console.log("acepta");
			})
		}
	})
}
//bloque de imagen
//validar solo si la imagen es jpg o png
const testImage= (file) => {
	return (file.files[0] && file.files[0].type == "image/png" || 
		file.files[0] && file.files[0].type=="image/jpeg") ? true : false;
}
//subir imagen y redimensionarla
const uploadImage = (div) => {
	let file=document.querySelector(div);
	//si no es png o jpg detenemos
	if(!testImage(file))
		return;
	
	let formData= new FormData();
	formData.append("images[]",file.files[0]);
	url="class/upload_image.php";				
	console.log(formData);
		
	$.ajax({
		url:url,			
		type:"POST",
		data:formData,
		//cache:false,
		processData:false,
		contentType:false,			
		success:function(datos){
			document.querySelector(".ima_profile").src="public/ima/"+datos;
			console.log(datos);
		},
		error:function(){
			console.log("Ocurrió un error con la petición Ajax");
		}
	});
}
