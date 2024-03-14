<?php

namespace App\Controllers;

use App\Model\LoginModel;
use Core\View;
use Core\Util;

class Home
{
    public function __construct()
    {
        date_default_timezone_set('America/Lima');
        session_start();
        if(!empty($_SESSION['username'])){
            header('Location:'.Util::baseUrl().'inicio');
        }
        $this -> model = new LoginModel();
    }

    public function index()
    {
        View::login(['home/index'], ['title' => 'Login']);
    }

    public function validarDatos()
    {
        if (isset($_POST['email']) && isset($_POST['password'])) {
            $email = $_POST['email'];
            $password = $_POST['password'];
            $datos = $this->model->usuariosCrm($email, $password);
            if($email == $datos->email && password_verify($password, $datos->password)){
                $_SESSION['username'] = $datos->name." ".$datos->last_name;
                View::renderJson('rs');
            }else{
                view::renderJson('incorrecto');
            }   
        }else{
            view::renderJson('vacio');
        }
    }

    public function cerrar_sesion()
    {
        session_destroy();
        header('Location: '.Util::baseUrl());
		exit;
    }

}
