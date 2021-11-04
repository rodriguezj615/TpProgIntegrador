<?php
require_once 'clases/Usuario.php';
require_once 'clases/Entrada.php';
require_once 'clases/RepositorioEntrada.php';

session_start();
if (isset($_SESSION['usuario'])) {
    $usuario = unserialize($_SESSION['usuario']);

    $entrada= new Entrada ($usuario, $_POST['nombreprod'],$_POST['precio'], $_POST['Stock']);
    $re = new RepositorioEntrada();
    $numero= $re-> guardar($entrada);

        if ($numero === false){

            header('Location: home.php?mensaje= Error al cargar el entrada');

        }else {
           $entrada->setIdNumer($numero);
           header('Location: home.php?mensaje= entrada creado exitosamente');
        }

} else {
    header('Location: index.php');
}
?>