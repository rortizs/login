<?php
class ControladorUsuarios{

    static public function ctrMostrarUsuarios($item, $valor){
        $tabla = "usuarios";

        $respuesta = ModeloUsuarios::mdlMostrarUsuarios($tabla, $item, $valor);
        
        return $respuesta;
    }

    /**
     * FUNCTION INGRESAR USUARIO
     */

    static public function ctrIngresarUsuario(){

        if(isset($_POST["ingUsuario"])){
            if(preg_match('/^[a-zA-Z0-9]+$/', $_POST["ingUsuario"])){
                
                $tabla = "usuarios";
                $item = "usuario";
                $valor = $_POST["ingUsuario"];
                $respuesta = Modelousuarios::mdlMostrarUsuarios($tabla, $item, $valor);

                //TODO: CONTINUAMOS EN LA PROX. CLASE MIERCOLES
            }
        }
    }

    //TODO:PENDIENTE VALIDAR NO REPETIR EL USUARIO
}