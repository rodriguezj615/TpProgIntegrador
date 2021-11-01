<?php
require_once '.env.php';
require_once 'clases/Usuario.php';
require_once 'clases/Cuenta.php';

class RepositorioSaldo
{
    private static $conexion = null;

    public function __construct()
    {
        if (is_null(self::$conexion)) {
            $credenciales = credenciales();
            self::$conexion = new mysqli(   $credenciales['servidor'],
                                            $credenciales['usuario'],
                                            $credenciales['clave'],
                                            $credenciales['base_de_datos']);
            if(self::$conexion->connect_error) {
                $error = 'Error de conexión: '.self::$conexion->connect_error;
                self::$conexion = null;
                die($error);
            }
            self::$conexion->set_charset('utf8'); 
        }
    }

    public function store(Cuenta $cuenta)
    {
        $saldo = $cuenta->getSaldo();
        $idUsuario = $cuenta->getIdUsuario();

        $q = "INSERT INTO cuentas (saldo, id_usuario) VALUES (?, ?)";

        try{
            $query = self::$conexion->prepare($q);
            $query->bind_param("ii", $saldo, $idUsuario);

            if ($query->execute()){
                return self::$conexion->insert_id;
            } else {
                return false;
            }
        } catch(Exception $e){
            return false;
        }
    }
}