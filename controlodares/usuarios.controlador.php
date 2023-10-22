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

                //encriptar la contrasena
                $encriptar = crypt($_POST["ingPassword"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');
                
                $tabla = "usuarios";
                $item = "usuario";
                $valor = $_POST["ingUsuario"];
                $respuesta = Modelousuarios::mdlMostrarUsuarios($tabla, $item, $valor);

                //validacion
                if(is_array($respuesta) && $respuesta["usuario"] == $_POST["ingUsuario"] && $respuesta["password"] == $encriptar){

                    //validamos el estado del usuario
                    if($respuesta["estado"] == 1){

                        $_SESSION["iniciarSesion"] = "ok";
                        $_SESSION["id"] = $respuesta["id"];
                        $_SESSION["nombre"] = $respuesta["nombre"];
                        $_SESSION["usuario"] = $respuesta["usuario"];

                        //registrar fecha del ultimo login
                        date_default_timezone_set("America/Guatemala");

                        $fecha = date('Y-m-d');
                        $hora = date('H:i:s');

                        $fechaActual = $fecha.' '.$hora;

                        $item1 = "ultimo_login";
                        $valor1 = $fechaActual;
                        $item2 = "id";
                        $valor2 = $respuesta["id"];

                        $ultimoLogin = ModeloUsuarios::mdlActualizarUsuario($tabla, $item1, $valor1, $item2, $valor2);

                        //valido si todo ok
                        if($ultimoLogin == "ok"){
                            echo '<script>
                                window.location = "inicio";
                            </script>';
                        }
                    }else {
                        echo '<br><div class="alert alert-danger">El usuario aun no esta activado</div>';
                    }
                }else{
                    echo '<br><div class="alert alert-danger">Error al ingresar, vuelve a intentarlo</div>';
                
                }
            }
        }
    }

    static public function ctrCrearUsuario(){
        if (isset($_POST["nuevoUsuario"])) {

			if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoNombre"]) &&
				preg_match('/^[a-zA-Z0-9]+$/', $_POST["nuevoUsuario"]) &&
				preg_match('/^[a-zA-Z0-9]+$/', $_POST["nuevoPassword"])){

                    $tabla= "usuarios";
                    //encriptar la contrasena
                    $encriptar = crypt($_POST["ingPassword"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

                    $datos = array("nombre" => $_POST["nuevoNombre"],
                                    "usuario" => $_POST["nuevoUsuario"],
                                    "password" => $encriptar,
                                    "perfil" => $_POST["nuevoPerfil"],
                                    "estado" => 0); //0=inactivo, 1=activo
                    $respuesta = ModeloUsuarios::mdlRegistrarUsuario($tabla, $datos);

                    //valido
                    if($respuesta == "ok"){
                        echo '<script>
                            swal({
                                type: "success",
                                title: "El usuario ha sido guardado correctamente",
                                showConfirmButton: true,
                                confirmButtonText: "Cerrar"
                                }).then(function(result){
                                    if(result.value){
                                        window.location = "usuarios";
                                    }
                                })
                            });
                            <script>';
                    }
                }else{
                    echo '<script>
                        swal({
                        type: "error",
                        title: "Error al guardar el usuario",
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar"
                        }).then(function(result){
                        if(result.value){
                            window.location = "usuarios";
                        }
                    })
                });
                <script>';
                }
        }else{
            echo '<script>
                swal({
                    type: "error",
                    title: "Error al guardar el usuario",
                    showConfirmButton: true,
                    confirmButtonText: "Cerrar"
                    }).then(function(result){
                        if(result.value){
                            window.location = "usuarios";
                        }
                    })
                });
                <script>';
        }
    }
}