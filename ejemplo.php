<?php

$url = $_POST['url'];

if($url != "/home/franco/Descargas/"){
    $back = accederFicheroAnterior($url);
    echo $back;
    botonBack($back);
}


function listarArchivos( $path ){
    $dir = opendir($path);
    $files = array();
    $contadorContenido = 0;
    while ($elemento = readdir($dir)){
        if( $elemento != "." && $elemento != ".."){
            //cargamos los archivos
            if( is_dir($path.$elemento) ){
                if($contadorContenido % 3 == 0){
                    echo "</div>
                    <div class=\"row justify-content-start\">";
                }
                carpeta($elemento, $path); 
                //incrementamos la variable
                $contadorContenido = $contadorContenido + 1;
            }
            else{
                $files[] = $elemento;
            }
        }
    }
    echo "</div><hr/>";

    for($i=0; $i<count( $files ); $i++){
        if($i % 3 == 0){
            echo "</div>
            <div class=\"row justify-content-start\">";
        }
        ejecutable($files[$i]);
    }
    echo "<BR>";
}
    
listarArchivos( $url );

function accederFicheroAnterior($url){
    $control = true;
    $url = substr($url, 0, -1);
    $i = strlen($url);

    while($i >= 0 && $control){
        if(substr($url,-1) == "/"){
            $control = false;
        }else{
            $url = substr($url, 0, $i);
            $i = $i - 1;
        }
    }
    return $url;
}

function botonBack($url){
    echo "
    <button type=\"button\" class=\"btn btn-light\" onclick=\"cargarCarpeta('".$url."');\">
        <i class=\"material-icons\">
            arrow_back
        </i>
    </button>
    ";
}


function ejecutable($nombreArchivo){

    echo "
    <div class=\"card col-sm\" style=\"margin:10px;\" ondblclick=\"cargarImagen('".$nombreArchivo."');\" >
        <div class=\"card-body w-100\">
            <p class=\"w-auto\">".$nombreArchivo."</p>
        </div>
    </div>";
}

function carpeta($nombreArchivo, $path){
    echo "
    <div class=\"card col-sm container\" style=\"margin:10px;\" ondblclick=\"cargarCarpeta('".$path.$nombreArchivo."/');\">
        <div class=\"card-body w-100 row align-items-center\">
            <div class=\"col-sm\" style=\"width: 80px; padding: 0%;\">
              <i class=\"material-icons\">
                folder
              </i>
            </div>
            <div class=\"col-sm texto\" >
                ".$nombreArchivo."
            </div>
            <div class=\"col-sm\">
              <button href=\"\" onclick=\"\">
                  <i class=\"material-icons\">
                    more_vert
                  </i>
              </button>
            </div>
        </div>
    </div>";
}
?>
