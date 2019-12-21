<?php
class query{
    private $pdo;
    public function __construct($pdo){
        $this->pdo = $pdo;
    }

    public function query_stm($statement,$data_arr,$fetch_type=NULL){
        $statement = $this->pdo->prepare($sql);
        $statement->execute($data_arr);
        if (!$fetch_type) return;
        return $this->fetch($statement,$fetch_type);
    }

    public function where($table,$condition_cols,$query_cols,$fetch_type="array"){
        $table = gettype($table)=="array" ? implode(" ",$table) : $table;
        $query_cols = gettype($query_cols)=="array" ? implode(" ",$query_cols) : $query_cols;
        $sql = "SELECT {$query_cols} FROM {$table} WHERE ";
        $sql.= implode(" = ? AND ",array_keys($condition_cols))." = ?";
        $statement = $this->pdo->prepare($sql);
        $statement->execute(array_values($condition_cols));
        return $this->fetch($statement,$fetch_type);
    }
    
    private function fetch($statement,$fetch_type){
        switch ($fetch_type) {
            case "array":
                return $statement->fetchAll(PDO::FETCH_ASSOC);
            case "column":
                return $statement->fetchColumn();
            default:
                return $statement->fetchAll(PDO::FETCH_CLASS);
        }
    }

    // public function getQuery($table){
    //     $statement = $this->pdo->prepare("select * from $table");
    //     $statement->execute();
    //     return $statement->fetchAll(PDO::FETCH_CLASS);
    // }
    // public function add_data($table_name,$data){
    //     $sql = sprintf('insert into %s (%s) values (%s)',
    //         $table_name,
    //         implode(", ",array_keys($data)),
    //         ":".implode(",: ",array_keys($data)),
    //     );
    //     $statement = $this->pdo->prepare($sql);
    //     $statement->execute($data);
    // }
}