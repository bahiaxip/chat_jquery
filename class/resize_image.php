<?php
class Resize
{
//FUNCIONES DE IMAGEN
	public function redimensionar($rutaImagen,$nuevoAncho,$nuevoAlto,$rutaNueva)
    {
        $rutaNueva2=array(2);
        $rutaNueva2[0]=$rutaNueva;
        $rutaImagenOriginal=$rutaImagen;    
        //$img_original=imagecreatefromjpeg($rutaImagenOriginal);

        //llamamos al método createImage que crea un nuevo recurso de imagen a partir //de una imagen original, usando el método correspondiente (para jpeg,para 
        //png o para gif) usando para ello exif_imagetype.
        $img_original=$this->createImage($rutaImagenOriginal);
        $max_ancho=$nuevoAncho;
        $max_alto=$nuevoAlto;

        //obtenemos el ancho y el alto de la imagen y lo almacenamos en $ancho y $alto
        list($ancho,$alto)=getimagesize($rutaImagenOriginal);

        //creamos condición para obtener ancho y alto final (unas veces se mantiene el //ancho pasado y otras veces el alto pasado)  manteniendo las mismas //proporciones ancho y alto respecto a como está la imagen original
        $x_ratio=$max_ancho/$ancho;
        $y_ratio=$max_alto/$alto;
        if(($x_ratio*$alto) < $max_alto)
        {
            $alto_final=ceil($x_ratio * $alto);
            $ancho_final=$max_ancho;
        }
        else
        {
            $ancho_final=ceil($y_ratio*$ancho);
            $alto_final=$max_alto;//
        }

        //almacenamos el ancho y el alto final de la imagen final
        $rutaNueva2[1]=$ancho_final;
        $rutaNueva2[2]=$alto_final;

        //imagecreatetruecolor devuelve un identificador de imagen en color (en         //negro) con la anchura y altura indicadas, este recurso de imagen será la
        // imagen destino
        $tmp=imagecreatetruecolor($ancho_final,$alto_final);

        //imagecopyresampled copia una imagen o una parte de imagen y la redimensiona
        imagecopyresampled($tmp,$img_original,0,0,0,0,$ancho_final,$alto_final,$ancho,$alto);    
        
        //el método exportImage detecta la extensión para poder exportar la imagen
        //con su método correspondiente.
        $this->exportImage($rutaImagenOriginal, $rutaNueva2[0], $tmp);

        //exportando de forma directa solo para jpeg y jpg
        //$calidad=95;
        //imagejpeg($tmp,$rutaNueva2[0],$calidad);

        return $rutaNueva2;
    }

    //creamos recurso de imagen PHP en la ruta especificada detectando el formato (jpg,png o gif)
//correspondiente con el método testFormatImg
    public function createImage($path)
    {
        switch($this->testFormatImg($path))
            {
                case "jpeg":  
                    $imag= imagecreatefromjpeg($path);                
                    break;
                case "png":
                    $imag= imagecreatefrompng($path);
                    break;
                case "gif":
                    $imag= imagecreatefromgif($path);
                    break;
            }
         return $imag;  
    }
//Exportamos la imagen al servidor detectando el formato (jpg,png o gif)
//correspondiente con el método testFormatImg
    public function exportImage($path,$new_path,$canva)
    {
        switch($this->testFormatImg($path))
        {
            case "jpeg":            
                //imagejpeg($canva,"./".$new_path,95);
                //para ruta absoluta eliminar ./
                imagejpeg($canva,$new_path,95);
                break;
            case "png":
                //imagepng($canva,"./".$new_path,8);
                imagepng($canva,$new_path,8);
                break;
            case "gif":
                //imagegif($canva,"./".$new_path);
                imagegif($canva,$new_path);
                break;
        }
    }
//detectar el formato de un archivo de imagen 
    public function testFormatImg($im)
    {
        switch (exif_imagetype($im))
        {
            case IMAGETYPE_JPEG:
                return "jpeg";            
                break;
            case IMAGETYPE_PNG:
                return "png";            
                break;
            case IMAGETYPE_GIF:
                return "gif";
                break;
        }
    }
}
    ?>