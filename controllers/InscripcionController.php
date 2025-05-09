<?php
    require_once ("../libs/interface/StorageInterface.php");
    require_once ("../libs/storage/FileUploader.php");
    require_once ("../models/modeloInscripcion.php");
    require_once ("../libs/ValidadorInscripcion.php");
    class InscripcionController{
        private array $data;
        private ValidadorInscripcion $validador;
        private StorageInterface $subida_archivos;
        private ModeloInscripcion $inscripcion_db;
        public function __construct(array $data){
            $this->data = $data;
            $this->validador = new ValidadorInscripcion();
            $this->subida_archivos = new FileUploader();
            $this->inscripcion_db = new ModeloInscripcion();
        }
        public function registrar_inscripcion(){
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
                $response = $this->subida_archivos->save_file($_FILES["subir_archivo"], "../data/imagesagenda/");
                if(isset($response["success"])){
                    $this->data["img_route"] = $response["success"];
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