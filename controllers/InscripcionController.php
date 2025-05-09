<?php
    require_once ("../models/modeloInscripcion.php");
    require_once ("../libs/FileUploader.php");
    require_once ("../libs/ValidadorInscripcion.php");
    class InscripcionController{
        private array $data;
        private ValidadorInscripcion $validador;
        private FileUploader $subida_archivos;
        private Inscripcion $inscripcion_db;
        public function __construct(array $data){
            $this->data = $data;
        }
        public function registrar_inscripcion(){
            $this->validador = new ValidadorInscripcion();
            $errors = $this->validador->ValidarInscripcion($this->data);
            if($errors != null){
                return $errors;
            }
            else{
                foreach(array_keys($this->data) as $campo){
                    if($this->data[$campo] == ""){
                        $this->data[$campo] = null;
                    }
                }
                $this->subida_archivos = new FileUploader();
                $response = $this->subida_archivos->save_file($_FILES["subir_archivo"], "../data/imagesagenda/");
                if(isset($response["success"])){
                    $this->data["img_route"] = $response["success"];
                    $this->inscripcion_db = new Inscripcion();
                    $rs = $this->inscripcion_db->nuevaInscripcion($this->data);
                    return $rs;
                }
                else {
                    return $response;
                }
            }
        }
    }
?>