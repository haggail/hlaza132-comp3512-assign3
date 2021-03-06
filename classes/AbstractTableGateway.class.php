<?php
/* this class is the basic structure of all of our gateway classes */
abstract class AbstractTableGateway {
    protected $connection;
    
    public function __construct($connect) {
        if (is_null($connect)) //if the connection is null, throw an exception and set it
        throw new Exception ("Connection is null");
        $this->connection = $connect;
    }
    
        //creates the select statement for tables
    protected abstract function getSelectStatement();
    
        //creates a join statement for the tables
    protected abstract function getJoinStatement();
    
        //gets the primary table key
    protected abstract function getPrimaryKeyName();
    
        //this is used for matching tables with another table's key
    protected abstract function getTableID();
    
        //adds an AND to the WHERE statement
    protected abstract function addToWhere();

    //gets all of the entries from the relevant database 
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
    
    //matches 2 keys from different tables
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
    
    //used for matches with an AND statement
    public function matchAnd($key) {
        $sql = $this->getSelectStatement();
        
        $sql.= ' AND ' . $this->addToWhere() . '=:key';
        
        $statement = DatabaseHelper::runQuery($this->connection, $sql, array(':key'=> $key));
        return $statement->fetchAll();
    }
    
    //similar to match data, except for the wild cards. aka adding in "like" statements
    public function matchWildcard($param, $sortFields=null, $limit=null) {
        $sql = $this->getSelectStatement() . ' WHERE ' . $this->getTableID() . ' LIKE :ID';
        
        if (! is_null($sortFields)) {
            $sql.= ' ORDER BY ' . $sortFields;
        }
        
        if (! is_null($limit)) {
            $sql.= ' LIMIT ' . $limit;
        }
        
        $statement = DatabaseHelper::runQuery($this->connection, $sql, array(':ID'=>$param . '%'));
        return $statement->fetchAll(); 
    }
    //similar to match2key but for wildcards. aka adding in "like" statements
    public function matchWildcard2($key1, $key2, $limit=null, $sortFields=null) {
        $sql = $this->getSelectStatement();
        
        $sql.= ' WHERE ' . $this->getTableID() . ' LIKE :key';
        $sql.= ' AND ' . $this->addToWhere() . '=:key2';
        
        if (! is_null($sortFields)) {
            $sql.= ' ORDER BY ' . $sortFields;
        }        
        
        if (! is_null($limit)) {
            $sql.= ' LIMIT ' . $limit;
        }

        $statement = DatabaseHelper::runQuery($this->connection, $sql, array(':key'=> $key1 . '%', ':key2' => $key2));
        return $statement->fetchAll();
    }
    

    //add user to database
    public function registerUser($lname, $city, $country, $email, $pass, $salt, $Date, $FName, $PNumber, $Address, $Region, $Postal){
        
        //insert to userLogin
        $sql = $this->addToWhere();
        $sql .="(:email, :pass, :salt, 1, :dateJoined, :dateModified)";
        $run = DatabaseHelper::runQuery($this->connection, $sql, array(':email'=>$email, ':pass'=>$pass, ':salt'=>$salt, ':dateJoined'=>$Date, 'dateModified'=>$Date));
        
        //getting auto-incremented ID from UserLogin to add to user so the primary keys match
        $sql = $this->getSelectStatement() . "UserName = :email";
        $userID = DatabaseHelper::runQuery($this->connection, $sql, array(':email'=>$email));
        $val = $userID->fetch();
        $ID = $val['UserID'];
        
        //insert to user
        $sql = $this->getJoinStatement(); 
        $sql .= "(:user, :first, :last, :address, :city, :region, :country, :postal, :phone, :email, 1)";
        $run = DatabaseHelper::runQuery($this->connection, $sql, array(':user'=>$ID, ':first'=>$FName, ':last'=>$lname, ':address'=>$Address, ':city'=>$city, ':region'=>$Region, ':country'=>$country, ':postal'=>$Postal, ':phone'=>$PNumber, ':email'=>$email));
        

        return true;
        
        //Just realized Later on these could be turned into an array....... -Brandon
    } 
}

?>