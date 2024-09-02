<?php

class Contacto extends Controller
{

    public function index()
    {
        $title = 'Contacto';
        $this->view('principal/contacto', compact('title'));
    }
}
