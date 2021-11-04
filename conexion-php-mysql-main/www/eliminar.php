<?php
require_once 'clases/Usuario.php';
require_once 'clases/RepositorioEntrada.php';
require_once 'clases/RepositorioUsuario.php';
require_once 'clases/Entrada.php';


session_start();
if (isset($_SESSION['usuario']) && isset($_GET['l'])) {
    
$usuario = unserialize($_SESSION['usuario']);
$re = new RepositorioEntrada();
$entrada = $re->get_one($_GET['l']);

if ($entrada->getIdUsuario() != $usuario->getId()){
    header('Error: La cuenta no pertenece al USUARIO');
    }

if($entrada->getStock() != 0) {
    header('Location: home.php?mensaje= El Stock disponible no puede ser mayor a 0');
    } else {
        if ($re->delete($entrada)) {
            $mensaje = "Entrada eliminada con éxito";
            }else {
            $mensaje = "Error al eliminar la entrada";
            }
            header("Location: home.php?mensaje=$mensaje");    
    } 
} else {
header('Location: index.php');
}
?>