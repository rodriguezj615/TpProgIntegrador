<?php
require_once 'clases/Usuario.php';
require_once 'clases/RepositorioEntrada.php';
require_once 'clases/RepositorioUsuario.php';
require_once 'clases/Entrada.php';

session_start();
if (isset($_SESSION['usuario']) && isset($_POST['cantidad'])) {
    $usuario = unserialize($_SESSION['usuario']);
    $re = new RepositorioEntrada();
    $entrada = $rc->get_one($_POST['numeroentrada']);
    if ($entrada->getIdUsuario() != $usuario->getId()) {
        die("Error: La cuenta no pertenece al usuario");
    }

    if ($_POST['tipo'] == 'p') {
        $r = $entrada->depositar($_POST['cantidad']);
    } else if ($_POST['tipo'] == 'r') {
        $r = $entrada->reponer($_POST['cantidad']);
    }
    if ($r) {
        $re->actualizarStock($entrada);
        $respuesta['resultado'] = "OK";
    } else {
        $respuesta['resultado'] = "Error al realizar la operación";
    }

    $respuesta['numero_entrada'] = $entrada->getId();
    $respuesta['cant'] = $entrada->getStock();
    echo json_encode($respuesta);
}

