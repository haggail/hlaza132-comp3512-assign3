<?php
abstract class AbstractTableGateway {
    protected $connection;
    
    public function __construct($connect) {
        if (is_null($connect))
        throw new Exception ("Connection is null");
        $this->connection = $connect;
    }
    
        //create the select statement for tables
    protected abstract function getSelectStatement();
    
        //create a join statement for the tables
    protected abstract function getJoinStatement();
    
        //get primary table key
    protected abstract function getPrimaryKeyName();
    
        //for matching tables with another tables key
    protected abstract function getTableID();
    
        //to add an AND to a where statement
    protected abstract function addToWhere();

    public function getAll($group=null, $sortFields=null, $limit=null) {
        $sql = $this->getSelectStatement();
        
        if (! is_null($group)) {
            $sql.= ' GROUP BY ' . $group;
        }
        
        if (! is_null($sortFields)) {
            $sql.= ' ORDER BY ' . $sortFields;
        }
        
        if (! is_null($limit)) {
            $sql.= ' LIMIT ' . $limit;
        }
        
        $statement = DatabaseHelper::runQuery($this->connection, $sql, null);
        return $statement->fetchAll();
    }
    
    //sql using "JOIN" functionality in statements
    public function joinTwoTables($key) {
        $sql = $this->getSelectStatement();
        $sql .= $this->getJoinStatement();
        
        $sql.= ' WHERE ' . $this->getTableID() . '=:key';
        //abstract functon to add AND
        //if function is null, ignore
        $sql.= $this->addToWhere();
        $statement = DatabaseHelper::runQuery($this->connection, $sql, array(':key'=> $key));
        return $statement->fetchAll();
    }
    
    //sql grabbing a statement based on primary key
    public function getByKey($key) {
        $sql = $this->getSelectStatement() . ' WHERE ' . $this->getPrimaryKeyName() . '=:key';
        $statement = DatabaseHelper::runQuery($this->connection, $sql, array(':key'=> $key));
        return $statement->fetch();
    }
    
    //sql grabbing a statement based on a passed key to match with id's that aren't the primary key
    public function matchData($param, $sortFields=null, $limit=null){
        $sql = $this->getSelectStatement() . ' WHERE ' . $this->getTableID() . '=:ID';
        
        if (! is_null($sortFields)) {
            $sql.= ' ORDER BY ' . $sortFields;
        }
        
        if (! is_null($limit)) {
            $sql.= ' LIMIT ' . $limit;
        }
        
        $statement = DatabaseHelper::runQuery($this->connection, $sql, array(':ID'=> $param));
        return $statement->fetchAll(); 
        /*return $statement->fetch(); --> original
        for later use, remember fetchAll may be the problem compared to fetch(), here's to ~5hours of debugging later.... fml */
    }
            //just another way to match 
    public function matchData2($param, $sortFields=null, $limit=null, $group=null) {
        $sql = $this->getSelectStatement() . ' WHERE ' . $this->addToWhere() . '=:ID';
        
        if (! is_null($group)) {
            $sql.= ' GROUP BY ' . $group;
        }
        
        if (! is_null($sortFields)) {
            $sql.= ' ORDER BY ' . $sortFields;
        }
        
        if (! is_null($limit)) {
            $sql.= ' LIMIT ' . $limit;
        }
        
        $statement = DatabaseHelper::runQuery($this->connection, $sql, array(':ID'=> $param));
        return $statement->fetchAll(); 
    }
    
    //matching 2 keys from different tables
    public function match2Key($key1, $key2, $limit=null, $sortFields=null) {
        $sql = $this->getSelectStatement();
        
        $sql.= ' WHERE ' . $this->getTableID() . '=:key';
        $sql.= ' AND ' . $this->addToWhere() . '=:key2';
        
        if (! is_null($sortFields)) {
            $sql.= ' ORDER BY ' . $sortFields;
        }        
        
        if (! is_null($limit)) {
            $sql.= ' LIMIT ' . $limit;
        }

        $statement = DatabaseHelper::runQuery($this->connection, $sql, array(':key'=> $key1, ':key2' => $key2));
        return $statement->fetchAll();
    }
    
    //matches with an "and" statement
    public function matchAnd($key) {
        $sql = $this->getSelectStatement();
        
        $sql.= ' AND ' . $this->addToWhere() . '=:key';
        
        $statement = DatabaseHelper::runQuery($this->connection, $sql, array(':key'=> $key));
        return $statement->fetchAll();
    }


}
?>