<?php
namespace App\Controllers\Errors;

use App\Core\Controller;
class HttpErrorController extends Controller{
    public function notFound(){
        //Exibir uma página 404 personalizada
        //Retornar status 404
        http_response_code(404);        
        $this->view('erros/404');
    }
    public function internalServerError(){
        http_response_code(500);
        $this->view('erros/500');
    }
    public function aunauthorized(){
        http_response_code(403);
        $this->view('erros/403');
    }
}