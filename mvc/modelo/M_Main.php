<?php

namespace mvc\modelo;

class M_Main implements Modelo
{
    public function despacha()
    {
        if( session_id() )
        {
            $params = session_get_cookie_params();
            
            setcookie(session_name(), '', time() - 420, $params["path"], $params["domain"], 
            $params["secure"], $params["httponly"]);
            
            session_unset();
            session_destroy();
        }
        session_start();

        return null;
    }
}


?>