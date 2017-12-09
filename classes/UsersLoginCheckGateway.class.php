<?php
class UsersLoginCheckGateway extends AbstractTableGateway {
    public function __construct($connect) {
        parent::__construct($connect);
    }
    protected function getSelectStatement() {
        return "SELECT UserID FROM Users";
    }
    
    protected function getPrimaryKeyName() {
        return "UserID";
    }
    
    protected function getTableID() {
        return "UserID";
    }
    
    protected function getJoinStatement(){
        return null;
    }
    
    protected function addToWhere(){
        return "LIKE";
    }
}
?>