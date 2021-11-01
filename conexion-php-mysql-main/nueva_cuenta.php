<?php
require_once 'clases/Usuario.php';
require_once 'clases/Cuenta.php';
require_once 'clases/RepositorioSaldo.php';

session_start();
if (isset($_SESSION['usuario'])) {
    $usuario = unserialize($_SESSION['usuario']);
    $cuenta = new Cuenta ($usuario, $saldo, $numero);
    $rc = new RepositorioSaldo();
    $numero = $rc->store($cuenta);
    if ($numero === false){
        header('Location: home.php?mensaje=Error al crear la cuenta');
    }else {
        $cuenta->setNumero($numero);
        header('Location: home.php?mensaje=Cuenta creada exitosamente');
    }
} else {
    header('Location: index.php');
}
?>