<?php

namespace mvc\controlador;

use Exception;

class Controlador
{
    protected array $peticiones_validas;
    protected string $vista_error = "\\mvc\\vista\\V_Error";

    public function __construct()
    {
        $this->peticiones_validas = [
            "Main" => [
                "modelo" => "\\mvc\\modelo\\M_Main",
                "vista" => "\\mvc\\vista\\V_Main"
            ],
            "Identificar" => [
                "modelo" => "\\mvc\\modelo\\M_Identificar",
                "vista" => "\\mvc\\vista\\V_Identificar"
            ],
            "Registrar" => [
                "modelo" => "\\mvc\\modelo\\M_Registrar",
                "vista" => "\\mvc\\vista\\V_Registrar"
            ]
        ];
    }

    public function gestiona_peticion()
    {
        try{
            $idp = $_GET['idp'] ?? $_POST['idp'] ?? "Main";
            $idp = filter_var($idp, FILTER_SANITIZE_SPECIAL_CHARS);
    
            if( !array_key_exists($idp, $this->peticiones_validas) ) 
                throw new Exception("La peticion $idp no existe.");
    
            $clase_modelo = $this->peticiones_validas[$idp]['modelo'];
            $clase_vista = $this->peticiones_validas[$idp]['vista'];
    
            if( !class_exists($clase_modelo) )
                throw new Exception("La clase modelo $clase_modelo no existe.");
            if( !class_exists($clase_vista) )
                throw new Exception("La clase vista $clase_vista no existe.");
    
            $modelo = new $clase_modelo();
            $datos = $modelo->despacha();
    
            $vista = new $clase_vista();
            $vista->genera_salida($datos);
        }
        catch( Exception $e )
        {
            $vista_error = new $this->vista_error();
            $vista_error->genera_salida([
                "mensaje" => $e->getMessage(),
                "codigo" => $e->getCode(),
                "archivo" => $e->getFile(),
                "linea" => $e->getLine(),
                "traza" => $e->getTraceAsString()
            ]);
        }
    }
}

?>