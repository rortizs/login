<?php 

// require_once "../controladores/usuarios.controlador.php";
require_once "./modelos/usuarios.modelo.php";

class AjaxUsuarios{

    /**
     * VALIDAR NO REPETIR USUARIOS
     */
    public $validarUsuario;
    public function validarUsuario(){
        $item = "usuario";
        $valor = $this->validarUsuario;

        $respuesta = ControladorUsuarios::ctrMostrarUsuarios($item, $valor);

        echo json_encode($respuesta);
    }
}