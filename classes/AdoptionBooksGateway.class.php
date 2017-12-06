<?php
class AdoptionBooksGateway extends AbstractTableGateway implements JsonSerializable {
    public function __construct($connect) {
        parent::__construct($connect);
    }
    protected function getSelectStatement() {
        return "SELECT AdoptionDetailID, AdoptionID, BookID, Quantity FROM AdoptionBooks";
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
    
    protected function jsonSerialize() {
        return "{'ID':\"AdoptionDetailID\", 'Book':\"BookID\", 'Quantity':\"Quantity\"}";
    }
}
?>