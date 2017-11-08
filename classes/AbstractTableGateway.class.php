<?php
abstract class AbstractTableGateway {
    protected $connection;
    
    public function __construct($connect) {
        if (is_null($connect))
        throw new Exception ("Connection is null");
        $this->connection = $connect;
    }
    
    protected abstract function getSelectStatement();
    protected abstract function getPrimaryKeyName();

    protected abstract function getTableID();
    
    public function getAll($sortFields=null, $limit=null) {
        $sql = $this->getSelectStatement();
        
        if (! is_null($sortFields)) {
            $sql.= ' ORDER BY ' . $sortFields;
        }
        
        if (! is_null($limit)) {
            $sql.= ' LIMIT ' . $limit;
        }
        
        $statement = DatabaseHelper::runQuery($this->connection, $sql, null);
        return $statement->fetchAll();
    }
    
    public function joinTables($joinField, $paramToMatch, $key) {
        $sql = $this->getSelectStatement();
        $sql.= ' JOIN ' . $joinField . ' WHERE ' . $paramToMatch . '=:key';
        $statement = DatabaseHelper::runQuery($this->connection, $sql, array(':key'=> $key));
        return $statement->fetch();
    }
    
    public function getByKey($key) {
        $sql = $this->getSelectStatement() . ' WHERE ' . $this->getPrimaryKeyName() . '=:key';
        $statement = DatabaseHelper::runQuery($this->connection, $sql, array(':key'=> $key));
        return $statement->fetch();
    }
    
    public function matchData($param){
        $sql = $this->getSelectStatement() . ' WHERE ' . $this->getTableID() . '=:ID';
        echo $sql . "<br>";
        echo $this->getTableID() . "<br>";
        echo $param . "<br>";
        $statement = DatabaseHelper::runQuery($this->connection, $sql, array(':ID'=>$param));
        return $statement->fetch();
    }
        /*
    public function matchData($param, $key){
        $sql = $this->getSelectStatement() . ' WHERE ' . $param . '=:key';
        $statement = DatabaseHelper::runQuery($this->connection, $sql, array(':key'=> $key));
        return $statement->fetch();
        
    }
        */
    
    
}
?>