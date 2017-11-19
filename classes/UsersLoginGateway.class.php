<?php
class UsersLoginGateway extends AbstractTableGateway {
    public function __construct($connect) {
        parent::__construct($connect);
    }
    protected function getSelectStatement() {
        return "SELECT UserID, UserName, Password, Salt, State, DateJoined, DateLastModified FROM UsersLogin";
    }
    
    protected function getPrimaryKeyName() {
        return "UserName";
    }
    
    protected function getTableID() {
        return "Password";
    }
    
    protected function getJoinStatement(){
        return null;
    }
    
    protected function addToWhere(){
        return;
    }
}
?>