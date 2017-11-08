<?php
class DatabaseHelper {
    public static function createConnectionInfo($values=array()) {
        $connString = $values[0];
        $user = $values[1];
        $pass = $values[2];
        
        $pdo = new PDO($connString, $user, $pass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    }
    // run an SQL query and return the cursor to the database
    public static function runQuery($connection, $sql, $parameters=array()) {
        if (!is_array($parameters)) {
            $parameters = array($parameters);
        }
        $statement = null;
        if (count($parameters) > 0) {
            $statement = $connection->prepare($sql);
            $executedOk = $statement->execute($parameters);
            if (! $executedOk) {
                throw new PDOException;
            }
        } else {
            $statement = $connection->query($sql);
            if (!$statement) {
                throw new PDOException;
            }
        }
        return $statement;
    }
}
?>