<?php
class AdoptionBooksGateway extends AbstractTableGateway /*implements JsonSerializable*/ {
    public function __construct($connect) {
        parent::__construct($connect);
    }
    protected function getSelectStatement() {
        return "SELECT AdoptionDetailID, AdoptionID, BookID, Quantity, ISBN10, Title , SUM(quantity) as TopAdopted FROM AdoptionBooks JOIN Books USING(BookID) GROUP BY ISBN10 ORDER BY TopAdopted DESC LIMIT 10";
    }
    
    protected function getPrimaryKeyName() {
        return "AdoptionDetailID";
    }
    
    protected function getTableID() {
        return null;
    }
    
    protected function getJoinStatement(){
        return null;
    }
    
    protected function addToWhere(){
        return null;
    }
    /*
    protected function jsonSerialize() {
        return "{'ID':\"AdoptionDetailID\", 'Book':\"BookID\", 'Quantity':\"Quantity\"}";
    }*/
}
?>