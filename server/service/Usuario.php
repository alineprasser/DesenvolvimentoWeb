<?php

class Usuario
{
    public static function verifyLogin(): Bool
    {
        if (!isset($_SESSION)) {
            session_start();
        }
        if (isset($_SESSION['online'])) {
            return true;
        } else {
            return false;
        }
    }
}
