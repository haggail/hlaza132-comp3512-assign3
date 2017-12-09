<?php
class UsersGateway extends AbstractTableGateway {
    public function __construct($connect) {
        parent::__construct($connect);
    }
    protected function getSelectStatement() {
        return "SELECT Users.UserID, FirstName, LastName, Address, City, Region, Country, Postal, Phone, Email, Privacy FROM Users JOIN UsersLogin";
    }
    
    protected function getPrimaryKeyName() {
        return "UserID";
    }
    
    protected function getTableID() {
        return null;
    }
    
    protected function getJoinStatement(){
        return null;
    }
    
    protected function addToWhere(){
        return "Users.UserID";
    }
}
?>