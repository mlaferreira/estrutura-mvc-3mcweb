<?php
namespace App\Core;

class Database{
    private $connection = null;
    private static $instance = null;


    private function __construct(){
        $this->connect();
    }

    public static function getInstance(){
        //Verifica se já existe uma instância.
        //se não existir, cria uma nova e salva em $instance,
        //Retorna $instance;
        if(self::$instance == null){
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function connect(){
        $databaseConfig = \config('database');
        

        $dsn = "mysql:host={$databaseConfig['host']};dbname={$databaseConfig['dbname']};charset={$databaseConfig['charset']}";

       $options = [
            \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
            \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
       ];

       try{
            $this->connection = new \PDO($dsn, $databaseConfig['username'], $databaseConfig['password'], $options);
            return true;
       }catch(\PDOException $e){
            throw new \Exception('Erro de conexão DB: '.$e->getMessage());
       }
       return false;

    }

    //Retorna um único resultado da consulta
    public function fetch($sql, $params = []): array
    {
        $stmt = $this->query($sql, $params);
        return $stmt->fetch();
    }

    //Retorna um array com os dados da consulta
    public function fetchAll($sql, $params = []): array
    {
        $stmt = $this->query($sql, $params);
        return $stmt->fetchAll();
    }

    //Retorna o rowCount
    public function execute($sql, $params = []): int
    {
        $stmt = $this->query($sql, $params);
        return $stmt->rowCount();
    }

    //Retorna o último ID inserido
    public function lastInsertId(): int
    {
        return $this->connection->lastInsertId();
    }

    //Retorna o número de linhas afetadas
    public function rowCount(): int
    {
        $this->connection->rowCount();
    }

    public function query($sql, $params = []){
       
        try{
            $stmt = $this->connection->prepare($sql);
            $stmt->execute($params);
            return $stmt;
        }catch(\PDOException $e){
            throw new \Exception('Erro de consulta ao DB: '.$e->getMessage());

        }
    }

}