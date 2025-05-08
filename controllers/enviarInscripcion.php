<?php
    require_once ("../models/modeloInscripcion.php");
    date_default_timezone_set("America/Bogota");
    function filtrado($datos) {
        $datos = trim($datos); // Elimina espacios antes y después de los datos
        $datos = stripslashes($datos); // Elimina backslashes \
        $datos = htmlspecialchars($datos); // Traduce caracteres especiales en entidades HTML
        $datos = str_replace("`", "´", $datos);
        $datos = str_replace("'", "-", $datos);
        return $datos;
    }
    function validar_practica(string $practica){
        if ($practica == "") {
            return ("Debe seleccionar al menos una práctica");
        }
    }
    function validar_tipo_actividad(string $tipo_actividad){
        if ($tipo_actividad == "") {
            return ("Debe seleccionar al menos un tipo de actividad");
        }
    }
    function validar_nombre_actividad(string $nombre_actividad){
        if ($nombre_actividad == "") {
            return ("Debe indicar un nombre para la actividad");
        }
    }
    function validar_nombre_artista(string $nombre_artista){
        if ($nombre_artista == "") {
            return ("Debe indicar un nombre de artista");
        }
    }
    function validar_enlace_actividad(string $enlace_actividad){
        if ($enlace_actividad == "") {
            return ("Dirección del enlace de la actividad obligatoria");
        }
    }
    function validar_institucion_responsable(string $institucion_responsable){
        if ($institucion_responsable == "") {
            return ("Debe indicar una institución responsable");
        }
    }
    function validar_trata_de(string $trata_de){
        if ($trata_de == "") {
            return ("Debe indicar una descripción de la actividad");
        }
    }
    function validar_nacionalidad(string $nacionalidad){
        if ($nacionalidad == "") {
            return ("La nacionalidad es obligatoria");
        }
    }
    function validar_sitio_web(string $sitio_web){
        if ($sitio_web == "") {
            return ("Dirección del sitio web obligatoria");
        }
    }
    function validar_publico(string $publico){
        if ($publico == "") {
            return ("Debe seleccionar el público objetivo");
        }
    }
    function validar_nombre_apellido(string $nombre_apellido){
        if ($nombre_apellido == "") {
            return ("Debe escribir el nombre y apellido de quien sube la información");
        }
    }
    function validar_mail(string $mail){
        if ($mail == "") {
            return ("Debe escribir una dirección electrónica de quien sube la información");
        }
        if (!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
            return ("Formato de mail no válido");
        }
    }
    function validar_tiempo_actividad(string $tiempo_actividad, array &$data){
        $errors = [];
        if ($tiempo_actividad == "Disponible permanente") {
            $desde = date("Y-m-d H:i:s");
            $x = date("Y-m-d H:i:s", strtotime($desde . "+ 6 month"));
            $data["desde"] = $desde;
            $data["hasta"] = $x;
        }
        else if ($tiempo_actividad == "En un rango de tiempo específico") {
            if ($data["desde"] == "") {
                $errors[] = ("Usted seleccionó: En un rango de tiempo específico, debe colocar una fecha inicial");
            }
            if ($data["tdesde"] == "") {
                $errors[] = ("Usted seleccionó: En un rango de tiempo específico, debe colocar una hora inicial");
            }
            if ($data["hasta"] == "") {
                $errors[] = ("Usted seleccionó: En un rango de tiempo específico, debe colocar una fecha final");
            }
            if ($data["thasta"] == "") {
                $errors[] = ("Usted seleccionó: En un rango de tiempo específico, debe colocar una hora final");
            }
            $data["desde"] = $data["desde"]." ".date('H:i:s', strtotime($data["tdesde"]));
            $data["hasta"] = $data["hasta"]." ".date('H:i:s', strtotime($data["thasta"]));
            if ($data["dias"] == "") {
                $errors[] = ("Usted seleccionó: En un rango de tiempo específico, debe seleccionar los días en que estará disponible la actividad");
            }
        }
        else if ($tiempo_actividad == "Con previa inscripción") {
            if ($data["fecha_actividad_inscripcion"] == "") {
                $errors[] = ("Usted seleccionó: Con previa inscripción, debe colocar la fecha de la actividad");
            }
            if ($data["tfecha_actividad_inscripcion"] == "") {
                $errors[] = ("Usted seleccionó: Con previa inscripción, debe colocar la hora de la actividad");
            }
            if ($data["correo_inscripcion"] == "") {
                $errors[] = ("Usted seleccionó: Con previa inscripción, debe colocar cómo se inscriben");
            }
            $data["fecha_actividad_inscripcion"] = $data["fecha_actividad_inscripcion"]." ".date('H:i:s.u', strtotime($data["tfecha_actividad_inscripcion"]));
            $data["desde"] = $data["fecha_actividad_inscripcion"];
        }
        return $errors;
    }

    if ($_POST) {
        $campos = [
            "practica", "tipo_actividad", "nombre_actividad", "nombre_artista", "enlace_actividad",
            "institucion_responsable", "trata_de", "tiempo_actividad", "desde", "tdesde", "hasta", "thasta", "dias",
            "fecha_actividad_inscripcion", "tfecha_actividad_inscripcion", "correo_inscripcion", "duracion",
            "nacionalidad", "pais_transmision", "sitio_web", "facebook", "twitter", "instagram", "youtube",
            "publico", "nombre_apellido", "mail", "institucion", "publicar"
        ];
        $data = [];
        foreach ($campos as $campo) {
            if (isset($_POST[$campo])) {
                if (is_array($_POST[$campo])) {
                    $data[$campo] = filtrado(implode("; ", $_POST[$campo]));
                } else {
                    $data[$campo] = filtrado($_POST[$campo]);
                }
            } else {
                $data[$campo] = "";
            }
        }
        $data["practica"] = str_replace('Otro', filtrado($_POST["practica12"]), $data["practica"]);
        $data["publico"] = str_replace('Otro', filtrado($_POST["publico2"]), $data["publico"]);
        $errores = [];
        $errores[] = validar_practica($data["practica"]);
        $errores[] = validar_tipo_actividad($data["tipo_actividad"]);
        $errores[] = validar_nombre_actividad($data["nombre_actividad"]);
        $errores[] = validar_nombre_artista($data["nombre_artista"]);
        $errores[] = validar_enlace_actividad($data["enlace_actividad"]);
        $errores[] = validar_institucion_responsable($data["institucion_responsable"]);
        $errores[] = validar_trata_de($data["trata_de"]);
        $errores[] = validar_nacionalidad($data["nacionalidad"]);
        $errores[] = validar_sitio_web($data["sitio_web"]);
        $errores[] = validar_publico($data["publico"]);
        $errores[] = validar_nombre_apellido($data["nombre_apellido"]);
        $errores[] = validar_mail($data["mail"]);
        $validacion_tiempo = validar_tiempo_actividad($data["tiempo_actividad"], $data);
        if(!is_null($validacion_tiempo)){
            $errores = array_merge($errores, $validacion_tiempo);
        }
        $errores = array_filter($errores, fn($e) => !is_null($e));
        
        //si hubo errores detenga y muestrelos
        if (!empty($errores)) {
            echo json_encode($errores);
        }
        else{
            foreach($campos as $campo){
                if($data[$campo] == ""){
                    $data[$campo] = null;
                }
            }
            $db = new Inscripcion();
            $rs = $db->nuevaInscripcion($_FILES["subir_archivo"], "../data/imagesagenda/", $data);
            echo json_encode($rs);
        }
    }
?>