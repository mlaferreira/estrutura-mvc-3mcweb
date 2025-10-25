<?php
namespace App\Controllers;


use App\Core\Controller;
use App\Models\Usuario;



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