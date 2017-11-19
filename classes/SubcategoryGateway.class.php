<?php
class SubcategoryGateway extends AbstractTableGateway {
    public function __construct($connect) {
        parent::__construct($connect);
    }
    protected function getSelectStatement() {
        return "SELECT SubcategoryID, CategoryID, SubcategoryName FROM Subcategories";
    }
    
    protected function getPrimaryKeyName() {
        return "SubcategoryID";
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
}
?>