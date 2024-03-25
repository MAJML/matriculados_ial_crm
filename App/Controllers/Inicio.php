<?php

namespace App\Controllers;

use App\Model\InicioModel;
use Core\View;
use Core\Util;

class Inicio
{

    public function __construct()
    {
        date_default_timezone_set('America/Lima');
        session_start();
        if(empty($_SESSION['username'])){
            session_destroy();
            header('Location: '.Util::baseUrl());
            exit;
        }
        $this -> model = new InicioModel();
    }

    public function index()
    {
        View::render(['Inicio/index'], ['title' => 'Inicio']);
    }

    public function metaLeads()
    {
        $meta_leads = $this->model->metaLeads();
        View::renderJson($meta_leads);
    }

    public function dataLeadsCount()
    {
        $desde = $_POST['desde'];
        $hasta = $_POST['hasta'];
        $matriculados = $this->model->countMatriculados($desde, $hasta);
        $perdidos = $this->model->countPerdidos($desde, $hasta);
        $noContactados = $this->model->countNoContactados($desde, $hasta);
        $leadsEntrantes = $this->model->countLeadsEntrantes($desde, $hasta);
        $meta_leads = $this->model->metaLeads();
        View::renderJson(['matriculados' => $matriculados, 'perdidos' => $perdidos, 'noContactados' => $noContactados, 'leadsEntrantes' => $leadsEntrantes, 'meta_leads' => $meta_leads]);
    }

    public function dataAsesoresSeguimiento()
    {
        $desde = $_POST['desde'];
        $hasta = $_POST['hasta'];
        $seguimiento = $this->model->dataAsesoresSeguimiento($desde, $hasta);
        View::renderJson($seguimiento);
    }

}
