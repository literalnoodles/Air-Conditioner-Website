<?php
class query{
    private $pdo;
    public $query_status;
    public function __construct($pdo){
        $this->pdo = $pdo;
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->pdo->setAttribute( PDO::ATTR_EMULATE_PREPARES, false );
    }

    public function transaction($action){
        switch ($action) {
            case 'begin':
                $this->pdo->beginTransaction();
                break;
            case 'rollback':
                $this->pdo->rollBack();
                break;
            case 'commit':
                $this->pdo->commit();
                break;
        }
    }

    public function query_stm($sql,$data_arr=NULL,$fetch_type=NULL){
        $statement = $this->pdo->prepare($sql);
        $statement->execute($data_arr);
        if (!$fetch_type) return;
        return $this->fetch($statement,$fetch_type);
    }

    public function get_last_id(){
        return $this->pdo->lastInsertId();
    }

    public function where($table,$query_cols,$condition_cols=NULL,$fetch_type="array"){
        $query_cols = gettype($query_cols)=="array" ? implode(", ",$query_cols) : $query_cols;
        $sql = "SELECT {$query_cols} FROM {$table}";
        if ($condition_cols){
            $sql.= " WHERE ";
            $sql.= implode(" AND ",array_map(function($x){return "{$x}=?";},array_keys($condition_cols)));
        }
        $statement = $this->pdo->prepare($sql);
        if ($condition_cols){
            $statement->execute(array_values($condition_cols));
        }else{
            $statement->execute();
        }
        return $this->fetch($statement,$fetch_type);
    }

    public function insert($table,$cols,$values){
        $cols = implode(", ",$cols);
        $sql = "INSERT INTO $table({$cols}) VALUES (";
        // generate "?, ?, ?..."
        $sql.= implode(", ",array_map(function($x){return "?";},$values)) . ")";
        $statement = $this->pdo->prepare($sql);
        $statement->execute($values);
        $this->query_status = $statement->rowCount()>0 ? true: false;
    }

    public function delete($table,$condition_cols){
        $sql = "DELETE FROM $table WHERE ";
        $sql.= implode(" = ? AND ",array_keys($condition_cols))." = ?";
        $statement = $this->pdo->prepare($sql);
        $statement->execute(array_values($condition_cols));
        $this->query_status = $statement->rowCount()>0 ? true: false;
    }

    public function update($table,$set_arr,$condition_arr){
        $set_str = implode(", ",array_map(function($x){return "{$x} = ? ";},array_keys($set_arr)));
        $where_str = implode("AND ",array_map(function($x){return "{$x} = ? ";},array_keys($condition_arr)));
        $sql = "UPDATE $table SET ";
        $sql.= $set_str." WHERE ";
        $sql.= $where_str;
        $statement = $this->pdo->prepare($sql);
        $data = array_merge(array_values($set_arr),array_values($condition_arr));
        $statement->execute($data);
        $this->query_status = $statement->rowCount()>0 ? true: false;
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

}