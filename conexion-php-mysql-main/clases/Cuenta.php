<?php
require_once 'clases/Usuario.php';
class Cuenta {
    protected $usuario;
    protected $saldo;
    protected $numero;
 
    public function __construct(Usuario $usuario, $saldo, $numero)
    {
        $this->usuario = $usuario;
        $this->saldo = $saldo;
        $this->numero = $numero;
    }

    public function getUsuario()
    {
        return $this->usuario;
    }

    public function getIdUsuario()
    {
        return $this->usuario->getId();
    }

    public function getNumero()
    {
        return $this->numero;
    }
    
    public function setNumero($n)
    {
        return $this->numero = $n;
    }
}
?>