<?php
class AnalyticsEmployeeToDoGateway extends AbstractTableGateway {
    public function __construct($connect) {
        parent::__construct($connect);
    }
    
    protected function getSelectStatement() {
        return "SELECT COUNT(*) as ToDoCount FROM EmployeeToDo WHERE DateBy LIKE '2017-06-__%'";
    }
    
    protected function getPrimaryKeyName() {
        return "MessageID";
    }
    
    protected function getTableID(){
        return "EmployeeID";
    }
    
    protected function getJoinStatement(){
        return null;
    }
    protected function addToWhere(){}
}
?>