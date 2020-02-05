<?php
$config = [
    "database_type"=>"mysql",
    "host"=>"127.0.0.1",
    "user"=>"root",
    "password"=>"quietMgsv94@"
];
class Connection{
    public static function connect($config){
        try{
            $pdo = new PDO(
                $config['database_type'].":"."host=".$config['host'],
                $config['user'],
                $config['password']
            );
            return $pdo;
        }
        catch(PDOException $e){
            die($e->getMessage());
        }
    }
}
class query{
    private $pdo;
    public function __construct($pdo){
        $this->pdo = $pdo;
    }
    // query->execute("some_statement",)
    public function exec($statement,$return_type=false,$var_arr=[]){
        try{
            $query = $this->pdo->prepare($statement);
            $query->execute($var_arr);
            if ($return_type){
                return $query;
            }
            return;
        }catch(PDOException $e){
            die($e->getMessage());
        }
    }
}
//create connection to db
$pdo = Connection::connect($config);
$db_query = new query($pdo);
//create database and use it
$db_statement = "create database if not exists abc12";
$db_query->exec($db_statement);
$use_db_statement = "use abc12";
$db_query->exec($use_db_statement);
//create table if not exist
$table_statement =  "create table if not exists abc12users(
                USERNAME VARCHAR(100) UNIQUE,
                PASSWORD_HASH CHAR(40),
                PHONE VARCHAR(10)
)";
$db_query->exec($table_statement);


