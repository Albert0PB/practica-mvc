<?php

require_once($_SERVER['DOCUMENT_ROOT'] . "/util/Html.php");

use util\Html;

abstract class Vista
{
    protected Html $html;

    public function __construct()
    {
        $this->html = new Html();
    }

    public function inicio_html( string $titulo)
    {
        $this->html->inicio($titulo, [
            "/estilos/general.css", 
            "/estilos/formulario.css",
            "/estilos/tablas.css"
        ]);
    }

    public function fin_html()
    {
        $this->html->fin();
    }
}

?>