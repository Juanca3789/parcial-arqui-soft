<?php
    require_once ("../libs/Conexion.php");
    class Inscripcion{
        private $conexion;
        public function __construct() {
            $this->conexion = new Conexion();
            $this->conexion = $this->conexion->conect();
        }
        private function guardarImage(array $imagenObtenida, string $carpeta){
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
        public function nuevaInscripcion(
            array $imagenObtenida,
            string $carpetaDestino,
            array $data
        ) {
            $fecha_montada = date('Y/m/d H:i:s', time());
            $statement = $this->conexion->prepare(
                "INSERT INTO agenda
                    (fecha_montada, practica, tipo_actividad, nombre_actividad, nombre_artista, enlace_actividad,
                    institucion_responsable, trata_de, tiempo_actividad, desde, hasta, dias, fecha_actividad_inscripcion,
                    correo_inscripcion, duracion, nacionalidad, pais_transmision, sitio_web, facebook, instagram,
                    youtube, twitter, publico, nombre_apellido, mail, institucion, publicar, uri_img)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)"
            );
            $img = $this->guardarImage($imagenObtenida, $carpetaDestino);
            $errors = ["errors" => []];
            if(!isset($img["success"])){
                $errors["errors"][] = $img["error"];
            }
            else{
                $statement->bind_param(
                    "ssssssssssssssssssssssssssss",
                    $fecha_montada, $data['practica'], $data['tipo_actividad'], $data['nombre_actividad'],
                    $data['nombre_artista'], $data['enlace_actividad'], $data['institucion_responsable'],
                    $data['trata_de'], $data['tiempo_actividad'], $data['desde'], $data['hasta'], $data['dias'],
                    $data['fecha_actividad_inscripcion'], $data['correo_inscripcion'], $data['duracion'],
                    $data['nacionalidad'], $data['pais_transmision'], $data['sitio_web'], $data['facebook'],
                    $data['instagram'], $data['youtube'], $data['twitter'], $data['publico'],
                    $data['nombre_apellido'], $data['mail'], $data['institucion'],
                    $data['publicar'], $img["success"]
                );
                $rs = $statement->execute();
                if(!$rs){
                    $errors["errors"][] = "No se ha podido subir la información a la DB, intenta nuevamente";
                }
            }
            if($errors["errors"] != []){
                return $errors;
            }
            return ["success" => "informacion guardada correctamente"];
        }
    }
?>