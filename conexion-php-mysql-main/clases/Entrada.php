<?php
require_once 'clases/Usuario.php';

class Entrada 
{
    protected $usuario;
    protected $precio;
    protected $nombreprod; 
    protected $stock;
    protected $codigo;

    public function __construct(Usuario $usuario, $precio, $nombreprod, $stock, $codigo = null)
    {
        $this->usuario= $usuario;
        $this->precio= $precio;
        $this->nombreprod= $nombreprod;
        $this->stock= $stock;
        $this->codigo= $codigo;
        
    }

    public function getUsuario() {
        return $this->usuario;
    }

    public function getIdUsuario() {
        return $this->usuario->getId();
    }

    public function getPrecio() {
        return $this->precio;
    }
    public function getNombreProd() {
        return $this->nombreprod;
    }
    
     public function getStock() {
        return $this->stock;
    }
    public function setStock($s) {
        $this->stock = $s;
    }
    public function getIdNumer() {
        return $this->codigo;
    }
    public function setIdNumer($id) {
        $this->codigo = $id;
    }


    public function depositar($cantidad)
    {
        if ($this->stock >= $cantidad) {
            $this->stock = $this->stock - $cantidad;
            return true;
        } else {
            return false;
        }
    }

    public function reponer($cantidad)
    {
        $this->stock = $this->stock + $cantidad;
        return true;
    }

}