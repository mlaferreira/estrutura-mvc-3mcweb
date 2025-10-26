<?php
namespace App\Models;
use App\Core\Model;
class Usuario extends Model{
    public function getUserData(){
        //Simulando dados de usuário
        return [
            'nome'  => 'Marcello Lima Alves Ferreira',
            'idade' => 47,
            'email' => 'mlaferreira.marcello@gmail.com'
        ];

    }

   public function createUser($nome){
    $sql = "INSERT INTO usuarios  (nome_completo) VALUES (:nome_completo)";
    $params = ['nome_completo'  => $nome];
    return $this->db->execute($sql, $params);
   }

   public function getUserById($id)
   {

    $sql = 'SELECT nome_completo FROM usuarios WHERE id = :id';
    $params = ['id' => $id];

    return $this->db->fetch($sql, $params);
   }

   public function getUsersCount(){
    return $this->db->fetch('SELECT COUNT(*) as total_usuarios FROM usuarios')['total_usuarios'];

   }
}