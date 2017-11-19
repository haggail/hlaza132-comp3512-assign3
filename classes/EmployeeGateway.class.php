<?php
class EmployeeGateway extends AbstractTableGateway {
    public function __construct($connect) {
        parent::__construct($connect);
    }
    
    protected function getSelectStatement() {
        return "SELECT EmployeeID, FirstName, LastName, Address, City, Region, Country, Postal, Email FROM Employees";
    }
    
    protected function getOrderFields() {
        return 'LastName, FirstName';
    }
    
    protected function getPrimaryKeyName() {
        return "EmployeeID";
    }
    
    protected function getTableID(){
        return "LastName";
    }
    
    protected function getJoinStatement(){
        return null;
    }
    
    protected function addToWhere(){
        return "City";
    }
}
?>