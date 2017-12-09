<?php
class SingleBookUniversityGateway extends AbstractTableGateway {
    public function __construct($connect) {
        parent::__construct($connect);
    }
    protected function getSelectStatement() {
        return "SELECT Name, UniversityID FROM Books"; 
    }
    
    protected function getPrimaryKeyName() {
        return "BookID";
    }
    
    protected function getTableID() {
        return "ISBN10";
    }
    
    protected function getJoinStatement(){
        return " JOIN AdoptionBooks USING (BookID) JOIN Adoptions USING (AdoptionID) JOIN Universities USING (UniversityID)";
    }
    
    protected function addToWhere(){
        return null;
    }
}
?>