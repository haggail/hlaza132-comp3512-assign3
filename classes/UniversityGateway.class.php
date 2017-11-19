<?php
class UniversityGateway extends AbstractTableGateway {
    public function __construct($connect) {
        parent::__construct($connect);
    }
    protected function getSelectStatement() {
        return "SELECT UniversityID, Name, Address, City, State, Zip, Website, Longitude, Latitude FROM Universities";
    }
    
    protected function getPrimaryKeyName() {
        return "UniversityID";
    }
    
    protected function getTableID() {
        return "StateId";
    }
    
    protected function getJoinStatement(){
        return " JOIN States ";
    }

    protected function addToWhere(){
        return " AND State = StateName ORDER BY Name LIMIT 20";
    }
}
?>