<?php

require_once "conexion.php";

class ModeloUsuarios {

    /**
     * Mostrar Usuarios
     * Esta funcion muestro un usuario o todos los usuarios
     */

    static public function mdlMostrarUsuarios($tabla, $item, $valor){
        if($item != null){
            $stmt = Conexion::conectar()->prepare("
                SELECT * FROM $tabla WHERE $item = :$item");
            $stmt->bindParam(":" . $item, $valor, PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->fetch();
        }else{
            $stmt = Conexion::conectar()->prepare("
                SELECT * FROM $tabla");
            $stmt->execute();
            return $stmt->fetchAll();
        }
        $stmt = null;        
    }

    /**
     * Modelo Registrar Usuario
     */
    static public function mdlRegistrarUsuario($tabla, $datos) {
        $stmt = Conexion::conectar()->prepare("
            INSERT INTO $tabla(nombre,usuario, password, estado)
            VALUES(:nombre,:usuario, :password, :estado)");
        
        $stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
        $stmt->bindParam(":usuario", $datos["usuario"], PDO::PARAM_STR);
        $stmt->bindParam(":password", $datos["password"], PDO::PARAM_STR);
        $stmt->bindParam(":estado", $datos["estado"], PDO::PARAM_INT);

        if($stmt->execute()){
            return "ok";
        }else{
            return "error";
        }

        //TODO:VALIDAR NO REPETIR EL USUARIO?

        $stmt = null;
    }

    /**
     * Modelo editar Usuario
     */

    static public function mdlEditarUsuario($tabla, $datos){

        $stmt = Conexion::conectar()->prepare("
            UPDATE $tabla SET nombre = :nombre, usuario = :usuario,
            password = :password WHERE usuario = :usuario");
    }

    /**
     * Modelo Actualizar Usuario
     */
    static public function mdlActualizarUsuario($tabla, $item1, $valor1, $item2, $valor2){
        $stmt = Conexion::conectar()->prepare("
            UPDATE $tabla SET $item1 = :$item1 WHERE $item2 = :$item2
        ");

        $stmt->bindParam(":" . $item1, $valor1, PDO::PARAM_STR);
        $stmt->bindParam(":" . $item2, $valor2, PDO::PARAM_STR);

        if($stmt->execute()){
            return "ok";
        }else{
            return "erorr";
        }

        $stmt = null;
    }

    /**
     * Modelo Eliminar Usuario
     */

    static public function mdlEliminarUsuario($tabla, $valor){
        $stmt = Conexion::conectar()->prepare("
            DELETE FROM $tabla WHERE id = :id
        ");

        $stmt->bindParam(":id", $valor, PDO::PARAM_INT);

        if($stmt->execute()){
            return "ok";
        }else{
            return "erorr";
        }

        $stmt = null;
    }
}