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
        
    }
}
?>