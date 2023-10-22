<?php 

require_once "../controlodares/usuarios.controlador.php";
require_once "./modelos/usuarios.modelo.php";

class AjaxUsuarios{

    //variable public
    public $idUsuario;

    /** EDITAR USUARIO*/
    public function ajaxEditarUsuario(){
        
        $item = "id";
        $valor = $this->idUsuario;

        $respuesta = ControladorUsuarios::ctrMostrarUsuarios($item, $valor);

        echo json_encode($respuesta);

    }

    /**Activar el usuario */
    public $activarUsuario;
    public $activadId;

    public function ajaxActivarUsuario(){

        $tabla = "usuarios";

        $item1 = "estado";
        $valor1 = $this->activarUsuario;

        $item2 = "id";
        $valor2 = $this->activadId;

        $respuesta = ModeloUsuarios::mdlActualizarUsuario($tabla, $item1, $valor1, $item2, $valor2);
    }

    /**
     * VALIDAR NO REPETIR USUARIOS
     */
    public $validarUsuario;
    public function ajaxValidarUsuario(){
        $item = "usuario";
        $valor = $this->validarUsuario;

        $respuesta = ControladorUsuarios::ctrMostrarUsuarios($item, $valor);

        echo json_encode($respuesta);
    }    

}

/**validar todo */
if(isset($_POST["idUsuario"])){

    $editar = new AjaxUsuarios();
    $editar->idUsuario =  $_POST["idUsuario"];
    $editar->ajaxEditarUsuario();
}

if(isset($_POST["activarUsuario"])){

    $activarUsuario = new AjaxUsuarios();
    $activarUsuario->activarUsuario =  $_POST["activarUsuario"];
    $activarUsuario->activadId =  $_POST["activadId"];
    $activarUsuario->ajaxActivarUsuario();
}

if(isset($_POST["validarUsuario"])){
    
    $validarUsuario = new AjaxUsuarios();
    $validarUsuario->validarUsuario =  $_POST["validarUsuario"];
    $validarUsuario->ajaxValidarUsuario();

}