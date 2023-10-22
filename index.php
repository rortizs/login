<?php

/**
 * Mostrar los errores
 */

ini_set('display_errors', 1);
ini_set('log_errors', 1);
ini_set("error_log", "/Users/richardortiz/workspace/sistema/errors/php_err_log");

require_once "controladores/plantilla.controlador.php";
require_once "controladores/usuarios.controlador.php";

require_once "modelos/usuarios.modelo.php";

$plantilla = new ControladorPlantilla();
$plantilla -> ctrPlantilla();

