<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/utilidades/DataBase.php');

class Usuario
{

    public $id;
    public $usuario;
    public $contrasenia;
    public $nombres;
    public $apellidos;


    private $db;

    function __construct()
    {
        $this->db = new DataBase();
        $this->id = 0;
    }

    public function set(
        $usuario,
        $contrasenia
    ) {
        $this->usuario = $usuario;
        $this->contrasenia = $contrasenia;
    }


    public function iniciarSesion()
    {
        $query = "select * from Usuario where upper(correo)= upper('$this->usuario') and contrasenia = md5('$this->contrasenia')";
        $result = $this->db->queryResult($query);
        $res = false;

        if (count($result) > 0) {
            $result = $result[0];
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }
            $_SESSION["nombres"] = $result['nombres'];
            $_SESSION["apellidos"] = $result['apellidos'];
            $_SESSION["usuario"] = $result['correo'];
            $res = true;
        }
        $this->db->close();
        return $res;
    }

    public function cerrarSesion()
    {
        session_unset();
        session_destroy();
    }



    public function __destroy()
    {
        $this->db->close();
    }


    function my_session_regenerate_id($id) {
        // Call session_create_id() while session is active to 
        // make sure collision free.
        if (session_status() != PHP_SESSION_ACTIVE) {
            session_start();
        }
        // WARNING: Never use confidential strings for prefix!
        $newid = session_create_id('myprefix-'. $id);
        // Set deleted timestamp. Session data must not be deleted immediately for reasons.
        $_SESSION['deleted_time'] = time();
        // Finish session
        session_commit();
        // Make sure to accept user defined session ID
        // NOTE: You must enable use_strict_mode for normal operations.
        ini_set('session.use_strict_mode', 0);
        // Set new custom session ID
        session_id($newid);
        // Start with custom session ID
        session_start();
    }
}
