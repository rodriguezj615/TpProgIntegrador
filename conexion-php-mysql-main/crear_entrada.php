<?php
require_once 'clases/Usuario.php';
session_start();
if (isset($_SESSION['usuario'])) {
    $usuario = unserialize($_SESSION['usuario']);
    $nomApe = $usuario->getNombreApellido();
} else {
    header('Location: index.php');
}
?>

<!DOCTYPE html> 
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width">
        <title>Bienvenido al sistema</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    </head>
    <body class="container">
      <div class="jumbotron text-center">
      <h1>Deposito Merceria</h1>
      </div>    
      <div class="text-center">
        <h3>Cargar Entrada</h3>

        <form action="nueva_entrada.php" method="post">
            <input name="nombreprod" id= "nombreprod" class="form-control form-control-lg" placeholder="nombre producto"><br>
            <input name="precio" id= "precio" class="form-control form-control-lg" placeholder="Precio"><br>
            <input name="stock" id= "stock" class="form-control form-control-lg" placeholder="Stock"><br>
            <input type="submit" value="Guardar entrada" class="btn btn-primary">
        </form>        
      </div> 
    </body>
</html>