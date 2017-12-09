<?php
class EmployeeToDoGateway extends AbstractTableGateway {
    public function __construct($connect) {
        parent::__construct($connect);
    }
    
    protected function getSelectStatement() {
        return "SELECT ToDoID, EmployeeID, Status, Priority, DateBy, Description FROM EmployeeToDo";
    }
    
    protected function getPrimaryKeyName() {
        return "ToDoID";
    }
    
    protected function getTableID(){
        return "EmployeeID";
    }
    
    protected function getJoinStatement(){
        return null;
    }
    
    protected function addToWhere(){
        return null;
    }
}
?>