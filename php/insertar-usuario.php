<?php


session_start();
require("config.php");


require 'config.php';
error_reporting(0);
header('Content-type: application/json; charset=utf-8');


$codigo = $_POST['codigo'];
$nombre = $_POST['nombre'];
$concentracion = $_POST['concentracion'];
$f_farmaceutica = $_POST['f_farmaceutica'];
$vencimiento = $_POST['vencimiento'];
$invima = $_POST['invima'];
$cantidad = $_POST['cantidad'];
$ingreso = $_POST['ingreso'];
$precio = $_POST['precio'];
$lote = $_POST['lote'];








// SE DEBE AQUI HACER CODIGO PARA LIMPIAR LOS DATOS DE LOS INPUTS

function validarDatos ($codigo,$nombre,$concentracion,$f_farmaceutica,$vencimiento,$invima,$cantidad){
    if($codigo == ''){
        return false;
    } elseif($nombre == ''){
        return false;
    } elseif ($concentracion == ''){
        return false;
    } elseif ($f_farmaceutica == ''){
        return false;
    } elseif($vencimiento == ''){
        return false;
    } elseif($invima == ''){
        return false;
    } elseif($cantidad == ''){
        return false;
    }
    return true;
}


if(validarDatos($codigo,$nombre,$concentracion,$f_farmaceutica,$vencimiento,$invima,$cantidad) == true){
    $conexion->set_charset('utf8');

    if($conexion->connect_errno){
        $respuesta = [
            'error' => true
        ];
    } else {
        $statement = $conexion->prepare("INSERT INTO usuarios(codigo, nombre, concentracion, f_farmaceutica, vencimiento, invima, cantidad, ingreso, precio, lote) VALUES(?,?,?,?,?,?,?,?,?,?)");
        $statement->bind_param("ssssssssss",$codigo,$nombre,$concentracion,$f_farmaceutica,$vencimiento,$invima,$cantidad,$ingreso,$precio,$lote);
        $statement->execute();

        if($conexion->affected_rows <= 0){
            $respuesta = ['error' => true];
        }
        $respuesta = [];
    }
} else {
    $respuesta = ['error' => true];
}

echo json_encode($respuesta);
echo json_encode($respuestaeliminar);

?>