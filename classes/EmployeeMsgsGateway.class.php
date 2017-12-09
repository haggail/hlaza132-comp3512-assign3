<?php
class EmployeeMsgsGateway extends AbstractTableGateway {
    public function __construct($connect) {
        parent::__construct($connect);
    }
    
    protected function getSelectStatement() {
        return "SELECT MessageDate, MessageID, Category, FirstName, LastName, Content, ContactID FROM EmployeeMessages JOIN Contacts USING (ContactID)";
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
    protected function addToWhere(){
        return null;
    }
}
?>