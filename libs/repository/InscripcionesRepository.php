<?php
    require_once (__DIR__."/../Conexion.php");
    require_once (__DIR__."/../interface/RepositoryInterface.php");
    
    class InscripcionesRepository implements RepositoryInterface{
        private $conexion;

        public  function __construct() {
            $this->conexion = new Conexion();
            $this->conexion = $this->conexion->conect();
        }

        public function save(array $data) : bool{
            $fecha_montada = date('Y/m/d H:i:s', time());
            $statement = $this->conexion->prepare(
                "INSERT INTO agenda
                    (fecha_montada, practica, tipo_actividad, nombre_actividad, nombre_artista, enlace_actividad,
                    institucion_responsable, trata_de, tiempo_actividad, desde, hasta, dias, fecha_actividad_inscripcion,
                    correo_inscripcion, duracion, nacionalidad, pais_transmision, sitio_web, facebook, instagram,
                    youtube, twitter, publico, nombre_apellido, mail, institucion, publicar, uri_img)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)"
            );
            $statement->bind_param(
                "ssssssssssssssssssssssssssss",
                $fecha_montada, $data['practica'], $data['tipo_actividad'], $data['nombre_actividad'],
                $data['nombre_artista'], $data['enlace_actividad'], $data['institucion_responsable'],
                $data['trata_de'], $data['tiempo_actividad'], $data['desde'], $data['hasta'], $data['dias'],
                $data['fecha_actividad_inscripcion'], $data['correo_inscripcion'], $data['duracion'],
                $data['nacionalidad'], $data['pais_transmision'], $data['sitio_web'], $data['facebook'],
                $data['instagram'], $data['youtube'], $data['twitter'], $data['publico'],
                $data['nombre_apellido'], $data['mail'], $data['institucion'],
                $data['publicar'], $data["img_route"]
            );
            $rs = $statement->execute();
            return $rs;
        }
    }
?>