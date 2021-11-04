<?php
require_once 'clases/Usuario.php';
require_once 'clases/Entrada.php';
require_once 'clases/RepositorioEntrada.php';

session_start();
if (isset($_SESSION['usuario'])) {
    $usuario = unserialize($_SESSION['usuario']);
    $nomApe = $usuario->getNombreApellido();
    $re = new RepositorioEntrada();
    $entradas = $re->get_all($usuario);

} else {
    header('Location: index.php');
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width">
        <title>Sistema de entradas</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    </head>

  

    <body class="container">
      <div class="text-center">
            <form method="POST" action="buscar.php" >
            <div class="form-group">
              <label for="doc"></label> 
              <input type="text" name="doc" class="form-control" id="doc">
            </div></br>
              <input type="submit" value="Buscar por Nombre de Prod" class="btn btn-info" name="btn2">
            </form>
    
      </br></br>
      <?php
            if (isset($_GET['mensaje'])) {
                echo '<div id="mensaje" class="alert alert-primary text-center">
                    <p>'.$_GET['mensaje'].'</p></div>';
            }
        ?>
        <h3>Listado de entradas</h3> </br>
          <table class="table table-striped">
            <tr>
            <th>Numero de entrada</th><th>Nombre Prod. de entrada</th><th>Precio</th><th>Cantidad Disponibles</th><th>Depositar</th><th>Reponer</th><th>Eliminar</th>
            </tr>

            <?php
            if (count($entradas)== 0) {
              echo "<tr><td colspan ='8'> No tiene entradas cargados</td></tr>";
            } else {
              foreach ($entradas as $unaentrada){
                $e = $unaentrada->getIdNumer();
                  echo "<tr>";
                  echo "<td>$e</td>";
                  echo "<td>".$unaentrada->getNombreProd()."</td>";
                  echo "<td>".$unaentrada->getPrecio()."</td>";
                  echo "<td id ='stock-$e'>".$unaentrada->getStock()."</td>";
                  echo "<td><button class='btn btn-outline-success' type='button' onclick='prestar($e)'> <img src='img/modificar.ico'></button></td>";
                  echo "<td><button class='btn btn-outline-success' type='button' onclick='reponer($e)'><img src='img/agregar.png'></button></td>";
                  echo "<td><a class='btn btn-outline-danger' href='eliminar.php?l=$e' role='button'><img src='img/borrar.png'></a></td>";
                  echo "<tr>";
              }
            }

            ?>
          </table> </br></br>

          <div id="accion">
            <h4 id="tipo_accion">Acción</h4>
            <input type="hidden" id="tipo">
            <input type="hidden" id="numeroentrada">

            <label for="cantidad">Cantidad:</label> 
            <input type="number" id="cantidad"></br></br>
            <button type="button" class="btn btn-success" onclick="accion();">Realizar Acción</button><br>

          </div><hr>

          <div class="d-grid gap-2">
              <a class="btn btn-primary" href="crear_entrada.php">Agregar entrada</a>
              <a class="btn btn-outline-danger" href="logout.php">Cerrar sesión</a>
          </div>
       

        
      </div> 
    </body>


    <script type="text/javascript" src="js/my-app.js"></script>


</html>

