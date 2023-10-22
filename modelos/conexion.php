<?php

class Conexion {

    static public function conectar(){

        $link = new PDO("
        mysql:host=localhost;dbname=miCurso",
        "root",
        "10Br3nd@10"
        );

        $link->exec("set names utf8");

        return $link;
    }
}