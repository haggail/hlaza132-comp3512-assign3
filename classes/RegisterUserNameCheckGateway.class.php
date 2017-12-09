<?php
class RegisterUserNameCheckGateway extends AbstractTableGateway {
    public function __construct($connect) {
        parent::__construct($connect);
    }
    protected function getSelectStatement() {
        return "SELECT UserID FROM Users";
    }
    
    protected function getPrimaryKeyName() {
        return null;
    }
    
    protected function getTableID() {
        return null;
    }
    
    protected function getJoinStatement(){
        return "INSERT INTO Users (UserID, FirstName, LastName, Address, City, Region, Country, Postal, Phone, Email, Privacy) VALUES ";
    }
    
    protected function addToWhere(){
        return "INSERT INTO UsersLogin (UserID, UserName, Password, Salt, State, DateJoined, DateLastModified) VALUES ";
    }
}
/*
Users table
-----------
UserID | FirstName | LastName | Address | City | Region | Country | Postal | Phone | Email | Privacy?

UsersLogin
----------
UserID | UserName (email) | Password | Salt | State | DateJoined | DateLastModified
*/



?>