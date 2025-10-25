<?php
require_once __DIR__ . '/../core/Controller.php';
require_once __DIR__ . '/../models/Usuario.php';


class HomeController extends Controller {
    public function index(){

        //Exemplo de dados do model
        $usuario = new Usuario();
        $data = $usuario->getUserData();


        //Retornar a view de Home
        $this->view('home/index', $data);
        

    }
    public function contact(){
        $this->view('home/contact');
    }
}