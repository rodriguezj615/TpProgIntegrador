<?php
require_once '.env.php';
require_once 'clases/Repositorio.php';
require_once 'clases/Usuario.php';
require_once 'clases/Entrada.php';

class Repositorioentrada extends Repositorio
{
    
    public function guardar (Entrada $entrada)  {
        
        $idUsuario = $entrada-> getIdUsuario();
        $nombreprod = $entrada->getNombreProd();
        $precio = $entrada-> getPrecio();
        $stock = $entrada ->getStock();
        
  

        $q = "INSERT INTO stock ( nombreprod, precio, Stock, id_Usuario) VALUES (?, ?, ?, ?)";

        try {
 
                $query = self::$conexion->prepare($q);

                $query->bind_param("ssii", $nombreprod, $precio, $stock, $idUsuario);

                    if ($query->execute()){

                        return self::$conexion->insert_id;

                    } else {
                        return false;
                    }
            } catch (Exception $e){

                return false;

               } 
    }

    public function get_all(Usuario $usuario){

        $idUsuario = $usuario ->getId();
        $q = "SELECT codigo, nombreprod, precio, Stock FROM stock WHERE id_Usuario = ?";

        try {
                $query = self::$conexion->prepare($q);
                $query->bind_param("i", $idUsuario);
                $query->bind_result($numeroentrada, $nombreprod, $precio, $stock);


                if ($query->execute()){
                    $listaentradas = array();
                        while ($query->fetch()){
                            $listaentradas[] = new Entrada($usuario, $nombreprod, $precio, $stock, $numeroentrada);
                            
                        }
                        return $listaentradas;
                }
                return false;
        } catch(Exception $e){
            return false;
        }
  
    }
    
    public function get_one($numeroentrada)
    {
        $q = "SELECT nombreprod, precio, Stock, id_Usuario FROM stock WHERE codigo  = ?";
        try {
            $query = self::$conexion->prepare($q);
            $query->bind_param("i", $numeroentrada);
            $query->bind_result($nombreprod, $precio, $stock, $idUsuario);


            if ($query->execute()) {
                if ($query->fetch()) {
                    $ru = new RepositorioUsuario();
                    $usuario = $ru->get_one($idUsuario);
                    return new Entrada($usuario, $nombreprod, $precio, $stock, $numeroentrada);

                }
            }
            return false;
        } catch(Exception $e) {
            return false;
        }
    }

    public function delete(Entrada $entrada)
    {
        $n = $entrada->getIdNumer();
        $q = "DELETE FROM stock WHERE codigo = ?";

        $query = self::$conexion->prepare($q);
        $query->bind_param("i", $n);
        return ($query->execute());
    }

    public function actualizarStock(Entrada $entrada)
   
    {
        $s = $entrada->getStock();
        $n=  $entrada->getIdNumer();
       

        $q = "UPDATE stock SET Stock = ? WHERE codigo = ?";

        $query = self::$conexion->prepare($q);
        $query->bind_param("ii", $n, $s);

        return $query->execute();
    }

}
