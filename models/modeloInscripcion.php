<?php
    require_once ("../libs/interface/RepositoryInterface.php");
    require_once ("../libs/repository/InscripcionesRepository.php");
    class ModeloInscripcion{
        private RepositoryInterface $repository;
        public function __construct() {
            $this->repository = new InscripcionesRepository();
        }

        public function nuevaInscripcion(
            array $data
        ) {
            $rs = $this->repository->save($data);
            if(!$rs){
                return ["errors" => ["No se ha podido subir la información a la DB, intenta nuevamente"]];
            }
            return ["success" => "informacion guardada correctamente"];
        }
    }
?>