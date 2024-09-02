<?php

class Home extends Controller
{

    private $productosModel;
    public function __construct()
    {
        $this->productosModel = $this->model('ProductosModel');
    }

    public function index()
    {
        $title = 'Home';
        $categorias = $this->productosModel->getCategorias();
        $this->view('principal/index', compact('title', 'categorias'));
    }
}
