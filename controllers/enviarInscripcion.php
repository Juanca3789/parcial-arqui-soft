<?php
    require_once("./InscripcionController.php");
    date_default_timezone_set("America/Bogota");
    function filtrado($datos) {
        $datos = trim($datos); // Elimina espacios antes y después de los datos
        $datos = stripslashes($datos); // Elimina backslashes \
        $datos = htmlspecialchars($datos); // Traduce caracteres especiales en entidades HTML
        $datos = str_replace("`", "´", $datos);
        $datos = str_replace("'", "-", $datos);
        return $datos;
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
        $controller = new InscripcionController($data);
        $rs = $controller->registrar_inscripcion();
        echo json_encode($rs);
    }
?>