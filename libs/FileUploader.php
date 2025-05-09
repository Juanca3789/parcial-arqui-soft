<?php
    class FileUploader{
        public function save_file(array $imagenObtenida, string $carpeta){
            $extension = $imagenObtenida["type"];
            $rs = "";
            $pasa = false;
            if (substr($extension, 0, 6) == "image/") {
                $extension = str_replace("image/", "", $extension);
                $pasa = true;
            }
            if ($extension == "") {
                $rs = "El archivo excede el límite de 200k";
                
            } else {
                $rs = "Tipo de archivo no valido, intente nuevamente";
            }
            if($pasa){
                $nombre_archivo = time().substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyz"), 0, 4).".".$extension;
                $ruta = $carpeta.basename($nombre_archivo);
                if(!move_uploaded_file($imagenObtenida['tmp_name'], $ruta)){
                    $rs = "La subida ha fallado, intentelo de nuevo";
                    $pasa = false;
                }
            }
            return $pasa ? ["success" => $ruta] : ["error" => $rs];
        }
    }
?>