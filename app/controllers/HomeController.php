<?php
namespace App\Controllers;


use App\Core\Controller;
use App\Core\Database;
use App\Models\Usuario;



class HomeController extends Controller {
    public function index(){

        //Exemplo de dados do model
        $usuario = new Usuario();
        $data = $usuario->getUserData();

        $userId52 = $usuario->getUserById(52);
        $totalUsuarios = $usuario->getUsersCount();

       
        echo 'USUÁRIO COM ID 52: <strong>'. $userId52['nome_completo'].'</strong>';
        echo '<br>';
        echo 'TOTAL DE USUARIOS NO SISTEMA: <strong>'.$totalUsuarios . '</strong>';

        //Retornar a view de Home
        $this->view('home/index', $data);
        

    }
    public function contact(){
        $this->view('home/contact');
    }
}