<?php
require_once("resize_image.php");
$resize=new Resize();

if(isset($_POST) && isset($_FILES)){

	foreach($_FILES['images']['error'] as $key => $error)
    {   
    	if($error == UPLOAD_ERR_OK){
    		$name = $_FILES['images']['name'][$key];
            //para local    		
            $path_root=getcwd();
            $path_ima=str_replace("class","",$path_root);
            $path_final=$path_ima."public/ima/".$name;	    
    	    copy($_FILES["images"]["tmp_name"][$key],$path_final);
    	    $resize->redimensionar($path_final,100,100,$path_final);
    	    echo $name;

    	}else{
    		echo "error";
    	}
	}	
}
?>
