<?php
class LoginGateway extends AbstractTableGateway {
    public function __construct($connect) {
        parent::__construct($connect);
    }
    protected function getSelectStatement() {
        return "SELECT UserID, UserName, Password, Salt, State, DateJoined, DateLastModified FROM UsersLogin";
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
        return null;
    }
}
?>